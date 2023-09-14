<?php
///////////////////////////////////////////
//  manejar los datos enviados desde js  //
///////////////////////////////////////////

// Lee el contenido JSON de la solicitud
$inputJSON = file_get_contents('php://input');

// Decodifica el contenido JSON en un array asociativo
$data = json_decode($inputJSON, true);

$accion = $data['accion'];

$accion($data);


function login($data) {
  include('../conexion/conexionDB.php');
  session_start();
    if (!empty($data["usuario"]) and !empty($data["password"])) {
      $usuario=$data["usuario"];
      $contraseña=$data["password"];
      //comprobar si es usuario admin
      $consulta = "SELECT * FROM usuario WHERE idUsuario='$usuario' AND contraseña=SHA2('$contraseña',256)";
      $resultado=mysqli_query($conexion,$consulta);
      $filas=mysqli_num_rows($resultado);
      $consulta2 = "SELECT * FROM administrador WHERE idUsuarioAdmi='$usuario'";
      $resultado2=mysqli_query($conexion,$consulta2);
      $filas2=mysqli_num_rows($resultado2);
      if($filas and $filas2){
        $_SESSION["userAdmin"]=$usuario;
        $_SESSION["user"]=$usuario;
        $data = "usuario encontrado";
				echo json_encode($data);
      }else{
        //comprobar si es usuario comun
        $consulta = "SELECT * FROM usuario WHERE idUsuario='$usuario' AND contraseña=SHA2('$contraseña',256)";
        $resultado=mysqli_query($conexion,$consulta);
        $filas=mysqli_num_rows($resultado);
        $consulta2 = "SELECT * FROM backoffice WHERE idUsuarioBack='$usuario'";
        $resultado2=mysqli_query($conexion,$consulta2);
        $filas2=mysqli_num_rows($resultado2);
        if($filas and $filas2){
          $_SESSION["userComun"]=$usuario;
          $_SESSION["user"]=$usuario;
          $data = "usuario encontrado 2";
				  echo json_encode($data);
        }else{
          $data = "usuario o contraseña incorrecta";
          echo json_encode($data);
        }
      }
  } 
}
?>