CREATE OR REPLACE FUNCTION

-- declaramos la función y sus argumentos
-- PRIMERA FUNCIÓN QUE EJECUTAR
cambio_usuarios ()

-- declaramos lo que retorna 
RETURNS void AS $$


-- definimos nuestra función
BEGIN

--Select personal.pid, personal.nombre, personal.rut, personal.sexo, personal.edad, trabaja_en.clasificacion, direccion.nombre as direccion from personal, Trabaja_en,  Unidad, Direccion Where personal.pid = trabaja_en.pid And trabaja_en.uid = unidad.uid And unidad.direccion_id= direccion.dir_id AND trabaja_en.clasificacion = 'administracion';
--Select usuarios.uid, usuarios.nombre, usuarios.rut, usuarios.sexo, usuarios.edad, comunas.direccion  from usuarios, direccionesusuarios, comunas Where usuarios.uid = direccionesusuarios.uid And direccionesusuarios.did= comunas.did;


    --IF 'direccion' NOT IN (SELECT column_name FROM information_schema.columns WHERE table_name='personal') THEN
      --  ALTER TABLE personal ADD direccion int;
        --UPDATE personal SET dirección = direccion.nombre from personal, Trabaja_en, Unidad, Direccion Where personal.pid = trabaja_en.pid And trabaja_en.uid = unidad.uid And unidad.direccion_id = direccion.dir_id; -- AND trabaja_en.clasificacion = 'administracion';        

    --END IF;

    IF 'direccion' NOT IN (SELECT column_name FROM information_schema.columns WHERE table_name='usuarios') THEN
        ALTER TABLE usuarios ADD direccion varchar(100);
        UPDATE usuarios SET direccion = comunas.direccion from direccionesusuarios, comunas Where usuarios.uid = direccionesusuarios.uid And direccionesusuarios.did = comunas.did;
        
        -- UPDATE usuarios SET direccion = comunas.direccion from usuarios, direccionesusuarios, comunas Where usuarios.uid = direccionesusuarios.uid And direccionesusuarios.did = comunas.did;
        -- TENER EN CUENTA: CADA USUARIO TIENE ASOCIADA + DE UNA DIRECCIÓN
        -- DESPUÉS AGREGAR LAS DIRECCIONES DEL PERSONAL 
    END IF;




-- -- finalizamos la definición de la función y declaramos el lenguaje
END
$$ language plpgsql