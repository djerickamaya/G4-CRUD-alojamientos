<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Seleccionar Alojamientos</title>
</head>
<body>
    <h1>Seleccionar Alojamientos</h1>
    <form action="../../controllers/AlojamientoController.php?action=saveUserAlojamientos" method="post">
        <?php foreach ($alojamientos as $alojamiento): ?>
            <div>
                <img src="<?php echo htmlspecialchars($alojamiento['imagen_url']); ?>" alt="Imagen de <?php echo htmlspecialchars($alojamiento['nombre']); ?>" width="20">
                <input type="checkbox" name="alojamientos[]" value="<?php echo $alojamiento['id']; ?>">
                <label><?php echo htmlspecialchars($alojamiento['nombre']); ?></label>
            </div>
        <?php endforeach; ?>
        <input type="submit" value="Guardar Selección">
    </form>
</body>
</html>