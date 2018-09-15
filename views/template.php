<?php
  /*=======================================================
    VARIABLES DE LAS RUTAS PRINCIPALES
  =======================================================*/
  session_start();
  $home = Rutes::mainRute();
  $dashboard = Rutes::dashboardRute();

  /*=======================================================
    DATA OF OPEN GRAPH
  =======================================================*/
  $rutesOpen = array();


  if (isset($_GET['rute'])){
    $rutesOpen = explode("/", $_GET["rute"]);
    $ruteOpen = $rutesOpen[0];

  } else {
    $ruteOpen = "home";
  }

  $openGraph = TemplateController::findOpenGraph($ruteOpen);

  if (!$openGraph) {
    $ruteOpen = "home";
    $openGraph = TemplateController::findOpenGraph($ruteOpen);
  }

  //var_dump($openGraph);


?>
<!DOCTYPE html>
<html lang="es-mx">
  <head>
    <!--=====================================================
      METADATOS
    ======================================================-->
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <meta name="title" content="<?php printf($openGraph["title"]); ?>">
    <meta name="description" content="<?php printf($openGraph["description"]); ?>">
    <meta name="keywords" content="<?php printf($openGraph["keywords"]); ?>">
    <meta name="author" content="Francisco Hidalgo">

    <title><?php printf($openGraph["title"]); ?></title>

    <!--=====================================================
      OPEN GRAPH GOOGLE
    ======================================================-->
    <meta property="og:title" content="<?php printf($openGraph["title"]); ?>"/>
    <meta property="og:image" content="<?php printf($dashboard.$openGraph["cover"]); ?>"/>
    <meta property="og:description" content="<?php printf($openGraph["description"]); ?>"/>

    <!--=====================================================
      OPEN GRAPH FACEBOOK
    ======================================================-->
    <meta property="og:type" content="webSite"/>
    <meta property="og:url" content="<?php printf($home.$openGraph["rute"]); ?>"/>
    <meta property="og:title" content="<?php printf($openGraph["title"]); ?>"/>
    <meta property="og:description" content="<?php printf($openGraph["description"]); ?>"/>
    <meta property="og:image" content="<?php printf($dashboard.$openGraph["cover"]); ?>"/>

    <!--=====================================================
      OPEN GRAPH TWITTER
    ======================================================-->
    <meta name="twitter:card" content="summary"/>
    <meta name="twitter:site" content="@nytimesbits"/>
    <meta name="twitter:creator" content="@nickbilton"/>

    <!--=====================================================
      ETIQUETAS LINK
    ======================================================-->
    <link rel="shortcut icon" href="<?php printf($home."assets/images/bibliotecageekico.png") ?>" />
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
    <main class="container-fluid height-full">
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

        } else if ($rutes[0] == "home") {
          //require_once 'views/articles/index_articles.php';
        } else {
          require_once 'views/templates/error404.php';
        }


      } else {
        require_once 'views/articles/index_articles.php';
      }
      ?>
      <!--=====================================================
        PIE DE PAGINA
      ======================================================-->
      <?php require_once 'views/templates/footer.php';  ?>
    </main>



    <!--=====================================================
      SCRPTS (JAVASCRIPT)
    ======================================================-->
    <?php require_once 'helpers/scripts.php'; ?>
  </body>
</html>
