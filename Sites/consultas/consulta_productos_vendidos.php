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
                <p class="fs-4">Resultados de la búsqueda:</p>  
            </div>
        </div>
    </div>
</header>

<?php
  #Llama a conexión, crea el objeto PDO y obtiene la variable $db
  require("../config/conexion.php");

  #Se obtiene el valor del input del usuario
  $producto = $_POST["producto"];
  $producto = strtolower($producto);
  $producto = trim($producto);
  $count = 0;
  while ($count == 0):
    $count = 1;
    if (strpos($producto, "á")) {
      $producto = str_replace('á', 'a', $producto);
      $count = 0;
    } elseif (strpos($producto, "é")) {
      $producto = str_replace('é', 'e', $producto);
      $count = 0;
    } elseif (strpos($producto, "í")) {
      $producto = str_replace('í', 'i', $producto);
      $count = 0;
    } elseif (strpos($producto, "ó")) {
      $producto = str_replace('ó', 'o', $producto);
      $count = 0;
    } elseif (strpos($producto, "ú")) {
      $producto = str_replace('ú', 'u', $producto);
      $count = 0;
    }
  endwhile;

  #Se construye la consulta como un string
 	$query = "SELECT productos.pid, productos.nombre, productos.descripcion, productos.tipo FROM productos, productostiendas, tiendas WHERE productos.pid = productostiendas.pid AND productostiendas.tid = tiendas.tid AND productos.nombre LIKE '%%$producto%%' AND tiendas.tid = $id;";
  #Se prepara y ejecuta la consulta. Se obtienen TODOS los resultados
	$result = $dbimp -> prepare($query);
	$result -> execute();
	$productos = $result -> fetchAll();
  ?>

<div class='py-5'>
<div class="container-xl px-lg-4">
  <div class="p-4 p-lg-4 bg-primary rounded-3 text-center">
    <div class="m-4 m-lg-4">
    <table class='table'>
    <tr>
      <th>Nombre</th>
      <th>Descripción</th>
      <th>Tipo</th>
    </tr>
  
      <?php
        // echo $productos;
        foreach ($productos as $p) {
          $nombre_mayuscula = ucfirst($p[1]);
          echo "<tr><td><a href='consulta_producto.php?id=$p[0]&nombre=$p[1]&tipo=$p[3]' role='button' class='btn'>$nombre_mayuscula</a></td><td>$p[2]</td><td>$p[3]</td></tr>";
      }
      ?>
    </table>
    </div>
  </div>
</div>
</div>   

  <?php
    echo "<a href='consulta_tienda.php?id=$id&nombre=$nombre' role='button' class='btn'> Volver </a>";
  ?>