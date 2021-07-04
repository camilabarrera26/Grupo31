<!DOCTYPE html>

<html>

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
            <th>Contraseña</th>
            
            </tr>
        </thead>
        <tbody>
            <?php
            foreach ($personals as $personal) {
                echo "<tr>";
                for ($i = 0; $i < 7; $i++) {
                    echo "<td>$personal[$i]</td> ";
                }
                echo "</tr>";
            }
            ?>
        </tbody>
    </table>
</body>
</html>