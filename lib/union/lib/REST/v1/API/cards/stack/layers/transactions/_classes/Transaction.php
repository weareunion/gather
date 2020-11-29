<?php


namespace Union\API\Cards;


use Union\Exceptions\InvalidCardTransactionType;

class Transaction
{
    /**
     * The action that is being done
     * @var
     */
    public $action_type;
    /**
     * The allowed action types
     * a) reload - Reload of the card
     * b) transfer_to_account - Transfer the whole balance to a venue account
     * c) unlink - delete card
     * d) release - release funding to venue (for expired cards)
     * e) adjust - a manual adjustment made to the card
     * @var string[]
     */
    public $action_type_allowed = ['reload', 'transfer_to_account', 'unlink', 'release', 'adjust'];
    /**
     * @var
     */
    public $fund_type;
    /**
     * @var string[]
     */
    public $fund_type_allowed = ['unaccounted','cash', 'credit_card_online', 'credit_card_manual'];

    public $fund_type_categories = [
        'unaccounted' => [
            'cash',
            'check',
            'other'
        ]
    ];
    /**
     * @var
     */
    public $amount;
    /**
     * @var
     */
    public $target_card;


    public $timestamp;

    /**
     * Server has seen the funding
     * @var bool
     */
    public $acknowledged = false;

    /**
     * Transaction constructor.
     * @param $timestamp
     */
    public function __construct()
    {
        $this->timestamp = time();
    }

    /**
     * @return mixed
     */
    public function getActionType()
    {
        return $this->action_type;
    }

    /**
     * @param mixed $action_type
     */
    public function setActionType( $action_type ): void
    {
        if (!in_array($action_type, $this->action_type_allowed, true)){
            throw new InvalidCardTransactionType("Type given '$action_type' is not supported.");
        }
        $this->action_type = $action_type;
    }

    /**
     * @return mixed
     */
    public function getFundType()
    {
        return $this->fund_type;
    }

    /**
     * @param mixed $fund_type
     */
    public function setFundType( $fund_type ): void
    {
        if (!in_array($fund_type, $this->fund_type_allowed, true)){
            throw new InvalidCardTransactionType("Type given '$fund_type' is not supported.");
        }
        $this->fund_type = $fund_type;
    }

    /**
     * @return mixed
     */
    public function getAmount()
    {
        return $this->amount;
    }

    /**
     * @param mixed $amount
     */
    public function setAmount( $amount ): void
    {
        $this->amount = $amount;
    }

    /**
     * @return mixed
     */
    public function getTargetCard()
    {
        return $this->target_card;
    }

    /**
     * @param mixed $target_card
     */
    public function setTargetCard( $target_card ): void
    {
    }

}