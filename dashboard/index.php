<?php
  include_once "models/rutes.php";
  include_once "models/conection.php";
  include_once "models/admin_model.php";
  include_once "models/articles_model.php";

  include_once "controllers/template_controller.php";
  include_once "controllers/admin_controller.php";
  include_once "controllers/articles_controller.php";

  $template = new TemplateController();
  $template -> template();
