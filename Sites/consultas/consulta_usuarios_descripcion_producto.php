<?php include('../templates/header.html');   ?>

<body>
<?php
  #Llama a conexión, crea el objeto PDO y obtiene la variable $db
  require("../config/conexion.php");

  #Se obtiene el valor del input del usuario
  $descripcion = $_POST["descripcion_producto"];

  #Se construye la consulta como un string
 	$query = "SELECT usuarios.nombre
     FROM productos, productoscompras, compras, usuarios
     WHERE $descripcion = productos.descripcion AND
     productos.pid = productoscompras.pid AND
     productoscompras.cid = compras.cid AND
     compras.uid = usuarios.uid
     ";

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