<?php include('../templates/header.html');   ?>

<body>
<?php
  #Llama a conexión, crea el objeto PDO y obtiene la variable $db
  require("../config/conexion.php");

  #Se obtiene el valor del input del usuario
  $comuna = $_POST["comuna_tienda"];
  echo $comuna;
  $comuna = strtolower($comuna);
  echo $comuna;
  $comuna = trim($comuna);
  echo $comuna;
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
  echo $comuna;

  #Se construye la consulta como un string
 	$query = "SELECT comunas.comuna_cobertura, AVG(personal.edad) FROM comunas, tiendas, personaltienda, personal WHERE comunas.comuna_cobertura LIKE '%%$comuna%%' AND comunas.did = tiendas.direccion AND tiendas.tid = personaltienda.tid AND personaltienda.eid = personal.eid GROUP BY comunas.comuna_cobertura;";
  #Se prepara y ejecuta la consulta. Se obtienen TODOS los resultados
	$result = $db -> prepare($query);
	$result -> execute();
	$edad = $result -> fetchAll();
  ?>

  <table class='table'>
    <tr>
      <th>Comuna</th>
      <th>Edad Promedio Trabajadores</th>
    </tr>
  
      <?php
        // echo $edad;
        foreach ($edad as $p) {
          echo "<tr><td>$p[0]</td><td>$p[1]</td></tr>";
      }
      ?>
      
  </table>

<?php include('../templates/footer.html'); ?>