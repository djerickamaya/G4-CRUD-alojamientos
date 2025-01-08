<?php
class Alojamiento {
    private $conn;
    private $table_name = "alojamientos";

    public $id;
    public $nombre;
    public $descripcion;
    public $direccion;
    public $precio;
    public $imagen_url;

    public function __construct($db) {
        $this->conn = $db;
    }

    public function read() {
        $query = "SELECT * FROM " . $this->table_name;
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt;
    }

    public function create() {
        $query = "INSERT INTO " . $this->table_name . " SET nombre=:nombre, descripcion=:descripcion, direccion=:direccion, precio=:precio, imagen_url=:imagen_url";
        $stmt = $this->conn->prepare($query);

        $this->nombre = htmlspecialchars(strip_tags($this->nombre));
        $this->descripcion = htmlspecialchars(strip_tags($this->descripcion));
        $this->direccion = htmlspecialchars(strip_tags($this->direccion));
        $this->precio = htmlspecialchars(strip_tags($this->precio));
        $this->imagen_url = htmlspecialchars(strip_tags($this->imagen_url));

        $stmt->bindParam(":nombre", $this->nombre);
        $stmt->bindParam(":descripcion", $this->descripcion);
        $stmt->bindParam(":direccion", $this->direccion);
        $stmt->bindParam(":precio", $this->precio);
        $stmt->bindParam(":imagen_url", $this->imagen_url);

        if ($stmt->execute()) {
            return true;
        }
        return false;
    }

    public function update() {
        $query = "UPDATE " . $this->table_name . " SET nombre=:nombre, descripcion=:descripcion, direccion=:direccion, precio=:precio, imagen_url=:imagen_url WHERE id=:id";
        $stmt = $this->conn->prepare($query);

        $this->nombre = htmlspecialchars(strip_tags($this->nombre));
        $this->descripcion = htmlspecialchars(strip_tags($this->descripcion));
        $this->direccion = htmlspecialchars(strip_tags($this->direccion));
        $this->precio = htmlspecialchars(strip_tags($this->precio));
        $this->imagen_url = htmlspecialchars(strip_tags($this->imagen_url));
        $this->id = htmlspecialchars(strip_tags($this->id));

        $stmt->bindParam(":nombre", $this->nombre);
        $stmt->bindParam(":descripcion", $this->descripcion);
        $stmt->bindParam(":direccion", $this->direccion);
        $stmt->bindParam(":precio", $this->precio);
        $stmt->bindParam(":imagen_url", $this->imagen_url);
        $stmt->bindParam(":id", $this->id);

        if ($stmt->execute()) {
            return true;
        }
        return false;
    }

    public function delete() {
        $query = "DELETE FROM " . $this->table_name . " WHERE id = ?";
        $stmt = $this->conn->prepare($query);

        $this->id = htmlspecialchars(strip_tags($this->id));
        $stmt->bindParam(1, $this->id);

        if ($stmt->execute()) {
            return true;
        }
        return false;
    }

    public function search($keywords) {
        $query = "SELECT * FROM " . $this->table_name . " WHERE nombre LIKE ? OR direccion LIKE ?";
        $stmt = $this->conn->prepare($query);

        $keywords = htmlspecialchars(strip_tags($keywords));
        $keywords = "%{$keywords}%";

        $stmt->bindParam(1, $keywords);
        $stmt->bindParam(2, $keywords);

        $stmt->execute();
        return $stmt;
    }
}
?>