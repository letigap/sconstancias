<?php

        require 'conexion.php';

        $id = $_GET['id'];

	
	if(isset($_POST['id'])){
		foreach ($_POST['id'] as $id):
        		$sql = "DELETE FROM participantes WHERE id = '$id'";
		endforeach;
		
	}
	else{
		?>
<script>
			window.alert('Selecciona un usuario');
			window.location.href='indice.php';
		</script>
		<?php
	}
	
?>
