<?php
include_once("include/dbConexion.php");
include_once("include/header.php");

$registros=array();
$dbc = conexion();
if (isset($_POST['IdEvento']) && !empty($_POST['IdEvento'])) {         
$id = $_REQUEST['IdEvento'];

$sql="SELECT CONCAT(participante.NombreParticipante,' ', participante.ApellidopParticipante,' ', participante.ApellidomParticipante) AS NOMBRE, participante.RfcParticipante, participante.EmailParticipante, `inscripcionevento`.IdEvento 
FROM `participante` 
LEFT JOIN `inscripcionevento` 
ON `inscripcionevento`.`RfcParticipante` = `participante`.`RfcParticipante` WHERE IdEvento=$id;";
 $registros = getDatos($sql);
}

$sql ="SELECT e.*, t.NombreTipoEvento FROM evento e,TipoEvento t WHERE e.IdTipoevento = t.IdTipoEvento;";
$resultado = mysqli_query($dbc,$sql);
?>

 <div class="container">
        <div class="row">
            <h3 style="text-align:center">LISTA DE PARTICIPANTES REGISTRADOS POR EVENTO</h3>
	        <br>		
            <h4 style="text-align:center">Selecciona el Evento para obtener la lista de participantes</h4>
        </div><br><br>

 <form class="form-horizontal" method="POST" id="myform" action="consulta.php" autocomplete="off">
 
<div class="col-sm-10">
        <label for="IdEvento" class="col-sm-6 control-label">Selecciona Evento:</label>
        <div class="col-sm-10">
             <select class="form-control" id="IdEvento" name="IdEvento">
                <option value="">Seleccionar Evento</option></label>
               <?php while($row = $resultado->fetch_assoc()) { ?>
                <option value="<?php echo $row['IdEvento']; ?>"><?php echo $row['NombreTipoEvento'].': '.$row['NombreEvento']; ?></option>
               <?php } ?>
             </select>
        </div>
</div>

<script type="text/javascript">
        //document.getElementById('descarga').style.display = "none";
        $('listar').on('click', function(){
            $('descarga').removeAttr('disabled');
        })
    function mostrar(){
    document.getElementById('descarga').style.display = "block";
    }
</script>

<div class="row">
          <table class="table table-hover table-responsive">
             <thead class="thead-dark">
              <tr>
                <!-- <th>Id</th> -->
                <th>RFC</th>
                <th>Nombre</th>
                <th>Email</th>
                <th>Evento</th>
              </tr>
            </thead>
            <tbody>
            <?php
        foreach ($registros as $evento) { 
            $eventoSel=$evento['IdEvento'];
        ?>  
                <tr>
                <td><?= $evento['RfcParticipante'] ?></td>
                <td><?= $evento['NOMBRE'] ?></td>
                <td><?= $evento['EmailParticipante']; ?></td>
                <td><?= $evento['IdEvento']; ?></td>
                </tr>
                
        <?php } ?>

             </tbody>
           </table>
       </div>
<div class="form-group">
        <div class="col-sm-offset-2 col-sm-10">
                <a href="inicio.php" class="btn btn-default">Regresar</a>
                <button type="submit" class="btn btn-primary" id="listar">Listado de asistentes</button>
                 <a href="reporte_evento.php?id=<?= $eventoSel; ?>" class="btn btn-secondary" id="descarga" Disabled>Listado en formato xls</a>
                
        </div>
</div>
</form>

</div>
