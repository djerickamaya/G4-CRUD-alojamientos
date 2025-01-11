<?php
session_start();
require_once '../config/db.php';

$database = new Database();
$conn = new mysqli($database->host, $database->username, $database->pasword, $database->dbname, $database->port);

// Verificar la conexión
if ($conn->connect_error) {
    die("Error de conexión: " . $conn->connect_error);
}

// Manejar la selección de alojamientos
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['like']) && isset($_SESSION['user_id'])) {
    $alojamiento_id = $_POST['alojamiento_id'];
    $user_id = $_SESSION['user_id'];

    // Verificar si ya existe la combinación en la tabla
    $check_sql = "SELECT * FROM usuarios_alojamientos WHERE usuario_id='$user_id' AND alojamiento_id='$alojamiento_id'";
    $check_result = $conn->query($check_sql);

    if ($check_result->num_rows == 0) {
        // Si no existe, insertar la nueva combinación
        $sql = "INSERT INTO usuarios_alojamientos (usuario_id, alojamiento_id) VALUES ('$user_id', '$alojamiento_id')";
        $conn->query($sql);
    }
}

// Consulta de alojamientos
$sql = "SELECT * FROM alojamientos";
$result = $conn->query($sql);

// Verificar si la consulta fue exitosa
if (!$result) {
    die("Error en la consulta: " . $conn->error);
}
?>
<!DOCTYPE html>
<html>

<head>
    <title>Landing Page</title>
    <link rel="stylesheet" type="text/css" href="css/styles.css">
</head>

<body>
    <?php include 'components/navbar.php'; ?>
    <h1>Alojamientos en El Salvador</h1>
    <div class="container">
        <?php while ($row = $result->fetch_assoc()): ?>
            <div class="card">
                <img src="<?php echo $row['imagen_url']; ?>" alt="<?php echo $row['nombre']; ?>">
                <h2><?php echo $row['nombre']; ?></h2>
                <p><?php echo $row['descripcion']; ?></p>
                <p><strong>Ubicación:</strong> <?php echo $row['direccion']; ?></p>
                <p><strong>Precio:</strong> $<?php echo $row['precio']; ?></p>
                <?php if (isset($_SESSION['user_id'])): ?>
                    <form method="post" action="index.php">
                        <input type="hidden" name="alojamiento_id" value="<?php echo $row['id']; ?>">
                        <button type="submit" name="like">Me gusta</button>
                    </form>
                <?php endif; ?>
            </div>
        <?php endwhile; ?>
    </div>
</body>

</html>