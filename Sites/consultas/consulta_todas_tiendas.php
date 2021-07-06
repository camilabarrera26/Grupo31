<body>
<?php
  #Llama a conexión, crea el objeto PDO y obtiene la variable $db
  require("../config/conexion.php");

  #Se construye la consulta como un string
 	$query = "SELECT tiendas.tid, tiendas.nombre, comunas.comuna_cobertura FROM tiendas, comunas WHERE tiendas.direccion = comunas.did;";

  #Se prepara y ejecuta la consulta. Se obtienen TODOS los resultados
	$result = $dbimp -> prepare($query);
	$result -> execute();
	$tienda = $result -> fetchAll();
  ?>

<?php include('../templates/header.html');   ?>

  <table class='table'>
    <tr>
      <th>Tienda</th>
      <th>Comuna</th>
    </tr>
        <?php
        // echo $tienda;
        foreach ($tienda as $t) {
          echo "<tr><td><a href='consulta_tienda.php?id=$t[0]&nombre=$t[1]' role='button' class='btn'> $t[1] </a></td><td>$t[2]</td></tr>";
      }
      ?>
  </table>

<?php include('../templates/footer.html'); ?>
</body>
