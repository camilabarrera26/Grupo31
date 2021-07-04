<?php
    require("../config/conexion.php");

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
                </tr>
            </thead>
            <tbody>
                <?php
                foreach ($personals as $personal) {
                    echo "<tr>";
                    for ($i = 0; $i < 5; $i++) {
                        echo "<td>$personal[$i]</td> ";
                    }
                    echo "</tr>";
                }
                ?>
            </tbody>
        </table>
    </body>
</html>