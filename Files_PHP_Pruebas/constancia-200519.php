<?php
require_once __DIR__ . '/vendor/autoload.php';
require_once('conexion.php');
$id = $_GET['id'];
$fecha = date("d-m-Y");
$consulta = "SELECT * FROM v_part_event WHERE  id = '$id';";
if($buscardatos = $mysqli->query($consulta)){
        $datos = $buscardatos->fetch_array(MYSQLI_ASSOC);
        $buscardatos->free();
    }

else {
        printf("Error: %s\n", $mysqli->error);
        $mysqli->close();
        exit;
    }


$mpdf = new \Mpdf\Mpdf(['orientation' => 'L']);
$mpdf->SetProtection(array('copy','print'), 'Acc3$0par', 'Acc3$0a11');
$mpdf -> SetTitle('Constancia de Evento');
$mpdf -> WriteHTML('<body>
background-image: -moz-repeating-linear-gradient(red, blue 20px, red 40px)

');
$mpdf -> WriteHTML('

<table width="100%" align="center" cellpadding="3" cellspacing="1">
  <tbody>
    <tr>
         <td colspan="2" align="right">
                <img src="images/unam.jpg" class="img-responsive" style="width:50%" alt="Image">
        </td>
        <td colspan="2" align="center">
                 <img src="images/FE.jpg" class="img-responsive" style="width:50%" alt="Image">
         </td>
         <td colspan="2" align="left">
                 <img src="https://placehold.it/150x80?text=LOGO INSTITUTO" class="img-responsive" style="width:50%" alt="Image">
         </td>
      </tr>
  </tbody>
</table><br><br>
');
$mpdf -> WriteHTML('
<h3 style="text-align: center">OTORGA LA PRESENTE</h3><br>
<h2 style="text-align: center">CONSTANCIA</h2>
');

$mpdf -> WriteHTML('
<table width="100%" align="center" cellpadding="3" cellspacing="1">
  <tbody>
    <tr>
      <td colspan="2" align="right">A: </td>
      <td colspan="2" align="left"><strong>'.$datos['nombre'].' '.$datos['apellidop'].' '.$datos['apellidom'].'</strong></td>
    </tr>
    <tr>
    <tr>
      <td  colspan="2" align="right">POR SU PARTICIPACION EN EL '.$datos['tipo_evento'].'</td>
    </tr>
    <tr>
      <td colspan="2" align="right"><strong>"'.$datos['nombre_evento'].'"</strong></td>
    </tr>
    <tr>
      <td align="right">Correo: </td>
      <td align="left"><strong>'.$datos['correo'].'</strong></td>
    </tr>
  </tbody>
</table>
<br>

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
');

$mpdf -> WriteHTML('<br><br><br>
<table width="100%" align="center" cellpadding="3" cellspacing="1">
<tbody>
    <tr>
      <td colspan="2" align="right">&nbsp;</td>
      <td colspan="2" align="right">Matricula: <strong><em>'.$datos['id'].'</em></strong></td>
    </tr>
    <tr>
      <td colspan="2" align="right">&nbsp;</td>
      <td colspan="2" align="right">Fecha de impresión: <strong><em>'.$fecha.'</em></strong></td>
    </tr>
</tbody>
</table><br><br>
');

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
        <img src="temp/'.$datos['rfc'].'.'.png.'" >
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


$mpdf -> WriteHTML('</body>');
$mpdf -> Output('Const-'.$datos['id'].'.pdf', 'I');
$mpdf->Output();
exit;

