<?php


namespace Union\API\datatypes;


class MapLocation
{
    /**
     * @var Coordinate
     */
    public $address;
    public $city;
    public $state;
    public $ZIP;

    public function __construct()
    {
        $this->address = new Coordinate();
        $this->city = new Coordinate();
        $this->state = new Coordinate();
        $this->ZIP = new Coordinate();
    }

    /**
     * @return Coordinate
     */
    public function getAddress(): Coordinate
    {
        return $this->address;
    }

    /**
     * @param Coordinate $address
     */
    public function setAddress(Coordinate $address)
    {
        $this->address = $address;
    }

    /**
     * @return Coordinate
     */
    public function getCity(): Coordinate
    {
        return $this->city;
    }

    /**
     * @param Coordinate $city
     */
    public function setCity(Coordinate $city)
    {
        $this->city = $city;
    }

    /**
     * @return Coordinate
     */
    public function getState(): Coordinate
    {
        return $this->state;
    }

    /**
     * @param Coordinate $state
     */
    public function setState(Coordinate $state)
    {
        $this->state = $state;
    }

    /**
     * @return Coordinate
     */
    public function getZIP(): Coordinate
    {
        return $this->ZIP;
    }

    /**
     * @param Coordinate $ZIP
     */
    public function setZIP(Coordinate $ZIP)
    {
        $this->ZIP = $ZIP;
    }

}