<?php
require_once "/lib/union/lib/REST/v1/build.php";
\Union\PKG\Autoloader::import__require("API.web, API.security, API.venues");
\Union\API\security\Auth::bounce_back();
\Union\API\venues\ActiveVenue::bounce_back();
\Union\API\web\UI\UIManager::import_header();

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Cards - Slately for Venues</title>
</head>
<body>
<? \Union\API\web\UI\UIManager::import_file("/elements/navbar/manage/standard.php");?>
<main>
    <div><h1>Content</h1></div>
</main>
</body>

<?php \Union\API\web\UI\UIManager::import_footer();?>