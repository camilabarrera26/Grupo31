<?php include("head.php"); ?>

<body>
    <form action='./queries/procedimiento_registro.php' method='POST'>
        <h1>Registrate Ahora</h1> <br>
        <p>Nombre<br><input type="text" name="nombre" placeholder="Ingrese su nombre"></p> <br>
        <p>Rut<br><input type="text" name="rut" placeholder="Ingrese su rut"></p> <br>
        
        <p>Sexo<br><select name='sexo' id='type'>
                    <option value='hombre'>Hombre</option>
                     <option value='mujer'>Mujer</option></select></p><br>

        <p>Edad<br><input type='number' name='edad' placeholder="Ingrese su edad"></p> <br>
        <p>Dirección<br><input type='text' name='direccion' placeholder="Ingrese su dirección"></p> <br>
        <input class = "reg" type='submit' value='Iniciar Sesión'>
    </form>
</body>
</html>