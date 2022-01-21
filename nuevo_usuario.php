<?php
    include("includes/funciones_db.php");
    include("includes/mis_funciones.php");
    include("includes/config.php");

    $nombre = '';
    $email = '';
    $password = '';
    $password_confirm = '';
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
        } elseif(!filter_var($nombre, FILTER_VALIDATE_REGEXP, ['options' => ['regexp' => "/^[a-z'-.\s ]+$/i"]])) {
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

            $dbc = conectar_db();

            $query = 'INSERT INTO users (nombre, email, password, estatus) VALUES (?, ?, ?, ?)';

            $stmt = mysqli_prepare($dbc, $query);

            //Crear el hash de la contraseña
            $password_hash = password_hash($password, PASSWORD_DEFAULT);

            mysqli_stmt_bind_param($stmt, 'ssss', $nombre, $email, $password_hash, $estatus);
            $estatus = '1'; // 1 = Usuario activo, 0 = inactivo

            if (mysqli_stmt_execute($stmt)) {
              $mensaje = "Se insertó el usuario exitosamente";
            } else {
                $mensaje = "No se pudo insertar el usuario";
                 
            }


        }

    }


    //PRESENTACIÓN - VISTA
    include("includes/encabezado.php");
    ?>
    <h1>Nuevo Usuario</h1>

    <span style="color: #ed1b24">
     <?= $mensaje ?>
    </span>

    <form action="nuevo_usuario.php" method="POST">
    
    <label for="nombre">Nombre</label>
    <input type="text" name="nombre" value="<?= $nombre ?>"><br/>
    <span style="color: #ed1b24">
    <?php
    if(isset($errores['nombre']) && !empty($errores['nombre'])){
        foreach($errores['nombre'] as $tipo => $mensaje) {
            echo $mensaje;
        }
    }
    
    ?>
    </span><br/>

    <label for="email">Email</label>
    <input type="text" name="email" value="<?= $email ?>"><br/>
    <span style="color: #ed1b24">
    <?php
    if(isset($errores['email']) && !empty($errores['email'])){
        foreach($errores['email'] as $tipo => $mensaje) {
            echo $mensaje;
        }
    }
    ?>
    </span><br/>

    <label for="password">Contraseña</label></label>
    <input type="text" name="password" value="<?= $password ?>"><br/>
    <span style="color: #ed1b24">
    <?php
    if(isset($errores['password']) && !empty($errores['password'])){
        foreach($errores['password'] as $tipo => $mensaje) {
            echo $mensaje;
        }
    }
    ?>
    </span><br/>

    <label for="password_confirm">Confirma contraseña</label></label>
    <input type="text" name="password_confirm" value="<?= $password_confirm ?>"><br/>
    <span style="color: #ed1b24">
    <?php
    if(isset($errores['password_confirm']) && !empty($errores['password_confirm'])){
        foreach($errores['password_confirm'] as $tipo => $mensaje) {
            echo $mensaje;
        }
    }

    ?>
    </span><br/>

    

    <button type="submit" name="enviar" value="1">Enviar</button>
    </form>
   
    <?php
        include("includes/pie.php");
    ?>