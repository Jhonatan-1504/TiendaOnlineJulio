<?php

if(!isset($_GET['option'])) {
  echo "<h1>No tienes permitido entrar a esta pagina</h1> <a href='http://localhost/TiendaOnlineJulio/'>Volver al Menu</a>";
  die();
}

$option = $_GET['option'];

include_once "../models/Productos.php";

switch ($option) {
  case 'add':
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
  case "list";
    Index();
    break;
}

// path "./api/controllers/ProductoController.php?option=list"
function Index()
{
  
}

function Create()
{
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
