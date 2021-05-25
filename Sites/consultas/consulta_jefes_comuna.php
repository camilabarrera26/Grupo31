<?php include('../templates/header.html');   ?>

<body>
<?php
  #Llama a conexión, crea el objeto PDO y obtiene la variable $db
  require("../config/conexion.php");

  #Se obtiene el valor del input del usuario
  $comuna = $_POST["comuna_tienda"];
  $comuna = strtolower($comuna);
  $comuna = trim($comuna);
  $count = 0;
  while ($count == 0):
    $count = 1;
    if (strpos($comuna, "á")) {
      $comuna = str_replace('á', 'a', $comuna);
      $count = 0;
    } elseif (strpos($comuna, "é")) {
      $comuna = str_replace('é', 'e', $comuna);
      $count = 0;
    } elseif (strpos($comuna, "í")) {
      $comuna = str_replace('í', 'i', $comuna);
      $count = 0;
    } elseif (strpos($comuna, "ó")) {
      $comuna = str_replace('ó', 'o', $comuna);
      $count = 0;
    } elseif (strpos($comuna, "ú")) {
      $comuna = str_replace('ú', 'u', $comuna);
      $count = 0;
    }
  endwhile;

  #Se construye la consulta como un string
 	$query = "SELECT comunas.comuna_cobertura, tiendas.nombre, personal.nombre FROM comunas, tiendas, personal WHERE comunas.comuna_cobertura LIKE '%%$comuna%%' AND comunas.did = tiendas.direccion AND tiendas.jefe = personal.eid;";

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