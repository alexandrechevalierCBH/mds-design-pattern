<?php

require_once 'Wallet.class.php';
class Banker
{


    private function getBalance()
    {
        $balance = Wallet::getBalance();
        echo $balance;
        return $balance;
    }

    private static function canBuy($amount): bool
    {
        if ($this->getBalance() >= $amount) {
            return true;
        } else {
            return false;
        }
    }

    private function getOseille($amount)
    {
    }
}
