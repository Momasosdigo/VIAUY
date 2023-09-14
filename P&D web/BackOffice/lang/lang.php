<?php 
if(isset($_GET['la'])){
	$_SESSION['la'] = $_GET['la'];
	header('Location:'.$_SERVER['PHP_SELF']);
	exit();
}
if(isset($_SESSION['la']))
{
switch($_SESSION['la']){
 	case "eng":
		require('lang/eng.php');		
	break;	
	case "esp":
		require('lang/esp.php');		
	break;	
	default: 
		require('lang/esp.php');		
	}
	
}else{
require('lang/esp.php');
}
?>