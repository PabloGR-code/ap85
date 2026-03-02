<?php

class GestorPdo extends Connection{

    public function __construct() {
        parent::__construct();
    }

    public function listar() {
        $consulta="SELECT * FROM bici";
        $stmt=$this->conn->query($consulta);
        $arraybici=[];
        while($value=$stmt->fetch(PDO::FETCH_ASSOC)){
            $bici=new Bici($value["nombre"], $value["precio"], $value["electrica"], $value["id"]);
            $arraybici[]=$bici;
        }
        return $arraybici;

    }

    public function agregar(Bici $p){
        $nombre=$p->getNombre();
        $precio=$p->getPrecio();
        $electrica=$p->getElectrica();
        $consulta="INSERT INTO bici (nombre, precio, electrica) VALUES ($nombre, $precio, $electrica)";
        $stmt=$this->conn->exec($consulta); //se pone exec con insert, update, delete
        return $stmt;
    }

}
