# Workmap
hola
![Caption for the picture.](workmap/workmap.png)



A la tabla usuarios de la base de datos del grupo 31 se le agregó una columna de direcciones (con la función cambio_usuarios), en la cual los usuarios que tenian más de una dirección, tienen asociada solo la dirección con menor id de las anteriores. Además, a esta tabla se le agrega la tabla personal de la base de datos del grupo 86 y se les asignan las contraseñas a través de la función asignar_contrasenas.

Las contraseñas son números aleatoreos asignados entre el 100000000 y 999999999. Con estas contraseñas más el rut el usuario podra logearse a la página. Estas contraseñas se pueden encontrar en el archivo excel contraseñas.xlsx, que se encuentra en la carpeta Entrega3. Además, si un usuario desea cambiar su contraseña debe ser un número entre los anteriores.

El usuario al registrarse debe ingresar un rut con la siguiente estructura: siete u ocho números, el guión y un número o la letra k.

