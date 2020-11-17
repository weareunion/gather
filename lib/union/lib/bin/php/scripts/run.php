<?php
require __DIR__ . "/Console.php";
$console = new \Union\CLI\support\Console();
if ($argv[1 ] == "") {
    \Union\CLI\support\Console::bell();
    \Union\CLI\support\Console::log("ERROR: Incorrect usage. For help: 'union help';", "light_red");
    exit();
}

switch ($argv[1]){
    case "fleet":
        if (($argv[2]) == ""){
            \Union\CLI\support\Console::bell();
            \Union\CLI\support\Console::log("ERROR: Incorrect usage. For help: 'union fleet help';", "light_red");
        }
        $fleet_server_list = json_decode(file_get_contents(__DIR__ . "/../data/fleet_servers.json"), JSON_OBJECT_AS_ARRAY);
        switch ($argv[2]){
            case "list":
                \Union\CLI\support\Console::log("\n\n--------------FLEET SERVERS--------------", "light_cyan");
                foreach ($fleet_server_list['servers'] as $server){
                    \Union\CLI\support\Console::log( "TYPE: " . $server['type'] .
                        "\nGCS INSTANCE NAME: " . $server['instance_name'] .
                        "\nNAME: " . $server['display_name'] .
                        "\nDESCRIPTION: " . $server['description'] .
                        "\nSERVERNAME: " . $server['name'] .
                        "\nZONE: " . $server['zone'] .
                        "\n- - - - - - - - - - - - - - - - - - -");
                }
                \Union\CLI\support\Console::log("\n");
                break;
            case "status":
                \Union\CLI\support\Console::log(shell_exec("gcloud compute instances list"));
            break;
            case "health":
                break;
            case "update":
                
                break;
        }
        break;
}