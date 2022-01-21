<?php
	//Agregamos la librería para generar códigos QR
	require 'phpqrcode/qrlib.php';    
        require 'conexion.php';
        
        $id=$_POST['seleccionados'];
        $dir = 'CONST_2021/';
        
        foreach($id as $llave => $valor) {
              
              $sql = "SELECT * FROM v_const_event WHERE id = '$valor'";
              $resultado = $mysqli->query($sql);
              $row = $resultado->fetch_array(MYSQLI_ASSOC);

	//Declaramos una carpeta temporal para guardar la imágenes generadas
//	$dir = 'temp/';
//	$dir = 'CONST_2021/';
	
	//Si no existe la carpeta la creamos
	if (!file_exists($dir))
        mkdir($dir);
	
        //Declaramos la ruta y nombre del archivo a generar
	//$filename = $dir.'test.png';
 
        //Parámetros de Configuración
	
	$tamanio = 10; //Tamaño de Pixel
	$level = 'M'; //Precisión
	$framSize = 3; //Tamaño en blanco
	$prefile = $row['id']; //prefijo de nombre de archivo
	$file = $row['rfc']; //nombre que se le dara a la imagen
	$contenido = $row['id']."".$row['rfc']." - ".$row['nombre']." ".$row['apellidop']." ".$row['apellidom']." - ".$row['nombre_evento']; //Texto
	
	$filename = $dir.$prefile.$file.'.png';
	//$filename = $dir.$contenido.'.png';

        //Enviamos los parámetros a la Función para generar código QR 
        echo '<font color="red">'.'Certificado:  '.$contenido.'</font>'.'<br>';
	QRcode::png($contenido, $filename, $level, $tamanio, $framSize); 
	
        //Mostramos la imagen generada
	echo '<img src="'.$dir.basename($filename).'" /><hr/>';
////////////////////////////////////////
        require 'generarQC.php';

///////////////////////////////////////


}
?>

