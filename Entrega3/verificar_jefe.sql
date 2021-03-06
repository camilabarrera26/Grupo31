CREATE OR REPLACE FUNCTION

verificar_jefe (rut_ varchar)

-- declaramos lo que retorna 
RETURNS BOOLEAN AS $$

-- definimos nuestra función
BEGIN

    IF rut_ NOT IN (SELECT Personal.rut FROM Personal, Trabaja_en WHERE Personal.pid =  Trabaja_en.pid AND Trabaja_en.clasificacion = 'administracion' ORDER BY Personal.pid) THEN
        RETURN FALSE;
    END IF;

    RETURN TRUE;
    

-- -- finalizamos la definición de la función y declaramos el lenguaje
END
$$ language plpgsql