<?php include('../templates/header.html');   ?>

<body>
<?php
  #Llama a conexión, crea el objeto PDO y obtiene la variable $db
  require("../config/conexion.php");

  #Se construye la consulta como un string
 	$query = "SELECT tiendas.nombre, comunas.comuna_cobertura FROM comunas, direccionesdespacho, tiendas WHERE comunas.did = direccionesdespacho.did AND direccionesdespacho.tid = tiendas.tid;";
  #Se prepara y ejecuta la consulta. Se obtienen TODOS los resultados
	$result = $db -> prepare($query);
	$result -> execute();
	$comunas = $result -> fetchAll();
  echo $result;
  ?>

  <table class='table'>
    <tr>
      <th>Tienda</th>
      <th> Comunas Cobertura</th>
    </tr>
  
      <?php
        // echo $comunas;
        foreach ($comunas as $p) {
          echo "<tr><td>$p[0]</td><td>$p[1]</td></tr>";
      }
      ?>
      
  </table>

<?php include('../templates/footer.html'); ?>