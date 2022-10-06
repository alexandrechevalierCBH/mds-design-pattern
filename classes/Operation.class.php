<?php

//create class Operation with attributes: type, amount, date, bitcoin
class Operation
{
    private $type;
    private $amount;
    private $date;
    private $bitcoin;

    public function __construct($type, $amount, $date, $bitcoin)
    {
        $this->type = $type;
        $this->amount = $amount;
        $this->date = $date;
        $this->bitcoin = $bitcoin;
    }

    public function getType()
    {
        return $this->type;
    }

    public function getAmount()
    {
        return $this->amount;
    }

    public function getDate()
    {
        return $this->date;
    }

    public function getbitcoin()
    {
        return $this->bitcoin;
    }
}
