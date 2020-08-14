<?php


namespace Union\API\datatypes;


class Address
{
    public $address;
    public $city;
    public $state;
    public $ZIP;

    /**
     * @return mixed
     */
    public function getAddress()
    {
        return $this->address;
    }

    /**
     * @param mixed $address
     */
    public function setAddress($address)
    {
        $this->address = $address;
    }

    /**
     * @return mixed
     */
    public function getCity()
    {
        return $this->city;
    }

    /**
     * @param mixed $city
     */
    public function setCity($city)
    {
        $this->city = $city;
    }

    /**
     * @return mixed
     */
    public function getState()
    {
        return $this->state;
    }

    /**
     * @param mixed $state
     */
    public function setState($state)
    {
        $this->state = $state;
    }

    /**
     * @return mixed
     */
    public function getZIP()
    {
        return $this->ZIP;
    }

    /**
     * @param mixed $ZIP
     */
    public function setZIP($ZIP)
    {
        $this->ZIP = $ZIP;
    }

    public function __toString()
    {
        return "$this->address, $this->city, $this->state $this->ZIP";
    }
}