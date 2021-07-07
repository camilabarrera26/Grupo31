<?php
    session_start();
    require("config/conexion.php");
    $message="";
    if(count($_POST)>0) {
        $nombre = $_POST["nombre"];
        $rut = $_POST["rut"];
        $sexo = $_POST["sexo"];
        $edad = $_POST["edad"];
        $direccion = $_POST["direccion"];
        $comuna = $_POST["comuna"];

        $query = "SELECT registrar_usuario('$nombre', '$rut', '$sexo', $edad, '$direccion', '$comuna');";
        $result = $dbimp -> prepare($query);
        $result -> execute();

        $personals = $result -> fetchAll();
        $a = $personals['0'];

        if ($personals == null) {
            $message = "Error al Registrarse!";
        } elseif (in_array(1, $a) == false) {
            $message = "Error al Registrarse!";
        } elseif (in_array(1, $a)) {
            $query1 = "SELECT usuarios.uid, usuarios.nombre FROM usuarios WHERE usuarios.rut = '$rut';";
            $result1 = $dbimp -> prepare($query1);
            $result1 -> execute();
            $usuario = $result1 -> fetchAll();
            foreach ($usuario as $u) {
              $_SESSION["id"] = $u[0];
              $_SESSION["nombre"] = $u[1];
            }
        }
    }
    if(isset($_SESSION["id"])) {
      header("Location: index.php");
    }
?>

<?php include('templates/header.html');   ?>

<header class="py-5">
    <div class="container px-lg-0">
        <div class="p-4 p-lg-2 bg-light rounded-3 text-center">
            <div class="m-4 m-lg-2">
                <h1 class="display-5 fw-bold">Mi Tienda Web</h1> 
                 <p class="fs-4">Regístrate</p>  
            </div>
        </div>
    </div>
</header>

<body>
<form method='POST' name="frmUser" action="" align="center">
<div class="message"><?php if($message!="") { echo $message; } ?></div>
<h3 align="center">Ingresa tus datos:</h3>
 Nombre:<br>
 <input type="text" name="nombre">
 <br>
 Rut:<br>
 <input type="text" name="rut">
 <br>
 Sexo<br><select name='sexo' id='type'>
    <option value='hombre'>Hombre</option>
    <option value='mujer'>Mujer</option>
  </select>
  <br>
 Edad:<br>
 <input type="number" name="edad">
 <br>
 Dirección:<br>
 <input type="text" name="direccion">
 <br>
 Comuna:<br>
 <input type="text" name="comuna">
 <br><br>

<input type="submit" name="submit" value="Submit">
<input type="reset">
</form>
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
        <input class = "reg" type='submit' value='Registrarse'>
    </form>
</body>
</html>

-->