<?php
	include_once("include/dbConexion.php");
	
	$NombreEvento = $_POST['NombreEvento'];
	
	$query = "SELECT * FROM evento WHERE NombreEvento = '$NombreEvento' ORDER BY NombreEvento";
	$resultado = $mysqli->query($query);
	
	$html= "<option value='0'>Seleccionar Evento</option>";
	
	while($row= $resultado->fetch_assoc())
	{
		$html.= "<option value='".$row['IdEvento']."'>".$rowM['NombreEvento']."</option>";
	}
	
	echo $html;
?>
