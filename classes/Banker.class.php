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

    /**
     * If the user has enough money, create a new operation object and add it to the buffer
     * 
     * @param amount the amount of bitcoin you want to buy
     * @param bitcoin the amount of bitcoin you want to buy
     * 
     * @return bool A boolean value.
     */
    public static function canBuy($amount, $bitcoin): bool
    {
        if (self::getBalance() >= $amount) {
            $unit_price = $amount / $bitcoin;
            $operation = new Operation('buy', $amount, $bitcoin, date("Y/m/d h:i:s"), $unit_price);
            self::bufferOperation($operation);
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
    }

    public function createOperation($type, $amount, $bitcoin, $unit_price)
    {
        $operation = new Operation($type, $amount, $bitcoin, date("Y/m/d h:i:s"), $unit_price);
        return $operation;
    }

    /**
     * It pushes an operation to the buffer, and if the buffer is full, it sends it to the database
     * 
     * @param operation the operation to be buffered
     */
    public static function bufferOperation($operation)
    {
        array_push(self::$operations_buffer, $operation);
        echo "Operation mise en buffer" . "\n";
        if (count(self::$operations_buffer) >= 10) {
            Wallet::testPushDB(self::$operations_buffer);
            echo "Buffer envoyé à la DB" . "\n";
            self::$operations_buffer = array();
        }
    }
}
