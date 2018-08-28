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

<div class="container">

  <div class="tabs-container p_5">
    <!--=====================================================
      EL CONTROLADOR DE LAS TABS
    ======================================================-->
    <nav class="tabs-control">
      <a href="#porfile" class="flex ai-center txt-center">Editar Perfil</a>
      <a href="#favorites" class="flex ai-center txt-center">Favoritos</a>
      <a href="#comments" class="flex ai-center txt-center">Comentarios</a>
    </nav>

    <!--=====================================================
      TABS
    ======================================================-->
    <div class="tabs">
      <div class="container">

        <!--=====================================================
          EDITAR PERFIL
        ======================================================-->
        <div class="tab porfile" id="porfile">
          <form method="post" enctype="multipart/form-data">

            <div class="portada m-auto">
              <figure>
                <?php
                  $cover = "assets/images/usersimage/default.jpg";
                  if($_SESSION['cover'] != ""){
                    $cover = $_SESSION['cover'];
                  }

                  printf('<img class="portada-image" src="'.$home.$cover.'" alt="">');

                  if($_SESSION['mode'] == "direct"){
                    printf('<label for="editcover" class="btn-edit-portada disable"><i class="fas fa-camera"></i> Editar</label>');
                    printf('<input class="none" type="file" id="editcover" name="editCover">');
                    printf('<input type="hidden" name="cover" value="'.$_SESSION['cover'].'">');
                  }
                ?>
              </figure>
              <?php
                if($_SESSION['mode'] == "direct"){
                  $photo = "assets/images/usersimage/default.jpg";
                  if ($_SESSION['photo'] != "") {
                    $photo = $_SESSION['photo'];
                  }
                  printf('<img class="user-image-tab" src="' .$home.$photo. '" alt="">');
                  printf('<label for="editimage" class="btn-edit-image disable"><i class="fas fa-camera font-2"></i></label>');
                  printf('<input class="none" type="file" id="editimage" name="editImage">');
                  printf('<input type="hidden" name="photo" value="'.$_SESSION['photo'].'">');
                } else {
                  printf('<img class="user-image-tab" src="'.$_SESSION['photo'].'" alt="">');
                }
              ?>
            </div>

            <div class="user-info col-12 col-lg-4 m-auto">

              <div class="info-username txt-center">
                <h4 class="font-1 lg-font-1_25 active"><?php printf($_SESSION["username"]) ?></h4>
                <?php
                  if($_SESSION['mode'] == "direct"){
                    printf('<input class="disable" type="text" name="editUsername" value="'.$_SESSION["username"].'">');
                  }
                ?>
              </div>

              <div class="info-email lg-font-1_25 txt-center">
                <h4 class="font-1 lg-font-1_25 active"><?php printf($_SESSION["email"]) ?></h4>
                <?php
                  if($_SESSION['mode'] == "direct"){
                    printf('<input class="disable" type="text" name="editEmail" value="'.$_SESSION["email"].'">');
                  }
                ?>
              </div>

              <?php if ($_SESSION['mode'] == "direct"): ?>
                <div class="info-password disable lg-font-1_25 txt-center">
                  <h4 class="font-1 lg-font-1_25">Cambiar Contraseña</h4>
                  <input type="password" name="editPasword" placeholder="Escribe tu contraseña">
                  <input type="hidden" name="hiddenPasword" value="<?php printf($_SESSION['password']) ?>">
                </div>
              <?php endif; ?>

              <div class="info-time txt-center">
                <h3 class="font-1 lg-font-1_25">Miembro desde: <?php printf($_SESSION["time"]) ?></h4>
              </div>

              <div class="p-1 txt-center">
                <input type="hidden" id="hiddenuserid" name="hiddenUserId" value="<?php printf($_SESSION['id']); ?>">
                <?php
                  if($_SESSION['mode'] == "direct"){
                ?>
                <button id="editprofile" class="no-border btn-edit-profile second-color-dark active">Editar</button>
                <button id="saveprofile" class="no-border btn-save-profile second-color-dark disable">Guardar</button>
                <?php
                  } else {
                ?>
                <button class="logup-social-media" type="button">Registrado con <?php printf($_SESSION['mode']); ?></button>
                <?php
                  }
                ?>
              </div>

            </div>

          </form>

          <?php
            $updateProfile = new UserController();
            $updateProfile->updateProfile();
          ?>

          <div class="config m-auto">
            <div class="second-color p_5 xmd-p-1">
              <h4>Configuración</h4>
            </div>
            <div class="p_5 xmd-p-1 notifications">
              <?php if ($_SESSION['notifications'] == 1) {
                $checkNotifications = "checked";
              } else {
                $checkNotifications = "";
              } ?>
              <input type="checkbox" id="notifications" <?php printf($checkNotifications); ?>>
              <label for="notifications">Notificaciones</label>
            </div>
            <div class="p_5 xmd-p-1 news">
              <?php if ($_SESSION['news'] == 1) {
                $checkNews = "checked";
              } else {
                $checkNews = "";
              } ?>
              <input type="checkbox" id="news" <?php printf($checkNews); ?>>
              <label for="news">Novedades</label>
            </div>
          </div>
        </div>

        <!--=====================================================
          FAVORITOS
        ======================================================-->
        <div class="tab" id="favorites">
          <div class="flex flex-wrap">
            <?php
              $favoritesArticles = UserModel::findFavoritesArticles($_SESSION['id']);
              if (count($favoritesArticles) == 0) {
                printf("<h1 class='txt-center font-3 col-12'>No hay articulos favoritos</h1>");
              } else {
            ?>
            <?php foreach ($favoritesArticles as $value) { ?>
              <div class="col-12 col-xmd-6 col-md-4 md-p_5 col-lg-3">
                <article class="article-card m-auto">
                  <div class="article information">
                    <a href="<?php printf($value["url"]); ?>">
                      <div class="image-container">
                        <img src="<?php printf($dashboard.$value["image"]); ?>" alt="">
                      </div>
                      <div class="article-title p_5">
                        <h3><?php printf($value["title"]); ?></h3>
                      </div>
                    </a>
                  </div>
                  <div class="outhor flex jc-sp-between p_5">
                    <a href="#">
                      <span><?php printf(substr($value["first_name"], 0, 13).'...'); ?></span>
                    </a>
                    <a href="#">
                      <span><?php printf(ArticleController::timesTampData($value["registration_date"])); ?></span>
                    </a>
                  </div>
                </article>
              </div>
            <?php }} ?>
          </div>
        </div>

        <!--=====================================================
          COMENTARIOS
        ======================================================-->
        <div class="tab" id="comments">
          <div class="flex flex-wrap">
        <?php
          $comments = UserController::findCommentsToUser($_SESSION['id']);
          foreach ($comments as $value) {
        ?>
          <div class="col-12 col-xmd-6 col-md-4 md-p_5 col-lg-3">
            <div class="comment">
              <div class="header-comment p_5 flex ai-center">
                <div class="user-image">
                  <img src="<?php printf($value['photo']); ?>" alt="">
                </div>
                <div class="user-name">
                  <h5><?php printf($value['username']); ?></h5>
                </div>
              </div>
              <div class="body-comment p_5">
                <?php
                if (isset($_SESSION["checkSession"])) {
                  if ($_SESSION["checkSession"] == "OK") {
                    if ($value['user_id'] == $_SESSION['id']) {
                ?>
                <textarea class="comment-<?php printf($value['comment_id']); ?>"><?php printf($value['comment']); ?></textarea>
                <input type="hidden" name="" value="<?php printf($value['comment']); ?>">
                <?php
                    }
                  }
                }
                ?>
                <p><?php printf($value['comment']); ?></p>
              </div>
              <div class="footer-comment">
                <?php
                if (isset($_SESSION["checkSession"])) {
                  if ($_SESSION["checkSession"] == "OK") {
                    if ($value['user_id'] == $_SESSION['id']) {
                ?>
                <button id="<?php printf($value['comment_id']); ?>" class="btn-edit-comment" type="button">Editar</button>
                <button class="btn-delete-comment" type="button">Eliminar</button>
                <?php
                    }
                  }
                }
                ?>
              </div>
            </div>
          </div>
        <?php } ?>
        </div>
      </div>

      </div>

    </div>

  </div>
</div>
