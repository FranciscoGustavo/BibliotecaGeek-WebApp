<!--=====================================================
  VALIDAR QUE LA SESION EXISTA
======================================================-->
<?php
  if (!isset($_SESSION["checkSession"])) {
    printf('<script>
      window.location = "'.$home.'"
    </script>');

    exit();
  }
?>


<div class="container p_5 lg-flex lg-p-0">

  <div class="col-12 col-lg-5 profile-container m-auto lg-m-0">

    <div class="photo p-1 flex jc-center flex-wrap">
      <?php
        if($_SESSION['mode'] == "direct"){

          $photo = $home."assets/images/users/default/default.jpg";

          if ($_SESSION['photo'] != "") {
            $photo = $_SESSION['photo'];
          }

        } else {
          $photo = $_SESSION['photo'];
        }
      ?>

      <img src="<?php printf($photo); ?>" alt="">

      <?php if ($_SESSION["mode"] == "direct") {
      ?>
      <button class="none btn-photo"><i class='fas fa-camera'></i></button>
      <div class="info-edit none">

        <form method="post" enctype="multipart/form-data">
          <div class="col-12 block txt-center">
            <button class="btn-edit-profile save" type="submit">
              Guardar Perfil
            </button>
          </div>
          <input class="none" type="file" id="editcover" name="editCover">
          <input type="hidden" name="cover" value="<?php printf($_SESSION["cover"]); ?>'">
          <input class="none inputPhoto" type="file" id="editimage" name="editImage">
          <input type="hidden" name="photo" value="<?php printf($_SESSION["photo"]); ?>">
          <input type="hidden" name="hiddenUserId" value="<?php printf($_SESSION['id']) ?>">
          <input class="input-edit input-username" type="text" name="editUsername" value="<?php printf($_SESSION['username']); ?>">
          <input class="input-edit input-email" type="email" name="editEmail" value="<?php printf($_SESSION['email']); ?>">
          <input class="input-edit input-username" type="password" name="editPasword" placeholder="Escribe tu contraseña">
          <input type="hidden" name="hiddenPasword" value="<?php printf($_SESSION['password']) ?>">
        </form>


      </div>
      <?php
      } ?>

      <?php
        $updateProfile = new UserController();
        $updateProfile->updateProfile();
      ?>
      <div class="info">
        <?php if ($_SESSION["mode"] == "direct") {?>
        <div class="col-12 block txt-center">
          <button class="btn-edit-profile edit">
            Editar Perfil
          </button>
        </div>
      <?php } ?>

        <h3 class="txt-center col-12 block username">
          <?php printf($_SESSION['username']); ?>
        </h3>

        <h4 class="txt-center col-12 block email">
          <?php printf($_SESSION['email']); ?>
        </h4>

      </div>

      <div class="col-12 txt-center sing-out">
        <?php
          if ($_SESSION['mode'] == "facebook") {
        ?>
        <a class="btn-logout-two" href="'.$home.'salir">
          Salir
        </a>
        <?php
          } else {
        ?>
        <a href="<?php printf($home.'salir'); ?>">
          Salir
        </a>
        <?php
          }
        ?>
      </div>
    </div>

    <div class="options font-0">
      <div class="col-6 i-b">
        <button class="font-1 btnfavoritesprofile" data-status="wait" data-user="<?php printf($_SESSION['id']) ?>">
          <i class="fas fa-heart font-1_5"></i>
          <p>
            Favoritos
          </p>
        </button>
      </div>
      <div class="col-6 i-b">
        <button class="font-1 btncommentsprofile" data-status="wait">
          <i class="fas fa-comments font-1_5"></i>
          <p>Commentarios</p>
        </button>
      </div>
    </div>

  </div>

  <div class="col-12 dinamic-content m-auto lg-m-0">
    <div class="content-favorites flex flex-wrap jc-sp-around col-12">

    </div>
    <div class="content-comments flex flex-wrap jc-sp-around col-12">

    </div>
  </div>

</div>
