<?php
	require 'conexion.php';
	
	$where = "";
	
	if(!empty($_POST))
	{
		$valor = $_POST['campo'];
		if(!empty($valor)){
			$where = "WHERE nombre LIKE '%$valor'";
		}
	}
	$sql = "SELECT * FROM v_part_event $where";
	$resultado = $mysqli->query($sql);
	
?>

<html lang="es">
        <head>
                <meta name="viewport" content="width=device-width, initial-scale=1">
                <link href="css/bootstrap.min.css" rel="stylesheet">
                <link href="css/bootstrap-theme.css" rel="stylesheet">
//		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
                <script src="js/jquery-3.1.1.min.js"></script>
                <script src="js/bootstrap.min.js"></script>
        </head>

<body>

                <div class="container">
                        <div class="row">
                                <h3 style="text-align:center">REGISTRO DE EVENTOS</h3>
                        </div>
			<br>
                        <div class="row">
                                <a href="nuevo_evento.php" class="btn btn-primary">Nuevo Evento</a>
			</div>
			<br>

                        <div class="row">
                                <a href="nuevo_participante.php" class="btn btn-primary">Nuevo Participante</a>
			</div>
			<br>
			 <div class="row">
                                <form action="<?php $_SERVER['PHP_SELF']; ?>" method="POST">
                                        <b>Nombre: </b><input type="text" id="campo" name="campo" />
                                        <input type="submit" id="enviar" name="enviar" value="Buscar" class="btn btn-info" />
                                </form>
                        </div>

                        <br>

			<br>


                        <div class="row table-responsive">
                                <table class="table table-striped">
                                        <thead>
                                                <tr>
                                                        <th>ID</th>
                                                        <th>Nombre</th>
                                                        <th>Apellido Paterno</th>
                                                        <th>Apellido Materno</th>
                                                        <th>RFC</th>
                                                        <th>Email</th>
                                                        <th>Evento</th>
                                                        <th>Profesor</th>
                                                        <th>Editar</th>
                                                        <th>Generar QR</th>
                                                        <th>Constancia PDF</th>
                                                        <th>Eliminar</th>
                                                </tr>
                                        </thead>

                                        <tbody>
                                                <?php while($row = $resultado->fetch_array(MYSQLI_ASSOC)) { ?>
                                                        <tr>
                                                                <td><?php echo $row['id']; ?></td>
                                                                <td><?php echo $row['nombre']; ?></td>
                                                                <td><?php echo $row['apellidop']; ?></td>
                                                                <td><?php echo $row['apellidom']; ?></td>
                                                                <td><?php echo $row['rfc']; ?></td>
                                                                <td><?php echo $row['correo']; ?></td>
                                                                <td><?php echo $row['nombre_evento']; ?></td>
                                                                <td><?php echo $row['nombre_profesor']; ?></td>
								<td><a href="modificar.php?id=<?php echo $row['id']; ?>"><span class="glyphicon glyphicon-pencil"></span></a></td>
                                                                <td><a href="generar.php?id=<?php echo $row['id']; ?>"><span class="glyphicon glyphicon-qrcode"></span></a></td>
                                                                <td><a href="constancia.php?id=<?php echo $row['id']; ?>"><span class="glyphicon glyphicon-file"></span></a></td>
                                                                <td><a href="#" data-href="eliminar.php?id=<?php echo $row['id']; ?>" data-toggle="modal" data-target="#confirm-delete"><span class="glyphicon glyphicon-trash"></span></a></td>
                                                        </tr>
                                                <?php } ?>
                                        </tbody>
                                </table>
                        </div>
                </div>

                <!-- Modal -->
                <div class="modal fade" id="confirm-delete" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                                <div class="modal-content">

                                        <div class="modal-header">
                                                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                                <h4 class="modal-title" id="myModalLabel">Eliminar Registro</h4>
                                        </div>

                                        <div class="modal-body">
                                                ¿Desea eliminar este registro?
                                        </div>

                                        <div class="modal-footer">
                                                <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                                                <a class="btn btn-danger btn-ok">Delete</a>
                                        </div>
                                </div>
                        </div>
                </div>

<script>
     $('#confirm-delete').on('show.bs.modal', function(e) {
        $(this).find('.btn-ok').attr('href', $(e.relatedTarget).data('href'));

        $('.debug-url').html('Delete URL: <strong>' + $(this).find('.btn-ok').attr('href') + '</strong>');
      });
</script>

</body>
</html>


