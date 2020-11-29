<?php


namespace Union\API\Cards;

use Union\API\venues\ActiveVenue;
use Union\API\venues\Venue;
use Union\Exceptions\InvalidParamType;
use Union\Exceptions\NoActiveVenue;
use Union\PKG\Autoloader;

Autoloader::import__require("API.venues");


class Venues
{
    public $parent;
    private $properties;

    /**
     * Venues constructor.
     * @param $properties
     * @param Card $parent
     */
    public function __construct( &$properties, Card $parent)
    {
        $this->properties = $properties;
        $this->parent = $parent;
    }

    /**
     * Add a venue to card lists
     * @param null $venue
     * @throws InvalidParamType
     * @throws NoActiveVenue
     * @throws \Union\Exceptions\CardDoesNotExistException
     */
    public function add( $venue=null){
        $venue = $this->param_check_venue($venue);

        // If it isnt added, add it to the list
        if (!$this->is_added($venue)){
            $this->properties->venues->associated[] = $venue;
        }

        // Update parent
        $this->parent->update();
    }

    /**
     * Check if venue is added
     * @param null $venue
     * @return false|mixed
     * @throws InvalidParamType
     * @throws NoActiveVenue
     */
    public function is_added( $venue=null){
        $venue = $this->param_check_venue($venue);
        // Convert to venue object type if its a string
        if (is_string($venue)){
            $venue = new Venue($venue);
        }

        // Iterate through venues to find the venue
        foreach ($this->properties->venues->associated as $venue_iter){
            if ($venue->id === $venue_iter->id) return $venue_iter;
        }
        return false;
    }

    /**
     * Remove a venue from list
     * @param null $venue
     * @throws InvalidParamType
     * @throws NoActiveVenue
     */
    public function remove( $venue=null){
        $venue = $this->param_check_venue($venue);
        foreach ($this->properties->venues->associated as &$venue_iter){
            if ($venue->id === $venue_iter->id) {
                // Remove and update parent
                unset($venue_iter);
                $this->parent->update();
                return;
            }
        }
    }

    protected function param_check_venue($venue=null){
        // Try to get the venue if its not set
        if ($venue === null){
            $venue = ActiveVenue::get();
            if ($venue === null){
                throw new NoActiveVenue("No active venue was given.", "", "No active venue has been selected. Please select one and try again.");
            }
        }
        // Check if variable is of the proper type
        if (!($venue instanceof Venue) && !(is_string($venue))){
            throw new InvalidParamType("Invalid param class. Expected Venue or String, got: " . gettype($venue));
        }
        // Convert to venue object type if its a string
        if (is_string($venue)){
            $venue = new Venue($venue);
        }
        return $venue;
    }
}