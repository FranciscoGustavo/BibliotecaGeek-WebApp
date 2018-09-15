<?php
class Conection
{

  public function starConection()
  {
    try {
      $connection = new PDO(
        'mysql:host=your_host; dbname=name_of_database',
        'you_user',
        'you_password',
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
