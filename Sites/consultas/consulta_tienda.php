<?php include('../templates/header.html');   ?>

<?php
if ($_POST["id_tienda"]) {
    echo 'hola1';
    $id = $_REQUEST['id']; 
    $nombre = $_REQUEST['nombre']; 
    echo $id;
} else {
    echo 'hola2';
    $id = $_POST["id_tienda"];
    echo $id;
}
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
    <input type="hidden" name="id_tienda" value="<?php echo $id; ?>">
    <input type="submit" value="Buscar">
</form>
</br>

<form action="consulta_todas_tiendas.php" method="get">
    <input type="submit" value="Volver">
</form>


