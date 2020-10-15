<?php
require_once "/lib/union/lib/REST/v1/build.php";
\Union\PKG\Autoloader::import__require("API.web, API.security, API.venues");
\Union\API\security\Auth::bounce_back();
\Union\API\venues\ActiveVenue::bounce_back();
\Union\API\web\UI\UIManager::import_header();
?>
<title>Slately for Venues | Dashboard</title>
<h1>Test</h1>
