<?php

require_once 'Wallet.class.php';
require_once 'Operation.class.php';
class Banker
{
    public static function getBalance()
    {
        $balance = Wallet::getBalance();
        return $balance;
    }

    public static function canBuy($amount, $qty): bool
    {
        if (self::getBalance() >= $amount) {
            $operation = new Operation('buy', $amount, $qty, '2020-01-01');
            Wallet::feedTempOp($operation);
            return true;
        } else {
            return false;
        }
    }

    public static function getOseille($amount)
    {
        //
    }

    public function createOperation($type, $amount, $qty)
    {
        $operation = new Operation($type, $amount, $qty, '2020-01-01');
        return $operation;
    }
}
