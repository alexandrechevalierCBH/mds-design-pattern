<?php

abstract class TraderFactory{
    public abstract function createTrader();
}

class BinanceTraderFactory extends TraderFactory {
    public function createTrader()
    {
        return new BinanceTrader();
    }
}

class BinanceTrader extends Trader
{
    public function buy($amount, $qty, $unit_price)
    {
        $bank = Banker::canBuy($amount, $qty, $unit_price);
        if ($bank) {
            echo 'I buy crypto' . '<br/>';
        } else {
            echo 'Not enouth money';
        }
    }

    public function sell($amount, $qty, $unit_price)
    {
        //send the operation to the database
        $db = DBConnector::getInstance();
        $conn = $db->getConnection();
        $sql = "SElECT * FROM `operations` WHERE `type` = 'buy' AND `unit_price` < '$unit_price'";
        $result = $conn->query($sql);
        $result= mysqli_num_rows($result);
        echo($result);
        if ($result == 0) {
            echo "Je ne vends pas, je suis raisonnable j'ai achété nada en dessous du prix";
        } else {
            $bank = Banker::getOseille($amount*$result, $qty*$result, $unit_price);
            echo 'Je vend de la crypto';
        }

    }
}
