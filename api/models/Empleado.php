<?php

class Empleado
{
  private $db;
  private $table;
  private $where;
  private $array;
  private $select = "*";

  function __construct()
  {
    $this->db = new Database();
    $this->table = "empleado";
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

  function CreateUser($empleado, $CountToSet)
  {
    $keys = implode(',', array_keys($empleado));
    $values = array_values($empleado);
    $question = $this->QuestionInterrogation($CountToSet);

    $query = "INSERT INTO $this->table ($keys) VALUES ($question)";
    $result = $this->db->connect()->prepare($query);
    $result->execute($values);

    return $result;
  }

  function Verification(string $username,string $password){
    $this->where = "WHERE Email_Empleado='$username' AND Contraseña_Empleado='$password'";
  }

  function Where($condicional)
  {
    $key = key($condicional);
    $value = $condicional[$key];
    $this->where = "WHERE $key = '$value'";
  }

  function UpdateUser($empleado)
  {
    $mykey = array();
    foreach ($empleado as $clave => $value) {
      array_push($mykey, "$clave = '$value'");
    }

    $query = "UPDATE $this->table SET " . implode(',', $mykey) . " $this->where";
    $result = $this->db->connect()->prepare($query);
    $result->execute();

    return $result;
  }

  function DeleteUser()
  {
    $query = "DELETE FROM $this->table $this->where";
    $result = $this->db->connect()->prepare($query);
    $result->execute();

    return $result;
  }
}
