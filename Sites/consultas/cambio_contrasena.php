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

<h3>Cambiar Contraseña</h3>

<form action='procedimiento_cambio_contrasena.php' method='POST'>
        <label for='rut'>Rut</label>
        <input type='text' name='rut' />

        <label for='contrasena_actual'>Contraseña Actual</label>
        <input type='text' name='contrasena_actual'/>

        <label for='contrasena_nueva'>Contraseña Nueva</label>
        <input type='text' name='contrasena_nueva'/>

    <input type='submit' value='Iniciar Seción'>
</form>

