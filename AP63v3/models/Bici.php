<?php

class Bici extends Producto{
    private $electrica;

    function __construct($nombre, $precio, $electrica, $id=0){
        parent::__construct($id, $nombre, $precio);
        $this->electrica=$electrica;
    }

    public function getElectrica()
    {
        return $this->electrica;
        
    }

    public function setElectrica($electrica)
    {
        $this->electrica = $electrica;
    }
}