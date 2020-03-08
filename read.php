<?php
declare(strict_types=1);

// #####################################################################################################################

$temporaryPath = __DIR__ . "/vendor";
$reportFilePath = $temporaryPath . "/report.sqlite";

// #####################################################################################################################

$pdo = null;
try {
    $pdo = new PDO("sqlite:" . $reportFilePath);
    $stmt = $pdo->query('SELECT DISTINCT url
                        FROM examples');
    foreach ($stmt as $row)
    {
        file_put_contents($temporaryPath . "/urls.txt", $row['url'] . PHP_EOL, FILE_APPEND);
        echo $row['url'] . PHP_EOL;
    }
    $stmt = null;
    unset($stmt);
} catch (PDOException $e) {
    echo $e->getMessage(), PHP_EOL;
}
$pdo = null;
unset($pdo);