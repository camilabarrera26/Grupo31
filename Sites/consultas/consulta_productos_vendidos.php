<?php include('../templates/header.html');   ?>

<body>
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
 	$query = ";";
  #Se prepara y ejecuta la consulta. Se obtienen TODOS los resultados
	$result = $dbimp -> prepare($query);
	$result -> execute();
	$productos = $result -> fetchAll();
  ?>

  <table class='table'>
    <tr>
      <th>Nombre</th>
      <th>Tipo</th>
      <th>Descripción</th>
    </tr>
  
      <?php
        // echo $productos;
        foreach ($productos as $p) {
          echo "<tr><td><a href='consulta_todos_productos.php?id=$p[0]' role='button' class='btn'>$p[1]</a></td><td>$tipo]</td><td>$p[2]</td></tr>";
      }
      ?>
      
  </table>

<?php include('../templates/footer.html'); ?>