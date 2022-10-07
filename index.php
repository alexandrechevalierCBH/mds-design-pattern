<?php

require_once 'classes/DBConnector.class.php';
require_once 'classes/Wallet.class.php';
require_once 'classes/Trader.class.php';


$db = DBConnector::getInstance()->getConnection();
$balance = Wallet::getBalance();

$testbuy = new Trader();

//$testbuy->buy(4000, 1, 4000);
$testbuy->sell(100000, 1, 100000);
