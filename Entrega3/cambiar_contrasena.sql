CREATE OR REPLACE FUNCTION

-- declaramos la función y sus argumentos
-- TERCERA FUNCIÓN QUE EJECUTAR
cambiar_contrasena (rute varchar(12), contrasena_actual int, contrasena_nueva int)

-- declaramos lo que retorna 
RETURNS BOOLEAN AS $$


-- definimos nuestra función
BEGIN

    --IF rute IN (SELECT rut FROM personal) AND contrasena_actual IN (SELECT contrasena FROM personal) THEN
        -- UPDATE personal SET contrasena = contrasena_nueva;
        --RETURN TRUE;

    IF (rute, contrasena_actual) IN (SELECT usuarios.rut, usuarios.contrasena FROM usuarios WHERE rut = rute AND contrasena = contrasena_actual) AND contrasena_nueva >= 100000000 AND contrasena_nueva <= 999999999 THEN
        UPDATE usuarios SET contrasena = contrasena_nueva WHERE rut = rute AND contrasena = contrasena_actual;
        RETURN TRUE;

    ELSE
        RETURN FALSE;

    END IF;
    



-- -- finalizamos la definición de la función y declaramos el lenguaje
END
$$ language plpgsql