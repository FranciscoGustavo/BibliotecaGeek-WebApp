<?php
/**
 *
 */
class ArticlesController
{
  public function showArticles(){
    $res = ArticlesModel::showArticles();
    return $res;
  }

}
