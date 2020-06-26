<?php
require_once __DIR__ . "/../../../API/autoload.php";
session_start();
$_SESSION['FLAG_DEVELOPER_VERBOSE'] = true;
\Union\API\Respondus\Respondus::listen();
//var_dump();
require_once __DIR__ . "/../../../src/php/elements/container/container_start.php";
?>

<script>
    (new HTTPClient())
        .set_service("API.ff")
        .set_action("create")
        .send().then(
            (data) => {
                console.log(
                    JSON.parse(data)
                )
            })
</script>
