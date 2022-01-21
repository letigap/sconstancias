<?php
//vemos si el usuario y contraseña es válido
if ($_POST["usuario"]=="admin" && $_POST["contrasena"]=="Admit3$$"){
	//usuario y contraseña validos
	//defino una sesion y guardo datos
	session_start();
	$_SESSION["autorizado"]= TRUE; //esta variable actua como bandera para saber si el usuario se logueo
	$_SESSION["usuario"] = $_POST["usuario"];
	header ("Location: agregarParticipante.php");	
}else {
	//si no existe le mando otra vez a la portada
	header("Location: index.php?errorusuario=si");
}
?>