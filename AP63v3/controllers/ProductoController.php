<?php

class ProductoController {

    private $gestor;

    public function __construct($gestor) {
        $this->gestor = $gestor;
    }

    public function index() {
        $productos = $this->gestor->listar();
        include "views/listar.php";
    }

    public function crear() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $id = uniqid(); 
            $nombre = $_POST['nombre'];
            $precio = $_POST['precio'];
            $electrica = $_POST['electrica'];

            $producto = new Bici($id, $nombre, $precio, $electrica);
            $this->gestor->agregar($producto);

            header("Location: index.php");
            exit;
        }

        include "views/crear.php";
    }

    public function editar() {
        $id = $_GET['id'] ?? null;
        $producto = $this->gestor->buscar($id);

        if (!$producto) {
            echo "Producto no encontrado";
            exit;
        }

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $this->gestor->actualizar($id, $_POST['nombre'], $_POST['precio'], $_POST['electrica']);
            header("Location: index.php");
            exit;
        }

        include "views/editar.php";
    }

    public function eliminar() {
        $id = $_GET['id'] ?? null;
        $this->gestor->eliminar($id);
        header("Location: index.php");
        exit;
    }
}
