<!--=====================================================
  REGISTRO DE USUARIO
======================================================-->
<?php
  $logup = new UserController();
  $logup -> logupUser();
?>
<div id="logup" class="col-6 p-1 m-auto form-container">
  <button class="closeModal"><i class="fas fa-times"></i></button>
  <h4 class="txt-center">Registrate</h4>
  <div class="errors-form"></div>
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
        <input type="text" name="logupUsername">
        <label for="">Nombre de usuario</label>
      </div>
      <div class="input-form">
        <input type="text" name="logupEmail">
        <label for="">Correo Electronico</label>
      </div>
      <div class="input-form">
        <input type="password" name="logupPassword">
        <label for="">Contraseña</label>
      </div>
      <div class="input-chekbox">
        <input type="checkbox" name="logupUserTerms" value="">
        <a href="#">terminos de usuario</a>
      </div>
      <div class="input-button">
        <a class="do-you-already-have-an-account" href="#">¿Ya tienes una cuenta?</a>
        <input class="second-color-dark" type="submit" name="" value="Acceder">
      </div>
    </form>
  </div>
</div>
