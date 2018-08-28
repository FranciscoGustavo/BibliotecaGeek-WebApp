<?php $article = ArticleController::showArticle($rutes[0]); ?>
<?php
if ($article != false) {
?>

<div class="container p-1 lg-flex ai-flex-start">

  <!--=====================================================
    ARTICULO
  ======================================================-->
  <div class="article-container m-auto">
    <div class="article">
      <!--=====================================================
        IMAGEN DE PORTADA
      ======================================================-->
      <div class="article-img-container">
        <img src="<?php printf($dashboard.$article["image"]); ?>" alt="">
      </div>

      <!--=====================================================
        TITULO DEL ARTICULO
      ======================================================-->
      <div class="article-title border-button p-1">
        <h1><?php printf($article["title"]); ?></h1>
      </div>

      <?php $content = json_decode($article["content"],true); ?>

      <?php  foreach($content as $value) { ?>

          <?php if($value["type"] == "paragraph"){ ?>
            <!--=====================================================
              PARRAFO
            ======================================================-->
            <div class="paragraph p-1 <?php printf($value["class"]); ?>">
              <?php if ($value["title"] != ""){ ?>
              <div class="paragraph-title">
                <h4><?php printf($value["title"]); ?></h4>
              </div>
              <?php }; ?>
              <div class='paragraph-content'>
                <p>
                  <?php printf($value["content"]); ?>
                </p>
              </div>
            </div>

          <?php } else if($value["type"] == "image"){ ?>
            <!--=====================================================
              IMAGEN
            ======================================================-->
            <div class="image p-1 <?php printf($value["class"]); ?>">
              <figure>
                <img src="<?php printf($value["rute"]); ?>" alt="<?php printf($value["alt"]); ?>">
                <figcaption><?php printf($value["figcaption"]); ?></figcaption>
              </figure>
            </div>

          <?php } ?>
      <?php } ?>
    </div>
  </div>

  <!--=====================================================
    RECOMENDADOS
  ======================================================-->
  <div class="recommended-container">

    <!--=====================================================
      INFORMACION DEL ARTICULO
    ======================================================-->
    <div class="information-to-article p_5">
        <!--=====================================================
          DATOS DEL ESCRITOR
        ======================================================-->
        <div class="outhor">
          <a class="flex ai-center flex-wrap" href="#">
            <h4 class="col-12 p_25">Autor:</h4>
            <div class="outhor-image">
              <img src="<?php printf($dashboard.$article['photo']); ?>" alt="">
            </div>
            <div class="outhor-name">
              <h5><?php printf($article['first_name']); ?></h5>
              <h6><?php printf($article['email']); ?></h6>
            </div>
          </a>
        </div>

        <!--=====================================================
          DETALLES DEL ARTICULOS
        ======================================================-->
        <div class="details">
          <h4 class="col-12 p_25">Detalles:</h4>
          <div class="details-views">
            <span class="icon"><i class="far fa-eye"></i></span>
            <span class="view-number"><?php printf($article["views"]); ?></span>
            <span> vistas</span>
          </div>
          <div class="details-shared">
            <span class="icon"><i class="fas fa-share-alt"></i></span>
            <span><?php printf($article["shared"]); ?></span>
            <span> veces compartido</span>
          </div>
          <div class="details-comment">
            <span class="icon"><i class="far fa-comments"></i></span>
            <span>23 Comentarios</span>
          </div>
          <div class="details-time">
            <span class="icon"><i class="far fa-calendar-alt"></i></span>
            <span><?php printf(ArticleController::timesTampData($article["registration_date"])); ?></span>
          </div>
        </div>

        <!--=====================================================
          COMPARTIR
        ======================================================-->
        <div class="share">
          <h4 class="col-12 p_25">Compartir:</h4>
          <div class="social-network flex jc-center">
            <a class="btn-shared-facebook" href="<?php printf($home.$rutes[0]); ?>" target="_blank">
              <i class="fab fa-facebook font-2"></i>
            </a>
            <a href="https://twitter.com/bibliotecageek" target="_blank">
              <i class="fab fa-twitter font-2"></i>
            </a>
            <a href="#">
              <i class="fab fa-whatsapp"></i>
            </a>
          </div>
        </div>

      <!--=====================================================
        GUARDAR COMO FAVORITO
      ======================================================-->
      <?php
        if (isset($_SESSION["checkSession"])) {
          if ($_SESSION["checkSession"] == "OK") {
      ?>
      <div class="share">
        <h4 class="col-12 p_25">Agregar a favorito</h4>
        <div class="social-network flex jc-center">
          <?php
            $favoriteAricle =  ArticleController::findFavoriteArticle($article['article_id'], $_SESSION['id']);
            if ($favoriteAricle == 1) {
              $favorite = "isfavorite";
            }else {
              $favorite = "";
            }
          ?>
          <input type="hidden" id="articleid" name="articleid" value="<?php printf($article['article_id']); ?>">
          <input type="hidden" id="userid" name="userid" value="<?php printf($_SESSION['id']); ?>">
          <input type="hidden" id="favorite" name="favorite" value="<?php printf($favoriteAricle); ?>">
          <a id="addmyfavorite">
            <i class="fas fa-heart <?php printf($favorite); ?>"></i>
          </a>
        </div>
      </div>
      <?php
          }
        }
      ?>
    </div>

    <!--=====================================================
      RECOMENDADOS
    ======================================================-->
    <div class="recommended p_5">
      <!--=====================================================
        TARJETA DE DISEÑO DE LOS ARTICULOS
      ======================================================-->
      <h3 class="p-1 txt-center">Recomendados</h3>

      <?php
        $item = "categorie_id";
        $value = $article["categorie_id"];

        $articlesRand = ArticleController::showArticleRand($item, $value);
      ?>
      <?php foreach ($articlesRand as $value) {?>

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

      <?php } ?>

    </div>

  </div>
</div>

<!--=====================================================
  COMENTARIOS
======================================================-->
<div class="container p-1 ">
  <div class="comments">
    <?php
      if (isset($_SESSION["checkSession"])) {
        if ($_SESSION["checkSession"] == "OK") {
    ?>
    <div class="comment comment-form">
      <div class="header-comment p_5 flex ai-center">
        <div class="user-image">
          <img src="<?php printf($_SESSION['photo']) ?>" alt="">
        </div>
        <div class="user-name">
          <h5><?php printf($_SESSION['username']) ?></h5>
        </div>
      </div>
      <div class="body-comment p_5">
        <div class="text-form">
          <textarea id="comment" name="name" placeholder="Escribe tu comentario"></textarea>
          <input type="hidden" id="articleid" name="article" value="<?php printf($article['article_id']); ?>">
          <input type="hidden" id="useridcomment" name="user" value="<?php printf($_SESSION['id']); ?>">
          <input type="hidden" id="usename" name="user" value="<?php printf($_SESSION['username']); ?>">
          <input type="hidden" id="photo" name="user" value="<?php printf($_SESSION['photo']); ?>">
        </div>
      </div>
      <div class="footer-comment">
        <button class="second-color-dark" type="button" id="btncomment">Publicar</button>
      </div>
    </div>
    <?php
        }
      } else {
    ?>
    <div class="comment comment-form">
      <div class="header-comment p_5 flex ai-center">
        <h3 class="txt-center col-12">Para comentar debes iniciar sesion</h3>
      </div>
    </div>
    <?php
      }
    ?>

    <?php
      $comments = ArticleController::findCommentsToArticle($article['article_id']);
    ?>

    <?php foreach ($comments as $value) { ?>
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
    <?php } ?>
  </div>
</div>
<?php
} else {
?>
<div class="container p-1 lg-flex ai-flex-start">
  <h1>Error articulo no publicado</h1>
</div>
<?php
}
?>
