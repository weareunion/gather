<?php
require __DIR__ . "/Console.php";
require_once "/lib/union/lib/REST/config/APIConstantDefinition.php";

$console = new \Union\CLI\support\Console();

/**
 * Execute the given command by displaying console output live to the user.
 *  @param  string  cmd          :  command to be executed
 *  @return array   exit_status  :  exit status of the executed command
 *                  output       :  console output of the executed command
 */
function liveExecuteCommand($cmd, $dark=true)
{

    while (@ ob_end_flush()){}; // end all output buffers if any

    $proc = popen("$cmd 2>&1 ; echo VM Exit Status : $?", 'r');

    $live_output     = "";
    $complete_output = "";

    while (!feof($proc))
    {
        $live_output     = fread($proc, 4096);
        $complete_output = $complete_output . $live_output;
        if($dark) \Union\CLI\support\Console::log("-> $live_output \r", 'dim', false) ;
        else echo ($live_output);
        @ flush();
    }

    pclose($proc);

    // get exit status
    preg_match('/[0-9]+$/', $complete_output, $matches);

    // return exit status and intended output
    return array (
        'exit_status'  => intval($matches[0]),
        'output'       => str_replace("Exit status : " . $matches[0], '', $complete_output)
    );
}

function set_environment( $server, $environment){
    $cmd = "mkdir -p ". UNION_SERVER_THIS . ";" . "cd " . UNION_SERVER_THIS . " && touch environment; echo \"$environment\" > " . UNION_SERVER_THIS . "/environment;";
    ssh($server, $cmd, true);
    \Union\CLI\support\Console::log("\n\n[!] Request sent to change environment to $environment has been sent to ".$server['instance_name'].".", "light_cyan");
}

function read_stdin(){
    $handle = fopen ("php://stdin","r");
    $line = fgets($handle);
    return trim($line);
}

function ssh($server, $command=null, $silent=false){
    $addendum = "";
    if (!$silent) {
        if ($command === null) {
            \Union\CLI\support\Console::log("Connecting you to " . $server['display_name'] . " (" . $server['instance_name'] . ")...", "light_cyan");
            \Union\CLI\support\Console::log("[!] Use the 'exit' command to close this tunnel when you are done.", "light_cyan");
        }else{
            \Union\CLI\support\Console::log("Running $command on " . $server['display_name'] . " (" . $server['instance_name'] . ")...", "light_cyan");
        }
    }
    if ($command !== null) $addendum = '--command="'.$command.'"';
    liveExecuteCommand('gcloud compute ssh  '.$server['instance_name'].' '. $addendum . ' --zone="'.$server['zone'].'"', false);
    if (!$silent) {
        if ($command === null) {
            \Union\CLI\support\Console::log("SSH tunnel closed successfully.", "light_green");
        } else {
            \Union\CLI\support\Console::log("Done...", "light_green");
        }
    }
}

function askYN(){
    while(1){
        $line = strtoupper(read_stdin());
        if (($line === "Y" || $line === "N")){
            return ($line === "Y");
        }
        \Union\CLI\support\Console::log("Invalid response. Please answer Y or N", "light_red");
    }
}

function get_directory($string){
    switch ($string){
        case "base":
            return "/lib/union";
            break;
        case "API":
        case "api":
            return "".UNION_API_DIRECTORY;
            break;
        case "drivers":
            return UNION_DRIVER_DIRECTORY_ROOT;
            break;
        case "pages":
            \Union\CLI\support\Console::log("Updating the pages without updating the rest of the stack will cause major errors. Continue? (Y\N)", "yellow");
            if(!askYN()) exit();
            return "/var/www/html";
            break;
        default:
            if ($string[0] === "/"){
                if (!(is_dir($string) && is_file($string))){
                    \Union\CLI\support\Console::log("'$string' is not a valid directory or file.", "light_red");
                    exit();
                }
                return $string;
            }
    }

}

