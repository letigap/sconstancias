<?php
$destinatario = "letiga@unam.mx";
$asunto = "Mensaje2 de prueba";

//attachment file path
$file = "CONST_2021/Const-171.pdf";

$cuerpo = '
<html>
<head>    
   <title>Prueba de correo</title>
</head>
<body>
<h1>Hola amigos</h1>
<p>Bienvenidos a prueba de correo electrónico</p>
</body>
</html>
';
//

//Para envio en formato html
$headers = "MIME-Version: 1.0\n";
$headers .= "Content-type: text/html; charset=utf-8\n";

//direccion de remitente
$headers .= "From: DEPFE<supervisor@depfe.unam.mx>\n";

//boundary 
$semi_rand = md5(time()); 
$mime_boundary = "==Multipart_Boundary_x{$semi_rand}x"; 

//headers for attachment 
$headers .= "nMIME-Version: 1.0n' . 'Content-Type: multipart/mixed;n' . ' boundary="{$mime_boundary}n"; 

//multipart boundary 
$message = "--{$mime_boundary}n" . "Content-Type: text/html; charset="UTF-8"n" .
"Content-Transfer-Encoding: 7bitnn" . $htmlContent . "nn"; 

//preparing attachment
if(!empty($file) > 0){
    if(is_file($file)){
        $message .= "--{$mime_boundary}n";
        $fp =    @fopen($file,"rb");
        $data =  @fread($fp,filesize($file));

        @fclose($fp);
        $data = chunk_split(base64_encode($data));
        $message .= "Content-Type: application/octet-stream; name="".basename($file).""n" . 
        "Content-Description: ".basename($files[$i])."n" .
        "Content-Disposition: attachment;n" . " filename="".basename($file).""; size=".filesize($file).";n" . 
        "Content-Transfer-Encoding: base64nn" . $data . "nn";
    }
}
$message .= "--{$mime_boundary}--";
$returnpath = "-f" . $from;

//send email
$mail = @mail($to, $subject, $message, $headers, $returnpath); 

//email sending status
echo $mail?"<h1>Mail sent.</h1>":"<h1>Mail sending failed.</h1>";

//Direccion de respuesta, si queremos respuesta
$headers .= "Reply-To: letiga@unam.mx\n";

//Direcciones que recibiran copia
$headers .= "Cc: garciap.leticia@gmail.com\n";

mail($destinatario, $asunto, $cuerpo, $headers)
?>
