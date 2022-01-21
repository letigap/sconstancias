<?php

$datos = $_POST;
  print_r($datos);

//SECCION DEL CODIGO PARA PROCESAR EL FORMULARIO
if (isset($_POST['agregar']) && !empty($_POST['agregar'])) {         
    $RfcParticipante = trim($_POST['RfcParticipante']);
    $NombreParticipante = trim($_POST['NombreParticipante']);
    $ApellidopParticipante = trim($_POST['ApellidopParticipante']);
    $ApellidomParticipante = trim($_POST['ApellidomParticipante']);
    $EmailParticipante = trim($_POST['EmailParticipante']);
    $IdEvento = $_POST['IdEvento'];
    
    
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


    if (empty($errores)) {

        $dbc = conexion();
        $sql = "SELECT * FROM participante WHERE EmailParticipante = '$EmailParticipante' or RfcParticipante = '$RfcParticipante';";
        $resultado = $dbc->query($sql);  
        $numfilas = $resultado->num_rows;
        if($numfilas==0){
             $query = 'INSERT INTO participante (RfcParticipante, NombreParticipante, ApellidopParticipante, ApellidomParticipante, EmailParticipante) VALUES (?, ?, ?, ?, ?)';

            $stmt = mysqli_prepare($dbc, $query);

            mysqli_stmt_bind_param($stmt, 'sssss',$RfcParticipante, $NombreParticipante, $ApellidopParticipante, $ApellidomParticipante, $EmailParticipante);
            if (mysqli_stmt_execute($stmt)) {
                echo "<script> var z = confirm('Registro  de participante realizado con exito'); 
                // location.href='InscripcionEvento.php'
                </script>";

                $sql2 = "SELECT * FROM inscripcionevento WHERE IdEvento = '$IdEvento' and RfcParticipante = '$RfcParticipante';";
                $resultado2 = $dbc->query($sql2);  
                $numfilas2 = $resultado2->num_rows;
                if($numfilas2==0){
                    // echo "<script>alert ('insertado');</script>";
                    $query2 = 'INSERT INTO inscripcionevento (IdEvento, RfcParticipante, FechaInscripcion) VALUES (?, ?, ?)';
        
                        $stmt2 = mysqli_prepare($dbc, $query2);
                        $hoy=date("Y") . "-" . date("m") . "-" . date("d")-1;
                        mysqli_stmt_bind_param($stmt2, 'iss',$IdEvento, $RfcParticipante, $hoy);
                            if (mysqli_stmt_execute($stmt2)) {
                                echo "<script> var z = confirm('Inscripción realizada con exito'); 
                                 location.href='inicio.php'
                                    // if (z == true) {
                                    //    location.href='NuevoParticipante.php'
                                    //  } else {
                                    //    location.href='AgregarEvento.php'
                                    // }
                                    </script>";
                            }else{
                                echo "<script>alert ('La inscripción no se pudo realizar');</script>";
                    
                            }
                }else{
                    echo "<script>alert ('YA EXISTE UNA INSCRIPCION DE PARTICIPANTE A ESE EVENTO');</script>";
                    
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
        }else{
            echo "<script> var z = confirm('El Participante ya esta registrado con el RFC introducido.');
            location.href='InscripcionEvento.php' 
            if (z == true) {
               location.href='InscripcionEvento.php'
             } else {
               location.href='NuevoParticipante.php'
            }
            </script>";
        }
    }// if errores

}//if isset


