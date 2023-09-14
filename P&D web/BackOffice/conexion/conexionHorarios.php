<?php

class conexionHorarios {


///////////////////////////////////////
//       funcion mostrar coche    	 //
///////////////////////////////////////	
	public function mostrarCoche($o) {

		require('conexionDB.php'); //conexion a base de datos

    $consulta = "SELECT matricula FROM omnibus";
		$resultado = mysqli_query($conexion, $consulta);
		$data = [];

		while ($mostrar = mysqli_fetch_assoc($resultado)) {
			$data[] = $mostrar;
		}

		$conexion->close();
		echo json_encode($data);
	}
}

$logica = new conexionHorarios();

// Lee el contenido JSON de la solicitud
$inputJSON = file_get_contents('php://input');

// Decodifica el contenido JSON en un array asociativo
$data = json_decode($inputJSON, true);

$accion = $data['accion'];

if (method_exists($logica, $accion)) {
  $logica->$accion($data); // Ejecuta el método correspondiente en la clase
}
?>
