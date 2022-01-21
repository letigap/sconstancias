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
else {
        printf("Error: %s\n", $mysqli->error);
        $mysqli->close();
        exit;
    }
	 if($datos['profesor']!=='' && $datos['procedencia']!=='') {
	}
	else {
	
		 if($datos['profesor'] ='') {

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
//$mpdf -> Output('2019/Const-'.$datos['id'].'.pdf', 'F');
$mpdf -> Output('2019/Const-'.$datos['id'].'.pdf', 'D');
exit;
	
}


