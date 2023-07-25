<?php
$error=$lang['iniError'];
if (!empty($_POST['btnIngresar'])) {
  if (!empty($_POST["usuario"]) and !empty($_POST["password"])) {
    header("location:usuarios.php");
  }else{
    echo "$error";
}
}

?>
