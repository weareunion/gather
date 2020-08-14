<?php


namespace Union\API\datatypes;


class VenueName
{
    public $display_name;
    public $private_name;
    public $description;
    public function __construct()
    {
    }

    /**
     * @return mixed
     */
    public function getDisplayName()
    {
        return $this->display_name;
    }

    /**
     * @param mixed $display_name
     */
    public function setDisplayName($display_name)
    {
        $this->display_name = $display_name;
    }

    /**
     * @return mixed
     */
    public function getPrivateName()
    {
        return $this->private_name;
    }

    /**
     * @param mixed $private_name
     */
    public function setPrivateName($private_name)
    {
        $this->private_name = $private_name;
    }

    /**
     * @return mixed
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * @param mixed $description
     */
    public function setDescription($description)
    {
        $this->description = $description;
    }

}