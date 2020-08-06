--TEST--
MongoDB\Driver\BulkWrite::update() hint option requires MongoDB 4.2 (server-side error)
--SKIPIF--
<?php require __DIR__ . "/../utils/basic-skipif.inc"; ?>
<?php skip_if_not_live(); ?>
<?php skip_if_server_version('>=', '4.2'); ?>
<?php skip_if_server_version('<=', '3.6.0'); ?>
--FILE--
<?php
require_once __DIR__ . "/../utils/basic.inc";

$manager = new MongoDB\Driver\Manager(URI);

$bulk = new MongoDB\Driver\BulkWrite;
$bulk->update(['_id' => 1], ['$set' => ['x' => 11]], ['hint' => '_id_']);

echo throws(function() use ($manager, $bulk) {
    $manager->executeBulkWrite(NS, $bulk);
}, 'MongoDB\Driver\Exception\BulkWriteException'), "\n";

?>
===DONE===
<?php exit(0); ?>
--EXPECT--
OK: Got MongoDB\Driver\Exception\BulkWriteException
BSON field 'update.updates.hint' is an unknown field.
===DONE===
