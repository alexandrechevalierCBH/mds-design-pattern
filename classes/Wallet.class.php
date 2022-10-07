<?php

require_once 'DBConnector.class.php';
class Wallet
{

    private $balance;
    private $tempOp = [];

    public function __construct($balance)
    {
        $this->balance = $balance;
    }

    public static function getBalance()
    {
        // get the balance from the database
        $db = DBConnector::getInstance();
        $conn = $db->getConnection();
        $sql = "SELECT * FROM wallet";
        $result = $conn->query($sql);
        $row = $result->fetch_assoc();
        return $row['balance'];
    }

    public static function feedTempOp($object)
    {
        $tempOp = [];
        array_push($tempOp, $object);
        var_dump($tempOp);
    }

    public static function updateBalance($operation)
    {
        //send the operation to the database
        $db = DBConnector::getInstance();
        $conn = $db->getConnection();
        $sql = "INSERT INTO operations (type, amount, bitcoin, date, unit_price) VALUES ('" . $operation->getType() . "', '" . $operation->getAmount() . "', '" . $operation->getbitcoin() . "', '" . $operation->getDate() . "', '" . $operation->getUnitPrice() . "')";
        $conn->query($sql);
        //update the balance in the database
        if ($operation->getType() === 'buy') {
            $sql = "UPDATE wallet SET balance = balance - " . $operation->getAmount();
            $conn->query($sql);
        } else {
            $sql = "UPDATE wallet SET balance = balance + " . $operation->getAmount();
            $conn->query($sql);
        }
    }

    public static function testPushDB($operation)
    {
        //push the operation to the database
        $db = DBConnector::getInstance();
        $conn = $db->getConnection();
        $sql = "INSERT INTO operations (type, amount, bitcoin, date, unit_price) VALUES ('" . $operation->getType() . "', '" . $operation->getAmount() . "', '" . $operation->getbitcoin() . "', '" . $operation->getDate() . "', '" . $operation->getUnitPrice() . "')";
        $conn->query($sql);
    }
}
