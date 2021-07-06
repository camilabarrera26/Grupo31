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

<header class="py-5">
    <div class="container px-lg-0">
        <div class="p-4 p-lg-2 bg-light rounded-3 text-center">
            <div class="m-4 m-lg-2">
                <h1 class="display-5 fw-bold"><?php echo "$nombre"; ?></h1> 
                <p class="fs-4">Aquí podrás cambiar tu contraseña a un numero entre el 100000000 y el 9999999999.</p>  
            </div>
        </div>
    </div>
</header>

<form action='procedimiento_cambio_contrasena.php' method='POST'>
        <label for='rut'>Rut</label>
        <input type='text' name='rut' />

        <label for='contrasena_actual'>Contraseña Actual</label>
        <input type='text' name='contrasena_actual'/>

        <label for='contrasena_nueva'>Contraseña Nueva</label>
        <input type='text' name='contrasena_nueva'/>

    <input type='submit' value='Iniciar Seción'>
</form>

