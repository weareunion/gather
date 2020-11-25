<?php
ini_set("display_errors",1);
error_reporting(E_ERROR);
require_once "/lib/union/lib/REST/v1/build.php";

\Union\PKG\Autoloader::import__require("API.managers");
\Union\PKG\Autoloader::import__require("API.cards");
\Union\PKG\Autoloader::import__require("API.transactions");

//echo var_export(\Union\API\managers\mongo\connect::get_obj()->slately->cards->find([])->toArray());

$c = new \Union\API\Cards\GiftCard('20DCD62E-7AB7-405E-9A5C-588DF4A85254');

echo var_export(\Union\API\managers\mongo\connect::get_obj()->slately->cards->find([])->toArray());
echo "test";

