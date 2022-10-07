<?php

require_once 'DBConnector.class.php';
require_once 'Operation.class.php';

class Wallet
{

    private float $balance;
    private float $bitcoin;

    public function __construct($balance)
    {
        if (!file_exists('wallet.json')) {
            $this->balance = self::getBalance();
            $this->bitcoin = self::getBitcoin();
            $this->save();
        } else {
            $this->load();
        }
    }

    // Function to save the wallet into a json file
    public function save()
    {
        $wallet = array(
            "balance" => $this->balance,
            "bitcoin" => $this->bitcoin
        );

        $json = json_encode($wallet);
        file_put_contents("wallet.json", $json);
    }

    // Function to load the wallet from a file
    public function load()
    {
        $json = file_get_contents("wallet.json");
        $wallet = json_decode($json, true);

        $this->balance = $wallet["balance"];
        $this->bitcoin = $wallet["bitcoin"];
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

    public static function getbitcoin()
    {
        // get the bitcoin qty from the database
        $db = DBConnector::getInstance();
        $conn = $db->getConnection();
        $sql = "SELECT * FROM wallet";
        $result = $conn->query($sql);
        $row = $result->fetch_assoc();
        return $row['bitcoin'];
    }

    public static function feedTempOp($object)
    {
        $tempOp = [];
        array_push($tempOp, $object);
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
            $sql = "UPDATE wallet SET bitcoins = bitcoins + " . $operation->getbitcoin();
            $conn->query($sql);
        } else {
            $sql = "UPDATE wallet SET balance = balance + " . $operation->getAmount();
            $conn->query($sql);
            $sql = "UPDATE wallet SET bitcoins = bitcoins - " . $operation->getbitcoin();
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
