<head>
<link href="styles/index.css" rel="stylesheet" />
<link rel="stylesheet" href="../styles/index.css">
</head>

<?php include('../templates/header.html');   ?>

<?php
    $id = $_REQUEST['id']; 
    $nombre = $_REQUEST['nombre']; 
?>

<div class="container px-lg-4">
  <div class="p-4 p-lg-4 bg-danger rounded-3 text-center">
    <div class="m-4 m-lg-4">
      <h1 class="display-6 fw-bold">Consulte por los 3 productos comestibles y no comestibles más económicos de la tienda:</h1>
        <?php
          echo "<a href='consulta_comestible_nocomestible_barato.php?id=$id&nombre=$nombre' role='button' class='btn'> Consulta </a>";
        ?>
    </div>
  </div>
</div>

<br>
Busque algún producto por nombre:
<form action="consulta_productos_vendidos.php" method="post">
    Producto:
    <input type="text" name="producto">
    <input type="hidden" name="id_tienda" value="<?php echo $id; ?>">
    <input type="submit" value="Buscar">
</form>
</br>

<?php

#Llama a conexión, crea el objeto PDO y obtiene la variable $db
require("../config/conexion.php");

$query = "SELECT productos.pid FROM productos;";

$result = $dbimp -> prepare($query);
$result -> execute();
$pid = $result -> fetchAll();
?>

<br>
Seleccione el ID del producto que desea comprar:
<form action="consulta_compra.php" method="post">
    ID Producto:
    <select>
    <?php
    foreach ($pid as $p) {
        echo "<option value=$p[0]>$p[0]</option>";
    }
    ?>
    </select>
  <input type="hidden" name="id_tienda" value="<?php echo $id; ?>">
  <input type="submit" value="Comprar">
</form>
</br>

<form action="consulta_todas_tiendas.php" method="get">
    <input type="submit" value="Volver">
</form>


