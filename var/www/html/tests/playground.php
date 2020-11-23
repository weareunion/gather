<?php
ini_set("display_errors",1);
error_reporting(E_ERROR);
require_once "/lib/union/lib/REST/v1/build.php";

\Union\PKG\Autoloader::import__require("API.managers");
\Union\PKG\Autoloader::import__require("API.cards");
\Union\PKG\Autoloader::import__require("API.transactions");
\Union\PKG\Autoloader::import__require("API.sessions");

$s = new \Union\session\Session();
$s->set("API.cards.sessions.active", ["test"]);
var_dump($s->get("API.cards.sessions.active"));
var_dump($_SESSION);
echo "test";

