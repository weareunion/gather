<?php


namespace Union\API\transactions;

use Moycroft\API\internal\mysql\Connect;
use Union\API\communications\external\SMS;
use Union\API\permissions\Rank;
use Union\API\security\Auth;
use Union\API\venues\ActiveVenue;
use Union\API\venues\Venue;
use Union\API\venues\VenueSearch;
use Union\Exceptions\TransactionAccountCreationFailure;
use Union\Exceptions\Unauthorized;
\Union\PKG\Autoloader::import__require("API.managers.mysql");
\Union\PKG\Autoloader::import__require("API.communications.external");
\Union\PKG\Autoloader::import__require("API.accounts");
\Union\PKG\Autoloader::import__require("API.venues");
\Union\PKG\Autoloader::import__require("API.security");
\Union\PKG\Autoloader::import__require("API.permissions");


class Account
{
    public $accountID;
    public $isCard = false;
    /**
     * Constructor for a transactional account object
     * @param null $accountID The account ID that should be accessed. If null, current account may be used.
     */
    public function __construct($accountID=null, $is_balance_account = false)
    {
        // Switch to current account if not specified
        if (!$accountID) $accountID = \Union\API\accounts\Account::get_current_account();

        // Check if it the account should be treated as a balance account
        if (!$is_balance_account)
        // Check if account exists (yes, even if the current account is used)
        if(!\Union\API\accounts\Account::account_exists($accountID) || !(new Venue($accountID)) || !Auth::logged_in())
            throw new Unauthorized(
                "Attempted to generate account transactional object. Account does not exist.",
                "Could be unauthorised.",
                "You must be logged in to do this action.",
                "You don't seem to be logged in",
                false);

        $this->accountID = $accountID;
        // Will check if there is an account created, if not it will make one. If it can't, throw.
        if (!$this->create()) throw new TransactionAccountCreationFailure("Could not create transaction account with user account ID: $this->accountID", "Suspected database error.");

        // Return the account object
        return $this;
    }

    /**
     * Check if account exists
     * @return bool
     */
    public function account_exits()
    {
        // Open database connection
        $connection = new Connect();
        $connection->connect();

        // Query database for account
        $data = $connection->query("SELECT * FROM slately_users.`transactions_accounts-general` WHERE id = '$this->accountID';", true);

        // Close to save resources
        $connection->disconnect();

        // Send verdict
        return (sizeof($data) == 1);
    }

    /**
     * Create a profile if it does not exist
     * @return bool
     */
    public function create(){
        // Check if account already exists
        if ($this->account_exits()) return true;

        // Open database connection
        $connection = new Connect();
        $connection->connect();

        // Create a blank account
        $data = $connection->query("INSERT INTO slately_users.`transactions_accounts-general` (id, balance, last_computed, locked, type) VALUES ('$this->accountID', 0.0, NOW(), false, 'user')");

        // Close to save resources
        $connection->disconnect();

        // Send verdict
        return $this->account_exits();
    }

    public function set_isCard(bool $isCard){
        $this->create();
        $this->isCard = $isCard;
        $connection = new Connect();
        $connection->connect();
        $connection->query("UPDATE slately_users.`transactions_accounts-general` SET is_card = '$isCard' WHERE id='$this->accountID'");
        $connection->disconnect();
    }

    public function isCard(){
        $this->create();
        $connection = new Connect();
        $connection->connect();
        $data = $connection->query("SELECT is_card FROM slately_users.`transactions_accounts-general` WHERE id='$this->accountID'");
        $connection->disconnect();
        return (bool)$data[0]['is_card'];
    }

    public function lock($reason){
        // Check if logged in
        \Union\API\accounts\Account::strict_logged_in();
        if (ActiveVenue::getRank() <= PERMISSIONS_RANK_LEVEL_EMPLOYEE) throw new Unauthorized("You must be logged in to do this and have sufficient permissions.", "");

        // Open database connection
        $connection = new Connect();
        $connection->connect();

        // Clean String
        $reason = $connection->cleanString($reason);

        // Change data
        $data = $connection->query("UPDATE slately_users.`transactions_accounts-general` SET locked = true, locked_by = '".Auth::logged_in()."', locked_reason = '$reason' WHERE id='$this->accountID'");

        // Close to save resources
        $connection->disconnect();

        // Notify user that their account is locked (if it's a user account)
        $sms = new SMS();
        if($sms->set_to($this->accountID)){
            echo 'sending';
            $sms->set_body("Your account with us was locked due to some suspicious activity. If you have any questions, you can text us here, or you can call us at this number.");
            $sms->send();
        }else{
            echo 'not sending to '. $this->accountID;
        }
    }

