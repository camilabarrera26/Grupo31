<?php
session_start();
if(!isset($_SESSION['id'])) // If session is not set then redirect to Login Page
       {
           header("Location: ../login.php");  
       }
?>

<?php 
  if(isset($_SESSION['id'])){
    include('templates/header_login.html'); 
  }  
  else {
  include('templates/header.html');  
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
                <p class="fs-4">Aquí podrás encontrar los productos más económicos de la tienda.</p>  
            </div>
        </div>
    </div>
</header>

<?php
  #Llama a conexión, crea el objeto PDO y obtiene la variable $db
  require("../config/conexion.php");

  #Se construye la consulta como un string
 	$query1 = "SELECT productoscomestibles.nombre, productoscomestibles.pid FROM productoscomestibles, productostiendas WHERE productoscomestibles.pid=productostiendas.pid AND productostiendas.tid=$id ORDER BY productoscomestibles.precio ASC LIMIT 3;";
  $query2 = "SELECT productosnocomestibles.nombre, productosnocomestibles.pid FROM productosnocomestibles, productostiendas WHERE productosnocomestibles.pid=productostiendas.pid AND productostiendas.tid=$id ORDER BY productosnocomestibles.precio ASC LIMIT 3;";
  #Se prepara y ejecuta la consulta. Se obtienen TODOS los resultados
	$result1 = $dbimp -> prepare($query1);
	$result1 -> execute();
	$comestibles = $result1 -> fetchAll();
  $result2 = $dbimp -> prepare($query2);
	$result2 -> execute();
	$nocomestibles = $result2 -> fetchAll();
  ?>

  <table class='table'>
    <tr>
      <th>Productos Comestibles Más Baratos</th>
    </tr>
  
      <?php
        // echo $comestibles;
        foreach ($comestibles as $c) {
          $tipo = 'comestible';
          $nombre_mayuscula = ucfirst($c[0]);
          echo "<tr><td><a href='consulta_producto.php?id=$c[1]&nombre=$c[0]&tipo=$tipo' role='button' class='btn'>$nombre_mayuscula</td></tr>";
      }
      ?>
      
  </table>

  <table class='table'>
    <tr>
      <th>Productos No Comestibles Más Baratos</th>
    </tr>
  
      <?php
        // echo $nocomestibles;
        foreach ($nocomestibles as $c) {
          $tipo = 'no comestible';
          $nombre_mayuscula = ucfirst($c[0]);
          echo "<tr><td><a href='consulta_producto.php?id=$c[1]&nombre=$c[0]&tipo=$tipo' role='button' class='btn'>$nombre_mayuscula</td></tr>";
      }
      ?>
      
  </table>

  <?php
    echo "<a href='consulta_tienda.php?id=$id&nombre=$nombre' role='button' class='btn'> Volver </a>";
  ?>