<?php
require_once __DIR__ . '/vendor/autoload.php';
require_once('conexion.php');
$id = $_GET['id'];
$fecha = date("Y");



$consulta = "SELECT * FROM v_const_event WHERE  id = '$id';";
if($buscardatos = $mysqli->query($consulta)){
        $datos = $buscardatos->fetch_array(MYSQLI_ASSOC);
        $buscardatos->free();
	}
$mpdf = new \Mpdf\Mpdf(['mode' => 'utf-8', 'format' => 'Letter-L']);
$mpdf -> WriteHTML('<body style="border:0; background: transparent url(images/firma-unica-constancia-depfe_color.jpg) no-repeat fixed left top; background-color:#fff; background-size: 280mm 215mm;">');

$mpdf -> WriteHTML('<head> <link rel="stylesheet" href="css/diseno-depfe-unam.css"> </head>');

$mpdf -> WriteHTML('<body style="border:0; background: transparent url(images/firma-unica-constancia-depfe_color.jpg) no-repeat fixed left top; background-color:#fff; background-size: 280mm 215mm;">');

$mpdf-> WriteHTML('

  <p class="nombre">'.$datos['nombre'].' '.$datos['apellidop'].' '.$datos['apellidom'].'</p>
  <p class="center">Por su asistencia '.$datos['elevento'].'</p>
  <p class="evento">"'.$datos['nombre_evento'].'"</p>

		
  <p align="center">'.$datos['fecha_inicio'].'.</p>
  <p align="center">Ciudad Universitaria, Ciudad de México.</p>
  <div class="posicion-num-certificado">
    <p class="right small">Número de certificado:</p>
    <p class="right small">UNAM-DEPFE-'.$fecha.'-'.$id.'</p>
  </div>
  <div class="posicion-qr">
    <img class="qr" src="2019/'.$id.''.$datos['rfc'].'.'.png.'" >
  </div>
	
');
 
$mpdf -> WriteHTML('</body>');
$mpdf -> Output('Const-'.$datos['id'].'.pdf', 'I');
$mpdf->Output();
exit;


//$mpdf = new \Mpdf\Mpdf(['orientation' => 'Letter-L']);
$mpdf = new \Mpdf\Mpdf(['mode' => 'utf-8', 'format' => 'Letter-L']);
//$mpdf->SetProtection(array('copy','print'), 'Acc3$0par', 'Acc3$0a11');
$mpdf -> SetTitle('Constancia de Evento');


$mpdf -> WriteHTML('<head> <link rel="stylesheet" href="css/diseno-depfe-unam.css"> </head>');

$mpdf -> WriteHTML('<body style="border:0; background: transparent url(images/firma-unica-constancia-depfe_color.jpg) no-repeat fixed left top; background-color:#fff; background-size: 280mm 215mm;">');
//$mpdf->SetWatermarkImage('images/bg-3-firmantes.jpg');
//$mpdf->showWatermarkImage = true;
//$mpdf->Image('images/bg-3-firmantes.jpg', 0, 0, 210, 297, 'jpg', '', true, false);

$mpdf-> WriteHTML('

  <p class="nombre">'.$datos['nombre'].' '.$datos['apellidop'].' '.$datos['apellidom'].'</p>
  <p class="center">Por su asistencia '.$datos['elevento'].'</p>
  <p class="evento">"'.$datos['nombre_evento'].'"</p>
  <p align="center">A cargo de '.$datos['nombre_profesor'].' '.$datos['procedencia'].'.</p>

		
  <p align="center">'.$datos['fecha_inicio'].'.</p>
  <p align="center">Ciudad Universitaria, Ciudad de México.</p>
  <div class="posicion-num-certificado">
    <p class="right small">Número de certificado:</p>
    <p class="right small">UNAM-DEPFE-'.$fecha.'-'.$id.'</p>
  </div>
  <div class="posicion-qr">
    <img class="qr" src="2019/'.$id.''.$datos['rfc'].'.'.png.'" >
  </div>
	
');
/*
$mpdf -> WriteHTML('
  		<h1 align="center">'.$datos['nombre'].' '.$datos['apellidop'].' '.$datos['apellidom'].'</h1>
  		  <p class="center">Por su participación en el '.$datos['tipo_evento'].'</p>
   		 <h2 class="center">"'.$datos['nombre_evento'].'"</h2>
');
$mpdf -> WriteHTML('<h2 style="text-align: center">DATOS DEL TUTOR</h2>');
$mpdf -> WriteHTML('
<table width="100%" align="center" cellpadding="3" cellspacing="1">
  <tbody>
    <tr>
      <td colspan="2" align="right">Profesor: </td>
      <td colspan="2" align="left"><strong>'.$datos['nombre_profesor'].'</strong></td>
      <td colspan="2" align="left"><strong>'.$datos['procedencia'].'</strong></td>
    </tr>
  </tbody>
</table>
<br>
');

$mpdf -> WriteHTML('
<table width="100%" align="center" cellpadding="3" cellspacing="1">
  <tbody>
    <tr>
      <td colspan="2" align="right">Periodo: </td>
      <td colspan="2" align="left"><strong>'.$datos['fecha_inicio'].' </strong></td>
    </tr>
  </tbody>
</table>
<br>


$mpdf -> WriteHTML('
<table width="100%" align="center" cellpadding="3" cellspacing="1">
  <tbody>
    <tr>
         <td colspan="2" align="right">
                <img src="https://placehold.it/150x80?text=FIRMA PROFESOR" class="img-responsive" style="width:50%" alt="Image">
        </td>
');
$mpdf -> WriteHTML('
         <td colspan="2" align="left">
        <img src="2019/'.$datos['id].'.'.$datos['rfc'].'.'.png.'" >
	</td>
	<td>
	<p class="center">Num. Certificado</p>
    	<p class="center">UNAM-DEPFE-'.$fecha.'-'.$id.'.</p> 

	</td>
	</td>

');
$mpdf -> WriteHTML('
         <td colspan="2" align="left">
                 <img src="https://placehold.it/150x80?text=LOGO INSTITUTO" class="img-responsive" style="width:50%" alt="Image">
         </td>
      </tr>
  </tbody>
</table>
');
*/
$mpdf -> WriteHTML('</body>');
$mpdf -> Output('Const-'.$datos['id'].'.pdf', 'I');
$mpdf->Output();
exit;

