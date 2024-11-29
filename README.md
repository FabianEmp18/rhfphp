# Final-PHP-CRUD-Tecno3f-2024

# Sistema de Gestión de Productos, Usuarios y Contactos

Este proyecto es un sistema web de gestión de productos, usuarios y contactos. Permite gestionar los productos de una tienda, visualizar los usuarios registrados y los mensajes recibidos a través de un formulario de contacto.

## Requisitos

- **PHP 7.4 o superior**
- **MySQL 5.7 o superior**
- **XAMPP o servidor web compatible**

**Datos para ingrear - Login:**
   - Usuario: admin 
   - Contraseña: prueba

## Instalación

1. **Instalar XAMPP:**
   Si no tienes XAMPP o un servidor compatible con PHP y MySQL, puedes descargarlo e instalarlo desde [aquí](https://www.apachefriends.org/index.html).

2. **Configurar la base de datos:**
   Crea una base de datos llamada rest_api_demo en MySQL utilizando phpMyAdmin o una herramienta similar.

3. **Importar la base de datos rest_api_demo que se encuentra en la carpeta dbf** 
   

### 4. **Configuración de la Conexión:**
   - Asegúrate de que el archivo `Database.php` contenga los detalles correctos para conectar a tu base de datos. 
   - La configuración predeterminada es:

<?php
class Database {
     private $host = "localhost"; // Servidor de la base de datos
     private $db_name = "rest_api_demo"; // Nombre de la base de datos (modificar si es necesario)
     private $username = "root"; // Usuario de la base de datos (modificar si es necesario)
     private $password = ""; // Contraseña de la base de datos (modificar si es necesario)
     public $conn;
     ```

   - Si estás usando XAMPP, generalmente no es necesario modificar estas configuraciones:
     - **Host:** `localhost`
     - **Nombre de la base de datos:** `rest_api_demo`
     - **Usuario:** `root`
     - **Contraseña:** *(dejar vacía por defecto en XAMPP)*.

   - Si tu configuración es diferente, actualiza los valores según corresponda.

### 4. **Datos para ingrear - Login:**
   - Usuario: admin 
   - Contraseña: prueba

## Funcionalidades

1. **Lista de Productos:**
   Muestra todos los productos almacenados en la base de datos en una tabla. Desde aquí puedes editar o eliminar productos.

2. **Crear Producto:**
   Un formulario que permite agregar nuevos productos a la base de datos.

3. **Modificar Producto:**
   Puedes modificar los detalles de un producto existente desde un formulario que carga la información previa.

4. **Eliminar Producto:**
   Permite eliminar productos directamente desde la tabla de productos.

5. **Cerrar Sesión:**
   Si el sistema requiere login, podrás cerrar sesión desde la vista correspondiente.






Este proyecto es un sistema web para gestionar **productos**, con funcionalidades de **Crear**, **Leer**, **Actualizar** y **Eliminar** (CRUD). Fue adaptado para trabajar exclusivamente con productos.

---

## Funcionalidades de Archivos Principales

### 1. **Crear Producto (`create.php`):**
   - Este archivo muestra un formulario para capturar los datos de un nuevo producto.
   - **Función:** Inserta un producto en la base de datos cuando se envía el formulario.
   - **Ubicación en el Sistema:** Es llamado desde `alta.php` o directamente accediendo a `http://localhost/rhfphp/alta.php`.
   - **Cambios realizados:** Se adaptó para trabajar con "productos" en lugar de "items".

### 2. **Leer Productos (`read.php`):**
   - Este archivo consulta todos los productos en la base de datos y los muestra en una tabla.
   - **Función:** Es la base para la vista de lista de productos en `index.php`.
   - **Ubicación en el Sistema:** Es invocado desde `index.php` (ruta: `http://localhost/rhfphp/index.php`).

### 3. **Modificar Producto (`update.php`):**
   - Permite editar un producto existente. Muestra un formulario pre-rellenado con los datos actuales del producto.
   - **Función:** Actualiza los detalles de un producto en la base de datos.
   - **Ubicación en el Sistema:** Es llamado desde `modificar.php` cuando se pasa un `id` como parámetro en la URL (ejemplo: `http://localhost/rhfphp/modificar.php?id=11`).


### 4. **Eliminar Producto (`delete.php`):**
   - Gestiona la eliminación de productos de la base de datos mediante un ID pasado como parámetro.
   - **Función:** Borra un producto y redirige de vuelta a la lista de productos (`index.php`).
   - **Ubicación en el Sistema:** Es invocado desde el botón "Eliminar" en `index.php`.

---

## Rol de los Archivos en el Sistema

1. **Controladores:**
   - Los archivos `create.php`, `update.php`, `delete.php`, y `read.php` tienen roles que combinan control y presentación.
   - Incluyen lógica para interactuar con la base de datos y mostrar resultados a los usuarios.

2. **Vistas:**
   - `index.php` funciona como la vista principal que integra la funcionalidad de los controladores mencionados.
   - `modificar.php` y `alta.php` actúan como enlaces hacia los formularios de modificación y creación, respectivamente.

3. **Base de Datos:**
   - Todas las operaciones son posibles gracias a las interacciones con la base de datos configuradas en `Database.php`.

