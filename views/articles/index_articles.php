<!--=====================================================
  ARTICULOS MOSTRADOS EN LA PAGINA DE INICIO
======================================================-->
<div class="container">

  <!--=====================================================
    ARTICULOS MAS VISTOS
  ======================================================-->
  <?php $articlesMostSee = ArticleController::showArticlesCard("views", "DESC", 0, 4, null, null); ?>
  <div class="most-seen-container">
    <h2 class="most-seen sm-p_5">Los articulos mas vistos</h2>
    <div class="most-seen-articles xmd-flex flex-wrap">
      <?php foreach ($articlesMostSee as $value) { ?>
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
                <span><?php printf(TemplateController::timesTampData($value["registration_date"])); ?></span>
              </a>
            </div>
          </article>
        </div>
      <?php } ?>
    </div>
  </div>

  <!--=====================================================
    LOS ULTIMOS ARTICULOS
  ======================================================-->
  <?php $lastArticles = ArticleController::showArticlesCard("article_id", "DESC", 0, 4, null, null); ?>
  <div class="the-last-container">
    <h2 class="the-last sm-p_5">Los ultimos articulos</h2>
    <div class="the-last-articles xmd-flex flex-wrap">
      <?php foreach ($lastArticles as $value) { ?>
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
                <span><?php printf(TemplateController::timesTampData($value["registration_date"])); ?></span>
              </a>
            </div>
          </article>
        </div>
      <?php } ?>
    </div>
  </div>

</div>
