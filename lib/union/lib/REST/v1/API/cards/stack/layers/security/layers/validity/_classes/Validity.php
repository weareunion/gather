<?php


namespace Union\API\Cards;


use Union\Exceptions\CardActivationException;
use Union\Exceptions\CardValidityException;

/**
 * Class Validity
 * @package Union\API\Cards
 */
class Validity {
    /**
     * @var
     */
    public $parent;
    /**
     * @var
     */
    public $properties;

    /**
     * Validity constructor.
     * @param $properties
     * @param $parent
     */
    public function __construct( &$properties, &$parent)
    {
        $this->properties = $properties;
        $this->parent = $parent;
    }

    /**
     * Standard create function
     */
    public function create(): void
    {
        // Set flag to current time
        $this->properties->validity->card_created_on = time();

        // Update
        $this->parent->update();
    }

    /**
     * Check if card is active and valid
     * @param bool $throw Should the function throw an exception
     * @return bool returns true if the card is valid
     * @throws CardValidityException
     */
    public function valid( bool $throw=true ){
        try {
            // Short hand
            $p = $this->properties->validity;

            // Check if card has been activated
            if ($p->activated_on === null) {
                throw new CardValidityException(
                    "Card has not been activated",
                "",
                "Inactive card",
                "In order to use this card, you must first activate it.");
            }

            // Check if the card is being used prematurely
            if ($p->validity_start !== null && $p->validity_start > time()) {
                throw new CardValidityException(
                    "Card was attempted to be used too early",
                    "Valid from " . (new \DateTime())->setTimestamp((int)$p->validity_start)->format('F j, Y H:i a') ,
                    "Too soon!",
                    "The card is not valid until " . (new \DateTime())->setTimestamp((int)$p->validity_start)->format('F j, Y H:i a') . ".");
            }

            // Check if the card is expired
            if ($p->validity_end !== null && $p->validity_end < time()) {
                throw new CardValidityException(
                    "Card was attempted to be used too late",
                    "",
                    "Your card has expired",
                    "Your card expired at " . (new \DateTime())->setTimestamp((int)$p->validity_start)->format('F j, Y H:i a')  . ". Please contact us if this is an error.");
            }
        }catch (\Exception $e) {
            // Only throw if false
            if (!$throw) {
                return false;
            }
            throw $e;
        }
        return true;
    }

    /**
     * Set time (in seconds) at which the card will expire after activation
     * @param int $expires_if_not_activated_after
     */
    public function set_expiry_interval( $expires_if_not_activated_after = 2419200): void
    {
        // Set interval
        $this->properties->validity->expires_if_not_activated_after = $expires_if_not_activated_after;

        // Update
        $this->parent->update();
    }

    /**
     * Check if the current date is within the expiry interval
     * @return bool
     */
    public function is_within_expiry_interval(){
        if ($this->properties->validity->expires_if_not_activated_after === null) {
            return true;
        }
        return ($this->properties->validity->card_created_on + $this->properties->validity->expires_if_not_activated_after > time());
    }

    /**
     * Set the unix timestamp as to which the card should begin to be valid
     * @param int $time
     */
    public function set_validity_start( int $time): void
    {
        // Set interval
        $this->properties->validity->validity_start = $time;

        // Update
        $this->parent->update();
    }

    /**
     * Set the Unix timestamp as to which the card should expire
     * @param int $time
     */
    public function set_validity_end( int $time): void
    {
        // Set interval
        $this->properties->validity->validity_end = $time;

        // Update
        $this->parent->update();
    }

    /**
     * Activate the card
     * @param bool $force if true, will force and not check if the card cannot be activated
     * @throws CardActivationException Will throw an exception if the card cannot be activated due to it being outside of the activation interval
     */
    public function activate($force=false){
        // Check if activation should be forced
        if (!$force)
            // Throw if past activation interval
        {
            if (!$this->is_within_expiry_interval()) {
                throw new CardActivationException(
                    "Could not be activated due to the activation period being expired.",
                    "",
                    "This Card is past due",
                    "Unfortunately, this card cannot be activated due to the fact that 
                    the activation period of" . ( $this->properties->validity->expires_if_not_activated_after / 86400 ) .
                    "has expired."
                );
            }
        }

        // Set interval
        $this->properties->validity->activated_on = time();

        // Update
        $this->parent->update();
    }

    /**
     * Deactivate the card
     */
    public function deactivate(){
        // Set interval
        $this->properties->validity->activated_on = null;

        // Update
        $this->parent->update();
    }


}