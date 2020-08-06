--TEST--
MongoDB\Driver\Manager::executeBulkWrite() write concern inheritance
--SKIPIF--
<?php require __DIR__ . "/../utils/basic-skipif.inc"; ?>
<?php skip_if_not_replica_set(); ?>
<?php skip_if_not_enough_data_nodes(2); /* w:2 */ ?>
<?php skip_if_not_clean(); ?>
--FILE--
<?php
require_once __DIR__ . "/../utils/basic.inc";
require_once __DIR__ . "/../utils/observer.php";

$manager = new MongoDB\Driver\Manager(URI, ['w' => 2, 'wtimeoutms' => 1000]);

(new CommandObserver)->observe(
    function() use ($manager) {
        $bulk = new MongoDB\Driver\BulkWrite;
        $bulk->insert(['x' => 1]);
        $manager->executeBulkWrite(NS, $bulk);

        $bulk = new MongoDB\Driver\BulkWrite;
        $bulk->insert(['x' => 1]);
        $manager->executeBulkWrite(NS, $bulk, ['writeConcern' => new MongoDB\Driver\WriteConcern(1)]);
    },
    function(stdClass $command) {
        echo json_encode($command->writeConcern), "\n";
    }
);

?>
===DONE===
<?php exit(0); ?>
--EXPECT--
{"w":2,"wtimeout":1000}
{"w":1}
===DONE===
