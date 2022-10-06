<?php

require_once 'Wallet.class.php';
class Banker
{


    public static function getBalance()
    {
        $balance = Wallet::getBalance();
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

    public static function getOseille($amount)
    {
    }
}
