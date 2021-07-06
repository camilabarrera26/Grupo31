
<?php
    session_start();

    // Nos conectamos a las bdds
    require("../config/conexion.php");


    // Enviamos del post la informacion a la query con nuestro procedimiento almacenado que realizará
    // las verificaciones correspondientes
    $query = "SELECT verificar_usuario('$_POST[rut]', '$_POST[contrasena]');";
    $result = $dbimp -> prepare($query);
    $result -> execute();

    $query1 = "SELECT usuarios.uid FROM usuarios WHERE usuarios.rut = '$_POST[rut]';";
    $result1 = $dbimp -> prepare($query1);
    $result1 -> execute();
    $id_usuario = $result1 -> fetchAll();
    foreach ($id_usuario as $id){
        $id1 = $id[0];
    }



    // Si nos interesa acceder a los booleanos que retorna el procedimiento, debemos hacer fetch de los resultados
    $personals = $result -> fetchAll();
    
    $a = $personals['0'];

    if ($personals == null) {
        echo "No ha podido ingresar sesión";
        //echo '<script>window.open("error_registro.php")</script>';
    } elseif (in_array(1, $a) == false) {
        echo "No ha podido ingresar sesión";
        //echo '<script>window.open("error_registro.php")</script>';
    } elseif (in_array(1, $a)) {
        echo "Ha ingresado correctamente";
        $_SESSION['user'] = $id1;
    }
    // Mostramos los cambios en una nueva tabla
    $query = "SELECT usuarios.uid, usuarios.nombre, usuarios.rut, usuarios.edad, usuarios.sexo, usuarios.contrasena, usuarios.direccion FROM usuarios WHERE rut = '$_POST[rut]' AND contrasena = '$_POST[contrasena]';";
    $result = $dbimp -> prepare($query);
    $result -> execute();
    $personals = $result -> fetchAll();

?>

<html>

<body>  

<h1>Mi Perfil</h1>

    <table class='table'>
        <thead>
            <tr>
            <th>Id</th>
            <th>Nombre</th>
            <th>Rut</th>
            <th>Sexo</th>
            <th>Edad</th>
            <th>Contrasena</th>
            <th>Dirección</th>
            </tr>
        </thead>
        <tbody>
            <?php
            foreach ($personals as $personal) {
                echo "<tr>";
                for ($i = 0; $i < 8; $i++) {
                    echo "<td>$personal[$i]</td> ";
                }
                echo "</tr>";
            }
            ?>
        </tbody>
    </table>
</body>
</html>

