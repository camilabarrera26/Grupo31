<?php include('templates/header.html');   ?>
<body>
  <section class="pt-4">
    <div class="container px-lg-5">
      <!-- Page Features-->
      <div class="row gx-lg-5">
        <div class="col-lg-6 col-xxl-4 mb-5">
          <div class="card bg-contrast border-0 h-100">
            <div class="card-body text-center p-4 p-lg-5 pt-0 pt-lg-0">
              <div class="feature bg-primary bg-gradient text-white rounded-3 mb-4 mt-n4"><i class="bi bi-collection"></i></div>
              <h2 class="fs-4 fw-bold">Lista de Comunas a las que despacha cada Tienda</h2>
              <form align="center" action="consultas/consulta_tiendas_cobertura.php" method="post">
                <br>
                <input type="submit" value="Buscar">
                <br>
              </form>
            </div>
          </div>
        </div>
        <div class="col-lg-6 col-xxl-4 mb-5">
          <div class="card bg-contrast border-0 h-100">
            <div class="card-body text-center p-4 p-lg-5 pt-0 pt-lg-0">
              <div class="feature bg-primary bg-gradient text-white rounded-3 mb-4 mt-n4"><i class="bi bi-collection"></i></div>
              <h2 class="fs-4 fw-bold">Busca a los jefes de las tiendas de alguna comuna</h2>
              <form align="center" action="consultas/consulta_jefes_comuna.php" method="post">
                <p class="mb-0">Comuna:</p>
                <br>
                <input type="text" name="comuna_tienda">
                <input type="submit" value="Buscar">
                <br>
              </form>
            </div>
          </div>
        </div>
        <div class="col-lg-6 col-xxl-4 mb-5">
          <div class="card bg-contrast border-0 h-100">
            <div class="card-body text-center p-4 p-lg-5 pt-0 pt-lg-0">
              <div class="feature bg-primary bg-gradient text-white rounded-3 mb-4 mt-n4"><i class="bi bi-collection"></i></div>
              <h2 class="fs-4 fw-bold">Averigua que tiendas tienen un tipo de producto</h2>
              <form align="center" action="consultas/consulta_tiendas_tipo_producto.php" method="post">
                <p class="mb-0">Seleccinar un tipo:</p>
                <br>
                <select name="tipo">
                <?php
                  echo "<option value=productoscomestibles>Comestible</option>";
                  echo "<option value=productosnocomestibles>No Comestible</option>";
                  echo "<option value=productoscongelados>Congelado</option>";
                  echo "<option value=productosfrescos>Fresco</option>";
                  echo "<option value=productosenconserva>En Conserva</option>";
                ?>
                </select>
                <input type="submit" value="Buscar">
                <br>
              </form>
            </div>
          </div>
        </div>
        <div class="col-lg-6 col-xxl-4 mb-5">
          <div class="card bg-contrast border-0 h-100">
            <div class="card-body text-center p-4 p-lg-5 pt-0 pt-lg-0">
              <div class="feature bg-primary bg-gradient text-white rounded-3 mb-4 mt-n4"><i class="bi bi-collection"></i></div>
              <h2 class="fs-4 fw-bold">Busca a los usuarios que compraron un producto con su descripción</h2>
              <form align="center" action="consultas/consulta_usuarios_descripcion_producto.php" method="post">
                <p class="mb-0">Descripción Producto:</p>
                <br>
                <input type="text" name="descripcion_producto">
                <input type="submit" value="Buscar">
              </form>
            </div>
          </div>
        </div>
        <div class="col-lg-6 col-xxl-4 mb-5">
          <div class="card bg-contrast border-0 h-100">
            <div class="card-body text-center p-4 p-lg-5 pt-0 pt-lg-0">
              <div class="feature bg-primary bg-gradient text-white rounded-3 mb-4 mt-n4"><i class="bi bi-collection"></i></div>
              <h2 class="fs-4 fw-bold">Busca la edad promedio de los trabajadores de alguna comuna</h2>
              <form align="center" action="consultas/consulta_edad_trabajadores_comuna.php" method="post">
                <p class="mb-0">Comuna:</p>
                <br>
                <input type="text" name="comuna_tienda">
                <input type="submit" value="Buscar">
              </form>
            </div>
          </div>
        </div>
        <div class="col-lg-6 col-xxl-4 mb-5">
          <div class="card bg-contrast border-0 h-100">
            <div class="card-body text-center p-4 p-lg-5 pt-0 pt-lg-0">
              <div class="feature bg-primary bg-gradient text-white rounded-3 mb-4 mt-n4"><i class="bi bi-collection"></i></div>
              <h2 class="fs-4 fw-bold">Averigua que tiendas han vendido más de algún tipo de producto</h2>
              <form align="center" action="consultas/consulta_tienda_tipo_producto_mas_vendido.php" method="post">
                <p class="mb-0">Seleccinar un tipo:</p>
                <br>
                <select name="tipo">
                <?php
                  echo "<option value=productoscomestibles>Comestible</option>";
                  echo "<option value=productosnocomestibles>No Comestible</option>";
                  echo "<option value=productoscongelados>Congelado</option>";
                  echo "<option value=productosfrescos>Fresco</option>";
                  echo "<option value=productosenconserva>En Conserva</option>";
                ?>
                </select>
                <input type="submit" value="Buscar">
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
</body>
