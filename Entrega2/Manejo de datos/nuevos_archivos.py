import os


def generar_directorio():

    """ Se genera el directorio para tener
        las tablas con los nuevos datos """

    current_path = os.getcwd()
    new_path = "tablas traspasadas"
    path = os.path.join(current_path, new_path)

    if not os.path.isdir(path):

        try:
            os.mkdir(path)
        except OSError:
            print("Creation of the directory %s failed" % path)
        else:
            print("Successfully created the directory %s " % path)


def read_csv_file(csv_file):

    """ Lee el archivo csv y retorna
        una array 2D con los datos """

    ruta = 'new data\\' + csv_file

    with open(ruta, 'r', encoding='UTF-8') as csv:

        primera_linea = True
        lines = csv.readlines()
        lista_final = []

        for line in lines:

            if primera_linea:

                primera_linea = False

            else:

                to_append = line.strip('\n').split(',')
                for i in range(len(to_append)):
                    to_append[i] = to_append[i].strip()
                lista_final.append(to_append)

    return lista_final


def crear_tabla_usuarios(ruta):

    """ Genera la tabla usuarios
        con los nuevos datos """

    array = read_csv_file(ruta)

    array = sorted(array, key=lambda x: int(x[0]))

    for lista in array:
        del lista[-1]

    new_array = []
    for x in array:
        if x not in new_array:
            new_array.append(x)

    with open('tablas traspasadas\\usuarios.csv', 'w+', encoding='UTF-8') \
            as csv_file:

        csv_file.write("uid,nombre,rut,edad,sexo\n")

        delimiter = ","

        for lista in new_array:
            string = delimiter.join(lista) + "\n"
            csv_file.write(string)


def crear_tabla_personal(ruta):

    """ Genera la tabla personal con
        los nuevos datos """

    array = read_csv_file(ruta)

    array = sorted(array, key=lambda x: int(x[0]))

    for lista in array:
        del lista[-1]

    with open('tablas traspasadas\\personal.csv', 'w+', encoding='UTF-8') \
            as csv_file:

        csv_file.write("eid,nombre,rut,edad,sexo\n")

        delimiter = ","

        for lista in array:
            string = delimiter.join(lista) + "\n"
            csv_file.write(string)


def crear_tabla_compras(ruta):

    """ Genera la tabla compras con
        los nuevos datos """

    array = read_csv_file(ruta)

    array = sorted(array, key=lambda x: int(x[0]))

    for lista in array:
        del lista[-3]
        del lista[-2]

    new_array = []
    for x in array:
        if x not in new_array:
            new_array.append(x)

    with open('tablas traspasadas\\compras.csv', 'w+', encoding='UTF-8') \
            as csv_file:

        csv_file.write("cid,uid,tid,did\n")

        delimiter = ","

        for lista in new_array:
            string = delimiter.join(lista) + "\n"
            csv_file.write(string)


def crear_tabla_productos_compras(ruta):

    """ Genera la tabla productos compras
        con los nuevos datos """

    array = read_csv_file(ruta)

    array = sorted(array, key=lambda x: int(x[0]))

    for lista in array:
        del lista[-1]
        del lista[-4]
        del lista[-3]

    new_array = []
    for x in array:
        if x not in new_array:
            new_array.append(x)

    with open(
        'tablas traspasadas\\productos_compras.csv', 'w+', encoding='UTF-8') \
            as csv_file:

        csv_file.write("cid,pid,cantidad\n")

        delimiter = ","

        for lista in new_array:
            string = delimiter.join(lista) + "\n"
            csv_file.write(string)


def crear_tabla_comunas(ruta):

    """ Genera la tabla comunas con
        los nuevos datos """

    array = read_csv_file(ruta)

    array = sorted(array, key=lambda x: int(x[0]))

    with open(
        'tablas traspasadas\\comunas.csv', 'w+', encoding='UTF-8') \
            as csv_file:

        csv_file.write("did,direccion,comuna_cobertura\n")

        delimiter = ","

        for lista in array:
            string = delimiter.join(lista) + "\n"
            csv_file.write(string)


