<?php
//Inicio la session
// session_start();

// //COMPRUEBA QUE EL USUARIO ESTA AUTENTIFICADO
//  if (!$_SESSION['email']) {
//          //si no existe, envío a la página de autentificación
//          header("Location: login.php");
//          exit();
//  } 
 include_once("include/header.php");
 include_once("include/dbConexion.php");
$dbc = conexion();
 ///////comienza busqueda por parametro
 $sql = "SELECT e.IdEvento, e.NombreEvento, e.ProfesorEvento, t.NombreTipoEvento, i.FechaInscripcion, p.* 
 FROM evento e INNER JOIN tipoevento t 
 ON e.IdTipoEvento = t.IdTipoEvento INNER JOIN inscripcionevento i 
 ON i.idEvento = `e`.`IdEvento` INNER JOIN participante p 
 ON i.RfcParticipante = p.RfcParticipante ORDER BY NombreEvento;";

 $registros = getDatos($sql);
 ///////
 if (isset($_POST['valor'])!= null) { 
        // echo "<script> alert('entrando'); </script>";
        $valor = $_POST['valor'];
        $valor= "%".$valor."%";
        if ($valor != null && $valor != "%%") { // if busquedas
                // echo "<script> alert('busqueda por like ".$valor."'); </script>";
                $query = "SELECT e.IdEvento, e.NombreEvento, e.ProfesorEvento, t.NombreTipoEvento, i.*, p.* 
                FROM evento e INNER JOIN tipoevento t 
                ON e.IdTipoEvento = t.IdTipoEvento INNER JOIN inscripcionevento i 
                ON i.idEvento = `e`.`IdEvento` INNER JOIN participante p 
                ON i.RfcParticipante = p.RfcParticipante 
                WHERE  NombreParticipante LIKE '$valor' OR NombreEvento LIKE 'valor';";
                $result = mysqli_query ($dbc, $query);

                 if ($result) { 
                        //Si no son muchos registros pueden obtenerse todos los registros en un solo paso:
                  $registros = mysqli_fetch_all($result, MYSQLI_ASSOC);    
                 }else{
                        echo "<script> alert('NO encontrado'); </script>";
                 }
        }
                 ///hasta aqui inserte
                 
 }
?>
<div class="container">
        <div class="row">
                <h3 style="text-align:center">REGISTRO DE EVENTOS</h3>
        </div>
	<br>
        <div class="row">
                <a href="consulta.php" class="btn btn-info">Consulta por Nombre de Evento</a>
	</div>
	<br>
        <!-- Comienza la vista -->
<div class="container mt-5 mb-5">
  <div class="row justify-content-center">
        <form class="form-inline my-2 my-lg-0" action="inicio.php" method="POST">
                <input class="form-control mr-sm-2" type="buscar" name="valor" size="30" maxlength="500" aria-label="Buscar">
                <button class="btn btn-info my-2 my-sm-0" type="submit" value="1" name="enviar">Buscar</button>
         </form>
  </div>
</div>
<form action="codigoqr.php" method="POST">
        <div class="row">
          <table class="table table-hover table-responsive">
             <thead class="thead-dark">
              <tr>
                <th>RFC</th>
                <th>Nombre</th>
                <th>Email</th>
                <th>Evento</th>
                <th>Tipo</th>
                <th>Profesor</th>
                <th>Editar<span class="fa fa-user"></th>
                <th><span class="fa fa-file-pdf-o"></th>
                <th><span class="fa fa-envelope-open"></span></th>
                <th>Eliminar</th>
              </tr>
            </thead>
            <tbody>
            <?php
        foreach ($registros as $evento) { 
        ?>	
                <tr>
                <!-- <td><?= $evento['IdParticipante'] ?></td> -->
                <td><?= $evento['RfcParticipante'] ?></td>
                <td><?= $evento['NombreParticipante'].' '.$evento['ApellidopParticipante'].' '.$evento['ApellidomParticipante']; ?></td>
                <td><?= $evento['EmailParticipante']; ?></td>
                <td><a href="ActualizarEvento.php?id=<?= $evento['IdEvento']; ?>"><?= $evento['NombreEvento']; ?></td>
                <td><?= $evento['NombreTipoEvento']; ?></td>
                <td><?= $evento['ProfesorEvento']; ?></td>
		<td><a href="ActualizarParticipante.php?id=<?= $evento['RfcParticipante'];?>"><span class="fa fa-pencil"></span></a></td>
                <td><input type="checkbox" name="seleccionados[]" value="<?= $evento['RfcParticipante']; ?>"/></td>
                <td><a href="enviar.php?id=<?= $evento['RfcParticipante']; ?>&correo=<?= $evento['EmailParticipante']; ?>&evento=<?= $evento['IdEvento']; ?>"><span class="fa fa-envelope"></span></a></td>
                <td><a data-toggle="modal"  href="eliminar.php?id=<?= $evento['IdEvento']?>" data-target="#confirm-delete"><span class="fa fa-trash"></span></a></td>         
                 </tr>
       <?php 
    }
    ?>
    </table>
   
	<?php
	if(isset($_POST['borrar']))
	{
	        if(empty($_POST['eliminar']))
		{
		echo '<h1>No se ha seleccionado ningun registro.</h1>';
		}
	}
	?>
        <!-- Modal -->
        <div class="modal fade" id="confirm-delete" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                <div class="modal-content">
                        <div class="modal-header">
                                <h4 class="modal-title" id="myModalLabel">¿Estas seguro de eliminar el participante?</h4>
                                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                        </div>

                        <div class="modal-body">
                        <p class="text-danger"><?= $evento['IdEvento'] ?></p>
                        </div>
                        <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">NO</button>
                                <a class="btn btn-danger btn-ok" href="eliminar.php?id=<?= $evento['IdEvento']?>">Borrar</a>
                        </div>
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
<div class="mb-4">
        <input type="submit" value="Generar QR y PDF" class="btn btn-primary">
</div>
</form>
</div>
<?php
include_once("include/footer.php");   
?>
    

