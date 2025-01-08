<?php 

// llamar al archivo de conexion
require_once 'conexion.php';

// Funcion para obtener los lugares que redirigira el menu
function getMenuItems($parent_id = NULL, $connection){
    $sql = "SELECT * FROM menu WHERE parent_id ".($parent_id === NULL ? "IS NULL" : "= $parent_id");
    $result = $connection->query($sql);

    $menu = [];
    if($result->num_rows > 0){
        while($row = $result->fetch_assoc()){
            $menu[] = $row; 
        }
    }
    return $menu;
}

// renderizar
function renderMenu($parent_id = NULL,$connection){
    $menuItems = getMenuItems($parent_id,$connection);

    if(!empty($menuItems)){
        echo '<ul>';
        foreach($menuItems as $menuItem){
            echo '<li>';
            echo '<a href="'.$menuItem['url'].'">'.$menuItem['name'].'</a>';
            renderMenu($menuItem['id'],$connection);
            echo '</li>';
        }
        echo '</ul>';
    }
}

echo '<nav>';
renderMenu(NULL,$connection);
echo '</nav>';

$connection->close();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    
</body>
</html>