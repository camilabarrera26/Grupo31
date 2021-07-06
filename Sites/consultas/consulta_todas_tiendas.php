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

<header class="py-5">
    <div class="container px-lg-0">
        <div class="p-4 p-lg-2 bg-light rounded-3 text-center">
            <div class="m-4 m-lg-2">
                <h1 class="display-5 fw-bold">Mi Tienda Web</h1> 
                <p class="fs-4">Aquí podrás encontrar una lista de todas nuestras tiendas.</p>  
            </div>
        </div>
    </div>
</header>

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
