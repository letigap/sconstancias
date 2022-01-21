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
     
    $id= $_REQUEST['id']; 

      $mensaje = '';
//VALIDAR EL PARAMETRO
$errores = [];
    if ( vacio($id) || !ctype_digit($id) ) {
        header('Location:inicio.php');
    } elseif(!filter_var($id, FILTER_VALIDATE_REGEXP, ['options' => ['regexp' => "/^[0-9]+$/i"]])) {
        header('Location:inicio.php');
    
    }

$dbc = conexion(); 

//SECCION DEL CODIGO PARA PROCESAR EL FORMULARIO	
	if (isset($_POST['enviar']) && !empty($_POST['enviar'])) {
                
        $IdTipoEvento = trim($_POST['IdTipoEvento']);
        $NombreEvento = trim($_POST['NombreEvento']);
        $ProfesorEvento = trim($_POST['ProfesorEvento']);
        $ProcedenciaProfeEvento = trim($_POST['ProcedenciaProfeEvento']);
        $FechaEvento = trim($_POST['FechaEvento']);
        $CoordinadorEvento = trim($_POST['CoordinadorEvento']);


        echo "<script> alert('hola'); </script>";

        $errores = [];
        if( vacio($NombreEvento) ) {
            $errores['NombreEvento']['obligatorio'] = "El nombre de evento es obligatorio";
        } elseif(!filter_var($NombreEvento, FILTER_VALIDATE_REGEXP, ['options' => ['regexp' => "/^[a-zA-ZáéíóúAÉÍÓÚÑñ0-9:&\(\)-.\s ]+$/i"]])) {
           //Nombre puede tener letras . ' (espacios) - 
           $errores['NombreEvento'][] = "El nombre no es válido";
        }elseif (strlen($NombreEvento) > 500) {
            $errores['NombreEvento'][] = "El nombre puede tener máximo 500 caracteres";
        }

        $errores = [];
        if( vacio($IdTipoEvento) ) {
            $errores['IdTipoEvento']['obligatorio'] = "El tipo de evento es obligatorio";
        } 

        $errores = [];
        if( vacio($ProfesorEvento) ) {
            $errores['ProfesorEvento']['obligatorio'] = "El profesor del evento es obligatorio";
        } elseif(!filter_var($ProfesorEvento, FILTER_VALIDATE_REGEXP, ['options' => ['regexp' => "/^[a-zA-ZáéíóúÁÉÍÓÚÑñäëüÄÖ'-.\s ]+$/i"]])) {
           //Nombre puede tener letras . ' (espacios) - 
           $errores['ProfesorEvento'][] = "El nombre de profesor no es válido";
        }elseif (strlen($ProfesorEvento) > 250) {
            $errores['ProfesorEvento'][] = "El nombre de profesor puede tener máximo 250 caracteres";
        }

        $errores = [];
        if( !vacio($ProcedenciaProfeEvento) && !filter_var($ProcedenciaProfeEvento, FILTER_VALIDATE_REGEXP, ['options' => ['regexp' => "/^[a-zA-ZáéíóúÁÉÍÓÚÑñäëüÄÖ0-9:&\(\)-.\s ]+$/i"]])) {
           //Nombre puede tener letras . ' (espacios) - 
           $errores['ProcedenciaProfeEvento'][] = "La Procedencia no es válida";
        }elseif (strlen($ProcedenciaProfeEvento) > 300) {
            $errores['ProcedenciaProfeEvento'][] = "La Procedencia puede tener máximo 300 caracteres";
        }

        if( vacio($FechaEvento) ) {
            $errores['FechaEvento']['obligatorio'] = "La fecha del evento es obligatorio";
        }

        if( !vacio($CoordinadorEvento) && (!filter_var($CoordinadorEvento, FILTER_VALIDATE_REGEXP, ['options' => ['regexp' => "/^[a-zA-ZáéíóúAÉÍÓÚÑñ.\s ]+$/i"]])) ) {   
            $errores['CoordinadorEvento']['fomato'] = "El coordinador no es válido";
        }elseif (strlen($CoordinadorEvento) > 300) {
            $errores['CoordinadorEvento'][] = "El coordinador del evnento puede tener máximo 300 caracteres";
        }
    

        // if( vacio($IdtipoEvento) ) {
        //     $errores['IdTipoEvento']['obligatorio'] = "El Tipo de evento es obligatorio";
        // }

        //Si no hay errores, guardamos el registro en la base de datos
        if (empty($errores)) {

            
            $query = "UPDATE evento SET IdTipoEvento=?, NombreEvento=?, ProfesorEvento=?, ProcedenciaProfeEvento=?, FechaEvento=?, CoordinadorEvento=? WHERE IdEvento = '$id'";

            $stmt = mysqli_prepare($dbc, $query);

            mysqli_stmt_bind_param($stmt, 'isssss', $IdTipoEvento, $NombreEvento, $ProfesorEvento, $ProcedenciaProfeEvento, $FechaEvento, $CoordinadorEvento);
            

            if (mysqli_stmt_execute($stmt)) {
              $mensaje = "El evento se actualizó exitosamente";
            } else {
                $mensaje = "No se pudo actualizar el evento";
                 
            }
        }

    }
#Consulta para el tipo de evento
$sql="SELECT * FROM TipoEvento";
$tipos=getDatos($sql);
// print_r($tipos);
        
// $sql="SELECT * FROM evento WHERE IdEvento = '$id'";
$sql="SELECT `evento`.*, `tipoevento`.* FROM `evento` LEFT JOIN `tipoevento` ON `evento`.`IdTipoEvento` = `tipoevento`.`IdTipoEvento` WHERE IdEvento = '$id'";
$resultado=mysqli_query($dbc,$sql);
foreach($resultado as $row):

    //PRESENTACIÓN - VISTA
    
