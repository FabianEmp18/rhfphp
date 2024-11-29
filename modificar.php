<?php
session_start();
require_once 'modelo/Database.php';
require_once 'controlador/productos.php';

$database = new Database();
$db = $database->getConnection();
$productos = new productos($db);

if (isset($_GET['id'])) {
    $productos->id = $_GET['id'];
    $producto = $productos->readOne();

    if (!$producto) {
        echo "Producto no encontrado.";
        exit;
    }
} else {
    echo "ID no proporcionado.";
    exit;
}

if ($_POST) {
    $productos->id = $_POST['id'];
    $productos->name = $_POST['name'];
    $productos->description = $_POST['description'];
    $productos->price = $_POST['price'];

    if ($productos->update()) {
        $_SESSION['message'] = "Producto modificado correctamente.";
        $_SESSION['message_type'] = "success";
        header('Location: index.php');
        exit;
    } else {
        $_SESSION['message'] = "Error al actualizar el producto.";
        $_SESSION['message_type'] = "error";
    }
}

echo '<!DOCTYPE html>';
echo '<html lang="es">';
echo '<head>';
echo '    <meta charset="UTF-8">';
echo '    <title>Modificar Producto</title>';
echo '    <link rel="stylesheet" href="css/styles.css">';
echo '</head>';
echo '<body>';

echo '    <div class="container">';
echo '        <h1>Modificar Producto</h1>';
echo '        <form method="post" class="form-wrapper">';
echo '            <input type="hidden" name="id" value="' . htmlspecialchars($producto['id']) . '">';
            
echo '            <label for="name">Nombre:</label>';
echo '            <input type="text" name="name" value="' . htmlspecialchars($producto['name']) . '" required>';

echo '            <label for="description">Descripción:</label>';
echo '            <input type="text" name="description" value="' . htmlspecialchars($producto['description']) . '" required>';

echo '            <label for="price">Precio:</label>';
echo '            <input type="number" name="price" value="' . htmlspecialchars($producto['price']) . '" required>';

echo '            <div class="actions">';
echo '                <button type="submit" class="btn btn-primary">Actualizar</button>';
echo '                <a href="index.php" class="btn btn-secondary">Volver</a>';
echo '            </div>';
echo '        </form>';
echo '    </div>';

echo '</body>';
echo '</html>';
?>