def crear_tabla_tiendas(ruta):

    """ Genera la tabla tiendas con
        los nuevos datos """

    array = read_csv_file(ruta)

    array = sorted(array, key=lambda x: int(x[0]))

    for lista in array:
        del lista[-1]

    new_array = []
    for x in array:
        if x not in new_array:
            new_array.append(x)

    with open(
        'tablas traspasadas\\tiendas.csv', 'w+', encoding='UTF-8') \
            as csv_file:

        csv_file.write("tid,nombre,direccion,jefe\n")

        delimiter = ","

        for lista in new_array:
            string = delimiter.join(lista) + "\n"
            csv_file.write(string)


def crear_tabla_productos(ruta):

    """ Genera la tabla productos con
        los nuevos datos. Agregamos
        la columna tipo. """

    array = read_csv_file(ruta)

    array = sorted(array, key=lambda x: int(x[0]))

    lista_final = []

    for product in array:
        # Producto no comestible
        if product[4] != "":
            new_list = product.copy()
            new_list.append("no comestible")
            lista_final.append(new_list)
        # Producto comestible
        else:
            new_list = product.copy()
            new_list.append("comestible")
            lista_final.append(new_list)

    for lista in lista_final:
        for _ in range(8):
            del lista[-2]

    new_array = []
    for x in lista_final:
        if x not in new_array:
            new_array.append(x)

    with open(
        'tablas traspasadas\\productos.csv', 'w+', encoding='UTF-8') \
            as csv_file:

        csv_file.write("pid,nombre,precio,descripcion,tipo\n")

        delimiter = ","

        for lista in new_array:
            string = delimiter.join(lista) + "\n"
            csv_file.write(string)


def crear_tabla_productos_comestibles(ruta):

    """ Genera la tabla productos comestibles
        con los nuevos datos """

    array = read_csv_file(ruta)

    array = sorted(array, key=lambda x: int(x[0]))

    for lista in array:
        for _ in range(4):
            del lista[4]
        for _ in range(3):
            del lista[5]

    new_array = []
    for x in array:
        if x not in new_array:
            new_array.append(x)

    with open(
        'tablas traspasadas\\productos_comestibles.csv',
        'w+', encoding='UTF-8') \
            as csv_file:

        csv_file.write("pid,nombre,precio,descripcion,fecha_expiracion\n")

        delimiter = ","

        for lista in new_array:
            if lista[-1] != "":
                string = delimiter.join(lista) + "\n"
                csv_file.write(string)


def crear_tabla_productos_no_comestibles(ruta):

    """ Genera la tabla productos no comestibles
        con los nuevos datos """

    array = read_csv_file(ruta)

    array = sorted(array, key=lambda x: int(x[0]))

    for lista in array:
        for _ in range(4):
            del lista[8]

    new_array = []
    for x in array:
        if x not in new_array:
            new_array.append(x)

    with open(
        'tablas traspasadas\\productos_no_comestibles.csv',
        'w+', encoding='UTF-8') \
            as csv_file:

        csv_file.write("pid,nombre,precio,descripcion,largo,alto,ancho,peso\n")

        delimiter = ","

        for lista in new_array:
            if lista[-2] != "":
                string = delimiter.join(lista) + "\n"
                csv_file.write(string)


def crear_tabla_productos_congelados(ruta):

    """ Genera la tabla productos congelados
        con los nuevos datos """

    array = read_csv_file(ruta)

    array = sorted(array, key=lambda x: int(x[0]))

    new_array = []
    for lista in array:
        if lista[4] == "" and lista[7] != "" and lista[8] != "":
            new_array.append(lista)

    for lista in new_array:
        for _ in range(3):
            del lista[4]
        for _ in range(4):
            del lista[5]

    new_array_2 = []
    for x in new_array:
        if x not in new_array_2:
            new_array_2.append(x)

    with open(
        'tablas traspasadas\\productos_congelados.csv',
        'w+', encoding='UTF-8') \
            as csv_file:

        csv_file.write("pid,nombre,precio,descripcion,peso\n")

        delimiter = ","

        for lista in new_array_2:
            string = delimiter.join(lista) + "\n"
            csv_file.write(string)


