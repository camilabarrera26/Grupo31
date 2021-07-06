CREATE OR REPLACE FUNCTION

-- declaramos la función y sus argumentos
verificar_productos_tiendas (pid int, tid int, uid_ int)

-- declaramos lo que retorna 
RETURNS BOOLEAN AS $$



-- declaramos las variables a utilizar si es que es necesario
DECLARE
idmax int;
a text;
c CURSOR FOR
    SELECT comunas.comuna_cobertura
    FROM   usuarios, direccionesusuarios, comunas
    WHERE usuarios.uid = direccionesusuarios.uid AND direccionesusuarios.did = comunas.did AND uid_ = usuarios.uid;

-- definimos nuestra función
BEGIN

    -- si el producto no esta en la tienda retorna false
    IF pid NOT IN (SELECT DISTINCT productos.pid FROM productos, productostiendas, tiendas WHERE productos.pid = productostiendas.pid AND productostiendas.tid = tiendas.tid AND productos.pid = pid AND tiendas.tid = tid) THEN
        RETURN FALSE;
    END IF;

    -- verificamos que la tienda despache a la comuna
    a := FALSE;
    FOR c in SELECT comunas.comuna_cobertura FROM usuarios, direccionesusuarios, comunas WHERE usuarios.uid = direccionesusuarios.uid AND direccionesusuarios.did = comunas.did AND uid_ = usuarios.uid LOOP
        IF c IN (SELECT DISTINCT comunas.comuna_cobertura FROM productos, productostiendas, tiendas, direccionesdespacho, comunas WHERE productos.pid = productostiendas.pid AND productostiendas.tid = tiendas.tid AND tiendas.tid = direccionesdespacho.tid AND direccionesdespacho.did = comunas.did AND productos.pid = pid AND tiendas.tid = tid)
            a := TRUE
        END IF;
    END LOOP;
    IF a = FALSE
        RETURN FALSE;
    END IF;

    -- insertamos el maximo id en la variable idmax
    SELECT INTO idmax
    MAX(id)
    FROM compras;

    -- insertamos el dato
    insert into compras values(idmax + 1, uid_, tid, pid);
    RETURN TRUE;
    

-- -- finalizamos la definición de la función y declaramos el lenguaje
END
$$ language plpgsql
