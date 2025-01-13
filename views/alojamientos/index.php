<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Alojamientos</title>
    <style>
        table {
            width: 100%;
            border-collapse: collapse;
        }
        table, th, td {
            border: 1px solid black;
        }
        th, td {
            padding: 10px;
            text-align: left;
        }
        th {
            background-color: #f2f2f2;
        }
    </style>
    <link rel="stylesheet" type="text/css" href="../../css/styles.css">
</head>
<body>
    <?php include '../components/navbar.php'; ?>
    <h1>Alojamientos</h1>
    <form action="../../controllers/AlojamientoController.php?action=index" method="get">
        <input type="text" name="keywords" placeholder="Buscar por nombre o dirección">
        <input type="submit" value="Buscar">
    </form>
    <div class="boton-container">
        <a class="boton-de-redireccion" href="../../controllers/AlojamientoController.php?action=create">Crear nuevo alojamiento</a>
    </div>
    <table>
        <thead>
            <tr>
                <th>Nombre</th>
                <th>Descripción</th>
                <th>Dirección</th>
                <th>Precio</th>
                <th>Imagen</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            <?php if (!empty($alojamientos)): ?>
                <?php foreach ($alojamientos as $alojamiento): ?>
                    <tr>
                        <td><?php echo htmlspecialchars($alojamiento['nombre']); ?></td>
                        <td><?php echo htmlspecialchars($alojamiento['descripcion']); ?></td>
                        <td><?php echo htmlspecialchars($alojamiento['direccion']); ?></td>
                        <td><?php echo htmlspecialchars($alojamiento['precio']); ?></td>
                        <td><img src="<?php echo htmlspecialchars($alojamiento['imagen_url']); ?>" alt="Imagen de <?php echo htmlspecialchars($alojamiento['nombre']); ?>" width="100"></td>
                        <td>
                            <a href="../../controllers/AlojamientoController.php?action=edit&&id=<?php echo $alojamiento['id']; ?>">Editar</a>
                            <a href="../../controllers/AlojamientoController.php?action=delete&&id=<?php echo $alojamiento['id']; ?>" onclick="return confirm('¿Estás seguro de que deseas eliminar este alojamiento?');">Eliminar</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            <?php else: ?>
                <tr>
                    <td colspan="6">No se encontraron alojamientos.</td>
                </tr>
            <?php endif; ?>
        </tbody>
    </table>
</body>
</html>