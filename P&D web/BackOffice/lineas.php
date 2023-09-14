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
    <title>Lineas</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="Keywords" content="Pasajes">
    <meta name="description" content="Pasajes">
    <meta name="author" content="CAMELCode.Corp">
    <meta name="copyright" content="CAMELCode.Corp">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="css/normalize.css">
    <link rel="stylesheet" href="css/global.css">
    <link rel="stylesheet" href="css/styleGlobal.css?v=<?php echo(rand()); ?>">
    <link rel="stylesheet" href="css/styleLineas.css?v=<?php echo(rand()); ?>">
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
        <div class="panelOpcion">
          <a href="rutas.php" class="latOpcion">
            <i class="fa-solid fa-map icon"></i>
            <span><?= $lang['bLRutas']; ?></span>
            <i class="fa-solid fa-chevron-right flecha"></i>
          </a>
        </div>
        <div class="panelOpcion">
          <a href="coches.php" class="latOpcion">
            <i class="fa-solid fa-bus-simple icon"></i>
            <span><?= $lang['bLCoches']; ?></span>
            <i class="fa-solid fa-chevron-right flecha"></i>
          </a>
        </div>
        <div class="panelActivo">
          <i class="fa-solid fa-signs-post iconActivo"></i>
          <span class="latActivo"><?= $lang['bLLineas']; ?></span>
          <i class="fa-solid fa-chevron-right flechaActiva"></i>
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
              <a href="lineas.php?la=eng"><img src="img/flags/eng.png" alt="<?= $lang['lang-eng']; ?>" title="<?= $lang['lang-eng']; ?>" /></a>
              <a href="lineas.php?la=esp"><img src="img/flags/esp.png" alt="<?= $lang['lang-esp']; ?>" title="<?= $lang['lang-esp']; ?>" /></a>
            </div>
          </div>
        </div>
        <h1><?= $lang['lineasTitulo']; ?></h1>
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
              <td class="tamaño"><?= $lang['lineasLinea']; ?></td>
              <td class="tamaño"><?= $lang['lineasCoches']; ?></td>
              <td class="tamaño"><?= $lang['lineasRutas']; ?></td>
            </tr>
            <tr>
              <td><input onclick='borrarUsuario(); disableOtherChecks(this)' type='checkbox' class='check seleccionarFila'></td>
              <td><input class='inputTabla' type='text' readonly value="L1"></td>
              <td><button class="botonETP">Ver</button></td>
              <td><button class="botonETP">Ver</button></td>
            </tr>
            <tr>
              <td><input onclick='borrarUsuario(); disableOtherChecks(this)' type='checkbox' class='check seleccionarFila'></td>
              <td><input class='inputTabla' type='text' readonly value="L2"></td>
              <td><button class="botonETP">Ver</button></td>
              <td><button class="botonETP">Ver</button></td>
            </tr>
            <tr>
              <td><input onclick='borrarUsuario(); disableOtherChecks(this)' type='checkbox' class='check seleccionarFila'></td>
              <td><input class='inputTabla' type='text' readonly value="L3"></td>
              <td><button class="botonETP">Ver</button></td>
              <td><button class="botonETP">Ver</button></td>
            </tr>
          </table>
        </div>
      </div>
      <div id="modalAgregar" class="modalAgregar">
        <div class="modal">
          <p class="modalP"><?= $lang['lineasNLinea']; ?></p>
          <div class="formNLinea">
            <div class="nuevoLinea">
              <div class="idLinea">
                <label class="labelModal"><?= $lang['lineasNombre']; ?></label><br>
                <input id="id" type="text" name="id" placeholder=" Nombre">
              </div>
              <div>
                <div class="ingresarLinea">
                  <label class="labelModal">Asignar</label><br>
                  <div class="btnCoche">
                    <button id="abrirModalCoches"><?= $lang['lineasCoches']; ?></button>
                  </div>
                  <div class="btnRuta">
                    <button id="abrirModalRutas"><?= $lang['lineasRutas']; ?></button>
                  </div>
                </div>
              </div>
              <div class="atrasGuardar">
                <button id="atras" class="modalAtras"><?= $lang['rutasAtras']; ?></button>
                <button class="datosGuardar"><?= $lang['rutasGuardar']; ?></button>
              </div>
            </div>
            <div class="error">
            </div>
          </div>
        </div>
      </div>
      <div id="modalAgregarCoches" class="modalAgregarCoches">
        <div class="modalLCR">
          <p class="modalP">Seleccionar coches</p>
          <div class="tableMCR">
            <table class="mostrarDatos" id="tableCoche">
              <tr class="filaTitulo filaTitulo2">
                <td><input type="checkbox" class="seleccionarFila"></td>
                <td><?= $lang['cochesCoche']; ?></td>
                <td><?= $lang['cochesMatricula']; ?></td>
                <td><?= $lang['cochesModelo']; ?></td>
                <td><?= $lang['cochesMarca']; ?></td>
                <td><?= $lang['cochesAsientos']; ?></td>
                <td><?= $lang['cochesPisos']; ?></td>
              </tr>
            </table>
          </div>
          <div class="atrasGuardarCoche">
            <button id="salirCoches" class="modalAtrasCoche"><?= $lang['rutasAtras']; ?></button>
            <button class="datosGuardarCoche"><?= $lang['rutasGuardar']; ?></button>
          </div>
          <div class="error">
          </div>
        </div>
      </div>
      <div id="modalAgregarRutas" class="modalAgregarRutas">
      <div class="modalLCR">
        <p class="modalP">Seleccionar rutas</p>
          <div class="tableMCR">
            <table class="mostrarDatos" id="tableRuta">
              <tr class="filaTitulo filaTitulo2">
                <td><input type="checkbox" class="seleccionarFila"></td>
                <td>Identificador</td>
                <td><?= $lang['rutasOrigen']; ?></td>
                <td><?= $lang['rutasDestino']; ?></td>
              </tr>
            </table>
          </div>
          <div class="atrasGuardarRuta">
            <button id="salirRutas" class="modalAtrasRuta"><?= $lang['rutasAtras']; ?></button>
            <button class="datosGuardarRuta"><?= $lang['rutasGuardar']; ?></button>
          </div>
          <div class="error">
          </div>
        </div>
      </div>
    </div>
    </div>
    </div>
    </div>
    <script src="js/mainLineas.js?v=<?php echo(rand()); ?>"></script>
    <script src="js/logicaLineas.js?v=<?php echo(rand()); ?>"></script>
  </body>

</html>