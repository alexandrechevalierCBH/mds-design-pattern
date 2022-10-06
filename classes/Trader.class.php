<?php 
require 'Banker.class.php';
class Trader 
{
    protected function buy($amount)
    {
        $bank = Banker::canBuy($amount);
        if ($bank) {
            echo 'I buy crypto';
        }
        else {
            echo 'Not enouth money';
        }
    }

    protected function sell($amount)
    {
        $bank = Banker::getOseille($amount);
        echo 'Je vend de la crypto';

    }
}
?>