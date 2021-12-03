const contenidoProducto = document.getElementById("contenido-producto");
const contadorCarrito = document.getElementById("contador-carrito");
const addButton = document.getElementById('addCarrito');

const LocalCarrito = getCarrito();

ShowMessageCarrito();

function getCarrito() {
  let local = localStorage.getItem("carrito");
  return local !== null ? [...JSON.parse(local)] : [];
}

function setCarrito(){
  localStorage.setItem('carrito', JSON.stringify(LocalCarrito))
}

function ShowMessageCarrito() {
  if (LocalCarrito.length) {
    contadorCarrito.classList.remove("visually-hidden");
    contadorCarrito.textContent = LocalCarrito.length;
  }
}

const handleClick = () =>{
  console.log('pinche enzo');
}

if(addButton){
  addButton.addEventListener('click',handleClick)
}
