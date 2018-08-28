<!--=====================================================
  ARTICULOS DE LA PAGINA DE ARTICULOS
======================================================-->
<div class="container flex flex-wrap">
  <!--=====================================================
    BUSCADOR Y LISTA DE CATEGORIAS
  ======================================================-->
  <aside class="col-12 col-lg-3 md-p_5 lg-p-0" style="background-color:;">

    <!--=====================================================
      BUSCADOR
    ======================================================-->
    <div class="search col-11 col-md-12 flex col-xlg-4 col-lg-12 second-color-dark">
      <input type="text" name="" placeholder="Buscar">
      <button class="second-color-dark">
        <i class="fas fa-search"></i>
      </button>
    </div>

    <!--=====================================================
      CATEGORIAS
    ======================================================-->
    <div class="categories col-11 col-md-12 flex col-xlg-4 col-lg-12 second-color">
      <?php
        $res = ArticleController::showCategories();
        $resDos = ArticleController::showSubcategories();
      ?>
      <div class="col-12 flex jc-sp-between ai-center p_5 second-color-dark">
        <h4>Categorias</h4>
        <button class="lg-none btn-categories">
          <i class="fas fa-bars font-1_5"></i>
        </button>
      </div>
      <div class="col-12 p_5">
        <ul class="categories-list sm-flex sm-flex-wrap jc-sp-around lg-block" style="">
          <?php foreach ($res as $value) { ?>
          <!--=====================================================
            CATEGORIA
          ======================================================-->
          <li>
            <a href='<?php printf($home.$value[1]); ?>'>
              <h5><?php printf($value[0]); ?></h5>
            </a>
            <ul class='subcategories-list'>
            <?php foreach ($resDos as $valueDos) {
                  if ($value[0] == $valueDos[0]){ ?>
                <!--=====================================================
                  SUBCATEGORIA
                ======================================================-->
                <li>
                  <a href='<?php printf($home.$valueDos[2]);?>'>
                    <h6><?php printf($valueDos[1]); ?></h6>
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
  <?php
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
      if ($rutes[1] < 1) {
        $rutes[1] = 1;
      }
      $start = (($rutes[1]-1)*$numberArticles);
    } else {
      $start = 0;
      $rutes[1] = 1;
    }


    $order = "article_id";
    $articles = ArticleController::showArticlesCard($order, "DESC", $start, $numberArticles, $condition, $value);
    $paginationNum = ArticleController::numberOfPagination($numberArticles, $condition, $value);
  ?>

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
                <span><?php printf(ArticleController::timesTampData($value["registration_date"])); ?></span>
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
            if ($paginationNum != 1) {
          ?>

          <?php if($rutes[1] != 1) { ?>
            <li>
              <a href="<?php printf($home.$rutes[0]."/".($rutes[1] - 1)); ?>"><i class="fas fa-arrow-left"></i></a>
            </li class="m-0">
          <?php } ?>
          <?php for ($i = 1; $i <= $paginationNum; $i++){ ?>
            <li class="m-0">
              <a href="<?php printf($home.$rutes[0]."/".$i); ?>"><?php printf($i); ?></a>
            </li>
          <?php }; ?>
          <?php if ($rutes[1] != $paginationNum){ ?>
            <li class="m-0">
              <a href="<?php printf($home.$rutes[0]."/".($rutes[1] + 1)); ?>"><i class="fas fa-arrow-right"></i></a>
            </li>
          <?php } ?>

          <?php
            }
          ?>


        </ul>
      </div>
    </div>

  </div>
</div>
