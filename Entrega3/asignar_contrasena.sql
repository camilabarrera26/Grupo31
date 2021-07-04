CREATE OR REPLACE FUNCTION

-- declaramos la función y sus argumentos
-- SEGUNDA FUNCIÓN QUE EJECUTAR
asignar_contrasena (pid int, nombre varchar(50), rute varchar(12), edad int, sexo varchar(25), direccion varchar (200))

-- declaramos lo que retorna, en este caso un booleano
RETURNS BOOLEAN AS $$

DECLARE
idmax int;

-- definimos nuestra función
BEGIN

    IF 'contrasena' NOT IN (SELECT column_name FROM information_schema.columns WHERE table_name='usuarios') THEN
        ALTER TABLE usuarios ADD contrasena int;
        UPDATE usuarios SET contrasena = ROUND(RANDOM()*(999999999-100000000)+100000000);
    END IF;

    --IF 'contrasena' IN (SELECT column_name FROM information_schema.columns WHERE table_name='personal') THEN
      --  UPDATE personal SET contrasena = ROUND(RANDOM()*(999999999-100000000)+100000000);
    --END IF;


    SELECT INTO idmax
    MAX(usuarios.uid)
    FROM usuarios;

    IF rute NOT IN (SELECT usuarios.rut from usuarios) THEN
        INSERT INTO usuarios values(idmax + 1, nombre, rute, edad, sexo, ROUND(RANDOM()*(999999999-100000000)+100000000), direccion);
        -- retornamos true si se agregó el valor
        RETURN TRUE;
    ELSE
        -- y false si no se agregó
        RETURN FALSE;

    END IF;


-- finalizamos la definición de la función y declaramos el lenguaje
END
$$ language plpgsql
