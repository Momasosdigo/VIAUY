<?php 

class conexionRutas {

	//funcion mostrar Paradas
	function mostrarParadas(){
		require('conexionDB.php'); //conexion a base de datos

    $consulta = "SELECT * FROM parada";
		$resultado = mysqli_query($conexion, $consulta);
		$data = [];

		while ($mostrar = mysqli_fetch_assoc($resultado)) {
			$data[] = $mostrar;
		}

		$conexion->close();
		echo json_encode($data);
		}

	//funcion agregar ruta
	function registrarRutas($idRuta, $idOrigen, $idDestino, $precioTotal){

		require('conexionDB.php'); //conexion a base de datos

		$consulta = "SELECT idRecorrido FROM recorrido WHERE idRecorrido = '$idRuta'";
		$resultado = mysqli_query($conexion, $consulta);
		$filas = mysqli_num_rows($resultado);

		if($filas){
			$consulta = "SELECT idRecorrido FROM recorrido WHERE idRecorrido = '$idRuta' AND activo=1";
			$resultado = mysqli_query($conexion, $consulta);
			$filas = mysqli_num_rows($resultado);
			if($filas){
				$respuesta = "id de ruta ya existe";
				echo json_encode($respuesta);
				$conexion->close();
			}else{
				$modificar = "UPDATE recorrido SET activo=1 WHERE idRecorrido='$idRuta'";
				mysqli_query($conexion,$modificar);
				$data = "activado";
				echo json_encode($data);
				$conexion->close();
			}
		}else{
			$insertarRecorrido= "INSERT INTO recorrido(idRecorrido, precioTotal) VALUES ('$idRuta','$precioTotal')";
			mysqli_query($conexion,$insertarRecorrido);
			$insertarTiene1= "INSERT INTO tiene(idParadaTiene, idRecorridoTiene, tipo, numeroParada) VALUES ('$idOrigen','$idRuta','Origen','0')";
			mysqli_query($conexion,$insertarTiene1);
			$insertarTiene2= "INSERT INTO tiene(idParadaTiene, idRecorridoTiene, tipo, numeroParada) VALUES ('$idDestino','$idRuta','Destino','1')";
			mysqli_query($conexion,$insertarTiene2);
			$respuesta = "listo";
			echo json_encode($respuesta);
			$conexion->close();
		}
	}

	function registrarParadas($data){
		require('conexionDB.php'); //conexion a base de datos

		$arrayInsert = [];
		foreach ($data["datosGuardadosParadas"] as $key => $fila) {
			$arrayInsert[] = "('".$fila['id']."','".$data['idRuta']."','Medio','".$fila['numero']."')";
		}
		// Obtener el último número de parada del arreglo datosGuardadosParadas
    $paradaAD = end($data["datosGuardadosParadas"])["numero"];
		$nuevoNumero = $paradaAD + 1;

		$arrayInsert[] = "('".$data['destino']."','".$data['idRuta']."','Destino','".$nuevoNumero."')";
		$valoresInsertar = implode(',', $arrayInsert);
		$insertar = "INSERT INTO tiene(idParadaTiene, idRecorridoTiene, tipo, numeroParada) VALUES $valoresInsertar ON DUPLICATE KEY UPDATE  idParadaTiene = VALUES(idParadaTiene), idRecorridoTiene = VALUES(idRecorridoTiene), tipo = VALUES(tipo), numeroParada = VALUES(numeroParada)";
		mysqli_query($conexion,$insertar);
		
		$respuesta = "listo";
		echo json_encode($respuesta);
		$conexion->close();
	}


	function mostrarRutas(){
		require('conexionDB.php'); //conexion a base de datos

    $consulta = "SELECT r.idRecorrido, 
    p_origen.coordenadas AS coordenadas_origen, 
    p_destino.coordenadas AS coordenadas_destino, 
    r.precioTotal 
		FROM recorrido AS r
		JOIN tiene AS t_origen ON r.idRecorrido = t_origen.idRecorridoTiene
		JOIN parada AS p_origen ON t_origen.idParadaTiene = p_origen.idParada AND t_origen.tipo = 'origen'
		JOIN tiene AS t_destino ON r.idRecorrido = t_destino.idRecorridoTiene
		JOIN parada AS p_destino ON t_destino.idParadaTiene = p_destino.idParada AND t_destino.tipo = 'destino'
		WHERE r.activo = 1;";
		$resultado = mysqli_query($conexion, $consulta);
		$data = [];

		while ($mostrar = mysqli_fetch_assoc($resultado)) {
			$data[] = $mostrar;
		}

		$conexion->close();
		echo json_encode($data);
	}

//////////////////////////////////////////////////
//     funcion borrar rutas de manera logica    //
//////////////////////////////////////////////////
	public function borrarRutas($idRuta){

		require('conexionDB.php'); //conexion a base de datos

		//consulta si cedula esta en 'backoffice'
		$consulta = "SELECT * FROM recorrido WHERE idRecorrido='$idRuta'";
		$resultado=mysqli_query($conexion,$consulta);
		$filas=mysqli_num_rows($resultado);

		//si la cedula esta en 'backoffice' hace el update y lo muestra en pantalla
		if($filas) {
			$modificar = "UPDATE recorrido SET activo= 0 WHERE idRecorrido= '$idRuta'";
			mysqli_query($conexion,$modificar); //'mysqli_query' envia la consulta a la base de datos mediante la '$conexion (variable declarada en 'conexion/conexionDB.php')' y '$consulta'
			$data = "Ruta borrada";
			echo json_encode($data);
			$conexion->close(); //cierra la conexion a base de datos
		}
	}
}
?>