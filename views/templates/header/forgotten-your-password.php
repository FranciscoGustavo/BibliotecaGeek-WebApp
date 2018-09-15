<!--=====================================================
  OLVIDO DE CONTRASEÑA
======================================================-->
<?php
  $forgotten = new UserController();
  $forgotten -> forgotten();
?>

<div class="container-password">
  <div id="forgotten-your-password" class="col-6 p-1 m-auto form-container">

    <button class="closeModal"><i class="fas fa-times"></i></button>
    <h4 class="txt-center">Olvidaste tu contraseña</h4>
    <div class="errors-form"></div>

    <div class="form">
      <form method="post">

        <div class="input-form font-0">
          <input class="no-border i-b col-10" type="email" name="forgottenEmail" placeholder="Correo electronico">
          <label class="i-b col-2 txt-center" for="">
            <i class="fas fa-at font-1"></i>
          </label>
        </div>

        <div class="input-buttons">
          <input type="submit" name="" value="Acceder">
        </div>

      </form>
    </div>

  </div>
</div>
