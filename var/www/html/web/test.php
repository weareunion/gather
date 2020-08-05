<?php
require_once "/lib/union/lib/REST/v1/build.php";
\Union\PKG\Autoloader::import__require("API.accounts");

echo \Union\API\accounts\Account::get_first_name(\Union\API\accounts\Account::lookup_email('kls8121999@gmail.com'));;
?>