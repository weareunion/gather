<?php


namespace Union\API\transactions;
\Union\PKG\Autoloader::import__require("API.managers.mysql");
\Union\PKG\Autoloader::import__require("API.managers");
\Union\PKG\Autoloader::import__require("API.communications.external");
\Union\PKG\Autoloader::import__require("API.accounts");
\Union\PKG\Autoloader::import__require("API.transactions");
\Union\PKG\Autoloader::import__require("API.security");


use Moycroft\API\internal\mysql\Connect;
use Union\API\security\Auth;
use Union\Exceptions\AccountLocked;
use Union\Exceptions\InsufficientFunds;
use Union\Exceptions\InvalidTransaction;
use Union\Exceptions\InvalidTransactionStatus;
use Union\Exceptions\InvalidTransactionType;
use Union\Exceptions\TransactionAccountCreationFailure;
use Union\Exceptions\TransactionAlreadyExists;
use Union\Exceptions\TransactionDoesNotExist;
use Union\Exceptions\Unauthorized;

/**
 * Class Transaction
 * Responsible for all internal transactions and movement of money
 * @package Union\API\transactions
 */
class Transaction
{
    /**
     * @var Account
     */
    /**
     * @var Account
     */
    public $active_account,
           $transaction_id,
           $source,
           $source_account_exists = true,
           $destination,
           $destination_account_exists = true,
           $amount,
           $description,
        /**
         * Type of transaction
         * transfer - A transfer between internal accounts
         * ingress - A Transfer coming from external transaction
         * egress - A Transfer leaving to external transaction
         * set - A manual override of balance
         */
           $type,
           $possible_types = [
               'transfer',
               'ingress',
               'egress',
               'set'
           ],
        /**
         * Status of transaction:
         * failed - Transaction has failed. Check status desc
         * inactive - Transaction is incomplete
         * pending - Transaction is pending
         * settled - Transaction is complete
         * disputed - Transaction is disputed and cannot be used to debit to destination account
         * fraudulent - Transaction is marked as fraudulent and will not be counted
         * refunded - Transaction has been refunded and will not be counted
         */
           $status,
           $possible_status = [
           'failed',
           'inactive',
           'pending',
           'settled',
           'disputed',
           'fraudulent',
           'refunded'],
           $status_description,
           $transaction_updated,
           $transaction_posted;
           public $changes = [];
           public $new = true;

    public function __construct($transaction_id=null){
        // Create an active account (will throw if not logged in)
        $this->active_account = new Account();

        // Load transaction if needed
        if ($transaction_id != null) $this->load($transaction_id);
    }

    public function set_source(Account $account=null){
        // Create new account object if it isnt provided
        if ($account == null) $account = new Account();
        // Check if account is locked
        if ($account->is_locked()) throw new AccountLocked("This account was locked and cannot be used in a transaction", "Reason: ".$account->is_locked(), "It seems like your account has been locked.", "Please contact support if you believe this was in error.");
        $this->source = $account;
        // Add to update list
        array_push($this->changes, 'source');
    }
    public function set_destination(Account $account){
        $this->destination = $account;
        // Add to update list
        array_push($this->changes, 'destination');
    }
    public function set_amount($amount){
        $this->amount = $amount;
        // Add to update list
        array_push($this->changes, 'amount');
    }
    public function set_type($type){
        // Verify valid type
        if (!in_array($type, $this->possible_types)) throw new InvalidTransactionType("The transaction type '$type' is invalid.", "Check inline docs.");
        $this->type = $type;
        // Add to update list
        array_push($this->changes, 'type');
    }
    public function set_status($status, $description = ""){
        // Verify valid type
        if (!in_array($status, $this->possible_status)) throw new InvalidTransactionStatus("The transaction status '$status' is invalid.", "Check inline docs.");
        $this->status_description = $description;
        $this->status = $status;
        // Add to update list
        array_push($this->changes, 'status');
        array_push($this->changes, 'status_description');
    }
    public function load($transaction_id){
        // Open database connection
        $connection = new Connect();
        $connection->connect();

        // Create a blank account
        $data = $connection->query("SELECT * FROM slately_users.`transactions-history` WHERE transaction_id = '$transaction_id'", true);

        // Close to save resources
        $connection->disconnect();

        // Check if the transaction exists
        if (sizeof($data) == 0) throw new TransactionDoesNotExist("Transaction with ID '$transaction_id' could not be found in records.", "");

        // Get the first row
        $data = $data[0];

        // Load the data from database into object
        $this->transaction_id = $transaction_id;
        $this->source = $data['source'];
        $this->destination = $data['destination'];
        $this->amount = $data['amount'];
        $this->type = $data['type'];
        $this->status = $data['status'];
        $this->status_description = $data['status_description'];
        $this->transaction_posted = $data['transaction_posted'];
        $this->transaction_updated = $data['transaction_updated'];

        // Try to load account objects. Fall back to UID if needed
        try {
            $this->source = new Account($this->source);
        } catch (TransactionAccountCreationFailure $e) {
            $this->source_account_exists = false;
        }
        try {
            $this->destination = new Account($this->destination);
        } catch (TransactionAccountCreationFailure $e) {
            $this->destination_account_exists = false;
        }

        // Set as new
        $this->new = false;

        // Clear list
        $this->changes = [];

        // Send verdict
        return true;
    }


}