    public function unlock(){
        // Check if logged in
        \Union\API\accounts\Account::strict_logged_in();
        if (ActiveVenue::getRank() <= PERMISSIONS_RANK_LEVEL_EMPLOYEE) throw new Unauthorized("You must be logged in to do this and have sufficient permissions.", "");

        // Open database connection
        $connection = new Connect();
        $connection->connect();


        // Change data
        $data = $connection->query("UPDATE slately_users.`transactions_accounts-general` SET locked = false WHERE id='$this->accountID'");

        // Close to save resources
        $connection->disconnect();
    }

    public function is_locked(){
        // Open database connection
        $connection = new Connect();
        $connection->connect();

        // Change data
        $data = $connection->query("SELECT locked, locked_reason FROM slately_users.`transactions_accounts-general` WHERE id='$this->accountID'", true);

        // Close to save resources
        $connection->disconnect();


        // DNE. Fallback
        if (sizeof($data) < 1) return false;

        // If its locked, return the reason. Else, return false
        if ($data[0]['locked'])
            return $data[0]['locked_reason'];
        else return false;

    }

    public function recalculate_balance(){
        // Make sure an account exists
        $this->create();

        // Calculate balance from roster
        $connection = new Connect();
        $connection->connect();
        $data = $connection->query("SELECT ROUND(IF(ISNULL(igr.ingress), 0,  igr.ingress), 2) as intress, 
       ROUND(IF(ISNULL(egr.egress), 0, egr.egress), 2) as egress, 
       ROUND((IF(ISNULL(igr.ingress), 0,  igr.ingress) - IF(ISNULL(egr.egress), 0, egr.egress)),2) as balance
    from (SELECT SUM(amount) as ingress
      FROM slately_users.`transactions-history`
               USE INDEX (`transactions-history`)
      WHERE destination='$this->accountID' AND accounted_for_destination = 1 AND (type = 'ingress' OR type = 'transfer' OR type = 'set')
     ) as igr
JOIN (
    (SELECT SUM(amount) as egress
     FROM slately_users.`transactions-history`
              USE INDEX (`transactions-history`)
     WHERE source='$this->accountID' AND accounted_for_source = 1 AND (type = 'egress' OR type = 'transfer')
    )
    ) as egr;", true);
    $connection->disconnect();

    // Verify that account balance is not too far off, if it is, lock the account for fraud
    if ($data[0]['balance'] > $this->get_balance() + 10 || $data[0]['balance'] < $this->get_balance() - 1.5){
        $this->lock("Account history appears fraudulent. Balance is reported as " . $this->get_balance() . " but is calculated to be " . $data[0]['balance'] . ".");
        return;
    }
    // Push balance changes if needed
    $this->modify_balance($this->get_balance() - $data[0]['balance']);
    return;
    }
    public function get_balance(){
        // Open database connection
        $connection = new Connect();
        $connection->connect();

        // Change data
        $data = $connection->query("SELECT * FROM slately_users.`transactions_accounts-general` WHERE id='$this->accountID'", true);
        // Close to save resources
        $connection->disconnect();
        return (float)$data[0]['balance'];
    }
    public function modify_balance($delta){
        // Open database connection
        $connection = new Connect();
        $connection->connect();

        // Clean string
        $delta = floatval($delta);

        // Change data
        $data = $connection->query("UPDATE slately_users.`transactions_accounts-general` SET balance=(balance+$delta) WHERE id='$this->accountID'", true);

        // Close to save resources
        $connection->disconnect();

        return (float)$data[0]['balance'];
    }
    public function current_user_authorized(){
        return ($this->accountID == \Union\API\accounts\Account::get_current_account() || Rank::get_rank() == PERMISSIONS_RANK_LEVEL_DEVELOPER);
    }

}