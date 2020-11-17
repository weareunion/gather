<?php


namespace Union\API\transactions;
use Moycroft\API\internal\mysql\Connect;
use Union\API\managers\GUID;
use Union\API\permissions\Rank;
use Union\API\security\Auth;
use Union\Exceptions\AccountLocked;
use Union\Exceptions\InsufficientFunds;
use Union\Exceptions\InvalidTransaction;
use Union\Exceptions\TransactionAccountCreationFailure;
use Union\Exceptions\TransactionAlreadyExists;
use Union\Exceptions\TransactionDoesNotExist;
use Union\Exceptions\TransactionFailed;
use Union\Exceptions\Unauthorized;
use function GuzzleHttp\Promise\task;

\Union\PKG\Autoloader::import__require("API.managers.mysql");
\Union\PKG\Autoloader::import__require("API.managers");
\Union\PKG\Autoloader::import__require("API.communications.external");
\Union\PKG\Autoloader::import__require("API.accounts");
\Union\PKG\Autoloader::import__require("API.transactions");
\Union\PKG\Autoloader::import__require("API.security");

class TransactionManager
{
    static public function transaction_exists($transaction_id){
        if ($transaction_id == null) return false;

        // Open database connection
        $connection = new Connect();
        $connection->connect();

        // Create a blank account
        $data = $connection->query("SELECT * FROM slately_users.`transactions-history` WHERE transaction_id = '$transaction_id'", true);

        // Close to save resources
        $connection->disconnect();

        return (sizeof($data) > 0);
    }

    static public function transfer(Account $from, Account $to, float $amount){
        $transaction = new Transaction();
        $transaction->set_source($from);
        $transaction->set_destination($to);
        $transaction->set_amount($amount);
        $transaction->set_type('transfer');
        self::post($transaction);
        return $transaction;
    }

    static public function post(Transaction &$transaction){
        // Prevent duplicates
        if (self::transaction_exists($transaction->transaction_id)) throw new TransactionAlreadyExists("A transaction with the id '$transaction->transaction_id already exists.", "Use the update() function to update the transaction.");

        // Chance to recalculate account totals
        if ($transaction->source != NULL) $transaction->source->recalculate_balance();
        if ($transaction->destination != NULL) $transaction->destination->recalculate_balance();

        // Check that type amount and source are set (are required for every transaction)
        if (!$transaction->type) throw new InvalidTransaction("Type is required for transaction");
        if (!$transaction->source) throw new InvalidTransaction("Source account is required for transaction");
        if (!$transaction->amount) throw new InvalidTransaction("An amount is required for transaction");

        // Check that transfer accounts have a destination
        if (in_array($transaction->type, ['transfer']) && !$transaction->destination)
            throw new InvalidTransaction("A destination account is required for a transfer transaction");

        // Check that outbound transactions are issued by only an authority
        if (in_array($transaction->type, ['transfer', 'egress']) && !$transaction->source->current_user_authorized())
            throw new Unauthorized("The current user is not authorized to do this transaction", "", "You are not authorized to do this transaction");

        // Check that balance is enough if egress or transfer
        if (in_array($transaction->type, ['transfer', 'egress']) && $transaction->source->get_balance() < $transaction->amount)
            throw new InsufficientFunds("Not enough balance to complete transaction", $transaction->source->get_balance()." is not enough for a transaction of ". $transaction->amount, "You do not have enough account balance to do this transaction");

        // Check that balance is not negative for non-set
        if (!in_array($transaction->type, ['set']) && 0 >= $transaction->amount)
            throw new InvalidTransaction("Amount must be positive unless it is an account set.");

        // Check that balance is not negative for non-set
        if (in_array($transaction->type, ['transfer','egress']) && ($transaction->source->is_locked()))
            throw new AccountLocked("The source account is locked'", "Reason:" . $transaction->source->is_locked(), "Your account has been locked.", "Please contact support if you believe that this was in error.");

        // Check that sets are done by an authority
        if (in_array($transaction->type, ['set']) && Rank::get_rank() < PERMISSIONS_RANK_LEVEL_MANAGER)
            throw new Unauthorized("The current user is not authorized to do this transaction", "", "You are not authorized to do this transaction");

        // Checks complete, configure the rest
        if (in_array($transaction->type, ['set'])) $transaction->status_description = "Authorized by " . Auth::logged_in();

        switch ($transaction->type){
            case "transfer":
                // Record balance before
                $source_bal = $transaction->source->get_balance();
                $dest_bal = $transaction->destination->get_balance();

                // Try transaction
                self::push($transaction);

                // Modify live balance
                $transaction->source->modify_balance((-1 * $transaction->amount));
                $transaction->destination->modify_balance(($transaction->amount));

                // Set status to posted
                self::status($transaction, "settled", "Transaction has been settled.");
                break;
        }
    }

    private static function push(Transaction &$transaction){

        // Create UUID for transaction
        $transaction->transaction_id = GUID::generate();

        try {
            // Attempt to insert transaction into chain
            $connection = new Connect();
            $connection->connect();
            $connection->query("INSERT INTO slately_users.`transactions-history` 
    (transaction_id, source, amount, type, status, description, status_description, destination, accounted_for_source, accounted_for_destination, transaction_posted, transaction_updated) 
    VALUES ('$transaction->transaction_id', 
            '".$transaction->source->accountID."', 
            '".$transaction->amount."', 
            '".$transaction->type."', 
            '".$transaction->status."', 
            '".$transaction->description."', 
            '".$transaction->status_description."', 
            '".$transaction->destination->accountID."',
            '1',
            '1',
            NOW(),
            NOW()
            )
            ");
            $connection->disconnect();
        }catch (\Exception $exception){
            throw new TransactionFailed("Transaction failed due to an unknown MySql error.", "Information: " . $exception->getMessage());
        }

        // Verify transaction exists
        $data = NULL;
        try {
            $connection = new Connect();
            $connection->connect();
            $data = $connection->query("SELECT * FROM slately_users.`transactions-history` WHERE transaction_id = '$transaction->transaction_id'", true);
            $connection->disconnect();
        }catch (\Exception $exception){
            throw new TransactionFailed("Transaction failed due to an unknown MySql error.", "Information: " . $exception->getMessage());
        }

        // Send Verdict
        if (sizeof($data) == 0){
            throw new TransactionFailed("Transaction could not be verified.", "Check MSQL logs.");
        }
    }

    static function status(Transaction &$transaction, $status, $description=""){
        $transaction->set_status($status, $description);
        self::update($transaction);
    }
    public static function update(Transaction &$transaction){
        // Check if transaction exists
        if (!TransactionManager::transaction_exists($transaction->transaction_id)){
            throw new TransactionDoesNotExist("This transaction does not exist. It must be created first.");
        }

        // Build query
        $targets = "";
        $obj = get_object_vars($transaction);

        foreach ($transaction->changes as $change){
            $value = "";
            if (in_array($change, ['destination', 'source'])) $value = $obj[$change]->accountID;
            else $value = $obj[$change];
            $targets .= "`$change` = '".$value."',";
        }

        // Compile
        $query = "UPDATE slately_users.`transactions-history` SET $targets transaction_updated=NOW() WHERE transaction_id='$transaction->transaction_id'";

        // Execute query
        $connection = new Connect();
        $connection->connect();
        $connection->query($query);
        $connection->disconnect();

        // Clear list
        $transaction->changes = [];
    }
}