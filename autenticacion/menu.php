<?php 
include ("seguridad.php");
?>
<html>
<head>
	<title>Bienvenido a la aplicación!</title>
</head>

<body>
<h1>Bienvenido <i><?php echo $_SESSION["usuario"]?></i> a la aplicación!</h1>
<h2>Si estás aquí es que te has autenticado</h2>
<br>
<hr>
<br>
<a href="aplicacion.php">Opción 1</a>
<br>
<a href="otra.php">Opción 2</a>
<br>
<br>
<hr>
<br>
<br>
<a href="salir.php">Salir</a>
</body>
</html>


