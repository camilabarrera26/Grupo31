<!DOCTYPE html>

<html>

<?php

    // Nos conectamos a las bdds
    require("../config/conexion.php");


    // Enviamos del post la informacion a la query con nuestro procedimiento almacenado que realizará
    // las verificaciones correspondientes
    $query = "SELECT cambio_usuarios();";
    $result = $dbimp -> prepare($query);
    $result -> execute();

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
            <th>Dirección</th>
            
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