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
  $query2 = "SELECT tiendas.nombre, comunas.direccion, comunas.comuna_cobertura, compras.cid FROM compras, tiendas, comunas WHERE compras.uid = $id AND comunas.did = compras.did AND tiendas.tid = compras.tid ORDER BY compras.cid ASC;";
  $query3 = "SELECT productos.nombre, compras.cid FROM productos, productoscompras, compras WHERE compras.uid = $id AND productos.pid = productoscompras.pid AND productoscompras.cid = compras.cid;";

  #Se prepara y ejecuta la consulta. Se obtienen TODOS los resultados
  $result = $dbimp -> prepare($query);
  $result -> execute();
  $usuario = $result -> fetchAll();

  #Consulta historial compras
  $result2 = $dbimp -> prepare($query2);
  $result2 -> execute();
  $compra = $result2 -> fetchAll();

  require("config/conexion.php");
  $result3 = $dbimp -> prepare($query3);
  $result3 -> execute();
  $nombre = $result3 -> fetchAll();
?>

<div class='py-5'>
<div class="container-xl px-lg-4">
  <div class="p-4 p-lg-4 bg-primary rounded-3 text-center">
    <div class="m-4 m-lg-4">
    <table class='table'>
      <tr>
        <th>Nombre</th>
        <th>Rut</th>
        <th>Edad</th>
        <th>Sexo</th>
        <th>Dirección</th>
      </tr>
      <?php
        foreach ($usuario as $u) {
          echo "<tr><td>$u[0]</td><td>$u[1]</td><td>$u[2]</td><td>$u[3]</td><td>$u[4]</td></tr>";
      }
      ?>
    </table>
    </div>
  </div>
</div>
</div>   

<?php

$query7 = "SELECT usuarios.rut FROM usuarios WHERE usuarios.uid = $id;";
$result7 = $dbimp -> prepare($query7);
$result7 -> execute();
$rut1 = $result7 -> fetchAll();

foreach ($rut1 as $r){
  echo $r[0];
  $query5 = "SELECT verificar_jefe('$r[0]');";

  $result5 = $dbp -> prepare($query5);
  $result5 -> execute();
  $jefe = $result5 -> fetchAll();
  break;
}

$puesto = "administracion";

if ($jefe == true) {
  echo "<h1> Administrativos en su Unidad </h1>";
  $query6 = "SELECT Personal.pid, Personal.nombre, Personal.rut, Personal.sexo, Personal.edad, Trabaja_en.clasificacion
            FROM Personal,  Trabaja_en WHERE Personal.pid =  Trabaja_en.pid AND Trabaja_en.clasificacion != $puesto
            Trabaja_en.uid = (SELECT Trabaja_en.uid From Personal, Trabaja_en WHERE Personal.rut = $rut) ORDER BY Personal.pid;";

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

<?php
  $pila = array();
  foreach ($compra as $c){
    foreach ($nombre as $n){
      if ($n[1] == $c[3]){
        $line = "<tr><td>$c[0]</td><td>$n[0]</td><td>$c[1]</td><td>$c[2]</td></tr>";
        array_push($pila, $line);
      }
    }
  }

  $number_of_elements = sizeof($pila);
?>

<h1> Historial de Compras </h1>
<table class='table'>
  <tr>
    <th>Nombre Tienda</th>
    <th>Producto</th>
    <th>Dirección de envío</th>
    <th>Comuna de envío</th>
  </tr>
    <?php
    foreach ($pila as $p){
    echo $p;
    }
    ?>
    

</table>

<p class="fs-4">Aquí podrás cambiar tu contraseña:
  <a href='consultas/cambio_contrasena.php' role='button' class='btn'> Cambiar Contraseña </a>
  </p>  

<a href='index.php' role='button' class='btn'> Volver </a>

    