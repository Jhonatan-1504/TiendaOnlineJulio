<?php

if (!isset($_GET['option'])) {
  echo "<h1>No tienes permitido entrar a esta pagina</h1> <a href='http://localhost:8080/TiendaOnlineJulio/'>Volver al Menu</a>";
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
  http://localhost:8080/TiendaOnlineJulio/api/controllers/DetalleBoletaController.php?option=listarDetallesId&idBoleta=42423453tetgdrgd
*/
function BuscarDetallesBoletaId()
{
  $reg = new DetalleBoleta();
  $reg->Inner('productos', ["ID_Producto", "ID_Producto"], 'p');
  $reg->Where(['ID_Boleta' => $_GET['idBoleta']]);
  echo json_encode($reg->All());
}

// HTTP_POST
/*
  http://localhost:8080/TiendaOnlineJulio/api/controllers/DetalleBoletaController.php?option=addDetalles

  {
    "products":[
      {
        "idProduct":"1",
        "count":"1",
        "price":"15.20"
      },
      {
        "idProduct":"2",
        "count":"2",
        "price":"55.90"
      },
      {
        "idProduct":"3",
        "count":"1",
        "price":"25.20"
      }
    ],
    "total":3,
    "idUser":1
  }

*/
function AgregarDetallesBoletaAndBoleta()
{
  $request = json_decode(file_get_contents("php://input"));

  $boleta = new Boleta();
  $detalles = new DetalleBoleta();

  $idBoleta = uniqid() . uniqid();

  $resultBoleta = $boleta->Create(["ID_Boleta" => $idBoleta, "ID_Usuario" => $request->idUser], 2);
  
  for ($i = 0; $i < $request->total; $i++) {
    $detalles->Create([
      "ID_Boleta" => $idBoleta,
      "Cantidad" => $request->products[$i]->count,
      "Final_Total" => $request->products[$i]->price,
      "ID_Producto" => $request->products[$i]->idProduct
    ], 4);
  }

  if ($resultBoleta->rowCount()) {
    http_response_code(200);
    echo json_encode(["msg" => "Agregado con exito"]);
  } else {
    http_response_code(404);
    echo json_encode(["msg" => "Enviaste mal algo"]);
  }
}
