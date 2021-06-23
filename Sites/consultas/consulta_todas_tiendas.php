<?php include('../templates/header.html');   ?>

<body>
<?php
  #Llama a conexión, crea el objeto PDO y obtiene la variable $db
  require("../config/conexion.php");

  #Se construye la consulta como un string
 	$query = "SELECT DISTINCT tiendas.tid, tiendas.nombre FROM tiendas;";
  #Se prepara y ejecuta la consulta. Se obtienen TODOS los resultados
	$result = $db -> prepare($hola);
	$result -> execute();
	$comunas = $result -> fetchAll();
  ?>

  <table class='table'>
    <tr>
      <th>Tienda</th>
    </tr>
  
      <?php
        // echo $comunas;
        foreach ($tienda as $t) {
          echo "<tr><td><a href='consulta_tienda.php?id=<?php echo $t[0] ?>' role='button' class=btn'> $p[1] </a></td></tr>";
      }
?>
      
  </table>

<?php include('../templates/footer.html'); ?>
</body>