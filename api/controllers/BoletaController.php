<?php

if (!isset($_GET['option'])) {
  echo "<h1>No tienes permitido entrar a esta pagina</h1> <a href='http://localhost/TiendaOnlineJulio/'>Volver al Menu</a>";
  die();
}

if (!isset($_POST)) {
  echo "No hay datos asignados";
  die();
}

$option = $_GET['option'];

include_once "../config/config.php";
include_once "../models/database.php";
include_once "../models/Boleta.php";

switch ($option) {
  case "listarBoletasId":
    BuscarBoletasId();
    break;
}

// HTTP_GET
/*
  http://localhost/TiendaOnlineJulio/api/controllers/BoletaController.php?option=listarBoletasId&idUser=1
*/
function BuscarBoletasId()
{
  $reg = new Boleta();
  $reg->Where(['ID_Usuario' => $_GET['idUser']]);
  echo json_encode($reg->All());
}