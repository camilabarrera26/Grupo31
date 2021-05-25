<?php include('../templates/header.html');   ?>

<body>
<?php
  #Llama a conexión, crea el objeto PDO y obtiene la variable $db
  require("../config/conexion.php");

  #Se obtiene el valor del input del usuario
  $comuna = $_POST["comuna_tienda"];

  #Se construye la consulta como un string
 	$query = "SELECT comunas.comuna_cobertura, tiendas.nombre, personal.nombre FROM comunas, tiendas, personal WHERE '$comuna' = comunas.comuna_cobertura AND comunas.did = tiendas.direccion AND tiendas.jefe = personal.eid;";

  #Se prepara y ejecuta la consulta. Se obtienen TODOS los resultados
	$result = $db -> prepare($query);
	$result -> execute();
	$jefes = $result -> fetchAll();
  ?>

  <table class='table'>
    <tr>
      <th>Comuna</th>
      <th>Tienda</th>
      <th>Jefe</th>
    </tr>
  
      <?php
        // echo $jefes;s
        foreach ($jefes as $p) {
          echo "<tr><td>$p[0]</td><td>$p[1]</td><td>$p[2]</td></tr>";
      }
      ?>
      
  </table>

<?php include('../templates/footer.html'); ?>