<?php
require "Algorithm.class.php";
require "DataRetriever.class.php";
Class Analyser {

    public function AddArray($ArrayPrice){
        $dtr = new DataRetriever("https://api.binance.com/api/v3/ticker/price");
        $proxy = new ProxyDataRetriever($dtr);

        while(true){
            $data= $proxy->getData();
            $price = $proxy->getPairPrice("BTCUSDT");
            array_push($ArrayPrice, $price);
            sleep( seconds: 3);
        }

        return $ArrayPrice;
    }

    public function Analyse($ArrayPrice){
        $algo = new Algorithm();
        $signal = $algo->getSignal($ArrayPrice);
        return $signal;
    }

}
?>