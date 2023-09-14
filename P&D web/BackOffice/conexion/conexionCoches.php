<?php 

class conexionCoches {

	public function __construct() {
	}

	/////////////////////////////////////
	//     funcion registrar coches		 //
	/////////////////////////////////////	
	public function registrarCoches($matricula, $modelo, $marca, $coche, $asientos, $pisos){
		session_start();
		include('conexionDB.php'); //conexion a base de datos

		$user = $_SESSION["user"]; //guarda el nombre id (cedula) de la persona que agrega el coche
		
		//comprueba cantidad de caracteres de los datos recibidos
		$numCMatricula = strlen($matricula);//'strlen' se usa para tomar la longitud de los caracteres
		$numCModelo = strlen($modelo);
		$numCMarca = strlen($marca);
		$numCCoche = strlen($coche);
		$numCAsientos = strlen($asientos);
		$numCPisos = strlen($pisos);

		//crea un insert para cada asiento 
		$insertAsiento = array();
		for ($numAsiento = 1; $numAsiento <= $asientos; $numAsiento++) {
				$insertAsiento[] = "('$numAsiento','activo', '$matricula')";
		}
		$valoresInsertar = implode(',', $insertAsiento);


		//comprueba que la cantidad de caracteres sea la correcta
		if ($numCMatricula >= 4  and $numCCoche >= 1 and $numCAsientos >= 1 and $numCAsientos <= 2 and $numCPisos == 1){

			//consulta a la base de datos si existe la matricula en la tabla 'omnibus' estando activa
			$consulta = "SELECT * FROM omnibus WHERE matricula='$matricula' AND activo=1";
			$resultado=mysqli_query($conexion,$consulta);
			$filas=mysqli_num_rows($resultado);

			//consulta a la base de datos si existe la matricula en tabla 'omnibus' estando inactiva
			$consulta2 = "SELECT * FROM omnibus WHERE matricula='$matricula' AND activo=0";
			$resultado2=mysqli_query($conexion,$consulta2);
			$filas2=mysqli_num_rows($resultado2);


			//si existe la matricula y esta activa muestra en pantalla que el coche ya esta registrado
			if($filas){
				$data = "Coche ya registrado";
				echo json_encode($data);
				$conexion->close(); //cierra la conexion a base de datos
			}

			//si existe la matricula de manera incativa en tabla 'omnibus' hace un update para ponerla activa y modificarle los demas datos
			elseif($filas2){
				$modificar = "UPDATE omnibus SET numOmnibus='$coche',cantidadAsientos='$asientos',marca='$marca',modelo='$modelo',pisos='$pisos',activo=1 WHERE matricula='$matricula'";
				$modificar2 = "UPDATE admi SET idUsuarioAdmi='$user' WHERE matriculaAdmi='$matricula'";
				$modificarAsiento = "UPDATE asiento SET estado='inactivo' WHERE matriculaAsiento='$matricula'";
				$insertar = "INSERT INTO asiento(idAsiento, estado, matriculaAsiento) VALUES $valoresInsertar ON DUPLICATE KEY UPDATE estado = VALUES(estado), matriculaAsiento = VALUES(matriculaAsiento)";
				mysqli_query($conexion,$modificarAsiento);
				mysqli_query($conexion,$modificar);
				mysqli_query($conexion,$modificar2);
				mysqli_query($conexion,$insertar);
				$data = "Creado con exito";
				echo json_encode($data);
				$conexion->close();
			}

			//si la matricula no existe en la base de datos inserta los datos en la tabla 'omnibus' y 'admi' y nuestra en pantalla que fue creado con exito
			else{
				$insertar = "INSERT INTO omnibus(matricula, numOmnibus, cantidadAsientos, marca, modelo, pisos) VALUES ('$matricula','$coche','$asientos','$marca','$modelo','$pisos')";
				mysqli_query($conexion,$insertar);
				$insertar2 = "INSERT INTO admi(idUsuarioAdmi, matriculaAdmi) VALUES ('$user','$matricula')";
				mysqli_query($conexion,$insertar2);
				$insertar3 = "INSERT INTO asiento(idAsiento, estado, matriculaAsiento) VALUES $valoresInsertar";
				mysqli_query($conexion,$insertar3);
				$data = "Creado con exito 2";
				echo json_encode($data);
				$conexion->close(); //cierra la conexion a base de datos
				}
		//si los datos no son los correctos lo muestra en pantalla
		}else{
			$data = "Datos mal ingresados";
			echo json_encode($data);
		}
	}


	///////////////////////////////////////
	//      funcion mostrar Coches			 //
	///////////////////////////////////////	
	public function mostrarCoches() {
		include('conexionDB.php'); // conexión a la base de datos

		$consulta = "SELECT omnibus.matricula, omnibus.numOmnibus, omnibus.cantidadAsientos, omnibus.marca, omnibus.modelo, omnibus.pisos, admi.idUsuarioAdmi FROM omnibus JOIN admi ON omnibus.matricula = admi.matriculaAdmi WHERE omnibus.activo = 1;";
		$resultado = mysqli_query($conexion, $consulta);
		$data = [];

		while ($mostrar = mysqli_fetch_assoc($resultado)) {
			$data[] = $mostrar;
		}

		$conexion->close();
		echo json_encode($data);
	}


