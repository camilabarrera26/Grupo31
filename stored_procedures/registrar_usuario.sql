CREATE OR REPLACE FUNCTION

-- declaramos la función y sus argumentos
-- CUARTA FUNCIÓN QUE EJECUTAR
registrar_usuario (nombrexd varchar(100), rute varchar(10), sexo varchar(20), edad int, direccion varchar(100))

-- declaramos lo que retorna 
RETURNS BOOLEAN AS $$


-- declaramos las variables a utilizar si es que es necesario
DECLARE
idmax int;


-- definimos nuestra función
BEGIN

    -- verificamos que no se repita el name

    IF rute IN (SELECT usuarios.rut FROM usuarios) THEN
        RETURN FALSE;
    END IF;

    IF rute IS NULL OR nombrexd IS NULL OR sexo IS NULL OR edad IS NULL OR direccion IS NULL THEN
        RETURN FALSE;
    END IF;

    -- ACEPTA CUALQUIER DIRECCIÓN

    -- insertamos el maximo id en la variable idmax
    SELECT INTO idmax
    MAX(usuarios.uid)
    FROM usuarios;

    -- insertamos el dato y la contraseña
    INSERT INTO usuarios values(idmax + 1, nombrexd, rute, edad, sexo, ROUND(RANDOM()*(999999999-100000000)+100000000), direccion);
    RETURN TRUE;
    



-- -- finalizamos la definición de la función y declaramos el lenguaje
END
$$ language plpgsql