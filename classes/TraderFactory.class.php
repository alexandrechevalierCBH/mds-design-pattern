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
        $bank = new Banker;
        $bank->canBuy($amount, $qty, $unit_price);
        if ($bank) {
            echo "Achat de $qty BTC au prix de " . round($unit_price,2) . "€ l'unité. Prix total : " . round($amount,2) . "€"."\n";
        } else {
            echo "Fonds insuffisants"."\n";
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
        var_dump($result);
        if ($result == 0) {
            echo "Tendance à la vente mais pas de profits réalisables"."\n";
        } else {
            $bank = new Banker;
            $bank->getOseille($amount*$result, $qty*$result, $unit_price);
            echo "Vente de " . $result*$qty . " BTC pour ". round($unit_price,2) .
            "€ l'unité. J'ai gagné " . round($amount*$result,2) ."€"."\n";
            $sql = "UPDATE `operations` SET `type` = 'sale' WHERE `type` = 'buy' AND `unit_price` < '$unit_price'"."\n";
            $result = $conn->query($sql);
        }

    }
}
