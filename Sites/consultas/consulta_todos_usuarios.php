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
                <p class="fs-4">Aquí podrás encontrar una lista de todos los usuarios de nuestras tiendas.</p>  
            </div>
        </div>
    </div>
</header>

<body>
<?php
  #Llama a conexión, crea el objeto PDO y obtiene la variable $db
  require("../config/conexion.php");

  #Se construye la consulta como un string
 	$query = "SELECT usuarios.nombre, usuarios.rut, usuarios.sexo, usuarios.edad, usuarios.direccion, usuarios.uid FROM usuarios ORDER BY usuarios.uid;";
  #Se prepara y ejecuta la consulta. Se obtienen TODOS los resultados
	$result = $dbimp -> prepare($query);
	$result -> execute();
	$usuario = $result -> fetchAll();
  ?>

<div class='py-5'>
<div class="container-xl px-lg-4">
  <div class="p-4 p-lg-4 bg-primary rounded-3 text-center">
    <div class="m-4 m-lg-4">
    <table class='table'>
    <tr>
      <th>Id</th>
      <th>Nombre</th>
      <th>Rut</th>
      <th>Sexo</th>
      <th>Edad</th>
      <th>Dirección</th>
    </tr>
        <?php
        // echo $tienda;
        foreach ($usuario as $u) {
          echo "<tr><td>$u[5]</td><td>$u[0]</td><td>$u[1]</td><td>$u[2]</td><td>$u[3]</td><td>$u[4]</td></tr>";
      }
      ?>    
    </table>
    </div>
  </div>
</div>
</div>   

<?php include('../templates/footer.html'); ?>
</body>
