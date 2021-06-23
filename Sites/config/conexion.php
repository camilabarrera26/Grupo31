<?php
  try {
    require('dataimp.php'); 
    $dbimp = new PDO("pgsql:dbname=$databaseNameimp;host=localhost;port=5432;user=$userimp;password=$passwordimp");
  } catch (Exception $e) {
    echo "No se pudo conectar a la base de datos: $e";
  }
?>