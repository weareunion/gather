<?php
/**
 * Created by PhpStorm.
 * User: karl
 * Date: 2019-05-13
 * Time: 21:40
 */

namespace Moycroft\API\internal\mysql;
//use function Moycroft\API\helper\IMPORT;
//
//require_once "../auth/auth.php";

require_once dirname(__FILE__) . "/../auth/auth.php";
require_once __DIR__ . "/../../../logging/classes/Log.php";

class Connect
{
    public $silent = false;
    public function __construct($silent=false)
    {
        $this->silent = $silent;
    }

    private $conn;
    /**
     * Attempts to create and return mysql connection
     * @param $database - name of database
     * @return connection
    */
    public function connect($database=null){
        global $verbose;
        if (($database == null)){
            $database = DB_NAME;
        }
//        echo $database
        $this->conn = mysqli_connect(DB_HOST,DB_USER,DB_PASS, $database);
        if ($this->conn->connect_error) {
//            Log::message("Connection failed: " . $this->conn->connect_error, "error");
            return false;
        }else{
//            $this->query("USE moycroft_global;");
            if (mysqli_connect_errno())
            {
//                Log::message( "Failed to connect to MySQL: " . mysqli_connect_error());
                return null;
            }
//            Log::message("Connection to database has been established", "success");

            return $this->conn;
        }
    }
    /**
     * Attempts to disconnect mysql connection
    */
    public function disconnect(){
        mysqli_close($this->conn);
//        __infoSH("Connection disconnected successfully.", "success");
    }
    /**
     * Attempts to run given query
    */
    public function query($query, $pullData=false){
        $this->autoConnect();
        global $verbose;
        $resp = mysqli_query($this->conn, $query);
        if ($resp) {
            if (!$this->silent) {
//                Log::message("Query ($query) executed successfully.", "success");
////                echo();
            }
            if ($pullData){
                return $this->getData($resp);
            }else {
                return $resp;
            }
        } else {
//            Log::message("Error: " . $query . "<br>" . mysqli_error($this->conn), "error");
            return false;
        }
    }
    public function multi_query($query, $pullData=false){
        $this->autoConnect();
        global $verbose;
        $resp = mysqli_multi_query($this->conn, $query);
        if ($resp) {
            if (!$this->silent) {
                echo("Error: " . $query . "<br>" . mysqli_error($this->conn));
//                Log::message("Query ($query) executed successfully.", "success");
//                echo();
            }
            if ($pullData){
                return $this->getData($resp);
            }else {
                return $resp;
            }
        } else {
            echo("Error: " . $query . "<br>" . mysqli_error($this->conn));
            return false;
        }
    }
    private function autoConnect(){
        if ($this->conn == null){
            $this->connect();
        }
    }
    public function cleanString($string){
        $this->autoConnect();
        return mysqli_escape_string($this->conn, $string);
    }
    /**
     * Attempts to return all data from response that is fed in the form of an array
    */
    public function getData($resp){
        $this->autoConnect();
        $queryResponse = [];
            while($row = mysqli_fetch_assoc($resp)) {
                array_push($queryResponse, $row);
            }
            return $queryResponse;
    }

    public function getConn(){
        $this->autoConnect();
        return $this->conn;
    }

    public function transaction($flag=MYSQLI_TRANS_START_READ_WRITE){
        mysqli_begin_transaction($this->conn, $flag);
    }

    public function commit(){
        mysqli_commit($this->conn);
    }

    static $logCount = 0;

}