<?php
declare(strict_types=1);

$reportFilePath = __DIR__ . "/vendor/report_" . date("YmdHis") . ".txt";
$phpManualFilePath = __DIR__ . "/vendor/php_manual_en.tar.gz";
$temporaryPath = __DIR__ . "/vendor";

$p = new PharData($phpManualFilePath);
$p->extractTo($temporaryPath, null, true);

// https://stackoverflow.com/questions/13718500/using-xpath-with-php-to-parse-html
libxml_use_internal_errors(true);

$dom = new DomDocument;

foreach (glob($temporaryPath . "/php-chunked-xhtml/*.html") as $filePath) {
   
   $dom->loadHTMLFile($filePath);
   $exampleNodes = getExampleNodes($dom);
   
   /*
   if ($exampleNodes->length === 0) {
       continue;
   }
   */
   
    $url = "https://www.php.net/manual/en/" . preg_replace('/\.html$/', ".php", basename($filePath));
    /*
    if (isUrlValid($url) === false) {
        echo "[URL " . $url . " does not exist]";
        continue;
    }
    */

for ($i = 0; $i < $exampleNodes->length; $i++) {

    $exampleNode = $exampleNodes->item($i);

    list($codeNode, $outputNode) = getCodeAndOutputNodes($exampleNode);

    // If either code or output are not available,
    // no way to further process this example.
    if ($codeNode === null || $outputNode === null) {
        continue;
    }

    $codeHtml = $codeNode->ownerDocument->saveXML($codeNode);
    $code = extractText($codeHtml);

    $outputHtml = $outputNode->ownerDocument->saveXML($outputNode);
    $output = extractText($outputHtml);

    storeCodeOutputUrl($reportFilePath, $code, $output, $url);

    echo ".";

}

unlink($filePath);

}



/**
 * @param DomDocument $document
 *
 * @return DomNodeList
 *
 * @see https://stackoverflow.com/questions/26366391/xpath-selecting-attributes-using-starts-with?rq=1
 */
function getExampleNodes(DomDocument $document): DomNodeList
{
    $xpath = new DomXPath($document);

    // Query all <div> nodes with id attribute starting with "example-"
    $exampleNodes = $xpath->query("//div[starts-with(@id, 'example-')]");
    
    unset($xpath);
    
    return $exampleNodes;
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