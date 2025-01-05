<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Seleccionar Alojamientos</title>
</head>
<body>
    <h1>Seleccionar Alojamientos</h1>
    <form action="saveUserAlojamientos.php" method="post">
        <?php foreach ($alojamientos as $alojamiento): ?>
            <div>
                <input type="checkbox" name="alojamientos[]" value="<?php echo $alojamiento['id']; ?>">
                <label><?php echo htmlspecialchars($alojamiento['nombre']); ?></label>
            </div>
        <?php endforeach; ?>
        <input type="submit" value="Guardar Selección">
    </form>
</body>
</html>