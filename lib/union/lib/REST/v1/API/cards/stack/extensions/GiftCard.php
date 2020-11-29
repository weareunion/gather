<?php


namespace Union\API\Cards;



use Union\API\transactions\Account;
use Union\API\transactions\Transaction;
use Union\API\transactions\TransactionManager;
use Union\Exceptions\CardAlreadyExistsException;
use Union\Exceptions\CardTransactionAccountCreationFailure;
use Union\Exceptions\ImproperCardTypeException;
use Union\Exceptions\IncompleteCardException;
use Union\Exceptions\UnknownCardException;

/**
 * A Card of type Gift Card
 * Class GiftCard
 * @package Union\API\Cards
 */
class GiftCard extends Card {

    // Transactions waiting to be executed
    /**
     * @var array
     */
    public $awaiting_transactions;

    /**
     * GiftCard constructor.
     * @param null $id
     * @throws \Union\Exceptions\TransactionAccountCreationFailure
     * @throws \Union\Exceptions\Unauthorized
     */
    public function __construct( $id=null){
        parent::__construct($id);
        if ($id === null) {
            $this->properties->type = 'balance_card';
            $this->properties->amount_current = -1;
            $this->properties->amount_start = -1;
            $this->properties->linked_user_attribute = "";
        }else{
            // Get card balance
            $this->update_card_balance();
        }
        $this->awaiting_transactions = [];
    }

    /**
     * Reset the card amount legally
     * @param $amount double The amount that the account should be set to
     * @param $description string An authorization string
     * @throws \Union\Exceptions\TransactionAccountCreationFailure Transaction accounts are created when they are needed. If there is some sort of error with it, this exception will be thrown. This is a fatal error and all processes should be aborted.
     * @throws \Union\Exceptions\Unauthorized Thrown if account is not authorized to do this transaction or if the user is not logged in.
     */
    public function reset_amount( $amount, $description, $payment_method = 'unaccounted'): void
    {

        // Create new transaction
        $this->properties->amount_current = $amount;
        $this->properties->amount_start = $amount;
        $transaction = new Transaction();
        $transaction->set_destination((new Account($this->properties->card_id)));
        $transaction->set_amount($amount);
        $transaction->set_type('set');
        $transaction->description = $description;

        $this->transactions->reset();
        $this->transactions->add_global_transaction($transaction);
        $this->transactions->log_reload_card($amount, $payment_method);

        // Add transaction to list
        $this->awaiting_transactions[] = $transaction;

        $this->update_transaction_account();
        $this->update();
    }


    // Over loaded methods helper methods

    /**
     * Forces a transaction account to be created
     * @throws CardTransactionAccountCreationFailure Transaction accounts are created using this method. This class is unusable without this helper infrastructure.
     * @throws \Union\Exceptions\TransactionAccountCreationFailure Will Throw the exception CardTransactionAccountCreationFailure
     * @throws \Union\Exceptions\Unauthorized Thrown if the account is not authorized to do this transaction or if the user is not logged in.
     */
    public function create_transaction_account(): void
    {
        // Ensure that card_id is set
        if (!isset($this->properties->card_id)){
            throw new CardTransactionAccountCreationFailure("Transaction account could not be created due to an account id not specified. Use load() or create() first.");
        }
        // Create new Transaction account if it does not alrady exist
        $account = new Account($this->properties->card_id, false, 'balance_card');
        $account->set_isCard(true);
    }

    /**
     * Attempts to execute the awaiting transactions and will update the object upon completion
     * @throws \Union\Exceptions\AccountLocked Will throw this exception if the account is locked
     * @throws \Union\Exceptions\InsufficientFunds Will throw this exception if the amount of funds is insufficient to the transaction amount
     * @throws \Union\Exceptions\InvalidTransaction A general syntax error
     * @throws \Union\Exceptions\TransactionAlreadyExists Will throw this exception if the transaction already exists
     * @throws \Union\Exceptions\Unauthorized|\Union\Exceptions\TransactionAccountCreationFailure Thrown if the account is not authorized to do this transaction or if the user is not logged in.
     */
    public function update_transaction_account(){
        // Execute every waiting transaction
        foreach ($this->awaiting_transactions as $transaction)
            TransactionManager::post($transaction);

        // Clear transactions
        $this->awaiting_transactions = [];

        // Update the card balance
        $this->update_card_balance();
    }

    /**
     * Updates the card balance from the transactional record
     * @throws \Union\Exceptions\TransactionAccountCreationFailure Transaction accounts are created when they are needed. If there is some sort of error with it, this exception will be thrown. This is a fatal error and all processes should be aborted.
     * @throws \Union\Exceptions\Unauthorized Thrown if the account is not authorized to do this transaction or if the user is not logged in.
     */
    public function update_card_balance(){
        // Update card balance from account balance
        $this->properties->amount_current = (new Account($this->properties->card_id))->get_balance();
    }

    // Overloaded methods

    /**
     * Creates framework for a new card of type gift card
     * @throws CardAlreadyExistsException Thrown if the card already exists
     * @throws CardTransactionAccountCreationFailure Transaction accounts are created when they are needed. If there is some sort of error with it, this exception will be thrown. This is a fatal error and all processes should be aborted.
     * @throws ImproperCardTypeException Thrown if the card type is incorrect
     * @throws IncompleteCardException Thrown when there are parameters missing
     * @throws UnknownCardException Thrown if the card is unknown (should never throw using this method)
     * @throws \Union\Exceptions\TransactionAccountCreationFailure Transaction accounts are created when they are needed. If there is some sort of error with it, this exception will be thrown. This is a fatal error and all processes should be aborted.
     * @throws \Union\Exceptions\Unauthorized Thrown if the account is not authorized to do this transaction or if the user is not logged in.
     */
    public function create(): void{
        // Check the proper type
        if ($this->properties->type !== 'balance_card'){
            throw new ImproperCardTypeException("The card type '".$this->properties->type."' is not supported by this class.");
        }
        if (!isset($this->properties->amount_start, $this->properties->amount_current)){
            throw new IncompleteCardException("Not all parameters were provided.");
        }

        parent::create();
        $this->create_transaction_account();
    }

    /**
     * Load from an ID
     * @param $id string ID to load object from
     */
    public function load( $id ){
        $res = parent::load($id);
        $this->update_transaction_account();
        return $res;
    }

    /**
     * Update the card object from the according databases
     */
    public function update(): void{
        $this->update_transaction_account();
        parent::update();
    }

    public function get_URL(){
        return SLATELY_WEBSTACK_HREF_PAGE_CLIENT_CARDS_VIEW . "?" . $this->properties->contingency_id;
    }


}