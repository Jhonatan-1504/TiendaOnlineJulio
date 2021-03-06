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
include_once "../models/Productos.php";

switch ($option) {
  case "listProduct":
    LIstarProduct();
    break;
  case "editProduct":
    BuscarProductoId();
    break;
  case 'addProduct':
    CrearProducto();
    break;
  case "updateProduct":
    ActualizarProducto();
    break;
  case "deleteProduct":
    BorrarProducto();
    break;
}

// HTTP_GET
/*
  http://localhost/TiendaOnlineJulio/api/controllers/ProductoController.php?option=listProduct
*/
function LIstarProduct()
{
  $reg = new Productos();
  echo json_encode($reg->All());
}

// HTTP_GET
/*
  http://localhost/TiendaOnlineJulio/api/controllers/ProductoController.php?option=editProduct&idProducto=1
*/
function BuscarProductoId()
{
  $reg = new Productos();
  $reg->Where(['ID_Producto' => $_GET['idProducto']]);
  echo json_encode($reg->All()[0]);
}

// HTTP_POST
/*
  http://localhost/TiendaOnlineJulio/api/controllers/ProductoController.php?option=addProduct
  
  FormData
  {
    "nombre":"Fuckboy",
    "descripcion":"Hora fuckboy poster",
    "stock":"15",
    "precio":"10.00",
    "idEmpleado":"1",
    "imagen": FILE,
  }
*/
function CrearProducto()
{
  // $request = json_decode(file_get_contents("php://input"));
  $request = json_decode(json_encode($_POST));

  $fileName = SaveFile('imagen', 'products');

  $datos = [
    "Nombre_Producto" => $request->nombre,
    "Descripcion_Producto" => $request->descripcion,
    "Imagen_Producto" => $fileName,
    "Stock_Producto" => $request->stock,
    "Precio_Producto" => $request->precio,
    "ID_Empleado" => $request->idEmpleado
  ];

  $reg = new Productos();
  $result = $reg->Create($datos, 6);
  if ($result) {
    echo "Producto registrado";
  }
}

// HTTP_POST
/*
  http://localhost/TiendaOnlineJulio/api/controllers/ProductoController.php?option=updateProduct&idProducto=1
  
  FormData
  {
    "nombre":"Fuckboy",
    "descripcion":"Hora fuckboy poster",
    "stock":"15",
    "precio":"10.00",
    "idEmpleado":"1",
    "imagen": FILE,
  }
*/
function ActualizarProducto()
{
  $request = json_decode(json_encode($_POST));

  $fileName = SaveFile('imagen', 'products');

  $datos = [
    "Nombre_Producto" => $request->nombre,
    "Descripcion_Producto" => $request->descripcion,
    "Stock_Producto" => $request->stock,
    "Precio_Producto" => $request->precio,
    "ID_Empleado" => $request->idEmpleado
  ];

  if (strlen($fileName) && $fileName !== 'Error') {
    $datos['Imagen_Producto'] = $fileName;
  }

  $reg = new Productos();
  $reg->Where(["ID_Producto" => $_GET['idProducto']]);
  $result = $reg->Update($datos);
  if ($result) {
    echo json_encode($datos);
  }
}

// HTTP_GET
/*
  http://localhost/TiendaOnlineJulio/api/controllers/ProductoController.php?option=deleteProduct&id=1
*/
function BorrarProducto()
{
  $reg = new Productos();
  $reg->Where(["ID_Producto" => $_GET['id']]);
  $result = $reg->Delete();
  if ($result->rowCount()) {
    http_response_code(200);
    echo json_encode(['msg' => 'Borrado']);
  } else {
    http_response_code(404);
    echo json_encode(["msg" => "Error"]);
  }
}

// HELPER
function SaveFile(string $key, string $dir)
{
  $directorio = "../../assets/$dir/";

  if (!isset($_FILES[$key]) || $_FILES[$key] === "Error") return "";

  $fileName = $_FILES[$key]['name'];
  $fileSave = $_FILES[$key]['tmp_name'];

  if (!file_exists($directorio)) {
    mkdir($directorio, 0777, true);
    if (file_exists($directorio)) {
      if (move_uploaded_file($fileSave, $fileName)) {
        return $fileName;
      } else {
        return "Error";
      }
    }
  } else {
    if (move_uploaded_file($fileSave, $directorio . $fileName)) {
      return $fileName;
    } else {
      return "Error";
    }
  }
}
