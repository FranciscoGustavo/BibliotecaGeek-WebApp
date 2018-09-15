<?php

class UserController
{
  /*=============================================
    REGISTRO DE USUARIOS
  =============================================*/
  public function logupUser(){
    /*=============================================
      VALIDA LOS DATOS INGRESADOS
    =============================================*/
    if(isset($_POST["logupUserTerms"])){
      if(preg_match('/^[a-zA-ZñÑáéíóúÁÉÍÓÚ0-9 ]+$/', $_POST["logupUsername"]) &&
         preg_match('/^[^0-9][a-zA-Z0-9_]+([.][a-zA-Z0-9_]+)*[@][a-zA-Z0-9_]+([.][a-zA-Z0-9_]+)*[.][a-zA-Z]{2,4}$/', $_POST["logupEmail"]) &&
         preg_match('/^[a-zA-Z0-9]+$/', $_POST["logupPassword"])){
           /*=============================================
             ENCRIPTAR CONTRASEÑA
             ENCRIPTAR CORREO ELECTRONICO
           =============================================*/
           $encryptedPassword = crypt($_POST["logupPassword"], '$2a$07$asxx54ahjppf45sd87a5a4dDDGsystemdev$');
           $encryptedEmail = md5($_POST["logupEmail"]);

           /*=============================================
             ARREGLO QUE CONTIENE TODOS LOS DATOS
             DEL REGISTRO
           =============================================*/
           $data = array(
              "username" => $_POST["logupUsername"],
              "password" =>  $encryptedPassword,
              "email" =>  $_POST["logupEmail"],
              "photo" => "",
              "cover" => "",
              "mode" =>  "direct",
              "check" =>  1,
              "encryptedEmail" => $encryptedEmail,
              "notifications" => 0,
              "news" => 0
            );

           $res = UserModel::logup($data);
           if ($res == "OK") {

             /*=============================================
             VERIFICACIÓN CORREO ELECTRÓNICO
             =============================================*/
            $home = "http://localhost/bibliotecageek/";
            $message = '<a href="'.$home.'verificar/'.$encryptedEmail.'" target="_blank" style="text-decoration:none">Validar</a>';
            $envio = self::sendEmail($_POST["logupEmail"], "Cuenta registrada", $message);

             if(!$envio){
               /*=============================================
                 LA CUENTA SE CREO PERO NO SE ENVIO CORREO DE VERIFICACIÓN
               =============================================*/
               $type = "'warning'";
               $title = "'¡Upss!'";
               $message = "'Tu cuenta ha sido creada, pero no se pudo enviar el correo de confirmacion ponte en contacto con nuestro servicio tecnico'";
               $button = "'Aceptar'";
               $callback = "history.back();";
               return self::alert($type, $title, $message, $button, $callback);
             }else {
               /*=============================================
                 LA CUENTA SE CREO CON EXITO
               =============================================*/
               $type = "'ok'";
               $title = "'¡Genial!'";
               $message = "'Tu cuenta a sido creada con exito, porfavor revisa tu correo para confirmarla'";
               $button = "'Aceptar'";
               $callback = "history.back();";
               return self::alert($type, $title, $message, $button, $callback);
             }
           } else {
             /*=============================================
               lA CUENTA NO SE PUDO CREAR EN LA BASE DE DATOS
             =============================================*/
             $type = "'error'";
             $title = "'¡Error!'";
             $message = "'No se pudo crear la cuenta porfavor pongase en contacto con nuestro servicio tecnico'";
             $button = "'Aceptar'";
             $callback = "history.back();";
             return self::alert($type, $title, $message, $button, $callback);
          }

      } else {
        /*=============================================
          CARACTERES EN LOS DATOS DEL USUARIO
        =============================================*/
        $type = "'warning'";
        $title = "'¡Atención!'";
        $message = "'No se aceptan caracteres especiales'";
        $button = "'Aceptar'";
        $callback = "history.back();";
        return self::alert($type, $title, $message, $button, $callback);
      }

    }

  }

  /*=============================================
    BUSCA AL USUARIO ESPECIFICADO
  =============================================*/
  static public function findUser($item, $value){
    return UserModel::findUser($item, $value);
  }