function rollout_servers($servers_to_rollout, $dir){
    if (!$dir){
        \Union\CLI\support\Console::log("There was an error", "light_red");
        throw new \Exception();
    }
    \Union\CLI\support\Console::log("Preparing to copy $dir (".trim(shell_exec('du -h -s ' . $dir . " | awk '{print $1}'")).") to ".count($servers_to_rollout)." server(s). Continue? (Y/N)", "yellow");
    if(!askYN()) exit();

    foreach($servers_to_rollout as $server){
        \Union\CLI\support\Console::log("Starting transfer to " . $server['display_name'] . "(" . $server['ip']['private'] . ")...", "light_cyan");
        liveExecuteCommand('gcloud compute scp --recurse --compress '.$dir.' '.$server['instance_name'].':'.dirname($dir).' --zone="'.$server['zone'].'"');
        \Union\CLI\support\Console::log("... Transfer completed.", "light_green");
        \Union\CLI\support\Console::log("SSHing to set permissions...", "light_cyan");
        liveExecuteCommand('gcloud compute ssh  '.$server['instance_name'].' --command="sudo chmod 777 '.dirname($dir).' -R" --zone="'.$server['zone'].'"');
        \Union\CLI\support\Console::log("...set permissions successfully!", "light_green");
    }
}

function list_servers($fleet_server_list){
    $i = 0;
    \Union\CLI\support\Console::log("\n\n---------- NODES(SERVERS) IN UNION FLEET -----------", "light_cyan");
    foreach ($fleet_server_list['servers'] as $server) {
        \Union\CLI\support\Console::log("\n----", "dim", false);
        \Union\CLI\support\Console::log(" " . $server['display_name'], "normal", false);
        \Union\CLI\support\Console::log(" (INDEX: $i)", "purple", false);
        \Union\CLI\support\Console::log(" ----\n", "dim", false);
        \Union\CLI\support\Console::log("Type of server: ", "light_cyan", false);
        \Union\CLI\support\Console::log($server['type'], "normal", true);
        \Union\CLI\support\Console::log("GCS Instance Name: ", "light_cyan", false);
        \Union\CLI\support\Console::log($server['instance_name'], "normal", true);
        \Union\CLI\support\Console::log("Description: ", "light_cyan", false);
        \Union\CLI\support\Console::log($server['description'], "normal", true);
        \Union\CLI\support\Console::log("Union Servername: ", "light_cyan", false);
        \Union\CLI\support\Console::log($server['name'], "normal", true);
        \Union\CLI\support\Console::log("Zone ", "light_cyan", false);
        \Union\CLI\support\Console::log($server['zone'], "normal", true);
        \Union\CLI\support\Console::log("Network IP Address: ", "light_cyan", false);
        \Union\CLI\support\Console::log($server['ip']['private'], "normal", true);
        \Union\CLI\support\Console::log("Public IP Address: ", "light_cyan", false);
        \Union\CLI\support\Console::log($server['ip']['public'], "normal", true);

        \Union\CLI\support\Console::log("\n");
        $i++;
    }
}

