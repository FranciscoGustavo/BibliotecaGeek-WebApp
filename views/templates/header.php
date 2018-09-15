<!--=====================================================
  API DE GOOGLE
======================================================-->
<?php
  /***=====================================================
    CREAR OBJETO DE LA API
  ======================================================**/
  $client = new Google_Client();
  $client->setAuthConfig('models/client_secret.json');
  $client->setAccessType('offline');
  $client->setScopes(['profile','email']);

  /***=====================================================
    RUTA PARA EL LOGIN DE GOOGLE
  ======================================================**/
  $ruteGoogle = $client->createAuthUrl();

  /***=====================================================
    RECIBIMOS LA VARIABLE GET DE GOOGLE LLAMADA CODE
  ======================================================**/
  if (isset($_GET['code'])) {
    $token = $client->authenticate($_GET['code']);

    $_SESSION['id_token_google'] = $token;

    $client->setAccessToken($token);
    /***=====================================================
      RECIBIR DATOS CIFRADOS DE GOOGLE
    ======================================================**/
    if ($client->getAccessToken()) {
      $item = $client->verifyIdToken();

      $data = array(
        "username"=>$item['name'],
        "password"=>"null",
        "email"=>$item['email'],
        "photo"=>$item['picture'],
        "cover"=>"",
        "mode"=>"google",
        "check"=>0,
        "encryptedEmail"=>"null",
        "notifications" => 0,
        "news"=>0
      );

      $res = UserController::logupSocialMedia($data);

      if ($res == 'OK') {
        printf("
          <script>
            window.location = localStorage.getItem('currentRute');
          </script>
        ");
      }

    }
  }
?>

<!--=====================================================
  CABECERA RALATIVA SOLO ACTIVA EN DISPOSITIVOS MOBILES
======================================================-->
<div class="menu-action">
  <div class=" flex jc-sp-between ai-center p_5">
    <img class="logo" src="<?php printf($home."assets/images/bibliotecageek.png") ?>" alt="">
    <button class="btn-menu no-border">
      <i class="far fa-question-circle font-2"></i>
    </button>

    <?php
      if (isset($_SESSION["checkSession"])) {
        if ($_SESSION["checkSession"] == "OK") {
    ?>
    <!--button class="btn-user no-border"><i class="fas fa-user font-2"></i></button-->
    <?php
        }
      }
    ?>
  </div>
</div>

<!--=====================================================
  CABECERA QUE CONTIENE EL MENU PRINCIPAL
======================================================-->
<header class="header">
  <div class="container menu-container">
    <nav class="xmd-flex jc-sp-between ai-center">
      <img class="logo none xmd-block" src="<?php printf($home."assets/images/bibliotecageek.png") ?>" alt="">

      <ul class="menu col-xmd-9 col-md-7 col-xlg-6 col-lg-5">

        <li class="home">
          <a href="<?php printf($home); ?>" class="p-1">
            <i class="fas fa-home font-1_5 i-b v-middle"></i>
            <span class="i-b v-middle">Home</span>
          </a>
        </li>

        <li class="blog">
          <a href="<?php printf($home); ?>articulos" class="p-1">
            <i class="far fa-newspaper font-1_5 i-b v-middle"></i>
            <span class="i-b v-middle">Blog</span>
          </a>
        </li>

        <li class="youtube">
          <a href="https://www.youtube.com/channel/UC7bOCFjb5xZZj7YT-tmwd1g" target="_blank" class="p-1">
            <i class="fab fa-youtube font-1_5 i-b v-middle"></i>
            <span class="i-b v-middle">
              Canal
            </span>
          </a>
        </li>

        <?php
          if (isset($_SESSION["checkSession"])) {
            if ($_SESSION["checkSession"] == "OK") {
        ?>
              <li class="user">

                <a href="<?php printf($home."perfil"); ?>" class="p-1">
                  <i class="fas fa-user-circle font-1_5 i-b v-middle"></i>
                  <span class="i-b v-middle">
                    Perfil
                  </span>
                </a>

                <ul class="user-menu">

                  <li>
                  <?php
                    if ($_SESSION['mode'] == "direct") {
                      echo '<a class="p-1"  href="'.$home.'salir">';
                    } else if ($_SESSION['mode'] == "facebook") {
                      echo '<a class="p-1 btn-logout" href="'.$home.'salir">';
                    } else {
                      echo '<a class="p-1" href="'.$home.'salir">';
                    }
                  ?>
                      <i class="fas fa-sign-out-alt font-1_5 i-b v-middle"></i>
                      <span class="i-b v-middle">
                        Salir
                      </span>
                    </a>
                  </li>

                </ul>

              </li>
        <?php
            }
          } else {
        ?>
            <li>
              <a href="#login" class="p-1 login">
                <i class="fas fa-sign-in-alt font-1_5 i-b v-middle"></i>
                <span class="i-b v-middle">Entrar</span>
             </a>
             <a href="#logup" class="none logup"></a>
            </li>
        <?php
          }
        ?>
      </ul>
    </nav>
    <?php
    if (isset($_SESSION["checkSession"])) {
      if ($_SESSION["checkSession"] == "OK") {
        //require_once "header/usermenu.php";
      }
    }
    ?>
  </div>

</header>


<div class="header-shadow"></div>

<?php
if (!isset($_SESSION["checkSession"])) {
  // INICIO DE SESSION
  require_once "header/login.php";

  // REGISTRO DE USUARIO
  require_once "header/logup.php";

  // OLVIDO DE CONTRASEÑA
  require_once "header/forgotten-your-password.php";
}

// ALERTAS
require_once "header/alert.php";
?>
