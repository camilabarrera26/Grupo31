<?php

    require("../config/conexion.php");

    ## AGREGAR DIRECCION

    $query = "SELECT personal.pid, personal.nombre, personal.rut, personal.edad, personal.sexo, direccion.nombre as direccion from personal, Trabaja_en, Unidad, direccion Where personal.pid = trabaja_en.pid And trabaja_en.uid = unidad.uid And unidad.direccion_id = direccion.dir_id AND trabaja_en.clasificacion = 'administracion';";
    //"SELECT personal.pid, personal.nombre, personal.rut, personal.edad, personal.sexo, direccion.nombre as nombre FROM personal WHERE personal.pid IN (Select personal.pid from personal, Trabaja_en, Unidad, Direccion Where personal.pid = trabaja_en.pid And trabaja_en.uid = unidad.uid And unidad.direccion_id = direccion.dir_id AND trabaja_en.clasificacion = 'administracion');";
    $result = $dbp -> prepare($query);
    $result -> execute();
    $usuarios = $result -> fetchAll();

    foreach ($usuarios as $usuario){

        $query = "SELECT asignar_contrasena($usuario[0], '$usuario[1]'::varchar,'$usuario[2]'::varchar, $usuario[3], '$usuario[4]'::varchar, '$usuario[5]'::varchar);";
        // Ejecutamos las querys para efectivamente insertar los datos
        $result = $dbimp -> prepare($query);
        $result -> execute();
        $result -> fetchAll();
    }

    // Mostramos los cambios en una nueva tabla
    $query = "SELECT usuarios.uid, usuarios.nombre, usuarios.rut, usuarios.edad, usuarios.sexo, usuarios.contrasena, usuarios.direccion FROM usuarios ORDER BY uid;";
    $result = $dbimp -> prepare($query);
    $result -> execute();
    $usuarios = $result -> fetchAll();

?>

    <body>  
        <table class='table'>
            <thead>
                <tr>
                <th>Id</th>
                <th>Nombre</th>
                <th>Rut</th>
                <th>Edad</th>
                <th>Sexo</th>
                <th>Contraseña</th>
                <th>Dirección</th>
                </tr>
            </thead>
            <tbody>
                <?php
                foreach ($usuarios as $usuario) {
                    echo "<tr>";
                    for ($i = 0; $i < 7; $i++) {
                        echo "<td>$usuario[$i]</td> ";
                    }
                    echo "</tr>";
                }
                ?>
            </tbody>
        </table>
    </body>
</html>