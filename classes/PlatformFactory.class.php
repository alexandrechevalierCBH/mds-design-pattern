<?php

require_once 'Platform.class.php';
require_once 'Analyser.class.php';

abstract class PlatformFactory{

    public abstract function createFactory();

}

class BinancePlatformFactory extends PlatformFactory{

    public function createFactory(){
        $trader = new Trader();
        $analyser = new Analyser();
        return new BinancePlatform($trader, $analyser);
    }

}

class BinancePlatform implements Platform {

    private Trader $_trd;
    private Analyser $_anl;

    public function __construct($trd, $anl){
        $this->_trd = $trd;
        $this->_anl = $anl;
    }

    public function getTrader(){
        return $this->_trd;
    }

    public function getAnalyser(){
        return $this->_anl;
    }

    public function Analyse($LastPrice){
        $LastPrice= $this->_anl->AddArray($LastPrice);

        $signal = $this->_anl->Analyse($LastPrice);
        if ($signal == 1){
            echo "J'achéte";
            $size = count($LastPrice);
            $BTCPrice = $LastPrice[$size - 1];
            $this->_trd->buy($BTCPrice, 1,$BTCPrice);
            echo "buy";
        }
        else if ($signal == -1){
            echo "Je vends";
            $size = count($LastPrice);
            $BTCPrice = $LastPrice[$size - 1];
            $this->_trd->sell($BTCPrice, 1,$BTCPrice);
            echo "sell";
        }
        else if ($signal == 0){
            echo "do nothing";
        }
        return $LastPrice;
    }
}