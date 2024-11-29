<?php
class Productos {
    private $conn;
    private $table_name = "productos";  // Cambié 'items' por 'productos'

    public $id;
    public $name;
    public $description;
    public $price;

    public function __construct($db) {
        $this->conn = $db;
    }

    // Leer todos los productos
    public function read() {
        if (!$this->conn) {
            echo "Conexión a la base de datos no establecida.";
            return false;
        }

        $query = "SELECT * FROM " . $this->table_name;
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Leer un solo producto por ID
    public function readOne() {
        if (!$this->conn) {
            echo "Conexión a la base de datos no establecida.";
            return false;
        }

        $query = "SELECT * FROM " . $this->table_name . " WHERE id = :id LIMIT 1";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':id', $this->id);
        $stmt->execute();

        // Retornar el producto encontrado como un array asociativo
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    // Crear un nuevo producto
    public function create() {
        if (!$this->conn) {
            echo "Conexión a la base de datos no establecida.";
            return false;
        }

        $query = "INSERT INTO " . $this->table_name . " (name, description, price) VALUES (:name, :description, :price)";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':name', $this->name);
        $stmt->bindParam(':description', $this->description);
        $stmt->bindParam(':price', $this->price);

        if ($stmt->execute()) {
            return true;
        }
        return false;
    }

    // Actualizar un producto existente
    public function update() {
        if (!$this->conn) {
            echo "Conexión a la base de datos no establecida.";
            return false;
        }

        $query = "UPDATE " . $this->table_name . " SET name = :name, description = :description, price = :price WHERE id = :id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':name', $this->name);
        $stmt->bindParam(':description', $this->description);
        $stmt->bindParam(':price', $this->price);
        $stmt->bindParam(':id', $this->id);

        if ($stmt->execute()) {
            return true;
        }
        return false;
    }

    // Eliminar un producto
    public function delete() {
        if (!$this->conn) {
            echo "Conexión a la base de datos no establecida.";
            return false;
        }

        $query = "DELETE FROM " . $this->table_name . " WHERE id = :id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':id', $this->id);

        if ($stmt->execute()) {
            return true;
        }
        return false;
    }
}
?>
