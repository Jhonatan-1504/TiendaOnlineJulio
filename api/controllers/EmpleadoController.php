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
include_once "../models/Empleado.php";

switch ($option) {
  case "perfil":
    BuscarIdEmpleado();
  break;
  case 'verificar':
    VerificarEmpleado();
    break;
  case 'addUser':
    CrearNuevoEmpleado();
    break;
  case "updatePassword":
    ActualizarPassword();
    break;
  case "updateAllData":
    ActualizarAll();
    break;
  case "deleteUser":
    BorraCuenta();
    break;
}

// HTTP_GET
/*
http://localhost:8080/TiendaOnlineJulio/api/controllers/EmpleadoController.php?option=perfil&idUser=1
*/
function BuscarIdEmpleado(){
  $reg = new Empleado();
  $reg->Where(["ID_Empleado"=>$_GET['idUser']]);
  $result = $reg->All();
  if($result === null){
    http_response_code(404);
    echo json_encode(["msg"=>"No existe Empleado"]);
    die();
  }
  echo json_encode($result[0]);
}


// HTTP_POST
/*
http://localhost:8080/TiendaOnlineJulio/api/controllers/EmpleadoController.php?option=verificar
{
  "email":'PincheENZO',
  "password":'12345'
}
*/
function VerificarEmpleado()
{
  $request = json_decode(json_encode($_POST));

  $reg = new Empleado();
  $reg->Verification($request->email, $request->password);
  $user = $reg->All();
  if ($user !== null) {
    http_response_code(200);
    echo json_encode($user[0]);
  } else {
    http_response_code(404);
    echo json_encode(['msg' => 'No existe']);
  }
}

// HTTP_POST
/*
http://localhost:8080/TiendaOnlineJulio/api/controllers/EmpleadoController.php?option=addUser

{
    "nameUser":"PincheENZO",
    "password":"123"
}
*/
function CrearNuevoEmpleado()
{
  $request = json_decode(json_encode($_POST));

  $datos = [
    "Email_Empleado" => $request->nameUser,
    "Contraseña_Empleado" => $request->password
    
  ];

  $reg = new Empleado();
  $result = $reg->CreateUser($datos, 2);

  if ($result) {
    echo "Registrado correctamente";
  };
}

// HTTP_POST
/*
http://localhost:8080/TiendaOnlineJulio/api/controllers/EmpleadoController.php?option=updatePassword

  {
    "email":"pINCHEeNZO",
    "password":"12345678"
  }
*/
function ActualizarPassword()
{
  $request = json_decode(json_encode($_POST));

  $datos = ["Contraseña_Empleado" => $request->password];

  $reg = new Empleado();
  $reg->Select(["ID_Empleado"]);
  $reg->Where(["Email_Empleado" => $request->email]);
  $user = $reg->All();

  if ($user === null) {
    http_response_code(404);
    echo json_encode(["msg" => "Correo no existe"]);
    die();
  }

  http_response_code(200);
  $result = $reg->UpdateUser($datos);

  if ($result) {
    echo "Actualizado con exito";
  }
}

// HTTP_POST
/*
http://localhost:8080/TiendaOnlineJulio/api/controllers/EmpleadoController.php?option=updateAllData&id=1

  {
    "dni":"87456321",
    "correo":"PincheEnzo@gmail.com",
    "nombre":"Piña",
    "apellido":"Enzo",
    "telefono":"987456321"
  }
*/
function ActualizarAll()
{
  $request = json_decode(file_get_contents("php://input"));

  $datos = [
    "DNI_Empleado" => $request->dni,
    "Email_Empleado" => $request->correo,
    "Nombres_Empleado" => $request->nombre,
    "Apellidos_Empleado" => $request->apellido,
    "Telefono_Empleado" => $request->telefono
  ];

  $reg = new Empleado();
  $reg->Where(["ID_Empleado" => $_GET['id']]);
  $result = $reg->UpdateUser($datos);

  if ($result) {
    echo "Actualizado con exito";
  }
}

// HTTP_GET
/*
http://localhost:8080/TiendaOnlineJulio/api/controllers/EmpleadoController.php?option=deleteUser&id=1
*/

function BorraCuenta()
{
  $reg = new Empleado();

  $reg->Where(["ID_Empleado" => $_GET['id']]);
  $result = $reg->DeleteUser();

  if ($result) {
    echo "Borrado con exito";
  }
}