	//////////////////////////////////////
	//     funcion modificar coches		  //
	//////////////////////////////////////
	public function modificarCoches($matriculaAnterior, $matricula, $modelo, $marca, $coche, $asientos, $pisos){
		session_start();
		include('conexionDB.php'); //conexion a base de datos
		
		$user = $_SESSION["user"]; //guarda el nombre id (cedula) de la persona que agrega el coche

		//comprueba cantidad de caracteres de los datos recibidos
		$numCMatricula = strlen($matricula);//'strlen' se usa para tomar la longitud de los caracteres
		$numCModelo = strlen($modelo);
		$numCMarca = strlen($marca);
		$numCCoche = strlen($coche);
		$numCAsientos = strlen($asientos);
		$numCPisos = strlen($pisos);

		//crea un insert para cada asiento 
		$insertAsiento = array();
		for ($numAsiento = 1; $numAsiento <= $asientos; $numAsiento++) {
				$insertAsiento[] = "('$numAsiento','activo', '$matricula')";
		}
		$valoresInsertar = implode(',', $insertAsiento);


		//comprueba que la cantidad de caracteres sea la correcta
		if ($numCMatricula >= 4  and $numCCoche >= 1 and $numCAsientos >= 1 and $numCAsientos <= 2 and $numCPisos == 1){
			
				//comprueba si la matricula que va a cambiar es igual a la nueva
				if ($matriculaAnterior == $matricula) {
					
					//si las matriculas son iguales hace un update con los demas datos en la tabla 'omnibus', 'asiento' y 'admi'
					$modificar = "UPDATE omnibus SET numOmnibus='$coche',cantidadAsientos='$asientos',marca='$marca',modelo='$modelo',pisos='$pisos' WHERE matricula='$matricula'";
					$modificar2 = "UPDATE admi SET idUsuarioAdmi='$user' WHERE matriculaAdmi='$matricula'";
					$modificarAsiento = "UPDATE asiento SET estado='inactivo' WHERE matriculaAsiento='$matricula'";
					$insertar = "INSERT INTO asiento(idAsiento, estado, matriculaAsiento) VALUES $valoresInsertar ON DUPLICATE KEY UPDATE estado = VALUES(estado), matriculaAsiento = VALUES(matriculaAsiento)";
					mysqli_query($conexion,$modificarAsiento);
					mysqli_query($conexion,$modificar);
					mysqli_query($conexion,$modificar2);
					mysqli_query($conexion,$insertar);
					$data = "modificado con exito";
					echo json_encode($data);
					$conexion->close(); //cierra la conexion a base de datos
				}
				else{

					//consulta si matricula nueva no esta con otro omnibus en 'omnibus'
					$consulta = "SELECT * FROM omnibus WHERE matricula='$matricula'";
					$resultado=mysqli_query($conexion,$consulta);
					$filas=mysqli_num_rows($resultado);

					//si la matricula esta ya esta registrada lo muestra en pantalla
					if($filas){
						$data = "matricula ya registrada";
						echo json_encode($data);
						$conexion->close();
					}
					else{

						//si la matricula no se encuentra en otro omnibus se manda el update y se muestra en pantalla que se modifico con exito 
						$modificar = "UPDATE omnibus SET matricula='$matricula',numOmnibus='$coche',cantidadAsientos='$asientos',marca='$marca',modelo='$modelo',pisos='$pisos' WHERE matricula='$matriculaAnterior'";
						$modificar2 = "UPDATE admi SET idUsuarioAdmi='$user' WHERE matriculaAdmi='$matricula'";
						$modificarAsiento = "UPDATE asiento SET estado='inactivo' WHERE matriculaAsiento='$matricula'";
						$insertar = "INSERT INTO asiento(idAsiento, estado, matriculaAsiento) VALUES $valoresInsertar ON DUPLICATE KEY UPDATE estado = VALUES(estado), matriculaAsiento = VALUES(matriculaAsiento)";
						mysqli_query($conexion,$modificarAsiento);
						mysqli_query($conexion,$modificar);
						mysqli_query($conexion,$modificar2);
						mysqli_query($conexion,$insertar);
						$data = "modificado con exito 2";
						echo json_encode($data);
						$conexion->close();
					}
				}
		}
		//si los datos no son los correctos lo muestra en pantalla
		else{
			$data = "Datos mal ingresados";
			echo json_encode($data);
		}
	}


	////////////////////////////////////////////////
	//   funcion borrar coches de manera logica   //
	////////////////////////////////////////////////
	public function borrarCoches($matricula){

		include('conexionDB.php'); //conexion a base de datos

		//consulta si matricula esta en 'omnibus'
		$consulta = "SELECT * FROM omnibus WHERE matricula='$matricula'";
		$resultado=mysqli_query($conexion,$consulta);
		$filas=mysqli_num_rows($resultado);

		//si la matricula esta en 'omnibus' hace el update y lo muestra en pantalla
		if($filas) {
			$modificar = "UPDATE omnibus SET activo= 0 WHERE matricula= '$matricula'";
			$modificarAsiento = "UPDATE asiento SET estado='inactivo' WHERE matriculaAsiento='$matricula'";
			mysqli_query($conexion,$modificarAsiento);
			mysqli_query($conexion,$modificar); //'mysqli_query' envia la consulta a la base de datos mediante la '$conexion (variable declarada en 'conexionDB.php')' y '$consulta'
			$data = "Coche borrado";
			echo json_encode($data);
			$conexion->close(); //cierra la conexion a base de datos
		}
	}
}
?>