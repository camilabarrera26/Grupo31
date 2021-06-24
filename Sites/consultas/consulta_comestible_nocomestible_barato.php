<?php include('../templates/header.html');   ?>

<body>

<?php 
$id = $_REQUEST['id']; 
$nombre = $_REQUEST['nombre']; 
?>

<?php
  #Llama a conexión, crea el objeto PDO y obtiene la variable $db
  require("../config/conexion.php");

  #Se construye la consulta como un string
 	$query1 = "SELECT productoscomestibles.nombre FROM productoscomestibles, productostiendas WHERE productoscomestibles.pid=productostiendas.pid AND productostiendas.tid=$id ORDER BY productoscomestibles.precio ASC LIMIT 3;";
  $query2 = "SELECT productosnocomestibles.nombre FROM productosnocomestibles, productostiendas WHERE productosnocomestibles.pid=productostiendas.pid AND productostiendas.tid=$id ORDER BY productosnocomestibles.precio ASC LIMIT 3;";
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
          echo "<tr><td>$c[0]</td></tr>";
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
          echo "<tr><td>$c[0]</td></tr>";
      }
      ?>
      
  </table>

  <?php
    echo "<a href='consulta_tienda.php?id=$id' role='button' class='btn'> Volver </a>";
  ?>