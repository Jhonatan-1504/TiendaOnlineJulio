<?php

if (!isset($_GET['option'])) {
  echo "<h1>No tienes permitido entrar a esta pagina</h1> <a href='http://localhost/TiendaOnlineJulio/'>Volver al Menu</a>";
  die();
}

$option = $_GET['option'];

include_once "../config/config.php";
include_once "../models/database.php";
include_once "../models/Usuario.php";

switch ($option) {
  case 'addUser':
    Create();
    break;
  case "edit":
    Edit();
    break;
  case "update":
    Update();
    break;
  case "delete":
    Deletes();
    break;
}

/*
http://localhost/TiendaOnlineJulio/api/controllers/UsuarioController.php?option=addUser

{
    "nameUser":"PincheENZO",
    "password":"123"
}
*/

function Create()
{
  if (!isset($_POST)) {
    echo "No hay datos asignados";
    die();
  }

  $request = json_decode(file_get_contents("php://input"));

  $datos = [
    "Contraseña_Usuario" => $request->password,
    "Nombre_Usuario" => $request->nameUser
  ];

  $reg = new Usuario();
  $result = $reg->CreateUser($datos, 2);

  if ($result > 0) {
    $_SESSION['msg'] = "Registrado correctamente";
  };
}

function Update()
{
}

function Deletes()
{
}

function Edit()
{
}
