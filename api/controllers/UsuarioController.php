<?php

if(!isset($_GET['option'])) {
  echo "<h1>No tienes permitido entrar a esta pagina</h1> <a href='http://localhost/TiendaOnlineJulio/'>Volver al Menu</a>";
  die();
}

$option = $_GET['option'];

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

// path "./api/controllers/UsuarioController.php?option=list"

function Create()
{
  if(!isset($_POST)) {
    echo "No hay datos asignados";
    die();
  }

  $datos = [
    "Contraseña_Usuario"=>$_POST['Contraseña_Usuario'],
    "Nombre_Usuario"=>$_POST['Nombre_Usuario'],
    "Apellido_Usuario"=>$_POST['Apellido_Usuario'],
  ];

  $reg = new Usuario();
  $result = $reg->CreateUser($datos,3);

  if($result>0) {
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
