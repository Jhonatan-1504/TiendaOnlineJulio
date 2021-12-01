<?php

class Usuario
{
  private $db;
  private $table;
  private $where;

  function __construct()
  {
    $this->db = new Database();
    $this->table = "usuario";
  }

  function QuestionInterrogation($count)
  {
    $array = [];
    for ($i = 0; $i < $count; $i++) {
      array_push($array, '?');
    }
    return $array;
  }


  function CreateUser($usuario, $CountToSet)
  {
    $keys = array_keys($usuario);
    $values = array_values($usuario);
    $question = $this->QuestionInterrogation($CountToSet);

    $query = "INSERT INTO $this->table ($keys) VALUES ($question)";
    $result = $this->db->connect()->prepare($query);
    $result->execute($values);

    return $result;
  }

  function Where($condicional){
    $key = key($condicional);
    $value = key($condicional);
    $this->where = "WHERE $key = $value";
  }

  function Update($usuario)
  {
    $values = array_values($usuario);
    $mykey = array();
    foreach ($usuario as $clave => $value) {
      array_push($mykey, "$clave = '$value'");
    }

    $query = "UPDATE $this->table SET " . implode(',', $mykey) . " $this->where";
    $result = $this->db->connect()->prepare($query);
    $result->execute($values);

    return $result;
  }


}
