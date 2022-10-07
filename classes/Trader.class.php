<?php
require 'Banker.class.php';
class Trader
{
    public function buy($amount, $bitcoin, $unit_price)
    {
        $bank = Banker::canBuy($amount, $bitcoin, $unit_price);
        if ($bank) {
            echo 'I buy crypto' . '<br/>';
        } else {
            echo 'Not enouth money';
        }
    }

    public function sell($amount, $bitcoin, $unit_price)
    {
        $bank = Banker::getOseille($amount, $bitcoin, $unit_price);
        echo 'Je vend de la crypto';
    }
}
