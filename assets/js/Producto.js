const spanAll = document.querySelectorAll(".show-text-span");
const badgesAll = document.querySelectorAll(".intorregation");
const inputsAll = document.querySelectorAll(".input-perfil");

const btnShowInput = document.getElementById("editProducto");
const btnSaveProducto = document.getElementById("sendProducto");

const frmProducto = document.getElementById("frmProducto");

const contentProduct = document.getElementById("contenido-producto");

const templateCard = document.querySelector("#template-card-producto").content;

var products = [];
var isEdit = false;

const OpenFormulario = () => {
  btnSaveProducto.disabled = false;
  for (let i = 0; i < inputsAll.length; i++) {
    spanAll[i].classList.add("visually-hidden");
    inputsAll[i].classList.remove("visually-hidden");
  }
};

const CloseFormulario = () => {
  btnSaveProducto.disabled = true;
  for (let i = 0; i < inputsAll.length; i++) {
    inputsAll[i].classList.add("visually-hidden");
    spanAll[i].classList.remove("visually-hidden");
  }
};

const LlenarFormulario = (item) => {
  OpenFormulario();
  frmProducto.precio.value = item.Precio_Producto;
  frmProducto.stock.value = item.Stock_Producto;
  frmProducto.descripcion.value = item.Descripcion_Producto;
  frmProducto.nombre.value = item.Nombre_Producto;
  isEdit = true;
};

const ObtenerDatos = (ev) => {
  if (ev.target.classList.contains("edit-card")) {
    const found = products.find((item) => item.ID_Producto == ev.target.dataset.id);
    LlenarFormulario(found);
  }

  if (ev.target.classList.contains("delete-card")) {
    ApiDeleteProducto(ev.target.dataset.id);
  }

  ev.stopPropagation();
};

const SaveProducto = async (event) => {
  event.preventDefault();
  const NewFormData = new FormData(frmProducto);
  NewFormData.append("idEmpleado", "1");

  if (isEdit) {
    await ApiUpdateProducto(1, NewFormData);
  } else {
    await ApiSendProducto(NewFormData);
  }
};

const BuildCardProducto = () => {
  let urlAssets = "../../assets/products/";

  contentProduct.innerHTML = "";

  products.map(
    ({
      ID_Producto,
      Nombre_Producto,
      Descripcion_Producto,
      Precio_Producto,
      Imagen_Producto,
    }) => {
      var clone = document.importNode(templateCard, true);

      clone.querySelector("[data-title]").textContent = Nombre_Producto;
      clone.querySelector("[data-description]").textContent =
        Descripcion_Producto;
      clone.querySelector("[data-price]").textContent = Precio_Producto;
      clone.querySelector("[data-imagen]").src = urlAssets + Imagen_Producto;
      clone.querySelector(".edit-card").dataset.id = ID_Producto;
      clone.querySelector(".delete-card").dataset.id = ID_Producto;

      contentProduct.appendChild(clone);
    }
  );
};

const ApiProducto = async () => {
  let url =
    "http://localhost/TiendaOnlineJulio/api/controllers/ProductoController.php?option=listProduct";
  const response = await fetch(url);
  const data = await response.json();
  products = data;
  BuildCardProducto();
};

const ApiUpdateProducto = async (id, data) => {
  let url = `http://localhost/TiendaOnlineJulio/api/controllers/ProductoController.php?option=updateProduct&idProducto=${id}`;
  const response = await fetch(url, { method: "POST", body: data });

  if (response.status === 200) {
    isEdit = false;
    ApiProducto();
    CloseFormulario();
    frmProducto.reset();
  }
};

const ApiDeleteProducto = async (id) => {
  let url = `http://localhost/TiendaOnlineJulio/api/controllers/ProductoController.php?option=deleteProduct&id=${id}`;
  const response = await fetch(url);
  if (response.status === 200) {
    isEdit = false;
    CloseFormulario();
    frmProducto.reset();
    ApiProducto();
  }
};

const ApiSendProducto = async (data) => {
  let url =
    "http://localhost/TiendaOnlineJulio/api/controllers/ProductoController.php?option=addProduct";
  const response = await fetch(url, { method: "POST", body: data });
  if (response.status === 200) {
    ApiProducto();
    CloseFormulario();
    frmProducto.reset();
  }
};

ApiProducto();

btnShowInput.addEventListener("click", OpenFormulario);
frmProducto.addEventListener("submit", SaveProducto);
contentProduct.addEventListener("click", ObtenerDatos);