?>
<h2 class="p-2 text-center">Actualizar datos de evento</h2>
<main class="container">
    <form class="form-evento" id="form_evento" action="ActualizarEvento.php" method="POST">
        <div class="form-row">
        <div class="form-group col-md-10">
            <label for="NombreEvento">Nombre de Evento</label>
                <input type="text" class="form-control <?= (isset($errores['NombreEvento'])) ? 'is-invalid' : '' ?>" id="NombreEvento" name="NombreEvento" placeholder="Nombre Evento" value="<?php echo $row['NombreEvento']; ?>">
                <div class="invalid-feedback">
                    <span>
                        <?php
                        if(isset($errores['NombreEvento']) && !empty($errores['NombreEvento'])){
                        foreach($errores['NombreEvento'] as $tipo => $mensaje) {
                        echo $mensaje;
                            }
                        }
                        ?>
                    </span>
                </div>
        </div>
        </div> 
        <div class="form-row">
                <div class="form-group col-md-10">
                <label for="IdTipoEvento">Tipo de evento</label>
                <select name="IdTipoEvento" id="IdTipoEvento" class="form-control <?= (isset($errores['IdTipoEvento'])) ? 'is-invalid' : '' ?>">
                        <option value="<?php echo $row['IdTipoEvento']; ?>"><?php echo $row['NombreTipoEvento']; ?></option>
                        <?php foreach($tipos as $tipo) {
                            echo "<option value='{$tipo['IdTipoEvento']}'>{$tipo['NombreTipoEvento']}</option>";
                        } ?>
                    </select>
                    <div class="invalid-feedback">
                        <span>
                        <?php
                        if(isset($errores['IdTipoEvento']) && !empty($errores['IdTipoEvento'])){
                            foreach($errores['IdTipoEvento'] as $tipo => $mensaje) {
                            echo $mensaje;
                        }
                        }
                        ?>
                        </span>
                    </div>
                </div>
            </div>

        
        <input type="hidden" id="id" name="id" value="<?php echo $row['IdEvento']; ?>" />
        <div class="form-row">
        <div class="form-group col-md-10">
            <label for="ProfesorEvento">Nombre de Profesor de Evento</label>
                <input type="text" class="form-control <?= (isset($errores['ProfesorEvento'])) ? 'is-invalid' : '' ?>" id="ProfesorEvento" name="ProfesorEvento" placeholder="Profesor Evento" value="<?php echo $row['ProfesorEvento']; ?>">
                <div class="invalid-feedback">
                    <span>
                        <?php
                        if(isset($errores['ProfesorEvento']) && !empty($errores['ProfesorEvento'])){
                        foreach($errores['ProfesorEvento'] as $tipo => $mensaje) {
                        echo $mensaje;
                            }
                        }
                        ?>
                    </span>
                </div>
        </div>
        </div>
        <div class="form-row">
        <div class="form-group col-md-10">
            <label for="ProcedenciaProfeEvento">Procedencia del Profesor de Evento</label>
                <input type="text" class="form-control <?= (isset($errores['ProcedenciaProfeEvento'])) ? 'is-invalid' : '' ?>" id="ProcedenciaProfeEvento" name="ProcedenciaProfeEvento" placeholder="Procedencia del profesor" value="<?php echo $row['ProcedenciaProfeEvento']; ?>">
                <div class="invalid-feedback">
                    <span>
                        <?php
                        if(isset($errores['ProcedenciaProfeEvento']) && !empty($errores['ProcedenciaProfeEvento'])){
                        foreach($errores['ProcedenciaProfeEvento'] as $tipo => $mensaje) {
                        echo $mensaje;
                            }
                        }
                        ?>
                    </span>
                </div>
        </div>
        </div>
        <div class="form-row">
                <div class="form-group col-md-10">
                    <label for="FechaEvento">Fecha de realización </label>
                    <input type="date" class="form-control <?= (isset($errores['FechaEvento'])) ? 'is-invalid' : '' ?>" name="FechaEvento" id="FechaEvento" placeholder="La fecha de realización del evento" value="<?php echo $row['FechaEvento']; ?>">
                    <div class="invalid-feedback"><span>
                        <?php
                        if(isset($errores['FechaEvento']) && !empty($errores['FechaEvento'])){
                            foreach($errores['FechaEvento'] as $tipo => $mensaje) {
                            echo $mensaje;
                        }
                        }
                        ?>
                        </span>  
                    </div>
                </div>
            </div>
            <div class="form-row">
                <div class="form-group col-md-10">
                <label for="CoordinadorEvento">Coordinador(es) del Evento</label>
                    <input type="text" class="form-control <?= (isset($errores['CoordinadorEvento'])) ? 'is-invalid' : '' ?>" name="CoordinadorEvento" id="CoordinadorEvento" placeholder="Coordinador de evento" value="<?php echo $row['CoordinadorEvento']; ?>">
                    <div class="invalid-feedback"><span>
                    <?php
                     if(isset($errores['CoordinadorEvento']) && !empty($errores['CoordinadorEvento'])){
                         foreach($errores['CoordinadorEvento'] as $tipo => $mensaje) {
                        echo $mensaje;
                       }
                     }
                     ?>
                     </span>
                    </div>
                </div>
            </div>                   
<?php endforeach; ?>
<div class="form-group">
			<div class="col-sm-offset-2 col-sm-10">
				<a href="inicio.php" class="btn btn-secondary">Regresar</a>
				<button type="submit" name="enviar" value="enviar" class="btn btn-primary">Guardar</button>
			</div>
		</div>
			
	</form>
</main>

<?php
    include_once("include/footer.php");
?>