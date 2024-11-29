<?php
session_start();
require_once 'modelo/Database.php';
require_once 'controlador/productos.php';

$database = new Database();
$db = $database->getConnection();
$productos = new productos($db);

if (isset($_GET['id'])) {
    $productos->id = $_GET['id'];
    
    if ($productos->delete()) {
        $_SESSION['message'] = "Producto eliminado correctamente.";
        $_SESSION['message_type'] = "success";
    } else {
        $_SESSION['message'] = "Error al eliminar el Producto.";
        $_SESSION['message_type'] = "error";
    }
    header('Location: index.php');
    exit;
} else {
    echo "ID no proporcionado.";
}
