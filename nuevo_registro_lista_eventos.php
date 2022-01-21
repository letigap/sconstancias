<?php
require ('conexion.php');
	
	$query = "SELECT * from v_event_tipo;";
	$resultado=$mysqli->query($query);
?>

<!DOCTYPE html>
<html lang="es-MX">
<head>
  <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=2, user-scalable=yes" />
  <meta charset="UTF-8" />
  <title>Posgrado de la Facultad de Economía-UNAM</title>
  <link rel="stylesheet" href="../css/reset.css">
  <link rel="stylesheet" href="../css/style-depfe-rwd.css">
  <link rel="stylesheet" href="../css/rwdgrid.css">
  <link rel="icon" type="image/png" sizes="16x16" href="../img-design/favicon-16x16.png">
  <script type="text/javascript" src="../js/jquery-3.2.1.js"></script>
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
<body class="bg-header">
<div class="mainwrapper">
  <header id="header_00">  
    <img src="../img-design/header_unam-depfe.svg" alt="Posgrado de la Facultad de Economía de la Universidad Nacional Aut&oacute;noma de M&eacute;xico" width="456" height="113" usemap="#Map" class="escala_header_unam-depfe">
    <map name="Map">
      <area shape="rect" coords="25,21,90,85" href="https://www.unam.mx/" target="_blank" title="UNAM">
      <area shape="rect" coords="117,19,168,84" href="http://www.economia.unam.mx/" target="_blank" title="Facultad de Economía">
    </map>
    <img src="../img-design/header_unam-depfe_small.svg" width="210" height="46" class="posicion_header_small" >   
    <div class="clear"></div>
  </header>
  <!-- end #header_00 -->
  
  <div class="clear"></div> 
   <!-- #Feature -->    
  <section id="feature">
    <div class="titulo-descripcion">
      <div class="depthpath">
        <ol>
          <li><a href="../.">Inicio</a></li>
        </ol>
      </div>    
      <h1>Registro</h1>
    </div>
  <div class="clear"></div>
  </section>
  <div class="main">
		<form class="form-style" method="POST" id="myform" action="guardar_usuario.php" autocomplete="off" >
          <fieldset>      
            <legend><em>Escribe tu nombre de la forma que deseas que aparezca en la constancia de participacion.</em></legend>        
            <div class="row">
              <div class="col-25">			
				<label for="nombre">Nombre</label>
              </div>
		      <div class="col-75">
				<input type="text" id="nombre" name="nombre" placeholder="Nombre" required>
			  </div>
            </div>
            <div class="row">
              <div class="col-25">
                <label for="apellidop"> Apellido Paterno</label>
              </div>
		      <div class="col-75">
				<input type="text" id="apellidop" name="apellidop" placeholder="Apellido Paterno" required>
		      </div>
            </div>
            <div class="row">
              <div class="col-25">
			    <label for="apellidom">Apellido Materno</label>
              </div>
              <div class="col-75">
                <input type="text" id="apellidom" name="apellidom" placeholder="Apellido Materno" required>
			  </div>
			</div>
			<div class="row">
              <div class="col-25">
                <label for="rfc">RFC</label>
              </div>
			  <div class="col-75">
			    <input type="text" id="rfc" name="rfc" placeholder="RFC" required>
			   </div>
			</div>
			<div class="row">
              <div class="col-25">
				<label for="correo" >Email</label>
              </div>
              <div class="col-75">
				<input type="email" id="correo" name="correo" placeholder="Email" required>
			  </div>
			</div>
            <div class="row">
              <div class="col-25">
                <label for="fecha">Fecha de inscripción</label>
              </div>
			  <div class="col-75">
			    <input type="date" id="fecha" name="fecha" placeholder="Fecha de inscripción">
			  </div>
			</div>
			<div class="row">
              <div class="col-25">
                <label for="nombre_evento">Selecciona  Evento:</label>
              </div>
              <div class="col-75">
                <select id="nombre_evento" name="nombre_evento">
				  <option value="">Seleccionar Evento</option></label>
			        <?php while($row = $resultado->fetch_assoc()) { ?>
                  <option value="<?php echo $row['nombre_evento']; ?>"><?php echo $row['tipo_evento'].': '.$row['nombre_evento']; ?></option>
                    <?php } ?>

                </select>
              </div>
            </div>
            <span class="espacio"></span>
            <div class="row">
              <div class="col-25"></div>
              <div class="col-75">
                <button class="boton" type="submit">Guardar</button>
              </div>
            </div>
          </fieldset>  
        </form>
  </div><!-- end .main -->
  <div class="pleca-footer"></div>
  
  <footer class="footer-gris"> 
    <div class="grid-12">
      <h3>Contacto</h3>  
    </div>   
    <span class="espacio clear"></span>
    <div class="grid-8">
      <h3>Informes y atenci&oacute;n</h3>
    </div>
    <div class="grid-4">
      <h3>Acerca de la p&aacute;gina</h3>
      <p>&Uacute;ltima modificaci&oacute;n: <!-- #BeginDate format:En2a -->20-Jun-2019 1:03 PM<!-- #EndDate --></p>
    </div>
    <span class="espacio clear"></span> 
    <div class="creditos">
      <small>Universidad Nacional Aut&oacute;noma de M&eacute;xico - Todos los derechos reservados &copy; 2003-2018.<br>
      Esta p&aacute;gina puede  ser reproducida con fines no lucrativos, siempre y cuando no se mutile, se cite  la fuente completa y su direcci&oacute;n electr&oacute;nica. De otra forma requiere permiso  previo por escrito de la instituci&oacute;n.</small>
    </div>
    <span class="clear"></span>
  </footer>
  
</div><!--FIN mainwrapper -->                
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

