<?php
session_start();
if(!isset($_SESSION['id'])) // If session is not set then redirect to Login Page
       {
           header("Location: ../login.php");  
       }
?>

<header>
<link href="styles/index.css" rel="stylesheet" />
<link rel="stylesheet" href="../styles/index.css">
</header>

<?php 
  if(isset($_SESSION['id'])){
    include('../templates/header_login.html'); 
  }  
  else {
  include('../templates/header.html');  
  }
?>

<?php
    $id = $_REQUEST['id']; 
    $nombre = $_REQUEST['nombre'];
    $tipo = $_REQUEST['tipo']; 
?>

<header class="py-5">
    <div class="container px-lg-0">
        <div class="p-4 p-lg-2 bg-light rounded-3 text-center">
            <div class="m-4 m-lg-2">
                <h1 class="display-5 fw-bold"><?php echo ucfirst($nombre); ?></h1> 
                <p class="fs-4">Aquí podrás encontrar especificaciones del producto.</p>  
            </div>
        </div>
    </div>
</header>

<body>
<?php
  #Llama a conexión, crea el objeto PDO y obtiene la variable $db
  require("../config/conexion.php");

  #Se construye la consulta como un string
  if ($tipo == 'comestible'){
    $query = "SELECT productoscomestibles.tipo FROM productoscomestibles WHERE productoscomestibles.pid = $id;";
    $result = $dbimp -> prepare($query);
	$result -> execute();
	$producto = $result -> fetchAll();

    foreach ($producto as $t) {
        if ($t[0] == 'fresco'){
            $query = "SELECT productoscomestibles.pid, productoscomestibles.nombre, productoscomestibles.precio, productoscomestibles.descripcion, productoscomestibles.fecha_expiracion, productosfrescos.duracion FROM productosfrescos, productoscomestibles WHERE productosfrescos.pid = $id AND productosfrescos.pid = productoscomestibles.pid;";
        } elseif ($t[0] == 'congelado') {
            $query = "SELECT productoscomestibles.pid, productoscomestibles.nombre, productoscomestibles.precio, productoscomestibles.descripcion, productoscomestibles.fecha_expiracion, productoscongelados.peso FROM productoscongelados, productoscomestibles WHERE productoscongelados.pid = $id AND productoscongelados.pid = productoscomestibles.pid;";
        } else {
            $query = "SELECT productoscomestibles.pid, productoscomestibles.nombre, productoscomestibles.precio, productoscomestibles.descripcion, productoscomestibles.fecha_expiracion, productosenconserva.metodo_conservacion FROM productosenconserva, productoscomestibles WHERE productosenconserva.pid = $id AND productosenconserva.pid = productoscomestibles.pid;";
        }
    }
  } else {
    $query = "SELECT productosnocomestibles.pid, productosnocomestibles.nombre, productosnocomestibles.precio, productosnocomestibles.descripcion, productosnocomestibles.largo, productosnocomestibles.alto, productosnocomestibles.ancho, productosnocomestibles.peso FROM productosnocomestibles WHERE productosnocomestibles.pid = $id;";
  }

  #Se prepara y ejecuta la consulta. Se obtienen TODOS los resultados
	$result = $dbimp -> prepare($query);
	$result -> execute();
	$producto1 = $result -> fetchAll();
  ?>

<div class='py-5'>
<div class="container-xl px-lg-4">
  <div class="p-4 p-lg-4 bg-primary rounded-3 text-center">
    <div class="m-4 m-lg-4">
    <table class='table'>
    <tr>
      <th>Id</th>
      <th>Nombre</th>
      <th>Precio</th>
      <th>Descripción</th>
      <?php
          if ($tipo == 'comestible'){
            echo "<th>Fecha de Expiración</th>";
            foreach ($producto as $t) {
            }
            foreach ($producto as $t) {
                if ($t[0] == 'fresco'){
                    echo "<th>Duración</th>";
                } elseif ($t[0] == 'congelado') {
                    echo "<th>Peso</th>";
                } else {
                    echo "<th>Método de Conservación</th>";
                }
            }
          } else {
            echo "<th>Largo</th>";
            echo "<th>Alto</th>";
            echo "<th>Ancho</th>";
            echo "<th>Peso</th>";
          }
      ?>
    </tr>
        <?php
         if ($tipo == 'comestible') {
          foreach ($producto1 as $t) {
            $nombre_mayuscula = ucfirst($t[1]);
            echo "<tr><td>$t[0]</td><td>$nombre_mayuscula</td><td>$$t[2]</td><td>$t[3]</td><td>$t[4]</td><td>$t[5]</td></tr>";
          }
         } else {
            foreach ($producto1 as $t) {
              $nombre_mayuscula = ucfirst($t[1]);
              echo "<tr><td>$t[0]</td><td>$nombre_mayuscula</td><td>$$t[2]</td><td>$t[3]</td><td>$t[4]</td><td>$t[5]</td><td>$t[5]</td><td>$t[6]</td></tr>";
            }
         }
      ?>    
    </table>
    </div>
  </div>
</div>
</div>   

<form action="consulta_todos_productos.php" method="get">
    <input type="submit" value="Volver">
</form>
</body>
