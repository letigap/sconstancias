<?php

function isNullLogin($usuario, $password){
	if(sterln(trim($usuario)) < 1 || strlen(trim($password)) <1)
	{
		return true;
	}
	else
	{
		return false;
	}
}

function login($usuario, $password)
{
	global $mysqli;
	$stmt = $mysqli->prepare("SELECT id, id_tipo, password FROM usuarios WHERE usuario = ? || correo = ? LIMIT 1");
	$stmt->bind_param("ss", $usuario,  $usuario);
	$stmt->execute();
	$stmt->store_result();
	$rows = $stmt->num_rows;

	if($rows > 0){
		if(isActivo($usuario)){
		$stmt->bind_result(id, $id_tipo, $password);
		$stmt->fetch();

		$validaPasswd = password_verify($password, $password);
		
		if($validaPasswd){
			lastSession($id);
			$_SESSION['id_usuario'] = $id;
			$_SESSION['tipo_usuario'] = $id_tipo;

			header("Location: inicio.php");
			} else{
			$errors = "La contrase&ntilde;a es incorrecta";
		}
		} else {
		$errors = 'El usuario no esta activo';
	}
	} else {
	$errors = "El nombre del usuario no existe";
}
return $errors;
}


	function lastSession($id)
	{
	global $mysqli;
	$stmt = $mysqli->prepare("UPDATE usuarios SET last_session=NOW(), token_password='', password_request=1 WHERE id = ?");
	$stmt->bind_param('s', $id);
	$stmt->execute();
	$stmt->close();
	}
	


function isActivo($usuario)
{
	global $mysqli;

	
	$stmt = $mysqli->prepare("SELECT activacion FROM usuarios WHERE usuario = ? || correo = ? LIMIT 1");
	$stmt->bind_param("ss", $usuario,  $usuario);
	$stmt->execute();
	$stmt->bind_result($activacion);
	$rows = fetch();

	if ($activacion == 1)
	{
		return true;
	}
	else
	{
		return false;
	}

}



?>
