<?php
        $mysqli = new mysqli('localhost', 'root', 'B0n1f0n/', 'EVENTOS');

        if($mysqli->connect_error){

                die('Error en la conexion' . $mysqli->connect_error);
        }
?>

