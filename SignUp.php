<?php

    require_once './config/db.php';

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        
        $nombre = isset($_POST['nombre']) ? $_POST['nombre'] : '';
        $email = isset($_POST['email']) ? $_POST['email'] : '';
        $password = isset($_POST['password']) ? $_POST['password'] : '';
    
        // Verifica si los campos no están vacíos
        if (!empty($nombre) && !empty($email) && !empty($password)) {
            $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
    
            // Conexión a la base de datos
            require_once './config/db.php';
            $db = new DataBase();
            $conn = $db->getConnection();
    
            // consulta sql para insertar datos
            $sql = "INSERT INTO usuarios (nombre, email, password) VALUES (:nombre, :email, :password)";
            $stmt = $conn->prepare($sql);
            $stmt->bindParam(':nombre', $nombre);
            $stmt->bindParam(':email', $email);
            $stmt->bindParam(':password', $hashedPassword);
    
            // Ejecutar la consulta
            if ($stmt->execute()) {
                header("Location: Login.php");
                exit();
            } else {
                header("Location: SingUp.php?error=1");
            }
    }
}
    
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./styles/login.css">
    
    <title>Ospedajes sv</title>
</head>
<body>
        <main>
            <section>
                <h1>Crear cuenta</h1>
                <form class="Estilos-form" method="POST">
                    <label>Nombre</label>
                    <input class="Estilos-Input" type="text" placeholder="Nombre de usuario" name="nombre" required>

                    <label>Email</label>
                    <input class="Estilos-Input" type="text" placeholder="Ingrese su email" name = "email" required>

                    <label>Ingrese su contraseña</label>
                    <input class="Estilos-Input" type="password" placeholder="Ingrse una contraseña" name = "password" required>

                    <p class="Estilos-Parrafo">Ya tienes una cuenta?<a href="Login.php">Iniciar sesion</a></p>

                    <button class="Estilos-Button" type="submit">Crear cuenta</button>
                </form>
            </section>
        </main>
</body>
</html>