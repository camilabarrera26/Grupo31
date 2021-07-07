<?php
  #Llama a conexión, crea el objeto PDO y obtiene la variable $db
  require("config/conexion.php");
#Se construye la consulta como un string
  $query = "SELECT * FROM usuarios ORDER BY usuarios.uid;";

  #Se prepara y ejecuta la consulta. Se obtienen TODOS los resultados
  $result = $dbimp -> prepare($query);
  $result -> execute();
  $usuario = $result -> fetchAll();

?>

  <table class='table'>
    <tr>
      <th>Nombre</th>
      <th>Rut</th>
      <th>Edad</th>
      <th>Sexo</th>
      <th>Contraseña</th>
      <th>Dirección</th>
    </tr>
        <?php
        // echo $tienda;
        foreach ($usuario as $u) {
          echo "<tr><td>$u[0]</td><td>$u[1]</td><td>$u[2]</td><td>$u[3]</td><td>$u[4]</td><td>$u[5]</td></tr>";
      }
      ?>
  </table>
