<?php


namespace Union\API\Cards;

require_once __DIR__ . '/Transaction.php';

class Transactions
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

    public function add_global_transaction(\Union\API\transactions\Transaction $transaction, $description=""){
        $this->parent->properties->transactions->global[] = [
            'transaction' => $transaction,
            'description' => $description
        ];
    }
    public function add_card_transaction(\Union\API\Cards\Transaction $transaction, $description=""){
        if ($transaction->getActionType() === 'release'){
            $this->properties->transactions->unclaimed_released_funds += $transaction->getAmount();
        }
        $this->properties->transactions->global[] = [
            'transaction' => $transaction,
            'description' => $description
        ];
    }

    public function reset(){
        $this->properties->transactions->global = [];
        $this->properties->transactions->card = [];
        $this->properties->transactions->unclaimed_released_funds;
    }

    public function get_global_transactions(){
        return $this->properties->transactions->global;
    }
    public function get_card_transactions(){
        return $this->properties->transactions->card;
    }

    public function log_reload_card(float $amount, string $payment_method){
        $t = new Transaction();
        $t->setAmount($amount);
        $t->setTargetCard($this->parent);
        $t->setFundType($payment_method);
        $t->setActionType('reload');
        $this->add_card_transaction($t);
        $this->parent->update();
    }

    public function get_card_transaction_proportion(){
        $t = new Transaction();
        $proportions = [];
        foreach($t->fund_type_allowed as $type){
            $proportions[$type] = 0;
        }
        foreach ($this->get_card_transactions() as $card_transaction){
            $proportions[$card_transaction['transaction']->fund_type] += $card_transaction['transaction']->amount;
        }
    }

}