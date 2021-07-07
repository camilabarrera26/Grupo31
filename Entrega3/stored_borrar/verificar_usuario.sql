CREATE OR REPLACE FUNCTION

-- declaramos la función y sus argumentos
-- QUINTA FUNCIÓN QUE EJECUTAR
verificar_usuario (rute varchar(10), contrasena_puesta int)

-- declaramos lo que retorna 
RETURNS BOOLEAN AS $$




-- definimos nuestra función
BEGIN

    IF (rute, contrasena_puesta) IN (SELECT usuarios.rut, usuarios.contrasena FROM usuarios WHERE rut = rute AND contrasena = contrasena_puesta) THEN
        RETURN TRUE;

    ELSE
        RETURN FALSE;

    END IF;
    



-- -- finalizamos la definición de la función y declaramos el lenguaje
END
$$ language plpgsql