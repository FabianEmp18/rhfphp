<?php
require_once dirname(__DIR__) . '/controlador/productos.php';

$productosController = new productos();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $data = [
        ':id' => $_POST['id'],
        ':name' => $_POST['name'],
        ':description' => $_POST['description'],
        ':price' => $_POST['price'],
        ':category_id' => $_POST['category_id']
    ];

    if ($productosController->update($data)) {
        echo "Producto actualizado con éxito.";
    } else {
        echo "Error al actualizar el producto.";
    }
    exit();
}

if (isset($_GET['id'])) {
    $producto = $productosController->getById($_GET['id']);
    if (!$producto) {
        die("Producto no encontrado.");
    }
} else {
    die("ID no proporcionado.");
}
?>
