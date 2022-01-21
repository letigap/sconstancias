<?php
    //Inicio la session
    // session_start();

    // //COMPRUEBA QUE EL USUARIO ESTA AUTENTIFICADO
    // if (!$_SESSION['user_id']) {
    //         //si no existe, envío a la página de autentificación
    //         header("Location: login.php");
    //         exit();
    // }

   include("includes/mis_funciones.php");
   include("includes/funciones_db.php");
   include("includes/config.php");

$dbc = conectar_db();

$query = "
    SELECT id_evento, e.nombre_evento as nombre, t.nombre_tevento as tipo
    FROM evento e
    INNER JOIN tipo_evento t ON (e.id_tevento = t.id_tevento)
    ORDER BY nombre
";

$result = mysqli_query ($dbc, $query);
if ($result) { 

    $numRows = mysqli_affected_rows($dbc);

    if ($numRows) {
        
        $eventos = mysqli_fetch_all($result, MYSQLI_ASSOC);
    }

}
//PRESENTACION o VISTA HTML
include ("includes/encabezado.php");
?>
<div class="container">
    <h1>Eventos</h1>
    <div>
    <a href="nuevo_evento.php" class="btn btn-primary" role="button" aria-pressed="true">Agregar evento</a>
    </div>

    <table>
    <tr>
    <th>ID</th>
    <th>NOMBRE DE EVENTO</th>
    <th>TIPO DE EVENTO</th>
    </tr>

<?php
 foreach ($eventos as $nombre) {
     ?>
        <tr class="table-info">
        <td><?= $nombre['id_evento'] ?></td>
        <td><a class="alert-link" href="ver_evento.php?id=<?= $nombre['id_evento']?>"><?= $nombre['nombre'] ?></a></td>
        <td><?= $nombre['tipo'] ?></td>
        <td></td>
        <td><a href="obtener_evento.php?id=<?= $nombre['id_evento']?>" class="btn btn-primary" role="button" aria-pressed="true">Actualizar evento</a></td>
        <td><a data-toggle="modal"  href="eliminar.php?id=<?= $nombre['id_evento']?>" class="btn btn-primary" data-target="#confirm-delete">Eliminar evento</a></td>         
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
                                                <h4 class="modal-title" id="myModalLabel">¿Estas seguro de eliminar el evento?</h4>
                                                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                                
                                        </div>

                                        <div class="modal-body">
                                                <br>
                                                <p class="text-danger"><?= $nombre['nombre'] ?></p>
                                                
                                        </div>

                                        <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-dismiss="modal">NO</button>
                                                <a class="btn btn-danger btn-ok" href="eliminar.php?id=<?= $nombre['id_evento']?>">Borrar</a>
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


<?php
echo "<br/>Eventos encontrados: ";
echo $numRows;
echo "<br/><br/><br/><br/><br/><br/>";

include ("includes/pie.php");
?>




