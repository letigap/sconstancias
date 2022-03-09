<?php
//Agregamos la librería para generar códigos QR
        include 'phpqrcode/qrlib.php';
	include_once("include/dbConexion.php");    


	use PHPMailer\PHPMailer\PHPMailer;
	use PHPMailer\PHPMailer\Exception;

	require 'PHPMailer/Exception.php';
	require 'PHPMailer/PHPMailer.php';
	require 'PHPMailer/SMTP.php';
	$mail = new PHPMailer(true);

        $id = $_POST['seleccionados'];

        print_r($id);
        $directorio = date("Y");
        $dir = 'CONST_'.$directorio.'/';
    //    $dir = 'CONST_'.$directorio.'r/';
		$dbc = conexion();

	//['rfc,id','rfc,id','rfc,id']:	
	
	

	foreach($id as $llave => $valor) { //foreach (['rfc,id','rfc,id','rfc,id'] => "rfc,id")
	$datos = explode(",", $valor); //se descompone la cadena rfc,id y se genera un ["rfc","id"]
	$rfc=$datos[0];
	$eventoid=$datos[1];
	$fromemail=$datos[2];
	echo "el RFC: ".$rfc. "<- ";
	echo "el ID EVENTO: ".$eventoid. "<- ";
        
              $query = "SELECT `evento`.*, `tipoevento`.`NombreTipoEvento`, `participante`.*
			FROM `evento` 
			INNER JOIN `tipoevento` ON `evento`.`IdTipoEvento` = `tipoevento`.`IdTipoEvento`,`participante`
			WHERE RfcParticipante = '$rfc' and IdEvento ='$eventoid';";
		$result = mysqli_query ($dbc, $query);
		$row = $result->fetch_array(MYSQLI_ASSOC);
			print_r($row);

			echo $row['IdEvento']; 
			echo $row['RfcParticipante']; 
		
	
	//Si no existe la carpeta la creamos
	if (!file_exists($dir))
        mkdir($dir);
	echo "<script> alert('Entrando'); </script>";
	
	
	$tamanio = 10; //Tamaño de Pixel
	$level = 'M'; //Precisión
	$framSize = 3; //Tamaño en blanco
	$prefile = $row['IdEvento']; //prefijo de nombre de archivo
	$file = $row['RfcParticipante']; //nombre que se le dara a la imagen
	$contenido = $row['IdEvento'] ." ".$row['RfcParticipante'] ." - ".$row['NombreParticipante']." ".$row['ApellidopParticipante']." ".$row['ApellidomParticipante']." - ".$row['NombreEvento']; //Texto
	
	// hasta aqui funciona

	$filename = $dir.$prefile.$file.'.png';
	echo '-----------'.$filename.'-----------';

	//$filename = $dir.$contenido.'.png';

        //Enviamos los parámetros a la Función para generar código QR 
        echo '<font color="red">'.'Certificado:  '.$contenido.'</font>'.'<br>';
	QRcode::png($contenido, $filename, $level, $tamanio, $framSize); 
	
        //Mostramos la imagen generada
	echo '<img src="'.$dir.basename($filename).'" /><hr/>';
////////////////////////////////////////
        require 'generarQC.php';
///////////////////////////////////////



try {
    //Server settings
    $mail->SMTPDebug = 2;                                       // Enable verbose debug output
    $mail->isSMTP();                                            // Set mailer to use SMTP
    $mail->SMTPAuth   = false;                                   // Enable SMTP authentication
    $mail->SMTPAutoTLS = false;

    $mail->Port       = '25';                                    // TCP port to connect to
    $mail->Host       = 'localhost';  // Specify main and backup SMTP servers
    $mail->Username   = 'supervisor';                     // SMTP username
    $mail->Password   = 'Spira2015/';                               // SMTP password

    echo "<script> alert('los datos son: '".$rfc."); </script>";
    echo "<script> alert('los datos son: '".$eventoid."); </script>";
    echo "<script> alert('los datos son: '".$fromemail."); </script>";

    //Recipients
    $mail->setFrom('supervisor@www.depfe.unam.mx', 'Depfe');
    $mail->addAddress($fromemail, 'destino');     // Add a recipient
    $mail->addAddress('letiga@unam.mx', 'copia');     // Add a recipient
    $mail->AddAttachment('CONST_2022/Const-'.$eventoid.''.$rfc.'.pdf');
    // Content
    $mail->isHTML(true);                                  // Set email format to HTML
    $mail->Subject = 'Constancia de Evento';
    $mail->Body    = 'Para la Divisi&oacute;n de Estudios de Posgrado de la Facultad de Econom&iacute;a de la UNAM, es un gusto dirigirnos</br>
a usted para agradecer su asistencia al III Seminario "Perspectivas críticas de las Cadenas Globales de Valor".
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
}
?>


