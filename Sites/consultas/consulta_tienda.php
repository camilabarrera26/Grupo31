<?php include('../templates/header.html');   ?>

<?php
    $id = $_REQUEST['id']; 
    $nombre = $_REQUEST['nombre']; 
?>

<br>
Consulte por los 3 productos comestibles y no comestibles más económicos de la tienda:
<?php
echo "<a href='consulta_comestible_nocomestible_barato.php?id=$id&nombre=$nombre' role='button' class='btn'> Consulta </a>";
?>
</br>

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
$query = "SELECT productos.pid FROM productos;";
$result = $dbimp -> prepare($query);
$result -> execute();
$pid = $result -> fetchAll();
?>

<br>
Seleccione el ID del producto que desea comprar:
<form action="consulta_compra.php" method="post">
    ID Producto:
    <?php
    foreach ($pid as $p) {
        echo "<option value=$p>$p</option>";
    }
    ?>
  <input type="hidden" name="id_tienda" value="<?php echo $id; ?>">
  <input type="submit" value="Comprar">
</form>
</br>

<form action="consulta_todas_tiendas.php" method="get">
    <input type="submit" value="Volver">
</form>


