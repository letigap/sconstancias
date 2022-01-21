<?php
include_once("include/dbConexion.php");
header('Content-type: application/vnd.ms-excel;charset=iso-8859-15');
header('Content-Disposition: attachment; filename=Lista_de_registro.xls');


$id = $_GET['id'];
// $datos = $_POST;
// print_r($datos);
$dbc = conexion();

$query="SELECT CONCAT(participante.NombreParticipante,' ', participante.ApellidopParticipante,' ', participante.ApellidomParticipante) AS NOMBRE, participante.RfcParticipante, participante.EmailParticipante, `inscripcionevento`.IdEvento 
FROM `participante` 
LEFT JOIN `inscripcionevento` 
ON `inscripcionevento`.`RfcParticipante` = `participante`.`RfcParticipante` WHERE IdEvento=$id;";
$resultado = mysqli_query ($dbc, $query);


?>

<div class="row table-visible_lg">
        <table id="data_table" class="table table-responsive">
                <thead>
                        <tr>
                        <th>NOMBRE</th>
                        <th>RFC</th>
                        <th>EMAIL</th>
                        <th>EVENTO</th>
                        </tr>
                </thead>
                <tbody>
                        <?php while($row = $resultado->fetch_array(MYSQLI_ASSOC)) { ?>
                        <tr>
                        <td><?php echo $row['NOMBRE']; ?></td>
                        <td><?php echo $row['RfcParticipante']; ?></td>
                        <td><?php echo $row['EmailParticipante']; ?></td>
                        <td><?php echo $row['IdEvento']; ?></td>
                        </tr>
                        <?php } ?>
                </tbody>
        </table>
</div>

