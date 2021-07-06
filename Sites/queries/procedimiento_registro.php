<!DOCTYPE html>

<html>

<?php

    // Nos conectamos a las bdds
    require("../config/conexion.php");


    // Enviamos del post la informacion a la query con nuestro procedimiento almacenado que realizará
    // las verificaciones correspondientes
    $query = "SELECT registrar_usuario('$_POST[nombre]', '$_POST[rut]', '$_POST[sexo]', $_POST[edad], '$_POST[direccion]');";
    $result = $dbimp -> prepare($query);
    $result -> execute();

    $query1 = "SELECT usuarios.uid FROM usuarios WHERE usuarios.rut = '$_POST[rut]';";
    $id_usuario = $dbimp -> prepare($query);
    $id_usuario -> execute();
    echo $id_usuario[0];
    echo $id_usuario;

    // Si nos interesa acceder a los booleanos que retorna el procedimiento, debemos hacer fetch de los resultados
    $personals = $result -> fetchAll();
    $a = $personals['0'];

    if ($personals == null) {
        echo "Error al registrarse";
        //echo '<script>window.open("error_registro.php")</script>';
    } elseif (in_array(1, $a) == false) {
        echo "Error al registrarse";
        //echo '<script>window.open("error_registro.php")</script>';
    } elseif (in_array(1, $a)) {
        echo "Se ha registrado correctamente";
        //session_start();
        //$_SESSION['user'] = $id_usuario[0];
        }
    // Mostramos los cambios en una nueva tabla
    $query = "SELECT * FROM usuarios ORDER BY usuarios.uid;";
    $result = $dbimp -> prepare($query);
    $result -> execute();
    $personals = $result -> fetchAll();

?>


<body>  
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