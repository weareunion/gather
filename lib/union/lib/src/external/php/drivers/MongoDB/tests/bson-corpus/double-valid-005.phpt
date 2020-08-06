--TEST--
Double type: 1.2345678921232E+18
--DESCRIPTION--
Generated by scripts/convert-bson-corpus-tests.php

DO NOT EDIT THIS FILE
--FILE--
<?php

require_once __DIR__ . '/../utils/tools.php';

$canonicalBson = hex2bin('100000000164002a1bf5f41022b14300');
$canonicalExtJson = '{"d" : {"$numberDouble": "1.2345678921232E+18"}}';
$relaxedExtJson = '{"d" : 1.2345678921232E+18}';

// Canonical BSON -> Native -> Canonical BSON
echo bin2hex(fromPHP(toPHP($canonicalBson))), "\n";

// Canonical BSON -> Canonical extJSON
echo json_canonicalize(toCanonicalExtendedJSON($canonicalBson)), "\n";

// Canonical BSON -> Relaxed extJSON
echo json_canonicalize(toRelaxedExtendedJSON($canonicalBson)), "\n";

// Canonical extJSON -> Canonical BSON
echo bin2hex(fromJSON($canonicalExtJson)), "\n";

// Relaxed extJSON -> BSON -> Relaxed extJSON
echo json_canonicalize(toRelaxedExtendedJSON(fromJSON($relaxedExtJson))), "\n";

?>
===DONE===
<?php exit(0); ?>
--EXPECT--
100000000164002a1bf5f41022b14300
{"d":{"$numberDouble":"1.2345678921232e+18"}}
{"d":1.2345678921232e+18}
100000000164002a1bf5f41022b14300
{"d":1.2345678921232e+18}
===DONE===