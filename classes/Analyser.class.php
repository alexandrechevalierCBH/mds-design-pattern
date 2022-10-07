<?php
require "Algorithm.class.php";
require "DataRetriever.class.php";
include 'proxyDataRetriver.class.php';
Class Analyser {

    private $dtr;
    private $proxy;

    public function __construct(){
        $this->dtr = new DataRetriever("https://api.binance.com/api/v3/ticker/price");
        $this->proxy = new ProxyDataRetriever($this->dtr);
    }


    public function AddArray($ArrayPrice){

        $data= $this->proxy->getData();
        $price = $this->proxy->getPairPrice("BTCUSDT");
        array_push($ArrayPrice, $price);
        return $ArrayPrice;
    }

    public function Analyse($ArrayPrice){
        $algo = new Algorithm();
        $signal = $algo->getSignal($ArrayPrice);
        return $signal;
    }

}
?>