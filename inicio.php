<?php
 include_once("include/header.php");
 include_once("include/dbConexion.php");
 //prueba de git

 ///////comienza busqueda por parametro

 if (isset($_POST['valor'])!= null) { 

 $valor = $_POST['valor'];
 $valor= "%".$valor."%";
        
$dbc = conexion();

$query = "SELECT `evento`.*, `tipoevento`.`NombreTipoEvento`, `participante`.*
          FROM `evento` 
         INNER JOIN `tipoevento` ON `evento`.`IdTipoEvento` = `tipoevento`.`IdTipoEvento`, `participante` 
         WHERE RfcParticipante LIKE '$valor' or NombreParticipante LIKE '$valor'
        ORDER BY NombreEvento;";

$result = mysqli_query ($dbc, $query);

    if ($result) { 
    
    //Si no son muchos registros pueden obtenerse todos los registros en un solo paso:
    $registros = mysqli_fetch_all($result, MYSQLI_ASSOC);    
    }
}else{

///hasta aqui inserte

 $sql = 'SELECT `evento`.*, `tipoevento`.*, inscripcionevento.*, participante.* 
 FROM `evento` 
 INNER JOIN `tipoevento` 
 ON `evento`.`IdTipoEvento` = `tipoevento`.`IdTipoEvento` 
 INNER JOIN `inscripcionevento` 
 ON `inscripcionevento`.`idEvento` = `evento`.`IdEvento` 
 INNER JOIN `participante` 
 ON `inscripcionevento`.`RfcParticipante` = `participante`.`RfcParticipante`';

//  $sql = 'SELECT `evento`.*, `inscripcionevento`.*, `participante`.*
//         FROM `evento` 
// 	LEFT JOIN `inscripcionevento` ON `inscripcionevento`.`idEvento` = `evento`.`IdEvento` 
// 	LEFT JOIN `participante` ON `inscripcionevento`.`RfcParticipante` = `participante`.`RfcParticipante`;';
 $registros = getDatos($sql);

}
?>
<div class="container">
        <div class="row">
                <h3 style="text-align:center">REGISTRO DE EVENTOS</h3>
        </div>
	<br>
        <div class="row">
                <a href="NuevoEvento.php" class="btn btn-info">Nuevo Evento</a>
	</div>
	<br>

        <div class="row">
                <a href="NuevoParticipante.php" class="btn btn-info">Nuevo Participante</a>
        </div>
	<br>
        <div class="row">
                <a href="consulta.php" class="btn btn-info">Consulta por Nombre de Evento</a>
	</div>
	<br>
        <!-- Comienza la vista -->
        <script type="text/javascript" src="js/jquery-3.4.0.js"></script>
        <script type="text/javascript">
   
            $(document).ready(function() {
            $('#envia').click(function(){
                var selected = '';    
                $('#form1 input[type=checkbox]').each(function(){
                    if (this.checked) {
                        selected += $(this).val()+',';
                    }
                }); 
                location.href=this.href+'?keys='+selected;return false;
                 // return selected;
            });         
        });    
    
    </script>
<div class="container mt-5 mb-5">
  <div class="row justify-content-center">
        <form class="form-inline my-2 my-lg-0" action="<?php $_SERVER['PHP_SELF']; ?>" method="POST">
                <input class="form-control mr-sm-2" type="buscar" name="valor" size="30" maxlength="500" aria-label="Buscar">
                <button class="btn btn-info my-2 my-sm-0" type="submit" value="1" name="enviar">Buscar</button>
         </form>
  </div>
<br>
<!-- </div> -->
  
<form action="codigoqr.php" method="POST" id="form1">
        <div class="row">
          <table class="table table-hover table-responsive">
             <thead class="thead-dark">
              <tr>
                <!-- <th>Id</th> -->
                <th>RFC</th>
                <th>Nombre</th>
                <th>Email</th>
                <th>Evento</th>
                <th>Tipo</th>
                <th>Profesor</th>
                <th>Editar</th>
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
                <td>
                    <input type="checkbox" id="ids" name="seleccionados[]" value="<?= $evento['RfcParticipante'].','.$evento['IdEvento']; ?>"/>
                </td>
                <td><input type="checkbox" name="enviados[]" value="<?= $evento['RfcParticipante']; ?>"></td>
                <!-- <td><a href="enviar.php?id=<?= $evento['RfcParticipante']; ?>&correo=<?= $evento['EmailParticipante']; ?>"><span class="fa fa-envelope"></span></a></td> -->
                <td><a href="#" data-href="eliminar.php?id=<?= $evento['RfcParticipante']; ?>" data-toggle="modal" data-target="#confirm-delete"><span class="fa fa-trash"></span></a></td>
                </tr>           
        <?php } ?>
             </tbody>
           </table>
			<!--	<input type="submit" name="borrar" value="Eliminar Registros" onclick="reload()" class="btn btn-danger col-md-offset-10"/>-->
        <input type="submit" value="Generar QR y PDF" class="btn btn-primary">


        
        <!-- <a href="enviar.php?keys=+scrt_var" class="btn btn-info">Enviar correo</a> -->
        <a href="enviar.php" class="btn btn-info" id="envia">Enviar Correo</a>


 </div>
</form>
 

        <?php
        if(isset($_POST['borrar']))
                {
                        if(empty($_POST['eliminar']))
                        {
                                echo '<h1>No se ha seleccionado ningun registro.</h1>';
                        }
                }
        ?>
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

</script>
<!-- <script>
     $('#confirm-delete').on('show.bs.modal', function(e) {
        $(this).find('.btn-ok').attr('href', $(e.relatedTarget).data('href'));

        $('.debug-url').html('Delete URL: <strong>' + $(this).find('.btn-ok').attr('href') + '</strong>');
      });
</script> -->





