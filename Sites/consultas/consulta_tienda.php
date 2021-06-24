<?php include('../templates/header.html');   ?>

<?php 
$id = $_REQUEST['id']; 
$nombre = $_REQUEST['nombre']; 
?>

Consulte por los 3 productos comestibles y no comestibles más económicos de la tienda:
<?php
echo "<a href='consulta_comestible_nocomestible_barato.php?id=$id&nombre=$nombre' role='button' class='btn'> Consulta </a>";
?>

<br>
Busque algún producto por nombre:
<form action="consulta_productos_vendidos.php" method="post">
    Producto:
    <input type="text" name="producto">
    <input type="hidden" value="<?php echo "$id"; ?>">
    <input type="submit" value="Buscar">
</form>
</br>

<?php include('../templates/footer.html'); ?>


