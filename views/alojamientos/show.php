<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Detalles del Alojamiento</title>
</head>
<body>
    <h1>Detalles del Alojamiento</h1>
    <div>
        <strong>Nombre:</strong>
        <p><?php echo htmlspecialchars($alojamiento['nombre']); ?></p>
    </div>
    <div>
        <strong>Descripción:</strong>
        <p><?php echo htmlspecialchars($alojamiento['descripcion']); ?></p>
    </div>
    <div>
        <strong>Dirección:</strong>
        <p><?php echo htmlspecialchars($alojamiento['direccion']); ?></p>
    </div>
    <div>
        <strong>Precio:</strong>
        <p><?php echo htmlspecialchars($alojamiento['precio']); ?></p>
    </div>
    <div>
        <strong>Imagen:</strong>
        <img src="<?php echo htmlspecialchars($alojamiento['imagen_url']); ?>" alt="Imagen de <?php echo htmlspecialchars($alojamiento['nombre']); ?>" width="300">
    </div>
    <a href="index.php">Volver a la lista de alojamientos</a>
</body>
</html>