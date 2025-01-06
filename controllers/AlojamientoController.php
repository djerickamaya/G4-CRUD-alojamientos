<?php
require_once '../config/db.php';
require_once '../models/Alojamiento.php';
require_once '../models/UsuarioAlojamiento.php';

class AlojamientoController {
    private $db;
    private $alojamiento;
    private $usuarioAlojamiento;

    public function __construct() {
        $database = new Database();
        $this->db = $database->getConnection();
        $this->alojamiento = new Alojamiento($this->db);
        $this->usuarioAlojamiento = new UsuarioAlojamiento($this->db);
    }

    public function index() {
        $stmt = $this->alojamiento->read();
        $alojamientos = $stmt->fetchAll(PDO::FETCH_ASSOC);
        require '../views/alojamientos/index.php';
    }

    public function create() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $this->alojamiento->nombre = $_POST['nombre'];
            $this->alojamiento->descripcion = $_POST['descripcion'];
            $this->alojamiento->direccion = $_POST['direccion'];
            $this->alojamiento->precio = $_POST['precio'];
            $this->alojamiento->imagen_url = $_POST['imagen_url'];

            if ($this->alojamiento->create()) {
                header('Location: ../views/alojamientos/search.php');
            } else {
                echo "Error al crear el alojamiento.";
            }
        } else {
            require '../views/alojamientos/create.php';
        }
    }

    public function edit($id) {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $this->alojamiento->id = $id;
            $this->alojamiento->nombre = $_POST['nombre'];
            $this->alojamiento->descripcion = $_POST['descripcion'];
            $this->alojamiento->direccion = $_POST['direccion'];
            $this->alojamiento->precio = $_POST['precio'];
            $this->alojamiento->imagen_url = $_POST['imagen_url'];

            if ($this->alojamiento->update()) {
                header('Location: index.php');
            } else {
                echo "Error al actualizar el alojamiento.";
            }
        } else {
            $stmt = $this->alojamiento->read();
            $alojamiento = $stmt->fetch(PDO::FETCH_ASSOC);
            require '../views/alojamientos/edit.php';
        }
    }

    public function delete($id) {
        $this->alojamiento->id = $id;
        if ($this->alojamiento->delete()) {
            header('Location: index.php');
        } else {
            echo "Error al eliminar el alojamiento.";
        }
    }

    public function search() {
        $keywords = isset($_GET['keywords']) ? $_GET['keywords'] : '';
        $stmt = $this->alojamiento->search($keywords);
        $alojamientos = $stmt->fetchAll(PDO::FETCH_ASSOC);
        require '../views/alojamientos/search.php';
    }

    public function saveUserAlojamientos($usuario_id) {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $selectedAlojamientos = isset($_POST['alojamientos']) ? $_POST['alojamientos'] : [];
            $this->usuarioAlojamiento->saveAlojamientos($usuario_id, $selectedAlojamientos);
            $this->usuarioAlojamiento->deleteAlojamientos($usuario_id, $selectedAlojamientos);
            header('Location: index.php');
        } else {
            $stmt = $this->alojamiento->read();
            $alojamientos = $stmt->fetchAll(PDO::FETCH_ASSOC);
            require '../views/alojamientos/select.php';
        }
    }
}

$action = isset($_GET['action']) ? $_GET['action'] : '';

$controller = new AlojamientoController();

switch ($action) {
    case 'create':
        $controller->create();
        break;
    case 'search':
        $controller->search();
        break;
    case 'edit':
        $id = isset($_GET['id']) ? $_GET['id'] : die('Error: ID no encontrado.');
        $controller->edit($id);
        break;
    case 'delete':
        $id = isset($_GET['id']) ? $_GET['id'] : die('Error: ID no encontrado.');
        $controller->delete($id);
        break;
    case 'saveUserAlojamientos':
        $usuario_id = isset($_GET['usuario_id']) ? $_GET['usuario_id'] : die('Error: ID no encontrado.');
        $controller->saveUserAlojamientos($usuario_id);
        break;
    default:
        $controller->index();
        break;
}
?>