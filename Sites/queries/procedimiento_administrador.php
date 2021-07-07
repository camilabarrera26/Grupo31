


<?php
$message="";

$contrasena = $_POST["contrasena"];

if ($contrasena == 'administrador123') {
    require("../config/conexion.php");
    $query = "SELECT * FROM usuarios ORDER BY usuarios.uid;";

    #Se prepara y ejecuta la consulta. Se obtienen TODOS los resultados
    $result = $dbimp -> prepare($query);
    $result -> execute();
    $usuario = $result -> fetchAll();

} else {
    $message = "Contraseña Inválida!";
    $usuario[0] = " ";


}

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
            foreach ($usuario as $u) {
                echo "<tr>";
                for ($i = 0; $i < 7; $i++) {
                    echo "<td>$u[$i]</td> ";
                }
                echo "</tr>";
            }
            ?>
        </tbody>
    </table>
</body>
</html>