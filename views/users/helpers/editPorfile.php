<div class="tab" id="edit-profile">
  <h2>Editar Perfil</h2>
  <div class="col-12 p-1 m-auto">

    <div class="errors-form"></div>

    <div class="info-user">
      <form id="edit-porfile">
        <div class="avatar">
          <input type="file" id="file-uploader" name="editImage">
          <?php
            if ($_SESSION["mode"] == "direct") {
              if ($_SESSION["photo"] != "") {
                printf('<div class="img" style="background-image: url('.$home.'assets/images/usersimage/'.$_SESSION["photo"].')"></div>');
              } else {
                printf('<div class="img" style="background-image: url(http://localhost/bibliotecageek/assets/images/default.jpg)"></div>');
              }
            }
          ?>

          <label for="file-uploader" class="avatar-selector flex jc-center ai-center">
            <i class="fa fa-camera" aria-hidden="true"></i>
          </label>
        </div>

        <div class="data-user p-1">
          <div class="input-form">
            <input type="text" class="non-empty" name="editUsername" value="<?php printf($_SESSION['username']); ?>">
            <label for="">Nombre de usuario</label>
          </div>
          <div class="input-form">
            <input type="text" class="non-empty" name="editEmail" value="<?php printf($_SESSION['email']); ?>">
            <label for="">Correo Electronico</label>
          </div>
          <div class="input-form">
            <input type="password" name="editPassword">
            <label for="">Cambiar contraseña</label>
          </div>
          <div class="input-form button">
            <button>Guardar</button>
          </div>
        </div>
      </form>
    </div>

  </div>
</div>
