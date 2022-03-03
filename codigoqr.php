<?php
//Agregamos la librería para generar códigos QR
        include 'phpqrcode/qrlib.php';
	include_once("include/dbConexion.php");    
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
        require 'enviar.php';
///////////////////////////////////////

}
?>


