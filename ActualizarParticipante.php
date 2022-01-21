<?php
// Inicio la session
    session_start();

   //COMPRUEBA QUE EL USUARIO ESTA AUTENTIFICADO

// $misession=$_SESSION['id_usuario'];

// if ($misession == null || $misession = '') {
//     header("location:login.php");
//     exit();

//     }
    include_once("include/header.php");
    include_once("include/dbConexion.php");
     
    // $id = $_GET['id'];
    $id= $_REQUEST['id']; 

      $mensaje = '';

//VALIDAR EL PARAMETRO
      $errores = [];
 // if ( vacio($id) || !ctype_digit($id) ) {
 //  header('Location:inicio.php');
 // } elseif(!filter_var($id, FILTER_VALIDATE_REGEXP, ['options' => ['regexp' => "/^[0-9]+$/i"]])) {
 //     header('Location:inicio.php');

 // }

 $dbc = conexion(); 

 //SECCION DEL CODIGO PARA PROCESAR EL FORMULARIO
 if (isset($_POST['agregar']) && !empty($_POST['agregar'])) {         
     $RfcParticipante = trim($_POST['RfcParticipante']);
     $NombreParticipante = trim($_POST['NombreParticipante']);
     $ApellidopParticipante = trim($_POST['ApellidopParticipante']);
     $ApellidomParticipante = trim($_POST['ApellidomParticipante']);
     $EmailParticipante = trim($_POST['EmailParticipante']);
     $IdEvento = trim($_POST['IdEvento']);
     
     
     $errores = [];
    // var_dump(vacio($id_tevento));
    // $errores = [];
     if( vacio($RfcParticipante) ) {
         $errores['RfcParticipante']['obligatorio'] = "El RFC es obligatorio";
     }elseif(!filter_var($RfcParticipante, FILTER_VALIDATE_REGEXP, ['options' => ['regexp' => "/^([A-Z,Ñ,&]{3,4}([0-9]{2})(0[1-9]|1[0-2])(0[1-9]|1[0-9]|2[0-9]|3[0-1])[A-Z|\d]{3})$/"]])) {
         //evento_nombre puede tener letras . ' (espacios) - 
         $errores['RfcParticipante'][] = "El  RFC de Participante no es válido";
      }elseif (strlen($RfcParticipante) > 15) {
          $errores['RfcParticipante'][] = "El RFC de Participante puede tener máximo 15 caracteres";
      }
 
     if( vacio($NombreParticipante) ) {
         $errores['NombreParticipante']['obligatorio'] = "El Nombre es obligatorio";
     } elseif(!filter_var($NombreParticipante, FILTER_VALIDATE_REGEXP, ['options' => ['regexp' => "/^[a-záéíóúAÉÍÓÚÑñ'-.\s ]+$/i"]])) {
        //evento_nombre puede tener letras . ' (espacios) - 
        $errores['NombreParticipante'][] = "El nombre de Participante no es válido";
     }elseif (strlen($NombreParticipante) > 80) {
         $errores['NombreParticipante'][] = "El nombre de Participante puede tener máximo 80 caracteres";
     }
     if( vacio($ApellidopParticipante) ) {
         $errores['ApellidopParticipante']['obligatorio'] = "El Apellido Paterno es obligatorio";
     } elseif(!filter_var($ApellidopParticipante, FILTER_VALIDATE_REGEXP, ['options' => ['regexp' => "/^[a-zA-ZáéíóúAÉÍÓÚÑñ'-.\s ]+$/i"]])) {
        //evento_nombre puede tener letras . ' (espacios) - 
        $errores['ApellidopParticipante'][] = "El Apellido  Paterno de participante no es válido";
     }elseif (strlen($ApellidopParticipante) > 80) {
         $errores['ApellidopParticipante'][] = "El Apellido Paterno de participante puede tener máximo 80 caracteres";
     }
 
     if( !vacio($ApellidomParticipante) ) {
         if(!filter_var($ApellidomParticipante, FILTER_VALIDATE_REGEXP, ['options' => ['regexp' => "/^[a-zA-ZáéíóúAÉÍÓÚÑñ'-.\s ]+$/i"]])) {
        //evento_nombre puede tener letras . ' (espacios) - 
        $errores['ApellidomParticipante'][] = "El Apellido Materno de participante no es válido";
     }elseif (strlen($ApellidomParticipante) > 80) {
         $errores['ApellidomParticipante'][] = "El Apellido Materno de participante puede tener máximo 80 caracteres";
     }
     }
 
     if( vacio($EmailParticipante) ) {
         $errores['EmailParticipante']['obligatorio'] = "La dirección de correo es obligatorio";
     } elseif(!filter_var($EmailParticipante, FILTER_VALIDATE_EMAIL)) {
         $errores['EmailParticipante']['formato'] = "El email no es válido";
     }elseif (strlen($EmailParticipante) > 100) {
         $errores['EmailParticipante'][] = "La dirección de correo puede tener máximo 100 caracteres";
     }
     if( vacio($IdEvento) ) {
         $errores['IdEvento']['obligatorio'] = "El evento es obligatorio";
     }
  

        //Si no hay errores, guardamos el registro en la base de datos
        if (empty($errores)) {

            
            $query = "UPDATE participante SET RfcParticipante=?, NombreParticipante=?, ApellidopParticipante=?, ApellidomParticipante=?, EmailParticipante=? WHERE IdParticipante = '$id'";

            $stmt = mysqli_prepare($dbc, $query);

            mysqli_stmt_bind_param($stmt, 'sssss', $RfcParticipante, $NombreParticipante, $ApellidopParticipante, $ApellidomParticipante, $EmailParticipante);
            

            if (mysqli_stmt_execute($stmt)) {
              $mensaje = "El participante se actualizó exitosamente";
            } else {
                $mensaje = "No se pudo actualizar el participante";
                 
            }


        }

    }
	

    $sql="SELECT * FROM participante WHERE RfcParticipante = '$id'";
    $resultado=mysqli_query($dbc,$sql);
     foreach($resultado as $row): 
         
    //PRESENTACIÓN - VISTA
    // include("includes/encabezado.php");
    ?>
    <div class="container">
	<div class="row">
		<h3 style="text-align:center">MODIFICAR REGISTRO</h3>
	</div>
			
	<form class="form-horizontal" method="POST" action="ActualizarParticipante.php" autocomplete="off">
		<div class="form-group">
			<label for="NombreParticipante" class="col-sm-2 control-label">Nombre Participante</label>
			<div class="col-sm-10">
				<input type="text" class="form-control" id="NombreParticipante" name="NombreParticipante" placeholder="NombreParticipante" value="<?php echo $row['NombreParticipante']; ?>" required>
			</div>
		</div>
				
	<!-- <input type="hidden" id="id" name="id" value="<?php echo $row['IdParticipante']; ?>" /> -->

		<div class="form-group">
			<label for="ApellidopParticipante" class="col-sm-2 control-label">Apellido Paterno</label>
				<div class="col-sm-10">
					<input type="text" class="form-control" id="ApellidopParticipante" name="ApellidopParticipante" placeholder="Apellido Paterno" value="<?php echo $row['ApellidopParticipante']; ?>" required>
				</div>
		</div>

		<div class="form-group">
			<label for="ApellidomParticipante" class="col-sm-2 control-label">Apellido Materno</label>
				<div class="col-sm-10">
					<input type="text" class="form-control" id="ApellidomParticipante" name="ApellidomParticipante" placeholder="Apellido Materno" value="<?php echo $row['ApellidomParticipante']; ?>" required>
				</div>
		</div>

		<div class="form-group">
			<label for="RfcParticipante" class="col-sm-2 control-label">RFC</label>
				<div class="col-sm-10">
					<input type="RfcParticipante" class="form-control" id="RfcParticipante" name="RfcParticipante" placeholder="RfcParticipante" value="<?php echo $row['RfcParticipante']; ?>"  required>
				</div>
		</div>
				
		<div class="form-group">
			<label for="EmailParticipante" class="col-sm-2 control-label">Email</label>
				<div class="col-sm-10">
					<input type="EmailParticipante" class="form-control" id="EmailParticipante" name="EmailParticipante" placeholder="Email" value="<?php echo $row['EmailParticipante']; ?>"  required>
				</div>
			</div>
            <?php
            $sql="SELECT * FROM evento";
             $resultado2=mysqli_query($dbc,$sql); 
             foreach($resultado2 as $evento):
            ?>
		<div class="form-group">
            <label for="NombreEvento" class="col-sm-2 control-label">Selecciona  Evento:</label>
                <div class="col-sm-10">
                    <select id="NombreEvento" name="NombreEvento" class="form-control <?= (isset($errores['NombreEvento'])) ? 'is-invalid' : '' ?>">>
                        <option value="<?php echo $evento['NombreEvento']; ?>"><?php echo $evento['NombreEvento']; ?></option>
                        <?php foreach($resultado2 as $evento) { ?>
						<option value="<?php echo $evento['IdEvento']; ?>"><?php echo $evento['NombreEvento']; ?></option>
                        <?php } ?> 

                    </select>
					<div class="invalid-feedback">
                        <?php
                        if(isset($errores['NombreEvento']) && !empty($errores['NombreEvento'])){
                            foreach($errores['NombreEvento'] as $tipo => $mensaje) {
                            echo $mensaje;
                        }
                        }
                        ?>
                    </div>
                </div>
        </div>
        <?php endforeach; ?>
        <?php endforeach; ?>
		<div class="form-group">
			<div class="col-sm-offset-2 col-sm-10">
				<a href="inicio.php" class="btn btn-default">Regresar</a>
				<button type="submit" class="btn btn-primary">Guardar</button>
			</div>
		</div>
			
	</form>
</div>