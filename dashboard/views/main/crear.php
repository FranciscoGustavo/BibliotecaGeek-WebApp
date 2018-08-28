<button class="btn-cancel">
  <i class="fas fa-ban font-1_5"></i>
  <span>Cancelar</span>
</button>
<button class="btn-save">
  <i class="far fa-save font-1_5"></i>
  <span>Guardar</span>
</button>

<div class="page-content">

  <!--=====================================================
    INFORMACION DEL ARTICULO
  ======================================================-->
  <div class="info-article col-11 col-lg-10 m-auto p-1">
    <!--=====================================================
      URL DEL ARTICULO
    ======================================================-->
    <div class="item url-article p-0">
      <label class="col-3 block" for="url">
        <i class="fas fa-link"></i>
      </label>
      <input class="col-12 block inputURL" id="url" type="text" name="url" placeholder="URL sin mayusculas, espacios o caracteres especiales">
    </div>

    <!--=====================================================
      DESCRIPCIÓN DEL ARTICULO
    ======================================================-->
    <div class="item p-0 description-url">
        <div class="count-charter">
          300
        </div>
        <label class="col-12 block" for="">Descripción:</label>
        <textarea class="col-12 block p_5 taDescription" name="description" placeholder="Introduce una descripcion"></textarea>
    </div>

    <!--=====================================================
    CATEGORIAS Y SUBCATEGORIAS
    ======================================================-->
    <div class="categories-articles">

      <select>
        <option autofocus>Selecciona Categoria</option>
        <option value="1">Programación</option>
        <option value="1">Matematicas</option>
        <option value="audi">Audi</option>
      </select>

      <select>
        <option autofocus>Selecciona Subcategoria</option>
        <option value="saab">Saab</option>
        <option value="mercedes">Mercedes</option>
        <option value="audi">Audi</option>
      </select>

    </div>

  </div>

  <!--=====================================================
    ARTICULO
  ======================================================-->
  <div class="article col-11 col-lg-10 m-auto">
    <!--=====================================================
      IMAGEN DE PORTADA
    ======================================================-->
    <div class="article-img-container">
      <img class="cover-img" src="<?php printf($dashboard."assets/images/articlesimage/default.jpg"); ?>" alt="">
      <label for="cover" class="txt-center">
        <i class="fas fa-plus-circle font-3"></i>
        <p>Agregar Portada</p>
      </label>
      <input class="none" id="cover" type="file" name="cover">
    </div>

    <!--=====================================================
      TITULO DEL ARTICULO
    ======================================================-->
    <div class="article-title border-button">
      <h1>
        <input class="inputTitle" type="text" name="title" placeholder="Escribe el titulo de tu articulo">
      </h1>
    </div>

    <!--=====================================================
      PARRAFO
    ======================================================-->
    <div class="paragraph p-1" id="1" data-type="paragraph" data-class="top-p-none">
      <div class="delete" onclick="deleteItem(1, 'paragraph')">
        <i class="fas fa-trash-alt"></i>
      </div>
      <div class="paragraph-title">
        <h4>
          <input class="title" type="text" name="title1" placeholder="Introduce un titulo">
        </h4>
      </div>

      <div class='paragraph-content'>
        <p>
          <textarea name="content1" placeholder="Escribe aqui"></textarea>
        </p>
      </div>
    </div>

    <!--=====================================================
      IMAGEN
    ======================================================-->
    <div class="image p-1" id="2" data-type="image" data-class="">
      <div class="delete" onclick="deleteItem(2, 'image')">
        <i class="fas fa-trash-alt"></i>
      </div>
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
