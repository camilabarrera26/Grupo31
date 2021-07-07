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
  $query2 = "SELECT tiendas.nombre, comunas.direccion, comunas.comuna_cobertura, compras.cid FROM compras, tiendas, comunas WHERE compras.uid = $id AND comunas.did = compras.did AND tiendas.tid = compras.tid;";
  $query3 = "SELECT despacho.cid, entregado_por.fecha FROM despacho, entregado_por WHERE despacho.did = entregado_por.did ORDER BY entregado_por.fecha ASC";
  $query4 = "SELECT productos.nombre, compras.cid FROM productos, productoscompras, compras WHERE compras.uid = $id AND productos.pid = productoscompras.pid AND productoscompras.cid = compras.cid;";

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

  require("config/conexion.php");
  $result4 = $dbimp -> prepare($query4);
  $result4 -> execute();
  $nombre = $result4 -> fetchAll();
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

<?php
  $pila = array();
  foreach ($fecha as $fe){
    foreach ($compra as $c){
      foreach ($nombre as $n){
        if ($fe[0] == $c[3]){
          if ($n[1] == $c[3]){
            $line = "<tr><td>$c[0]</td><td>$n[0]</td><td>$c[1]</td><td>$c[2]</td><td>$fe[1]</td></tr>";
            array_push($pila, $line);
          }
        }
      }
    }
  }

  $number_of_elements = sizeof($pila);
?>

<div class='py-5'>
<div class="container-xl px-lg-4">
  <div class="p-4 p-lg-4 bg-primary rounded-3 text-center">
    <div class="m-4 m-lg-4">
      <h1 class="display-6 fw-bold">Historial de Compras</h1>
        <table class='table'>
          <tr>
            <th>Nombre Tienda</th>
            <th>Producto</th>
            <th>Dirección de envío</th>
            <th>Comuna de envío</th>
            <th>Fecha de envío</th>
           </tr>
           <?php
             foreach ($pila as $p){
              echo $p;
            }
           ?>
        </table>
    </div>
  </div>
</div>
</div>

<?php

$query5 = "SELECT verficar_jefe($id);";

$result5 = $dbp -> prepare($query5);
$result5 -> execute();
$jefe = $result5 -> fetchAll();

if ($jefe == true) {
  echo "<h1> Administrativos en su Unidad </h1>";
  $query6 = "SELECT rellenar con query que obtiene administrativos trabajando en $direccion;";

  $result6 = $dbp -> prepare($query6);
  $result6 -> execute();
  $administrativos = $result6 -> fetchAll();
  echo "<table class='table'>";
  echo "<tr>";
  echo "<th>Nombre administrativo</th>";
  echo "</tr>";
        foreach ($administrativos as $a) {
                echo "<tr><td>$a[0]</td></tr>";
          }
  echo "</table>";
} 
?>

<div class='py-5'>
<div class="container-xl px-lg-4">
  <div class="p-4 p-lg-4 bg-primary rounded-3 text-center">
    <div class="m-4 m-lg-4">
      <h1 class="display-6 fw-bold">Consulte por los 3 productos comestibles y no comestibles más económicos de la tienda:</h1>
        <p class="fs-4">Aquí podrás cambiar tu contraseña:
          <a href='consultas/cambio_contrasena.php' role='button' class='btn'> Cambiar Contraseña </a>
        </p>  
    </div>
  </div>
</div>
</div>   



<a href='index.php' role='button' class='btn'> Volver </a>