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
    <link rel="stylesheet" href="css/styleHorarios.css?v=<?php echo(rand()); ?>">
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
        <div class="panelOpcion">
          <a href="lineas.php" class="latOpcion">
            <i class="fa-solid fa-signs-post icon"></i>
            <span><?= $lang['bLLineas']; ?></span>
            <i class="fa-solid fa-chevron-right flecha"></i>
          </a>
        </div>
        <div class="panelActivo">
            <i class="fa-solid fa-clock iconActivo"></i>
            <span class="latActivo"><?= $lang['bLHorarios']; ?></span>
            <i class="fa-solid fa-chevron-right flechaActiva"></i>
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
              <a href="horarios.php?la=eng"><img src="img/flags/eng.png" alt="<?= $lang['lang-eng']; ?>" title="<?= $lang['lang-eng']; ?>" /></a>
              <a href="horarios.php?la=esp"><img src="img/flags/esp.png" alt="<?= $lang['lang-esp']; ?>" title="<?= $lang['lang-esp']; ?>" /></a>
            </div>
          </div>
        </div>
        <h1><?= $lang['horariosTitulo']; ?></h1>
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
          <table class="mostrarDatos">
            <tr class="filaTitulo">
              <td><input type="checkbox" class="seleccionarFila"></td>
              <td><?= $lang['horariosLinea']; ?></td>
              <td><?= $lang['horariosHora']; ?></td>
              <td><?= $lang['horariosDia']; ?></td>
              <td><?= $lang['horariosCoche']; ?></td>
            </tr>
            <tr class="">
              <td><input onclick='borrarUsuario(); disableOtherChecks(this)' type='checkbox' class='check seleccionarFila'></td>
              <td><input class='inputTabla' type='text' readonly value="L1"></td>
              <td><input class='inputTabla' type='text' readonly value="09:30"></td>
              <td><input class='inputTabla' type='text' readonly value="Lunes"></td>
              <td><input class='inputTabla' type='text' readonly value="123"></td>
            </tr>
            <tr class="">
              <td><input onclick='borrarUsuario(); disableOtherChecks(this)' type='checkbox' class='check seleccionarFila'></td>
              <td><input class='inputTabla' type='text' readonly value="L1"></td>
              <td><input class='inputTabla' type='text' readonly value="09:30"></td>
              <td><input class='inputTabla' type='text' readonly value="Lunes"></td>
              <td><input class='inputTabla' type='text' readonly value="123"></td>
            </tr>
            <tr class="">
              <td><input onclick='borrarUsuario(); disableOtherChecks(this)' type='checkbox' class='check seleccionarFila'></td>
              <td><input class='inputTabla' type='text' readonly value="L1"></td>
              <td><input class='inputTabla' type='text' readonly value="09:30"></td>
              <td><input class='inputTabla' type='text' readonly value="Lunes"></td>
              <td><input class='inputTabla' type='text' readonly value="123"></td>
            </tr>
            <tr class="">
              <td><input onclick='borrarUsuario(); disableOtherChecks(this)' type='checkbox' class='check seleccionarFila'></td>
              <td><input class='inputTabla' type='text' readonly value="L1"></td>
              <td><input class='inputTabla' type='text' readonly value="09:30"></td>
              <td><input class='inputTabla' type='text' readonly value="Lunes"></td>
              <td><input class='inputTabla' type='text' readonly value="123"></td>
            </tr>
            <tr class="">
              <td><input onclick='borrarUsuario(); disableOtherChecks(this)' type='checkbox' class='check seleccionarFila'></td>
              <td><input class='inputTabla' type='text' readonly value="L1"></td>
              <td><input class='inputTabla' type='text' readonly value="09:30"></td>
              <td><input class='inputTabla' type='text' readonly value="Lunes"></td>
              <td><input class='inputTabla' type='text' readonly value="123"></td>
            </tr>
          </table>
        </div>
      </div>
      <div id="modalAgregar" class="modalAgregar">
        <div class="modal">
          <p class="modalP"><?= $lang['horariosHorarios']; ?></p>
          <div class="formNLinea">
            <div class="nuevoLinea">
            <div class="asignarH">
              <label class="labelModal">Asignar</label>
              <select class="seleccionarL" id=""></select>
              <div class="agregarDatos">
                <label class="labelAgregarH"><?= $lang['horariosHora']; ?></label>
                <label class="labelAgregarH"><?= $lang['horariosDia']; ?></label>
                <label class="labelAgregarH"><?= $lang['horariosCoche']; ?></label>
              </div>
              <div class="agregarDatos">
                <input type="time" class="inputAgregarH" placeholder=" Hora">
                <select class="inputAgregarH">
                  <option id="dia1">Lunes</option>
                  <option id="dia2">Martes</option>
                  <option id="dia3">Miercoles</option>
                  <option id="dia4">Jueves</option>
                  <option id="dia5">Viernes</option>
                  <option id="dia6">Sabado</option>
                  <option id="dia7">Domingo</option>
                </select>
                <div class="dropdown">
                  <input class="dropdownInput" type='text' id="selecInput">
                  <div class="dropdownContenido">
                    <div id="seleccionarCoche">
                    </div>
                  </div>
                </div>
                <button class="AgregarHorario"><i class="fa-solid fa-plus"></i></button>
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
    </div>
    </div>
    </div>
    </div>
    <script src="js/mainHorarios.js?v=<?php echo(rand()); ?>"></script>
    <script src="js/logicaHorarios.js?v=<?php echo(rand()); ?>"></script>
  </body>

</html>