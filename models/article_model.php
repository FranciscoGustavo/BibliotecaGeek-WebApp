<?php
/*=======================================================
MODELO DE LOS ARTICULOS Y CATEGORIAS

CONECTA CON LA BASE DE DATOS Y LA EXTRAE PARA SER
PROCESADA POR EL CONTROLADOR
=======================================================*/
class ArticleModel
{
  /*=============================================
    BUSCA TODAS LAS CATEGORIAS
  =============================================*/
  public function showCategories(){
    $conection = Conection::starConection();
    $elements = $conection->prepare(
      "SELECT categorie_name, url, categorie_id FROM categories"
    );
    $elements->execute();
    return $elements->fetchAll();
  }

  /*=============================================
    BUSCA TODAS LAS SUBCATEGORIAS
  =============================================*/
  public function showSubcategories(){
    $conection = Conection::starConection();
    $elements = $conection->prepare(
      "SELECT categories.categorie_name, subcategories.subcategorie_name,
              subcategories.url, subcategories.subcategorie_id
      FROM subcategories
      INNER JOIN categories ON subcategories.categorie_id = categories.categorie_id"
    );
    $elements->execute();
    return $elements->fetchAll();
  }

  /*=============================================
    BUSCA LA RUTA EN DIFERENTES TABLAS
  =============================================*/
  static public function rutesCategories($table, $rute){
    $conection = Conection::starConection();
    $elements = $conection->prepare("SELECT * FROM ".$table." WHERE url = '".$rute."'");
    $elements->execute();
    return $elements->fetch();
  }

  /*=============================================
    BUSCA LA INFORMACION DE LAS TARJETAS DE PRODUCTOS
  =============================================*/
  static public function showArticlesCard($start, $count){
    $conection = Conection::starConection();
    $elements = $conection->prepare("SELECT * FROM articles");
    $elements->execute();
    return $elements->fetch();
  }

  /*=============================================
    MUESTRA LOS ARTICULOS EN FORMA DE TARJETA
  =============================================*/
  static public function articlesMostSeen($order, $mode, $start, $count, $conditionSql){
    $conection = Conection::starConection();
    $elements = $conection->prepare("
        SELECT admin.first_name, categories.categorie_name, subcategories.subcategorie_name, articles.article_id,
        articles.title, articles.image, articles.description, articles.url, articles.registration_date FROM `articles`
        INNER JOIN admin ON articles.admin_id = admin.admin_id
        INNER JOIN categories ON articles.categorie_id = categories.categorie_id
        INNER JOIN subcategories ON articles.subcategorie_id = subcategories.subcategorie_id
        $conditionSql ORDER BY($order) $mode LIMIT $start, $count

    ");
    $elements->execute();
    return $elements->fetchAll();
  }

  /*=============================================
    LA INFORMACION DE UN ARTICULO
  =============================================*/
  static public function showArticle($rute){
    $conection = Conection::starConection();
    $elements = $conection->prepare("
      SELECT articles.article_id, articles.title, articles.image,
              admin.first_name, admin.photo, admin.email,
              articles.content, articles.state,
              articles.views, articles.shared, articles.categorie_id,
              articles.registration_date FROM `articles`

              INNER JOIN admin ON articles.admin_id = admin.admin_id
              INNER JOIN categories ON articles.categorie_id = categories.categorie_id
              INNER JOIN subcategories ON articles.subcategorie_id = subcategories.subcategorie_id
              WHERE articles.url = '$rute' && articles.state = 0
    ");
    $elements->execute();
    return $elements->fetch();
  }

  /*=============================================
    BUSCA EL NUMERO DE ARTICULOS PARA LA PAGINACION
  =============================================*/
  static public function numberOfPagination($condition){
    $conection = Conection::starConection();
    $elements = $conection->prepare("SELECT COUNT(*) FROM articles $condition");
    $elements->execute();
    return $elements->fetch();
  }

  /*=============================================
    ACTUALIZA LAS VISTAS DEL ARTICULO BASADO EN SU URL
  =============================================*/
  static public function updateViewArticleBy($rute, $item, $value) {
    $conection = Conection::starConection();
    $elements = $conection->prepare("
      UPDATE `articles` SET `$item` = '$value' WHERE `articles`.`url` = '$rute'
    ");

    if ($elements->execute()) {
      return "OK";
    }
    else{
      return "ERROR";
    }

  }

  /*=============================================
    BUSCA SI EL ARTICULO FAVORITO
  =============================================*/
  static public function findFavoriteArticle($articleId, $userId){
    $conection = Conection::starConection();
    $elements = $conection->prepare("SELECT * FROM `favorites` WHERE user_id = $userId && article_id = $articleId");
    $elements->execute();
    return $elements->fetch();

  }

  /*=============================================
    AÑADIMOS NUEVO ARTICULO FAVORITO
  =============================================*/
  static public function addFavoriteArticle($userId, $articleId){
    $conection = Conection::starConection();
    $elements = $conection->prepare("
      INSERT INTO favorites(favorite_id, user_id, article_id, registration_date)
      VALUES (0,$userId,$articleId,CURRENT_TIMESTAMP)
    ");

    if ($elements->execute()) {
      return "OK";
    }
    else{
      return "ERROR";
    }
  }

  /*=============================================
    BORRAMOS ARTICULO FAVORITO
  =============================================*/
  static public function removeFavoriteArticle($userId, $articleId){
    $conection = Conection::starConection();
    $elements = $conection->prepare("
      DELETE FROM `favorites` WHERE user_id = $userId && article_id = $articleId
    ");

    if ($elements->execute()) {
      return "OK";
    }
    else{
      return "ERROR";
    }
  }

  /*=============================================
    BUSCA LOS COMENTARIOS DE CADA ARTICULO
  =============================================*/
  static public function findCommentsToArticle($article_id){
    $conection = Conection::starConection();
    $elements = $conection->prepare("
      SELECT comments.comment_id, users.user_id, users.username, users.photo, comment FROM `comments`
      INNER JOIN users ON comments.user_id = users.user_id
      WHERE article_id = $article_id ORDER BY(comment_id) DESC;
    ");

    $elements -> execute();
    return $elements->fetchAll();

    $elements-> close();

    $elements = null;
  }

  /*=============================================
    CREA UN COMENTARIO
  =============================================*/
  static public function createNewComment($userid, $articleid, $comment){
    $conection = Conection::starConection();
    $elements = $conection->prepare("INSERT INTO comments(comment_id, user_id, article_id, comment, registration_date) VALUES
      (0, $userid, $articleid, '$comment',  CURRENT_TIMESTAMP)
    ");


    if($elements->execute()){

      return "OK";

    }else{

      return "ERROR";

    }

    $elements->close();
    $elements = null;
  }

  /*=============================================
    ACTUALIZA UN COMENTARIO
  =============================================*/
  static public function updateComment($commentId, $comment){
    $conection = Conection::starConection();
    $elements = $conection->prepare("UPDATE comments SET comment = '$comment' WHERE comment_id = $commentId");


    if($elements->execute()){

      return "OK";

    }else{

      return "ERROR";

    }

    $elements->close();
    $elements = null;
  }

  /*=============================================
    ELIMINA UN COMENTARIO
  =============================================*/
  static public function deleteComment($deleteCommentId){
    $conection = Conection::starConection();
    $elements = $conection->prepare("DELETE FROM comments WHERE comment_id = $deleteCommentId");


    if($elements->execute()){

      return "OK";

    }else{

      return "ERROR";

    }

    $elements->close();
    $elements = null;
  }


}
