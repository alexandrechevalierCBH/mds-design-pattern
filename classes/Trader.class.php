<?php 
class Trader 
{
    protected function buy($amount)
    {
        $bank = New Banker::canBuy($amount);
        if ($bank) {
            echo 'I buy money';
        }
        else {
            echo 'Not enouth money';
        }
    }

    protected function sell($amout)
    {
        $bank = New Banker::getOseille($amount);
        echo 'Je vend de la crypto';

    }
}
?>