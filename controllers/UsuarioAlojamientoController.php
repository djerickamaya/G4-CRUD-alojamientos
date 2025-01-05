<?php
require_once 'config/database.php';
require_once 'models/UsuarioAlojamiento.php';

class UsuarioAlojamientoController {
    private $db;
    private $usuarioAlojamiento;

    public function __construct() {
        $database = new Database();
        $this->db = $database->getConnection();
        $this->usuarioAlojamiento = new UsuarioAlojamiento($this->db);
    }

    public function saveAlojamientos($usuario_id, $alojamientos) {
        foreach ($alojamientos as $alojamiento_id) {
            $this->usuarioAlojamiento->usuario_id = $usuario_id;
            $this->usuarioAlojamiento->alojamiento_id = $alojamiento_id;
            $this->usuarioAlojamiento->save();
        }
    }

    public function deleteAlojamientos($usuario_id, $alojamientos) {
        $stmt = $this->usuarioAlojamiento->getAlojamientosByUsuario($usuario_id);
        $existingAlojamientos = $stmt->fetchAll(PDO::FETCH_COLUMN);

        foreach ($existingAlojamientos as $alojamiento_id) {
            if (!in_array($alojamiento_id, $alojamientos)) {
                $this->usuarioAlojamiento->usuario_id = $usuario_id;
                $this->usuarioAlojamiento->alojamiento_id = $alojamiento_id;
                $this->usuarioAlojamiento->delete();
            }
        }
    }
}
?>