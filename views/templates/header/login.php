<!--=====================================================
  INICIO DE SESION
======================================================-->
<?php
  $login = new UserController();
  $login -> loginUser();
?>
<div id="login" class="col-6 p-1 m-auto form-container">
  <button class="closeModal"><i class="fas fa-times"></i></button>
  <h4 class="txt-center">Iniciar Sesion</h4>
  <div class="errors-form">

  </div>
  <div class="social-media-login col-12">
    <div class="col-6">
      <a class="fb col-11 txt-center m-auto" href="#">Facebook</a>
    </div>
    <div class="col-6">
      <a class="gl col-11 txt-center m-auto" href="<?php echo $ruteGoogle; ?>">Google</a>
    </div>
  </div>
  <div class="form">
    <form method="post">
      <div class="input-form">
        <input type="email" name="loginEmail">
        <label for="">Correo Electronico</label>
      </div>
      <div class="input-form">
        <input type="password" name="loginPassword">
        <label for="">Contraseña</label>
      </div>
      <div class="input-chekbox">
        <input type="checkbox" name="loginRememberMe">
        <a href="#">Recordar Cuenta</a>
      </div>
      <div class="input-button">
        <a class="create-Account" href="#">¿Crear una cuenta?</a>
        <input class="direct second-color-dark" type="submit" name="" value="Acceder">
      </div>
    </form>
  </div>
  <div class="txt-center padding-top">
    <a class="forgotten-your-password" href="#">Has olvidado Tu contraseña</a>
  </div>
</div>
