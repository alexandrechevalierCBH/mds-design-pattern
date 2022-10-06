<?php

require_once 'DBConnector.class.php';
class Wallet
{

    private $balance;

    public function __construct($balance)
    {
        $this->balance = $balance;
    }

    public static function getBalance()
    {
        // get the balance from the database
        $db = DBConnector::getInstance();
        $conn = $db->getConnection();
        $sql = "SELECT * FROM balance";
        $result = $conn->query($sql);
        $row = $result->fetch_assoc();
        return $row['balance'];
    }
}
