<?php
ini_set("display_errors",1);
error_reporting(E_ERROR);
require_once "/lib/union/lib/REST/v1/build.php";

\Union\PKG\Autoloader::import__require("API.cards");
$card = new \Union\API\Cards\Card();
$card->create();


//\Union\PKG\Autoloader::import__require("API.transactions");
//$account = new \Union\API\transactions\Account();
////$account->lock("Test");
//$account->unlock();
////$account->modify_balance(100);
////\Union\API\transactions\TransactionManager::transfer((new \Union\API\transactions\Account("4C76BC69-530F-4AF9-A7C5-D984299E8C72")), $account, .2);
echo "test";