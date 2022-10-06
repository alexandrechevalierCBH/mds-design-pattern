<?php

require_once 'classes/DBConnector.class.php';
//require wallet class
require_once 'classes/Wallet.class.php';

$db = DBConnector::getInstance()->getConnection();
$balance = Wallet::getBalance();
echo $balance;
