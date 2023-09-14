<?php 

class conexionUsuarios {

	public function __construct() {
	}
///////////////////////////////////////
//     funcion registrar Usuarios		 //
///////////////////////////////////////	
	public function registrarUsuarios($nombre, $apellido, $cedula, $clave){

		require('conexionDB.php'); //conexion a base de datos

		//comprueba cantidad de caracteres de los datos recibidos
		$numCNombre = strlen($nombre); //'strlen' se usa para tomar la longitud de los caracteres
		$numCApellido = strlen($apellido);
		$numCCedula = strlen($cedula);
		$numCClave = strlen($clave);

		//comprueba que la cantidad de caracteres sea la correcta
		if ($numCNombre >= 2 and $numCClave >= 8 and $numCApellido >= 2 and $numCCedula == 8){

				//consulta a la base de datos si existe la cedula en tabla 'usuario'
				$consulta = "SELECT * FROM usuario WHERE idUsuario='$cedula'"; 
				$resultado=mysqli_query($conexion,$consulta); //'mysqli_query' envia la consulta a la base de datos mediante la '$conexion (variable declarada en 'conexion/conexionDB.php')' y '$consulta'
				$filas=mysqli_num_rows($resultado); //'mysqli_num_rows' guarda los datos de la consulta anteriormente enviada

				//si existe la cedula en tabla 'usuario' pasa a otro condicional
				if($filas){

					//consulta a la base de datos si existe la cedula en tabla 'backoffice' estando activa
					$consulta = "SELECT * FROM backoffice WHERE idUsuarioBack='$cedula' AND activo=1";
					$resultado=mysqli_query($conexion,$consulta);
					$filas=mysqli_num_rows($resultado);

					//consulta a la base de datos si existe la cedula en tabla 'backoffice' estando inactiva
					$consulta2 = "SELECT * FROM backoffice WHERE idUsuarioBack='$cedula' AND activo=0";
					$resultado2=mysqli_query($conexion,$consulta2);
					$filas2=mysqli_num_rows($resultado2);

					//si existe la cedula de manera activa en tabla 'backoffice' muestra en pantalla que el usuario ya esta registrado
					if($filas){
						$data = "el usuario ya existe";
						echo json_encode($data);
						$conexion->close(); //cierra la conexion a base de datos
					}

					//si existe la cedula de manera incativa en tabla 'backoffice' hace un update para ponerla activa y modificarle los demas datos
					elseif($filas2){
						$modificar = "UPDATE usuario SET contraseña=SHA2('$clave',256) WHERE idUsuario='$cedula'";
						$modificar2 = "UPDATE backoffice SET nombreBack='$nombre',apellidoBack='$apellido',activo=1 WHERE idUsuarioBack='$cedula'";
						mysqli_query($conexion,$modificar);
						mysqli_query($conexion,$modificar2);
						$data = "Creado con exito";
						echo json_encode($data);
						$conexion->close();
					}

					//si no existe la cedula en tabla 'backoffice' inserta los datos en la tabla y mustra en pantalla que fue creado con exito
					else{
						$insertar = "INSERT INTO backoffice (idUsuarioBack, nombreBack, apellidoBack) VALUES ('$cedula','$nombre','$apellido')";
						mysqli_query($conexion,$insertar);
						$data = "Creado con exito 2";
						echo json_encode($data);
						$conexion->close();
					}
				
				//si la cedula no existe en la base de datos inserta los datos en la tabla 'usuario' y 'backoffice' y nuestra en pantalla que fue creado con exito
				}else{
					$insertar = "INSERT INTO usuario(idUsuario, contraseña) VALUES ('$cedula',SHA2('$clave',256))";
					mysqli_query($conexion,$insertar);
					$insertar2 = "INSERT INTO backoffice (idUsuarioBack, nombreBack, apellidoBack) VALUES ('$cedula','$nombre','$apellido')";
					 mysqli_query($conexion,$insertar2);
					$data = "Creado con exito 3";
					echo json_encode($data);
					$conexion->close();
				}

		//si los datos no son los correctos lo muestra en pantalla
		}else{
			$data = "Datos mal ingresados";
			echo json_encode($data);
		}
	}


///////////////////////////////////////
//      funcion mostrar Usuarios		 //
///////////////////////////////////////	
	public function mostrarUsuarios() {

		require('conexionDB.php'); //conexion a base de datos

		$consulta = "SELECT idUsuarioBack, nombreBack, apellidoBack FROM backoffice WHERE activo = 1";
		$resultado = mysqli_query($conexion, $consulta);
		$data = [];

		while ($mostrar = mysqli_fetch_assoc($resultado)) {
				$data[] = $mostrar;
		}

		$conexion->close();
		echo json_encode($data);
	}


///////////////////////////////////////
//     funcion modificar Usuarios		 //
///////////////////////////////////////
	public function modificarUsuarios($nombre, $apellido, $cedulaAnterior, $cedula, $clave){

		require('conexionDB.php'); //conexion a base de datos

		//comprueba cantidad de caracteres de los datos recibidos
		$numCNombre = strlen($nombre);//'strlen' se usa para tomar la longitud de los caracteres
		$numCApellido = strlen($apellido);
		$numCCedula = strlen($cedula);
		$numCClave = strlen($clave);

		//comprueba que la cantidad de caracteres sea la correcta
		if ($numCNombre >= 2 and $numCClave >= 8 and $numCApellido >= 2 and $numCCedula == 8){

				//comprueba si la cedula que va a cambiar es igual a la nueva
				if ($cedulaAnterior == $cedula) {

					//si las cedulas son iguales hace un update con los demas datos en la tabla 'usuario' y 'backoffice'
					$modificar = "UPDATE usuario SET contraseña=SHA2('$clave',256) WHERE idUsuario='$cedulaAnterior'";
					$modificar2 = "UPDATE backoffice SET nombreBack='$nombre',apellidoBack='$apellido' WHERE idUsuarioBack='$cedulaAnterior'";
					mysqli_query($conexion,$modificar); //'mysqli_query' envia la consulta a la base de datos mediante la '$conexion (variable declarada en 'conexion/conexionDB.php')' y '$consulta'
					mysqli_query($conexion,$modificar2);
					$data = "modificado con exito";
					echo json_encode($data);
					$conexion->close(); //cierra la conexion a base de datos
				}
				else{

					//consulta si la cedula nueva esta con otro usuario en 'backoffice'
					$consulta = "SELECT * FROM backoffice WHERE idUsuarioBack='$cedula'";
					$resultado=mysqli_query($conexion,$consulta);
					$filas=mysqli_num_rows($resultado);

					//si la cedula ya esta registrada lo muestra en pantalla
					if($filas){
						$data = "cedula ya registrada";
						echo json_encode($data);
						$conexion->close();
					}
					else{

						//si la cedula no se encuentra en otro usuario se manda el update y se muestra en pantalla que se modifico con exito 
						$modificar = "UPDATE usuario SET idUsuario='$cedula',contraseña=SHA2('$clave',256) WHERE idUsuario='$cedulaAnterior'";
						$modificar2 = "UPDATE backoffice SET nombreBack='$nombre',apellidoBack='$apellido' WHERE idUsuarioBack='$cedula'";
						mysqli_query($conexion,$modificar);
						mysqli_query($conexion,$modificar2);
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


//////////////////////////////////////////////////
//   funcion borrar Usuarios de manera logica   //
//////////////////////////////////////////////////
	public function borrarUsuarios($cedula){

		require('conexionDB.php'); //conexion a base de datos

		//consulta si cedula esta en 'backoffice'
		$consulta = "SELECT * FROM backoffice WHERE idUsuarioBack='$cedula'";
		$resultado=mysqli_query($conexion,$consulta);
		$filas=mysqli_num_rows($resultado);

		//si la cedula esta en 'backoffice' hace el update y lo muestra en pantalla
		if($filas) {
			$modificar = "UPDATE backoffice SET activo= 0 WHERE idUsuarioBack= '$cedula'";
			mysqli_query($conexion,$modificar); //'mysqli_query' envia la consulta a la base de datos mediante la '$conexion (variable declarada en 'conexion/conexionDB.php')' y '$consulta'
			$data = "Usuario borrado";
			echo json_encode($data);
			$conexion->close(); //cierra la conexion a base de datos
		}
	}
}
?>