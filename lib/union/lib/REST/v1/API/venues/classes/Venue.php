<?php


namespace Union\API\venues;


use Moycroft\API\internal\mysql\Connect;
use Union\API\datatypes\Location;
use Union\API\datatypes\VenueName;
use Union\PKG\Autoloader;

class Venue
{
    public $location;
    public $name;
    public $id;

    public function __construct($venue_id)
    {
        Autoloader::import__require("API.managers.mysql, API.datatypes");
        $this->location = new Location();
        $this->name = new VenueName();
        $this->load($venue_id);
    }
    public function load($venue_id){

        // Get data from database
        $connection = new Connect();
        $connection->connect();
        $data = $connection->query("SELECT * FROM slately_venues.`venues-lookup` WHERE GUID = '$venue_id'", true);
        $connection->disconnect();;

        // return false if it doesnt exist
        if (sizeof($data) == 0) return false;
        $this->location->coordinates->city->setLatitude($data[0]['location_city_latitude']);
        $this->location->coordinates->city->setLongitude($data[0]['location_city_longitude']);
        $this->location->coordinates->address->setLatitude($data[0]['location_map_latitude']);
        $this->location->coordinates->address->setLongitude($data[0]['location_map_longitude']);
        $this->location->address->setAddress($data[0]['location_address']);
        $this->location->address->setCity($data[0]['location_city']);
        $this->location->address->setState($data[0]['location_state']);
        $this->location->address->setZIP($data[0]['location_zip']);
        $this->name->setDisplayName($data[0]['display_name']);
        $this->name->setDescription($data[0]['venue_description']);
        $this->id = $venue_id;
    }
}