<?php

//create class Operation with attributes: type, amount, date, bitcoin
class Operation
{
    private $type;
    private $amount;
    private $date;
    private $bitcoin;
    private $unit_price;

    public function __construct($type, $amount, $date, $bitcoin, $unit_price)
    {
        $this->type = $type;
        $this->amount = $amount;
        $this->date = $date;
        $this->bitcoin = $bitcoin;
        $this->unit_price = $unit_price;
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

    public function getUnitPrice()
    {
        return $this->unit_price;
    }
}
