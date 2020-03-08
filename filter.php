<?php
declare(strict_types=1);

// #####################################################################################################################

$temporaryPath = __DIR__ . "/vendor";
$reportFilePath = $temporaryPath . "/report.sqlite";

// #####################################################################################################################

$pdo = null;
try {
    $pdo = new PDO("sqlite:" . $reportFilePath);
    $stmt = $pdo->exec('UPDATE examples
                         SET is_relevant = 0
                         WHERE url LIKE "%/zookeeper%"
OR url LIKE "%/yaf%"
OR url LIKE "%/yar%"
OR url LIKE "%/tidy%"
OR url LIKE "%/thread%"
OR url LIKE "%/tokyo%"
OR url LIKE "%/swish%"
OR url LIKE "%/worker%"
OR url LIKE "%/solr%"
OR url LIKE "%/yaml%"
OR url LIKE "%/sphinx%"
OR url LIKE "%/stomp%"
OR url LIKE "%/snmp%"
OR url LIKE "%/seaslog%"
OR url LIKE "%/mysql%"
OR url LIKE "%/mongo%"
OR url LIKE "%/sqlite3%"
OR url LIKE "%/reflection%"
OR url LIKE "%/sdo%"
OR url LIKE "%/quickhash%"
OR url LIKE "%/pht%"
OR url LIKE "%/pool%"
OR url LIKE "%/phar%"
OR url LIKE "%/lua%"
OR url LIKE "%/memcache%"
OR url LIKE "%/rararchive%"
OR url LIKE "%/oauth%"
OR url LIKE "%/intl%"
OR url LIKE "%/cairo%"
OR url LIKE "%/rar%"
OR url LIKE "%/mutex%"
OR url LIKE "%/imagick%"
OR url LIKE "%/gmagick%"
OR url LIKE "%/gearman%"
OR url LIKE "%/event%"
OR url LIKE "%/ds-%"
OR url LIKE "%/chdb%"
OR url LIKE "%iterator%"
OR url LIKE "%mysql%"
OR url LIKE "%mongo%"
OR url LIKE "%svn%"
OR url LIKE "%tidy%"
OR url LIKE "%wincache%"
OR url LIKE "%uopz%"
OR url LIKE "%mssql%"
OR url LIKE "%/function.pg-%"
OR url LIKE "%/function.posix-%"
OR url LIKE "%/function.gmp-%"
OR url LIKE "%/function.id3-%"
OR url LIKE "%/function.runkit%"
OR url LIKE "%/function.snmp%"
OR url LIKE "%/function.ssh%"
OR url LIKE "%/function.stomp%"
OR url LIKE "%/function.seaslog%"
OR url LIKE "%/function.intl%"
OR url LIKE "%/function.geoip-%"
OR url LIKE "%/function.eio-%"
OR url LIKE "%/function.cubrid%"
OR url LIKE "%/function.db2-%"
OR url LIKE "%/function.openssl-%"
OR url LIKE "%sybase%"
OR url LIKE "%wddx%"
OR url LIKE "%v8js%"
OR url LIKE "%.cairo%"
OR url LIKE "%gender%"
OR url LIKE "%odbc%"
OR url LIKE "%yaml-%"
OR url LIKE "%yaz-%"
OR url LIKE "%zend-%"
OR url LIKE "%.oci-%"
OR url LIKE "%.pcntl-%"
OR url LIKE "%.imap-%"
OR url LIKE "%.fbsql-%"
OR url LIKE "%.cubrid-%"
OR url LIKE "%.apc%"
OR url LIKE "%.apache%"
OR url LIKE "%.image%"
OR url LIKE "%.classkit%"
OR url LIKE "%.yaf%"
OR url LIKE "%.gd%"
OR url LIKE "%.ftp%"
OR url LIKE "%.scout%"
OR url LIKE "%zmq%"
OR url LIKE "%apc.%"
OR url LIKE "%scream.%"
OR url LIKE "%/ds.%"
OR url LIKE "%/eio.%"
OR url LIKE "%collator%"
OR url LIKE "%ibm%"
OR url LIKE "%-4d%"
OR url LIKE "%informix%"
OR url LIKE "%xhprof%"
OR url LIKE "%.tcp%"
OR url LIKE "%xmlrpc%"
OR url LIKE "%yp-%"
OR url LIKE "%ffi.%"
OR url LIKE "%/cond.%"
OR url LIKE "%/ev%"');
} catch (PDOException $e) {
    echo $e->getMessage(), PHP_EOL;
}
$pdo = null;
unset($pdo);

echo PHP_EOL;
