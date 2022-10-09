<?php

require_once 'DBConnector.class.php';
require_once 'Operation.class.php';

class Wallet
{

    private float $balance;
    private float $bitcoin;

    public function __construct()
    {
    }

    public function getBalance()
    {
        // get the balance from the database
        $db = DBConnector::getInstance();
        $conn = $db->getConnection();
        $sql = "SELECT * FROM wallet";
        $result = $conn->query($sql);
        $row = $result->fetch_assoc();
        return $row['balance'];
    }

    public function getBddBitcoin()
    {
        // get the bitcoin qty from the database
        $db = DBConnector::getInstance();
        $conn = $db->getConnection();
        $sql = "SELECT * FROM wallet";
        $result = $conn->query($sql);
        $row = $result->fetch_assoc();
        return $row['bitcoin'];
    }

    public static function updateWallet($operation)
    {
        //send the operation to the database
        $db = DBConnector::getInstance();
        $conn = $db->getConnection();
        if ($operation->getType() === 'buy') {
            $sql = "UPDATE wallet SET balance = balance - " . $operation->getAmount();
            $conn->query($sql);
            $sql = "UPDATE wallet SET bitcoins = bitcoins + " . $operation->getbitcoin();
            $conn->query($sql);
        } else {
            $sql = "UPDATE wallet SET balance = balance + " . $operation->getAmount();
            $conn->query($sql);
            $sql = "UPDATE wallet SET bitcoins = bitcoins - " . $operation->getbitcoin();
            $conn->query($sql);
        }
    }

    public function testPushDB($operations_buffer)
    {
        foreach ($operations_buffer as $operation) {
            self::updateWallet($operation);
            $db = DBConnector::getInstance();
            $conn = $db->getConnection();
            $sql = "INSERT INTO operations (type, amount, bitcoin, date, unit_price) 
            VALUES ('" . $operation->getType() . "', '" . $operation->getAmount() . 
            "', '" . $operation->getbitcoin() . "', '" . $operation->getDate() . "', '" . 
            $operation->getUnitPrice() . "')";
            $conn->query($sql);
        }
    }
}
