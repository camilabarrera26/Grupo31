<?php include('../templates/header.html');   ?>

<body>
<?php
  #Llama a conexión, crea el objeto PDO y obtiene la variable $db
  require("../config/conexion.php");

  #Se obtiene el valor del input del usuario
  $tipo = $_POST["tipo"];

  #Se construye la consulta como un string
 	$query = "SELECT tiendas.nombre, COUNT(compras.cid) as cantidad 
     FROM $tipo, productoscompras, compras, tiendas 
     WHERE $tipo.pid = productoscompras.pid AND
     productoscompras.cid = compras.cid AND
     compras.tid = tiendas.tid
     GROUP BY tiendas.nombre
     ORDER BY cantidad DESC
     LIMIT 5";

  #Se prepara y ejecuta la consulta. Se obtienen TODOS los resultados
	$result = $db -> prepare($query);
	$result -> execute();
	$productos = $result -> fetchAll();
  ?>

  <table class='table'>
    <tr>
      <th>Comuna</th>
      <th>Edad Promedio Trabajadores</th>
    </tr>
  
      <?php
        // echo $productos;
        foreach ($productos as $p) {
          echo "<tr><td>$p[0]</td><td>$p[1]</td></tr>";
      }
      ?>
      
  </table>

<?php include('../templates/footer.html'); ?>