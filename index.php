<?php

require_once 'classes/DBConnector.class.php';
//require wallet class
require_once 'classes/Wallet.class.php';
require_once 'classes/Trader.class.php';


$db = DBConnector::getInstance()->getConnection();
$balance = Wallet::getBalance();

$testbuy = new Trader();
$testbuy->buy(5005, 1, 20000.34);

$testbuy->buy(4000, 1, 20001.45);
