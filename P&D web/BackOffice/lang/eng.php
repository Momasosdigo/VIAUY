<?php
//Ingles lang

//seleccion idioma
$lang['banderaIdioma'] = "img/flags/eng.png";
$lang['lang-eng'] = 'English';
$lang['lang-esp'] = 'Español';

//barra lateral
$lang['bLInicio'] = 'Home';
$lang['bLRutas'] = 'Routes';
$lang['bLCoches'] = 'Cars';
$lang['bLUsuarios'] = 'Users';
$lang['bLLineas'] = 'Lines';
$lang['bLHorarios'] = 'Timetables';
$lang['bLCerrarSesion'] = 'Logout';

//inicio de sesion
$lang['iniUsuario'] = ' User';
$lang['iniClave'] = ' Password';
$lang['iniBoton'] = 'LOGIN';
$lang['iniRestablecer'] = 'Reset password';
$lang['iniIncorrecto'] = 'incorrect username or password';
$lang['iniError'] = 'Enter the data well';

//barra buscador
$lang['bBNuevo'] = ' New';
$lang['bBEditar'] = ' Edit';
$lang['bBBorrar'] = ' Delete';
$lang['bBBuscar'] = ' Search';

//pagina usuarios
$lang['userTitulo'] = 'Users Administration';
$lang['userCedula'] = 'Document';
$lang['userNombre'] = 'First name';
$lang['userApellido'] = 'Last name';
$lang['userPermisos'] = 'Permits';
$lang['userNUsuario'] = 'New User';
$lang['userContraseña'] = 'Password';
$lang['userAtras'] = 'Back';
$lang['userGuardar'] = 'Save';
$lang['userEditarUser'] = 'User edit';

//pagina rutas
$lang['rutasTitulo'] = 'Route Administration';
$lang['rutasOrigen'] = 'Origin';
$lang['rutasDestino'] = 'Destination';
$lang['rutasNRuta'] = 'New Route';
$lang['rutasIngresar'] = 'Enter';
$lang['rutasHorarios'] = 'Timetables';
$lang['rutasParadas'] = 'Stops';
$lang['rutasAtras'] = 'Back';
$lang['rutasGuardar'] = 'Save';
$lang['rutasIHorario'] = 'Enter Timetable';
$lang['rutasIParadas'] = 'Enter Stops';
$lang['rutasNombre'] = 'Name';

//pagina coches
$lang['cochesTitulo'] = 'Car Administration';
$lang['cochesCoche'] = 'Car';
$lang['cochesMatricula'] = 'registration';
$lang['cochesModelo'] = 'Model';
$lang['cochesMarca'] = 'Brand';
$lang['cochesAsientos'] = 'Seats';
$lang['cochesPisos'] = 'Flats';
$lang['cochesICoche'] = 'Enter Car';
$lang['cochesAtras'] = 'Back';
$lang['cochesGuardar'] = 'Save';
$lang['cochesCreador'] = 'Creator';
$lang['userEditarCoche'] = 'Car edit';

//pagina lineas
$lang['lineasTitulo'] = 'Line Administration';
$lang['lineasLinea'] = 'Line';
$lang['lineasCoches'] = 'Cars';
$lang['lineasRutas'] = 'Routes';
$lang['lineasNLinea'] = 'New line';
$lang['lineasNombre'] = 'Name';

//pagina horarios
$lang['horariosTitulo'] = 'Timetable Administration';
$lang['horariosLinea'] = 'Line';
$lang['horariosHora'] = 'Hour';
$lang['horariosDia'] = 'Day';
$lang['horariosCoche'] = 'Car';
$lang['horariosHorarios'] = 'Timetable';

//respuestas para js
$lang['creadoConExito'] = 'Successfully created';
$lang['usuarioExiste'] = 'User already exists';
$lang['datosMalIngresados'] = 'Incorrect data entry';
$lang['modificadoConExito'] = 'Successfully modified';
$lang['cedulaExiste'] = 'Document already registered';
$lang['usuarioBorrado'] = 'User deleted';
$lang['cocheExiste'] = 'Car already registered';
$lang['matriculaExiste'] = 'Registration already registered';
$lang['cocheBorrado'] = 'Car deleted';
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