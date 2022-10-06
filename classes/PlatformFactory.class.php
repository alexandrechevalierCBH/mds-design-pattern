<?php

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

}