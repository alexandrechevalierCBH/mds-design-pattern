<?php
Class ProxyDataRetriever{
    private $dataRetriever;
    private $data = array();
    private int $getLastUpdate;

    public function __construct(DataRetriever $dataRetriever){
        $this->getLastUpdate = 0;
        $this->dataRetriever = $dataRetriever;
    }

    public function getData(){
        if(time() - $this->getLastUpdate > 60){
            $this->data = $this->dataRetriever->getData();
            $this->getLastUpdate = time();
        }
        return $this->data;
    }

    public function getPairPrice($pair){
        return $this->dataRetriever->getPairPrice($pair);
    }
}