<?php


namespace Union\API\Cards;



use Union\API\accounts\Account;
use Union\API\security\Auth;
use Union\Exceptions\CardAuthenticationFailure;
use Union\Exceptions\CardDoesNotExistException;
use Union\Exceptions\InvalidPinException;
use Union\Exceptions\Unauthorized;
use Union\session\Session;

/**
 * Class Authentication
 *
 * This class is used to authenticate (or unlock) the card for use. This class
 * is NOT responsible for transaction validation and authentication
 *
 * @package Union\API\Cards
 */
class Authentication {
    /**
     * @var
     */
    public $parent;
    private $properties;

    /**
     * Authentication constructor.
     * @param $properties
     * @param $parent
     */
    public function __construct( &$properties, Card $parent)
    {
        $this->properties = $properties;
        $this->parent = $parent;
    }

    /**-------------SESSION AUTHENTICATION METHODS-------------**/


    /**
     * Authenticate the current card and bind it to the current session.
     * If no pin number is supplied, use the current session. If none of these methods work,
     * the method will throw a CardAuthenticationFailure exception.
     *
     * @param null $pin If this parameter is set, then the method will attempt to use the pin authentication method.
     * @throws CardAuthenticationFailure Thrown if all possible authentication methods have been exhausted.
     */
    public function authenticate($pin=null): void
    {
        if ($pin !== null && !$this->pin_validate($pin)){
            throw new CardAuthenticationFailure(
                "Supplied PIN does not match records.",
                "",
                "Incorrect Code",
                "It seems like the code you entered does not match our records.
                 You can enter in the recovery code that you recived upon the activation of your card.");
        }
        if ($pin === null && !$this->current_account_authenticated()){
            throw new CardAuthenticationFailure(
                "The current account is not linked to this card.",
                "",
                "The ",
                "It seems like your account is not linked to this card.
                 You can enter in the recovery code that you recived upon the activation of your card to revert this change.");
        }

        // ------ Begin Session Auth -----

        // Get activated cards
        $exsts = Session::get_current_session()->get("API.cards.session.active");

        // Check if any activated cards already exist
        if ($exsts === null) {
            $exsts = [];
        }

        // Add card ID
        $exsts[] = $this->properties->card_id;

        // Add to session
        Session::get_current_session()->set("API.cards.session.active", $exsts);
    }

    /**
     * Check if current card is authenticated for session
     * @return bool returns true if authenticated for the current session
     */
    public function is_authenticated(): bool
    {
        // Get activated cards
        $exsts = Session::get_current_session()->get("API.cards.session.active");

        // If none are registered, return false
        if ($exsts === null) {
            return false;
        }

        // For every key that is registered, check if there is a registration
        foreach ($exsts as $key) {
            if ($key === $this->properties->card_id) {
                return true;
            }
        }

        // Otherwise, return false
        return false;
    }

    /**
     * Removes current card from authentication list
     */
    public function deauthenticate(): void
    {
        // Get activated cards
        $exsts = Session::get_current_session()->get("API.cards.session.active");

        // If none are registered, return
        if ($exsts === null) {
            return;
        }

        // For every key that is registered, check if there is a registration
        foreach ($exsts as &$key)
            // If the key is found, remove it from the registration list
        {
            if ($key === $this->properties->card_id) {
                unset($key);
                return;
            }
        }
    }

    /**-------------PIN NUMBER AUTHENTICATION METHODS-------------**/

    /**
     * Attach pin to card
     * @param $pin string pin to be attached
     * @throws CardDoesNotExistException
     * @throws InvalidPinException Throws if the pin is invalid
     */
    public function pin_attach( $pin): void
    {
        // Prepare pin
        $this->prepare_pin($pin);

        // Salt and hash string
        $salt = $this->generate_crypto_string();
        $hash = $this->generate_hash($pin, $salt);

        // Set into parent
        $this->properties->security->authentication->methods->pin->pin_SHA = $hash;
        $this->properties->security->authentication->methods->pin->pin_SHA_salt = $salt;

        // Update
        $this->parent->update();
    }

    /**
     * Validates the given pin against the record hash
     * @param $pin string Pin to validate against the record hash
     * @return bool return true if the pin is valid
     * @throws InvalidPinException
     */
    public function pin_validate( $pin): bool{
        // Prepare pin
        $this->prepare_pin($pin);

        // Compare the pin with the embedded hash function
        return $this->compare_hash(
            $pin,
            $this->properties->security->authentication->methods->pin->pin_SHA,
            $this->properties->security->authentication->methods->pin->pin_SHA_salt
        );
    }

    /**
     * Remove pin from card
     */
    public function pin_revoke(): void
    {
        // Clear the properties
        $this->properties->security->authentication->methods->pin->pin_SHA = '';
        $this->properties->security->authentication->methods->pin->pin_SHA_salt = '';
    }

    /**
     * Change pin to supplied pin
     * @param $pin string Pin to install
     * @throws CardDoesNotExistException
     * @throws InvalidPinException Throws if the given pin not valid
     */
    public function pin_change( $pin): void
    {
        // Prepare pin
        $this->prepare_pin($pin);

        // Remove current pin
        $this->pin_revoke();

        // Attach new pin
        $this->pin_attach($pin);
    }

    /**
     * Generates and sets a backup authentication PIN for the card.
     * @return string Generated backup pin
     * @throws CardDoesNotExistException Throws if the card does not exist
     */
    public function issue_backup_pin(): string
    {
        // Generate pin
        $backup_pin = $this->generate_pin();

        // Generate random salt
        $salt = $this->generate_crypto_string();

        // Add to properties list
        $this->properties->security->authentication->methods->pin->recovery->pin_SHA = $this->generate_hash($backup_pin, $salt);
        $this->properties->security->authentication->methods->pin->recovery->pin_SHA_salt = $salt;

        // Push update
        $this->parent->update();

        return $backup_pin;
    }

    /**
     * Validate backup pin against hash
     * @param $pin string Pin to compare against the record hash
     * @return bool Returns true if the pin is valid and matches the record hash
     * @throws InvalidPinException
     */
    public function validate_backup_pin( $pin): bool
    {
        // Prepare pin
        $this->prepare_pin($pin);
        return $this->compare_hash(
            $pin,
            $this->properties->security->authentication->methods->pin->recovery->pin_SHA,
            $this->properties->security->authentication->methods->pin->recovery->pin_SHA_salt
        );
    }

    /**
     * Clean and prepare pin and convert to padded string
     * @param $pin string Pin to be prepared
     * @throws InvalidPinException
     */
    public function prepare_pin( &$pin): void
    {
        // Cast pin for safety
        /** @noinspection CallableParameterUseCaseInTypeContextInspection */
        $pin = (int)preg_replace("/[^0-9]/", "", $pin );;
        // Check if its a valid pin
        if ($pin > 9999 || $pin < 0){
            throw new InvalidPinException("The pin that was given ($pin) is not valid", "");
        }

        // Pad string
        $pin = str_pad($pin, 4, '0', STR_PAD_LEFT);
    }

    /**-------------ACCOUNT AUTHENTICATION METHODS-------------**/

    /**
     * Check if current account is authenticated for the current card
     * @return bool returns true if the account is authenticated for this card
     */
    public function current_account_authenticated(): bool{
        return (Auth::logged_in() && Auth::logged_in() ===  $this->properties->security->authentication->methods->account->account_id);
    }

    /**
     * Link account ID to card
     * @param null $account_id Account ID to link
     * @throws CardDoesNotExistException
     * @throws Unauthorized Throws if the account is not authorized to do this transaction or if the user is not logged in.
     */
    public function link_account( $account_id=null): void
    {

        // If account is not specified use logged in account
        if ($account_id == null) $account_id = Auth::logged_in();

        // If that doesnt work, throw
        if (!$account_id || !Account::account_exists($account_id)){
            throw new Unauthorized(
                "User must be logged in to link an account",
                "",
                "You must be logged in to link an account"
            );
        }

        // Set properties
        $this->properties->security->authentication->methods->account->account_id = $account_id;
        $this->properties->security->authentication->methods->account->account_linked = true;
        $this->properties->security->authentication->methods->account->changed_on = time();

        // Update
        $this->parent->update();
    }

    /**
     * Unlink account ID from card
     * @throws CardDoesNotExistException
     */
    public function unlink_account(): void
    {
        // Set properties
        $this->properties->security->authentication->methods->account->account_id = '';
        $this->properties->security->authentication->methods->account->account_linked = false;
        $this->properties->security->authentication->methods->account->changed_on = time();

        // Update
        $this->parent->update();
    }

    /**-------------CRYPTO HELPER METHODS-------------**/

    /**
     * Generates a 256 bit string of random letters
     * @param int $length custom length of string
     * @return string random 256 character string
     * @throws \Exception
     */
    public function generate_crypto_string( $length=256): string
    {
        $bytes = random_bytes((int)($length/2));
        return bin2hex($bytes);
    }

    /**
     * Encrypts a string with the most recent hash available
     * @param $string string string to encrypt
     * @param string $salt an optinal salt
     * @return false|string|null returns the hash
     */
    private function generate_hash( $string, $salt=""){
        return password_hash($string.$salt, PASSWORD_DEFAULT);
    }

    /**
     * Compare string with hash
     * @param $string string String to compare to hash
     * @param $hash string Hash to compare against
     * @param string $salt Optional salt
     * @return bool returns true if string is valid against the hash, false otherwise
     */
    private function compare_hash( $string, $hash, $salt="" ): bool
    {
        return password_verify($string.$salt, $hash);
    }

    /**
     * Generates random pin with size
     * @param int $size length of random pin
     * @return string pin
     * @throws \Exception
     */
    private function generate_pin($size=4): string{
        return str_pad(random_int(0, 9 ** $size), $size, '0', STR_PAD_LEFT);
    }

}