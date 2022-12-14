<?php

require_once 'Wallet.class.php';
require_once 'Operation.class.php';
require_once 'Bank.class.php';

class Banker extends Bank
{
    // set an array where we will store the operations
    private static $operations_buffer = array();
    private Wallet $wallet;

    public function __construct(){
        $this->wallet = new Wallet();
    }

    public function canBuy($amount, $bitcoin): bool
    {
        if ($this->wallet->getBalance() >= $amount) {
            $unit_price = $amount / $bitcoin;
            $operation = new Operation('buy', $amount, $bitcoin, date("Y/m/d h:i:s"), $unit_price);
            self::bufferOperation($operation);
            return true;
        } else {
            return false; 
        }
    }

    public function getOseille($amount, $bitcoin)
    {
        $unit_price = $amount / $bitcoin;
        $operation = new Operation('sell', $amount, $bitcoin, date("Y/m/d h:i:s"), $unit_price);
        self::bufferOperation($operation);
    }

    public function createOperation($type, $amount, $bitcoin, $unit_price)
    {
        $operation = new Operation($type, $amount, $bitcoin, date("Y/m/d h:i:s"), $unit_price);
        return $operation;
    }

    public function bufferOperation($operation)
    {
        array_push(self::$operations_buffer, $operation);
        if (count(self::$operations_buffer) >= 10) {
            $this->wallet->testPushDB(self::$operations_buffer);
            echo "------------- Buffer envoyé à la DB -------------"."\n";
            self::$operations_buffer = array();
        }
    }
}