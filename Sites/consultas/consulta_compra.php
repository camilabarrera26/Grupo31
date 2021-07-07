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
        $query2 = "SELECT verificar_productos_tiendas($p[0], $id_tienda, $id_usuario, '$comuna', $did);";

        // Ejecutamos las querys para efectivamente insertar los datos
        $result2 = $dbimp -> prepare($query2);
        $result2 -> execute();
        $result2 = $result2 -> fetchAll();
    }

    if ($result2 == true) {
        echo 'Compra Exitosa';
        #despacho.did, despacho.direccion_origen_id, despacho.direccion_destino_id, despacho.cid, entregado_por.vid, entregado_por.pid, entregado_por.fecha FROM despacho, entregado_por WHERE despacho.did = entregado_por.did ORDER BY entregado_por.fecha ASC";
        $result3 = $dbp -> prepare($query3);
        $result3 -> execute();
        $fecha = $result3 -> fetchAll();

        // Set the new timezone
        date_default_timezone_set('America/Santiago');
        $date = date('d-m-y h:i:s');
        
        $query4 = "SELECT insertar_fecha($p[0], $id_tienda, $id_usuario, '$comuna', $did);";
        $result4 = $dbimp -> prepare($query4);
        $result4 -> execute();
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