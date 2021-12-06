const mostrarBoletas = document.getElementById("mostrar-boletas");

const spanAll = document.querySelectorAll(".show-text-span");
const badgesAll = document.querySelectorAll(".intorregation");
const inputsAll = document.querySelectorAll(".input-perfil");

const editPerfil = document.getElementById("editPerfil");
const sendPerfil = document.getElementById("sendPerfil");

var myToastEl = document.getElementById("liveToast");
var myToast = bootstrap.Toast.getOrCreateInstance(myToastEl);

const showUserMSG = document.querySelector(".info-msg-user");
const infoMessage = document.querySelector(".info-msg-text");

const renderLinkBoleta = (boleta, index) => {
  return `<a href="../boleta/Boleta.php?idBoleta=${boleta.ID_Boleta}&idUser=${boleta.ID_Usuario}&date=${boleta.Fecha_Compra}" class="list-group-item list-group-item-action" aria-current="true">
            <div class="d-flex w-100 justify-content-between">
              <h5 class="mb-1">N°${index}</h5>
              <small>${boleta.Fecha_Compra}</small>
            </div>
            <p class="mb-1">Mas detalles.</p>
          </a>`;
};

const renderPerfil = ({
  Nombres_Usuario,
  Apellidos_Usuario,
  Telefono_Usuario,
  Email_Usuario,
  DNI_Usuario,
}) => {
  const renderItem = (element, text = "", index) => {
    element.textContent = text;
    if (text) {
      badgesAll[index].classList.add("visually-hidden");
      inputsAll[index].value = text;
    }
  };

  let fullName = `${Nombres_Usuario ? Nombres_Usuario + ", ": ""}${Apellidos_Usuario? Apellidos_Usuario: ""}`;

  renderItem(spanAll[0], fullName, 0);
  renderItem(spanAll[1], DNI_Usuario ? DNI_Usuario : "", 1);
  renderItem(spanAll[2], Telefono_Usuario ? Telefono_Usuario : "", 2);
  renderItem(spanAll[3], Email_Usuario ? Email_Usuario : "", 3);
  showUserMSG.textContent = "Hola, " + Email_Usuario
};

const Edit = () => {
  sendPerfil.disabled = false;

  for (let i = 0; i < inputsAll.length; i++) {
    spanAll[i].classList.add("visually-hidden");
    inputsAll[i].classList.remove("visually-hidden");
  }
};

const EsconderInputs = () => {
  sendPerfil.disabled = true;
  for (let i = 0; i < inputsAll.length; i++) {
    inputsAll[i].classList.add("visually-hidden");
    spanAll[i].classList.remove("visually-hidden");
  }
};

const SavePerfil = () => {
  const newInputsAll = document.querySelectorAll(".input-perfil");

  const NombreCompleto = newInputsAll[0].value.split(",", 2);

  if (NombreCompleto[1] === undefined) {
    infoMessage.textContent =
      "Debes separar con una coma el nombre del apellido";
    myToast.show();
    return;
  }

  if (
    !newInputsAll[1].value ||
    !newInputsAll[2].value ||
    !newInputsAll[3].value
  ) {
    infoMessage.textContent = "Todos los campos son importantes";
    myToast.show();
    return;
  }

  let obj = {
    nombre: NombreCompleto[0],
    apellido: NombreCompleto[1],
    dni: newInputsAll[1].value,
    telefono: newInputsAll[2].value,
    correo: newInputsAll[3].value,
  };

  ApiSendPerfil(obj);
};

const ApiBoleta = async () => {
  let url =
    "http://localhost/TiendaOnlineJulio/api/controllers/BoletaController.php?option=listarBoletasId&idUser=1";

  const response = await fetch(url);
  const boletas = await response.json();

  const items = boletas.map((boleta, i) => renderLinkBoleta(boleta, i + 1));
  const template =
    "<li class='list-group-item text-white bg-dark'>Mis Boletas</li>" +
    items.join(" ");

  mostrarBoletas.innerHTML = template;
};

const ApiPerfil = async () => {
  let url =
    "http://localhost/TiendaOnlineJulio/api/controllers/UsuarioController.php?option=perfil&idUser=1";

  const response = await fetch(url);
  const perfil = await response.json();

  renderPerfil(perfil);
};

const ApiSendPerfil = async (object) => {
  let url =
    "http://localhost/TiendaOnlineJulio/api/controllers/UsuarioController.php?option=updateAllData&id=1";
  const response = await fetch(url, {
    method: "POST",
    body: JSON.stringify(object),
  });
  if(response.status === 200 ){
    console.log('Actualizado');
  }
  EsconderInputs();
  ApiPerfil();
};

ApiBoleta();
ApiPerfil();

editPerfil.addEventListener("click", Edit);
sendPerfil.addEventListener("click", SavePerfil);
