<?php
require_once "/lib/union/lib/REST/v1/build.php";
\Union\PKG\Autoloader::import__require("API.accounts, API.sessions, API.venues , API.venues.management");
//\Union\API\accounts\Registration::send_conformation_email("kls8121999@gmail.com", "TEST");
var_dump(\Union\API\venues\ActiveVenue::get());
?>