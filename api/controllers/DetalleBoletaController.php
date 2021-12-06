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
include_once "../models/DetallesBoleta.php";

switch ($option) {
  case "listarDetallesId":
    BuscarDetallesBoletaId();
    break;
  case "addDetalles":
    AgregarDetallesBoletaAndBoleta();
    break;
}

// HTTP_GET
/*
  http://localhost/TiendaOnlineJulio/api/controllers/DetalleBoletaController.php?option=listarDetallesId&idBoleta=1
*/
function BuscarDetallesBoletaId()
{
  $reg = new DetalleBoleta();
  // $reg->Inner();
  $reg->Where(['ID_Boleta' => $_GET['idBoleta']]);
  echo json_encode($reg->All());
}

// HTTP_POST
/*
  http://localhost/TiendaOnlineJulio/api/controllers/DetalleBoletaController.php?option=addDetalles&idUser=1
*/
function AgregarDetallesBoletaAndBoleta(){
  $request = json_decode(file_get_contents("php://input"));

  $boleta = new Boleta();
  $detalles = new DetalleBoleta();

  $idBoleta = uniqid() . uniqid();

  // sendBoleta

  // sendDetalleBoleta
  echo json_encode($request->products);
   
}