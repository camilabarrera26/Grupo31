<?php
session_start();
?>

<?php 
  if(isset($_SESSION['id'])){
    include('templates/header_login.html'); 
  }  
  else {
  include('templates/header.html');  
  }
?>

<header class="py-5">
    <div class="container px-lg-0">
        <div class="p-4 p-lg-2 bg-light rounded-3 text-center">
            <div class="m-4 m-lg-2">
                <h1 class="display-5 fw-bold"><?php $_SESSION["nombre"] ?></h1> 
                 <p class="fs-4">Aquí podrás encontrar tu información</p>  
            </div>
        </div>
    </div>
</header>
<body>

<?php
  #Llama a conexión, crea el objeto PDO y obtiene la variable $db
  require("config/conexion.php");
#Se construye la consulta como un string
  $id = $_SESSION["id"];
  $query = "SELECT usuarios.nombre, usuarios.rut, usuarios.edad, usuarios.sexo, usuarios.direccion FROM usuarios WHERE usuarios.uid = $id;";

  #Se prepara y ejecuta la consulta. Se obtienen TODOS los resultados
  $result = $dbimp -> prepare($query);
  $result -> execute();
  $usuario = $result -> fetchAll();
?>

  <table class='table'>
    <tr>
      <th>Nombre</th>
      <th>Rut</th>
      <th>Edad</th>
      <th>Sexo</th>
      <th>Dirección</th>
    </tr>
        <?php
        // echo $tienda;
        foreach ($usuario as $u) {
          echo "<tr><td>$u[0]</td><td>$u[1]</td><td>$u[2]</td><td>$u[3]</td><td>$u[4]</td></tr>";
      }
      ?>    
  </table>

 <h1> Historial de Compras </h1>

<a href='index.php' role='button' class='btn'> Volver </a>