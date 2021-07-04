CREATE OR REPLACE FUNCTION

-- declaramos la función y sus argumentos
-- Primera FUNCIÓN QUE EJECUTAR
cambio_usuarios ()

-- declaramos lo que retorna 
RETURNS void AS $$


-- definimos nuestra función
BEGIN

--Select personal.pid, personal.nombre, personal.rut, personal.sexo, personal.edad, trabaja_en.clasificacion, direccion.nombre as direccion from personal, Trabaja_en,  Unidad, Direccion Where personal.pid = trabaja_en.pid And trabaja_en.uid = unidad.uid And unidad.direccion_id= direccion.dir_id AND trabaja_en.clasificacion = 'administracion';
--Select usuarios.uid, usuarios.nombre, usuarios.rut, usuarios.sexo, usuarios.edad, comunas.direccion  from usuarios, direccionesusuarios, comunas Where usuarios.uid = direccionesusuarios.uid And direccionesusuarios.did= comunas.did;

    IF 'direccion' NOT IN (SELECT column_name FROM information_schema.columns WHERE table_name='usuarios') THEN
        ALTER TABLE usuarios ADD direccion int;
        UPDATE usuarios SET dirección = 1 --comunas.direccion from usuarios, direccionesusuarios, comunas Where usuarios.uid = direccionesusuarios.uid And direccionesusuarios.did= comunas.did;

    END IF;




-- -- finalizamos la definición de la función y declaramos el lenguaje
END
$$ language plpgsql