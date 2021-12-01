<?php

class Productos
{
  private $db;
  private $table;
  private $array;
  private $where;

  function __construct()
  {
    $this->db = new Database();
    $this->table = "productos";
  }

  function QuestionInterrogation($count)
  {
    $array = [];
    for ($i = 0; $i < $count; $i++) {
      array_push($array, '?');
    }
    return $array;
  }

  function All()
  {
    $query = "SELECT * FROM $this->table";
    $sentence = $this->db->connect()->query($query);
    $sentence->execute();

    while ($row = $sentence->fetch(PDO::FETCH_ASSOC)) {
      $this->array[] = $row;
    }

    return $this->array;
  }

  function Create($product, $CountToSet)
  {
    $keys = array_keys($product);
    $values = array_values($product);
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

  function Update($product)
  {
    $values = array_values($product);
    $mykey = array();
    foreach ($product as $clave => $value) {
      array_push($mykey, "$clave = '$value'");
    }

    $query = "UPDATE $this->table SET " . implode(',', $mykey) . " $this->where";
    $result = $this->db->connect()->prepare($query);
    $result->execute($values);

    return $result;
  }

  function Delete(){
    $query = "DELETE FROM $this->table $this->where";
    $result = $this->db->connect()->prepare($query);
    $result->execute();

    return $result;
  }
}
