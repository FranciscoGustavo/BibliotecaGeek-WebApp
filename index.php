<?php
  include_once "models/rutes.php";
  include_once "models/conection.php";
  include_once "models/article_model.php";
  include_once "models/user_model.php";

  include_once "controllers/template_controller.php";
  include_once "controllers/user_controller.php";
  include_once "controllers/article_controller.php";

  include_once "extensions/PHPMailer/PHPMailerAutoload.php";
  include_once "extensions/vendor/autoload.php";

  $template = new TemplateController();
  $template -> template();
