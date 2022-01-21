<?php
	
	include_once("include/dbConexion.php");
 
	$id = $_GET['id'];
	$dbc = conexion();
	$sql = "DELETE FROM evento WHERE id = '$id'";
	$resultado = mysqli_query($dbc,$sql);
	// $resultado = $mysqli->query($sql);
?>
 	<body>
		<div class="container">
			<div class="row">
				<div class="row" style="text-align:center">
				<?php if($resultado) { ?>
				<h3>REGISTRO ELIMINADO</h3>
				<?php } else { ?>
				<h3>ERROR AL ELIMINAR</h3>
				<?php } ?>
				
				<a href="inicio.php" class="btn btn-primary">Regresar</a>
				
				</div>
			</div>
		</div>
	</body>

