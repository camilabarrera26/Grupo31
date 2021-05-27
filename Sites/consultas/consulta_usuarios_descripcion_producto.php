<?php include('../templates/header.html');   ?>

<body>
<?php
  #Llama a conexión, crea el objeto PDO y obtiene la variable $db
  require("../config/conexion.php");

  #Se obtiene el valor del input del usuario
  $descripcion = $_POST["descripcion_producto"];
  $descripcion = strtolower($descripcion);
  $descripcion = trim($descripcion);
  $count = 0;
  while ($count == 0):
    $count = 1;
    if (strpos($descripcion, "á")) {
      $descripcion = str_replace('á', 'a', $descripcion);
      $count = 0;
    } elseif (strpos($descripcion, "é")) {
      $descripcion = str_replace('é', 'e', $descripcion);
      $count = 0;
    } elseif (strpos($descripcion, "í")) {
      $descripcion = str_replace('í', 'i', $descripcion);
      $count = 0;
    } elseif (strpos($descripcion, "ó")) {
      $descripcion = str_replace('ó', 'o', $descripcion);
      $count = 0;
    } elseif (strpos($descripcion, "ú")) {
      $descripcion = str_replace('ú', 'u', $descripcion);
      $count = 0;
    }
  endwhile;

  #Se construye la consulta como un string
 	$query = "SELECT DISTINCT usuarios.nombre FROM productos, productoscompras, compras, usuarios WHERE productos.descripcion LIKE '%%$descripcion%%' AND productos.pid = productoscompras.pid AND productoscompras.cid = compras.cid AND compras.uid = usuarios.uid;";

  #Se prepara y ejecuta la consulta. Se obtienen TODOS los resultados
	$result = $db -> prepare($query);
	$result -> execute();
	$usuarios = $result -> fetchAll();
  ?>

  <table class='table'>
    <tr>
      <th>Usuarios</th>
    </tr>
  
      <?php
        // echo $usuarios;
        foreach ($usuarios as $p) {
          echo "<tr><td>$p[0]</td></tr>";
      }
      ?>
      
  </table>

<?php include('../templates/footer.html'); ?>