<?php

require_once 'classes/DBConnector.class.php';
//require wallet class
require_once 'classes/Wallet.class.php';
require_once 'classes/Trader.class.php';
require_once 'classes/PlatformFactory.class.php';




$LastPrice= array();

$db = DBConnector::getInstance()->getConnection();
$balance = Wallet::getBalance();
/*
$testbuy = new Trader();
$testbuy->buy(5005, 1, 20000.34);

$testbuy->buy(4000, 1, 20001.45);*/


$Platform = new BinancePlatformFactory();
$Platform = $Platform->createFactory();

while(true){
    $LastPrice = $Platform->Analyse($LastPrice);
    print_r($LastPrice);
    sleep( seconds: 10);
}