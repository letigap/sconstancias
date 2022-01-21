<?php
    //Inicio la session
    session_start();

   // //COMPRUEBA QUE EL USUARIO ESTA AUTENTIFICADO
    //if (!$_SESSION['user_id']) {
            //si no existe, envío a la página de autentificación
      //      header("Location: login.php");
        //    exit();
    //}

   include("includes/mis_funciones.php");
   include("includes/funciones_db.php");
   include("includes/config.php");

$dbc = conectar_db();

$query = "
SELECT e.id_evento, e.img_evento, e.nombre_evento as evento, e.descripcion_evento, e.fecha_evento, e.cartel_evento, e.organizador_evento, e.sede_evento, te.nombre_tevento, cc.nombre_cconocimiento
FROM evento e 
INNER JOIN tipo_evento te 
ON e.id_tevento = te.id_tevento
INNER JOIN campo_conocimiento cc
ON  e.id_cconocimiento = cc.id_cconocimiento 
ORDER BY nombre_evento;
";

$result = mysqli_query ($dbc, $query);
if ($result) { 

    $numRows = mysqli_affected_rows($dbc);

    if ($numRows) {
        
        $eventos = mysqli_fetch_all($result, MYSQLI_ASSOC);
    }

}

//PRESENTACION o VISTA HTML
include ("includes/encabezado.php");
?>
    <h2>Eventos</h2>

    <div class="container">

<?php
 foreach ($eventos as $evento) {
     ?>
     <div class="card mb-3" style="max-width: 90%;">
        <div class="row no-gutters">
          <div class="col-md-4">
           <img  alt="imagen" src="<?=$evento['img_evento']?>">
         </div>
        <div class="col-md-8">
          <div class="card-body">
            <h5 class="card-title"><?= $evento['evento'] ?></h5>
            <div class="card-text"><?= $evento['descripcion_evento'] ?>
    
               Organizador: <?= $evento['organizador_evento'] ?><br>
               Tipo de Evento:<?= $evento['nombre_tevento'] ?><br/>
              <a href="<?= $evento['cartel_evento'] ?>">Programa en pfd</a>
              <p><?= $evento['sede_evento'] ?></p>
              Campo de Conocimiento: <?= $evento['nombre_cconocimiento'] ?>
            </div>
           <p class="card-text"><small class="text-muted"><?= $evento['fecha_evento'] ?></small></p>
          </div>
        </div>
      </div>
</div>
     
       <?php 
    }
    ?>
    </div>
<?php

include ("includes/pie.php");
?>

