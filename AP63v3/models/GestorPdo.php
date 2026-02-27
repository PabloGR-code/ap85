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
            $bici=new Bici($value["id"], $value["nombre"], $value["precio"], $value["electrica"]);
            $arraybici[]=$bici;
        }
        return $arraybici;

    }

}
