<?php
//vemos si el usuario y contrase�a es v�ildo
if ($_POST["usuario"]=="admin" && $_POST["contrasena"]=="123456"){
	//usuario y contraseña validos
	//defino una sesion y guardo datos
	session_start();
	$_SESSION["autorizado"]= TRUE; //esta variable actua como bandera para saber si el usuario se logueo
	$_SESSION["usuario"] = $_POST["usuario"];
	header ("Location: menu.php");	
}else {
	//si no existe le mando otra vez a la portada
	header("Location: index.php?errorusuario=si");
}
?>