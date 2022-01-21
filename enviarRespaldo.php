<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'PHPMailer/Exception.php';
require 'PHPMailer/PHPMailer.php';
require 'PHPMailer/SMTP.php';

require 'conexion.php';
// Instantiation and passing `true` enables exceptions
$id = $_POST['id'];
//$id = '173';
$archivo = $_GET['id'];

$correo = $_GET['correo'];
$mail = new PHPMailer(true);




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
    $mail->setFrom('supervisor@www.depfe.unam.mx', 'Lety');
    $mail->addAddress($correo, 'destino');     // Add a recipient
    //$mail->addAddress('letiga@unam.mx', 'destino');     // Add a recipient

    // Attachments
    //$mail->AddAttachment('CONST_2021/Const-'.$archivo.'.pdf');
    $mail->AddAttachment('enviar.php');
    // Content
    $mail->isHTML(true);                                  // Set email format to HTML
    $mail->Subject = 'Constancia de Evento';
    $mail->Body    = 'Para nosotros Divisi&oacute;n de Estudios de Posgrado de la Facultad de Estudios de Posgrado de la Facultad de Econom&iacute;a es un gusto dirigirnos</br>
a usted para hacerle llegar nuestro reconocimiento por haber contado con su asistencia al Seminario "La Inversi&oacute;n Extranjera Directa en 
Am&eacute;rica Latina: una lectura cr&iacute;tica."</br>

Adjuntamos en este correo su constancia de participaci&oacute;n y estaremos agradecidos de poder contar con su presencia para futuros eventos.</br>
Atentamente.</br>
Divisi&oacute;n de Estudios de Posgrado de la Facultad de Econom&iacute;a.
';

    $mail->send();
    echo 'El mensaje se envió exitosamente';
} catch (Exception $e) {
    echo "Hubo un error al enviar el mensaje. Mailer Error: {$mail->ErrorInfo}";
}
