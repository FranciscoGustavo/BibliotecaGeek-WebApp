<?php

class AdminController
{

  static public function login($dashboard){
    if (isset($_POST["loginEmail"])) {

      if(preg_match('/^[^0-9][a-zA-Z0-9_]+([.][a-zA-Z0-9_]+)*[@][a-zA-Z0-9_]+([.][a-zA-Z0-9_]+)*[.][a-zA-Z]{2,4}$/', $_POST["loginEmail"]) &&
         preg_match('/^[a-zA-Z0-9]+$/', $_POST["loginPassword"])){

           $table = "admin";
           $item = "email";
           $value = $_POST["loginEmail"];

           $res = AdminModel::login($table,$item,$value);
           //return $res;
           if ($res != false) {
             if ($res["email"] == $_POST['loginEmail'] && $res['password'] == $_POST['loginPassword']) {

               $_SESSION["adminCheckSession"] = "OK";
               $_SESSION["adminId"] = $res['admin_id'];
               $_SESSION["adminName"] = $res['first_name'];
               $_SESSION["adminLastName"] = $res['last_name'];
               $_SESSION["adminPhoto"] = $res['photo'];
               $_SESSION["adminEmail"] = $res['email'];
               $_SESSION["adminPassword"] = $res['password'];

               return printf('<script type="text/javascript">
                      window.location = "'.$dashboard.'"
                   </script>');

             } else {
               return "El correo o la contraseña no conciden";
             }
           } else {
             return "Correo no registrado";
           }

      } else {
        return "Error No se permiten caracteres especiales";
      }
    }
  }
}
