<?php
    session_start();
    require("config/conexion.php");
    $message="";
    if(count($_POST)>0) {
        $contrasena = $_POST["contrasena"];

        if ($contrasena == "administrador123") {
            $message = "Error al Registrarse!";
        } elseif (in_array(1, $a) == false) {
            $message = "Error al Registrarse!";
        } 

?>

<?php include('templates/header.html');   ?>

<header class="py-5">
    <div class="container px-lg-0">
        <div class="p-4 p-lg-2 bg-light rounded-3 text-center">
            <div class="m-4 m-lg-2">
                <h1 class="display-5 fw-bold">Mi Tienda Web</h1> 
                 <p class="fs-4">Administrador</p>  
            </div>
        </div>
    </div>
</header>

<body>
<form method='POST' name="frmUser" action="./queries/procedimiento_administrador.php" align="center">
<div class="message"><?php if($message!="") { echo $message; } ?></div>
<h3 align="center">Ingresa tus datos:</h3>
Contraseña:<br>
 <input type="text" name="contrasena">
 <br>

<input type="submit" name="submit" value="Submit">
<input type="reset">
</form>
</body>
</html>
