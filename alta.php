<?php
session_start();
require_once 'modelo/Database.php';
require_once 'controlador/productos.php';

$database = new Database();
$db = $database->getConnection();
$productos = new productos($db);

if ($_POST) {
    $productos->name = $_POST['name'];
    $productos->description = $_POST['description'];
    $productos->price = $_POST['price'];

    if ($productos->create()) {
        $_SESSION['message'] = "Producto creado exitosamente.";
        $_SESSION['message_type'] = "success";
    } else {
        $_SESSION['message'] = "Error al crear el producto.";
        $_SESSION['message_type'] = "error";
    }
    header('Location: index.php');
    exit;
}

echo '<!DOCTYPE html>';
echo '<html lang="es">';
echo '<head>';
echo '    <meta charset="UTF-8">';
echo '    <title>Crear Producto</title>';
echo '    <link rel="stylesheet" href="css/styles.css">';
echo '</head>';
echo '<body>';
echo '    <div class="container">';
echo '        <h1>Crear Nuevo Producto</h1>';
echo '        <form method="post" class="form-wrapper">';
echo '            <label for="name">Nombre:</label>';
echo '            <input type="text" name="name" required>';

echo '            <label for="description">Descripción:</label>';
echo '            <input type="text" name="description" required>';

echo '            <label for="price">Precio:</label>';
echo '            <input type="number" name="price" required>';

echo '            <div class="actions">';
echo '                <button type="submit" class="btn btn-primary">Crear</button>';
echo '                <a href="index.php" class="btn btn-secondary">Volver</a>';
echo '            </div>';
echo '        </form>';
echo '    </div>';
echo '</body>';
echo '</html>';
?>
