<?php

class Boleta
{
  private $db;
  private $table;
  private $where;
  private $array;
  private $select = "*";

  function __construct()
  {
    $this->db = new Database();
    $this->table = "boleta";
  }

  function QuestionInterrogation($count)
  {
    $array = [];
    for ($i = 0; $i < $count; $i++) {
      array_push($array, '?');
    }
    return implode(',', $array);
  }

  function Select(array $array){
    $this->select = implode(',',$array);
  }

  function All()
  {
    $query = "SELECT $this->select FROM $this->table $this->where";
    $sentence = $this->db->connect()->query($query);
    $sentence->execute();

    while ($row = $sentence->fetch(PDO::FETCH_ASSOC)) {
      $this->array[] = $row;
    }

    return $this->array;
  }

  function Create($miArray, $CountToSet)
  {
    $keys = implode(',', array_keys($miArray));
    $values = array_values($miArray);
    $question = $this->QuestionInterrogation($CountToSet);

    $query = "INSERT INTO $this->table ($keys) VALUES ($question)";
    $result = $this->db->connect()->prepare($query);
    $result->execute($values);

    return $result;
  }

  function Where($condicional)
  {
    $key = key($condicional);
    $value = $condicional[$key];
    $this->where = "WHERE $key = '$value'";
  }

  function Update($miarray)
  {
    $mykey = array();
    foreach ($miarray as $clave => $value) {
      array_push($mykey, "$clave = '$value'");
    }

    $query = "UPDATE $this->table SET " . implode(',', $mykey) . " $this->where";
    $result = $this->db->connect()->prepare($query);
    $result->execute();

    return $result;
  }

  function Delete()
  {
    $query = "DELETE FROM $this->table $this->where";
    $result = $this->db->connect()->prepare($query);
    $result->execute();

    return $result;
  }
}