def crear_tabla_productos_frescos(ruta):

    """ Genera la tabla productos frescos
        con los nuevos datos """

    array = read_csv_file(ruta)

    array = sorted(array, key=lambda x: int(x[0]))

    clean_array = []
    for lista in array:
        if lista[-3] != "":
            clean_array.append(lista)

    for lista in clean_array:
        for _ in range(5):
            del lista[4]
        for _ in range(2):
            del lista[5]

    new_array = []
    for x in clean_array:
        if x not in new_array:
            new_array.append(x)

    with open(
        'tablas traspasadas\\productos_frescos.csv',
        'w+', encoding='UTF-8') \
            as csv_file:

        csv_file.write("pid,nombre,precio,descripcion,duracion\n")

        delimiter = ","

        for lista in new_array:
            string = delimiter.join(lista) + "\n"
            csv_file.write(string)


def crear_tabla_productos_en_conserva(ruta):

    """ Genera la tabla productos frescos
        con los nuevos datos """

    array = read_csv_file(ruta)

    array = sorted(array, key=lambda x: int(x[0]))

    clean_array = []
    for lista in array:
        if lista[-2] != "":
            clean_array.append(lista)

    for lista in clean_array:
        for _ in range(6):
            del lista[4]
        for _ in range(1):
            del lista[5]

    new_array = []
    for x in clean_array:
        if x not in new_array:
            new_array.append(x)

    with open(
        'tablas traspasadas\\productos_en_conserva.csv',
        'w+', encoding='UTF-8') \
            as csv_file:

        csv_file.write("pid,nombre,precio,descripcion,metodo_conservacion\n")

        delimiter = ","

        for lista in new_array:
            string = delimiter.join(lista) + "\n"
            csv_file.write(string)


def crear_tabla_direcciones_usuarios(ruta):

    """ Genera la tabla direcciones_usuarios
        con los nuevos datos """

    array = read_csv_file(ruta)

    array = sorted(array, key=lambda x: int(x[0]))

    for lista in array:
        for _ in range(4):
            del lista[1]

    new_array = []
    for x in array:
        if x not in new_array:
            new_array.append(x)

    with open(
        'tablas traspasadas\\direcciones_usuarios.csv',
        'w+', encoding='UTF-8') \
            as csv_file:

        csv_file.write("duid,uid,did\n")

        delimiter = ","

        counter = 0
        for lista in new_array:
            string = str(counter) + "," + delimiter.join(lista) + "\n"
            csv_file.write(string)
            counter += 1


def crear_tabla_personal_tienda(ruta_personal, ruta_tiendas):

    """ Genera la tabla personal_tienda
        con los nuevos datos """

    array_personal = read_csv_file(ruta_personal)
    array_tiendas = read_csv_file(ruta_tiendas)

    with open(
        'tablas traspasadas\\personal_tienda.csv',
        'w+', encoding='UTF-8') \
            as csv_file:

        csv_file.write('tid,eid\n')

        lista_final = []

        for trabajador in array_personal:
            for tienda in array_tiendas:

                if trabajador[-1] == tienda[0]:
                    lista_final.append([tienda[0], trabajador[0]])

        lista_final = sorted(lista_final, key=lambda x: int(x[0]))

        new_array = []
        for x in lista_final:
            if x not in new_array:
                new_array.append(x)

        delimiter = ","

        for lista in new_array:
            string = delimiter.join(lista) + "\n"
            csv_file.write(string)


