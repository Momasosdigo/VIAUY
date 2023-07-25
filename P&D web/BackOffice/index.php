<!DOCTYPE html>
<html lang="es">
  <?php
  include("lang/lang.php");
  ?>

<head>
  <title>Admin</title>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="Keywords" content="Pasajes">
  <meta name="description" content="Pasajes">
  <meta name="author" content="CAMELCode.Corp">
  <meta name="copyright" content="CAMELCode.Corp">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
  <link rel="stylesheet" href="css/normalize.css">
  <link rel="stylesheet" href="css/global.css">
  <link rel="stylesheet" href="css/style.css">
</head>

<body>
  <div class="divPrincipal">
    <div class="nav">
      <div class="idioma">
        <div class="dropdown">
          <button class="dropbtn"><img src="<?= $lang['banderaIdioma']; ?>"> <i class="fa-solid fa-angle-down"></i></button>
          <div class="dropdown-content">
            <a href="index.php?la=eng"><img src="img/flags/eng.png" alt="<?= $lang['lang-eng']; ?>" title="<?= $lang['lang-eng']; ?>" /></a>
            <a href="index.php?la=esp"><img src="img/flags/esp.png" alt="<?= $lang['lang-esp']; ?>" title="<?= $lang['lang-esp']; ?>" /></a>
          </div>
        </div>
      </div>
    </div>
    <div>
      <div class="content">
        <form method="post" class="formLogin">
          <div class="login">
            <img src="img/logoAdmin.svg" class="logo">
            <div class="user">
              <i class="fa-solid fa-user icon iconPerson"></i>
              <input id="usuario" type="text" class="txtUser" name="usuario" placeholder="<?= $lang['iniUsuario']; ?>">
            </div>
            <div class="pass">
            <i class="fa-solid fa-lock iconCandado"></i>
              <input type="password" id="input" name="password" class="txtPass" placeholder="<?= $lang['iniClave']; ?>">
            </div>
            <div class="divIniciar">
              <button name="btnIngresar" class="iniciar" value="submit"><?= $lang['iniBoton'];?></button>
            </div>
            <div class="restablecerC">
              <a href="#">
                <p><?= $lang['iniRestablecer']; ?></p>
              </a>
            </div>
            <div class="error">
              <?php
              include 'controlador/controladorLogin.php';
              ?>
            </div>
          </div>
        </form>
      </div>
    </div>
  </div>
  <footer>
  </footer>
</body>

</html>