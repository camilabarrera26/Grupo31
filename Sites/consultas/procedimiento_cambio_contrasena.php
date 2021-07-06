<?php
session_start();
if(!isset($_SESSION['id'])) // If session is not set then redirect to Login Page
       {
           header("Location: ../login.php");  
       }
?>

<?php 
  if(isset($_SESSION['id'])){
    include('../templates/header_login.html'); 
  }  
  else {
  include('../templates/header.html');  
  }
?>

<!DOCTYPE html>

<html>

<header class="py-5">
    <div class="container px-lg-0">
        <div class="p-4 p-lg-2 bg-light rounded-3 text-center">
            <div class="m-4 m-lg-2">
                <h1 class="display-5 fw-bold"><?php echo "$nombre"; ?></h1> 
                <p class="fs-4">Aquí podrás encontrar el resultado de tu cambio de contraseña.</p>  
            </div>
        </div>
    </div>
</header>

<?php

    // Nos conectamos a las bdds
    require("../config/conexion.php");


    // Enviamos del post la informacion a la query con nuestro procedimiento almacenado que realizará
    // las verificaciones correspondientes
    $query = "SELECT cambiar_contrasena('$_POST[rut]', $_POST[contrasena_actual], $_POST[contrasena_nueva]);";
    $result = $dbimp -> prepare($query);
    $result -> execute();

    // Si nos interesa acceder a los booleanos que retorna el procedimiento, debemos hacer fetch de los resultados
    $personals = $result -> fetchAll();
    $a = $personals['0'];

    if ($personals == null) {
        echo "Error al cambiar la contraseña";
        //echo '<script>window.open("error_registro.php")</script>';
    } elseif (in_array(1, $a) == false) {
        echo "Error al cambiar la contraseña";
        //echo '<script>window.open("error_registro.php")</script>';
    } elseif (in_array(1, $a)) {
        echo "Su contraseña ha sido cambiada correctamente";
    }