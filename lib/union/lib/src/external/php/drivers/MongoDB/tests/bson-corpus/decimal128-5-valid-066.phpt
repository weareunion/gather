--TEST--
Decimal128: [decq663] fold-down full sequence (Clamped)
--DESCRIPTION--
Generated by scripts/convert-bson-corpus-tests.php

DO NOT EDIT THIS FILE
--FILE--
<?php

require_once __DIR__ . '/../utils/tools.php';

$canonicalBson = hex2bin('180000001364006400000000000000000000000000FE5F00');
$canonicalExtJson = '{"d" : {"$numberDecimal" : "1.00E+6113"}}';
$degenerateExtJson = '{"d" : {"$numberDecimal" : "1E+6113"}}';

// Canonical BSON -> Native -> Canonical BSON
echo bin2hex(fromPHP(toPHP($canonicalBson))), "\n";

// Canonical BSON -> Canonical extJSON
echo json_canonicalize(toCanonicalExtendedJSON($canonicalBson)), "\n";

// Canonical extJSON -> Canonical BSON
echo bin2hex(fromJSON($canonicalExtJson)), "\n";

// Degenerate extJSON -> Canonical BSON
echo bin2hex(fromJSON($degenerateExtJson)), "\n";

?>
===DONE===
<?php exit(0); ?>
--EXPECT--
180000001364006400000000000000000000000000fe5f00
{"d":{"$numberDecimal":"1.00E+6113"}}
180000001364006400000000000000000000000000fe5f00
180000001364006400000000000000000000000000fe5f00
===DONE===