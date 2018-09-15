<?php
include_once "../models/user_model.php";
include_once "../models/conection.php";

include_once "../controllers/user_controller.php";
include_once "../controllers/template_controller.php";

class UserAjax
{
  /*=============================================
    BUSCA EL CORREO A REGISTRAR EN LA BASE SE DATOS
  =============================================*/
  public $email;

  public function findEmail (){
    $res = UserController::findUser("email", $this->email);
    if ($res == false) {
      return printf("true");
    } else {
      if ($res['mode'] == "direct") {
        $message = "Este correo ya esta registrado y fue de manera directa";
      } else if ($res['mode'] == "facebook") {
          $message = "Este correo ya esta registrado y fue con facebook";
      } else if ($res['mode'] == "google") {
          $message = "Este correo ya esta registrado y fue con google";
      }
      return printf($message);
    }
  }

  /*=============================================
    REGISTRO CON FACEBOOK
  =============================================*/
  public $fbEmail;
  public $fbName;
  public $fbPhoto;

  public function logupFacebook(){
    $data = array(
      "username" => $this->fbName,
      "password" => "null",
      "email" => $this->fbEmail,
      "photo" => $this->fbPhoto,
      "cover" => "",
      "mode" => "facebook",
      "check" => 0,
      "encryptedEmail" => "null",
      "notifications" => 0,
      "news" => 0
    );

    $res= UserController::logupSocialMedia($data);

    return printf($res);

  }

  /*=============================================
    ACTIVA O DESACTIVA LAS NOTIFICACIONES
  =============================================*/
  public $table;
  public $value;
  public $userId;

  public function changeNotifications(){
    $res = UserController::updateNotificatiosOrNew($this->table, $this->value, $this->userId);
    return printf($res);
  }

  /*=============================================
    CARGAR ARTICULOS FAVORITOS
  =============================================*/
  public function loadArticlesFavorites(){
    $data = '';
    $res = $favoritesArticles = UserController::findFavoritesArticles($this->userId);
    $data = '[{}';
    foreach ($res as $value) {
      $data .= ',{';
      $data .= '"name":"'.substr($value["first_name"], 0, 10).'"';
      $data .= ',"title":"'.$value["title"].'"';
      $data .= ',"image":"'.$value["image"].'"';
      $data .= ',"url":"'.$value["url"].'"';
      $data .= ',"time":"'.TemplateController::timesTampData($value["registration_date"]).'"';
      $data .= '}';
    }

    $data .= ']';
    return printf($data);
  }

  public function loadCommentsFavorites(){
    $data = '';
    $res = UserController::findCommentsToUser($this->userId);
    $data = '[{}';
    foreach ($res as $value) {
      $data .= ',{';
      $data .= '"commentid":"'.$value["comment_id"].'"';
      $data .= ',"user":"'.$value["user_id"].'"';
      $data .= ',"username":"'.$value["username"].'"';
      $data .= ',"photo":"'.$value["photo"].'"';
      $data .= ',"comment":"'.$value["comment"].'"';
      $data .= '}';
    }

    $data .= ']';
    return printf($data);
  }

}

/*=============================================
  BUSCA EL CORREO A REGISTRAR EN LA BASE SE DATOS
=============================================*/
  if (isset($_POST["logupEmail"])) {
    $Ajax = new UserAjax();
    $Ajax ->email = $_POST["logupEmail"];
    $Ajax ->findEmail();
  }

/*=============================================
  REGISTRO CON FACEBOOK
=============================================*/
  if (isset($_POST["logupFb"])) {
    $Ajax = new UserAjax();
    $Ajax ->fbEmail = $_POST["email"];
    $Ajax ->fbName = $_POST["name"];
    $Ajax ->fbPhoto = $_POST["photo"];
    $Ajax ->logupFacebook();
  }

/*=============================================
  ACTIVA O DESACTIVA LAS NOTIFICACIONES
=============================================*/
  if (isset($_POST["notification"])) {
    $Ajax = new UserAjax();
    $Ajax->table = $_POST['notification'];
    $Ajax->value = $_POST['value'];
    $Ajax->userId = $_POST['user'];
    $Ajax ->changeNotifications();
  }

  /*=============================================
    CARGA ARTICULOS FAVORITOS
  =============================================*/
  if (isset($_POST["loadFavorites"])) {
    $Ajax = new UserAjax();
    $Ajax ->userId = $_POST["userId"];
    $Ajax ->loadArticlesFavorites();
  }

  /*=============================================
    CARGA COMENTARIOS DEL USUARIO
  =============================================*/
  if (isset($_POST["loadComments"])) {
    $Ajax = new UserAjax();
    $Ajax ->userId = $_POST["userId"];
    $Ajax ->loadCommentsFavorites();
  }
