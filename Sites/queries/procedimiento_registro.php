
<html>

<?php
header("Location: ../register.php");
    require("../config/conexion.php");

    $query = "SELECT registrar_usuario('$_POST[nombre]', '$_POST[rut]', '$_POST[sexo]', $_POST[edad], '$_POST[direccion]');";
    $result = $dbimp -> prepare($query);
    $result -> execute();

    $personals = $result -> fetchAll();
    $a = $personals['0'];

    if ($personals == null) {
        header("Location: ../register.php");
    } elseif (in_array(1, $a) == false) {
        header("Location: ../register.php");
    } elseif (in_array(1, $a)) {
        header("Location: ../register.php");
        }
