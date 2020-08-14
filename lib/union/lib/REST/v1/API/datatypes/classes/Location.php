<?php


namespace Union\API\datatypes;


use Union\PKG\Autoloader;

class Location
{
    public $address;
    public $coordinates;

    public function __construct()
    {
        $this->coordinates = new MapLocation();
        $this->address = new Address();
    }

    /**
     * @return Address
     */
    public function getAddress(): Address
    {
        return $this->address;
    }

    /**
     * @param Address $address
     */
    public function setAddress(Address $address)
    {
        $this->address = $address;
    }
}