<?php include('../templates/header.html');   ?>

<body>

<?php 
$id = $_POST["id_tienda"];
?>

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

  <table class='table'>
    <tr>
      <th>Nombre</th>
      <th>Descripción</th>
      <th>Tipo</th>
    </tr>
  
      <?php
        // echo $productos;
        foreach ($productos as $p) {
          echo "<tr><td><a href='consulta_todos_productos.php?id=$p[0]' role='button' class='btn'>$p[1]</a></td><td>$p[2]</td><td>$p[3]</td></tr>";
      }
      ?>
      
  </table>

<form action="consulta_tienda.php" method="get">
    <input type="hidden" name="id_tienda" value="<?php echo $id; ?>">
    <input type="submit" value="Volver">
</form>