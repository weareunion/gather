<?php
require_once __DIR__ . "/../../../API/autoload.php";
session_start();
$_SESSION['FLAG_DEVELOPER_VERBOSE'] = false;
\Union\API\Respondus\Respondus::listen();
//var_dump();
require_once __DIR__ . "/../../../src/php/elements/container/container_start.php";
?>

<?php


try {
    Account::create("Karl", "Schmidt", "(864) 329-4637", "karl@washmel.com", "EXECUTE");
} catch (AccountAlreadyExists $e) {
    \Union\Grooped\gameserver\logging\Log::message("Error Thrown: Account already exists. $e");
} catch (DatabaseInsertionError $e) {
    \Union\Grooped\gameserver\logging\Log::message("There was a problem inserting into the database. $e");
} catch (InvalidParams $e) {
    \Union\Grooped\gameserver\logging\Log::message("Param issues. $e");
}
///**
// * This code will benchmark your server to determine how high of a cost you can
// * afford. You want to set the highest cost that you can without slowing down
// * you server too much. 8-10 is a good baseline, and more is good if your servers
// * are fast enough. The code below aims for ≤ 50 milliseconds stretching time,
// * which is a good baseline for systems handling interactive logins.
// */
//$timeTarget = 0.05; // 50 milliseconds
//
//$cost = 8;
//do {
//    $cost++;
//    $start = microtime(true);
//    password_hash("test", PASSWORD_BCRYPT, ["cost" => $cost]);
//    $end = microtime(true);
//} while (($end - $start) < $timeTarget);
//
//echo "Appropriate Cost Found: " . $cost;
//?>

<script>
    // (new HTTPClient())
    //     .set_service("API.ff")
    //     .set_action("create")
    //     .send().then(
    //         (data) => {
    //             console.log(
    //                 JSON.parse(data)
    //             )
    //         })
</script>