  /*=============================================
    ACTUALIZA EL USUARIO
  =============================================*/
  static public function updateUser($id, $item, $value){
    return UserModel::updateUser($id, $item, $value);
  }

  /*=============================================
    INICIO DE SESSION
  =============================================*/
  public function loginUser(){
    if(isset($_POST["loginEmail"])){

      if(preg_match('/^[^0-9][a-zA-Z0-9_]+([.][a-zA-Z0-9_]+)*[@][a-zA-Z0-9_]+([.][a-zA-Z0-9_]+)*[.][a-zA-Z]{2,4}$/', $_POST["loginEmail"]) &&
         preg_match('/^[a-zA-Z0-9]+$/', $_POST["loginPassword"])){

           /*=============================================
             ENCRIPTAR CONTRASEÑA
             ENCRIPTAR CORREO ELECTRONICO
           =============================================*/
           $encryptedPassword = crypt($_POST["loginPassword"], '$2a$07$asxx54ahjppf45sd87a5a4dDDGsystemdev$');

           $item = "email";
           $value = $_POST['loginEmail'];

           $res = UserModel::findUser($item, $value);

           if($res['email'] == $_POST['loginEmail'] && $res['password'] == $encryptedPassword){
             if ($res['checked'] == 1) {
               /*=============================================
                 lA CUENTA AUN NO ES VALIDADA
               =============================================*/
               $type = "'warning'";
               $title = "'¡Ups...!'";
               $message = "'Al parecer a un no has verificado tu cuenta revisa tu correo o bandeja de spam'";
               $button = "'Aceptar'";
               $callback = "history.back();";
               return self::alert($type, $title, $message, $button, $callback);

               } else {
               /*=============================================
                 SE CREAN LAS VARIABLES DE SESION
               =============================================*/
               $_SESSION["checkSession"] = "OK";
               $_SESSION["id"] = $res['user_id'];
               $_SESSION["username"] = $res['username'];
               $_SESSION["photo"] = $res['photo'];
               $_SESSION["cover"] = $res['cover'];
               $_SESSION["email"] = $res['email'];
               $_SESSION["password"] = $res['password'];
               $_SESSION["mode"] = $res['mode'];
               $_SESSION["notifications"] = $res['notifications'];
               $_SESSION["news"] = $res['news'];
               $_SESSION["time"] = TemplateController::timesTampData($res['registration_date']);

               return printf("<script>
                window.location  = localStorage.getItem('currentRute');
               </script>");

             }
           } else {
             /*=============================================
               EL CORREO O LA CONTRASEÑA NO CONCIDEN
             =============================================*/
             $type = "'error'";
             $title = "'¡Error!'";
             $message = "'Porfavor revise que el correo o la contraseña sean correctos'";
             $button = "'Aceptar'";
             $callback = "history.back();";
             return self::alert($type, $title, $message, $button, $callback);
           }

      } else {
        /*=============================================
          CARACTERES ESPECIALES
        =============================================*/
        $type = "'warning'";
        $title = "'¡Atención!'";
        $message = "'No se aceptan caracteres especiales'";
        $button = "'Aceptar'";
        $callback = "history.back();";
        return self::alert($type, $title, $message, $button, $callback);
      }
    }
  }

  /*=============================================
    OLVIDO DE CONTRASEÑA
  =============================================*/
  public function forgotten(){
    if(isset($_POST["forgottenEmail"])){
			if(preg_match('/^[^0-9][a-zA-Z0-9_]+([.][a-zA-Z0-9_]+)*[@][a-zA-Z0-9_]+([.][a-zA-Z0-9_]+)*[.][a-zA-Z]{2,4}$/', $_POST["forgottenEmail"])){
        /*=============================================
          GENERAR CONTRASEÑA ALEATORIA
        =============================================*/
        function generatePassword($longitud){

          $key = "";
          $pattern = "1234567890abcdefghijklmnopqrstuvwxyz";

          $max = strlen($pattern)-1;

          for($i = 0; $i < $longitud; $i++){

            $key .= $pattern{mt_rand(0,$max)};

          }

          return $key;
        }

        $newPassword = generatePassword(11);

        $encrypted = crypt($newPassword, '$2a$07$asxx54ahjppf45sd87a5a4dDDGsystemdev$');

        $item = "email";
        $value = $_POST["forgottenEmail"];

        /*=============================================
          BUSCA AL USUARIO EN LA BASE DE $datos
        =============================================*/
        $res = UserModel::findUser($item, $value);

        if ($res) {
          if ($res["mode"] == "direct") {
            $id = $res["user_id"];
    				$item = "password";
    				$value = "'".$encrypted."'";

            /*=============================================
              ACTUALIZA LA CONTRASEÑA
            =============================================*/
  					$res2 = UserModel::updateUser($id, $item, $value);
            if ($res2 == "OK") {
              /*=============================================
              CAMBIO DE CONTRASEÑA
              =============================================*/
              $message = "<h1>".$newPassword."</h1>";
              $envio = self::sendEmail($_POST["forgottenEmail"], "Solicitud de cambio de contraseña", $message);

              if(!$envio){
                /*=============================================
                  EL CORREO NO SE ENVIO PERO SI SE CAMBIO LA CONTRASEÑA
                =============================================*/
                $type = "'error'";
                $title = "'¡Error!'";
                $message = "'Hubo un error en su cambio de contraseña'";
                $button = "'Aceptar'";
                $callback = "history.back();";
                return self::alert($type, $title, $message, $button, $callback);
              } else {
                /*=============================================
                  EL CAMBIO DE CONTRASEÑA SE REALIZO CON EXITO
                =============================================*/
                $type = "'ok'";
                $title = "'¡Exito!'";
                $message = "'¡Por favor revise la bandeja de entrada o la carpeta de SPAM de su correo electrónico para su cambio de contraseña!'";
                $button = "'Aceptar'";
                $callback = "history.back();";
                return self::alert($type, $title, $message, $button, $callback);
              }
            }
          } else {
            /*=============================================
              EL CORREO FUE REGISTRADO CON UNA RED SOCIAL
            =============================================*/
            $type = "'warning'";
            $title = "'¡Error!'";
            $message = "'El correo fue registrado con alguna red social'";
            $button = "'Aceptar'";
            $callback = "history.back();";
            return self::alert($type, $title, $message, $button, $callback);
          }

        } else {
          /*=============================================
            EL CORREO NO FUE ENCONTRADO EN LA BASE DE DATOS
          =============================================*/
          $type = "'error'";
          $title = "'¡Error!'";
          $message = "'El correo no existe en nuestra base de datos'";
          $button = "'Aceptar'";
          $callback = "history.back();";
          return self::alert($type, $title, $message, $button, $callback);
        }
      } else {
        /*=============================================
          EN CASO QUE EL CORREO TRAIGA CARACTERES ESPECIALES
        =============================================*/
        $type = "'warning'";
        $title = "'¡Alerta!'";
        $message = "'Escriba correctamente la contraseña no se aceptan caracteres especiales'";
        $button = "'Aceptar'";
        $callback = "history.back();";
        return self::alert($type, $title, $message, $button, $callback);
      }
    }
  }

  /*=============================================
    REGISTRO CON REDES SOCIALES
  =============================================*/
  static public function logupSocialMedia($data){

    $item = "email";
    $value = $data['email'];
    $emailRepet = false;

    $resFindRepet =  UserModel::findUser($item, $value);

    /*=============================================
      BUSCAMOS QUE LA CUENTA YA EXISTA Y SU METODO DE
      REGISTRO SEA DIFERENTE A FACEBOOK O GOOGLE
    =============================================*/
    if ($resFindRepet) {
      if ($resFindRepet['mode'] != $data['mode']) {
        /*=============================================
          LA CUENTA SE CREO CON UN METODO DIFERENTE A REDES SOCIALES
        =============================================*/
        $type = "'error'";
        $title = "'¡ERROR!'";
        $message = "'El correo electrónico, ya está registrado en el sistema con un método diferente a ".$data['mode']."'";
        $button = "'Aceptar'";
        $callback = "history.back();";
        return self::alert($type, $title, $message, $button, $callback);
       $emailRepet = false;
      }
      $emailRepet = true;
    } else {
      /*=============================================
        SI LA CUENTA NO EXISTE LA CREAMOS
      =============================================*/
      $res = UserModel::logup($data);
    }

    /*=============================================
      SI EL CORREO YA EXISTE Y SE CREO CON GOOGLE
      O FACEBOOK O YA SE CREO UNA CUENTA NUEVA
    =============================================*/
    if($emailRepet || $res == "OK"){

      /*=============================================
        BUSCAMOS LA CUENTA Y CREAMOS LAS SESIONES
        DEPENDIENDO EL MODO DE REGISTRO.
      =============================================*/
      $resFind =  UserModel::findUser($item, $value);

      if ($resFind['mode'] == "facebook") {
        /*=============================================
          MODO FCEBOOK
        =============================================*/
        session_start();
         $_SESSION["checkSession"] = "OK";
         $_SESSION["id"] = $resFind['user_id'];
         $_SESSION["username"] = $resFind['username'];
         $_SESSION["photo"] = $resFind['photo'];
         $_SESSION["cover"] = $resFind['cover'];
         $_SESSION["email"] = $resFind['email'];
         $_SESSION["password"] = $resFind['password'];
         $_SESSION["mode"] = $resFind['mode'];
         $_SESSION["notifications"] = $resFind['notifications'];
         $_SESSION["news"] = $resFind['news'];
         $_SESSION["time"] = $resFind['registration_date'];

         return "OK";
      } else if ($resFind['mode'] == "google") {
        /*=============================================
          MODO GOOGLE
        =============================================*/
         $_SESSION["checkSession"] = "OK";
         $_SESSION["id"] = $resFind['user_id'];
         $_SESSION["username"] = $resFind['username'];
         $_SESSION["photo"] = $resFind['photo'];
         $_SESSION["cover"] = $resFind['cover'];
         $_SESSION["email"] = $resFind['email'];
         $_SESSION["password"] = $resFind['password'];
         $_SESSION["mode"] = $resFind['mode'];
         $_SESSION["notifications"] = $resFind['notifications'];
         $_SESSION["news"] = $resFind['news'];
         $_SESSION["time"] = $resFind['registration_date'];

         return "OK";
      } else {
        return null;
      }
    }
  }

  /*=============================================
    ACTUALIZAR PERFIL
  =============================================*/
  public function updateProfile(){
    if (isset($_POST['editUsername'])) {

      $rutePhoto = self::validateImages("editImage",$_POST['photo'],$_POST['hiddenUserId'], 500);
      $ruteCover = self::validateImages("editCover",$_POST['cover'],$_POST['hiddenUserId'], 140);

      if ($_POST['editPasword'] == "") {
        $password = $_POST['hiddenPasword'];
      } else {
        $password = crypt($_POST["editPasword"], '$2a$07$asxx54ahjppf45sd87a5a4dDDGsystemdev$');
      }

      $data = array("username"=>$_POST["editUsername"],
               "password"=> $password,
               "email"=> $_POST["editEmail"],
               "photo"=>$rutePhoto,
               "cover"=>$ruteCover,
               "id"=> $_POST['hiddenUserId']
             );

      $res = UserModel::updateProfile($data);

      if ($res == "OK") {
        $_SESSION["checkSession"] = "OK";
        $_SESSION["id"] = $data['id'];
        $_SESSION["username"] = $data['username'];
        $_SESSION["photo"] = $data['photo'];
        $_SESSION["cover"] = $data['cover'];
        $_SESSION["email"] = $data['email'];
        $_SESSION["password"] = $data['password'];
        /*=============================================
          EL CORREO NO SE ENVIO PERO SI SE CAMBIO LA CONTRASEÑA
        =============================================*/
        $type = "'ok'";
        $title = "'¡Genial!'";
        $message = "'¡Su cuenta se ah actualizado con exito!'";
        $button = "'Aceptar'";
        $callback = "history.back();";
        return self::alert($type, $title, $message, $button, $callback);
     }

    }
  }

  /*=============================================
  VALIDAR IMAGEN
  =============================================*/
  static private function validateImages($nameImage, $imageDefault, $userId, $startHigh){
    if (isset($_FILES[$nameImage]["tmp_name"]) && !empty($_FILES[$nameImage]["tmp_name"])) {
      /*=============================================
        PRIMERO PREGUNTAMOS SI EXISTE OTRA IMAGEN EN LA BASE DE DATOS
      =============================================*/

      $directory = "assets/images/users/".$userId;

      if (!empty($imageDefault)) {

        unlink($imageDefault);

      }else if(!file_exists($directory)){
        mkdir($directory, 0755);
      }
      /*=============================================
      GUARDAMOS LA IMAGEN EN EL DIRECTORIO
      =============================================*/
      list($width, $high) = getimagesize($_FILES[$nameImage]["tmp_name"]);

      $newWidth = 500;
      $newHigh = $startHigh;

      $randomName = mt_rand(100, 999);

      /*=============================================
        IMAGENES JPG
      =============================================*/
      if($_FILES[$nameImage]["type"] == "image/jpeg"){
        $rute = "assets/images/users/".$userId."/".$randomName.".jpg";

        /*=============================================
        MOFICAMOS TAMAÑO DE LA FOTO
        =============================================*/
        $origin = imagecreatefromjpeg($_FILES[$nameImage]["tmp_name"]);
        $destination = imagecreatetruecolor($newWidth, $newHigh);

        imagecopyresized($destination, $origin, 0, 0, 0, 0, $newWidth, $newHigh, $width, $high);
        imagejpeg($destination, $rute);

      }

      /*=============================================
        IMAGENES PNG
      =============================================*/
      if($_FILES[$nameImage]["type"] == "image/png"){

        $rute = "assets/images/users/".$userId."/".$randomName.".png";

        /*=============================================
        MOFICAMOS TAMAÑO DE LA FOTO
        =============================================*/

        $origin = imagecreatefrompng($_FILES[$nameImage]["tmp_name"]);

        $destination = imagecreatetruecolor($newWidth, $newHigh);

        imagealphablending($destination, FALSE);

        imagesavealpha($destination, TRUE);

        imagecopyresized($destination, $origin, 0, 0, 0, 0, $newWidth, $newHigh, $width, $high);

        imagepng($destination, $rute);

      }

    } else {
      $rute = $imageDefault;
    }

    return $rute;

  }

  /*=============================================
    ACTUALIZA LAS NOTIFICACIONES O LAS NOVEDADES
  =============================================*/
  static public function updateNotificatiosOrNew($table, $value, $userId){
    $res = UserModel::updateUser($userId, $table, $value);
    if($res == "OK"){
      session_start();
      $_SESSION[$table] = $value;
      return "OK";
    }
  }

  /*=============================================
    BUSCA LOS ARTICULOS FAVORITOS DEL USUARIO
  =============================================*/
  static public function findFavoritesArticles($userid){
    $res = UserModel::findFavoritesArticles($userid);
    return $res;
  }

  /*=============================================
    BUSCA LOS COMENTARIOS DE UN USUARIO
  =============================================*/
  static public function findCommentsToUser($user_id){
    $res = UserModel::findCommentsToUser($user_id);
    return $res;
  }

  /*=============================================
    ENVIA UN CORREO ELECTRONICO
  =============================================*/
  static private function sendEmail($emailDestination, $subject, $message){
    date_default_timezone_set("America/Mexico_City");

    $mail = new PHPMailer();

    $mail->Username = "hidalgofco520@gmail.com";
    $mail->Password = "hidalgolopez";

    $mail->CharSet = 'UTF-8';
    $mail->SMTPSecure = 'ssl';
    $mail->Host = "smtp.gmail.com"; // GMail
    $mail->Port = 465;
    $mail->IsSMTP(); // use SMTP
    $mail->SMTPAuth = true;
    $mail->setFrom($mail->Username,"Biblioteca Geek");
    $mail->AddAddress($emailDestination); // recipients email
    $mail->Subject = $subject;
    $mail->Body .= $message;
    $mail->IsHTML(true);

    return $mail->Send();
  }

  /*=============================================
    MANDA UNA ALERTA EN PANTALLA
  =============================================*/
  static private function alert($type, $title, $message, $button, $callback){
    $alert = "<script>";
      $alert .= "window.addEventListener('load', ()=>{";
        $alert .= "new AlertModal(".$title.",".$message.",".$button.",".$type.",()=>{".$callback."});";
      $alert .= "})";
    $alert .= "</script>";
    return printf($alert);
  }
}
