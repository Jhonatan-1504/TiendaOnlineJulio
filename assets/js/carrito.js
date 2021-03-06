const contenidoProducto = document.getElementById("contenido-producto");
const contadorCarrito = document.getElementById("contador-carrito");

const optionsLinks = document.querySelector("[data-options-links]");

const LocalCarrito = getCarrito();

ShowMessageCarrito();

function getCarrito() {
  let local = localStorage.getItem("carrito");
  return local !== null ? [...JSON.parse(local)] : [];
}

function ShowMessageCarrito() {
  if (LocalCarrito.length) {
    contadorCarrito.classList.remove("visually-hidden");
    contadorCarrito.textContent = LocalCarrito.length;
  }
}

const linkUser = document.querySelector("[data-checkout-user]");
const urlBase = document.querySelector("[data-url]").textContent;

const getSession = () => {
  let local = localStorage.getItem("session");
  return local !== null ? JSON.parse(local) : null;
};

const InitLinks = () => {
  let paramsSession = getSession();

  if (paramsSession === null) {
    linkUser.href = urlBase + "Views/Login/Login.php";
  } else {
    linkUser.href = urlBase + "Views/perfil/perfil.php";
  }
};

InitLinks();

const SessionParams = getSession();

if (SessionParams && SessionParams.hasOwnProperty("ID_Empleado")) {
  optionsLinks.innerHTML ="<div><button class='btn btn-light' id='btnCloseSession'>Cerrar Session</button></div>";
  document.querySelector("#btnCloseSession").addEventListener("click", () => {
    localStorage.removeItem("session");
    window.location.href = "../../";
  });
}
