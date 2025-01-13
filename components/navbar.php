<?php
// Incluir el archivo de conexión

// Función para obtener los elementos del menú
function getMenuItems($parent_id = NULL, $conn) {
    $sql = "SELECT * FROM menu WHERE parent_id " . ($parent_id === NULL ? "IS NULL" : "= :parent_id");
    $stmt = $conn->prepare($sql);

    if ($parent_id !== NULL) {
        $stmt->bindParam(':parent_id', $parent_id, PDO::PARAM_INT);
    }

    $stmt->execute();
    $menu = $stmt->fetchAll(PDO::FETCH_ASSOC);

    return $menu;
}

// Función para renderizar el menú
function renderMenu($parent_id = NULL, $conn) {
    $menuItems = getMenuItems($parent_id, $conn);

    if (!empty($menuItems)) {
        echo '<nav class="navbar"><ul class="navbar-list">';
        foreach ($menuItems as $menuItem) {
            echo '<li class="navbar-item">';
            echo '<a href="' . htmlspecialchars($menuItem['url']) . '" class="navbar-link">' . htmlspecialchars($menuItem['nombre']) . '</a>';
            renderMenu($menuItem['id'], $conn); // Llamada recursiva
            echo '</li>';
        }
        echo '</ul>
        </nav>';
    }
}

// Mostrar el menú
echo '<nav>';
renderMenu(NULL, $conn);
echo '</nav>';
?>