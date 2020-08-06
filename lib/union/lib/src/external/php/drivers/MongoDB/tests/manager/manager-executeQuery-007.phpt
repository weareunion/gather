--TEST--
MongoDB\Driver\Manager::executeQuery() read concern inheritance
--SKIPIF--
<?php require __DIR__ . "/../utils/basic-skipif.inc"; ?>
<?php skip_if_not_replica_set(); ?>
<?php skip_if_server_version('<', '3.6'); /* readConcernLevel:available */ ?>
<?php skip_if_not_clean(); ?>
--FILE--
<?php
require_once __DIR__ . "/../utils/basic.inc";
require_once __DIR__ . "/../utils/observer.php";

$manager = new MongoDB\Driver\Manager(URI, ['readConcernLevel' => 'local']);

(new CommandObserver)->observe(
    function() use ($manager) {
        $manager->executeQuery(NS, new MongoDB\Driver\Query([]));
        $manager->executeQuery(NS, new MongoDB\Driver\Query([], [
            'readConcern' => new MongoDB\Driver\ReadConcern(MongoDB\Driver\ReadConcern::AVAILABLE),
        ]));
    },
    function(stdClass $command) {
        echo json_encode($command->readConcern), "\n";
    }
);

?>
===DONE===
<?php exit(0); ?>
--EXPECT--
{"level":"local"}
{"level":"available"}
===DONE===
