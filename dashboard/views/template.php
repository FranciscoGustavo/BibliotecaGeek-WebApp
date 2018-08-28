<?php
  $rute = Rutes::mainRute();
  $dashboard = Rutes::dashboardRute();
  session_start();
?>
<!DOCTYPE html>
<html lang="es-mx">
  <head>
    <!--=====================================================
      ETIQUETAS META
    ======================================================-->
    <meta charset="UTF-8">
    <meta name="description" content="Free Web tutorials">
    <meta name="keywords" content="HTML,CSS,XML,JavaScript">
    <meta name="author" content="Francisco Hidalgo">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Biblioteca Geek</title>

    <!--=====================================================
      LINKS
    ======================================================-->
    <link href="https://fonts.googleapis.com/css?family=Roboto" rel="stylesheet">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.0.13/css/all.css">
    <link rel="stylesheet" href="<?php printf($dashboard); ?>assets/css/library-full-min-v1.0.css">
    <link rel="stylesheet" href="<?php printf($dashboard); ?>assets/css/login/login.css">
    <link rel="stylesheet" href="<?php printf($dashboard); ?>assets/css/templates/header.css">
    <link rel="stylesheet" href="<?php printf($dashboard); ?>assets/css/templates/menu.css">
    <link rel="stylesheet" href="<?php printf($dashboard); ?>assets/css/main/main.css">
    <link rel="stylesheet" href="<?php printf($dashboard); ?>assets/css/main/articles.css">
    <link rel="stylesheet" href="<?php printf($dashboard); ?>assets/css/main/editar.css">

  </head>
  <body>
    <div class="page-main">
    <?php
      if (!isset($_SESSION["adminCheckSession"])) {
        include 'views/login/login.php';
      } else {
        /*=======================================================
          HEADER Y MENU
        =======================================================*/
        include 'views/templates/header.php';
        include 'views/templates/menu.php';

        $rutes = array();
        $item = null;
        $value =  null;

        /*=======================================================
          CONTENIDO DINAMICO DE LA PAGINA
        =======================================================*/
        printf('<main>');

        if (isset($_GET['rute'])){
          $rutes = explode("/", $_GET["rute"]);

          /*=======================================================
            URL'S AMIGABLES DE ARTICULOS
          =======================================================*/



          if($rutes[0] == "salir"){
            require_once 'views/login/'.$rutes[0].'.php';

          } else if($rutes[0] == "articles" ||
                    $rutes[0] == "comments" ||
                    $rutes[0] == "categories" ||
                    $rutes[0] == "users" ||
                    $rutes[0] == "editar" ||
                    $rutes[0] == "crear"){
            require_once 'views/main/'.$rutes[0].'.php';

          } else {
            require_once 'views/templates/error404.php';
          }
        } else {
          require_once 'views/main/main.php';
        }
        printf('</main>');

        /*=======================================================
          PIE DE PAGINA
        =======================================================*/
      }
    ?>
    </div>

    <!--=====================================================
      SCRPTS (JAVASCRIPT)
    ======================================================-->
    <script src="<?php printf($dashboard) ?>assets/js/templates/menu.js"></script>
    <script src="<?php printf($dashboard) ?>assets/js/main/articles.js"></script>
    <script src="<?php printf($dashboard) ?>assets/js/main/edit.js"></script>
    <script src="<?php printf($dashboard) ?>assets/js/main/savearticle.js"></script>
    <script src="<?php printf($dashboard) ?>assets/js/main.js"></script>

  </body>
</html>
