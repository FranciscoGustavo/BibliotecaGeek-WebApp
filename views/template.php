<?php
  $home = Rutes::mainRute();
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
      ETIQUETAS LINK
    ======================================================-->
    <?php require_once 'helpers/links.php'; ?>

  </head>
  <body>
    <!--=====================================================
      HEADER Y MENU
    ======================================================-->
    <?php require_once 'views/templates/header.php';  ?>

    <!--=====================================================
      CONTENIDO DINAMICO DE LA PAGINA
    ======================================================-->
    <main class="container-fluid">
      <?php
      $rutes = array();
      $item = null;
	    $value =  null;

      if (isset($_GET['rute'])){
        $rutes = explode("/", $_GET["rute"]);


        /*=======================================================
          URL'S AMIGABLES DE CATEGORIAS
        =======================================================*/
        $item = "categories";
        $value =  $rutes[0];
        $ruteSubCategories = ArticleController::rutesCategories($value, $item);
        if ($ruteSubCategories == null) {

          /*=======================================================
            URL'S AMIGABLES DE SUBCATEGORIAS
          =======================================================*/
          $item = "subcategories";
          $value =  $rutes[0];
          $ruteSubCategories = ArticleController::rutesCategories($value, $item);
        }

        /*=======================================================
          URL'S AMIGABLES DE ARTICULOS
        =======================================================*/
        $item = "articles";
        $value =  $rutes[0];
        $ruteArticles = ArticleController::rutesCategories($value, $item);


        /*=======================================================
          LISTA BLANCA DE URL'S AMIGABLES
        =======================================================*/
        if ($rutes[0] == "articulos" || $ruteSubCategories != null ) {
          require_once 'views/articles/main_articles.php';

        } elseif ($ruteArticles != false) {
          require_once 'views/articles/article.php';

        } else if($rutes[0] == "verificar" || $rutes[0] == "salir" || $rutes[0] == "perfil"){
          require_once 'views/users/'.$rutes[0].'.php';

        } else {
          require_once 'views/templates/error404.php';
        }


      } else {
        require_once 'views/articles/index_articles.php';
      }
      ?>
    </main>

    <!--=====================================================
      PIE DE PAGINA
    ======================================================-->
    <?php require_once 'views/templates/footer.php';  ?>

    <!--=====================================================
      SCRPTS (JAVASCRIPT)
    ======================================================-->
    <?php require_once 'helpers/scripts.php'; ?>
  </body>
</html>
