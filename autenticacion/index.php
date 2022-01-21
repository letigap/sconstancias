<?php
//Revisamos si existe una sesión activa
session_start();
if (isset($_SESSION["autorizado"]) && $_SESSION["autorizado"]){
	//Si existe direccionamos al usuario al menu principal
	header ("Location: menu.php");	
}
?>
<html>
<head>
	<title>Entrada</title>
    <link href="estilos.css" rel="stylesheet" type="text/css">
</head>
<body> 
<h1><br><br><br><br><br></h1>
<form action="control.php" method="POST">
<table border="0" align="center" width="255" cellpadding="4" cellspacing="0">
<tr>
    <td colspan="2" align="center" 
	<?php if (isset($_GET["errorusuario"]) && $_GET["errorusuario"]=="si"){?>
		bgcolor="red"><span style="color:ffffff"><b>Datos incorrectos</b></span>
	<?php }else{?>
		bgcolor="#cccccc">Introduzca su clave de acceso
	<?php }?></td>
</tr>
<tr>
	<td colspan = "2"><br></td>
</tr>
<tr>
    <td align="right">Cuenta de usuario:</td>
    <td><input type="Text" name="usuario" size="15" maxlength="50" class="input"></td>
</tr>
<tr>
    <td align="right">Contraseña:</td>
    <td><input type="password" name="contrasena" size="15" maxlength="50" class="input"></td>
</tr>
<tr>
    <td colspan="2" align="center"><br><br><input type="Submit" value="ENTRAR" class="input"></td>
</tr>
</table>
</form>

</body>
</html>
