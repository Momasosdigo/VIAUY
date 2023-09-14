<!DOCTYPE html>
<html lang="es">
  <?php
  session_start(); //habilita las session
  include("lang/lang.php"); //archivo idiomas 
  if (!empty($_SESSION["userAdmin"])){ //comprueba si la session admin no esta iniciada

  }elseif (!empty($_SESSION["userComun"])){
    header("location: index.php");
  }
  ?>

  <head>
    <title>Usuarios</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="Keywords" content="Pasajes">
    <meta name="description" content="Pasajes">
    <meta name="author" content="CAMELCode.Corp">
    <meta name="copyright" content="CAMELCode.Corp">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="css/normalize.css">
    <link rel="stylesheet" href="css/global.css">
    <link rel="stylesheet" href="css/styleUsuarios.css?v=<?php echo(rand()); ?>">
    <link rel="stylesheet" href="css/styleGlobal.css?v=<?php echo(rand()); ?>">
  </head>

  <body>
    <div class="divPrincipal">
      <div class="panelLat">
        <img src="img/logoAdmin.svg" class="logo">
        <div class="panelActivo">
          <i class="fa-solid fa-user iconActivo"></i>
          <span class="latActivo"><?= $lang['bLUsuarios']; ?></span>
          <i class="fa-solid fa-chevron-right flechaActiva"></i>
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
              <a href="usuarios.php?la=eng"><img src="img/flags/eng.png" alt="<?= $lang['lang-eng']; ?>" title="<?= $lang['lang-eng']; ?>" /></a>
              <a href="usuarios.php?la=esp"><img src="img/flags/esp.png" alt="<?= $lang['lang-esp']; ?>" title="<?= $lang['lang-esp']; ?>" /></a>
            </div>
          </div>
        </div>
        <h1><?= $lang['userTitulo']; ?></h1>
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
              <td><?= $lang['userCedula']; ?></td>
              <td><?= $lang['userNombre']; ?></td>
              <td><?= $lang['userApellido']; ?></td>
            </tr>
          </table>
        </div>
      </div>
      <div id="modalAgregar" class="modalAgregar"> 
        <div class="modal">
          <p class="modalP"><?= $lang['userNUsuario']; ?></p>
          <form id="agregar">
            <div class="nombreUser">
              <label class="labelModal"><?= $lang['userNombre']; ?></label><br>
              <input id="nombre" required type="text" name="nombre" placeholder="<?= $lang['userNombre']; ?>">
            </div>
            <div class="apellidoUser">
              <label class="labelModal"><?= $lang['userApellido']; ?></label><br>
              <input id="apellido" required type="text" name="apellido" placeholder="<?= $lang['userApellido']; ?>">
            </div>
            <div class="cedulaClave">
              <div class="cedulaUser">
                <label class="labelModal"><?= $lang['userCedula']; ?></label><br>
                <input id="cedula" required minlength="8" maxlength="8" type="text" name="cedula" onkeypress="return validarNumeros(event)" placeholder="<?= $lang['userCedula']; ?>">
              </div>
              <div class="claveUser">
                <label class="labelModal"><?= $lang['userContraseña']; ?></label><br>
                <input id="clave" required minlength="8" type="password" name="clave" placeholder="<?= $lang['userContraseña']; ?>">
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
          <p class="modalP"><?= $lang['userEditarUser']; ?></p>
          <form id="modificar"> 
            <input type="hidden" id="inputCedCam" name="cedulaAnterior">
            <div class="nombreUser">
              <label class="labelModal"><?= $lang['userNombre']; ?></label><br>
              <input required id="inputNom" type="text" name="nombreMod">
            </div>
            <div class="apellidoUser">
              <label class="labelModal"><?= $lang['userApellido']; ?></label><br>
              <input required id="inputApe" type="text" name="apellidoMod">
            </div>
            <div class="cedulaClave">
              <div class="cedulaUser">
                <label class="labelModal"><?= $lang['userCedula']; ?></label><br>
                <input onkeypress="return validarNumeros(event)" required minlength="8" maxlength="8" id="inputCed" id="cedula" type="text" name="cedulaMod">
              </div>
              <div class="claveUser">
                <label class="labelModal"><?= $lang['userContraseña']; ?></label><br>
                <input required minlength="8" type="password" id="inputCla" type="password" name="claveMod" placeholder="<?= $lang['userContraseña']; ?>">
              </div>
            </div>
            <div class="atrasGuardar">
              <button type="button" id="atrasEditar" class="modalAtras"><?= $lang['userAtras']; ?></button>
              <button value="submit" id="guardarEditar" name="guardarEditar" class="datosGuardar"><?= $lang['userGuardar']; ?></button>
            </div>
            <div class="advertenciaForm advertenciaFormMod" id="advertenciaFormMod">
            </div>
          </form>
        </div>
      </div>
    </div>
    <script src="js/logicaUsuarios.js?v=<?php echo(rand()); ?>"></script>
    <script src="js/mainUsuarios.js?v=<?php echo(rand()); ?>"></script>
  </body>
</html>