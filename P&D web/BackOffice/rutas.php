<!DOCTYPE html>
<html lang="es">
  <?php
  include("lang/lang.php");
  ?>

<head>
  <title>Rutas</title>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="Keywords" content="Pasajes">
  <meta name="description" content="Pasajes">
  <meta name="author" content="CAMELCode.Corp">
  <meta name="copyright" content="CAMELCode.Corp">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
  <link rel="stylesheet" href="css/normalize.css">
  <link rel="stylesheet" href="css/global.css">
  <link rel="stylesheet" href="css/styleRutas.css">
  <link rel="stylesheet" href="css/styleGlobal.css">
</head>

<body>
  <div class="divPrincipal">
    <div class="panelLat">
      <img src="img/logoAdmin.svg" class="logo">
      <div class="panelOpcion">
        <a href="usuarios.php" class="latOpcion">
          <i class="fa-solid fa-user icon"></i>
          <span><?= $lang['bLUsuarios']; ?></span>
          <i class="fa-solid fa-chevron-right flecha"></i>
        </a>
      </div>
      <div class="panelActivo">
        <i class="fa-solid fa-map iconActivo"></i>
        <span class="latActivo"><?= $lang['bLRutas']; ?></span>
        <i class="fa-solid fa-chevron-right flecha"></i>
      </div>
      <div class="panelOpcion">
        <a href="coches.php" class="latOpcion">
          <i class="fa-solid fa-bus-simple icon"></i>
          <span><?= $lang['bLCoches']; ?></span>
          <i class="fa-solid fa-chevron-right flecha"></i>
        </a>
      </div>
      <div class="cerrarSesion">
        <a href="index.php"><button><i class="fa-solid fa-chevron-left"></i> <?= $lang['bLCerrarSesion']; ?></button></a>
      </div>
    </div>
    <div class="content">
      <div class="idioma">
        <div class="dropdown">
          <button class="dropbtn"><img src="<?= $lang['banderaIdioma']; ?>"> <i class="fa-solid fa-angle-down"></i></button>
          <div class="dropdown-content">
            <a href="rutas.php?la=eng"><img src="img/flags/eng.png" alt="<?= $lang['lang-eng']; ?>" title="<?= $lang['lang-eng']; ?>" /></a>
            <a href="rutas.php?la=esp"><img src="img/flags/esp.png" alt="<?= $lang['lang-esp']; ?>" title="<?= $lang['lang-esp']; ?>" /></a>
          </div>
        </div>
      </div>
      <h1><?= $lang['rutasTitulo']; ?></h1>
      <div class="buscador">
        <button id="abrirModal" class="nuevo"><i class="fa-solid fa-plus"></i><?= $lang['rutasNuevo']; ?></button>
        <button class="editar"><i class="fa-solid fa-pen"></i><?= $lang['rutasEditar']; ?></button>
        <button class="borrar"><i class="fa-solid fa-trash"></i><?= $lang['rutasBorrar']; ?></button>
        <input id="buscar" type="text" class="TxtBuscar" name="buscar" placeholder="  Buscar">
        <button class="buscar"><i class="fa-solid fa-magnifying-glass"></i><?= $lang['rutasBuscar']; ?></button>
      </div>
      <div class="table">
        <table class="mostrarDatos">
          <tr class="filaTitulo">
            <td></td>
            <td>ID</td>
            <td><?= $lang['rutasOrigen']; ?></td>
            <td><?= $lang['rutasDestino']; ?></td>
          </tr>
          <tr class="fila">
            <td><input type="checkbox" id="check" class="check" value="checkbox"></td>
            <td>7A</td>
            <td>Montevideo</td>
            <td>Artigas</td>
          </tr>
          <tr class="fila">
            <td><input type="checkbox" id="check" class="check" value="checkbox"></td>
            <td>7A</td>
            <td>Montevideo</td>
            <td>Artigas</td>
          </tr>
          <tr class="fila">
            <td><input type="checkbox" id="check" class="check" value="checkbox"></td>
            <td>7A</td>
            <td>Montevideo</td>
            <td>Artigas</td>
          </tr>
          <tr class="fila">
            <td><input type="checkbox" id="check" class="check" value="checkbox"></td>
            <td>7A</td>
            <td>Montevideo</td>
            <td>Artigas</td>
          </tr>
          <tr class="fila">
            <td><input type="checkbox" id="check" class="check" value="checkbox"></td>
            <td>7A</td>
            <td>Montevideo</td>
            <td>Artigas</td>
          </tr>
          <tr class="fila">
            <td><input type="checkbox" id="check" class="check" value="checkbox"></td>
            <td>7A</td>
            <td>Montevideo</td>
            <td>Artigas</td>
          </tr>
          <tr class="fila">
            <td><input type="checkbox" id="check" class="check" value="checkbox"></td>
            <td>7A</td>
            <td>Montevideo</td>
            <td>Artigas</td>
          </tr>
          <tr class="fila">
            <td><input type="checkbox" id="check" class="check" value="checkbox"></td>
            <td>7A</td>
            <td>Montevideo</td>
            <td>Artigas</td>
          </tr>
        </table>
      </div>
    </div>
    <div id="modalAgregar" class="modalAgregar">
      <div class="modal">
        <p><?= $lang['rutasNRuta']; ?></p>
        <div class="formNRuta">
          <div class="nuevoRuta">
          <div class="idRuta">
              <label>ID</label><br>
              <input id="id" type="text" name="id" placeholder=" ID">
            </div>
            <div class="origenRuta">
              <label><?= $lang['rutasOrigen']; ?></label><br>
              <input id="origen" type="text" name="origen" placeholder=" <?= $lang['rutasOrigen']; ?>">
            </div>
            <div class="destinoRuta">
              <label><?= $lang['rutasDestino']; ?></label><br>
              <input id="destino" type="text" name="destino" placeholder=" <?= $lang['rutasDestino']; ?>">
            </div>
            <div>
              <div class="ingresarRuta">
                <label><?= $lang['rutasIngresar']; ?></label><br>
                <div class="btnHorario">
                  <button id="abrirModalHorarios"><?= $lang['rutasHorarios']; ?></button>
                </div>
                <div class="btnParada">
                  <button id="abrirModalParadas"><?= $lang['rutasParadas']; ?></button>
                </div>
              </div>
            </div>
            <div class="atrasGuardar">
              <button id="atras" class="modalAtras"><?= $lang['rutasAtras']; ?></button>
              <button class="datosGuardar"><?= $lang['rutasGuardar']; ?></button>
            </div>
          </div>
          <div class="error">
            <?php
            ?>
          </div>
        </div>
      </div>
    </div>
    <div id="modalAgregarHorarios" class="modalAgregarHorarios">
      <div class="modalHorarios">
        <p><?= $lang['rutasHorarios']; ?></p>
        <div class="formHorarios">
          <div class="nuevoHorarios">
            <div class="ingresarHorarios">
              <label><?= $lang['rutasIHorario']; ?></label><br>
              <div class="ingresarHorario">
                <input id="ingresarHorario" type="text" name="ingresarHorario" placeholder=" <?= $lang['rutasIHorario']; ?>">
                <button class="AgregarHorario"><i class="fa-solid fa-plus"></i></button>
              </div>
            </div>
            <div class="divTablaHorario">
              <table class="tablaHorarios">
                <tr class="">
                  <td class="columnaPHorario">1</td>
                  <td class="columnaMHorario">14:30</td>
                  <td><button class="eliminarHorario"><i class="fa-solid fa-trash"></i></i></button></td>
                </tr>
                <tr class="">
                  <td class="columnaPHorario">1</td>
                  <td class="columnaMHorario">14:30</td>
                  <td><button class="eliminarHorario"><i class="fa-solid fa-trash"></i></i></button></td>
                </tr>
                <tr class="">
                  <td class="columnaPHorario">1</td>
                  <td class="columnaMHorario">14:30</td>
                  <td><button class="eliminarHorario"><i class="fa-solid fa-trash"></i></i></button></td>
                </tr>
                <tr class="">
                  <td class="columnaPHorario">1</td>
                  <td class="columnaMHorario">14:30</td>
                  <td><button class="eliminarHorario"><i class="fa-solid fa-trash"></i></i></button></td>
                </tr>
                <tr class="">
                  <td class="columnaPHorario">1</td>
                  <td class="columnaMHorario">14:30</td>
                  <td><button class="eliminarHorario"><i class="fa-solid fa-trash"></i></i></button></td>
                </tr>
              </table>
            </div>
            <div class="atrasGuardarHorario">
              <button id="salirHorarios" class="modalAtrasHorario"><?= $lang['rutasAtras']; ?></button>
              <button class="datosGuardarHorario"><?= $lang['rutasGuardar']; ?></button>
            </div>
          </div>
          <div class="error">
            <?php
            ?>
          </div>
        </div>
      </div>
    </div>
    <div id="modalAgregarParadas" class="modalAgregarParadas">
      <div class="modalParadas">
        <p><?= $lang['rutasParadas']; ?></p>
        <div class="formParadas">
          <div class="nuevoParadas">
            <div class="ingresarParadas">
              <label><?= $lang['rutasIParadas']; ?></label><br>
              <div class="ingresarParada">
                <input id="ingresarParada" type="text" name="ingresarParada" placeholder=" <?= $lang['rutasIParadas']; ?>">
                <button class="AgregarParada"><i class="fa-solid fa-plus"></i></button>
              </div>
            </div>
            <div class="divTablaParada">
              <table class="tablaParadas">
                <tr class="">
                  <td class="columnaPParada">1</td>
                  <td class="columnaMParada">Ejemplo</td>
                  <td><button class="eliminarParada"><i class="fa-solid fa-trash"></i></i></button></td>
                </tr>
                <tr class="">
                  <td class="columnaPParada">1</td>
                  <td class="columnaMParada">Ejemplo</td>
                  <td><button class="eliminarParada"><i class="fa-solid fa-trash"></i></i></button></td>
                </tr>
                <tr class="">
                  <td class="columnaPParada">1</td>
                  <td class="columnaMParada">Ejemplo</td>
                  <td><button class="eliminarParada"><i class="fa-solid fa-trash"></i></i></button></td>
                </tr>
                <tr class="">
                  <td class="columnaPParada">1</td>
                  <td class="columnaMParada">Ejemplo</td>
                  <td><button class="eliminarParada"><i class="fa-solid fa-trash"></i></i></button></td>
                </tr>
                <tr class="">
                  <td class="columnaPParada">1</td>
                  <td class="columnaMParada">Ejemplo</td>
                  <td><button class="eliminarParada"><i class="fa-solid fa-trash"></i></i></button></td>
                </tr>
              </table>
            </div>
            <div class="atrasGuardarParada">
              <button id="salirParadas" class="modalAtrasParada"><?= $lang['rutasAtras']; ?></button>
              <button class="datosGuardarParada"><?= $lang['rutasGuardar']; ?></button>
            </div>
          </div>
          <div class="error">
            <?php
            ?>
          </div>
        </div>
      </div>
    </div>
  </div>
  </div>
  </div>
  </div>
  <script src="js/main.js"></script>
</body>

</html>