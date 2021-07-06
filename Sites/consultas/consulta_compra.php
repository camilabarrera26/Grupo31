<?php
session_start();
if(!isset($_SESSION['rut'])) // If session is not set then redirect to Login Page
       {
           header("Location: ../login.php");  
       }
?>

<?php include('../templates/header.html'); ?>
<html>
<body>

<?php 
$id = $_REQUEST['id']; 
$nombre = $_REQUEST['nombre']; 
?>

<header class="py-5">
    <div class="container px-lg-0">
        <div class="p-4 p-lg-2 bg-light rounded-3 text-center">
            <div class="m-4 m-lg-2">
                <h1 class="display-5 fw-bold"><?php echo "$nombre"; ?></h1> 
                <p class="fs-4">Aquí podrás encontrar el resultado de tu compra.</p>  
            </div>
        </div>
    </div>
</header>

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

<br>
<?php
    echo "<a href='consulta_tienda.php?id=$id&nombre=$nombre' role='button' class='btn'> Volver </a>";
  ?>
</br>

</html>