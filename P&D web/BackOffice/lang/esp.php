<?php
//Español lang

//seleccion idioma
$lang['banderaIdioma'] = "img/flags/esp.png";
$lang['lang-eng'] = 'English';
$lang['lang-esp'] = 'Español';

//barra lateral
$lang['bLInicio'] = 'Inicio';
$lang['bLRutas'] = 'Rutas';
$lang['bLCoches'] = 'Coches';
$lang['bLUsuarios'] = 'Usuarios';
$lang['bLLineas'] = 'Lineas';
$lang['bLHorarios'] = 'Horarios';
$lang['bLCerrarSesion'] = 'Cerrar sesion';

//inicio de sesion
$lang['iniUsuario'] = ' Usuario';
$lang['iniClave'] = ' Contraseña';
$lang['iniBoton'] = 'INGRESAR';
$lang['iniRestablecer'] = 'Restablecer contraseña';
$lang['iniIncorrecto'] = 'usuario o contraseña incorrecta';
$lang['iniError'] = 'Introduzca bien los datos';

//barra buscador
$lang['bBNuevo'] = ' Nuevo';
$lang['bBEditar'] = ' Editar';
$lang['bBBorrar'] = ' Borrar';
$lang['bBBuscar'] = ' Buscar';

//pagina usuarios
$lang['userTitulo'] = 'Administracion De Usuarios';
$lang['userCedula'] = 'Cedula';
$lang['userNombre'] = 'Nombre';
$lang['userApellido'] = 'Apellido';
$lang['userNUsuario'] = 'Nuevo Usuario';
$lang['userContraseña'] = 'Contraseña';
$lang['userAtras'] = 'Atras';
$lang['userGuardar'] = 'Guardar';
$lang['userEditarUser'] = 'Editar usuario';

//pagina rutas
$lang['rutasTitulo'] = 'Administracion De Rutas';
$lang['rutasOrigen'] = 'Origen';
$lang['rutasDestino'] = 'Destino';
$lang['rutasNRuta'] = 'Nueva Ruta';
$lang['rutasIngresar'] = 'Ingresar';
$lang['rutasHorarios'] = 'Horarios';
$lang['rutasParadas'] = 'Paradas';
$lang['rutasAtras'] = 'Atras';
$lang['rutasGuardar'] = 'Guardar';
$lang['rutasIHorario'] = 'Ingresar Horario';
$lang['rutasIParadas'] = 'Ingresar Paradas';
$lang['rutasNombre'] = 'Nombre';

//pagina coches
$lang['cochesTitulo'] = 'Administracion De Coches';
$lang['cochesCoche'] = 'Coche';
$lang['cochesMatricula'] = 'Matricula';
$lang['cochesModelo'] = 'Modelo';
$lang['cochesMarca'] = 'Marca';
$lang['cochesAsientos'] = 'Asientos';
$lang['cochesPisos'] = 'Pisos';
$lang['cochesICoche'] = 'Ingresar Coche';
$lang['cochesAtras'] = 'Atras';
$lang['cochesGuardar'] = 'Guardar';
$lang['cochesCreador'] = 'Creador';
$lang['userEditarCoche'] = 'Editar coche';

//pagina lineas
$lang['lineasTitulo'] = 'Administracion De Lineas';
$lang['lineasLinea'] = 'Linea';
$lang['lineasCoches'] = 'Coches';
$lang['lineasRutas'] = 'Rutas';
$lang['lineasNLinea'] = 'Nueva linea';
$lang['lineasNombre'] = 'Nombre';

//pagina horarios
$lang['horariosTitulo'] = 'Administracion De horarios';
$lang['horariosLinea'] = 'Linea';
$lang['horariosHora'] = 'Hora';
$lang['horariosDia'] = 'Dia';
$lang['horariosCoche'] = 'Coche';
$lang['horariosHorarios'] = 'Horario';

//respuestas para js
$lang['creadoConExito'] = 'Creado con exito';
$lang['usuarioExiste'] = 'El usuario ya existe';
$lang['datosMalIngresados'] = 'Datos mal ingresados';
$lang['modificadoConExito'] = 'Modificado con exito';
$lang['cedulaExiste'] = 'Cedula ya registrada';
$lang['usuarioBorrado'] = 'Usuario borrado';
$lang['cocheExiste'] = 'Coche ya registrado';
$lang['matriculaExiste'] = 'Matricula ya registrada';
$lang['cocheBorrado'] = 'Coche borrado';
?>

<script>
    const creadoConExito = "<?= $lang['creadoConExito']; ?>";
    const usuarioExiste = "<?= $lang['usuarioExiste']; ?>";
    const datosMalIngresados = "<?= $lang['datosMalIngresados']; ?>";
    const modificadoConExito = "<?= $lang['modificadoConExito']; ?>";
    const cedulaExiste = "<?= $lang['cedulaExiste']; ?>";
    const usuarioBorrado = "<?= $lang['usuarioBorrado']; ?>";
    const cocheExiste = "<?= $lang['cocheExiste']; ?>";
    const matriculaExiste = "<?= $lang['matriculaExiste']; ?>";
    const cocheBorrado = "<?= $lang['cocheBorrado']; ?>";
</script>