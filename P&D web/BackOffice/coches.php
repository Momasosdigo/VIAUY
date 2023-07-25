<!DOCTYPE html>
<html lang="es">
  <?php
  include("lang/lang.php");
  ?>

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
  <link rel="stylesheet" href="css/styleCoches.css">
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
        <i class="fa-solid fa-chevron-right flecha"></i>
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
            <a href="coches.php?la=eng"><img src="img/flags/eng.png" alt="<?= $lang['lang-eng']; ?>" title="<?= $lang['lang-eng']; ?>" /></a>
            <a href="coches.php?la=esp"><img src="img/flags/esp.png" alt="<?= $lang['lang-esp']; ?>" title="<?= $lang['lang-esp']; ?>" /></a>
          </div>
        </div>
      </div>
      <h1><?= $lang['cochesTitulo']; ?></h1>
      <div class="buscador">
        <button id="abrirModal" class="nuevo"><i class="fa-solid fa-plus"></i><?= $lang['cochesNuevo']; ?></button>
        <button class="editar"><i class="fa-solid fa-pen"></i><?= $lang['cochesEditar']; ?></button>
        <button class="borrar"><i class="fa-solid fa-trash"></i><?= $lang['cochesBorrar']; ?></button>
        <input id="buscar" type="text" class="TxtBuscar" name="buscar" placeholder="  Buscar">
        <button class="buscar"><i class="fa-solid fa-magnifying-glass"></i><?= $lang['cochesBuscar']; ?></button>
      </div>
      <div class="table">
        <table class="mostrarDatos">
          <tr class="filaTitulo">
            <td></td>
            <td><?= $lang['cochesCoche']; ?></td>
            <td><?= $lang['cochesMatricula']; ?></td>
            <td><?= $lang['cochesModelo']; ?></td>
            <td><?= $lang['cochesMarca']; ?></td>
            <td><?= $lang['cochesAsientos']; ?></td>
            <td><?= $lang['cochesPisos']; ?></td>
          </tr>
          <tr class="fila">
            <td><input type="checkbox" id="check" class="check" value="checkbox"></td>
            <td>101</td>
            <td>ABC-1234</td>
            <td>RS6</td>
            <td>Audi</td>
            <td>42</td>
            <td>2</td>
          </tr>
          <tr class="fila">
            <td><input type="checkbox" id="check" class="check" value="checkbox"></td>
            <td>101</td>
            <td>ABC-1234</td>
            <td>RS6</td>
            <td>Audi</td>
            <td>42</td>
            <td>2</td>
          </tr>
          <tr class="fila">
            <td><input type="checkbox" id="check" class="check" value="checkbox"></td>
            <td>101</td>
            <td>ABC-1234</td>
            <td>RS6</td>
            <td>Audi</td>
            <td>42</td>
            <td>2</td>
          </tr>
          <tr class="fila">
            <td><input type="checkbox" id="check" class="check" value="checkbox"></td>
            <td>101</td>
            <td>ABC-1234</td>
            <td>RS6</td>
            <td>Audi</td>
            <td>42</td>
            <td>2</td>
          </tr>
          <tr class="fila">
            <td><input type="checkbox" id="check" class="check" value="checkbox"></td>
            <td>101</td>
            <td>ABC-1234</td>
            <td>RS6</td>
            <td>Audi</td>
            <td>42</td>
            <td>2</td>
          </tr>
          <tr class="fila">
            <td><input type="checkbox" id="check" class="check" value="checkbox"></td>
            <td>101</td>
            <td>ABC-1234</td>
            <td>RS6</td>
            <td>Audi</td>
            <td>42</td>
            <td>2</td>
          </tr>
          <tr class="fila">
            <td><input type="checkbox" id="check" class="check" value="checkbox"></td>
            <td>101</td>
            <td>ABC-1234</td>
            <td>RS6</td>
            <td>Audi</td>
            <td>42</td>
            <td>2</td>
          </tr>
          <tr class="fila">
            <td><input type="checkbox" id="check" class="check" value="checkbox"></td>
            <td>101</td>
            <td>ABC-1234</td>
            <td>RS6</td>
            <td>Audi</td>
            <td>42</td>
            <td>2</td>
          </tr>
          <tr class="fila">
            <td><input type="checkbox" id="check" class="check" value="checkbox"></td>
            <td>101</td>
            <td>ABC-1234</td>
            <td>RS6</td>
            <td>Audi</td>
            <td>42</td>
            <td>2</td>
          </tr>
          <tr class="fila">
            <td><input type="checkbox" id="check" class="check" value="checkbox"></td>
            <td>101</td>
            <td>ABC-1234</td>
            <td>RS6</td>
            <td>Audi</td>
            <td>42</td>
            <td>2</td>
          </tr>
          <tr class="fila">
            <td><input type="checkbox" id="check" class="check" value="checkbox"></td>
            <td>101</td>
            <td>ABC-1234</td>
            <td>RS6</td>
            <td>Audi</td>
            <td>42</td>
            <td>2</td>
          </tr>
          <tr class="fila">
            <td><input type="checkbox" id="check" class="check" value="checkbox"></td>
            <td>101</td>
            <td>ABC-1234</td>
            <td>RS6</td>
            <td>Audi</td>
            <td>42</td>
            <td>2</td>
          </tr>
          <tr class="fila">
            <td><input type="checkbox" id="check" class="check" value="checkbox"></td>
            <td>101</td>
            <td>ABC-1234</td>
            <td>RS6</td>
            <td>Audi</td>
            <td>42</td>
            <td>2</td>
          </tr>
          <tr class="fila">
            <td><input type="checkbox" id="check" class="check" value="checkbox"></td>
            <td>101</td>
            <td>ABC-1234</td>
            <td>RS6</td>
            <td>Audi</td>
            <td>42</td>
            <td>2</td>
          </tr>
          <tr class="fila">
            <td><input type="checkbox" id="check" class="check" value="checkbox"></td>
            <td>101</td>
            <td>ABC-1234</td>
            <td>RS6</td>
            <td>Audi</td>
            <td>42</td>
            <td>2</td>
          </tr>
          <tr class="fila">
            <td><input type="checkbox" id="check" class="check" value="checkbox"></td>
            <td>101</td>
            <td>ABC-1234</td>
            <td>RS6</td>
            <td>Audi</td>
            <td>42</td>
            <td>2</td>
          </tr>
          <tr class="fila">
            <td><input type="checkbox" id="check" class="check" value="checkbox"></td>
            <td>101</td>
            <td>ABC-1234</td>
            <td>RS6</td>
            <td>Audi</td>
            <td>42</td>
            <td>2</td>
          </tr>
          <tr class="fila">
            <td><input type="checkbox" id="check" class="check" value="checkbox"></td>
            <td>101</td>
            <td>ABC-1234</td>
            <td>RS6</td>
            <td>Audi</td>
            <td>42</td>
            <td>2</td>
          </tr>
          <tr class="fila">
            <td><input type="checkbox" id="check" class="check" value="checkbox"></td>
            <td>101</td>
            <td>ABC-1234</td>
            <td>RS6</td>
            <td>Audi</td>
            <td>42</td>
            <td>2</td>
          </tr>
          <tr class="fila">
            <td><input type="checkbox" id="check" class="check" value="checkbox"></td>
            <td>101</td>
            <td>ABC-1234</td>
            <td>RS6</td>
            <td>Audi</td>
            <td>42</td>
            <td>2</td>
          </tr>
          <tr class="fila">
            <td><input type="checkbox" id="check" class="check" value="checkbox"></td>
            <td>101</td>
            <td>ABC-1234</td>
            <td>RS6</td>
            <td>Audi</td>
            <td>42</td>
            <td>2</td>
          </tr>
          <tr class="fila">
            <td><input type="checkbox" id="check" class="check" value="checkbox"></td>
            <td>101</td>
            <td>ABC-1234</td>
            <td>RS6</td>
            <td>Audi</td>
            <td>42</td>
            <td>2</td>
          </tr>
          <tr class="fila">
            <td><input type="checkbox" id="check" class="check" value="checkbox"></td>
            <td>101</td>
            <td>ABC-1234</td>
            <td>RS6</td>
            <td>Audi</td>
            <td>42</td>
            <td>2</td>
          </tr>
          <tr class="fila">
            <td><input type="checkbox" id="check" class="check" value="checkbox"></td>
            <td>101</td>
            <td>ABC-1234</td>
            <td>RS6</td>
            <td>Audi</td>
            <td>42</td>
            <td>2</td>
          </tr>
          <tr class="fila">
            <td><input type="checkbox" id="check" class="check" value="checkbox"></td>
            <td>101</td>
            <td>ABC-1234</td>
            <td>RS6</td>
            <td>Audi</td>
            <td>42</td>
            <td>2</td>
          </tr>
          <tr class="fila">
            <td><input type="checkbox" id="check" class="check" value="checkbox"></td>
            <td>101</td>
            <td>ABC-1234</td>
            <td>RS6</td>
            <td>Audi</td>
            <td>42</td>
            <td>2</td>
          </tr>
        </table>
      </div>
    </div>
    <div id="modalAgregar" class="modalAgregar">
      <div class="modal">
        <p><?= $lang['cochesICoche']; ?></p>
        <div class="formNCoche">
          <div class="nuevoCoche">
            <div class="matriculaCoche">
              <label><?= $lang['cochesMatricula']; ?></label><br>
              <input id="matricula" type="text" name="matricula" placeholder=" <?= $lang['cochesMatricula']; ?>">
            </div>
            <div class="modeloCoche">
              <label><?= $lang['cochesModelo']; ?></label><br>
              <input id="modelo" type="text" name="modelo" placeholder=" <?= $lang['cochesModelo']; ?>">
            </div>
            <div class="marcaCoche">
              <label><?= $lang['cochesMarca']; ?></label><br>
              <input id="marca" type="text" name="marca" placeholder=" <?= $lang['cochesMarca']; ?>">
            </div>
            <div class="cocheAP">
              <div class="cocheCoche">
                <label><?= $lang['cochesCoche']; ?></label><br>
                <input id="coche" type="text" name="coche" placeholder=" <?= $lang['cochesCoche']; ?>">
              </div>
              <div class="asientosCoche">
                <label><?= $lang['cochesAsientos']; ?></label><br>
                <input id="asientos" type="password" name="asientos" placeholder=" <?= $lang['cochesAsientos']; ?>">
              </div>
              <div class="pisosCoche">
                <label><?= $lang['cochesPisos']; ?></label><br>
                <input id="pisos" type="password" name="pisos" placeholder=" <?= $lang['cochesPisos']; ?>">
              </div>
            </div>
            <div class="atrasGuardar">
              <button id="atras" class="modalAtras"><?= $lang['cochesAtras']; ?></button>
              <button class="datosGuardar"><?= $lang['cochesGuardar']; ?></button>
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
  <script src="js/main.js"></script>
</body>

</html>