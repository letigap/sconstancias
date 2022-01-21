<?php
 session_start();
 $datos = $_POST;
// print_r($datos);
$mensaje = '';
//SECCION DEL CODIGO PARA PROCESAR EL FORMULARIO
// echo "<script> console.log('1');</script>";
 if (isset($_POST['enviar']) && !empty($_POST['enviar'])) {

// echo "<script> console.log('2');</script>";
// }else{
// echo "<script> console.log('2');</script>";

   $email = trim($_POST['email']);
   $password = trim($_POST['password']);
   
   $errores = [];
   
   if( vacios($email) ) {
       $errores['email']['obligatorio'] = "El Email es obligatorio";
   }

   if( vacios($password) ) {
       $errores['password']['obligatorio'] = "La contraseña es obligatorio";
   } 

   //Si no hay errores, guardamos el registro en la base de datos
   if (empty($errores)) {
    $params = parse_ini_file("db.conf.php");
   // print_r($params);

    $dbc = mysqli_connect($params['host'], $params['user'], $params['clave'], $params['dbnombre']);

       // $dbc = conexion();

       //1.Busco el usuario con ese email en la base de datos

       $query = 'SELECT * FROM usuarios WHERE email = ? AND estatus = "1"';
       $stmt = mysqli_prepare($dbc, $query);
       mysqli_stmt_bind_param($stmt, 's' , $email);
       mysqli_stmt_execute($stmt);
       $result = mysqli_stmt_get_result($stmt);

       if ($result) {
           $numRows = mysqli_affected_rows($dbc);
           
           if($numRows) { 
               $user = mysqli_fetch_array($result, MYSQLI_ASSOC);

               $crypted = password_hash($password, PASSWORD_DEFAULT);
               //Comparo la contraseña del formulario con la de la BD
               if (password_verify($password, $user['password'])) {
                 //El usuario es válido
                   $user['email'];
                   //$_SESSION['id_usuario'] = $user['id_usuario'];
                   $_SESSION['email'] = $user;
                   header("Location:./inicio.php");
               } else {
                     $errores['password']['obligatorio'] = "La contraseña es incorrecta";
               } 
           } else {
            $errores['email']['obligatorio'] = "Usuario incorrecto";

           }
           
       } else{
            $mensaje = "Los Datos son incorrectos";
       }

   }

 }

function vacios($valor) {
    if ($valor === 0 || $valor == '0') {
        return false;
    } 
    
    if (empty($valor)) {
        return true;
    } else {
        return false;
    }
}
?>
