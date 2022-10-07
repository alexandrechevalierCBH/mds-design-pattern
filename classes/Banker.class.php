<?php

require_once 'Wallet.class.php';
require_once 'Operation.class.php';
class Banker
{
    // set an array where we will store the operations
    private static $operations_buffer = array();

    public static function getBalance()
    {
        $balance = Wallet::getBalance();
        return $balance;
    }

    public static function getBitcoin()
    {
        $bitcoin = Wallet::getBitcoin();
        return $bitcoin;
    }

    public static function canBuy($amount, $bitcoin): bool
    {
        if (self::getBalance() >= $amount) {
            $unit_price = $amount / $bitcoin;
            $operation = new Operation('buy', $amount, $bitcoin, date("Y/m/d h:i:s"), $unit_price);
            self::bufferOperation($operation);
            // Wallet::testPushDB($operation);
            // Wallet::updateWallet($operation);
            return true;
        } else {
            return false;
        }
    }

    public static function getOseille($amount, $bitcoin)
    {
        $unit_price = $amount / $bitcoin;
        $operation = new Operation('sell', $amount, $bitcoin, date("Y/m/d h:i:s"), $unit_price);
        self::bufferOperation($operation);
        // Wallet::testPushDB($operation);
        // Wallet::updateWallet($operation);
    }

    public function createOperation($type, $amount, $bitcoin, $unit_price)
    {
        $operation = new Operation($type, $amount, $bitcoin, date("Y/m/d h:i:s"), $unit_price);
        return $operation;
    }

    public static function bufferOperation($operation)
    {
        array_push(self::$operations_buffer, $operation);
        print_r(self::$operations_buffer);
        if (count(self::$operations_buffer) >= 10) {
            Wallet::testPushDB(self::$operations_buffer);
            self::$operations_buffer = array();
        }
    }
}
