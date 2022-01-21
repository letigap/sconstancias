<?php

$datos = $_POST;
//    print_r($datos);


//SECCION DEL CODIGO PARA PROCESAR EL FORMULARIO 
if (isset($_POST['agregar']) && !empty($_POST['agregar'])) {
    $IdTipoEvento = $_POST['IdTipoEvento'];
    $NombreEvento = trim($_POST['NombreEvento']);
    $ProfesorEvento = trim($_POST['ProfesorEvento']);
    $ProcedenciaProfeEvento = trim($_POST['ProcedenciaProfeEvento']);
    $FechaEvento = trim($_POST['FechaEvento']);
    $CoordinadorEvento = trim($_POST['CoordinadorEvento']);
    
    $errores = [];
    if( vacio($IdTipoEvento) ) {
        $errores['IdTipoEvento']['obligatorio'] = "El tipo de evento es obligatorio";
    } 
    if( vacio($NombreEvento) ) {
        $errores['NombreEvento']['obligatorio'] = "El Nombre de evento es obligatorio";
    } elseif(!filter_var($NombreEvento, FILTER_VALIDATE_REGEXP, ['options' => ['regexp' => "/^[a-zA-ZáéíóúAÉÍÓÚÑñ0-9:&\(\)-.\s ]+$/i"]])) {
       //NombreEvento puede tener letras,numeros,acentos . ' (espacios) - 
       $errores['NombreEvento'][] = "El nombre de evento no es válido";
    }elseif (strlen($NombreEvento) > 500) {
        $errores['NombreEvento'][] = "El nombre de evento puede tener máximo 500 caracteres";
    }
    if( !vacio($ProfesorEvento) ) {
        if (!filter_var($ProfesorEvento, FILTER_VALIDATE_REGEXP, ['options' => ['regexp' => "/^[a-zA-ZáéíóúAÉÍÓÚÑñ.\s ]+$/i"]])) {
       //evento_descripcion puede tener letras . (espacios)
       $errores['ProfesorEvento'][] = "El nombre de profesor no es válido";
    }elseif (strlen($ProfesorEvento) > 250) {
        $errores['ProfesorEvento'][] = "El nombre del profesor puede tener máximo 250 caracteres";
    }
    }
    if( !vacio($ProcedenciaProfeEvento) ) {      
        if(!filter_var($ProcedenciaProfeEvento, FILTER_VALIDATE_REGEXP, ['options' => ['regexp' => "/^[a-zA-ZáéíóúAÉÍÓÚÑñ0-9'-.\s ]+$/i"]])) {
        //evento_descripcion puede tener letras . ' (espacios) -  números
        $errores['ProcedenciaProfeEvento'][] = "La procedencia del profesor no es válida";
    }elseif (strlen($ProcedenciaProfeEvento) > 300) {
        $errores['ProcedenciaProfeEvento'][] = "La institición de procedencia puede tener máximo 300 caracteres";
    }
    }
    if( vacio($FechaEvento) ) {
        $errores['FechaEvento']['obligatorio'] = "La fecha del evento es obligatorio";
    } elseif(!filter_var($FechaEvento, FILTER_VALIDATE_REGEXP, ['options' => ['regexp' => "/^[a-zA-Záéíóú0-9':,-.\s ]+$/i"]])) {
       //FechaEvento puede tener letras . ' (espacios) - números
       $errores['FechaEvento'][] = "La fecha no es válida";
    }elseif (strlen($FechaEvento) > 80) {
        $errores['FechaEvento'][] = "La fecha puede tener máximo 80 caracteres";
    }
    if( !vacio($CoordinadorEvento) ) {
        if (!filter_var($CoordinadorEvento, FILTER_VALIDATE_REGEXP, ['options' => ['regexp' => "/^[a-zA-ZáéíóúAÉÍÓÚÑñ.\s ]+$/i"]])) {
        $errores['CoordinadorEvento']['fomato'] = "El coordinador no es válido";
    }elseif (strlen($CoordinadorEvento) > 300) {
        $errores['CoordinadorEvento'][] = "El coordinador del evnento puede tener máximo 300 caracteres";
    }
    }

    //Si no hay errores, guardamos el registro en la base de datos
    if (empty($errores)) {

        $dbc = conexion();
         echo "<script> alert('hola comienzo'); </script>";


        $query = 'INSERT INTO evento (IdTipoEvento, NombreEvento, ProfesorEvento, ProcedenciaProfeEvento, FechaEvento, CoordinadorEvento) VALUES (?, ?, ?, ?, ?, ?)';

            $stmt = mysqli_prepare($dbc, $query);

            mysqli_stmt_bind_param($stmt, 'isssss',$IdTipoEvento, $NombreEvento, $ProfesorEvento, $ProcedenciaProfeEvento, $FechaEvento, $CoordinadorEvento);

            $query = 'INSERT INTO participante (id_rol, participante_nombre, participante_apellidop, participante_apellidom, participante_email, participante_cargo_inst) VALUES (?, ?, ?, ?, ?, ?)';

            if (mysqli_stmt_execute($stmt)) {
            echo "<script> var z = confirm('Evento registrado con exito ¿Agregar otro?'); 
                if (z == true) {
                   location.href='NuevoEvento.php'
                 } else {
                   location.href='index.php'
                }
                </script>";
            }else{
                echo "<script>alert ('El evento no se pudo registrar');</script>";

            } 
    }  


}
        
         


   

