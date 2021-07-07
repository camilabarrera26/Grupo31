<?php
session_start();
?>

<?php 
  if(isset($_SESSION['id'])){
    include('templates/header_login.html'); 
  }  
  else {
  include('templates/header.html');  
  }
?>

<header class="py-5">
    <div class="container px-lg-0">
        <div class="p-4 p-lg-2 bg-light rounded-3 text-center">
            <div class="m-4 m-lg-2">
                <h1 class="display-5 fw-bold">Mi Tienda Web</h1> 
                 <p class="fs-4">Aquí podrás encontrar información sobre tiendas.</p>  
            </div>
        </div>
    </div>
</header>

<body>
<h3>Registrarse</h3>

<form action='./queries/procedimiento_registro.php' method='POST'>
        <label for='nombre'>Nombre</label>
        <input type='text' name='nombre' />

        <label for='rut'>Rut</label>
        <input type='text' name='rut' />
        
        <label for='type'>Sexo</label>
        <select name='sexo' id='type'>
            <option value='hombre'>Hombre</option>
            <option value='mujer'>Mujer</option>
        </select>

        <label for='edad'>Edad</label>
        <input type='number' name='edad'/>

        <label for='direccion'>Dirección</label>
        <input type='text' name='direccion'/>

    <input type='submit' value='Registrarse'>
</form>

</body>


<!--
<!DOCTYPE html>

<html>

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <title> Delivery </title>
</head>

<body>

<h3>Cambio tablas</h3>

<form action='./queries/procedimiento_tablas.php' method='GET'>
    <input type='submit' value='Cambio tablas'>
</form>

<h3>Contraseñas</h3>

<form action='./queries/procedimiento_asignar_contra.php' method='GET'>
    <input type='submit' value='Asignar Contraseñas'>
</form>

<h3>Registrarse</h3>

<form action='./queries/procedimiento_registro.php' method='POST'>
        <label for='nombre'>Nombre</label>
        <input type='text' name='nombre' />

        <label for='rut'>Rut</label>
        <input type='text' name='rut' />
        
        <label for='type'>Sexo</label>
        <select name='sexo' id='type'>
            <option value='hombre'>Hombre</option>
            <option value='mujer'>Mujer</option>
        </select>

        <label for='edad'>Edad</label>
        <input type='number' name='edad'/>

        <label for='direccion'>Dirección</label>
        <input type='text' name='direccion'/>

    <input type='submit' value='Registrarse'>
</form>

<h3>Iniciar seción</h3>

<form action='./queries/procedimiento_entrada.php' method='POST'>
        <label for='rut'>Rut</label>
        <input type='text' name='rut' />

        <label for='contrasena'>Contraseña</label>
        <input type='text' name='contrasena'/>

    <input type='submit' value='Iniciar Seción'>
</form>

<h3>Cambiar Contraseña</h3>

<form action='./queries/procedimiento_cambiar_contra.php' method='POST'>
        <label for='rut'>Rut</label>
        <input type='text' name='rut' />

        <label for='contrasena_actual'>Contraseña Actual</label>
        <input type='text' name='contrasena_actual'/>

        <label for='contrasena_nueva'>Contraseña Nueva</label>
        <input type='text' name='contrasena_nueva'/>

    <input type='submit' value='Iniciar Seción'>
</form>

</body>
</html>
-->
