<?php
declare(strict_types=1);

// #####################################################################################################################

$temporaryPath = __DIR__ . "/vendor";
$reportFilePathSer = $temporaryPath . "/report.ser";
$reportFilePath = $temporaryPath . "/report.sqlite";

// #####################################################################################################################

$data = unserialize(file_get_contents($reportFilePathSer));

$pdo = null;
try {
    $pdo = new PDO("sqlite:" . $reportFilePath);
    $pdo->exec(
        "CREATE TABLE examples (
          id INTEGER PRIMARY KEY AUTOINCREMENT,
          example_id TEXT NOT NULL UNIQUE,
          code TEXT NOT NULL,
          output TEXT NOT NULL,
          url TEXT NOT NULL,
          is_relevant INTEGER
        )"
    );
    $stmt = $pdo->prepare('INSERT INTO examples VALUES (NULL, ?, ?, ?, ?, 1)');
    foreach ($data as $datum)
    {
        $stmt->execute(array_values($datum));
        echo ".";
    }
    $stmt = null;
    unset($stmt);
} catch (PDOException $e) {
    echo $e->getMessage(), PHP_EOL;
}
$pdo = null;
unset($pdo);

echo PHP_EOL;