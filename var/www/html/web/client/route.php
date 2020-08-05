<?php
require_once __DIR__ . "/../../API/autoload.php";
\Union\API\security\Auth::bounce_back();
if (!isset($_GET['destination'])){
    ob_clean();
    header("Location: home.php");
    ob_flush();
}else{
    ob_clean();
    header("Location: ". urldecode(base64_decode(urldecode($_GET['destination']))));
    ob_flush();
}
?>
