<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);

    $conn = new mysqli('localhost', 'root', '', 'alojamientos_db');
    $sql = "INSERT INTO usuarios (nombre, email, password) VALUES ('$username', '$email', '$password')";

    if ($conn->query($sql) === TRUE) {
        header('Location: login.php');
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}
?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registro</title>
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

        .register-container {
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

        .register-container input,
        .register-container button {
            width: 90%;
            margin: 10px 0;
            padding: 10px;
            border-radius: 4px;
            border: 1px solid #cccccc;
            box-sizing: border-box;
        }

        .register-container button {
            background-color: #007BFF;
            color: #ffffff;
            border: none;
            cursor: pointer;
        }

        .register-container button:hover {
            background-color: #0056b3;
        }
    </style>
</head>

<body>
    <?php include 'components/navbar.php'; ?>
    <div class="register-container">
        <h2>Registro</h2>
        <form method="post" action="register.php">
            <input type="text" name="username" required placeholder="Nombre de usuario">
            <input type="email" name="email" required placeholder="Email">
            <input type="password" name="password" required placeholder="Contraseña">
            <button type="submit">Registrarse</button>
        </form>
    </div>
</body>

</html>