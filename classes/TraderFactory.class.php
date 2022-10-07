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
            echo "Super ! J'ai acheté $qty crypto à " . round($unit_price,2) . "€ l'unité. J'ai investi " . round($amount,2) . "€ :("."\n";
        } else {
            echo "Je n'ai pas d'argent"."\n";
        }
    }

    public function sell($amount, $qty, $unit_price)
    {
        //send the operation to the database
        $db = DBConnector::getInstance();
        $conn = $db->getConnection();
        $sql = "SElECT * FROM `operations` WHERE `type` = 'buy' AND `unit_price` < '$unit_price'"."\n";
        $result = $conn->query($sql);
        $result= mysqli_num_rows($result);
        if ($result == 0) {
            echo "Je ne vends pas, je suis raisonnable j'ai achété nada en dessous du prix"."\n";
        } else {
            $bank = Banker::getOseille($amount*$result, $qty*$result, $unit_price);
            echo "Super ! J'ai vendu " . $result*$qty . " crypto à ". round($unit_price,2) ."€ l'unité. J'ai gagné " . round($amount*$result,2) ."€"."\n";
        }

    }
}
