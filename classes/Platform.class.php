<?php
Class Platform {
    private $_nom;
    private $_link;

    public function __construct($nom, $link)
    {
        $this->_nom = $nom;
        $this->_link = $link;
    }

    public function getNom(){
        return $this->_nom;
    }

    public function getLink(){
        return $this->_link;
    }

}
?>