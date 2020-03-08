<?php
declare(strict_types=1);

// #####################################################################################################################

$temporaryPath = __DIR__ . "/vendor";
$reportFilePath = $temporaryPath . "/report_" . date("YmdHis") . ".ser";
$phpManualArchiveFilePath = $temporaryPath . "/php_manual_en.tar.gz";
$phpManualFolderPath = $temporaryPath . "/php_manual";
$documentationBaseUrl = "https://www.php.net/manual/en";

// #####################################################################################################################

/**
 * @var array e.g. Array (
 *                   [...]
 *                   [23] => Array (
 *                             [example_id] => example-5924
 *                             [code] => <?php
 *                                       $zk = new Zookeeper();
 *                                       $zk->connect('localhost:2181');
 *                                       $zk->addAuth('digest', 'timandes:timandes');
 *                                       $zkConfig = $zk->getConfig();
 *                                       $r = $zkConfig->get();
 *                                       if ($r)
 *                                           echo $r;
 *                                       else
 *                                           echo 'ERR';
 *                                       ?>
 *                             [output] => server.1=localhost:2888:3888:participant;0.0.0.0:2181
 *                                         version=0xca01e881a2
 *                             [url] => https://www.php.net/manual/en/zookeeperconfig.get.php
 *                           )
 *                   [...]
 *                 )
 */
$data = [];

decompressArchive($phpManualArchiveFilePath, $temporaryPath);

// https://stackoverflow.com/questions/13718500/using-xpath-with-php-to-parse-html
libxml_use_internal_errors(true);

$dom = new DomDocument;

foreach (glob($temporaryPath . "/php-chunked-xhtml/*.html") as $filePath) {

    $dom->loadHTMLFile($filePath);
    $exampleNodes = getExampleNodes($dom);

    if ($exampleNodes->length === 0) {
        continue;
    }

    $url = $documentationBaseUrl . "/" . preg_replace('/\.html$/', ".php", basename($filePath));
/*
    if (isUrlValid($url) === false) {
        echo "[URL " . $url . " does not exist]";
        continue;
    }
*/
    for ($i = 0; $i < $exampleNodes->length; $i++) {

        $exampleNode = $exampleNodes->item($i);

        $exampleId = $exampleNode->getAttribute("id");

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

        // storeCodeOutputUrl($reportFilePath, $code, $output, $url);

        $data[] = [
            "example_id" => $exampleId,
            "code" => $code,
            "output" => $output,
            "url" => $url,
        ];

        echo ".";

    }

    unlink($filePath);

}

file_put_contents($reportFilePath, serialize($data));

// #####################################################################################################################

/**
 * @param string $archiveFilePath
 * @param string $destinationPath
 */
function decompressArchive(string $archiveFilePath, string $destinationPath)
{
    $p = new PharData($archiveFilePath);
    $p->extractTo($destinationPath, null, true);
    unset($p);
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
    $headers = get_headers($url);
    $result = is_array($headers) === true &&
        isset($headers[0]) === true &&
        is_string($headers[0]) === true &&
        substr($headers[0], -6) === "200 OK";
    return $result;
}

/**
 * @param string $filePath
 * @param string $code
 * @param string $output
 * @param string $url
 */
function storeCodeOutputUrl(string $filePath, string $code, string $output, string $url)
{
    file_put_contents(
        $filePath,
        PHP_EOL . PHP_EOL .
        $code .
        PHP_EOL . PHP_EOL .
        $output .
        PHP_EOL . PHP_EOL .
        $url .
        PHP_EOL . PHP_EOL .
        str_repeat("#", 100),
        FILE_APPEND
    );
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