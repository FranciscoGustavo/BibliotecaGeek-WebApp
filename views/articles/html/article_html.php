<div class="container p-1">
  <?php $article = ArticleController::showArticle($rutes[0]); ?>

  <!--=====================================================
    ARTICULO
  ======================================================-->
  <div class="article-container">
    <!--=====================================================
      IMAGEN DE PORTADA
    ======================================================-->
    <div class="article-img-container">
      <img src="<?php printf($rute."assets/".$article["image_rute"]); ?>" alt="">
    </div>

    <!--=====================================================
      TITULO DEL ARTICULO
    ======================================================-->
    <div class="article-title border-button p-1">
      <h1><?php printf($article["title"]); ?></h1>
    </div>

    <!--=====================================================
      PARRAFO
    ======================================================-->
    <div class='paragraph p-1'>
      <div class='paragraph-title'>
        <h4>¿Que es mobile First</h4>
      </div>
      <div class='paragraph-content'>
        <p>
          Lorem ipsum dolor sit amet, consectetur adipisicing elit,
          sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.
          Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris
          nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in
          reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla
          pariatur. Excepteur sint occaecat cupidatat non proident, sunt in
          culpa qui officia deserunt mollit anim id est laborum.
          Lorem ipsum dolor sit amet, consectetur adipisicing elit,
          sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.
          Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris
          nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in
          reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla
          pariatur. Excepteur sint occaecat cupidatat non proident, sunt in
          culpa qui officia deserunt mollit anim id est laborum.
        </p>
      </div>
    </div>

    <!--=====================================================
      IMAGEN
    ======================================================-->
    <div class="image p-1">
      <figure>
        <img src="http://localhost/bibliotecageek/assets/images/mat-s.jpg" alt=''>
        <figcaption>Foto By ANTONIO</figcaption>
      </figure>
    </div>

    <!--=====================================================
      PARRAFO
    ======================================================-->
    <div class='paragraph p-1'>
      <div class='paragraph-title'>
        <h4>¿Que es mobile First</h4>
      </div>
      <div class='paragraph-content'>
        <p>
          Lorem ipsum dolor sit amet, consectetur adipisicing elit,
          sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.
          Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris
          nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in
          reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla
          pariatur. Excepteur sint occaecat cupidatat non proident, sunt in
          culpa qui officia deserunt mollit anim id est laborum.
          Lorem ipsum dolor sit amet, consectetur adipisicing elit,
          sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.
          Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris
          nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in
          reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla
          pariatur. Excepteur sint occaecat cupidatat non proident, sunt in
          culpa qui officia deserunt mollit anim id est laborum.
        </p>
      </div>
    </div>

    <!--=====================================================
      PARRAFO
    ======================================================-->
    <div class='paragraph p-1 top-p-none'>
      <div class='paragraph-content'>
        <p>
          Lorem ipsum dolor sit amet, consectetur adipisicing elit,
          sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.
          Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris
          nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in
          reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla
          pariatur. Excepteur sint occaecat cupidatat non proident, sunt in
          culpa qui officia deserunt mollit anim id est laborum.
          Lorem ipsum dolor sit amet, consectetur adipisicing elit,
          sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.
          Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris
          nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in
          reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla
          pariatur. Excepteur sint occaecat cupidatat non proident, sunt in
          culpa qui officia deserunt mollit anim id est laborum.
        </p>
      </div>
    </div>

    <!--=====================================================
      IMAGEN
    ======================================================-->
    <div class="image p-1">
      <figure>
        <img src="http://localhost/bibliotecageek/assets/images/mobile-f.jpg" alt=''>
        <figcaption>Foto By ANTONIO</figcaption>
      </figure>
    </div>

    <!--=====================================================
      PARRAFO
    ======================================================-->
    <div class='paragraph p-1'>
      <div class='paragraph-title'>
        <h4>¿Que es mobile First</h4>
      </div>
      <div class='paragraph-content'>
        <p>
          Lorem ipsum dolor sit amet, consectetur adipisicing elit,
          sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.
          Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris
          nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in
          reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla
          pariatur. Excepteur sint occaecat cupidatat non proident, sunt in
          culpa qui officia deserunt mollit anim id est laborum.
          Lorem ipsum dolor sit amet, consectetur adipisicing elit,
          sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.
          Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris
          nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in
          reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla
          pariatur. Excepteur sint occaecat cupidatat non proident, sunt in
          culpa qui officia deserunt mollit anim id est laborum.
        </p>
      </div>
    </div>

    <!--=====================================================
      DATOS DEL ESCRITOR
    ======================================================-->
    <div class="outhor p-1 border-top flex jc-sp-between ai-center">
      <div class="outhor-image">
        <img src="http://localhost/bibliotecageek/assets/images/people.jpg" alt="">
      </div>
      <div class="outhor-name">
        <h4>Francisco</h4>
      </div>
      <div class="article-timestamp">
        <p>22/Julio/2018</p>
      </div>
    </div>

  </div>

</div>
