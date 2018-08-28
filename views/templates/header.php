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
<div class="menu-action p_5 flex jc-sp-between ai-center primary-color">
  <div class="">
    <button class="btn-menu no-border"><i class="icon-menu fas fa-bars font-2"></i></button>
    <?php
      if (isset($_SESSION["checkSession"])) {
        if ($_SESSION["checkSession"] == "OK") {
    ?>
    <button class="btn-user no-border"><i class="fas fa-user font-2"></i></button>
    <?php
        }
      }
    ?>
  </div>
  <p>LOGO</p>
</div>

<!--=====================================================
  CABECERA QUE CONTIENE EL MENU PRINCIPAL
======================================================-->
<header class="header primary-color">
  <div class="container menu-container">
    <nav class="xmd-flex xmd-jc-sp-between xmd-ai-center">
      <p class="none xmd-block">LOGO</p>
      <ul class="menu xmd-flex">
        <li><a href="<?php printf($home); ?>" class="p-1">Home</a></li>
        <li><a href="<?php printf($home); ?>articulos" class="p-1">Articulos</a></li>
        <li><a href="https://www.youtube.com/channel/UC7bOCFjb5xZZj7YT-tmwd1g" target="_blank" class="p-1">Videos</a></li>
        <li><a href="<?php printf($home); ?>about-me" class="p-1">Acerca</a></li>

        <?php
          if (isset($_SESSION["checkSession"])) {
            if ($_SESSION["checkSession"] == "OK") {
        ?>
              <li class="btn-user none xmd-block user-image xmd-flex ai-center">
              <?php
                if($_SESSION['mode'] == "direct"){
                  $photo = "assets/images/usersimage/default.jpg";
                  if ($_SESSION['photo'] != "") {
                    $photo = $_SESSION['photo'];
                  }
                  printf('<img src="' .$home.$photo. '" alt="">');
                } else {
                  printf('<img src="' .$_SESSION['photo']. '" alt="">');
                }
              ?>
              </li>
        <?php
            }
          } else {
        ?>
            <li><a href="#login" class="p-1 login">Iniciar Sesión</a></li>
            <li><a href="#logup" class="p-1 logup">Registrate</a></li>
        <?php
          }
        ?>
      </ul>
    </nav>
    <?php
    if (isset($_SESSION["checkSession"])) {
      if ($_SESSION["checkSession"] == "OK") {
        require_once "header/usermenu.php";
      }
    }
    ?>
  </div>

</header>


<div class="header-shadow"></div>

<?php
if (!isset($_SESSION["checkSession"])) {



}
// INICIO DE SESSION
require_once "header/login.php";

// REGISTRO DE USUARIO
require_once "header/logup.php";

// OLVIDO DE CONTRASEÑA
require_once "header/forgotten-your-password.php";

// ALERTAS
require_once "header/alert.php";
?>
