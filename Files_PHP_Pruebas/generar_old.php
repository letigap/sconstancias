<?php
	require 'conexion.php';
	
	$id_participante = $_GET['id_participante'];
	$nombre = $_GET['nombre'];
	$apellidop = $_GET['apellidop'];
	$apellidom = $_GET['apellidom'];
	$rfc = $_GET['rfc'];
	$correo = $_GET['correo'];
	$nombre_evento = $_GET['nombre_evento'];
	$nombre_profesor = $_GET['nombre_profesor'];
	$fecha_inicio = $_GET['fecha_inicio'];
	$fecha_termino = $_GET['fecha_termino'];
	
	$sql = "SELECT * FROM v_part_event WHERE id_participante = '$id_participante'";
	$resultado = $mysqli->query($sql);
	$row = $resultado->fetch_array(MYSQLI_ASSOC);
	
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
				<h3 style="text-align:center">GENERAR CODIGO QR</h3>
			</div>
			
			<form class="form-horizontal" method="POST" action="codigoqr.php" autocomplete="off">
				<div class="form-group">
					<label for="nombre" class="col-sm-2 control-label">Nombre</label>
					<div class="col-sm-10">
						<input type="text" class="form-control" id="nombre" name="nombre" placeholder="Nombre" value="<?php echo $row['nombre']; ?>">
					</div>
				</div>
				
				<div class="form-group">
					<label for="apellidop" class="col-sm-2 control-label">Apellido Paterno</label>
					<div class="col-sm-10">
						<input type="text" class="form-control" id="apellidop" name="apellidop" placeholder="Apellido Paterno" value="<?php echo $row['apellidop']; ?>">
					</div>
				</div>

				<div class="form-group">
					<label for="apellidom" class="col-sm-2 control-label">Apellido Materno</label>
					<div class="col-sm-10">
						<input type="text" class="form-control" id="apellidom" name="apellidom" placeholder="Apellido Materno" value="<?php echo $row['apellidom']; ?>">
					</div>
				</div>

				<input type="hidden" id="id_participante" name="id_participante" value="<?php echo $row['id_participante']; ?>" />
				
				<div class="form-group">
					<label for="rfc" class="col-sm-2 control-label">RFC</label>
					<div class="col-sm-10">
						<input type="rfc" class="form-control" id="rfc" name="rfc" placeholder="RFC" value="<?php echo $row['rfc']; ?>">
					</div>
				</div>
				
				<div class="form-group">
					<label for="correo" class="col-sm-2 control-label">Dirección de Correo</label>
					<div class="col-sm-10">
						<input type="email" class="form-control" id="correo" name="correo" placeholder="Email" value="<?php echo $row['correo']; ?>" >
					</div>
				</div>

				<div class="form-group">
					<label for="nombre_evento" class="col-sm-2 control-label">Nombre del Evento</label>
					<div class="col-sm-10">
						<input type="tel" class="form-control" id="nombre_evento" name="nombre_evento" placeholder="Nombre del evento" value="<?php echo $row['nombre_evento']; ?>" >
					</div>
				</div>
				
				<div class="form-group">
					<label for="nombre_profesor" class="col-sm-2 control-label">Profesor</label>
					<div class="col-sm-10">
						<input type="tel" class="form-control" id="nombre_profesor" name="nombre_profesor" placeholder="Nombre del Profesor" value="<?php echo $row['nombre_profesor']; ?>" >
					</div>
				</div>

				<div class="form-group">
					<label for="fecha_inicio" class="col-sm-2 control-label">Fecha de Inicio</label>
					<div class="col-sm-10">
						<input type="tel" class="form-control" id="fecha_inicio" name="fecha_inicio" placeholder="Fecha de Inicio" value="<?php echo $row['fecha_nicio']; ?>" >
					</div>
				</div>

				<div class="form-group">
					<label for="fecha_termino" class="col-sm-2 control-label">Fecha de Termino</label>
					<div class="col-sm-10">
						<input type="tel" class="form-control" id="fecha_termino" name="fecha_termino" placeholder="Fecha de Termino" value="<?php echo $row['fecha_termino']; ?>" >
					</div>
				</div>

				<div class="form-group">
					<label for="codigo_qr" class="col-sm-2 control-label">Elige nivel QR</label>
					<div class="col-sm-10">
						<select class="form-control" id="niv" name="niv">
							<option value="L" <?php if($row['niv']=='L') echo 'selected'; ?>>BAJA CALIDAD</option>
							<option value="M" <?php if($row['niv']=='M') echo 'selected'; ?>>MEDIANA CALIDAD</option>
							<option value="Q" <?php if($row['niv']=='Q') echo 'selected'; ?>>BUENA CALIDAD</option>
							<option value="H" <?php if($row['niv']=='H') echo 'selected'; ?>>ALTA CALIDAD</option>
						</select>
					</div>
				</div>
				
				<div class="form-group">
					<label for="size" class="col-sm-2 control-label">Tamaño QR</label>
					<div class="col-sm-10">
						<select class="form-control" id="size" name="size">
							<option value="5" <?php if($row['size']=='5') echo 'selected'; ?>>5 </option>
							<option value="10" <?php if($row['size']=='10') echo 'selected'; ?>>10</option>
							<option value="15" <?php if($row['size']=='15') echo 'selected'; ?>>15 </option>
							<option value="20" <?php if($row['size']=='20') echo 'selected'; ?>>20</option>
						</select>
					</div>
				</div>
				
				<div class="form-group">
					<div class="col-sm-offset-2 col-sm-10">
						<a href="index.php" class="btn btn-default">Regresar</a>
						<button type="submit" class="btn btn-primary">Generar</button>

					</div>
				</div>
			</form>
		</div>
	</body>

</html>