def crear_tabla_direcciones_despacho(ruta_direcciones, ruta_tiendas):

    """ Genera la tabla direcciones_usuarios
        con los nuevos datos """

    array_direcciones = read_csv_file(ruta_direcciones)
    array_tiendas = read_csv_file(ruta_tiendas)

    with open(
        'tablas traspasadas\\direcciones_despacho.csv',
        'w+', encoding='UTF-8') \
            as csv_file:

        csv_file.write('ddid,tid,did\n')

        lista_parcial = []
        lista_final = []

        for direccion in array_direcciones:
            for tienda in array_tiendas:

                if direccion[-1] == tienda[-1]:
                    lista_parcial.append([tienda[0], direccion[0]])

        counter = 0
        for element in lista_parcial:
            to_append = [str(counter)] + element
            lista_final.append(to_append)
            counter += 1

        lista_final = sorted(lista_final, key=lambda x: int(x[0]))

        delimiter = ","

        for lista in lista_final:
            string = delimiter.join(lista) + "\n"
            csv_file.write(string)


def crear_tabla_productos_tienda(ruta_productos, ruta_tiendas):

    """ Genera la tabla productos_tienda
        con los nuevos datos """

    array_productos = read_csv_file(ruta_productos)
    array_tiendas = read_csv_file(ruta_tiendas)

    with open(
        'tablas traspasadas\\productos_tienda.csv',
        'w+', encoding='UTF-8') \
            as csv_file:

        csv_file.write('tpid,tid,pid\n')

        lista_parcial = []
        lista_final = []

        for producto in array_productos:
            for tienda in array_tiendas:

                if producto[-1] == tienda[0]:
                    lista_parcial.append([tienda[0], producto[0]])

        new_array = []
        for x in lista_parcial:
            if x not in new_array:
                new_array.append(x)

        counter = 0
        for element in new_array:
            to_append = [str(counter)] + element
            lista_final.append(to_append)
            counter += 1

        lista_final = sorted(lista_final, key=lambda x: int(x[0]))

        delimiter = ","

        for lista in lista_final:
            string = delimiter.join(lista) + "\n"
            csv_file.write(string)


def crear_tabla_productos_compras(ruta_compras):

    """ Genera la tabla productos_compras
        con los nuevos datos """

    array_compras = read_csv_file(ruta_compras)

    for lista in array_compras:

        for _ in range(2):
            del lista[1]
        del lista[-1]

    new_array = []
    for x in array_compras:
        if x not in new_array:
            new_array.append(x)

    with open(
        'tablas traspasadas\\productos_compras.csv',
        'w+', encoding='UTF-8') \
            as csv_file:

        csv_file.write('cid,pid,cantidad\n')

        delimiter = ","

        for lista in new_array:
            string = delimiter.join(lista) + "\n"
            csv_file.write(string)


# Se genera el directorio
generar_directorio()

# Se crea la tabla usuarios
crear_tabla_usuarios('usuarios.csv')

# Se crea la tabla personal
crear_tabla_personal('trabajadores.csv')

# Se crea la tabla compras
crear_tabla_compras('comprasV2.csv')

# Se crea la tabla productos_compras
crear_tabla_productos_compras('comprasV2.csv')

# Se crea la tabla comunas
crear_tabla_comunas('direcciones.csv')

# Se crea la tabla comunas
crear_tabla_tiendas('plano_coberturaV2.csv')

# Se crea la tabla productos
crear_tabla_productos('productosV2.csv')

# Se crea la tabla productos comestibles
crear_tabla_productos_comestibles('productosV2.csv')

# Se crea la tabla productos comestibles
crear_tabla_productos_no_comestibles('productosV2.csv')

# Se crea la tabla productos congelados
crear_tabla_productos_congelados('productosV2.csv')

# Se crea la tabla productos frescos
crear_tabla_productos_frescos('productosV2.csv')

# Se crea la tabla productos en conserva
crear_tabla_productos_en_conserva('productosV2.csv')

# Se crea la tabla direcciones usuarios
crear_tabla_direcciones_usuarios('usuarios.csv')

# Se crea la tabla personal tienda
crear_tabla_personal_tienda('trabajadores.csv', 'plano_coberturaV2.csv')

# Se crea la tabla direcciones despacho
crear_tabla_direcciones_despacho('direcciones.csv', 'plano_coberturaV2.csv')

# Se crea la tabla productos tienda
crear_tabla_productos_tienda('productosV2.csv', 'plano_coberturaV2.csv')

# Se crea la tabla productos compras
crear_tabla_productos_compras('comprasV2.csv')
