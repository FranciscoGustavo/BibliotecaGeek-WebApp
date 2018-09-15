<?php $article = ArticleController::showArticle($rutes[0]); ?>
<?php
if ($article != false) {
?>

<div class="container lg-flex">

  <!--=====================================================
    ARTICULO
  ======================================================-->
  <div class="article-container m-auto lg-m-0 col-11 col-sm-10 col-lg-8">
    <div class="article">

      <!--=====================================================
        IMAGEN DE PORTADA
      ======================================================-->
      <div class="article-img-container">
        <img src="<?php printf($dashboard.$article["image"]); ?>" alt="">
        <!--=====================================================
          TITULO DEL ARTICULO
        ======================================================-->
        <div class="article-title">
          <h1 class="font-1_5"><?php printf($article["title"]); ?></h1>
        </div>
      </div>

      <!--=====================================================
        INFORMACION DEL ARTICULO
      ======================================================-->
      <div class="info-article sm-flex sm-ai-center">
        <!--=====================================================
          DATOS DEL ESCRITOR
        ======================================================-->
        <div class="outhor flex jc-center col-sm-6">

          <a class="flex ai-center" href="#">
            <div class="outhor-image">
              <img src="<?php printf($dashboard.$article['photo']); ?>" alt="">
            </div>
            <div class="outhor-name">
              <h5><?php printf($article['first_name']); ?></h5>
              <h6><?php printf(TemplateController::timesTampData($article["registration_date"])); ?></h6>
            </div>
          </a>

        </div>

        <!--=====================================================
          DETALLES DEL ESCRITOR
        ======================================================-->
        <div class="details flex jc-center col-sm-6">

          <div class="details-views">
            <span class="view-number font-1_25"><?php printf($article["views"]); ?></span>
          </div>
          <div class="details-favorite">

            <?php
              if (isset($_SESSION["checkSession"])) {
                if ($_SESSION["checkSession"] == "OK") {
                  $favoriteAricle =  ArticleController::findFavoriteArticle($article['article_id'], $_SESSION['id']);
                  if ($favoriteAricle == 1) {
                    $favorite = "isfavorite";
                  }else {
                    $favorite = "";
                  }
                }
              } else {
                $favorite = "sing_in";
              }
            ?>
            <input type="hidden" id="articleid" name="articleid" value="<?php printf($article['article_id']); ?>">
            <input type="hidden" id="userid" name="userid" value="<?php printf($_SESSION['id']); ?>">
            <input type="hidden" id="favorite" name="favorite" value="<?php printf($favoriteAricle); ?>">

            <span id="addmyfavorite" class="icon <?php printf($favorite); ?>"><i class="fas fa-heart font-1_25"></i></span>
          </div>
          <div class="details-shared">
            <span class="icon"><i class="fas fa-share-alt font-1_25"></i></span>
          </div>

        </div>
      </div>

      <?php printf($article["content"]) ?>
      </div>
  </div>

  <!--=====================================================
    RECOMENDADOS
  ======================================================-->
  <div class="recommended-container m-auto lg-m-0 col-lg-4">
    <!--=====================================================
      RECOMENDADOS
    ======================================================-->
    <div class="recommended">
      <!--=====================================================
        TARJETA DE DISEÑO DE LOS ARTICULOS
      ======================================================-->

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
               <span><?php printf(TemplateController::timesTampData($value["registration_date"])); ?></span>
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
<div class="container">

  <div class="comments col-11 col-sm-10 col-lg-8 m-auto lg-m-0">

    <?php
      $comments = ArticleController::findCommentsToArticle($article['article_id']);
      if (isset($_SESSION["checkSession"])) {
        if ($_SESSION["checkSession"] == "OK") {
          if ($_SESSION['mode'] != "direct") {
            $photo = $_SESSION['photo'];
          } else {
            if ($_SESSION['photo'] == "") {
              $photo = $home."assets/images/users/default/default.jpg";
            } else {
              $photo = $home.$_SESSION['photo'];
            }
          }
    ?>
    <div class="comment comment-form">
      <div class="header-comment p_5 flex ai-center">
        <div class="user-image">
          <img src="<?php printf($photo); ?>" alt="">
        </div>
        <div class="user-name">
          <h5><?php printf($_SESSION["username"]); ?></h5>
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
      <div class="footer-comment txt-right p_5">
        <button type="button" id="btncomment">
          Publicar
        </button>
      </div>
    </div>
    <?php
        }
      }
    ?>

    <?php foreach ($comments as $value) {
      if ($value["photo"] == "") {
        $photo = "assets/images/users/default/default.jpg";
      } else {
        $photo = $value["photo"];
      }
    ?>
    <div class="comment">

      <div class="header-comment p_5 flex ai-center">
        <div class="user-image">
          <img src="<?php printf($photo); ?>" alt="">
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

        <p>
          <?php printf($value['comment']); ?>
        </p>
      </div>

      <div class="footer-comment p_5 flex jc-flex-end">
        <?php
        if (isset($_SESSION["checkSession"])) {
          if ($_SESSION["checkSession"] == "OK") {
            if ($value['user_id'] == $_SESSION['id']) {
        ?>

        <div class="container-buttons">

          <button id="<?php printf($value['comment_id']); ?>" class="btn-edit-comment" type="button">
            <i class="fas fa-edit"></i>
          </button>

          <button class="btn-delete-comment" type="button">
            <i class="fas fa-trash"></i>
          </button>

        </div>

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
