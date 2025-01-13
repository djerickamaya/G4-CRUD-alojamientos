<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Crear Alojamiento</title>
    <link rel="stylesheet" type="text/css" href="../../css/styles.css">
</head>
<body>
    <?php include_once '../components/navbar.php'; ?>
    <h1>Crear Nuevo Alojamiento</h1>
    <form  class="formulario-alojamiento" action="../../controllers/AlojamientoController.php?action=create" method="post">
        <div>
            <label for="nombre">Nombre:</label>
            <input type="text" id="nombre" name="nombre" required>
        </div>
        <div>
            <label for="descripcion">Descripción:</label>
            <textarea id="descripcion" name="descripcion"></textarea>
        </div>
        <div>
            <label for="direccion">Dirección:</label>
            <input type="text" id="direccion" name="direccion">
        </div>
        <div>
            <label for="precio">Precio:</label>
            <input type="number" step="0.01" id="precio" name="precio" min="0">
        </div>
        <div>
            <label for="imagen_url">URL de la Imagen:</label>
            <input type="text" id="imagen_url" name="imagen_url">
        </div>
        <div>
            <input type="submit" value="Crear">
        </div>
    </form>
    <div class="boton-container">
        <a class="boton-de-redireccion" href="../../controllers/AlojamientoController.php">Volver a la lista de alojamientos</a>
    </div>
</body>
</html>