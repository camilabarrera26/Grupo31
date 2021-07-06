<?php
    session_start();
    require("../config/conexion.php");
    $message="";
    echo "hola";
    if(count($_POST)>0) {
        $query = "SELECT usuarios.uid, usuarios.nombre FROM usuarios WHERE usuarios.rut = '$_POST[rut]' AND usuarios.contrasena = '$_POST[password]';";
        $result = $dbimp -> prepare($query);
        $result -> execute();
        $usuario = $result -> fetchAll();
        if(is_array($usuario)) {
            foreach ($usuario as $u){
            $_SESSION["id"] = $u[0];
            $_SESSION["nombre"] = $u[1];
            }
        } else {
         $message = "Invalid Username or Password!";
        }
    }
    if(isset($_SESSION["id"])) {
    header("Location:index.php");
    }
?>

<?php include('../templates/header.html');   ?>
<html>
<head>
<title>Iniciar Sesión</title>
</head>
<body>
<form name="frmUser" method="post" action="" align="center">
<div class="message"><?php if($message!="") { echo $message; } ?></div>
<h3 align="center">Ingresa tus datos:</h3>
 Rut:<br>
 <input type="text" name="user_name">
 <br>
 Contraseña:<br>
<input type="password" name="password">
<br><br>
<input type="submit" name="submit" value="Submit">
<input type="reset">
</form>
<?php
echo $_SESSION["id"];
?>
</body>
</html>


<!--
<body>
    <form action='./queries/procedimiento_registro.php' method='POST'>
        <h1>Registrate Ahora</h1> <br>
        <p>Nombre<br><input type="text" name="nombre" placeholder="Ingrese su nombre"></p> <br>
        <p>Rut<br><input type="text" name="rut" placeholder="Ingrese su rut"></p> <br>
        
        <p>Sexo<br><select name='sexo' id='type'>
                    <option value='hombre'>Hombre</option>
                     <option value='mujer'>Mujer</option></select></p><br>

        <p>Edad<br><input type='number' name='edad' placeholder="Ingrese su edad"></p> <br>
        <p>Dirección<br><input type='text' name='direccion' placeholder="Ingrese su dirección"></p> <br>
        <input class = "reg" type='submit' value='Iniciar Sesión'>
    </form>
</body>
</html>
-->