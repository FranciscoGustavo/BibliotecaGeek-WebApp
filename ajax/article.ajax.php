<?php
  include_once "../models/article_model.php";
  include_once "../controllers/article_controller.php";
  include_once "../models/conection.php";

  class ArticleAjax
  {
    /*=============================================
      ACTUALIZA LAS VISTAS DEL ARTICULO
    =============================================*/
    public $item;
    public $value;
    public $rute;

    public function updateViewArticle(){
      $request = ArticleController::updateViewArticleBy($this->rute, $this->item, $this->value);
      return printf($request);
    }

    /*=============================================
      AGREGA ARTICULO A FAVORITOS
    =============================================*/
    public $userId;
    public $articleId;
    public $favorite;

    public function changeMyFavoriteArticle(){
      if ($this->favorite == 1) {
        $res = ArticleController::removeFavoriteArticle($this->userId,$this->articleId);
        if($res == "OK"){
          $res = "ERROR";
        }
      } else {
        $res = ArticleController::addFavoriteArticle($this->userId,$this->articleId);
        if($res == "OK"){
          $res = "OK";
        }
      }
      return printf($res);
    }

    /*=============================================
      CREA UN COMENTARIO
    =============================================*/
    public $comment;

    public function createNewComment(){
      if (preg_match('/^[,\\.\\a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ ]+$/', $this->comment)) {
        $res = ArticleController::createNewComment($this->userId, $this->articleId, $this->comment);
        return printf($res);
      } else {
        return printf("characters");
      }
    }

    /*=============================================
      ACTUALIZA UN COMENTARIO
    =============================================*/
    public $commentId;
    public $commentUpdate;

    public function updateComment(){
      if (preg_match('/^[,\\.\\a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ ]+$/', $this->commentUpdate)) {
        $res = ArticleController::updateComment($this->commentId, $this->commentUpdate);
        return printf($res);
      } else {
        return printf("characters");
      }
    }

    /*=============================================
      ELIMINA UN COMENTARIO
    =============================================*/
    public $deleteComment;

    public function deleteComment(){
      $res = ArticleController::deleteComment($this->deleteComment);
      return printf($res);
    }

  }

  /*=============================================
    ACTUALIZA LAS VISTAS DEL ARTICULO
  =============================================*/
  if (isset($_POST["value"])) {
    $Ajax = new ArticleAjax();
    $Ajax ->item = $_POST["item"];
    $Ajax ->value = $_POST["value"];
    $Ajax ->rute = $_POST["rute"];
    $Ajax -> updateViewArticle();
  }

  /*=============================================
    AGREGA ARTICULO A FAVORITOS
  =============================================*/
  if (isset($_POST["favorite"])) {
    $Ajax = new ArticleAjax();
    $Ajax ->userId = $_POST["userid"];
    $Ajax ->articleId = $_POST["articleid"];
    $Ajax ->favorite = $_POST["favorite"];
    $Ajax ->changeMyFavoriteArticle();
  }

  /*=============================================
    CREA UN COMENTARIO
  =============================================*/
  if (isset($_POST["comment"])) {
    $Ajax = new ArticleAjax();
    $Ajax ->userId = $_POST["userId"];
    $Ajax ->articleId = $_POST["articleId"];
    $Ajax ->comment = $_POST["comment"];
    $Ajax ->createNewComment();
  }

  /*=============================================
    ACTUALIZA UN COMENTARIO
  =============================================*/
  if (isset($_POST["commentId"])) {
    $Ajax = new ArticleAjax();
    $Ajax ->commentId = $_POST["commentId"];
    $Ajax ->commentUpdate = $_POST["commentUpdate"];
    $Ajax ->updateComment();
  }

  /*=============================================
    ELIMINA UN COMENTARIO
  =============================================*/
  if (isset($_POST["deleteComment"])) {
    $Ajax = new ArticleAjax();
    $Ajax ->deleteComment = $_POST["deleteComment"];
    $Ajax ->deleteComment();
  }