switch ($argv[1]) {
    case "fleet":
        if (( $argv[2] ) == "") {
            \Union\CLI\support\Console::bell();
            \Union\CLI\support\Console::log("ERROR: Incorrect usage. For help: 'union fleet help';", "light_red");
            exit();
        }
        $fleet_server_list = json_decode(file_get_contents(__DIR__ . "/../data/fleet_servers.json"), JSON_OBJECT_AS_ARRAY);
        switch ($argv[2]) {
            case "help":
                \Union\CLI\support\Console::log("\n------- Union Fleet Manager Interface (GCS) -------", "white");
                \Union\CLI\support\Console::log("PHP Supported command line interface to manage a Union Group network\n", "normal", true);

                \Union\CLI\support\Console::log("[0] ", "dim", false);
                \Union\CLI\support\Console::log("union fleet ", "light_gray", false);
                \Union\CLI\support\Console::log("list", "light_cyan", false);
                \Union\CLI\support\Console::log(" - List all severs known to the Union fleet management software.", "normal", true);

                \Union\CLI\support\Console::log("[1] ", "dim", false);
                \Union\CLI\support\Console::log("union fleet ", "light_gray", false);
                \Union\CLI\support\Console::log("status", "light_cyan", false);
                \Union\CLI\support\Console::log(" - List all severs known to the hosting GCS.", "normal", true);

                \Union\CLI\support\Console::log("[2] ", "dim", false);
                \Union\CLI\support\Console::log("union fleet ", "light_gray", false);
                \Union\CLI\support\Console::log("rollout", "light_cyan", false);
                \Union\CLI\support\Console::log(" <webserver|database|API|development_cluster|(server_name)> ", "green", false);
                \Union\CLI\support\Console::log(" [all|drivers|API|(API_locator_string)|pages|(directory)] ", "green", false);
                \Union\CLI\support\Console::log(" - Push rollout from this servers codebase to any listed server.", "normal", true);

                \Union\CLI\support\Console::log("[3] ", "dim", false);
                \Union\CLI\support\Console::log("union fleet ", "light_gray", false);
                \Union\CLI\support\Console::log("ssh", "light_cyan", false);
                \Union\CLI\support\Console::log(" [server_name]", "green", false);
                \Union\CLI\support\Console::log(" - Open an ssh tunnel into given server. If non is given, a list will be presented.", "normal", true);

                \Union\CLI\support\Console::log("[4] ", "dim", false);
                \Union\CLI\support\Console::log("union fleet ", "light_gray", false);
                \Union\CLI\support\Console::log("modify", "light_cyan", false);
                \Union\CLI\support\Console::log(" [parameter] [server_name]", "green", false);
                \Union\CLI\support\Console::log(" - Open an ssh tunnel into given server and rollout server settings. If non is given, a list will be presented.", "normal", true);

                \Union\CLI\support\Console::log("\n©2020 Union Group, LLC. All rights reserved. Unauthorized use of this interface or its network is prohibited and will be logged.\n", "light_purple");
                break;
            case "list":
                list_servers($fleet_server_list);
                break;
            case "status":
                \Union\CLI\support\Console::log("Getting instance list from Google Cloud Services... This may take a few seconds...", "light_cyan");
                \Union\CLI\support\Console::log("", "light_cyan");
                \Union\CLI\support\Console::log(shell_exec("gcloud compute instances list"));
                \Union\CLI\support\Console::log("[!] Be aware that these instances are not necessarily available or known to this Union network. To see available nodes, use union fleet list. To add a node, use union fleet add.", "yellow");
                break;
            case "health":
                break;
            case "rollout":
                $servers_to_rollout = [];
                if (( $argv[3] == "" )) {
                    \Union\CLI\support\Console::log("ERROR: Incorrect usage. union fleet rollout <webserver|database|API|development_cluster|(server_name)> <all|drivers|API|(API_locator_string)|pages|(directory)> For help: 'union fleet help';", "light_red");
                    exit();
                }
                switch ($argv[3]) {
                    case "":
                        \Union\CLI\support\Console::log("ERROR: Incorrect usage. Target needed \n USAGE: union fleet rollout <webserver|database|API|development_cluster|(server_name)|(server_ip)> <all|drivers|API|(API_locator_string)|pages|(directory)> For help: 'union fleet help';", "light_red");
                        exit();
                        break;


                    case "database":
                    case "API":
                    case "development_cluster":
                        \Union\CLI\support\Console::log("UNAVAILABLE: Unfortunately, this type of server rollout distribution is not yet implemented.", "yellow");
                        exit();
                        break;

                    case "webserver":
                        foreach ($fleet_server_list['servers'] as $server) {
                            if ($server['type'] === 'webserver') {
                                $servers_to_rollout[] = $server;
                            }
                        }
                        break;
                    default:
                        $found = false;
                        foreach ($fleet_server_list['servers'] as $server) {
                            if ($server['ip']["private"] === $argv[3] ||
                                $server['ip']["public"] === $argv[3] ||
                                $server['name'] === $argv[3] ||
                                $server['instance_name'] === $argv[3]) {
                                $servers_to_rollout[] = $server;
                                $found = true;
                            }
                        }
                        if (!$found) {
                            \Union\CLI\support\Console::log("ERROR: A server known to this Union instance with these attributes does not exist.", "light_red");
                        }
                        break;
                }
                if ($argv[4] == "") {
                    \Union\CLI\support\Console::log("Running this command without any additional arguments will cause this server to deploy its entire stack. Continue? (Y/N)", "yellow");
                    if (!askYN()) exit();
                    $steps = [ "base", "pages" ];
                    foreach ($steps as $step) {
                        $dir = get_directory($step);
                        rollout_servers($servers_to_rollout, $dir);
                    }
                } else {
                    $dir = get_directory($argv[4]);
                    rollout_servers($servers_to_rollout, $dir);
                }

                break;
                break;
            case "ssh":
                if ($argv[3] === "") {
                    list_servers($fleet_server_list);
                    \Union\CLI\support\Console::log("No instance was defined. Type an index of an instance above to connect to it.", "light_cyan");
                    while (1) {
                        $selection = read_stdin();
                        if (!is_numeric($selection) || (int)$selection < 0 || (int)$selection > count($fleet_server_list['servers'] ) - 1) {
                            \Union\CLI\support\Console::log("Invalid index. Must be a number between 0 and " . ( count($fleet_server_list['servers'] ) - 1 ), "light_red");
                        } else {
                            $server = $fleet_server_list['servers'][ (int)$selection ];
                            \Union\CLI\support\Console::log("" . $server['display_name'] . " (" . $server['instance_name'] . ") selected! \n", "light_green");
                            ssh($server);
                            break;
                        }
                    }
                } else {
                    foreach ($fleet_server_list['servers'] as $server) {
                        if ($server['ip']["private"] === $argv[3] ||
                            $server['ip']["public"] === $argv[3] ||
                            $server['name'] === $argv[3] ||
                            $server['instance_name'] === $argv[3]) {
                            ssh($server);
                            exit();
                        }
                    }
                    \Union\CLI\support\Console::log("ERROR: Server '$argv[3]' is not known to this Union instance. Use union fleet list to see available servers", "light_red");
                }
                break;
            case "modify":
                switch ($argv[3]) {
                    case "environment":
                        if ($argv[4] === "") {
                            \Union\CLI\support\Console::log("Must specify an environment (production, development, staging)", 'light_red');
                            exit();
                        }
                        if ($argv[5] === "") {
                            list_servers($fleet_server_list);
                            \Union\CLI\support\Console::log("No instance was defined. Type an index of an instance above to connect to it.", "light_cyan");
                            while (1) {
                                $selection = read_stdin();
                                if (!is_numeric($selection) || (int)$selection < 0 || (int)$selection > count($fleet_server_list) - 1) {
                                    \Union\CLI\support\Console::log("Invalid index. Must be a number between 0 and " . ( count($fleet_server_list) - 1 ), "light_red");
                                } else {
                                    $server = $fleet_server_list['servers'][ (int)$selection ];
                                    \Union\CLI\support\Console::log("" . $server['display_name'] . " (" . $server['instance_name'] . ") selected! \n", "light_green");
                                    set_environment($server, $argv[4]);
                                    break;
                                }
                            }
                        } else {
                            foreach ($fleet_server_list['servers'] as $server) {
                                if ($server['ip']["private"] === $argv[5] ||
                                    $server['ip']["public"] === $argv[5] ||
                                    $server['name'] === $argv[5] ||
                                    $server['instance_name'] === $argv[5]) {
                                    set_environment($server, $argv[4]);
                                    exit();
                                }
                            }
                            \Union\CLI\support\Console::log("ERROR: Server '$argv[5]' is not known to this Union instance. Use union fleet list to see available servers", "light_red");
                        }
                        break;
                    case "help":
                        \Union\CLI\support\Console::log("\n------- Union Fleet Manager Interface (GCS) -------", "white");
                        \Union\CLI\support\Console::log("PHP Supported command line interface to manage a Union Group network\n", "normal", true);

                        \Union\CLI\support\Console::log("[0] ", "dim", false);
                        \Union\CLI\support\Console::log("union fleet modify", "light_gray", false);
                        \Union\CLI\support\Console::log(" environment", "light_cyan", false);
                        \Union\CLI\support\Console::log("  [development|production|staging|(etc...)]", "green", false);
                        \Union\CLI\support\Console::log(" <server>", "green", false);
                        \Union\CLI\support\Console::log(" - Modify the environment of the given server (development, production, etc.). If none is given, a list will be provided.", "normal", true);

                        \Union\CLI\support\Console::log("\n©2020 Union Group, LLC. All rights reserved. Unauthorized use of this interface or its network is prohibited and will be logged.\n", "light_purple");
                        break;
                    default:
                        \Union\CLI\support\Console::bell();
                        \Union\CLI\support\Console::log("ERROR: Incorrect usage. For help: 'union fleet modify help';", "light_red");
                        exit();
                }

        }
        break;


        break;
    case "help":
            \Union\CLI\support\Console::log("\n------- Union Interface (GCS) -------", "white");
            \Union\CLI\support\Console::log("PHP Supported command line interface with Union software.\n", "normal", true);

            \Union\CLI\support\Console::log("[0] ", "dim", false);
            \Union\CLI\support\Console::log("union ", "light_gray", false);
            \Union\CLI\support\Console::log("fleet", "light_cyan", false);
            \Union\CLI\support\Console::log(" - Fleet management methods such as updating, ssh and status", "normal", true);


            \Union\CLI\support\Console::log("\n©2020 Union Group, LLC. All rights reserved. Unauthorized use of this interface or its network is prohibited and will be logged.\n", "light_purple");
            break;
    default:
            \Union\CLI\support\Console::bell();
            \Union\CLI\support\Console::log("ERROR: Incorrect usage. For help: 'union help';", "light_red");
            exit();
            break;
}