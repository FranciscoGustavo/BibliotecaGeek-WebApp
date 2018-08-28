<?php
if ($rutes[1] == "") {
  header("location: http://localhost/bibliotecageek/dashboard/articles");
  exit();
}
?>

<button class="btn-cancel">
  <i class="fas fa-ban font-1_5"></i>
  <span>Cancelar</span>
</button>
<button class="btn-save">
  <i class="far fa-save font-1_5"></i>
  <span>Guardar</span>
</button>

<div class="page-content">

  <div class="info-article col-11 col-lg-10 m-auto">

    <div class="item url-article">
      <label class="col-3 block" for="">
        <span>URL</span>
        <i class="fas fa-link"></i>
      </label>
      <input class="col-12 block" type="text" name="" value="titulo-de-mi-post">
    </div>

    <div class="item">
        <label for="">Descripcion</label>
        <textarea name="description"></textarea>
    </div>

    <div class="">
      <div class="categories">
        <span>Categoria</span>
        <select>
          <option value="volvo">Volvo</option>
          <option value="saab">Saab</option>
          <option value="mercedes">Mercedes</option>
          <option value="audi">Audi</option>
        </select>
      </div>
      <div class="subcategories">
        <span>Subcategoria</span>
        <select>
          <option value="volvo">Volvo</option>
          <option value="saab">Saab</option>
          <option value="mercedes">Mercedes</option>
          <option value="audi">Audi</option>
        </select>
      </div>
    </div>

  </div>

  <div class="article col-11 col-lg-10 m-auto">
    <!--=====================================================
      IMAGEN DE PORTADA
    ======================================================-->
    <div class="article-img-container">
      <img class="cover-img" src="<?php printf($dashboard."assets/images/articlesimage/default.jpg"); ?>" alt="">
      <label for="cover"><i class="fas fa-plus-circle font-3"></i></label>
      <input class="none" id="cover" type="file" name="cover">
    </div>

    <!--=====================================================
      TITULO DEL ARTICULO
    ======================================================-->
    <div class="article-title border-button">
      <h1>
        <input type="text" placeholder="Escribe el titulo de tu articulo" value="Titulo de mi post">
      </h1>
    </div>

    <!--=====================================================
      PARRAFO
    ======================================================-->
    <div class="paragraph p-1" id="1" data-type="paragraph" data-class="top-p-none">
      <div class="paragraph-title">
        <h4>
          <input type="text" name="title1" placeholder="Introduce un titulo">
        </h4>
      </div>

      <div class='paragraph-content'>
        <p>
          <textarea name="content1" placeholder="Escribe aqui">
          </textarea>
        </p>
      </div>
    </div>

    <!--=====================================================
      IMAGEN
    ======================================================-->
    <div class="image p-1" id="2" data-type="image" data-class="">
      <figure>
        <img src="<?php printf($dashboard."assets/images/articlesimage/default.jpg"); ?>" alt="">
        <figcaption>
          <input type="text" name="figcaption2" placeholder="Nombre del autor de la imagen">
        </figcaption>
      </figure>
    </div>

    <!--=====================================================
      ADD NEW ITEM
    ======================================================-->
    <div class="new-item flex jc-sp-between p-1">
      <div class="col-12 col-md-6 txt-center">
        <button class="new-image">
          <i class="far fa-image font-1_5"></i>
          <p>Agregar Imagen</p>
        </button>
      </div>
      <div class="col-12 col-md-6 txt-center">
        <button class="new-text">
          <i class="fas fa-font font-1_5"></i>
          <p>Agregar Texto</p>
        </button>
      </div>

    </div>
  </div>

</div>
