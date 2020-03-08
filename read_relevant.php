<?php
declare(strict_types=1);

// #####################################################################################################################

$temporaryPath = __DIR__ . "/vendor";
$reportFilePath = $temporaryPath . "/report.sqlite";

// #####################################################################################################################

$pdo = null;
try {
    $pdo = new PDO("sqlite:" . $reportFilePath);
    $stmt = $pdo->query("SELECT DISTINCT url
                         FROM examples
                         WHERE is_relevant = 1");
    foreach ($stmt as $index => $row) {
        $url = $row["url"];
        preg_match('#^https://www.php.net/manual/en/(.+)\.php$#', $url, $matches);
        printf("%-60s", $matches[1]);
        if ($index % 3 === 0) {
            echo PHP_EOL;
        }
    }
    $stmt = null;
    unset($stmt);
} catch (PDOException $e) {
    echo $e->getMessage(), PHP_EOL;
}
$pdo = null;
unset($pdo);

echo PHP_EOL;