<?php
session_start();
if(!isset($_SESSION['id'])) // If session is not set then redirect to Login Page
       {
           header("Location: ../login.php");  
       }
?>

<?php 
  if(isset($_SESSION['id'])){
    include('../templates/header_login.html'); 
  }  
  else {
  include('../templates/header.html');  
  }
?>

<html>
<body>

<?php 
$id_tienda = $_REQUEST['id']; 
$nombre = $_REQUEST['nombre']; 
$did = $_REQUEST['did'];
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
    
    $id_usuario = $_SESSION['id'];
    $comuna = $_POST["direcciones"];
    

    foreach ($productos as $p){

        // Luego construimos las querys con nuestro procedimiento almacenado para ir agregando esas tuplas a nuestra bdd objetivo
        // Hacemos una verificacion para ver si el pokemon es legendario porque ese parámetro no se comporta muy bien entre php y sql
        // asi que lo agregamos manualmente al final (por eso los FALSE o TRUE)
        echo $p[0];
        echo $id_tienda;
        echo $id_usuario;
        echo $comuna;
        echo $did;
        $query = "SELECT verificar_productos_compras($p[0], $id_tienda, $id_usuario, '$comuna', $did);";

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