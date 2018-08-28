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

      if(preg_match('/^[a-zA-ZñÑáéíóúÁÉÍÓÚ]+$/', $_POST["logupUsername"]) &&
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

             date_default_timezone_set("America/Bogota");

             $url = Rutes::mainRute();

             $mail = new PHPMailer;

             $mail->CharSet = 'UTF-8';

             $mail->isMail();

             $mail->setFrom('hidalgofco520@gmail.com', 'Biblioteca Geek');

             $mail->addReplyTo('hidalgofco520@gmail.com', 'Biblioteca Geek');

             $mail->Subject = "Por favor verifique su dirección de correo electrónico";

             $mail->addAddress($_POST["logupEmail"]);

             $mail->msgHTML('<a href="'.$url.'verificar/'.$encryptedEmail.'" target="_blank" style="text-decoration:none">');

             $envio = $mail->Send();

             if(!$envio){
               return printf("<script>
                 window.addEventListener('load', ()=>{
                   title = '¡Upss!';
                   message = 'Tu cuenta ha sido creada, pero no se pudo enviar el correo de confirmacion ponte en contacto con nuestro servicio tecnico';
                   new AlertModal(title, message, 'Cerrar','warning',()=>{
                     history.back();
                   });
                 });
              </script>");
             }else {
               return printf("<script>
                window.addEventListener('load', ()=>{
                  title = '¡Genial!';
                  message = 'Tu cuenta a sido creada con exito, porfavor revisa tu correo para confirmarla';
                  new AlertModal(title, message, 'Aceptar','ok', ()=>{
                    history.back();
                  });
                });
              </script>");
             }



           } else {
             return printf("<script>
               window.addEventListener('load', ()=>{
                 title = '¡Error!';
                 message = 'No se pudo crear la cuenta porfavor pongase en contacto con nuestro servicio tecnico';
                 new AlertModal(title, message, 'Aceptar','warning', ()=>{
                   history.back();
                 });
               });
            </script>");
           }

      } else {
        return printf("<script>
          window.addEventListener('load', ()=>{
            title = '¡Atención!';
            message = 'No se aceptan caracteres especiales';
            new AlertModal(title, message, 'Aceptar','warning', ()=>{
              history.back();
            });
          });
       </script>");
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
               return printf("<script>
                 window.addEventListener('load', ()=>{
                   title = '¡Ups...!';
                   message = 'Al parecer a un no has verificado tu cuenta revisa tu correo o bandeja de spam';
                   new AlertModal(title, message, 'Aceptar','warning', ()=>{
                     history.back();
                   });
                 });
              </script>");
             } else {
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
               $_SESSION["time"] = self::timesTampData($res['registration_date']);

               return printf("<script>
                window.location  = localStorage.getItem('currentRute');
               </script>");

             }
           } else {
              return printf("<script>
                window.addEventListener('load', ()=>{
                  title = 'Error!';
                  message = 'Porfavor revise que el correo o la contraseña sean correctos';
                  new AlertModal(title, message, 'Aceptar','error', ()=>{
                    history.back();
                  });
                });
              </script>");
           }

      } else {
        return printf("<script>
          window.addEventListener('load', ()=>{
            title = '¡Atención!';
            message = 'No se aceptan caracteres especiales';
            new AlertModal(title, message, 'Aceptar','warning', ()=>{
              history.back();
            });
          });
       </script>");
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
            date_default_timezone_set("America/Bogota");

            $mail = new PHPMailer;

            $mail->CharSet = 'UTF-8';

            $mail->isMail();

            $mail->setFrom('cursos@tutorialesatualcance.com', 'Tutoriales a tu Alcance');

            $mail->addReplyTo('cursos@tutorialesatualcance.com', 'Tutoriales a tu Alcance');

            $mail->Subject = "Solicitud de nueva contraseña";

            $mail->addAddress($_POST['forgottenEmail']);

            $mail->msgHTML($newPassword);

            $envio = $mail->Send();

            if(!$envio){
              return printf("<script>
                window.addEventListener('load', ()=>{
                  title = '¡Error!';
                  message = 'Hubo un error en su cambio de contraseña';
                  new AlertModal(title, message, 'Aceptar','error', ()=>{
                    history.back();
                  });
                });
              </script>");
            } else {
              return printf("<script>
                window.addEventListener('load', ()=>{
                  title = '¡Exito!';
                  message = '¡Por favor revise la bandeja de entrada o la carpeta de SPAM de su correo electrónico para su cambio de contraseña!';
                  new AlertModal(title, message, 'Aceptar','ok', ()=>{
                    history.back();
                  });
                });
              </script>");
            }
          }

        } else {
          return printf("<script>
            window.addEventListener('load', ()=>{
              title = '¡Error!';
              message = 'El correo no exitse';
              new AlertModal(title, message, 'Aceptar','error', ()=>{
                history.back();
              });
            });
          </script>");
        }
      } else {
        return printf("<script>
          window.addEventListener('load', ()=>{
            title = '¡Alerta!';
            message = 'Escriba correctamente la contraseña no se aceptan caracteres especiales';
            new AlertModal(title, message, 'Aceptar','warning', ()=>{
              history.back();
            });
          });
        </script>");
      }
    }
  }

  /*=============================================
    CONVIERTE LA FECHA
  =============================================*/
  static public function timesTampData($fecha){
    $timestamp = strtotime($fecha);
    $meses = ['Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre'];

    $dia = date('d', $timestamp);
    $mes = date('m', $timestamp) - 1;
    $year = date('Y', $timestamp);

    $fecha = "$dia/" . $meses[$mes] . "/$year";
    return $fecha;
  }

  /*=============================================
    REGISTRO CON REDES SOCIALES
  =============================================*/
  static public function logupSocialMedia($data){

    $item = "email";
    $value = $data['email'];
    $emailRepet = false;

    $resFindRepet =  UserModel::findUser($item, $value);

    if ($resFindRepet) {
      if ($resFindRepet['mode'] != $data['mode']) {
        return printf("<script>
          window.addEventListener('load', ()=>{
            title = '¡ERROR!!';
            message = 'El correo electrónic, ya está registrado en el sistema con un método diferente a Google!';
            new AlertModal(title, message, 'Cerrar','error',()=>{
              history.back();
            });
          });
       </script>");
       $emailRepet = false;
      }
      $emailRepet = true;
    } else {
      $res = UserModel::logup($data);
    }

    if($emailRepet || $res == "OK"){

      $resFind =  UserModel::findUser($item, $value);

      if ($resFind['mode'] == "facebook") {
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
         $_SESSION["time"] = self::timesTampData($resFind['registration_date']);

         return "OK";
      } else if ($resFind['mode'] == "google") {

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
         $_SESSION["time"] = self::timesTampData($resFind['registration_date']);

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

        return printf("<script>
          window.addEventListener('load', ()=>{
            title = '¡Genial!';
            message = '¡Su cuenta se ah actualizado con exito!';
            new AlertModal(title, message, 'Aceptar','ok',()=>{
              history.back();
            });
          });
       </script>");
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
}
