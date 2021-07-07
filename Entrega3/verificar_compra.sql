CREATE OR REPLACE FUNCTION

-- declaramos la función y sus argumentos
verificar_productos_tiendas (pid_ int, tid_ int, uid_ int, comuna varchar)

-- declaramos lo que retorna 
RETURNS BOOLEAN AS $$



-- declaramos las variables a utilizar si es que es necesario
DECLARE
idmax int;
idmax1 int;

-- definimos nuestra función
BEGIN

    -- si el producto no esta en la tienda retorna false
    IF pid_ NOT IN (SELECT DISTINCT productos.pid FROM productos, productostiendas, tiendas WHERE productos.pid = productostiendas.pid AND productostiendas.tid = tiendas.tid AND productos.pid = pid_ AND tiendas.tid = tid_) THEN
        RETURN TRUE;
    END IF;

    -- verificamos que la tienda despache a la comuna
    IF comuna NOT IN (SELECT DISTINCT comunas.comuna_cobertura FROM productos, productostiendas, tiendas, direccionesdespacho, comunas WHERE productos.pid = productostiendas.pid AND productostiendas.tid = tiendas.tid AND tiendas.tid = direccionesdespacho.tid AND direccionesdespacho.did = comunas.did AND productos.pid = pid_ AND tiendas.tid = tid_) THEN
        RETURN FALSE;
    END IF;

    -- insertamos el maximo id en la variable idmax
    SELECT INTO idmax
    MAX(id)
    FROM compras;

    SELECT INTO idmax1
    MAX(direccionesdespacho.ddid)
    FROM direccionesdespacho;

    -- insertamos el dato
    insert into compras values(idmax + 1, uid_, tid, pid);
    insert into productoscompras values(idmax + 1, pid_, 1);
    insert into direccionesdespacho values(idmax1 + 1, tid_, pid);
    RETURN TRUE;
    

-- -- finalizamos la definición de la función y declaramos el lenguaje
END
$$ language plpgsql


