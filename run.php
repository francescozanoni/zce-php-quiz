<?php
declare(strict_types=1);

// https://stackoverflow.com/questions/13718500/using-xpath-with-php-to-parse-html
libxml_use_internal_errors(true);
$dom = new DomDocument;
$dom->loadHTMLFile("php-bigxhtml.html");
$xpath = new DomXPath($dom);

/* Query all <div> nodes with id attribute starting with "example-" */
// https://stackoverflow.com/questions/26366391/xpath-selecting-attributes-using-starts-with?rq=1
$exampleNodes = $xpath->query("//div[starts-with(@id, 'example-')]");

$reportFilePath = __DIR__ . "/report_" . date("YmdHis") . ".txt";

for ($i = 0; $i < $exampleNodes->length; $i++) {

    $exampleNode = $exampleNodes->item($i);

    list($codeNode, $outputNode) = getCodeAndOutputNodes($exampleNode);

    // If either code or output are not available,
    // no way to further process this example.
    if ($codeNode === null || $outputNode === null) {
        continue;
    }

    /*
    if (isUrlValid($url) === false) {
        echo "[URL " . $url . " does not exist]";
        continue;
    }
    */

    $codeHtml = $codeNode->ownerDocument->saveXML($codeNode);
    $code = extractText($codeHtml);

    $outputHtml = $outputNode->ownerDocument->saveXML($outputNode);
    $output = extractText($outputHtml);

    $url = getUrlFromDomElement($exampleNode, $xpath);

    storeCodeOutputUrl($reportFilePath, $code, $output, $url);

    echo ".";

}

function isUrlValid(string $url): bool
{
    $result = null;

    $curl = curl_init();
    curl_setopt($curl, CURLOPT_URL, $url);
    curl_setopt($curl, CURLOPT_NOBODY, true);
    if (false === curl_exec($curl) ||
        200 !== curl_getinfo($curl, CURLINFO_HTTP_CODE)) {
        $result = false;
    } else {
        $result = true;
    }
    curl_close($curl);

    return $result;
}

function getUrlFromDomElement(DOMElement $element, DOMXPath $xpath): string
{
    // https://stackoverflow.com/questions/28237694/xpath-get-parent-node-from-child-node
    // https://stackoverflow.com/questions/5350666/xpath-or-operator-for-different-nodes
    $page = $xpath
        ->query(
            '//div[@id="' . $element->getAttribute("id") . '"]/ancestor::div[@class="section"]' .
            '|' .
            '//div[@id="' . $element->getAttribute("id") . '"]/ancestor::div[@class="sect1"]'
        )
        ->item(0)
        ->getAttribute("id");
    $page = "https://www.php.net/manual/en/" . $page . ".php";
    return $page;
}

function storeCodeOutputUrl(string $filePath, string $code, string $output, string $url)
{
    file_put_contents($filePath, PHP_EOL . PHP_EOL, FILE_APPEND);
    file_put_contents($filePath, $code, FILE_APPEND);
    file_put_contents($filePath, PHP_EOL . PHP_EOL, FILE_APPEND);
    file_put_contents($filePath, $output, FILE_APPEND);
    file_put_contents($filePath, PHP_EOL . PHP_EOL, FILE_APPEND);
    file_put_contents($filePath, $url, FILE_APPEND);
    file_put_contents($filePath, PHP_EOL . PHP_EOL, FILE_APPEND);
    file_put_contents($filePath, "##################################################################################", FILE_APPEND);
}

/**
 * @param DOMNode $exampleNode
 *
 * @return array
 *
 * @see https://stackoverflow.com/questions/2234441/creating-a-domdocument-from-a-domnode-in-php
 */
function getCodeAndOutputNodes(DOMNode $exampleNode): array
{
    $dom = new DomDocument;
    $dom->appendChild($dom->importNode($exampleNode, true));
    $xpath = new DomXPath($dom);

    $codeNodes = $xpath->query("//code");
    $outputNodes = $xpath->query("//pre");

    unset($xpath);

    return [
        $codeNodes->length > 0 ? $codeNodes->item(0) : null,
        $outputNodes->length > 0 ? $outputNodes->item(0) : null,
    ];
}

/**
 * @param string $htmlTagContent e.g. <code>
 *                                      <span style="color: #000000">
 *                                        <span style="color: #0000BB">&lt;?php<br/>$insert </span>
 *                                        <span style="color: #007700">= </span>
 *                                        <span style="color: #0000BB">$db</span>
 *                                        <span style="color: #007700">-&gt;</span>
 *                                        <span style="color: #0000BB">prepare</span>
 *                                        <span style="color: #007700">(</span>
 *                                        <span style="color: #DD0000">"SELECT * FROM table"</span>
 *                                        <span style="color: #007700">);<br/></span>
 *                                        <span style="color: #0000BB">?&gt;</span>
 *                                      </span>
 *                                    </code>
 *
 * @return string e.g. <?php
 *                     $insert = $db->prepare("SELECT * FROM table");
 *                     ?>
 */
function extractText(string $htmlTagContent): string
{

    $text = $htmlTagContent;

    // Fix %C2%A0 sequence, which is $nbsp;
    // https://stackoverflow.com/questions/12837682/non-breaking-utf-8-0xc2a0-space-and-preg-replace-strange-behaviour
    $text = bin2hex($text);
    $text = str_replace("c2a0", "20", $text);
    $text = hex2bin($text);

    $text = str_replace(["<br />", "<br/>", "<br>"], PHP_EOL, $text);

    $text = strip_tags($text);
    $text = html_entity_decode($text);

    $text = trim($text);

    return $text;
}