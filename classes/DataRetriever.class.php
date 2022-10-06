<?php

Class DataRetriever{

    private $url;
    private $data = array();

    public function __construct($url){
        $this->url = $url;
    }

    public function getData(){
        $json = file_get_contents($this->url);
        $this->data = json_decode($json,true);
        return $this->data;
    }

    public function getPairPrice($pair){
        foreach ($this->data as $key => $onePair) {
            if($onePair["symbol"] == $pair){
                return $onePair['price'];
            }
        }
    }

}

