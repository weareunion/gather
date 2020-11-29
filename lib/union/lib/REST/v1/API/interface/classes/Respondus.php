<?php

namespace Union\API\Respondus;

use Exception;
use Union\Exceptions\APIException;
use Union\Exceptions\FormattedException;
use function Union\processor\run;

define("RESPONDUS_RESPONSE_TYPE_SUCCESS", 1);
define("RESPONDUS_RESPONSE_TYPE_ERROR", 0);
define("RESPONDUS_RESPONSE_TYPE_UNKNOWNERROR", -1);

//OVERLOAD RESPONDUS EXCEPTION FOR IMPORTS
class RespondusException extends FormattedException
{
}
class InvalidDelta extends \Union\API\Respondus\RespondusException{};


class Respondus
{
    /**
     * Starts listening for POST instructions. Call this on any page.
     */
    static function listen()
    {
        if ((sizeof($_POST) == 0)) {
            return;
        }
        if (isset($_POST['service']) && isset($_POST['action'])) {
            try {
                (new Respondus())->capture()->getResponse()->branch(
                    function ($data) {
                        Respondus::announce(RESPONDUS_RESPONSE_TYPE_SUCCESS, $data);
                        exit();
                    },
                    function ($data) {
                        Respondus::announce(RESPONDUS_RESPONSE_TYPE_ERROR, $data);
                        exit();
                    }
                );
            } catch (APIException $exception) {
                Respondus::announce(RESPONDUS_RESPONSE_TYPE_ERROR, $exception->data);
                exit();
            } catch (RespondusException $exception) {
                Respondus::announce(RESPONDUS_RESPONSE_TYPE_ERROR, $exception->data);
                exit();
            } catch (\Exception $exception) {
                Respondus::announce(RESPONDUS_RESPONSE_TYPE_UNKNOWNERROR, $exception);
                exit();
            }

        }

    }

    function capture()
    {
        return (
        (isset($_POST['data'])
            ? (new Process($_POST['service'], $_POST['action'], $_POST['data']))->execute()
            : (new Process($_POST['service'], $_POST['action']))->execute()
        )
        );
    }

    /**
     * @param $type int Expects a RESPONDUS_RESPONSE_TYPE_[x] constant
     * @param $data array Data formatted for response. Errors follow certain structure, but success posts do not.
     */
    private static function announce($type, $data)
    {
        try {
            switch ($type) {
                case RESPONDUS_RESPONSE_TYPE_SUCCESS:
                    ob_clean();
                    echo json_encode($data, JSON_FORCE_OBJECT);
                    exit();
                    break;
                case RESPONDUS_RESPONSE_TYPE_ERROR:
                    //STANDARD RESPONSE FOR PRIVATE ERRORS
                    if ($data['no_external_face'] == true || $data['external']['title'] == null) {
                        $data['external'] = [
                            "title" => "Error Withheld",
                            "description" => "Error body witheld."
                        ];
                        $data['code'] = 501;
                    }
                    ob_clean();

                    if (isset($_SESSION['FLAG_DEVELOPER_VERBOSE']) && $_SESSION['FLAG_DEVELOPER_VERBOSE']) {
                        if (!isset($data['code']) || $data['code'] == 0 || $data['code'] == 500) {
                            $data['code'] = "599";
                        }
                        header('HTTP/1.1 ' . $data['code'] . ' ' . $data['external']['title'] . ' - ' . $data['external']['description'] . ' @ Log Lookup ID: ' . $data['log_lookup'] . ' >>DEBUG>> ' . $data['internal']['title'] . ' - ' . $data['internal']['description']);
                        header('Content-Type: application/json; charset=UTF-8');
                        die(
                        json_encode(
                            array(
                                'response' =>
                                    [
                                        "title" => $data['external']['title'],
                                        "description" => $data['external']['description'],
                                        "lookup" => $data['log_lookup'],
                                        "debug" => [
                                            "title" => $data['internal']['title'],
                                            "description" => $data['internal']['description'],
                                        ]
                                    ],
                                'code' =>
                                    $data['code']
                            )
                            , JSON_FORCE_OBJECT)
                        );
                    } else {
                        header('HTTP/1.1 ' . "500" . ' ' . $data['external']['title'] . ' - ' . $data['external']['description'] . ' @ Log Lookup ID: ' . $data['log_lookup']);
                        header('Content-Type: application/json; charset=UTF-8');
                        die(
                        json_encode(
                            array(
                                'response' =>
                                    [
                                        "title" => $data['external']['title'],
                                        "description" => $data['external']['description'],
                                        "lookup" => $data['log_lookup']
                                    ],
                                'code' =>
                                    $data['code']
                            )
                        )
                        );
                    }

                    break;
                case RESPONDUS_RESPONSE_TYPE_UNKNOWNERROR:
                    die(500);
                    break;
            }
        } catch (\Exception $exception) {
            if (isset($_SESSION['FLAG_DEVELOPER_VERBOSE']) && $_SESSION['FLAG_DEVELOPER_VERBOSE']) {
                die($exception);
            } else {

                die(500);
            }
        }
    }

}

class Process extends Respondus
{
    public $service;
    public $action;
    public $data;
    public $execution_type = 'special';

    public function __construct($service, $action, $data = [])
    {
        $this->service = $service;
        $this->action = $action;
        $this->data = $data;
    }

    public function execute()
    {
        // Begin interpreting service string
        $interpret = explode(".", strtolower($this->service));

        if ($interpret[0] == 'api') {
            $this->execution_type = $interpret[0];
        };

//

        $execution_target_directory = UNION_API_DIRECTORY . "/";

        if ($this->execution_type == "special") {
            $execution_target_directory = __DIR__ . "/../processors/";
        }

        if ($this->execution_type == 'api') {
            array_shift($interpret);
        }

        $execution_target_directory .= implode("/", $interpret) . (($this->execution_type == 'api') ? "/processors/" : "");
        $execution_target_directory = realpath($execution_target_directory);


        if (!is_dir($execution_target_directory)) {
            throw new RespondusException("Service not found.", "The directory '$execution_target_directory' for service id '$this->service' does not exist and therefore cannot contain the action requested.");
        }


        $execution_target_file = $execution_target_directory . "/" . $this->action . ".php";

        if (!file_exists($execution_target_file)) {
            throw new RespondusException("Action not found.", "The file '$execution_target_file' for service id '$this->service' and action '$this->action' does not exist and therefore cannot contain the action requested.");
        }


        require_once $execution_target_file;

        //Run the process
        $placeholder = run($this->data);

        // Create response object
        $response = new Response();

        $response->data = $placeholder;

        if (!$placeholder) {
            $response->successful = false;
        }
        return $response;
    }
}

class Response extends Respondus
{
    public $successful = true;
    public $data = [];

    function getResponse()
    {
        return $this;
    }

    function branch($on_success, $on_error)
    {
        if ($this->successful) {
            $on_success($this->data);
        } else {
            $on_error($this->data);
        }
    }

}
