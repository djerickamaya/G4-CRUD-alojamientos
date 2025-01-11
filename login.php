<?php
require_once '../config/db.php';

$database = new Database();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $email = $_POST['email'];
    $password = $_POST['password'];

    $conn = new mysqli($database->host, $database->username, $database->pasword, $database->dbname, $database->port);
    $sql = "SELECT * FROM usuarios WHERE email='$email'";
    $result = $conn->query($sql);
    $user = $result->fetch_assoc();

    if ($user && password_verify($password, $user['password'])) {
        session_start();
        $_SESSION['user_id'] = $user['id'];
        $_SESSION['role'] = $user['rol'];
        header('Location: account.php');
    } else {
        echo "Email o contraseña incorrectos.";
    }
}
?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inicio de Sesión</title>
    <link rel="stylesheet" href="css/styles.css"> <!-- Enlace al archivo CSS -->
    <style>
        body {
            font-family: 'Arial', sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
            display: flex;
            flex-direction: column;
            align-items: center;
        }

        .login-container {
            display: flex;
            flex-direction: column;
            align-items: center;
            background-color: #ffffff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.1);
            max-width: 400px;
            width: 100%;
            text-align: center;
            margin-top: 20px;
            /* Ajuste el margen superior */
        }

        .login-container input,
        .login-container button {
            width: 90%;
            margin: 10px 0;
            padding: 10px;
            border-radius: 4px;
            border: 1px solid #cccccc;
            box-sizing: border-box;
        }

        .login-container button {
            background-color: #007BFF;
            color: #ffffff;
            border: none;
            cursor: pointer;
        }

        .login-container button:hover {
            background-color: #0056b3;
        }
    </style>
</head>

<body>
    <?php include 'components/navbar.php'; ?>
    <div class="login-container">
        <h2>Inicio de Sesión</h2>
        <form method="post" action="login.php">
            <input type="email" name="email" required placeholder="Email">
            <input type="password" name="password" required placeholder="Contraseña">
            <button type="submit">Iniciar Sesión</button>
        </form>
    </div>
</body>

</html>