<!DOCTYPE html>
<html lang="es">
  <?php
  session_start();
  include("lang/lang.php"); //archivo idiomas 
  ?>
  <script>
    // Obtén los datos de la sesión PHP y guárdalos en una variable JavaScript
    const userComun = "<?php echo isset($_SESSION['userComun']) ? $_SESSION['userComun'] : ''; ?>";
</script>

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
    <link rel="stylesheet" href="css/styleRutas.css?v=<?php echo(rand()); ?>">
    <link rel="stylesheet" href="css/styleGlobal.css?v=<?php echo(rand()); ?>">
  </head>

  <body>
    <div class="divPrincipal">
      <div class="panelLat">
        <img src="img/logoAdmin.svg" class="logo">
        <div class="panelOpcion" id="pUsuario">
          <a href="usuarios.php" class="latOpcion">
            <i class="fa-solid fa-user icon"></i>
            <span><?= $lang['bLUsuarios']; ?></span>
            <i class="fa-solid fa-chevron-right flecha"></i>
          </a>
        </div>
        <div class="panelActivo">
          <i class="fa-solid fa-map iconActivo"></i>
          <span class="latActivo"><?= $lang['bLRutas']; ?></span>
          <i class="fa-solid fa-chevron-right flechaActiva"></i>
        </div>
        <div class="panelOpcion">
          <a href="coches.php" class="latOpcion">
            <i class="fa-solid fa-bus-simple icon"></i>
            <span><?= $lang['bLCoches']; ?></span>
            <i class="fa-solid fa-chevron-right flecha"></i>
          </a>
        </div>
        <div class="panelOpcion">
          <a href="lineas.php" class="latOpcion">
            <i class="fa-solid fa-signs-post icon"></i>
            <span><?= $lang['bLLineas']; ?></span>
            <i class="fa-solid fa-chevron-right flecha"></i>
          </a>
        </div>
        <div class="panelOpcion">
          <a href="horarios.php" class="latOpcion">
            <i class="fa-solid fa-clock icon"></i>
            <span><?= $lang['bLHorarios']; ?></span>
            <i class="fa-solid fa-chevron-right flecha"></i>
          </a>
        </div>
        <div class="cerrarSesion">
          <a href="controlador/controladorCerrarSesion.php"><button><i class="fa-solid fa-chevron-left"></i> <?= $lang['bLCerrarSesion']; ?></button></a>
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
          <button id="abrirModal" class="nuevo"><i class="fa-solid fa-plus"></i><?= $lang['bBNuevo']; ?></button>
          <button onclick="guardarDatosFila()" class="editar"><i class="fa-solid fa-pen"></i><?= $lang['bBEditar']; ?></button>
          <form id="borrar" class="divBorrar"> 
            <input id="claveBorrar" type="hidden">
            <button value="submit" class="borrar" name="btnBorrar"><i class="fa-solid fa-trash"></i><?= $lang['bBBorrar']; ?></button>
          </form>
          <div class="divBuscador" id="buscar">
            <input id="searchInput" type="text" class="TxtBuscar" name="buscar" placeholder="  <?= $lang['bBBuscar']; ?>">
            <button id="searchButton" class="buscar" name="buscador"><i class="fa-solid fa-magnifying-glass"></i><?= $lang['bBBuscar']; ?></button>
          </div>
        </div>
        <div class="advertenciaBorrar" id="advertenciaBorrar">
        </div>
        <div class="table">
          <table class="mostrarDatos" id="table">
            <tr class="filaTitulo">
              <td><input type="checkbox" class="seleccionarFila"></td>
              <td>Identificador</td>
              <td><?= $lang['rutasOrigen']; ?></td>
              <td><?= $lang['rutasDestino']; ?></td>
              <td>Precio</td>
            </tr>
          </table>
        </div>
      </div>
      <div id="modalAgregar" class="modalAgregar">
        <div class="modal">
          <p class="modalP"><?= $lang['rutasNRuta']; ?></p>
          <form id="agregar">
            <div class="nuevoRuta">
              <div class="divsRuta">
                <label class="labelModal">Identificador</label><br>
                <input id="idRuta" required autocomplete="off" type="text" name="idRuta" placeholder=" Identificador">
              </div>
              <div class="divsRuta">
                <div class="dropdown">
                  <label class="labelModal"><?= $lang['rutasOrigen']; ?></label><br>
                  <input id="origenOculto" type="hidden">
                  <input class="dropdownInput" type='text' autocomplete="off" required name="origen" id="inputOrigen" placeholder=" <?= $lang['rutasOrigen']; ?>">
                  <div class="dropdownContenidoO">
                    <div id="seleccionarParadaO">
                    </div>
                </div>
              </div>
              </div>
              <div class="divsRuta">
                <div class="dropdown">
                  <label class="labelModal"><?= $lang['rutasDestino']; ?></label><br>
                  <input id="destinoOculto" type="hidden">
                  <input class="dropdownInput" type='text' autocomplete="off" required name="origen" id="inputDestino" placeholder=" <?= $lang['rutasDestino']; ?>">
                  <div class="dropdownContenidoD">
                    <div id="seleccionarParadaD">
                    </div>
                  </div>
                </div>
              </div>
              <div class="divsRuta">
                <label class="labelModal">Precio total</label><br>
                <input id="precioTotal" type="number" required name="precio" min="200" max="9999" placeholder=" Precio">
              </div>
              <div>
                <div class="ingresarRuta">
                  <label class="labelModal"><?= $lang['rutasIngresar']; ?></label><br>
                  <div class="btnParada">
                    <button type="button" id="abrirModalParadas"><?= $lang['rutasParadas']; ?></button>
                  </div>
                </div>
              </div>
              <div class="atrasGuardar">
                <button type="button" id="atras" class="modalAtras"><?= $lang['rutasAtras']; ?></button>
                <button value="submit" class="datosGuardar"><?= $lang['rutasGuardar']; ?></button>
              </div>
            </div>
            <div class="advertenciaForm" id="advertenciaForm">
            </div>
          </form>
        </div>
      </div>
      <div id="modalAgregarParadas" class="modalAgregarParadas">
        <div class="modal">
          <p class="modalP"><?= $lang['rutasParadas']; ?></p>
          <div class="formParadas">
            <div class="nuevoParadas">
              <div class="ingresarParadas">
                <label class="labelModal"><?= $lang['rutasIParadas']; ?></label><br>
                <div class="dropdown">
                  <input id="paradaOculto" type="hidden">
                  <input autocomplete="off"  class="dropdownInput" type='text' id="selecInput">
                  <div class="dropdownContenido">
                    <div id="seleccionarParada">
                    </div>
                  </div>
                  <button class="AgregarParada" id="AgregarParada"><i class="fa-solid fa-plus"></i></button>
                </div>
              </div>
              <div class="divTablaParada">
                <table class="tablaParadas" id="tablaParadas">
                </table>
              </div>
              <div class="atrasGuardarParada">
                <button id="salirParadas" class="modalAtrasParada"><?= $lang['rutasAtras']; ?></button>
                <button id="datosGuardarParada" class="datosGuardarParada"><?= $lang['rutasGuardar']; ?></button>
              </div>
            </div>
            <div class="error">
            </div>
          </div>
        </div>
      </div>
    </div>
    </div>
    </div>
    </div>
    <script src="js/mainRutas.js?v=<?php echo(rand()); ?>"></script>
    <script src="js/logicaRutas.js?v=<?php echo(rand()); ?>"></script>
  </body>

</html>