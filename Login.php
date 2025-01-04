<?php
    require_once "./config/db.php"

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./styles/login.css">
    <title>Iniciar sesion</title>
</head>
<body>
    <main>
        <section>
        <h1>Iniciar Sesion</h1>
        <form method="POST" class="Estilos-form">
            <label>Email</label>
            <input class="Estilos-Input" type="text" placeholder="Ingrese su email" name = "email">

            <label>Ingrese su contraseña</label>
            <input class="Estilos-Input" type="password" placeholder="Ingrse una contraseña" name = "password">

            <p class="Estilos-Parrafo">No tienes cuenta?<a href="Login.php">Crear cuenta</a></p>

            <button class="Estilos-Button" type="submit">Iniciar sesion</button>
        </form>
        </section>
    </main>
</body>
</html>