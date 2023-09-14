<?php
class logica{
  /////////////////////////////////////
  //       funciones usuarios        //
  /////////////////////////////////////
  public function mostrarUsuarios($data) {
    require '../conexion/conexionUsuarios.php';

    $mosUsuario = new conexionUsuarios();
    echo $mosUsuario->mostrarUsuarios();
  }

  function registrarUsuarios($data) {
    require '../conexion/conexionUsuarios.php';
    
    $regUsuario = new conexionUsuarios(); //crea un objeto de la clase 'conexionUsuario' dentro del archivo 'conexionUsuarios.php'
    $nombre=$data["nombre"]; //variable que guarda el input con 'name = 'nombre'' que se envio con el formulario
    $apellido=$data["apellido"];
    $cedula=$data["cedula"];
    $clave=$data["clave"];

    //utiliza el objeto creado anteriormente para enviar los datos a la funcion 'registrarUsuarios' dentro de la clase usuario
    echo $regUsuario->registrarUsuarios($nombre, $apellido, $cedula, $clave);
  }

  function modificarUsuarios($data) {
    require '../conexion/conexionUsuarios.php';

    $modUsuario = new conexionUsuarios();//crea un objeto de la clase 'conexionUsuario' dentro del archivo 'conexionUsuarios.php'
    $cedulaAnterior=$data["cedulaAnterior"];//variable que guarda el input con 'name = 'cedulaAnterior'' que se envio con el formulario
    $nombre=$data["nombre"];
    $apellido=$data["apellido"];
    $cedula=$data["cedula"];
    $clave=$data["clave"];

    //utiliza el objeto creado anteriormente para enviar los datos a la funcion 'modificarUsuarios' dentro de la clase usuario
    echo $modUsuario->modificarUsuarios($nombre, $apellido, $cedulaAnterior, $cedula, $clave);
  }


  function borrarUsuarios($data) {
    require '../conexion/conexionUsuarios.php';
  
    $borrarUsuario = new conexionUsuarios();//crea un objeto de la clase 'conexionUsuario' dentro del archivo 'conexionUsuarios.php'
    $cedula=$data["claveBorrar"];//variable que guarda el input con 'name = 'cedulaBorrar'' que se envio con el formulario

    //utiliza el objeto creado anteriormente para enviar los datos a la funcion 'borrarUsuarios' dentro de la clase usuario
    echo $borrarUsuario->borrarUsuarios($cedula);
  
  }
  //fin funciones usuarios


  /////////////////////////////////////
  //       funciones coches          //
  /////////////////////////////////////
  function mostrarCoches($data) {
    require '../conexion/conexionCoches.php';

    $mosCoches = new conexionCoches();
    echo $mosCoches->mostrarCoches();
  }

  function registrarCoches($data) {
    require '../conexion/conexionCoches.php';

    $regCoches = new conexionCoches(); //crea un objeto de la clase 'conexionCoches' dentro del archivo 'conexionCoches.php'
    $matricula=$data["matricula"]; //variable que guarda el input con 'name = 'matricula'' que se envio con el formulario
    $modelo=$data["modelo"];
    $marca=$data["marca"];
    $coche=$data["coche"];
    $asientos=$data["asientos"];
    $pisos=$data["pisos"];

    //utiliza el objeto creado anteriormente para enviar los datos a la funcion 'registrarCoches' dentro de la clase coches
    echo $regCoches->registrarCoches($matricula, $modelo, $marca, $coche, $asientos, $pisos);
    
  }

  function modificarCoches($data) {
    require '../conexion/conexionCoches.php';

    $modCoches = new conexionCoches(); //crea un objeto de la clase 'coches' dentro del archivo 'conexionCoches.php'
    $matriculaAnterior=$data["matriculaAnterior"]; //variable que guarda el input con 'name = 'matriculaAnterior'' que se envio con el formulario
    $matricula=$data["matricula"];
    $modelo=$data["modelo"];
    $marca=$data["marca"];
    $coche=$data["coche"];
    $asientos=$data["asientos"];
    $pisos=$data["pisos"];

    //utiliza el objeto creado anteriormente para enviar los datos a la funcion 'modistrarCoches' dentro de la clase coches
    echo $modCoches->modificarCoches($matriculaAnterior, $matricula, $modelo, $marca, $coche, $asientos, $pisos);
  }

  function borrarCoches($data) {
    require '../conexion/conexionCoches.php';

    $borrarCoches = new conexionCoches();//crea un objeto de la clase 'Coches' dentro del archivo 'conexionCoches.php'
    $matricula=$data["matriculaBorrar"];//variable que guarda el input con 'name = 'matriculaBorrar'' que se envio con el formulario

    //utiliza el objeto creado anteriormente para enviar los datos a la funcion 'borrarCoches' dentro de la clase Coches
    echo $borrarCoches->borrarCoches($matricula);
  }
  //fin funciones Coches

  /////////////////////////////////////
  //        funciones rutas          //
  /////////////////////////////////////
  function mostrarRutas($data) {
    require '../conexion/conexionRutas.php';

    $mosRutas = new conexionRutas();
    echo $mosRutas->mostrarRutas();
  }
  

  function registrarRutas($data) {
    require '../conexion/conexionRutas.php';

    $regRutas = new conexionRutas(); //crea un objeto de la clase 'conexionRutas' dentro del archivo 'conexionRutas.php'
    $idRuta=$data["idRuta"];
    $idOrigen=$data["idOrigen"];
    $idDestino=$data["idDestino"];
    $precioTotal=$data["precioTotal"];

    //utiliza el objeto creado anteriormente para enviar los datos a la funcion 'registrarRutas' dentro de la clase Rutas
    echo $regRutas->registrarRutas($idRuta, $idOrigen, $idDestino, $precioTotal);
  }

  function mostrarParadas($data){
    require '../conexion/conexionRutas.php';

    $mosParadas = new conexionRutas();
    echo $mosParadas->mostrarParadas();
  }

  function registrarParadas($data){
    require '../conexion/conexionRutas.php';

    $regisParadas = new conexionRutas();
    echo $regisParadas->registrarParadas($data);
  }

  function borrarRutas($data) {
    require '../conexion/conexionRutas.php';

    $borrarRutas = new conexionRutas();//crea un objeto de la clase 'Coches' dentro del archivo 'conexionCoches.php'
    $idRuta=$data["claveBorrar"];//variable que guarda el input con 'name = 'matriculaBorrar'' que se envio con el formulario

    //utiliza el objeto creado anteriormente para enviar los datos a la funcion 'borrarCoches' dentro de la clase Coches
    echo $borrarRutas->borrarRutas($idRuta);
  }
}

///////////////////////////////////////////
//  manejar los datos enviados desde js  //
///////////////////////////////////////////
$logica = new logica();

// Lee el contenido JSON de la solicitud
$inputJSON = file_get_contents('php://input');

// Decodifica el contenido JSON en un array asociativo
$data = json_decode($inputJSON, true);

$accion = $data['accion'];

if (method_exists($logica, $accion)) {
  $logica->$accion($data); // Ejecuta el método correspondiente en la clase
}




?>