<?php
    require("config/conexion.php");
    $message="";
    if(count($_POST)>0) {
        $contrasena = $_POST["contrasena"];

        if ($contrasena = "administrador123") {
            $query1 = "SELECT * FROM usuarios ORDER BY usuarios.uid';";
            $result1 = $dbimp -> prepare($query1);
            $result1 -> execute();
            $usuario = $result1 -> fetchAll();
        } else {
            $message = "Error al Entrar!";
        } 

?>

  <table class='table'>
    <tr>
      <th>Nombre</th>
      <th>Rut</th>
      <th>Edad</th>
      <th>Sexo</th>
      <th>Contraseña</th>
      <th>Dirección</th>
    </tr>
        <?php
        // echo $tienda;
        foreach ($usuario as $u) {
          echo "<tr><td>$u[0]</td><td>$u[1]</td><td>$u[2]</td><td>$u[3]</td><td>$u[4]</td><td>$u[5]</td></tr>";
      }
      ?>
  </table>

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
<h3 align="center">Ingresa tus datos de administrador:</h3>
 Contrasena:<br>
 <input type="text" name="contrasena">
 <br>

<input type="submit" name="submit" value="Submit">
<input type="reset">
</form>
</body>
</html>