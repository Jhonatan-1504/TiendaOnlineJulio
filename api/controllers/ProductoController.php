<?php

if (!isset($_GET['option'])) {
  echo "<h1>No tienes permitido entrar a esta pagina</h1> <a href='http://localhost/TiendaOnlineJulio/'>Volver al Menu</a>";
  die();
}

if (!isset($_POST)) {
  echo "No hay datos asignados";
  die();
}

$table = "calero";

$option = $_GET['option'];

include_once "../config/config.php";
include_once "../models/database.php";
include_once "../models/Productos.php";

switch ($option) {
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
  http://localhost/TiendaOnlineJulio/api/controllers/ProductoController.php?option=updateProduct&id=1
  
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
    "Imagen_Producto" => $fileName,
    "Stock_Producto" => $request->stock,
    "Precio_Producto" => $request->precio,
    "ID_Empleado" => $request->idEmpleado
  ];

  $reg = new Productos();
  $reg->Where(["ID_Producto" => $_GET['id']]);
  $result = $reg->Update($datos);
  if ($result) {
    echo "Producto actualizado";
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
  if ($result) {
    echo "Borrado con exito";
  }
}

// HELPER
function SaveFile(string $key, string $dir)
{
  $directorio = "../../assets/$dir/";

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
