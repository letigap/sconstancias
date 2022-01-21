<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'PHPMailer/Exception.php';
require 'PHPMailer/PHPMailer.php';
require 'PHPMailer/SMTP.php';

$mail = new PHPMailer(true);

include_once("include/dbConexion.php");

$array = $_GET['keys'];
$correos = explode(",", $array);
foreach ($emails as $indice => $valor){
echo $indice." = ".$valor."<br>";
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
// $envio=$_POST['enviados'];
//         print_r($envio);

// foreach($envio as $llave => $valor) {
//     echo "el valor es: ".$valor. "<- ";  
// $archivo = $_GET['id'];

// $correo = $_GET['correo'];
    $correo="solrac512@gmail.com"

    try {
    //Server settings
    $mail->SMTPDebug = 2;                                       // Enable verbose debug output
    $mail->isSMTP();                                            // Set mailer to use SMTP
    $mail->SMTPAuth   = false;                                   // Enable SMTP authentication
    $mail->SMTPAutoTLS = false;
   // $mail->SMTPSecure = 'ssl';                                  // Enable TLS encryption, `ssl` also accepted
   // $mail->Port       = '25';                                    // TCP port to connect to
    //$mail->Host       = '132.247.149.1';  // Specify main and backup SMTP servers
   // $mail->Username   = 'supervisor@132.247.149.1';                     // SMTP username
    //$mail->Password   = 'Spira2015/';                               // SMTP password

    $mail->Port       = '25';                                    // TCP port to connect to
    $mail->Host       = 'localhost';  // Specify main and backup SMTP servers
    $mail->Username   = 'supervisor';                     // SMTP username
    $mail->Password   = 'Spira2015/';                               // SMTP password

    //Recipients
    $mail->setFrom('supervisor@www.depfe.unam.mx', 'Depfe');
    $mail->addAddress($correo, 'destino');     // Add a recipient
    $mail->addAddress('letiga@unam.mx', 'copia');     // Add a recipient

    // Attachments
    $mail->AddAttachment('CONST_2021/Const-'.$valor.'.pdf');
    //$mail->AddAttachment('enviar.php');
    // Content
    $mail->isHTML(true);                                  // Set email format to HTML
    $mail->Subject = 'Constancia de Evento';
    $mail->Body    = 'Para la Divisi&oacute;n de Estudios de Posgrado de la Facultad de Econom&iacute;a de la UNAM, es un gusto dirigirnos</br>
a usted para agradecer su asistencia al Seminario en honor de Anthony P. Thirlwall: "Problem&aacute;ticas filos&oacute;ficas y anal&iacute;ticas en el desarrollo econ&oacute;mico de econom&iacute;as estructuralmente restringidas".
//a usted para agradecer su asistencia al Seminario Internacional: "Econom&iacute;a en Tiempos de Pandemia." 
</br>
</br>
Adjuntamos en este correo su constancia de asistencia y estaremos honrados de poder contar con su presencia en futuros eventos.</br>
</br>
Atentamente.</br>
</br>
La Divisi&oacute;n de Estudios de Posgrado de la Facultad de Econom&iacute;a-UNAM.
';

    $mail->send();
    echo 'El mensaje se envió exitosamente';
} catch (Exception $e) {
    echo "Hubo un error al enviar el mensaje. Mailer Error: {$mail->ErrorInfo}";
}

// }//termina foreach


////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
}


