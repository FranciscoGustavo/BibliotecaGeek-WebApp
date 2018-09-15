<!--=====================================================
  INICIO DE SESION
======================================================-->
<?php
  $login = new UserController();
  $login -> loginUser();
?>
<div class="container-login">

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

        <div class="input-form font-0">
          <input class="no-border i-b col-10" type="email" name="loginEmail" placeholder="Correo electronico">
          <label class="i-b col-2 txt-center" for="">
            <i class="fas fa-at font-1"></i>
          </label>
        </div>

        <div class="input-form font-0">
          <input class="no-border i-b col-10" type="password" name="loginPassword" placeholder="Contraseña">
          <label class="i-b col-2 txt-center" for="">
            <i class="fas fa-key"></i>
          </label>
        </div>

        <div class="input-buttons flex">
          <div class="col-6 flex ai-center">
            <a class="create-Account" href="#">¿Crear una cuenta?</a>
          </div>
          <div class="col-6 txt-right">
            <input class="direct" type="submit" value="Acceder">
          </div>
        </div>

      </form>
    </div>

    <div class="txt-center padding-top-1">
      <a class="forgotten-your-password" href="#">Has olvidado Tu contraseña</a>
    </div>
  </div>

</div>
