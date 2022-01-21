<?php
	require __DIR__ . '/vendor/autoload.php'; 
  include_once ("include/dbConexion.php");

   $sql = "SELECT `evento`.*, `tipoevento`.`NombreTipoEvento`, `participante`.*
         FROM `evento` 
         INNER JOIN `tipoevento` ON `evento`.`IdTipoEvento` = `tipoevento`.`IdTipoEvento`,`participante`
         WHERE RfcParticipante = '$valor'";
                 echo "<script> alert('".$valor."'); </script>";
    $result = mysqli_query ($dbc, $query);
    $row = $result->fetch_array(MYSQLI_ASSOC);
  //$row = getDatos($sql); Para poder usarla es necesario recorrer el arreglo con un foreach ya que la funcion regresa un arreglo

      print_r($row);
        echo "<script> alert('Consulta'); </script>";

$fecha = date("Y");

  echo "<script> alert('".$fecha."'); </script>";

//$mpdf = new \Mpdf\Mpdf(['orientation' => 'Letter-L']);
$mpdf = new \Mpdf\Mpdf(['mode' => 'utf-8', 'format' => 'Letter-L']);
//$mpdf->SetProtection(array('copy','print'), 'Acc3$0par', 'Acc3$0a11');
$mpdf -> SetTitle('Constancia de Evento');


$mpdf -> WriteHTML('<head> <link rel="stylesheet" href="css/diseno-depfe-unam.css"> </head>');

$mpdf -> WriteHTML('<body style="border:0; background: transparent url(images/firma-unica-constancia-depfe_color.jpg) no-repeat fixed left top; background-color:#fff; background-size: 280mm 215mm;">');

$mpdf-> WriteHTML('

  <p class="nombre">'.$row['NombreParticipante'].' '.$row['ApellidopParticipante'].' '.$row['ApellidomParticipante'].'</p>
  <p class="center">Por su asistencia al III '.$row['NombreTipoEvento'].':</p>
  <p class="evento">"'.$row['NombreEvento'].'"</p>
<!--  <p align="center">A cargo de: '.$row['ProfesorEvento'].''.$row['ProcedenciaProfeEvento'].'.</p>-->

		
  <p align="center">Que se llevó a cabo los días '.$row['FechaEvento'].'.</p>
  <p align="center">Ciudad Universitaria, Ciudad de México.</p>
  <div class="posicion-num-certificado">
    <p class="right small">Número de certificado:</p>
    <p class="right small">UNAM-DEPFE-'.$fecha.'-'.$row['RfcParticipante'].'</p>
  </div>
  <div class="posicion-qr">
    <img class="qr" src="CONST_2021/'.$row['IdEvento'].''.$row['RfcParticipante'].'.png" >
  </div>
	
');
$mpdf -> WriteHTML('</body>');
$mpdf -> Output('Const-'.$row['IdEvento'].'-'.$row['RfcParticipante'].'.pdf', 'F');
$mpdf->Output('CONST_2021/Const-'.$row['IdEvento'].''.$row['RfcParticipante'].'.pdf', \Mpdf\Output\Destination::FILE);
// $mpdf->Output('CONST_2021/Const-'.$row['IdEvento'].'-'.$row['RfcParticipante'].'.pdf', \Mpdf\Output\Destination::FILE);

?>

