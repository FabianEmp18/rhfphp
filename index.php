<?php
session_start();

if (!isset($_SESSION['loggedin'])) {
    header('Location: login.php');
    exit;
}

require_once 'modelo/Database.php';
require_once 'controlador/productos.php';

$database = new Database();
$db = $database->getConnection();
$productos = new productos($db);

// Consultar la tabla de usuarios
$query_users = "SELECT * FROM users";
$stmt_users = $db->prepare($query_users);
$stmt_users->execute();
$users_data = $stmt_users->fetchAll(PDO::FETCH_ASSOC);

// Consultar la tabla de contactos
$query_contacts = "SELECT * FROM contacts";
$stmt_contacts = $db->prepare($query_contacts);
$stmt_contacts->execute();
$contacts_data = $stmt_contacts->fetchAll(PDO::FETCH_ASSOC);

// Lógica de eliminación de productos
if (isset($_GET['delete_id'])) {
    $productos->id = $_GET['delete_id'];
    if ($productos->delete()) {
        $_SESSION['message'] = "El producto se ha eliminado correctamente.";
        $_SESSION['message_type'] = "success";
        header('Location: index.php');
        exit;
    } else {
        $_SESSION['message'] = "Error al eliminar el producto.";
        $_SESSION['message_type'] = "error";
        header('Location: index.php');
        exit;
    }
}

$productos_data = $productos->read();

echo '<!DOCTYPE html>';
echo '<html lang="es">';
echo '<head>';
echo '    <meta charset="UTF-8">';
echo '    <title>Gestión de Productos, Usuarios y Contactos</title>';
echo '    <link rel="stylesheet" href="css/styles.css">';
echo '</head>';
echo '<body>';

if (isset($_SESSION['message'])) {
    echo '<div class="modal-overlay">';
    echo '    <div class="modal-content ' . $_SESSION['message_type'] . '">';
    echo '        <span class="close-btn">&times;</span>';
    echo '        <p>' . $_SESSION['message'] . '</p>';
    echo '    </div>';
    echo '</div>';
    unset($_SESSION['message']);
    unset($_SESSION['message_type']);
}

echo '<div class="container">';
echo '    <h1>Gestión de Productos, Usuarios y Contactos</h1>';

echo '    <div class="header-buttons">';
echo '        <a href="alta.php" class="btn btn-primary">Crear Nuevo Producto</a>';
echo '        <a href="cerrar_sesion.php" class="btn btn-danger">Cerrar Sesión</a>';
echo '    </div>';

echo '    <h2>Lista de Productos</h2>';
echo '    <table>';
echo '        <tr>';
echo '            <th>ID</th>';
echo '            <th>Nombre</th>';
echo '            <th>Descripción</th>';
echo '            <th>Precio</th>';
echo '            <th>Acciones</th>';
echo '        </tr>';

foreach ($productos_data as $producto) {
    echo '<tr>';
    echo '    <td>' . $producto['id'] . '</td>';
    echo '    <td>' . $producto['name'] . '</td>';
    echo '    <td>' . $producto['description'] . '</td>';
    echo '    <td>' . $producto['price'] . '</td>';
    echo '    <td class="table-actions">';
    echo '        <a href="modificar.php?id=' . $producto['id'] . '" class="btn btn-warning">Modificar</a>';
    echo '        <a href="index.php?delete_id=' . $producto['id'] . '" class="btn btn-danger">Eliminar</a>';
    echo '    </td>';
    echo '</tr>';
}

echo '    </table>';

echo '    <h2>Lista de Usuarios</h2>';
echo '    <table>';
echo '        <tr>';
echo '            <th>ID</th>';
echo '            <th>Nombre de Usuario</th>';
echo '            <th>Email</th>';
echo '            <th>Estado</th>';
echo '        </tr>';

foreach ($users_data as $user) {
    echo '<tr>';
    echo '    <td>' . $user['user_id'] . '</td>';
    echo '    <td>' . $user['username'] . '</td>';
    echo '    <td>' . $user['user_email'] . '</td>';
    echo '    <td>' . ($user['user_status'] == 1 ? 'Activo' : 'Inactivo') . '</td>';
    echo '</tr>';
}

echo '    </table>';

echo '    <h2>Lista de Contactos</h2>';
echo '    <table>';
echo '        <tr>';
echo '            <th>ID</th>';
echo '            <th>Nombre</th>';
echo '            <th>Email</th>';
echo '            <th>Mensaje</th>';
echo '            <th>Fecha</th>';
echo '        </tr>';

foreach ($contacts_data as $contact) {
    echo '<tr>';
    echo '    <td>' . $contact['contact_id'] . '</td>';
    echo '    <td>' . $contact['name'] . '</td>';
    echo '    <td>' . $contact['email'] . '</td>';
    echo '    <td>' . $contact['message'] . '</td>';
    echo '    <td>' . $contact['created'] . '</td>';
    echo '</tr>';
}

echo '    </table>';
echo '</div>';

echo '<script>';
echo '    document.addEventListener("DOMContentLoaded", () => {';
echo '        const modalOverlay = document.querySelector(".modal-overlay");';
echo '        const closeBtn = document.querySelector(".close-btn");';
echo '        if (modalOverlay) {';
echo '            setTimeout(() => {';
echo '                modalOverlay.style.display = "none";';
echo '            }, 3000);';
echo '            closeBtn.addEventListener("click", () => {';
echo '                modalOverlay.style.display = "none";';
echo '            });';
echo '        }';
echo '    });';
echo '</script>';

echo '</body>';
echo '</html>';
?>