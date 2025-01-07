<?php
class UsuarioAlojamiento {
    private $conn;
    private $table_name = "usuarios_alojamientos";

    public $usuario_id;
    public $alojamiento_id;

    public function __construct($db) {
        $this->conn = $db;
    }

    public function save() {
        $query = "INSERT INTO " . $this->table_name . " SET usuario_id=:usuario_id, alojamiento_id=:alojamiento_id";
        $stmt = $this->conn->prepare($query);

        $this->usuario_id = htmlspecialchars(strip_tags($this->usuario_id));
        $this->alojamiento_id = htmlspecialchars(strip_tags($this->alojamiento_id));

        $stmt->bindParam(":usuario_id", $this->usuario_id);
        $stmt->bindParam(":alojamiento_id", $this->alojamiento_id);

        if ($stmt->execute()) {
            return true;
        }
        return false;
    }

    public function delete() {
        $query = "DELETE FROM " . $this->table_name . " WHERE usuario_id = :usuario_id AND alojamiento_id = :alojamiento_id";
        $stmt = $this->conn->prepare($query);

        $this->usuario_id = htmlspecialchars(strip_tags($this->usuario_id));
        $this->alojamiento_id = htmlspecialchars(strip_tags($this->alojamiento_id));

        $stmt->bindParam(":usuario_id", $this->usuario_id);
        $stmt->bindParam(":alojamiento_id", $this->alojamiento_id);

        if ($stmt->execute()) {
            return true;
        }
        return false;
    }

    public function getAlojamientosByUsuario($usuario_id) {
        $query = "SELECT alojamiento_id FROM " . $this->table_name . " WHERE usuario_id = ?";
        $stmt = $this->conn->prepare($query);

        $usuario_id = htmlspecialchars(strip_tags($usuario_id));
        $stmt->bindParam(1, $usuario_id);

        $stmt->execute();
        return $stmt;
    }
}
?>