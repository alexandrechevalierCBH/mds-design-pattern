<?php
class Algorithm
{
    //Constructor
    public function __construct()
    {
    }

    // getSignal : if the signal is 1, we buy, if the signal is -1, we sell, if the signal is 0, we do nothing
    public function getSignal($arrayPrices)
    {
        // size of the array
        $size = count($arrayPrices);

        // if the size is less than 10, return 0
        if ($size < 10) {
            return 0;
        }

        $sum = 0;
        for ($i = 0; $i < $size-1; $i++) {
            $sum += $arrayPrices[$i];
        }

        $average = $sum / ($size - 1);

        //BUY
        if ($arrayPrices[$size - 1] > $average ) {
            return 1;
        }

        //SELL
        if ($arrayPrices[$size - 1] < $average) {
            return -1;
        }

        return 0;
    }
}
?>