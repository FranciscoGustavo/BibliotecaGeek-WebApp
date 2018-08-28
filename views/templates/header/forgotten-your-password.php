<!--=====================================================
  OLVIDO DE CONTRASEÑA
======================================================-->
<?php
  $forgotten = new UserController();
  $forgotten -> forgotten();
?>
<div id="forgotten-your-password" class="col-6 p-1 m-auto form-container">
  <button class="closeModal"><i class="fas fa-times"></i></button>
  <h4 class="txt-center">Olvidaste tu contraseña</h4>
  <div class="errors-form"> </div>
  <div class="form">
    <form method="post">
      <div class="input-form">
        <input type="email" name="forgottenEmail">
        <label for="">Escribe tu correo electronico</label>
      </div>
      <div class="input-button">
        <input class="second-color-dark" type="submit" name="" value="Acceder">
      </div>
    </form>
  </div>
</div>
