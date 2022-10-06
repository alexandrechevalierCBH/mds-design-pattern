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

    public static function canBuy($amount, $qty, $unit_price): bool
    {
        if (self::getBalance() >= $amount) {
            $operation = new Operation('buy', $amount, $qty, '2020-01-01', $unit_price);
            Wallet::feedTempOp($operation);
            return true;
        } else {
            return false;
        }
    }

    public static function getOseille($amount, $qty, $unit_price)
    {
        $operation = new Operation('sell', $amount, $qty, '2020-01-01', $unit_price);
        Wallet::feedTempOp($operation);
    }

    public function createOperation($type, $amount, $qty, $unit_price)
    {
        $operation = new Operation($type, $amount, $qty, '2020-01-01', $unit_price);
        return $operation;
    }
}
