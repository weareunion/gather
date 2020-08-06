--TEST--
MongoDB\Driver\Manager::executeCommand() does not inherit read or write concern
--SKIPIF--
<?php require __DIR__ . "/../utils/basic-skipif.inc"; ?>
<?php skip_if_not_replica_set(); ?>
<?php skip_if_not_enough_data_nodes(2); /* w:2 */ ?>
<?php skip_if_server_version('<', '3.6'); /* readConcernLevel:available */ ?>
<?php skip_if_not_clean(); ?>
--FILE--
<?php
require_once __DIR__ . "/../utils/basic.inc";
require_once __DIR__ . "/../utils/observer.php";

$manager = new MongoDB\Driver\Manager(URI, ['readConcernLevel' => 'local', 'w' => 2, 'wtimeoutms' => 1000]);

$command = new MongoDB\Driver\Command([
    'aggregate' => COLLECTION_NAME,
    'pipeline' => [
        ['$group' => ['_id' => 1]],
        ['$out' => COLLECTION_NAME . '.out'],
    ],
    'cursor' => (object) [],
]);

(new CommandObserver)->observe(
    function() use ($manager, $command) {
        $manager->executeCommand(DATABASE_NAME, $command);
        $manager->executeCommand(DATABASE_NAME, $command, [
            'readConcern' => new MongoDB\Driver\ReadConcern(MongoDB\Driver\ReadConcern::AVAILABLE),
            'writeConcern' => new MongoDB\Driver\WriteConcern(1),
        ]);
    },
    function(stdClass $command) {
        echo json_encode($command->readConcern ?? null), "\n";
        echo json_encode($command->writeConcern ?? null), "\n";
    }
);

?>
===DONE===
<?php exit(0); ?>
--EXPECT--
null
null
{"level":"available"}
{"w":1}
===DONE===
