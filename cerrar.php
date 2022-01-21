<?php

session_start();
$misession=$_SESSION['email'];

if ($misession == null || $misession = '') {
    header("location:login.php");
}

    	session_destroy();
		echo "<script> alert('hola se inserto 1'); </script>";
    	header("location:login.php");
		echo "Se cerró sesión correctamente";

?>
