<?php
class Conection
{

  public function starConection()
  {
    try {
      $connection = new PDO(
        'mysql:host=localhost;dbname=librarydb',
        'root',
        '',
        array(
          PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
          PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"
        )
			);
      return $connection;
    } catch(PDOException $e) {
      return false;
    }
  }
}
