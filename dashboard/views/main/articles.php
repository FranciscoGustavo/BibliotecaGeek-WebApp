<div class="page-content">

  <div class="articles-table">

    <header class="table-row-header none lg-block">
      <div class="col-12 flex txt-center">
        <div class="col-6">Titulo</div>
        <div class="col-1">Estado</div>
        <div class="col-2">Editar</div>
        <div class="col-2">Publicar</div>
        <div class="col-1">Borrar</div>
      </div>
    </header>

    <?php $articles = ArticlesController::showArticles(); ?>
    <?php //var_dump($articles); ?>
    <?php foreach ($articles as $value) {
    ?>
        <div class="table-row p-1">
          <div class="col-12 flex flex-wrap txt-center">
            <div class="col-12 col-lg-6">
              <h1><?php printf($value['title']) ?></h1>
            </div>
            <div class="col-12 col-lg-1">
              <h2>
                <?php
                  if ($value['state'] == 1) {
                    printf("Guardado");
                  } else {
                    printf("Publicado");
                  }
                ?>
              </h2>
            </div>
            <div class="col-4 col-lg-2">
              <button class="edit" data-url="<?php printf($value['article_id']); ?>">Editar</button>
            </div>
            <div class="col-5 col-lg-2">
              <button data-state="<?php printf($value['state']); ?>">
                <?php
                  if ($value['state'] == 1) {
                    printf("Publicar");
                  } else {
                    printf("Borrador");
                  }
                ?>
              </button>
            </div>
            <div class="col-3 col-lg-1">
              <button type="button" name="button"><i class="fas fa-trash-alt"></i></button>
            </div>
          </div>
        </div>

    <?php
    } ?>

  </div>

</div>
