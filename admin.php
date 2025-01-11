<?php
session_start();
$conn = new mysqli('localhost', 'root', '', 'alojamientos_db');

// Verificar la conexión
if ($conn->connect_error) {
    die("Error de conexión: " . $conn->connect_error);
}

// Manejar el inicio de sesión del administrador
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['login'])) {
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Consulta para obtener el usuario por email
    $stmt = $conn->prepare("SELECT id, password, role FROM usuarios WHERE email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $stmt->bind_result($user_id, $hashed_password, $role);
    $stmt->fetch();
    $stmt->close();

    // Verificar la contraseña y el rol
    if (password_verify($password, $hashed_password) && $role === 'admin') {
        $_SESSION['user_id'] = $user_id;
        $_SESSION['role'] = $role;
    } else {
        echo "Correo electrónico o contraseña incorrectos, o no tienes permisos de administrador.";
        exit();
    }
}

// Redirigir si no es un administrador
if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'admin') {
    header('Location: login.php');
    exit();
}

// Manejar la adición de alojamientos
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['add'])) {
    $nombre = $_POST['nombre'];
    $descripcion = $_POST['descripcion'];
    $direccion = $_POST['direccion'];
    $precio = $_POST['precio'];
    $imagen_url = $_POST['imagen_url'];

    $stmt = $conn->prepare("INSERT INTO alojamientos (nombre, descripcion, direccion, precio, imagen_url) VALUES (?, ?, ?, ?, ?)");
    $stmt->bind_param("sssss", $nombre, $descripcion, $direccion, $precio, $imagen_url);
    $stmt->execute();
    $stmt->close();
}
?>
<!DOCTYPE html>
<html>

<head>
    <title>Administrador - Agregar Alojamiento</title>
    <link rel="stylesheet" type="text/css" href="css/styles.css">
</head>

<body>
    <?php include 'components/navbar.php'; ?>
    <?php if (!isset($_SESSION['user_id'])): ?>
        <h1>Iniciar Sesión Administrador</h1>
        <form method="post" action="admin.php">
            <input type="email" name="email" required placeholder="Correo Electrónico">
            <input type="password" name="password" required placeholder="Contraseña">
            <button type="submit" name="login">Iniciar Sesión</button>
        </form>
    <?php else: ?>
        <h1>Agregar Alojamiento</h1>
        <form method="post" action="admin.php">
            <input type="text" name="nombre" required placeholder="Nombre">
            <input type="text" name="descripcion" required placeholder="Descripción">
            <input type="text" name="direccion" required placeholder="Dirección">
            <input type="text" name="precio" required placeholder="Precio">
            <input type="text" name="imagen_url" placeholder="URL de la Imagen">
            <button type="submit" name="add">Agregar</button>
        </form>
    <?php endif; ?>
</body>

</html>