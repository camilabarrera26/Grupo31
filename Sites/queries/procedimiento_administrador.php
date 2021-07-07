<?php include('../templates/header.html');   ?>

<header class="py-5">
    <div class="container px-lg-0">
        <div class="p-4 p-lg-2 bg-light rounded-3 text-center">
            <div class="m-4 m-lg-2">
                <h1 class="display-5 fw-bold">Mi Tienda Web</h1> 
                 <p class="fs-4">Administrador</p>  
            </div>
        </div>
    </div>
</header>

<?php
$contrasena = $_POST["contrasena"];

if ($contrasena == 'administrador123') {
    require("../config/conexion.php");
    $query = "SELECT * FROM usuarios ORDER BY usuarios.uid;";

    #Se prepara y ejecuta la consulta. Se obtienen TODOS los resultados
    $result = $dbimp -> prepare($query);
    $result -> execute();
    $usuario = $result -> fetchAll();
} else {
    echo("Contraseña equivocada");
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