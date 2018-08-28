<?php
class AdminModel
{

  public function login($table,$item,$value){
    $conection = Conection::starConection();
    $elements = $conection->prepare(
      "SELECT * FROM $table WHERE $item = '$value'"
    );
    $elements->execute();
    return $elements->fetch();
  }

}
