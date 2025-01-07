<?php
session_start();
require_once './config/db.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = isset($_POST['email']) ? $_POST['email'] : '';
    $password = isset($_POST['password']) ? $_POST['password'] : '';

    // Verifica si los campos no están vacíos
    if (!empty($email) && !empty($password)) {
        // Conexión a la base de datos
        $db = new DataBase();
        $conn = $db->getConnection();
        $sql = "SELECT * FROM usuarios WHERE email = :email";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':email', $email);

        // Ejecutar la consulta
        if ($stmt->execute()) {
            $usuario = $stmt->fetch(PDO::FETCH_ASSOC);

            // Verificar si el usuario existe y la contraseña es correcta
            if ($usuario && password_verify($password, $usuario['password'])) {
                $_SESSION['email'] = $usuario['email'];
                $_SESSION['nombre'] = $usuario['nombre'];
                $_SESSION['usuario_id'] = $usuario['id'];
                $_SESSION['rol'] = $usuario['rol'];
                header("Location: ../../Controllers/AlojamientoController.php?action=search");
                exit();
            } else {
                header("Location: SignUp.php?error=1");
                exit();
            }
        } else {
            echo "Error al ejecutar la consulta.";
        }
    } else {
        echo "Por favor, complete todos los campos.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./styles/login.css">
    <title>Iniciar sesión</title>
</head>
<body>
    <main>
        <section>
        <h1>Iniciar Sesión</h1>
        <form method="POST" class="Estilos-form">
            <label>Email</label>
            <input class="Estilos-Input" type="text" placeholder="Ingrese su email" name="email" required>

            <label>Ingrese su contraseña</label>
            <input class="Estilos-Input" type="password" placeholder="Ingrese una contraseña" name="password" required>

            <p class="Estilos-Parrafo">¿No tienes cuenta? <a href="SingUp.php">Crear cuenta</a></p>

            <button class="Estilos-Button" type="submit">Iniciar sesión</button>
        </form>
        </section>
    </main>
</body>
</html>