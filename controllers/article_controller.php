<?php
/*=======================================================
CONTROLADOR DE LOS ARTICULOS Y CATEGORIAS

PROCESA LA INFORMACION REQUERIDA PARA LAS VISTAS
=======================================================*/
class ArticleController
{
  /*=============================================
    MUESTRA TODAS LAS CATEGORIAS
  =============================================*/
  public function showCategories(){
    return ArticleModel::showCategories();
  }

  /*=============================================
    MUESTRA TODAS LAS SUBCATEGORIAS
  =============================================*/
  public function showSubcategories(){
    return ArticleModel::showSubcategories();
  }

  /*=============================================
    BUSCA LA RUTA SOLICITADA DETRO DE LA BASE DE DATOS
  =============================================*/
  static public function rutesCategories($rute, $table){
      $rutes = ArticleModel::rutesCategories($table, $rute);

      if ($rute == false) {
        return null;
      } else {
        return $rutes;
      }
  }

  /*=============================================
    MUESTRA LA IMFORMACION PARA LAS 'CARD' DE LOS ARTICULOS
  =============================================*/
  static public function showArticlesCard($order, $mode, $start, $count, $condition, $value){

    if ($condition == null AND $value == null) {
      return ArticleModel::articlesMostSeen($order, $mode, $start, $count, "WHERE articles.state = 0");

    } else if ($condition == "subcategorie_id"){
      $conditionSql = "WHERE articles.$condition = $value && articles.state = 0";
      return ArticleModel::articlesMostSeen($order, $mode, $start, $count, $conditionSql);

    } else if ($condition == "categorie_id"){
      $conditionSql = "WHERE articles.$condition = $value && articles.state = 0";
      return ArticleModel::articlesMostSeen($order, $mode, $start, $count, $conditionSql);
    }

  }

  /*=============================================
    BUSCA EL NUMERO DE PAGINAS
  =============================================*/
  static public function numberOfPagination($numArticles, $condition, $value){
    if ($condition == null AND $value == null) {
      $res =  ArticleModel::numberOfPagination("");
    } else {
      $sqlCondition = "WHERE $condition =  $value";
      $res =  ArticleModel::numberOfPagination($sqlCondition);
    }

    return ceil((int)$res[0]/$numArticles);

  }

  /*=============================================
    MUESTRA EL ARTICULO BASADO EN SU RUTA
  =============================================*/
  static public function showArticle($rute){
    return ArticleModel::showArticle($rute);
  }

  /*=============================================
    MUESTRA ARTICULOS RECOMENDADOS
  =============================================*/
  static public function showArticleRand($item, $value){
    $conditionSql = "WHERE articles.$item = $value && articles.state = 0";
    $order = "RAND()";
    $mode = "DESC";
    $start = 0;
    $count = 4;
    return ArticleModel::articlesMostSeen($order, $mode, $start, $count, $conditionSql);
  }

  /*=============================================
    ACTUALIZA LAS VISTAS DEL ARTICULO MOSTRADO
  =============================================*/
  static public function updateViewArticleBy($rute, $item, $value){
    return ArticleModel::updateViewArticleBy($rute, $item, $value);
  }

  /*=============================================
    BUSCA SI EL ARTICULO FAVORITO
  =============================================*/
  static public function findFavoriteArticle($articleId, $userId){
    $res = ArticleModel::findFavoriteArticle($articleId, $userId);
    if ($res != null) {
      return 1;
    } else {
      return 0;
    }
  }

  /*=============================================
    AÑADIMOS NUEVO ARTICULO FAVORITO
  =============================================*/
  static public function addFavoriteArticle($userId, $articleId){
    $res = self::findFavoriteArticle($articleId, $userId);
    if ($res != 1 ) {
      $res = ArticleModel::addFavoriteArticle($userId, $articleId);
    } else {
      $res = "ERROR";
    }
    return $res;
  }

  /*=============================================
    BORRAMOS ARTICULO FAVORITO
  =============================================*/
  static public function removeFavoriteArticle($userId, $articleId){
    $res = ArticleModel::removeFavoriteArticle($userId, $articleId);
    return $res;
  }

  /*=============================================
    BUSCA LOS COMENTARIOS DE CADA ARTICULO
  =============================================*/
  static public function findCommentsToArticle($article_id){
    $res = ArticleModel::findCommentsToArticle($article_id);
    return $res;
  }

  /*=============================================
    CREA UN COMENTARIO
  =============================================*/
  static public function createNewComment($userid, $articleid, $comment){
    $res = ArticleModel::createNewComment($userid, $articleid, $comment);
    return $res;
  }

  /*=============================================
    ACTUALIZA UN COMENTARIO
  =============================================*/
  static public function updateComment($commentId, $comment){
    $res = ArticleModel::updateComment($commentId, $comment);
    return $res;
  }

  /*=============================================
    ELIMINA UN COMENTARIO
  =============================================*/
  static public function deleteComment($deleteCommentId){
    $res = ArticleModel::deleteComment($deleteCommentId);
    return $res;
  }

}
