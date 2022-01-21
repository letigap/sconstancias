<?php
    include("includes/funciones_db.php");
    include("includes/mis_funciones.php");
    include("includes/config.php");

    // $id = $_GET['id'];
    $id= $_REQUEST['id']; 
  //$id = $_POST['nombre'];

    // $nombre_evento = '';
    //  $id_tevento = '';
    //  $descripcion_evento = '';
    //  $sede_evento = '';
    //  $fecha_evento = '';
    //  $organizador_evento = '';
      $mensaje = '';

    //  $dbc = conectar_db();

     //VALIDAR EL PARAMETRO
//      $errores = [];
// if ( vacio($id) || !ctype_digit($id) ) {
//   header('Location:menu.php');
// } elseif(!filter_var($id, FILTER_VALIDATE_REGEXP, ['options' => ['regexp' => "/^[0-9]+$/i"]])) {
//     header('Location:menu.php');
// } elseif( !is_int($id) || !abs($id) ) {
//     header('Location:menu.php'); 
// }

//- obligatorio
//- numérico


$dbc = conectar_db(); 


 

    //SECCION DEL CODIGO PARA PROCESAR EL FORMULARIO
    if (isset($_POST['enviar']) && !empty($_POST['enviar'])) {
         echo '<script type="text/javascript">alert("'.$id.'");</script>';
        
        $id_tevento = $_POST['id_tevento'];
        $nombre_evento = trim($_POST['nombre_evento']);
        $descripcion_evento = trim($_POST['descripcion_evento']);
        $sede_evento = trim($_POST['sede_evento']);
        $fecha_evento = trim($_POST['fecha_evento']);
        $organizador_evento = trim($_POST['organizador_evento']);
        
        $errores = [];
        if( vacio($id_tevento) ) {
            $errores['id_tevento']['obligatorio'] = "El tipo de evento es obligatorio";
        } 
        
       // var_dump(vacio($id_tevento));
        $errores = [];
        if( vacio($nombre_evento) ) {
            $errores['nombre_evento']['obligatorio'] = "El Nombre es obligatorio";
        } elseif(!filter_var($nombre_evento, FILTER_VALIDATE_REGEXP, ['options' => ['regexp' => "/^[a-zA-ZáéíóúAÉÍÓÚÑñ0-9'-.:\s ]+$/i"]])) {
           //nombre_evento puede tener letras . ' (espacios) - 
           $errores['nombre_evento'][] = "El nombre de evento no es válido";
        }elseif (strlen($nombre_evento) > 500) {
            $errores['nombre_evento'][] = "El nombre de evento puede tener máximo 500 caracteres";
        }

        if( vacio($descripcion_evento) ) {
            $errores['descripcion_evento']['obligatorio'] = "La descripcion de evento es obligatorio";
        } elseif(!filter_var($descripcion_evento, FILTER_VALIDATE_REGEXP, ['options' => ['regexp' => "/^[a-zA-ZáéíóúAÉÍÓÚÑñ0-9'-.,:\s ]+$/i"]])) {
           //descripcion_evento puede tener letras . ' (espacios) -  números
           $errores['descripcion_evento'][] = "La descripción no es válida";
        }elseif (strlen($nombre_evento) > 900) {
            $errores['descripcion_evento'][] = "La descripción puede tener máximo 900 caracteres";
        }

        if( vacio($sede_evento) ) {
            $errores['sede_evento']['obligatorio'] = "La sede de evento es obligatorio";
        } elseif(!filter_var($sede_evento, FILTER_VALIDATE_REGEXP, ['options' => ['regexp' => "/^[a-zA-ZáéíóúAÉÍÓÚÑñ0-9'-.,:\s ]+$/i"]])) {
           //sede_evento puede tener letras . ' (espacios) -  y numeros
           $errores['sede_evento'][] = "La sede no es válida";
        }elseif (strlen($sede_evento) > 250) {
            $errores['sede_evento'][] = "La sede puede tener máximo 250 caracteres";
        }

        if( vacio($fecha_evento) ) {
            $errores['fecha_evento']['obligatorio'] = "La fecha del evento es obligatorio";
        } elseif(!filter_var($fecha_evento, FILTER_VALIDATE_REGEXP, ['options' => ['regexp' => "/^[a-z0-9'-.\s ]+$/i"]])) {
           //fecha_evento puede tener letras . ' (espacios) - números
           $errores['fecha_evento'][] = "La fecha no es válida";
        }elseif (strlen($fecha_evento) > 100) {
            $errores['fecha_evento'][] = "La fecha puede tener máximo 100 caracteres";
        }

        if( vacio($organizador_evento) ) {
            $errores['organizador_evento']['obligatorio'] = "El organizador del evento es obligatorio";
        } elseif(!filter_var($organizador_evento, FILTER_VALIDATE_REGEXP, ['options' => ['regexp' => "/^[a-zA-ZáéíóúAÉÍÓÚÑñ0-9'-.\s ]+$/i"]])) {
           //organizador_evento puede tener letras . ' (espacios) - 
           $errores['organizador_evento'][] = "El organizador no es válido";
        }elseif (strlen($organizador_evento) > 250) {
            $errores['organizador_evento'][] = "El organizador puede tener máximo 250 caracteres";
        }
        
        //VALIDACION DEL ARCHIVO DE IMAGEN A SUBIR   

             $target_path = "img/";
             $target_path = $target_path . basename($_FILES['img_evento']['name']);

              // $errores = [];
            if (is_uploaded_file ($_FILES['img_evento']['tmp_name'])) {
            //Validar el tamaño del archivo
            if ($_FILES['img_evento']['size'] >  3145728 ){
                $errores['img_evento'] = "El tamaño del archivo es mayor al permitido.";
                
            }

          
            //Validar el tipo de archivo
            $tiposValidos = [
                'image/gif', 'image/png', 'image/jpg', 'image/jpeg'
                            ];
            $mimeTypeArchivo = mime_content_type($_FILES['img_evento']['tmp_name']);

            if (!in_array($mimeTypeArchivo, $tiposValidos) || !in_array($_FILES['img_evento']['type'], $tiposValidos)) {
                echo '<br>';
                $errores['img_evento'][] = '<br/>"El archivo solo puede ser .gif, .png, o .jpg"';
            }

            if(empty($errores)) {
                 if(!move_uploaded_file($_FILES['img_evento']['tmp_name'], $target_path)) {
                    $errores['img_evento'][] = "No se pudo mover";
                }
            }  
              
            } else {
                 $errores['img_evento'][] = "No se subió el archivo";
             }
      
      //VALIDACION DEL ARCHIVO DE CARTEL DE EVENTO
      $target_path2 = "archivos/";
      $target_path2 = $target_path2 . basename($_FILES['cartel_evento']['name']);

       // $errores = [];
     if (is_uploaded_file ($_FILES['cartel_evento']['tmp_name'])) {
     //Validar el tamaño del archivo
     if ($_FILES['cartel_evento']['size'] >  3145728 ){
         $errores['cartel_evento'] = "El tamaño del archivo es mayor al permitido.";
         
     }

   
     //Validar el tipo de archivo
     $tiposValidos = [
        'application/pdf'
                     ];
     $mimeTypeArchivo = mime_content_type($_FILES['cartel_evento']['tmp_name']);

     if (!in_array($mimeTypeArchivo, $tiposValidos) || !in_array($_FILES['cartel_evento']['type'], $tiposValidos)) {
         echo '<br>';
         $errores['cartel_evento'][] = '<br/>"El archivo solo puede ser .pdf"';
     }

     if(empty($errores)) {
          if(!move_uploaded_file($_FILES['cartel_evento']['tmp_name'], $target_path2)) {
             $errores['cartel_evento'][] = "No se pudo mover";
         }
     }  
       
     } else {
          $errores['cartel_evento'][] = "No se subió el archivo";
      }


        //Si no hay errores, guardamos el registro en la base de datos
        if (empty($errores)) {

            
            $query = "UPDATE evento SET id_tevento=?, img_evento=?, nombre_evento=?, descripcion_evento=?, fecha_evento=?, cartel_evento=?, organizador_evento=?, sede_evento=? WHERE id_evento = '$id'";

            $stmt = mysqli_prepare($dbc, $query);

            mysqli_stmt_bind_param($stmt, 'isssssss', $id_tevento, $target_path, $nombre_evento, $descripcion_evento, $fecha_evento, $target_path2, $organizador_evento, $sede_evento);
            

            if (mysqli_stmt_execute($stmt)) {
              $mensaje = "El evento se actualizó exitosamente";
            } else {
                $mensaje = "No se pudo actualizar el evento";
                 
            }


        }

    }
	

    $query = "
    SELECT * FROM evento e 
     INNER JOIN tipo_evento t 
     ON e.id_tevento = t.id_tevento 
     WHERE id_evento = ?";

    $stmt = mysqli_prepare($dbc, $query);
    mysqli_stmt_bind_param($stmt, 'i', $id);
    mysqli_stmt_execute($stmt);

    $result = mysqli_stmt_get_result($stmt);
    if ($result) { 
        $numRows = mysqli_affected_rows($dbc);
      //pr($numRows);
        if ($numRows) {
          //Aqui busca por ID y solo nos debe devolver 1 registro
          $evento = mysqli_fetch_array($result, MYSQLI_ASSOC);
         // pr($country);
        }else {
          //header('Location:paises.php');
          exit;
        }

    }


    $sql="SELECT * FROM tipo_evento";
    $result=mysqli_query($dbc,$sql);

    //PRESENTACIÓN - VISTA
    include("includes/encabezado.php");
    ?>
    <div class="container">
    <h3>Evento a Actualizar</h3>


    <span>
     <?= $mensaje ?>
    </span>

    
    <form class="form-horizontal" id="myform" action="obtener_evento.php" method="POST" enctype="multipart/form-data">
        <input id="id" name="id" type="hidden" value="<?php echo $evento['id_evento']; ?>">

        <div class="form-group">
            <label for="id_tevento" class="col-sm-2 control-label">Tipo de Evento</label>
                    <div class="col-sm-10">
                        <select class="form-control" id="id_tevento" name="id_tevento">
                            <option value="<?php echo $evento['id_tevento']; ?>"><?php echo $evento['nombre_tevento']; ?></option>
                            <?php while($resultArray=mysqli_fetch_array($result)){
                                ?>
                            <option value="<?php echo $resultArray['id_tevento']; ?>"><?php print $resultArray['nombre_tevento']; ?></option>
                            <?php } ?>
                            
                        </select>
                    </div>
        </div>
        <div class="form-group">
            <label for="nombre_evento" class="col-sm-2 control-label">Nombre del Evento</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="nombre_evento" name="nombre_evento" value="<?php echo $evento['nombre_evento']; ?>">
                    <span style="color: #ed1b24">
                    <?php
                     if(isset($errores['nombre_evento']) && !empty($errores['nombre_evento'])){
                         foreach($errores['nombre_evento'] as $tipo => $mensaje) {
                        echo $mensaje;
                       }
                     }
    
                     ?>
                     </span>
                </div>
        </div>
		
        <div class="card mb-3" style="max-width: 50%;">
         <div class="row no-gutters">
             <div class="col-md-4">
                 <img  alt="imagen" src="<?=$evento['img_evento']?>">
            </div>
           <p class="card-text"><small class="text-muted"><?= $evento['img_evento'] ?></small></p>
         </div>
     </div>
        <div class="form-group">
            <label for="img_evento" class="col-sm-2 control-label">Nueva Ruta Imagen Evento</label>
                <div class="col-sm-10">
                    <input type="file" class="form-control" id="img_evento" name="img_evento">
                     <span style="color: #ed1b24">
                    <?php
                        if(isset($errores['img_evento']) && !empty($errores['img_evento'])){
                            foreach($errores['img_evento'] as $tipo => $mensaje) {
                            echo $mensaje;
                            }
                        }else {
                            echo "<br/>El archivo es válido y se subió con éxito";
                        }
    
                     ?>
                    </span>
                </div>
        </div>

        <div class="form-group">
            <label for="descripcion_evento" class="col-sm-2 control-label">Descripción</label>
                <div class="col-sm-10">
                    <textarea class="form-control" id="descripcion_evento" name="descripcion_evento" value="<?php echo $evento['descripcion_evento']; ?>" placeholder="<?php echo $evento['descripcion_evento']; ?>"></textarea>
                    <span style="color: #ed1b24">
                    <?php
                     if(isset($errores['descripcion_evento']) && !empty($errores['descripcion_evento'])){
                         foreach($errores['descripcion_evento'] as $tipo => $mensaje) {
                        echo $mensaje;
                       }
                     }
    
                     ?>
                     </span>
                </div>
        </div>

        <div class="form-group">
            <label for="sede_evento" class="col-sm-2 control-label">Sede del Evento</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="sede_evento" name="sede_evento" value="<?php echo $evento['sede_evento']; ?>">
                    <span style="color: #ed1b24">
                    <?php
                     if(isset($errores['sede_evento']) && !empty($errores['sede_evento'])){
                         foreach($errores['sede_evento'] as $tipo => $mensaje) {
                        echo $mensaje;
                       }
                     }
    
                     ?>
                     </span>
                </div>
         </div>
         <div class="form-group">
            <label for="fecha_evento" class="col-sm-2 control-label">Fecha de Realización</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="fecha_evento" name="fecha_evento" value="<?php echo $evento['fecha_evento']; ?>">
                    <span style="color: #ed1b24">
                    <?php
                     if(isset($errores['fecha_evento']) && !empty($errores['fecha_evento'])){
                         foreach($errores['fecha_evento'] as $tipo => $mensaje) {
                        echo $mensaje;
                       }
                     }
    
                     ?>
                    </span>
                </div>
        </div>

         <div class="form-group">
            <label for="cartel_evento" class="col-sm-2 control-label">Ruta Cartel Evento</label>
                <div class="col-sm-10">
                    <input type="file" class="form-control" id="cartel_evento" name="cartel_evento" value="<?php echo $evento['cartel_evento']; ?>">
                    <span style="color: #ed1b24">
                    <?php
                        if(isset($errores['cartel_evento']) && !empty($errores['cartel_evento'])){
                            foreach($errores['cartel_evento'] as $tipo => $mensaje) {
                            echo $mensaje;
                            }
                        }else {
                            echo "<br/>El archivo es válido y se subió con éxito";
                        }
    
                     ?>
                     </span>
                </div>
        </div>
        
        <div class="form-group">
            <label for="sede_evento" class="col-sm-2 control-label">Organizador del Evento</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="organizador_evento" name="organizador_evento" value="<?php echo $evento['organizador_evento']; ?>">
                    <span style="color: #ed1b24">
                    <?php
                     if(isset($errores['organizador_evento']) && !empty($errores['organizador_evento'])){
                         foreach($errores['organizador_evento'] as $tipo => $mensaje) {
                        echo $mensaje;
                       }
                     }
    
                     ?>
                     </span>
                </div>
         </div>
                                


    <div class="form-group">
        <div class="col-sm-offset-2 col-sm-10">
            <a href="menu.php" class="btn btn-default">Regresar al menu</a>
            <button type="submit" value="1" name="enviar">Actualizar</button>
        </div>
   </div>
</form>
</div>
 <?php
        include("includes/pie.php");
?>
            