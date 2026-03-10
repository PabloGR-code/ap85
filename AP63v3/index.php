<?php
require_once "autoload.php";
session_start();

$gestor=new GestorPDO();
$productoController = new ProductoController($gestor);
$usuarioController = new UsuarioController($gestor);

$accion = $_GET['accion'] ?? 'index';

switch ($accion) {
    //Acciones del usuario
    case 'login':
        $usuarioController->login();
        break;
    case 'registro':
        $usuarioController->registro();
        break;
    case 'logout':
        $usuarioController->logout();
        break;
    //Acciones del negocio. Técnica fall-through
    case 'crear':
    case 'editar':
    case 'eliminar':
        if (!isset($_SESSION['usuario_id'])) {
            header('Location: index.php?accion=login');
            exit;
        }
        // Si está autenticado, dejamos que ejecute la acción
        if ($accion === 'crear') $productoController->crear();
        if ($accion === 'editar') $productoController->editar();
        if ($accion === 'eliminar') $productoController->eliminar();
        break;
    default:
        $productoController->index();
}
