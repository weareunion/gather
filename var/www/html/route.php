<?php
require_once "/lib/union/lib/REST/v1/build.php";
\Union\PKG\Autoloader::import__require("API.security");
echo \Union\API\security\Auth::logged_in();
\Union\API\security\Auth::bounce_back();
if (!isset($_GET['destination'])){
    ob_clean();
    header("Location: /");
    ob_flush();
}else{
    ob_clean();
    header("Location: ". urldecode(base64_decode(urldecode($_GET['destination']))));
    ob_flush();
}
?>
