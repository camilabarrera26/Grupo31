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
                <p class="fs-4">Aquí podrás encontrar una lista de todos los producto ofrecidos por nuestras tiendas.</p>  
            </div>
        </div>
    </div>
</header>

<body>
<?php
  #Llama a conexión, crea el objeto PDO y obtiene la variable $db
  require("../config/conexion.php");

  #Se construye la consulta como un string
 	$query = "SELECT productos.pid, productos.nombre, productos.precio, productos.tipo, productos.pid FROM productos ORDER BY productos.pid;";

  #Se prepara y ejecuta la consulta. Se obtienen TODOS los resultados
	$result = $dbimp -> prepare($query);
	$result -> execute();
	$productos = $result -> fetchAll();
  ?>

  

  <table class='table'>
    <tr>
      <th>Id</th>
      <th>Productos</th>
      <th>Precio</th>
      <th>Tipo</th>
    </tr>
        <?php
        // echo $productos;
    foreach ($productos as $p) {
          $nombre_mayuscula = ucfirst($p[1]);
          echo "<tr><td>$p[4]</td><td><a href='consulta_producto.php?id=$p[0]&nombre=$p[1]&tipo=$p[3]' role='button' class='btn'> $nombre_mayuscula </a></td><td>$$p[2]</td><td>$p[3]</td></tr>";
      }
      ?>    
  </table>

<?php include('../templates/footer.html'); ?>
</body>
