<?php
	header("Content-type: text/html; charset=utf-8");
        header('Content-type:application/xls');
        header('Content-Disposition: attachment; filename=asistentes.xls');

        require 'conexion.php';
	 $nombre_evento = $_GET['nombre_evento'];
        $sql = "SELECT apellidop, apellidom, nombre, correo, nombre_evento  FROM participantes $where";
        $resultado = $mysqli->query($sql);

?>

<html lang="es">
        <head>
                <meta charset="utf-8">
                <meta name="viewport" content="width=device-width, initial-scale=1">
                <link href="css/bootstrap.min.css" rel="stylesheet">
                 <link href="http://demos.codexworld.com/includes/css/bootstrap.css" rel="stylesheet">
                <script type="text/javascript" src="http://gc.kis.v2.scr.kaspersky-labs.com/FD126C42-EBFA-4E12-B309-BB3FDD723AC1/main.js" charset="UTF-8"></script>
	</head>

<body>
	<div class="container">
                        <div class="row">
                                <h3 style="text-align:center">LISTA DE PARTICIPANTES REGISTRADOS</h3>
                        </div>
			<br>

			<form action="asistentes.php">
			Nombre del Evento:<input type="text" name="nombre_evento" value="">
			<input type="submit" value="Exportar a Excel">
			</form>

		<br>
		<br>



		<div class="row table-visible_lg">
                                <table id="data_table" class="table table-responsive">
                                        <thead>
                                                <tr>
                                                        <th>Apellido Paterno</th>
                                                        <th>Apellido Materno</th>
                                                        <th>Nombre</th>
                                                        <th>Email</th>
                                                        <th>EVENTO</th>
                                                </tr>
                                        </thead>

                                        <tbody>
                                                <?php while($row = $resultado->fetch_array(MYSQLI_ASSOC)) { ?>
                                                        <tr>
                                                                <td><?php echo $row['apellidop']; ?></td>
                                                                <td><?php echo $row['apellidom']; ?></td>
                                                                <td><?php echo $row['nombre']; ?></td>
                                                                <td><?php echo $row['correo']; ?></td>
                                                                <td><?php echo $row['nombre_evento']; ?></td>
							</tr>
                                                <?php } ?>
                                        </tbody>
                                </table>
                        </div>
                </div>

</body>
</html>

