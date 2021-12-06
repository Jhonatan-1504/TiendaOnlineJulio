const spanAll = document.querySelectorAll(".show-text-span");
const badgesAll = document.querySelectorAll(".intorregation");
const inputsAll = document.querySelectorAll(".input-perfil");

const btnShowInput = document.getElementById("editProducto");
const btnSaveProducto = document.getElementById("sendProducto");

const frmProducto = document.getElementById("frmProducto");

const Edit = () => {
  btnSaveProducto.disabled = false;

  for (let i = 0; i < inputsAll.length; i++) {
    spanAll[i].classList.add("visually-hidden");
    inputsAll[i].classList.remove("visually-hidden");
  }
};

const EsconderInputs = () => {
  btnSaveProducto.disabled = true;
  for (let i = 0; i < inputsAll.length; i++) {
    inputsAll[i].classList.add("visually-hidden");
    spanAll[i].classList.remove("visually-hidden");
  }
};

const SaveProducto = (event) => {
    event.preventDefault();
   
    const NewFormData = new FormData(frmProducto);
    NewFormData.append("idEmpleado","1")
    ApiProducto(NewFormData);

  };


const ApiProducto  = async (data) => {
    let url = "http://localhost/TiendaOnlineJulio/api/controllers/ProductoController.php?option=addProduct";
    const response = await fetch(url,{method:"POST",body:data});
    const Data = await response.text();
    window.location.reload(true);
    console.log(Data);
}

btnShowInput.addEventListener('click',Edit);
frmProducto.addEventListener('submit',SaveProducto);