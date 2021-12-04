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
</head>

<body>
  <?php include_once "../../api/config/config.php"; ?>
  <?php include_once "../../components/header.php" ?>

  <div class="container p-3">

    <div class="row">

      <div class="col-md-4">

        <div class="card">
          <div class="card-header">
            <div class="d-flex gap-2 align-items-center">
              <img src="../../assets/usuario.svg" alt="usuario">
              <h3 id="mostrar-nombre-completo"></h3>
              <span class="badge bg-danger rounded-pill intorregation" title="falta el Correo">!</span>
            </div>
          </div>

          <ol class="list-group list-group-numbered">
            <li class="list-group-item d-flex justify-content-between align-items-start">
              <div class="ms-2 me-auto">
                <div class="fw-bold">DNI</div>
                <span id="mostrar-dni"></span>
              </div>
              <span class="badge bg-danger rounded-pill intorregation" title="falta el DNI">!</span>
            </li>
            <li class="list-group-item d-flex justify-content-between align-items-start">
              <div class="ms-2 me-auto">
                <div class="fw-bold">Telefono</div>
                <span id="mostrar-telefono"></span>
              </div>
              <span class="badge bg-danger rounded-pill intorregation" title="falta el telefono">!</span>
            </li>
            <li class="list-group-item d-flex justify-content-between align-items-start">
              <div class="ms-2 me-auto">
                <div class="fw-bold">Correo</div>
                <span id="mostrar-correo"></span>
              </div>
              <span class="badge bg-danger rounded-pill intorregation" title="falta el Correo">!</span>
            </li>
          </ol>

        </div>

      </div>
      <div class="col-md-8">


        <div class="card">

          <div class="list-group" id="mostrar-boletas">

            <a href="../boleta/Boleta.php"></a>

            <a href="../../" class="list-group-item list-group-item-action" aria-current="true">
              No se han realizado compras aun, <strong>Comprar Ahora</strong>
            </a>
          </div>

        </div>

      </div>

    </div>

  </div>

  <!-- here -->

  <script>
    const mostrarBoletas = document.getElementById('mostrar-boletas')

    const fullName = document.getElementById('mostrar-nombre-completo')
    const dniShow = document.getElementById('mostrar-dni')
    const telefonoShow = document.getElementById('mostrar-telefono')
    const correoShow = document.getElementById('mostrar-correo')

    const badgesAll = document.querySelectorAll('.intorregation');

    const renderLinkBoleta = (boleta, index) => {
      return `<a href="../boleta/Boleta.php?idBoleta=${boleta.ID_Boleta}&idUser=${boleta.ID_Usuario}" class="list-group-item list-group-item-action" aria-current="true">
                <div class="d-flex w-100 justify-content-between">
                  <h5 class="mb-1">N°${index}</h5>
                  <small>${boleta.Fecha_Compra}</small>
                </div>
                <p class="mb-1">Mas detalles.</p>
              </a>`;
    }

    const renderPerfil = ({
      Nombres_Usuario,
      Apellidos_Usuario,
      Telefono_Usuario,
      Fecha_Registro,
      Email_Usuario,
      DNI_Usuario
    }) => {

      const renderItem = (element, text='', index) => {
        element.textContent = text;
        if (text) {
          badgesAll[index].classList.add('visually-hidden')
        }
      }

      renderItem(fullName, Nombres_Usuario ? Nombres_Usuario : '' + " " + Apellidos_Usuario ? Apellidos_Usuario : '', 0)
      renderItem(dniShow, DNI_Usuario ? DNI_Usuario : '', 1)
      renderItem(telefonoShow, Telefono_Usuario ? Telefono_Usuario : '', 2)
      renderItem(correoShow, Email_Usuario ? Email_Usuario : '', 3)
    }

    const ApiBoleta = async () => {
      let url = "http://localhost/TiendaOnlineJulio/api/controllers/BoletaController.php?option=listarBoletasId&idUser=1"

      const response = await fetch(url);
      const boletas = await response.json();

      const items = boletas.map((boleta, i) => renderLinkBoleta(boleta, i + 1))
      const template = items.join(" ");

      mostrarBoletas.innerHTML = template
    }

    const ApiPerfil = async () => {
      let url = "http://localhost/TiendaOnlineJulio/api/controllers/UsuarioController.php?option=perfil&idUser=1"

      const response = await fetch(url);
      const perfil = await response.json();

      renderPerfil(perfil);
    }

    ApiBoleta();
    ApiPerfil();
  </script>


  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
</body>

</html>