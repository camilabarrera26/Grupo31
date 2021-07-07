<?php
session_start();
if(!isset($_SESSION['id'])) // If session is not set then redirect to Login Page
       {
           header("Location: ../login.php");  
       }
?>

<?php 
  if(isset($_SESSION['id'])){
    include('../templates/header_login.html'); 
  }  
  else {
  include('../templates/header.html');  
  }
?>

<?php
  #Llama a conexión, crea el objeto PDO y obtiene la variable $db
  require("../config/conexion.php");

  #Se construye la consulta como un string
 	$query = "SELECT tiendas.tid, tiendas.nombre, comunas.comuna_cobertura, tiendas.tid FROM tiendas, comunas WHERE tiendas.direccion = comunas.did;";

  #Se prepara y ejecuta la consulta. Se obtienen TODOS los resultados
	$result = $dbimp -> prepare($query);
	$result -> execute();
	$tienda = $result -> fetchAll();
  ?>

  <table class='table'>
    <tr>
      <th>Id</th>
      <th>Tienda</th>
      <th>Comuna</th>
    </tr>
        <?php
        // echo $tienda;
        foreach ($tienda as $t) {
          echo "<tr><td>$t[3]</td><td><a href='consulta_tienda.php?id=$t[0]&nombre=$t[1]' role='button' class='btn'> $t[1] </a></td><td>$t[2]</td></tr>";
      }
      ?>
  </table>

<?php include('../templates/footer.html'); ?>
