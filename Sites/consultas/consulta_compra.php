<?php include('../templates/header.html'); ?>
<html>
<body>

<?php 
$id = $_POST["id_tienda"];
?>

  <?php
    // Nos conectamos a las bdds
    require("../config/conexion.php");
    
    // Primero obtenemos el producto con id seleccionado
    $producto = $_POST["id_producto"];

    $query = "SELECT productos.pid FROM productos WHERE productos.pid = $producto;";
    $result = $dbimp -> prepare($query);
    $result -> execute();
    $productos = $result -> fetchAll();


    foreach ($productos as $p){

        // Luego construimos las querys con nuestro procedimiento almacenado para ir agregando esas tuplas a nuestra bdd objetivo
        // Hacemos una verificacion para ver si el pokemon es legendario porque ese parámetro no se comporta muy bien entre php y sql
        // asi que lo agregamos manualmente al final (por eso los FALSE o TRUE)

            $query = "SELECT verificar_compra($p[0], $id);";

        // Ejecutamos las querys para efectivamente insertar los datos
        $result = $dbimp -> prepare($query);
        $result -> execute();
        $result -> fetchAll();

        if ($result == 'TRUE') {
            break;
        }
    }

    if ($result == 'TRUE') {
        echo 'Compra Exitosa';
    } else {
        echo 'No se pudo realizar la compra';
    }

  ?>
</body>
</html>