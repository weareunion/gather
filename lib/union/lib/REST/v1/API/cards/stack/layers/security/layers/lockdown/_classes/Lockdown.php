<?php


namespace Union\API\Cards;


use Union\API\transactions\Account;
use Union\Exceptions\CardDoesNotExistException;
use Union\Exceptions\TransactionAccountCreationFailure;

/**
 * Class Lockdown
 * @package Union\API\Cards
 */
class Lockdown {
    private $properties;
    private $parent;

    /**
     * Lockdown constructor.
     * @param $properties
     * @param $parent
     */
    public function __construct( &$properties, Card $parent)
    {
        $this->properties = $properties;
        $this->parent = $parent;
    }

    /**
     * Lock down card and transaction account
     * @param $reason string Reason that the card was locked_reason
     * @param null $origin The origin of the lock
     * @throws CardDoesNotExistException Throws if the card does not exist
     * @throws \Union\Exceptions\Unauthorized Throws if the user is not authorized to do this action.
     */
    public function lockdown( $reason, $origin = null): void
    {
        // Ignore if transaction account cannot be created
        try {
            ( new Account($this->properties->card_id) )->lock($reason);
        }catch (TransactionAccountCreationFailure $e) {}
        $this->properties->lockdown->active = true;
        $this->properties->lockdown->reason = $reason;
        $this->properties->lockdown->origin = $origin;
        $this->parent->update();
    }

    /**
     * Unlock the card and transaction account. Keep in mind that the reason that the card might
     * have been locked in the first place might have not been resolved
     * @throws CardDoesNotExistException Throws if the card does not exist
     * @throws \Union\Exceptions\Unauthorized Throw an exception if the user is not authorized to do this action
     */
    public function unlock(): void
    {
        try {
            ( new Account($this->properties->card_id) )->unlock();
        }catch (TransactionAccountCreationFailure $e) {}
        $this->properties->lockdown->active = false;
        $this->parent->update();
    }
}
