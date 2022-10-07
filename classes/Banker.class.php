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

    public static function canBuy($amount, $bitcoin, $unit_price): bool
    {
        if (self::getBalance() >= $amount) {
            $operation = new Operation('buy', $amount, $bitcoin, date("Y/m/d h:i:s"), $unit_price);
            Wallet::feedTempOp($operation);
            Wallet::testPushDB($operation);
            Wallet::updateBalance($operation);
            return true;
        } else {
            return false;
        }
    }

    public static function getOseille($amount, $bitcoin, $unit_price)
    {
        $operation = new Operation('sell', $amount, $bitcoin, date("Y/m/d h:i:s"), $unit_price);
        Wallet::feedTempOp($operation);
        Wallet::testPushDB($operation);
        Wallet::updateBalance($operation);
    }

    public function createOperation($type, $amount, $bitcoin, $unit_price)
    {
        $operation = new Operation($type, $amount, $bitcoin, date("Y/m/d h:i:s"), $unit_price);
        return $operation;
    }
}
