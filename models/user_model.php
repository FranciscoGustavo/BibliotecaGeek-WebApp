<?php
/**
 *
 */
class UserModel
{
  /*=============================================
    REGISTRA EL NUEVO USUARIO
  =============================================*/
  static public function logup($data){
    $username = $data['username'];
    $password = $data['password'];
    $email = $data['email'];
    $mode = $data['mode'];
    $photo = $data['photo'];
    $cover = $data['cover'];
    $check = $data['check'];
    $encryptedEmail = $data['encryptedEmail'];
    $notifications = $data['notifications'];
    $news = $data['news'];


    $conection = Conection::starConection();
    $elements = $conection->prepare("INSERT INTO users(user_id, username, password, email, mode, photo, cover, checked, encryptedEmail, notifications, news, registration_date, last_time_update) VALUES
      (0, '$username', '$password', '$email', '$mode', '$photo', '$cover', $check, '$encryptedEmail', $notifications, $news,   CURRENT_TIMESTAMP, CURRENT_TIMESTAMP)
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
    BUSCA AL USUARIO
  =============================================*/
  static public function findUser($item, $value){
    $conection = Conection::starConection();
    $elements = $conection->prepare("SELECT * FROM users WHERE $item = '$value'");
    $elements->execute();

    return $elements->fetch();
  }

  /*=============================================
    ACTUALIZA USUARIO
  =============================================*/
  static public function updateUser($id, $item, $value){
    $conection = Conection::starConection();
    $elements = $conection->prepare("UPDATE users SET $item = $value WHERE user_id = $id");

    if($elements -> execute()){

      return "OK";

    }else{

      return "ERROR";

    }

    $elements-> close();

    $elements = null;
  }

  /*=============================================
    ACTUALIZA PERFIL DE USUARIO
  =============================================*/
  static public function updateProfile($data){
    $conection = Conection::starConection();
    $elements = $conection->prepare("UPDATE users SET username = :username, email = :email, password = :password, photo = :photo, cover = :cover, last_time_update = CURRENT_TIMESTAMP WHERE user_id = :id");

    $elements -> bindParam(":username", $data["username"], PDO::PARAM_STR);
    $elements -> bindParam(":email", $data["email"], PDO::PARAM_STR);
    $elements -> bindParam(":password", $data["password"], PDO::PARAM_STR);
    $elements -> bindParam(":photo", $data["photo"], PDO::PARAM_STR);
    $elements -> bindParam(":cover", $data["cover"], PDO::PARAM_STR);
    $elements -> bindParam(":id", $data["id"], PDO::PARAM_INT);

    if($elements -> execute()){

      return "OK";

    }else{

      return "ERROR";

    }

    $elements-> close();

    $elements = null;
  }

  /*=============================================
    BUSCA LOS ARTICULOS FAVORITOS DEL USUARIO
  =============================================*/
  static public function findFavoritesArticles($userid){
    $conection = Conection::starConection();
    $elements = $conection->prepare("
    SELECT  admin.first_name, categories.categorie_name, subcategories.subcategorie_name,
    		articles.article_id, articles.title, articles.description, articles.image,
    		articles.url, articles.registration_date FROM `favorites`

            INNER JOIN articles ON favorites.article_id = articles.article_id
            INNER JOIN admin ON articles.admin_id = admin.admin_id
            INNER JOIN categories ON articles.categorie_id = categories.categorie_id
            INNER JOIN subcategories ON articles.subcategorie_id = subcategories.subcategorie_id
            WHERE favorites.user_id = $userid
    ");

    $elements -> execute();
    return $elements->fetchAll();

    $elements-> close();

    $elements = null;
  }

  /*=============================================
    BUSCA LOS COMENTARIOS DE UN USUARIO
  =============================================*/
  static public function findCommentsToUser($user_id){
    $conection = Conection::starConection();
    $elements = $conection->prepare("
    SELECT comments.comment_id, users.user_id, users.username, users.photo, comment FROM `comments`
    INNER JOIN users ON comments.user_id = users.user_id
    WHERE comments.user_id = $user_id ORDER BY(comment_id) DESC
    ");

    $elements -> execute();
    return $elements->fetchAll();

    $elements-> close();

    $elements = null;
  }

}
