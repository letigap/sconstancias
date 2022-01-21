<?php

$datos = $_POST;
//   print_r($datos);

  $mensaje = '';

 //SECCION DEL CODIGO PARA PROCESAR EL FORMULARIO
 if (isset($_POST['enviar']) && !empty($_POST['enviar'])) {
             
     $nombre = trim($_POST['nombre']);
     $email = trim($_POST['email']);
     $password = trim($_POST['password']);
     $password_confirm = trim($_POST['password_confirm']);
     
     //var_dump(vacio($nombre));
     $errores = [];
     if( vacio($nombre) ) {
         $errores['nombre']['obligatorio'] = "El nombre es obligatorio";
     } elseif(!filter_var($nombre, FILTER_VALIDATE_REGEXP, ['options' => ['regexp' => "/^[a-zA-ZáéíóúAÉ'-.\s ]+$/i"]])) {
        //Nombre puede tener letras . ' (espacios) - 
        $errores['nombre'][] = "El nombre no es válido";
     }elseif (strlen($nombre) > 200) {
         $errores['nombre'][] = "El nombre puede tener máximo 200 caracteres";
     }

     if( vacio($email) ) {
         $errores['email']['obligatorio'] = "El Email es obligatorio";
     }elseif(!filter_var($email, FILTER_VALIDATE_EMAIL)) {
         $errores['email']['formato'] = "El email no es válido";
     }elseif (strlen($email) > 200) {
         $errores['email'][] = "El Email puede tener máximo 100 caracteres";
     }

     if( vacio($password) ) {
         $errores['password']['obligatorio'] = "La contraseña es obligatorio";
     } elseif (strlen($password) < 8) {
         $errores['password'][] = "La contraseña debe tener al menos 8 caracteres";
     }
     if( vacio($password_confirm) ) {
         $errores['password_confirm']['obligatorio'] = "Confirme la contraseña";
     } elseif ($password != $password_confirm){
         $errores['password'][] = "La contraseña y su confirmacion no coinciden";
     }

     
 

     //Si no hay errores, guardamos el registro en la base de datos
     if (empty($errores)) {

         $dbc = conexion();

         //Busco si existe el emai en la base de datos

            $query = 'SELECT * FROM usuarios WHERE email = ? AND estatus = "1"';
            $stmt = mysqli_prepare($dbc, $query);
            mysqli_stmt_bind_param($stmt, 's' , $email);
            mysqli_stmt_execute($stmt);
            $result = mysqli_stmt_get_result($stmt);

            if ($result) {
                
                $numRows = mysqli_affected_rows($dbc);
                
                if($numRows) {
                    echo "<script>alert ('El email ya existe en la base de datos');
                    location.href='login.php'
                    </script>";
                } 
            
                else{
                        $query = 'INSERT INTO usuarios (nombre, email, password, estatus) VALUES (?, ?, ?, ?)';

                        $stmt = mysqli_prepare($dbc, $query);

                        //Crear el hash de la contraseña
                        $password_hash = password_hash($password, PASSWORD_DEFAULT);

                        mysqli_stmt_bind_param($stmt, 'ssss', $nombre, $email, $password_hash, $estatus);
                        $estatus = '1'; // 1 = Usuario activo, 0 = inactivo

                        if (mysqli_stmt_execute($stmt)) {
                            echo "<script>alert ('El usuario se registro exitosamente');
                            location.href='login.php'
                            </script>";
                        } else {
                            $mensaje = "El usuario no se pudo registrar";
                            // echo "<script>alert ('El usuario no se pudo registrar');</script>";
                            
                        }
                }
            }

     }

 }
