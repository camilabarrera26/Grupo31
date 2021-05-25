<?php include('../templates/header.html');   ?>

<body>
<?php
  #Llama a conexión, crea el objeto PDO y obtiene la variable $db
  require("../config/conexion.php");

  #Se obtiene el valor del input del usuario
  $comuna = $_POST["comuna_tienda"];

  #Se construye la consulta como un string
 	$query = "SELECT comunas.comuna_cobertura, AVG(personal.edad) FROM comunas, tiendas, personaltienda, personal WHERE '$comuna' = comunas.comuna_cobertura AND comunas.did = tiendas.direccion AND tiendas.tid = personaltienda.tid AND personaltienda.eid = personal.eid;";
  echo $query;
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