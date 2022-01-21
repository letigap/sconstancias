 <?php
//Inicio la session
    //  session_start();

    //  //COMPRUEBA QUE EL USUARIO ESTA AUTENTIFICADO
    //   if (!$_SESSION['email']) {
    //           //si no existe, envío a la página de autentificación
    //           header("Location: login.php");
    //           exit();
    //   } 
require_once("include/header.php");
include_once("include/dbConexion.php");
include_once("include/validar_evento.php");


#Consulta para el tipo de evento
$sql="SELECT * FROM tipoevento";
$tipos = getDatos($sql);

?>


<!-- Vista del formulario-->
<body>
    <h2 class="p-2 text-center">Registra Nuevo Evento</h2>
    <main class="container">
    <form class="form-evento" id="myform" action="NuevoEvento.php" method="POST">
            <div class="form-row">
                <div class="form-group col-md-10">
                <label for="IdTipoEvento">Tipo de evento</label>
                <select name="IdTipoEvento" id="IdTipoEvento" class="form-control <?= (isset($errores['IdTipoEvento'])) ? 'is-invalid' : '' ?>">
                        <option value="">-- N/A --</option>
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
            <div class="form-row">
                <div class="form-group col-md-10">
                    <label for="NombreEvento">Nombre del evento</label>
                    <input type="text" class="form-control <?= (isset($errores['NombreEvento'])) ? 'is-invalid' : '' ?>" name="NombreEvento" id="NombreEvento" placeholder="Nombre de evento">
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
                    <label for="ProfesorEvento">Nombre del Profesor del evento</label>
                    <input type="text" class="form-control <?= (isset($errores['ProfesorEvento'])) ? 'is-invalid' : '' ?>" name="ProfesorEvento" id="ProfesorEvento" placeholder="Nombre del profesor del evento">
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
                <label for="ProcedenciaProfeEvento">Procedencia del profesor del evento</label>
                    <input type="text" class="form-control <?= (isset($errores['ProcedenciaProfeEvento'])) ? 'is-invalid' : '' ?>" name="ProcedenciaProfeEvento" id="ProcedenciaProfeEvento" placeholder="Procedencia del Profesor de evento">
                    <div class="invalid-feedback"><span>
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
                    <input type="text" class="form-control <?= (isset($errores['FechaEvento'])) ? 'is-invalid' : '' ?>" name="FechaEvento" id="FechaEvento" placeholder="La fecha de realización del evento">
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
                    <input type="text" class="form-control <?= (isset($errores['CoordinadorEvento'])) ? 'is-invalid' : '' ?>" name="CoordinadorEvento" id="CoordinadorEvento" placeholder="Coordinador de evento">
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
            <div class="mb-4">
            <button name="agregar" value="agregar" type="submit" class="btn btn-primary">Guardar</button>
            <a href="cerrar.php" class="btn btn-primary">Salir</a>
            </div>
    </form>
</main>

<?php
require_once ("include/footer.php");
