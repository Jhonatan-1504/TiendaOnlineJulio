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
include_once "../models/DetallesBoleta.php";

switch ($option) {
  case "listarDetallesId":
    BuscarDetallesBoletaId();
    break;
}

// HTTP_GET
/*
  http://localhost/TiendaOnlineJulio/api/controllers/DetalleBoletaController.php?option=listarDetallesId&idBoleta=1
*/
function BuscarDetallesBoletaId()
{
  $reg = new DetalleBoleta();
  $reg->Where(['ID_Boleta' => $_GET['idBoleta']]);
  echo json_encode($reg->All());
}