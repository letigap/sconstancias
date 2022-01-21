<?php
require ('conexion.php');
	
	$query = "SELECT id_evento, nombre_evento FROM evento ORDER BY nombre_evento";
	$resultado=$mysqli->query($query);
?>
 
<html lang="es">
<head>
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link href="css/bootstrap.min.css" rel="stylesheet">
	<link href="css/bootstrap-theme.css" rel="stylesheet">
	<script src="js/jquery-3.1.1.min.js"></script>
	<script src="js/bootstrap.min.js"></script>

<script language="javascript">
		$(document).ready(function(){
			$("#id_evento").change(function () {

				$('#id_evento').find('option').remove().end().append('<option value="whatever"></option>').val('whatever');
				
				$("#id_evento option:selected").each(function () {
					id_evento = $(this).val();
					$.post("includes/getEvento.php", { nombre_evento: nombre_evento }, function(data){
						$("#nombre_evento").html(data);
					});            
				});
			})
		});
</script>
</head>

<body>
	<div class="container">
		<div class="row">
			<h3 style="text-align:center">NUEVO REGISTRO</h3>
			
		</div>

		<form class="form-horizontal" method="POST" id="myform" action="guardar_usuario.php" autocomplete="off">

			<div class="form-group">
				<p align="center"><i>Escribe tu nombre de la forma que deseas que aparezca en la constancia de participacion.</i></p>
				<label for="nombre" class="col-sm-2 control-label">Nombre</label>
				<div class="col-sm-10">
					<input type="text" class="form-control" id="nombre" name="nombre" placeholder="Nombre" required>
				</div>
			</div>

			<div class="form-group">
				<label for="apellidop" class="col-sm-2 control-label">Apellido Paterno</label>
				<div class="col-sm-10">
					<input type="text" class="form-control" id="apellidop" name="apellidop" placeholder="Apellido Paterno" required>
				</div>
			</div>

			<div class="form-group">
				<label for="apellidom" class="col-sm-2 control-label">Apellido Materno</label>
				<div class="col-sm-10">
					<input type="text" class="form-control" id="apellidom" name="apellidom" placeholder="Apellido Materno" required>
				</div>
			</div>

			<div class="form-group">
				<label for="rfc" class="col-sm-2 control-label">RFC</label>
				<div class="col-sm-10">
					<input type="text" class="form-control" id="rfc" name="rfc" placeholder="RFC" required>
				</div>
			</div>

			<div class="form-group">
				<label for="correo" class="col-sm-2 control-label">Email</label>
				<div class="col-sm-10">
					<input type="email" class="form-control" id="correo" name="correo" placeholder="Email" required>
				</div>
			</div>

			<div class="form-group">
				<label for="fecha" class="col-sm-2 control-label">Fecha de inscripción</label>
				<div class="col-sm-10">
					<input type="date" class="form-control" id="fecha" name="fecha" placeholder="Fecha de inscripción">
				</div>
			</div>
			<div class="form-group">
                                        <label for="nombre_evento" class="col-sm-2 control-label">Selecciona  Evento:</label>
                                        <div class="col-sm-10">
                                                <select class="form-control" id="nombre_evento" name="nombre_evento">
						<option value="">Seleccionar Evento</option></label>
			                        <?php while($row = $resultado->fetch_assoc()) { ?>
                       			         <option value="<?php echo $row['nombre_evento']; ?>"><?php echo $row['nombre_evento']; ?></option>
                      				  <?php } ?>

                                                </select>
                                        </div>
                                </div>
		
		<br />
		


			<div class="form-group">
				<div class="col-sm-offset-2 col-sm-10">
                                                <button type="submit" class="btn btn-primary">Guardar</button>
                                        </div>
                                </div>
                        </form>
                </div>
	<script src="js/jquery-1.11.1.min.js"></script>
	<script src="js/jquery.validate.min.js"></script>
	<script src="js/additional-methods.min.js"></script>
<script>

/*Agregar funciones jquery validator*/


$.validator.addMethod("lettersonly", function(value, element){
	return this.optional(element) || /^[a-zA-ZñÑáéíóúÁÉÍÓÚäëïöüÄËÏÖÜ\s]+$/i.test(value);

}, "Solo letras");
$.validator.addMethod("RFC", function (value, element) {
    if (value !== '') {
        var patt = new RegExp("^[A-Z,Ñ,&]{3,4}[0-9]{2}[0-1][0-9][0-3][0-9][A-Z,0-9]?[A-Z,0-9]?[0-9,A-Z]?$");
        return patt.test(value);
    } else {
        return false;
    }
}, "Ingrese un RFC valido");
$( "#myform" ).validate({
  rules: {
    nombre: {
      lettersonly: true,
    },
     apellidop: {
	lettersonly: true
    },
     apellidom: {
	lettersonly: true
    },
     nombre_evento: {
	required: true,
     },
    rfc: {
      RFC: true
    }
  }
});

</script>
</body>
</html>

