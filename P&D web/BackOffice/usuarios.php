<!DOCTYPE html>
<html lang="es">
  <?php
  include("lang/lang.php");
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
  <link rel="stylesheet" href="css/styleUsuarios.css">
  <link rel="stylesheet" href="css/styleGlobal.css">
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
      <div class="cerrarSesion">
        <a href="index.php"><button><i class="fa-solid fa-chevron-left"></i> <?= $lang['bLCerrarSesion']; ?></button></a>
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
        <button id="abrirModal" class="nuevo"><i class="fa-solid fa-plus"></i><?= $lang['userNuevo']; ?></button>
        <button class="editar"><i class="fa-solid fa-pen"></i><?= $lang['userEditar']; ?></button>
        <button class="borrar"><i class="fa-solid fa-trash"></i><?= $lang['userBorrar']; ?></button>
        <input id="buscar" type="text" class="TxtBuscar" name="buscar" placeholder="  Buscar">
        <button class="buscar"><i class="fa-solid fa-magnifying-glass"></i><?= $lang['userBuscar']; ?></button>
      </div>
      <div class="table">
        <table class="mostrarDatos">
          <tr class="filaTitulo">
            <td></td>
            <td><?= $lang['userCedula']; ?></td>
            <td><?= $lang['userNombre']; ?></td>
            <td><?= $lang['userApellido']; ?></td>
          </tr>
          <tr class="fila">
            <td><input type="checkbox" id="check" class="check" value="checkbox"></td>
            <td>5.123.123-3</td>
            <td>Cody</td>
            <td>Lane</td>
          </tr>
          <tr class="fila">
            <td><input type="checkbox" id="check" class="check" value="checkbox"></td>
            <td>5.123.123-3</td>
            <td>Arthur</td>
            <td>Edwards</td>
          </tr>
          <tr class="fila">
            <td><input type="checkbox" id="check" class="check" value="checkbox"></td>
            <td>5.123.123-3</td>
            <td>Cody</td>
            <td>Lane</td>
          </tr>
          <tr class="fila">
            <td><input type="checkbox" id="check" class="check" value="checkbox"></td>
            <td>5.123.123-3</td>
            <td>Arthur</td>
            <td>Edwards</td>
          </tr>
          <tr class="fila">
            <td><input type="checkbox" id="check" class="check" value="checkbox"></td>
            <td>5.123.123-3</td>
            <td>Cody</td>
            <td>Lane</td>
          </tr>
          <tr class="fila">
            <td><input type="checkbox" id="check" class="check" value="checkbox"></td>
            <td>5.123.123-3</td>
            <td>Arthur</td>
            <td>Edwards</td>
          </tr>
        </table>
      </div>
    </div>
    <div id="modalAgregar" class="modalAgregar">
      <div class="modal">
        <p><?= $lang['userNUsuario']; ?></p>
        <form method="get" class="formNUser">
          <div class="nuevoUser">
            <div class="nombreUser">
              <label><?= $lang['userNombre']; ?></label><br>
              <input id="nombre" type="text" name="nombre" placeholder=" <?= $lang['userNombre']; ?>">
            </div>
            <div class="apellidoUser">
              <label><?= $lang['userApellido']; ?></label><br>
              <input id="apellido" type="text" name="apellido" placeholder=" <?= $lang['userApellido']; ?>">
            </div>
            <div class="cedulaClave">
              <div class="cedulaUser">
                <label><?= $lang['userCedula']; ?></label><br>
                <input id="cedula" type="text" name="cedula" placeholder=" <?= $lang['userCedula']; ?>">
              </div>
              <div class="claveUser">
                <label><?= $lang['userContraseña']; ?></label><br>
                <input id="clave" type="password" name="clave" placeholder=" <?= $lang['userContraseña']; ?>">
              </div>
            </div>
            <div class="atrasGuardar">
              <button id="atras" class="modalAtras"><?= $lang['userAtras']; ?></button>
              <button class="datosGuardar"><?= $lang['userGuardar']; ?></button>
            </div>
          </div>
          <div class="error">
            <?php
            ?>
          </div>
      </div>
      </form>
    </div>
  </div>
  </div>
  <script src="js/main.js"></script>
</body>

</html>