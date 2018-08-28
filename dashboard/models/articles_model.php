<?php
/**
 *
 */
class ArticlesModel
{
  public function showArticles(){
    $conection = Conection::starConection();
    $elements = $conection->prepare(
      "SELECT * FROM articles ORDER BY(article_id) DESC LIMIT 10"
    );
    $elements->execute();
    return $elements->fetchAll();
  }
}
