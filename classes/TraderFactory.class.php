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
        $bank = Banker::getOseille($amount, $qty, $unit_price);
        echo 'Je vend de la crypto';
    }
}
