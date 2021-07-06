
<html>

<?php
    // Nos conectamos a las bdds
    require("../config/conexion.php");

    // Enviamos del post la informacion a la query con nuestro procedimiento almacenado que realizará
    // las verificaciones correspondientes
    $query = "SELECT registrar_usuario('$_POST[nombre]', '$_POST[rut]', '$_POST[sexo]', $_POST[edad], '$_POST[direccion]');";
    $result = $dbimp -> prepare($query);
    $result -> execute();

    // Si nos interesa acceder a los booleanos que retorna el procedimiento, debemos hacer fetch de los resultados
    $personals = $result -> fetchAll();
    $a = $personals['0'];

    if ($personals == null) {
        header("Location: ../register.php");
    } elseif (in_array(1, $a) == false) {
        header("Location: ../register.php");
    } elseif (in_array(1, $a)) {
        header("Location: ../register.php");
        }
