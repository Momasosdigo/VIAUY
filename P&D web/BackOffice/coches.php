<!DOCTYPE html>
<html lang="es">
  <?php
  session_start(); //habilita las session
  include("lang/lang.php"); //archivo idiomas 
  ?>
  <script>
    // Obtén los datos de la sesión PHP y guárdalos en una variable JavaScript
    const userComun = "<?php echo isset($_SESSION['userComun']) ? $_SESSION['userComun'] : ''; ?>";
  </script>

  <head>
    <title>Coches</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="Keywords" content="Pasajes">
    <meta name="description" content="Pasajes">
    <meta name="author" content="CAMELCode.Corp">
    <meta name="copyright" content="CAMELCode.Corp">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="css/normalize.css">
    <link rel="stylesheet" href="css/global.css">
    <link rel="stylesheet" href="css/styleCoches.css?v=<?php echo(rand()); ?>">
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
        <div class="panelOpcion">
          <a href="rutas.php" class="latOpcion">
            <i class="fa-solid fa-map icon"></i>
            <span><?= $lang['bLRutas']; ?></span>
            <i class="fa-solid fa-chevron-right flecha"></i>
          </a>
        </div>
        <div class="panelActivo">
          <i class="fa-solid fa-bus-simple iconActivo"></i>
          <span class="latActivo"><?= $lang['bLCoches']; ?></span>
          <i class="fa-solid fa-chevron-right flechaActiva"></i>
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
              <a href="coches.php?la=eng"><img src="img/flags/eng.png" alt="<?= $lang['lang-eng']; ?>" title="<?= $lang['lang-eng']; ?>" /></a>
              <a href="coches.php?la=esp"><img src="img/flags/esp.png" alt="<?= $lang['lang-esp']; ?>" title="<?= $lang['lang-esp']; ?>" /></a>
            </div>
          </div>
        </div>
        <h1><?= $lang['cochesTitulo']; ?></h1>
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
              <td><?= $lang['cochesCoche']; ?></td>
              <td><?= $lang['cochesMatricula']; ?></td>
              <td><?= $lang['cochesModelo']; ?></td>
              <td><?= $lang['cochesMarca']; ?></td>
              <td><?= $lang['cochesAsientos']; ?></td>
              <td><?= $lang['cochesPisos']; ?></td>
              <td><?= $lang['cochesCreador']; ?></td>
            </tr>
          </table>
        </div>
      </div>
      <div id="modalAgregar" class="modalAgregar">
        <div class="modal">
          <p class="modalP"><?= $lang['cochesICoche']; ?></p>
          <form id="agregar">
            <div class="matriculaCoche">
              <label class="labelModal"><?= $lang['cochesMatricula']; ?></label><br>
              <input required class="inputLargo" id="matricula" type="text" name="matricula" placeholder=" <?= $lang['cochesMatricula']; ?>">
            </div>
            <div class="modeloCoche">
              <label class="labelModal"><?= $lang['cochesModelo']; ?></label><br>
              <input required class="inputLargo" id="modelo" type="text" name="modelo" placeholder=" <?= $lang['cochesModelo']; ?>">
            </div>
            <div class="marcaCoche">
              <label class="labelModal"><?= $lang['cochesMarca']; ?></label><br>
              <input required class="inputLargo" id="marca" type="text" name="marca" placeholder=" <?= $lang['cochesMarca']; ?>">
            </div>
            <div class="cocheAP">
              <div class="cocheCoche">
                <label class="labelModal"><?= $lang['cochesCoche']; ?></label><br>
                <input required class="inputCorto" id="coche" type="text" name="coche" placeholder=" <?= $lang['cochesCoche']; ?>">
              </div>
              <div class="asientosCoche">
                <label class="labelModal"><?= $lang['cochesAsientos']; ?></label><br>
                <input required required minlength="1" maxlength="2" class="inputCorto" id="asientos" type="text" name="asientos" placeholder=" <?= $lang['cochesAsientos']; ?>">
              </div>
              <div class="pisosCoche">
                <label class="labelModal"><?= $lang['cochesPisos']; ?></label><br>
                <input required required minlength="1" maxlength="1" class="inputCorto" id="pisos" type="text" name="pisos" placeholder=" <?= $lang['cochesPisos']; ?>">
              </div>
            </div>
            <div class="atrasGuardar">
            <button type="button" id="atras" class="modalAtras"><?= $lang['userAtras']; ?></button>
              <button value="submit" id="guardar" name="btnGuardar" class="datosGuardar"><?= $lang['userGuardar']; ?></button>
            </div>
            <div class="advertenciaForm" id="advertenciaForm">
            </div>
          </form>
        </div>
      </div>
      <div id="modalEditar" class="modalEditar">
        <div class="modal">
          <p class="modalP"><?= $lang['userEditarCoche']; ?></p>
          <form id="modificar"> 
            <input type="hidden" id="inputMatCam" name="matriculaAnterior">
            <div class="matriculaCoche">
              <label class="labelModal"><?= $lang['cochesMatricula']; ?></label><br>
              <input required class="inputLargo" id="inputMatricula" type="text" name="matriculaMod" >
            </div>
            <div class="modeloCoche">
              <label class="labelModal"><?= $lang['cochesModelo']; ?></label><br>
              <input required class="inputLargo" id="inputModelo" type="text" name="modeloMod">
            </div>
            <div class="marcaCoche">
              <label class="labelModal"><?= $lang['cochesMarca']; ?></label><br>
              <input required class="inputLargo" id="inputMarca" type="text" name="marcaMod">
            </div>
            <div class="cocheAP">
              <div class="cocheCoche">
                <label class="labelModal"><?= $lang['cochesCoche']; ?></label><br>
                <input required class="inputCorto" id="inputCoche" type="text" name="cocheMod">
              </div>
              <div class="asientosCoche">
                <label class="labelModal"><?= $lang['cochesAsientos']; ?></label><br>
                <input required required minlength="1" maxlength="2" class="inputCorto" id="inputAsientos" type="text" name="asientosMod">
              </div>
              <div class="pisosCoche">
                <label class="labelModal"><?= $lang['cochesPisos']; ?></label><br>
                <input required required minlength="1" maxlength="1" class="inputCorto" id="inputPisos" type="text" name="pisosMod">
              </div>
            </div>
            <div class="atrasGuardar">
              <button type="button" id="atrasEditar" class="modalAtras"><?= $lang['cochesAtras']; ?></button>
              <button value="submit" id="guardarEditar" name="guardarEditar" class="datosGuardar"><?= $lang['cochesGuardar']; ?></button>
            </div>
            <div class="advertenciaForm advertenciaFormMod" id="advertenciaFormMod">
            </div>
          </form>
        </div>
      </div>
    </div>
    <script src="js/logicaCoches.js?v=<?php echo(rand()); ?>"></script>
    <script src="js/mainCoches.js?v=<?php echo(rand()); ?>"></script>
  </body>
</html>