<?php

class GestorPDO extends Connection{

    public function __construct() {
        parent::__construct();
    }

    public function listar() {
        $consulta="SELECT * FROM bici";
        $rtdo=$this->conn->query($consulta);
        $arrayBici=[];
        while ($value = $rtdo->fetch(PDO::FETCH_ASSOC)){
            $bici = new Bici($value['nombre'], $value['precio'], $value['electrica'], $value['id']);
            $arrayBici[]=$bici;
        }
        return $arrayBici;
    }
    public function agregar(Bici $bici) {
        try {
            $sql = "INSERT INTO bici (nombre, precio, electrica) VALUES (:nombre, :precio, :electrica)";
            $stmt = $this->conn->prepare($sql);

            $stmt->bindValue(':nombre', $bici->getNombre());
            $stmt->bindValue(':precio', $bici->getPrecio());
            $stmt->bindValue(':electrica', $bici->getElectrica());

            // Ejecutamos
            return $stmt->execute(); 
            
        } catch (PDOException $e) {
            //código que quiera para mostrar
            return false;
        }
    }
    //cambiar a bind
    public function buscar($id) {
        $sql="SELECT * FROM bici WHERE id=$id";
        $stmt=$this->conn->query($sql);
 
        while ($value = $stmt->fetch(PDO::FETCH_ASSOC)){
            $bici = new Bici($value['nombre'], $value['precio'], $value['electrica'], $value['id']);
        }
        return $bici;
    }

    //cambiar a bind
    public function actualizar($producto) {

    $sql="UPDATE bici SET nombre=:nombre, precio=:precio, electrica=:electrica WHERE id=:id";
        $stmt=$this->conn->prepare($sql);
        $stmt->bindValue(':nombre',$producto->getNombre());
        $stmt->bindValue(':precio',$producto->getPrecio());
        $stmt->bindValue(':electrica',$producto->getElectrica());
        $stmt->bindValue(':id',$producto->getId());
        return $stmt->execute();
    }

    public function eliminar($id) {
        $sql="DELETE FROM bici WHERE id=:id";
        $stmt=$this->conn->prepare($sql);
        $stmt->bindValue(':id',$id);
        return $stmt->execute();
    }

    //Gestión de usuarios
    public function registrarUsuario(Usuario $usuario) {
        try {
            $sql = "INSERT INTO Usuario (email, password) VALUES (:email, :password)";
            $stmt = $this->conn->prepare($sql);

            // Usamos los getters del objeto
            $stmt->bindValue(':email', $usuario->getEmail());
            $stmt->bindValue(':password', $usuario->getPassword());

            return $stmt->execute(); 
            
        } catch (PDOException $e) {
            echo $e->getMessage() . $e->getCode();
        }
    }
    public function buscarUsuarioPorEmail($email) {
        $sql = "SELECT * FROM Usuario WHERE email = :email LIMIT 1";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindValue(':email', $email);
        $stmt->execute();

        $value = $stmt->fetch(PDO::FETCH_ASSOC);
        
        // Si encontró algo, creamos y devolvemos el objeto Usuario
        if ($value) {
            return new Usuario($value['email'], $value['password'], $value['id']);
        }
        // Si no existe, devolvemos false o null
        return false;
    }


}
