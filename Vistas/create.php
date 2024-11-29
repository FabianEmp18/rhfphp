<?php
require_once dirname(__DIR__) . '/controlador/productos.php';

$productosController = new productos();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $data = [
        ':name' => $_POST['name'],
        ':description' => $_POST['description'],
        ':price' => $_POST['price'],
        ':category_id' => $_POST['category_id']
    ];

    if ($productosController->create($data)) {
        echo "Producto creado con éxito.";
    } else {
        echo "Error al crear el producto.";
    }
    exit();
}
?>
