<?php

class Bank {
    private Wallet $wallet;

    public function __construct(){
        $this->wallet = new Wallet();
    }

    public function getWallet(){
        return $this->wallet;
    }

    public function getBalance()
    {
    }

    public function getBitcoin()
    {      
    }


}

?>