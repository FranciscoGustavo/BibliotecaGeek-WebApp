<?php
  require 'article_controller.php';

  class MainController
  {
    function __construct()
    {
      if ($_SERVER['REQUEST_METHOD'] == 'POST') {

       }
       if ($_SERVER['REQUEST_METHOD'] == 'GET') {
         if ($_GET['view'] == 'articles') {
           $Article = new Article();
           $Article->ShowArticles();
         }
       }
    }
  }

  $app = new MainController();


?>
