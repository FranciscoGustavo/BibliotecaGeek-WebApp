<ul class="menu-user">
  <li class="flex jc-center ai-center">
    <?php
      if($_SESSION['mode'] == "direct"){
        $photo = "assets/images/usersimage/default.jpg";
        if ($_SESSION['photo'] != "") {
          $photo = $_SESSION['photo'];
        }
        printf('<img src="'.$home.$photo.'" alt="">');
      } else {
        printf('<img src="' .$_SESSION['photo']. '" alt="">');
      }
    ?>
    <div class="p-1">
      <p><?php printf($_SESSION["username"]); ?></p>
      <p><?php printf($_SESSION["email"]); ?></p>
    </div>
  </li>
  <li><a href="<?php printf($home); ?>perfil">Ver perfil</a></li>
  <?php
    if ($_SESSION['mode'] == "direct") {
      echo '<li><a href="'.$home.'salir">Salir</a></li>';
    } else if ($_SESSION['mode'] == "facebook") {
      echo '<li><a class="btn-logout" a href="'.$home.'salir">Salir</a></li>';
    } else {
      echo '<li><a href="'.$home.'salir">Salir</a></li>';
    }

  ?>

</ul>
