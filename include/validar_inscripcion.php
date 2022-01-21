<?php

$datos = $_POST;
 print_r($datos);


//SECCION DEL CODIGO PARA PROCESAR EL FORMULARIO
if (isset($_POST['agregar']) && !empty($_POST['agregar'])) {         
    $RfcParticipante = trim($_POST['RfcParticipante']);
    $IdEvento = trim($_POST['IdEvento']);

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

    if( vacio($IdEvento) ) {
        $errores['IdEvento']['obligatorio'] = "El evento es obligatorio";
    }


    if (empty($errores)) {

        $dbc = conexion();
        $sql = "SELECT * FROM inscripcionevento WHERE IdEvento = '$IdEvento' and RfcParticipante = '$RfcParticipante';";
        $resultado = $dbc->query($sql);  
        $numfilas = $resultado->num_rows;
        if($numfilas==0){
            // echo "<script>alert ('insertado');</script>";
            $query = 'INSERT INTO inscripcionevento (RfcParticipante, IdEvento, FechaInscripcion) VALUES (?, ?, ?)';

                $stmt = mysqli_prepare($dbc, $query);
                $hoy=date("Y") . "-" . date("m") . "-" . date("d")-1;
                mysqli_stmt_bind_param($stmt, 'sis',$RfcParticipante, $IdEvento, $hoy);
                    if (mysqli_stmt_execute($stmt)) {
                        echo "<script> var z = confirm('Registro realizado con exito'); 
                        location.href='InscripcionEvento.php'
                            // if (z == true) {
                            //    location.href='NuevoParticipante.php'
                            //  } else {
                            //    location.href='AgregarEvento.php'
                            // }
                            </script>";
                    }else{
                        echo "<script>alert ('El registro no se pudo realizar');</script>";
             
                    }

        }else{
            echo "<script> var z = confirm('El Participante ya esta registrado con el RFC introducido en dicho evento.');
            location.href='InscripcionEvento.php' 
            // if (z == true) {
            //    location.href='AgregarParticipante.php'
            //  } else {
            //    location.href='AgregarEvento.php'
            // }
            </script>";
        }
    }

}


