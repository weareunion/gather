<?php


namespace Union\API\storage;


class GCStorageClient
{
    static private $keyfile = '/lib/union/lib/keys/GCS/slately-bucket-interface-service-account.json';
    static function import_GCInterface(){
        \Union\PKG\Autoloader::import__require("drivers.external.GoogleAPIClient7->composer");
    }
    static function register_stream($project_id = "spring-ember-278604"){
        self::import_GCInterface();
            $client = new \Google\Cloud\Storage\StorageClient(['projectId' => $project_id, 'keyFile' => json_decode(file_get_contents(self::$keyfile), true)]);
            $client->registerStreamWrapper();
    }
    static function get_client($project_id = "spring-ember-278604"){
        self::import_GCInterface();
        return new \Google\Cloud\Storage\StorageClient(['projectId' => $project_id, 'keyFile' => json_decode(file_get_contents(self::$keyfile), true)]);
    }
}