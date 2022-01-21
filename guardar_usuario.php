<?php

        require 'conexion.php';

        $nombre = $_POST['nombre'];
        $apellidop = $_POST['apellidop'];
        $apellidom = $_POST['apellidom'];
        $rfc = $_POST['rfc'];
        $correo = $_POST['correo'];
        $fecha = $_POST['fecha'];
        $nombre_evento = $_POST['nombre_evento'];

                if(isset($_POST['nombre'])){
                        $nombre = $_POST['nombre'];
                        $apellidop = $_POST['apellidop'];
                        $correo = $_POST['correo'];

                        $campos = array();

                        if($nombre == ""){
                                array_push($campos, "El campo nombre no puede estar vacio");
                        }
                }

	$consulta = "SELECT * FROM participantes WHERE rfc = '$rfc' and nombre_evento = '$nombre_evento';";
	if($buscardatos = $mysqli->query($consulta)){
	$datos = $buscardatos->fetch_array(MYSQLI_ASSOC);
	$buscardatos->free();
	printf("Existe al menos un registro igual al que desea realizar en el evento .'$nombre_evento.'");
	$mysqli->close();	
	exit;
	}else{
	

	$sql = "INSERT INTO participantes (nombre, apellidop, apellidom, rfc, correo, fecha, nombre_evento) VALUES ('$nombre','$apellidop', '$apellidom', '$rfc', '$correo', '$fecha', '$nombre_evento')";
        $resultado = $mysqli->query($sql);
}
?>

<html lang="es">
        <head>

                <meta name="viewport" content="width=device-width, initial-scale=1">
                <link href="css/bootstrap.min.css" rel="stylesheet">
                <link href="css/bootstrap-theme.css" rel="stylesheet">
                <script src="js/jquery-3.1.1.min.js"></script>
                <script src="js/bootstrap.min.js"></script>
        </head>

        <body>
                <div class="container">
                        <div class="row">
                                <div class="row" style="text-align:center">
                                        <?php if($resultado) { ?>
                                                <h3>REGISTRO GUARDADO</h3>
                                                <?php } else { ?>
                                                <h3>ERROR AL GUARDAR</h3>
                                        <?php } ?>

                                        <a href="http://www.depfe.unam.mx/eventos/" class="btn btn-primary">Regresar</a>

                                </div>
                        </div>
                </div>
        </body>
</html>

