<?php
    require("../config/conexion.php");

    $query = "SELECT uid, nombre, rut, sexo, edad FROM usuarios ORDER BY uid;";
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
                <th>Sexo</th>
                <th>Edad</th>
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