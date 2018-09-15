<!--=====================================================
  ARTICULOS DE LA PAGINA DE ARTICULOS
======================================================-->
<div class="container flex flex-wrap ">
  <!--=====================================================
    BUSCADOR Y LISTA DE CATEGORIAS
  ======================================================-->
  <aside class="m-auto col-11 col-lg-3">

    <!--=====================================================
      BUSCADOR
    ======================================================-->
    <div class="search col-12 font-0">
      <input class="i-b col-10 p_5 font-1 no-border" type="text" name="" placeholder="Buscar">
      <button class="i-b col-2 no-border">
        <i class="fas fa-search"></i>
      </button>
    </div>

    <!--=====================================================
      CATEGORIAS
    ======================================================-->
    <div class="categories col-12">

      <?php
      /*=======================================================
        CATEGORIAS Y SUBCATEGORIAS
      =======================================================*/
        $res = ArticleController::showCategories();
        $resDos = ArticleController::showSubcategories();
      /*=======================================================
        OBTIENE EL VALOR DE CATEGORIA O SUBCATEGORIA
      =======================================================*/
        if (!isset($_SESSION["order"])) {
          $_SESSION["order"] = "DESC";
        }

        if ($rutes[0] == "articulos") {
          $value = null;
          $condition = null;
        } else if(isset($ruteSubCategories["subcategorie_id"])){
          $value = $ruteSubCategories["subcategorie_id"];
          $condition = "subcategorie_id";
        } else {
          $value = $ruteSubCategories["categorie_id"];
          $condition = "categorie_id";
        }
        $numberArticles = 12;



        if (isset($rutes[1])) {
          /* ORDENA EL VALOR DE LOS ARTICULOS */
          if (isset($rutes[2])) {
            if ($rutes[2] == "recientes") {
              $modeURL = "antiguos";
              $mode = "DESC";
              $_SESSION["order"] = $mode;
            } else if ($rutes[2] == "antiguos") {
              $modeURL = "recientes";
              $mode = "ASC";
              $_SESSION["order"] = $mode;
            }
          } else {
            if ($_SESSION["order"] == "DESC") {
              $modeURL = "antiguos";
            } else {
              $modeURL = "recientes";
            }
            $mode = $_SESSION["order"];
          }

          /* SI LA PAGINACION NO EXISTE SE AGREGA UN DEFAULT */
          if ($rutes[1] < 1) {
            $rutes[1] = 1;
          }

          $start = (($rutes[1]-1)*$numberArticles);
        } else {
          $start = 0;
          $rutes[1] = 1;
          $modeURL = "antiguos";
          $mode = "DESC";
        }

        $order = "article_id";
        $articles = ArticleController::showArticlesCard($order, $mode, $start, $numberArticles, $condition, $value);
        $paginationNum = ArticleController::numberOfPagination($numberArticles, $condition, $value);
      ?>

      <div class="header-categories flex p_5">

        <div class="col-4 flex jc-sp-around">
          <button class="btn-categories">
            <i class="fas fa-bars font-1_5"></i>
          </button>
          <button class="btn-categories">
            <a href="<?php printf($home.$rutes[0]."/1/".$modeURL) ?>">
              <?php if ( $_SESSION["order"] == "DESC") { ?>
                <i class="fas fa-sort-amount-up font-1_5"></i>
              <?php } else { ?>
                <i class="fas fa-sort-amount-down font-1_5"></i>
              <?php } ?>
            </a>
          </button>

        </div>

        <div class="col-8 flex jc-center ai-center">
          <h4>Categorias</h4>
        </div>

      </div>

      <div class="col-12">
        <ul class="categories-list no-bullet">
          <?php foreach ($res as $value) { ?>
          <!--  CATEGORIA -->
          <li class="m-0">
            <a class="block p_5" href='<?php printf($home.$value[1]); ?>'>
              <h5 class="font-1"><?php printf($value[0]); ?></h5>
            </a>
            <!--  SUBCATEGORIA  -->
            <ul class='subcategories-list no-bullet'>
            <?php foreach ($resDos as $valueDos) {
                  if ($value[0] == $valueDos[0]){ ?>
                <li>
                  <a class="block p_25" href='<?php printf($home.$valueDos[2]);?>'>
                    <h6 class="font-1"><?php printf($valueDos[1]); ?></h6>
                  </a>
                </li>
              <?php }} ?></ul>
          </li><?php }?>

        </ul>
      </div>
    </div>
  </aside>

  <!--=====================================================
    ARTICULOS
  ======================================================-->
  <div class="col-12 col-lg-9">
    <div class="articles-container flex flex-wrap">

      <?php foreach ($articles as $value) { ?>
        <div class="col-12 col-xmd-6 col-md-4 md-p_5">
          <article class="article-card m-auto">
            <div class="article information">
              <a href="<?php printf($home.$value["url"]); ?>">
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
                <span><?php printf(TemplateController::timesTampData($value["registration_date"])); ?></span>
              </a>
            </div>
          </article>
        </div>
      <?php } ?>
    </div>

    <!--=====================================================
      PAGINACION
    ======================================================-->
    <div class="pagination">
      <div class="flex jc-center">
        <ul>
          <?php
            if ($paginationNum > 4) {
              if ($rutes[1] > ($paginationNum-2)) {
                $startPag = $paginationNum - 4;
                $pag = $paginationNum;
              }  else if ($rutes[1] > 3) {
                $startPag = $rutes[1] -2;
                $pag = $rutes[1] + 2;
              } else {
                $startPag = 1;
                $pag = 5;
              }
            } else {
              $startPag = 1;
              $pag = $paginationNum;
            }


            if ($paginationNum >= 0) {
          ?>

            <li class="m-0 arrow-rigth">
              <?php if($rutes[1] != 1) { ?>
                <a href="<?php printf($home.$rutes[0]."/".($rutes[1] - 1)); ?>"><i class="fas fa-arrow-left"></i></a>
              <?php } else { ?>
                <a><i class="fas fa-arrow-left"></i></a>
              <?php } ?>
            </li>

          <?php for ($i = $startPag; $i <= $pag; $i++){ ?>
            <?php if ($rutes[1] == $i){ ?>
              <li class="m-0 active">
            <?php } else { ?>
              <li class="m-0">
            <?php } ?>
              <a href="<?php printf($home.$rutes[0]."/".$i); ?>"><?php printf($i); ?></a>
            </li>
          <?php }; ?>

            <li class="m-0 arrow-left">
              <?php if ($rutes[1] != $paginationNum){ ?>
                <a href="<?php printf($home.$rutes[0]."/".($rutes[1] + 1)); ?>"><i class="fas fa-arrow-right"></i></a>
              <?php } else { ?>
                <a><i class="fas fa-arrow-right"></i></a>
              <?php } ?>
            </li>

          <?php
            }
          ?>


        </ul>
      </div>
    </div>

  </div>
</div>
