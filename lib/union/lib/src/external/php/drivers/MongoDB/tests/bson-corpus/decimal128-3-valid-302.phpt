--TEST--
Decimal128: [basx059] strings without E cannot generate E in result
--DESCRIPTION--
Generated by scripts/convert-bson-corpus-tests.php

DO NOT EDIT THIS FILE
--FILE--
<?php

require_once __DIR__ . '/../utils/tools.php';

$canonicalBson = hex2bin('18000000136400F198670C08000000000000000000363000');
$canonicalExtJson = '{"d" : {"$numberDecimal" : "345678.54321"}}';
$degenerateExtJson = '{"d" : {"$numberDecimal" : "0345678.54321"}}';

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
18000000136400f198670c08000000000000000000363000
{"d":{"$numberDecimal":"345678.54321"}}
18000000136400f198670c08000000000000000000363000
18000000136400f198670c08000000000000000000363000
===DONE===