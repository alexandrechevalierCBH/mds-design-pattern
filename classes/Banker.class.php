<?php

require_once 'Wallet.class.php';
class Banker
{


    public function getBalance()
    {
        $balance = Wallet::getBalance();
        echo $balance;
        return $balance;
    }

    public static function canBuy($amount): bool
    {
        if (self::getBalance() >= $amount) {
            return true;
        } else {
            return false;
        }
    }

    public function getOseille($amount)
    {
    }
}
