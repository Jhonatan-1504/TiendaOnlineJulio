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
include_once "../models/Usuario.php";

switch ($option) {
  case "perfil":
    BuscarIdUsuario();
  break;
  case 'verificar':
    VerificarUsuario();
    break;
  case 'addUser':
    CrearNuevoUsuario();
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
http://localhost/TiendaOnlineJulio/api/controllers/UsuarioController.php?option=perfil&idUser=1
*/
function BuscarIdUsuario(){
  $reg = new Usuario();
  $reg->Where(["ID_Usuario"=>$_GET['idUser']]);
  $result = $reg->All();
  if($result === null){
    http_response_code(404);
    echo json_encode(["msg"=>"No existe usuario"]);
    die();
  }
  echo json_encode($result[0]);
}


// HTTP_POST
/*
http://localhost/TiendaOnlineJulio/api/controllers/UsuarioController.php?option=verificar
{
  "email":'PincheENZO',
  "password":'12345'
}
*/
function VerificarUsuario()
{
  $request = json_decode(json_encode($_POST));

  $reg = new Usuario();
  $reg->Verification($request->email, $request->password);
  $user = $reg->All();
  if ($user !== null) {
    http_response_code(200);
    echo json_encode($user);
  } else {
    http_response_code(404);
    echo json_encode(['msg' => 'No existe']);
  }
}

// HTTP_POST
/*
http://localhost/TiendaOnlineJulio/api/controllers/UsuarioController.php?option=addUser

{
    "nameUser":"PincheENZO",
    "password":"123"
}
*/
function CrearNuevoUsuario()
{
  $request = json_decode(json_encode($_POST));

  $datos = [
    "Contrasena_Usuario" => $request->password,
    "Email_Usuario" => $request->nameUser
  ];

  $reg = new Usuario();
  $result = $reg->CreateUser($datos, 2);

  if ($result) {
    echo "Registrado correctamente";
  };
}

// HTTP_POST
/*
http://localhost/TiendaOnlineJulio/api/controllers/UsuarioController.php?option=updatePassword

  {
    "email":"pINCHEeNZO",
    "password":"12345678"
  }
*/
function ActualizarPassword()
{
  $request = json_decode(json_encode($_POST));

  $datos = ["Contrasena_Usuario" => $request->password];

  $reg = new Usuario();
  $reg->Select(["ID_Usuario"]);
  $reg->Where(["Email_Usuario" => $request->email]);
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
http://localhost/TiendaOnlineJulio/api/controllers/UsuarioController.php?option=updateAllData&id=1

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
    "DNI_Usuario" => $request->dni,
    "Email_Usuario" => $request->correo,
    "Nombres_Usuario" => $request->nombre,
    "Apellidos_Usuario" => $request->apellido,
    "Telefono_Usuario" => $request->telefono
  ];

  $reg = new Usuario();
  $reg->Where(["ID_Usuario" => $_GET['id']]);
  $result = $reg->UpdateUser($datos);

  if($result->rowCount()){
    http_response_code(200);
    echo json_encode(["msg"=>"Actualizado con exito"]);
  }else{
    http_response_code(204);
    echo json_encode(["msg"=>"No actualizamos nada"]);
  }
  
}

// HTTP_GET
/*
http://localhost/TiendaOnlineJulio/api/controllers/UsuarioController.php?option=deleteUser&id=1
*/

function BorraCuenta()
{
  $reg = new Usuario();

  $reg->Where(["ID_Usuario" => $_GET['id']]);
  $result = $reg->DeleteUser();

  if ($result) {
    echo "Borrado con exito";
  }
}
