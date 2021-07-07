CREATE OR REPLACE FUNCTION

verificar_jefe (id)

-- declaramos lo que retorna 
RETURNS BOOLEAN AS $$


-- declaramos las variables a utilizar si es que es necesario
DECLARE
idmax int;

-- definimos nuestra función
BEGIN

    IF id NOT IN (--rellenar con select de ids de jefes ) THEN
        RETURN FALSE;
    END IF;

    RETURN TRUE;
    

-- -- finalizamos la definición de la función y declaramos el lenguaje
END
$$ language plpgsql