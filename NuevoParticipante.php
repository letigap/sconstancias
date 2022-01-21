<?php
    //Inicio la session
    // session_start();

    // // //COMPRUEBA QUE EL USUARIO ESTA AUTENTIFICADO
    //  if (!$_SESSION['email']) {
    //          //si no existe, envío a la página de autentificación
    //          header("Location: login.php");
    //          exit();
    //  }
require_once("include/header.php");
include_once("include/dbConexion.php");
include_once("include/validar_participante.php");

#consulta para eventos
$sql="select IdEvento, NombreEvento FROM evento";
$eventos = getDatos($sql);
?>
<!--Vista del formulario-->
<body>
    <h2 class="p-2 text-center">Registro nuevo participante</h2>
<main class="container">
<form class="form-evento" id="form_participante" action="NuevoParticipante.php" method="POST">
<div class="form-row">
<div class="form-group col-md-10">
    <label for="RfcParticipante">RFC del participante</label>
    <input type="text" class="form-control <?= (isset($errores['RfcParticipante'])) ? 'is-invalid' : '' ?>" name="RfcParticipante" id="RfcParticipante" placeholder="RFC del participante">
     <div class="invalid-feedback">
       <span>
        <?php
        if(isset($errores['RfcParticipante']) && !empty($errores['RfcParticipante'])){
         foreach($errores['RfcParticipante'] as $tipo => $mensaje) {
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
    <label for="NombreParticipante">Nombre de Participante</label>
    <input type="text" class="form-control <?= (isset($errores['NombreParticipante'])) ? 'is-invalid' : '' ?>" name="NombreParticipante" id="NombreParticipante" placeholder="Nombre del participante">
        <div class="invalid-feedback">
        <span>
         <?php
          if(isset($errores['NombreParticipante']) && !empty($errores['NombreParticipante'])){
            foreach($errores['NombreParticipante'] as $tipo => $mensaje) {
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
    <label for="ApellidopParticipante">Apellido Paterno Participante</label>
    <input type="text" class="form-control <?= (isset($errores['ApellidopParticipante'])) ? 'is-invalid' : '' ?>" name="ApellidopParticipante" id="ApellidopParticipante" placeholder="Apellido Paterno">
        <div class="invalid-feedback"><span>
        <?php
            if(isset($errores['ApellidopParticipante']) && !empty($errores['ApellidopParticipante'])){
              foreach($errores['ApellidopParticipante'] as $tipo => $mensaje) {
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
    <label for="ApellidomParticipante">Apellido Materno Participante</label>
    <input type="text" class="form-control <?= (isset($errores['ApellidomParticipante'])) ? 'is-invalid' : '' ?>" name="ApellidomParticipante" id="ApellidomParticipante" placeholder="Apellido Materno">
        <div class="invalid-feedback"><span>
        <?php
            if(isset($errores['ApellidomParticipante']) && !empty($errores['ApellidomParticipante'])){
              foreach($errores['ApellidomParticipante'] as $tipo => $mensaje) {
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
    <label for="EmailParticipante">Dirección de correo electrónico del participante</label>
    <input type="text" class="form-control <?= (isset($errores['EmailParticipante'])) ? 'is-invalid' : '' ?>" name="EmailParticipante" id="EmailParticipante" placeholder="Email">
        <div class="invalid-feedback"><span>
        <?php
            if(isset($errores['EmailParticipante']) && !empty($errores['EmailParticipante'])){
              foreach($errores['EmailParticipante'] as $tipo => $mensaje) {
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
    <label for="IdEvento">Elige Evento al que deseas inscribirte:</label>
      <select name="IdEvento" id="IdEvento" class="form-control <?= (isset($errores['IdEvento'])) ? 'is-invalid' : '' ?>">
        <option value="">-- N/A --</option>
            <?php foreach($eventos as $evento) {
                echo "<option value='{$evento['IdEvento']}'>{$evento['NombreEvento']}</option>";
            } ?>
      </select>
      <div class="invalid-feedback"><span>
            <?php
              if(isset($errores['IdEvento']) && !empty($errores['IdEvento'])){
                  foreach($errores['IdEvento'] as $tipo => $mensaje) {
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