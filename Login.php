<?php

    require_once "./config/db.php";

    session_start();

    if($_SERVER["REQUEST_METHOD"] == "POST"){
        $email = isset($_POST['email'])? trim($_POST['email']): '';
        $password = isset($_POST['password'])? trim($_POST['password']): '';

            if(!empty($email) && !empty($password)){
                //conexion a la base de datos

                $db = new DataBase();
                $conn =$db->getConnection();

                //consulta sql para verificar el email y el password;

                $sql = "SELECT password FROM usuarios WHERE email = :email";
                $stmt = $conn ->prepare($sql);
                $stmt->bindParam(':email', $email);
                $stmt ->execute();
                $usuario = $stmt->fetch(PDO::FETCH_ASSOC);

                    if($usuario && password_verify($password, $usuario['password'])){

                        $_SESSION['user_email'] = $email;

                        header("Location: Alojamientos.php");
                        exit();
                    }else{
                        header("Location: Login.php?error=invalid_credentials");
                        exit();
                    }
            }else{
                header("Location: Login.php?=error=missing_fields ");
                exit();
            }
    }

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-
    scale=1.0">
    <link rel="stylesheet" href="./styles/login.css">
    <title>Iniciar sesion</title>
</head>
<body>
    <main>
        <section>
        <h1>Iniciar Sesion</h1>

        <?php

            if(isset($_GET['error'])){
                if($_GET['error'] == 'invalid_credencials'){
                    echo "<p style = 'color: red;'> Correo o contraña incorrecta}os. Intente nuevamente</p>";
                }elseif($_GET['error'] == 'missing_fields'){
                    echo "<p style='color: red;'>Por favor, completa todos los campos.</p>";
                }
            }

        ?>
        <form method="POST" class="Estilos-form">
            <label>Email</label>
            <input class="Estilos-Input" type="text" placeholder="Ingrese su email" name = "email">

            <label>Ingrese su contraseña</label>
            <input class="Estilos-Input" type="password" placeholder="Ingrse una contraseña" name = "password">

            <p class="Estilos-Parrafo">No tienes cuenta?<a href="SignUp.php">Crear cuenta</a></p>

            <button class="Estilos-Button" type="submit">Iniciar sesion</button>
        </form>
        </section>
    </main>
</body>
</html>