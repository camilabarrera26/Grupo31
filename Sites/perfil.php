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
                <h1 class="display-5 fw-bold">Mi Tienda Web</h1> 
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
  $query2 = "SELECT tiendas.nombre, comunas.direccion, comunas.comuna_cobertura, compras.cid, productos.nombre FROM compras, tiendas, comunas, productos, productoscompras WHERE compras.uid = $id AND comunas.did = compras.did AND tiendas.tid = compras.tid AND compras.cid = productoscompras.cid AND productoscompras.pid = productos.pid;";
  $query3 = "SELECT despacho.cid, entregado_por.fecha FROM despacho, entregado_por WHERE despacho.did = entregado_por.did ORDER BY entregado_por.fecha ASC";

  #Se prepara y ejecuta la consulta. Se obtienen TODOS los resultados
  $result = $dbimp -> prepare($query);
  $result -> execute();
  $usuario = $result -> fetchAll();

  #Consulta historial compras
  $result2 = $dbimp -> prepare($query2);
  $result2 -> execute();
  $compra = $result2 -> fetchAll();

  require("config/conexion.php");
  $result3 = $dbp -> prepare($query3);
  $result3 -> execute();
  $fecha = $result3 -> fetchAll();

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

  <p class="fs-4">Aquí podrás cambiar tu contraseña:</p>  
  <a href='consultas/cambio_contrasena.php' role='button' class='btn'> Cambiar </a>

 <h1> Historial de Compras </h1>
  <table class='table'>
      <tr>
        <th>Nombre Tienda</th>
        <th>Dirección de envío</th>
        <th>Comuna de envío</th>
        <th>Fecha de envío</th>
      </tr>
          <?php
          foreach ($fecha as $fe) {
            foreach ($compra as $c) {
              if ($fe[0] == $c[4]) {
                echo "<tr><td>$c[0]</td><td>$c[1]</td><td>$c[2]</td><td>$fe[1]</td></tr>";
                }
              }
            }
          ?>
  </table>

<a href='index.php' role='button' class='btn'> Volver </a>