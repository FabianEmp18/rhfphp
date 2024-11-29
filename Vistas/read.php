<?php
require_once '../modelo/Database.php';
require_once '../controlador/productos.php';

$database = new Database();
$db = $database->getConnection();
$productos = new productos($db);

$data = $productos->read();

echo '<!DOCTYPE html>';
echo '<html lang="es">';
echo '<head>';
echo '    <meta charset="UTF-8">';
echo '    <title>Gestión de Productos</title>';
echo '    <link rel="stylesheet" href="../css/styles.css">';
echo '</head>';
echo '<body>';
echo '    <div class="container">';
echo '        <h1>Gestión de Productos</h1>';
echo '        <a href="../alta.php" class="btn btn-primary">Crear Nuevo Producto</a>';
echo '        <a href="../cerrar_sesion.php" class="btn btn-danger">Cerrar Sesión</a>';

echo '        <table>';
echo '            <tr>';
echo '                <th>ID</th>';
echo '                <th>Nombre</th>';
echo '                <th>Descripción</th>';
echo '                <th>Precio</th>';
echo '                <th>Acciones</th>';
echo '            </tr>';

foreach ($data as $producto) {
    echo '            <tr>';
    echo '                <td>' . htmlspecialchars($producto['id']) . '</td>';
    echo '                <td>' . htmlspecialchars($producto['name']) . '</td>';
    echo '                <td>' . htmlspecialchars($producto['description']) . '</td>';
    echo '                <td>' . htmlspecialchars($producto['price']) . '</td>';
    echo '                <td>';
    echo '                    <form action="../vista/delete.php" method="post" style="display:inline;">';
    echo '                        <input type="hidden" name="id" value="' . htmlspecialchars($producto['id']) . '">';
    echo '                        <button type="submit" class="btn btn-danger">Eliminar</button>';
    echo '                    </form>';
    echo '                    <a href="../modificar.php?id=' . htmlspecialchars($producto['id']) . '" class="btn btn-warning">Editar</a>';
    echo '                </td>';
    echo '            </tr>';
}

echo '        </table>';
echo '    </div>';
echo '</body>';
echo '</html>';
?>
