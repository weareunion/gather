<?php
namespace Union\Exceptions;
interface IException
{
    /* Protected methods inherited from Exception class */
    public function getMessage();                 // Exception message
    public function getCode();                    // User-defined Exception code
    public function getFile();                    // Source filename
    public function getLine();                    // Source line
    public function getTrace();                   // An array of the backtrace()
    public function getTraceAsString();           // Formated string of trace

    /* Overrideable methods inherited from Exception class */
    public function __toString();                 // formated string for display
    public function __construct($internal_title, $internal_description, $external_title = null, $external_description = null, $no_external_facing_EC = false, $code = 0);
}

abstract class FormattedException extends \Exception implements IException
{
    protected $message = 'Unknown exception';     // Exception message
    private   $string;                            // Unknown
    protected $code    = 0;                       // User-defined exception code
    protected $file;                              // Source filename of exception
    protected $line;                              // Source line of exception
    private   $trace;                             // Unknown
    /**
     * @var array
     */
    public $data;

    public function __construct($internal_title, $internal_description, $external_title = null, $external_description = null, $no_external_facing_EC = false, $code = 0)
    {
        // some code
        $this->data = [
            "external" => [
                "title" => $external_title,
                "description" => $external_description
            ],
            "internal" => [
                "title" => $internal_title,
                "description" => $internal_description
            ],
            "no_external_face" => $no_external_facing_EC,
            "code" => $code,
            "log_lookup" => 3000
        ];
        if (!$internal_title) {
            throw new $this('Unknown '. get_class($this));
        }
        parent::__construct($internal_title, $code);
    }

    public function __toString()
    {
        return get_class($this) . " '{$this->data['internal']['title']}' - '{$this->data['internal']['description']}' ('{$this->data['code']}') in {$this->file}({$this->line})\n"
            . "{$this->getTraceAsString()}";
    }
}


// Standard HTTP
class StandardHTTPException extends FormattedException {};
    class Unauthorized extends StandardHTTPException {
    public function __construct($internal_title, $internal_description, $external_title = null, $external_description = null, $no_external_facing_EC = false, $code = 0)
    {
        parent::__construct($internal_title, $internal_description, $external_title, $external_description, $no_external_facing_EC, $code=401);
    }
};

// API
class APIException extends FormattedException {};
class InvalidParams extends APIException {};

// API.cards
class CardException extends APIException {};
class CardCreation extends CardException {};
class TooManyLoops extends CardException {};
class CardNumberTaken extends CardException{};

//API.accounts
class AccountException extends APIException{};
    class AccountCreationException extends AccountException{};
        class AccountAlreadyExists extends AccountCreationException{};
        class DatabaseInsertionError extends AccountCreationException{};
    class AccountControllerException extends AccountException {}
    class AccountActivationException extends AccountException {};

//API.security
class SecurityException extends APIException{};
    class AuthException extends SecurityException{};
        class AuthControllerException extends AuthException{};
            class InvalidPassword extends AuthControllerException {};
            class Invalid2FA extends AuthControllerException {};
        class UnauthorizedRequest extends AuthException {};


    /**
     * HTTP Error Codes:
     *
     * 401 - Unauthorized
     *
     * API Error codes are a number in the range of 10000000-99999999 (X-A-BB-C-D-E-F)
     *
     * API (1000)
     *    InvalidParams (1001)
     *
     * API.accounts (10000000):
     *             .create (10010000):
     *                  AccountCreationException (10011000):
     *                          AccountAlreadyExists (10011100):
     *                                 -> ACCOUNT WITH THIS EMAIL ALREADY EXISTS (10011110)
     *                                 -> ACCOUNT WITH THIS PHONE NUMBER ALREADY EXISTS (10011120)
     *                          DatabaseInsertionError (10011200);
     *                                 -> FAILED TO INSERT INTO DATABASE; BOOLEAN (10011210)
     *                                 -> FAILED TO INSERT INTO DATABASE; EXCEPTION (10011220)
     *                                 -> ACCOUNT LINKING: FAILED TO UPDATE DATABASE; EXCEPTION (10011230)
     *                  AccountControllerException (01012000):
     *                          InvalidParams (10012100):
     *                                 -> EMAIL FAILED VALIDATION (10012110)
     *                                 -> BOTH EMAIL AND PHONE NUMBER MISSING (10012120)
     *
     * API.security (2000000):
     *              .auth (2110000):
     *                      .create (2010000):
     *                          AccountAlreadyExists (2011000):
     *                              AuthControllerException (2011100):
     *                                      Login (2011110):
     *                                          -> INVALID PASSWORD (2011111)
     *                                          -> BOTH EMAIL AND PHONE NUMBER MISSING (2011112)
     *                                          -> ACCOUNT NOT FOUND (2011113)
    **/
