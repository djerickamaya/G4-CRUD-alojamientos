<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Buscar Alojamientos</title>
    <style>
        .card {
            border: 1px solid #ccc;
            border-radius: 8px;
            padding: 16px;
            margin: 16px;
            width: 300px;
            display: inline-block;
            vertical-align: top;
            position: relative;
        }
        .card img {
            width: 100%;
            border-radius: 8px 8px 0 0;
        }
        .card .price {
            color: red;
            font-weight: bold;
            position: absolute;
            top: 16px;
            right: 16px;
            background: rgba(255, 255, 255, 0.8);
            padding: 4px 8px;
            border-radius: 4px;
        }
        .card .details {
            padding: 8px 0;
        }
    </style>
</head>
<body>
    <h1>Buscar Alojamientos</h1>
    <form action="../../controllers/AlojamientoController.php?action=search" method="get">
        <input type="hidden" name="action" value="search">
        <input type="text" name="keywords" placeholder="Buscar por nombre o dirección">
        <input type="submit" value="Buscar">
    </form>
    <div class="results">
        <?php if (!empty($alojamientos)): ?>
            <?php foreach ($alojamientos as $alojamiento): ?>
                <div class="card">
                    <img src="<?php echo htmlspecialchars($alojamiento['imagen_url']); ?>" alt="Imagen de <?php echo htmlspecialchars($alojamiento['nombre']); ?>">
                    <div class="price"><?php echo htmlspecialchars($alojamiento['precio']); ?></div>
                    <div class="details">
                        <h2><?php echo htmlspecialchars($alojamiento['nombre']); ?></h2>
                        <p><?php echo htmlspecialchars($alojamiento['direccion']); ?></p>
                    </div>
                </div>
            <?php endforeach; ?>
        <?php else: ?>
            <p>No se encontraron alojamientos.</p>
        <?php endif; ?>
    </div>
</body>
</html>