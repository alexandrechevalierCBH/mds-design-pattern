<?php 
require 'Banker.class.php';
class Trader 
{
    public function buy($amount, $qty)
    {
        $bank = Banker::canBuy($amount, $qty);
        if ($bank) {
            echo 'I buy crypto' . '<br/>';
        }
        else {
            echo 'Not enouth money';
        }
    }

    public function sell($amount, $qty)
    {
        $bank = Banker::getOseille($amount, $qty);
        echo 'Je vend de la crypto';

    }
}
