<?php
require "Algorithm.class.php";
require "DataRetriever.class.php";
Class Analyser {
    private $LastPrices=array();

    public function AddArray(){
        $dtr = new DataRetriever("https://api.binance.com/api/v3/ticker/price");
        $proxy = new ProxyDataRetriever($dtr);

        while(true){
            $data= $proxy->getData();
            $price = $proxy->getPairPrice("BTCUSDT");
            array_push($LastPrices, $price);
            sleep( seconds: 3);
        }

        return $LastPrices;
    }

    public function Analyse($LastPrices){
        $algo = new Algorithm();
        $signal = $algo->getSignal($LastPrices);
        return $signal;
    }

}
?>