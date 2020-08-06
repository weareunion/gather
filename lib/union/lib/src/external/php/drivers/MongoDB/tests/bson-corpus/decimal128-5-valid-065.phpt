--TEST--
Decimal128: [decq661] fold-down full sequence (Clamped)
--DESCRIPTION--
Generated by scripts/convert-bson-corpus-tests.php

DO NOT EDIT THIS FILE
--FILE--
<?php

require_once __DIR__ . '/../utils/tools.php';

$canonicalBson = hex2bin('18000000136400E803000000000000000000000000FE5F00');
$canonicalExtJson = '{"d" : {"$numberDecimal" : "1.000E+6114"}}';
$degenerateExtJson = '{"d" : {"$numberDecimal" : "1E+6114"}}';

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
18000000136400e803000000000000000000000000fe5f00
{"d":{"$numberDecimal":"1.000E+6114"}}
18000000136400e803000000000000000000000000fe5f00
18000000136400e803000000000000000000000000fe5f00
===DONE===