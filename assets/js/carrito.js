const contenidoProducto = document.getElementById("contenido-producto");
const contadorCarrito = document.getElementById("contador-carrito");

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
