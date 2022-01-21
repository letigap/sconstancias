<?php
include_once("include/validarLogin.php");
include_once("include/dbConexion.php");
include_once("include/header.php");
?>

<div class="container justify-content-center">
<div class="row">
<div class="col-xs-12 col-sm-6 col-md-6">
<img class="img-fluid rounded mx-auto d-block m-5" alt="composición actividades" src="assets/img/composicion-actividades1.jpg"  style="max-width: 100%;height: auto;">
</div>
<div class="col-xs-12 col-sm-6 col-md-6 align-self-center">
<div class="card bg-light m-5">
  <div class="card-header" style="background-color: #006ba1;">Ingresar</div>
  <div class="card-body">
    <form class="p-4" action="login.php" method="POST">
        <div class="form-group">
          <label for="email">Dirección de correo electrónico</label>
          <input type="email" class="form-control" id="email" name="email" placeholder="email@example.com">
              <span style="color: #ed1b24">
              <?php
              if(isset($errores['email']) && !empty($errores['email'])){
                  foreach($errores['email'] as $tipo => $mensaje) {
                      echo $mensaje;
                  }
              }
              ?>
              </span>
        </div>
        <div class="form-group">
          <label for="password">Password</label>
          <input type="password" class="form-control" id="password"  name="password" placeholder="Password">
          <span style="color: #ed1b24">
          <?php
          if(isset($errores['password']) && !empty($errores['password'])){
              foreach($errores['password'] as $tipo => $mensaje) {
                  echo $mensaje;
              }
          }
          ?>
          </span>
        </div>
        <button type="submit" name="enviar" value="enviar" class="btn btn-primary">Ingresar</button>
  
      </form>
    </div>
  </div>
</div>
</div>
</div>
</div>
<?php
include_once("include/footer.php");
?>
