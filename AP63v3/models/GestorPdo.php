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

        $consulta = "INSERT INTO bici (nombre, precio, electrica) VALUES (:nombre, :precio, :electrica)";

        $stmt = $this->conn->prepare($consulta);

        $stmt->bindValue(':nombre', $p->getNombre());
        $stmt->bindValue(':precio', $p->getPrecio());
        $stmt->bindValue(':electrica', $p->getElectrica());

        $stmt->execute();

        return $stmt;
    }

    public function eliminar($id){
        $consulta = "DELETE FROM bici WHERE id=:id";
        $stmt=$this->conn->prepare($consulta);
        $stmt->bindValue(':id', $id);
        $stmt ->execute();
        return $stmt;
    }

    public function editar(){
        
    }

}
