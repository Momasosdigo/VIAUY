<!DOCTYPE html>
<html lang="es">
  <?php
  session_start();
  include("lang/lang.php");
  if (!empty($_SESSION["userAdmin"])){
    header("location: usuarios.php");
  }
  if (!empty($_SESSION["userComun"])){
    header("location: rutas.php");
  }
  ?>
<head>
  <title>Inicio de sesion</title>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="Keywords" content="Pasajes">
  <meta name="description" content="Pasajes">
  <meta name="author" content="CAMELCode.Corp">
  <meta name="copyright" content="CAMELCode.Corp">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
  <link rel="stylesheet" href="css/normalize.css">
  <link rel="stylesheet" href="css/global.css">
  <link rel="stylesheet" href="css/style.css?v=<?php echo(rand()); ?>">
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
        <form id="formulario" class="formLogin">
          <div class="login">
            <img src="img/logoAdmin.svg" class="logo">
            <div class="user">
              <i class="fa-solid fa-user icon iconPerson"></i>
              <input id="usuario" type="text" class="txtUser" name="usuario" placeholder="<?= $lang['iniUsuario']; ?>" required>
            </div>
            <div class="pass">
            <i class="fa-solid fa-lock iconCandado"></i>
              <input type="password" id="password" name="password" class="txtPass" placeholder="<?= $lang['iniClave']; ?>" required>
            </div>
            <div class="divIniciar">
              <button id="ingresar" name="btnIngresar" class="iniciar" value="submit"><?= $lang['iniBoton'];?></button>
            </div>
            <div class="advertenciaForm" id="advertenciaForm">
            </div>
          </div>
        </form>
      </div>
    </div>
  </div>
  <script src="js/mainIndex.js?v=<?php echo(rand()); ?>"></script>
  <script src="https://code.jquery.com/jquery-3.7.0.js" integrity="sha256-JlqSTELeR4TLqP0OG9dxM7yDPqX1ox/HfgiSLBj8+kM=" crossorigin="anonymous"></script>
</body>

</html>