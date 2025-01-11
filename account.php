<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit();
}

$conn = new mysqli('localhost', 'root', '', 'alojamientos_db');

if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

// Manejar la eliminación de alojamientos
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['delete'])) {
    $alojamiento_id = $_POST['alojamiento_id'];
    $user_id = $_SESSION['user_id'];
    $sql = "DELETE FROM usuarios_alojamientos WHERE usuario_id='$user_id' AND alojamiento_id='$alojamiento_id'";
    $conn->query($sql);
}

// Manejar el cierre de sesión
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['logout'])) {
    session_destroy();
    header('Location: login.php');
    exit();
}

// Mostrar alojamientos del usuario
$user_id = $_SESSION['user_id'];
$sql = "SELECT a.* FROM alojamientos a JOIN usuarios_alojamientos ua ON a.id = ua.alojamiento_id WHERE ua.usuario_id='$user_id'";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html>

<head>
    <title>Cuenta de Usuario</title>
    <link rel="stylesheet" type="text/css" href="css/styles.css">
</head>

<body>
    <?php include 'components/navbar.php'; ?>
    <h1>Mis Alojamientos</h1>
    <form method="post" action="account.php">
        <button type="submit" name="logout">Cerrar sesión</button>
    </form>
    <div class="container">
        <?php while ($row = $result->fetch_assoc()): ?>
            <div class="card">
                <img src="<?php echo $row['imagen_url']; ?>" alt="<?php echo $row['nombre']; ?>">
                <h2><?php echo $row['nombre']; ?></h2>
                <p><?php echo $row['descripcion']; ?></p>
                <p><strong>Ubicación:</strong> <?php echo $row['direccion']; ?></p>
                <p><strong>Precio:</strong> $<?php echo $row['precio']; ?></p>
                <form method="post" action="account.php">
                    <input type="hidden" name="alojamiento_id" value="<?php echo $row['id']; ?>">
                    <button type="submit" name="delete">Eliminar</button>
                </form>
            </div>
        <?php endwhile; ?>
    </div>
</body>

</html>