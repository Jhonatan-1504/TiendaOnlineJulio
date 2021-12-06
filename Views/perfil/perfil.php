<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="description" content="La mejor tienda online improvisada en 10 horas">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
  <title>Perfil</title>
  <script defer src="../../assets/js/carrito.js"></script>
  <script defer src="../../assets/js/perfil.js"></script>
</head>

<body>
  <?php include_once "../../api/config/config.php"; ?>
  <?php include_once "../../components/header.php" ?>

  <div class="text-white bg-dark p-3 d-flex justify-content-between align-items-center">
    <h1 data-user-name>Bienvenido, Enzo</h1>
    <button class="btn btn-secondary" id="btnCloseSession">Cerrar Session</button>
  </div>

  <div class="container p-3">

    <div class="row">

      <div class="col-md-4">

        <div class="card">
          <div class="card-header">
            <div class="d-flex gap-2 align-items-center">
              <img src="../../assets/usuario.svg" alt="usuario">
              <h3 class="show-text-span"></h3>
              <span class="badge bg-danger rounded-pill intorregation" title="falta el Nombre">!</span>
              <input type="text" class="form-control input-perfil visually-hidden">
            </div>
          </div>

          <ol class="list-group">
            <li class="list-group-item d-flex justify-content-between align-items-start">
              <div class="ms-2 me-auto">
                <div class="fw-bold">DNI</div>
                <span class="show-text-span"></span>
                <input type="text" min="1" max="99999999" class="form-control input-perfil visually-hidden">
              </div>
              <span class="badge bg-danger rounded-pill intorregation" title="falta el DNI">!</span>
            </li>
            <li class="list-group-item d-flex justify-content-between align-items-start">
              <div class="ms-2 me-auto">
                <div class="fw-bold">Telefono</div>
                <span class="show-text-span"></span>
                <input type="text" class="form-control input-perfil visually-hidden">
              </div>
              <span class="badge bg-danger rounded-pill intorregation" title="falta el telefono">!</span>
            </li>
            <li class="list-group-item d-flex justify-content-between align-items-start">
              <div class="ms-2 me-auto">
                <div class="fw-bold">Correo</div>
                <span class="show-text-span"></span>
                <input type="text" class="form-control input-perfil visually-hidden">
              </div>
              <span class="badge bg-danger rounded-pill intorregation" title="falta el Correo">!</span>
            </li>
          </ol>

          <div class="card-footer">
            <div class="d-flex gap-2 justify-content-between align-items-start">
              <button id="editPerfil" class="btn btn-light border border-dark">Editar</button>
              <button id="sendPerfil" disabled class="btn btn-dark">Enviar</button>
            </div>
          </div>

        </div>

      </div>
      <div class="col-md-8">
        <div class="card">
          <div class="list-group" id="mostrar-boletas">
            <a href="../../" class="list-group-item list-group-item-action" aria-current="true">
              No se han realizado compras aun, <strong>Comprar Ahora</strong>
            </a>
          </div>
        </div>
      </div>

    </div>

  </div>

  <div class="position-fixed bottom-0 end-0 p-3" style="z-index: 11">
    <div id="liveToast" class="toast bg-secondary" role="alert" aria-live="assertive" aria-atomic="true">
      <div class="toast-header">
        <strong class="me-auto info-msg-user"></strong>
        <small>Justo Ahora</small>
        <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
      </div>
      <div class="toast-body text-white info-msg-text"></div>
    </div>
  </div>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
</body>

</html>