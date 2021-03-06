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
?>

<header class="py-5">
    <div class="container px-lg-0">
        <div class="p-4 p-lg-2 bg-light rounded-3 text-center">
            <div class="m-4 m-lg-2">
                <h1 class="display-5 fw-bold"><?php echo "$nombre"; ?></h1> 
                <p class="fs-4">Aquí podrás encontrar información sobre la tienda y comprar productos.</p>  
            </div>
        </div>
    </div>
</header>

<div class='py-5'>
<div class="container-xl px-lg-4">
  <div class="p-4 p-lg-4 bg-primary rounded-3 text-center">
    <div class="m-4 m-lg-4">
      <h1 class="display-6 fw-bold">Consulte por los 3 productos comestibles y no comestibles más económicos de la tienda:</h1>
        <?php
          echo "<a href='consulta_comestible_nocomestible_barato.php?id=$id&nombre=$nombre' role='button' class='btn'> Consulta </a>";
        ?>
    </div>
  </div>
</div>
</div>

<div class='py-5'>
<div class="container-xl px-lg-4">
  <div class="p-4 p-lg-4 bg-primary rounded-3 text-center">
    <div class="m-4 m-lg-4">
      <h1 class="display-6 fw-bold">Busque algún producto por nombre:</h1>
      <form action="consulta_productos_vendidos.php" method="post">
        Producto:
        <input type="text" name="producto">
        <input type="hidden" name="id" value="<?php echo $id; ?>">
        <input type="hidden" name="nombre" value="<?php echo $nombre; ?>">
        <input type="submit" value="Buscar" class="btn">
       </form>
    </div>
  </div>
</div>
</div>

<?php

#Llama a conexión, crea el objeto PDO y obtiene la variable $db
require("../config/conexion.php");

$query = "SELECT productos.pid, productos.nombre FROM productos;";
$result = $dbimp -> prepare($query);
$result -> execute();
$pid = $result -> fetchAll();

$id_usuario = $_SESSION["id"];

$query1 = "SELECT comunas.direccion, comunas.comuna_cobertura, comunas.did FROM comunas, direccionesusuarios, usuarios WHERE comunas.did = direccionesusuarios.did and direccionesusuarios.uid = usuarios.uid and usuarios.uid = $id_usuario;";
$result1 = $dbimp -> prepare($query1);
$result1 -> execute();
$direcciones = $result1 -> fetchAll();
?>

<div class='py-5'>
<div class="container-xl px-lg-4">
  <div class="p-4 p-lg-4 bg-primary rounded-3 text-center">
    <div class="m-4 m-lg-4">
      <h1 class="display-6 fw-bold">Seleccione el ID del producto que desea comprar y su direccion:</h1>
      <form action="consulta_compra.php" method="post">
        ID Producto:
        <select name='id_producto'>
        <?php
        foreach ($pid as $p) {
            echo "<option value=$p[0]>$p[0] - $p[1]</option>";
        }
        ?>
        </select>
        Direccion:
        <select name='direcciones'>
        <?php
        foreach ($direcciones as $d) {
            echo "<option value=$d[1]|$d[2]>$d[0]</option>";
        }
        ?>
        </select>
        <input type="hidden" name="id" value="<?php echo $id; ?>">
        <input type="hidden" name="nombre" value="<?php echo $nombre; ?>">
        <input type="submit" value="Comprar" class='btn'>
      </form>
    </div>
  </div>
</div>
</div>

<form action="consulta_todas_tiendas.php" method="get">
    <input type="submit" value="Volver">
</form>


