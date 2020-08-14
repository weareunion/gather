<?php


namespace Union\API\datatypes;


class StaffRank
{
    public $user_rank = [
        "Read Only", "Employee", "Manager", "Owner"
    ];
    public $rank;

    public function __construct($rank)
    {
        $this->setRank($rank);
    }

    /**
     * @return mixed
     */
    public function getRank()
    {
        return $this->rank;
    }

    /**
     * @param mixed $rank
     */
    public function setRank($rank)
    {
        $this->rank = $rank;
    }

    public function __toString()
    {
        $this->rank = abs($this->rank);
        if ($this->rank > sizeof($this->user_rank)-1){
            return 'Owner';
        }
        return "" . $this->user_rank[$this->rank];
    }
}