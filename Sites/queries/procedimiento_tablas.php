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

    $query = "SELECT cambio_personal();";
    $result = $dbp -> prepare($query);
    $result -> execute();

    // Mostramos los cambios en una nueva tabla
    $query = "SELECT * FROM personal ORDER BY pid;";
    $result = $dbp -> prepare($query);
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
            <th>Dirección</th>
            <th>Contraseña</th>
            
            </tr>
        </thead>
        <tbody>
            <?php
            foreach ($personals as $personal) {
                echo "<tr>";
                for ($i = 0; $i < 6; $i++) {
                    echo "<td>$personal[$i]</td> ";
                }
                echo "</tr>";
            }
            ?>
        </tbody>
    </table>
</body>
</html>