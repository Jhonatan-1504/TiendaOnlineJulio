<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="description" content="La mejor tienda online improvisada en 10 horas">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
  <script defer src="../../assets/js/carrito.js"></script>
  <title>Carrito</title>
</head>
<body>

  <?php include_once "../../api/config/config.php"; ?>
  <?php include_once "../../components/header.php"; ?>

  <template id="mensaje-cantidad-limite">
        <div class="position-fixed top-0 end-0 p-3" style="z-index: 11">
            <div class="alert alert-danger" role="alert" style="width: 25rem;">
                <div class="d-flex justify-content-between">
                    <h4 class="alert-heading">Stock no permitido!</h4>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
                <p>Seleciona otra cantidad</p>
            </div>
        </div>
  </template>

  <div class="row" style="align-items: center;">
    <div class="container col-md-8">
        <div class="list-group" id="Listar_Productos" style="margin: 5%;align-items: center;">
            <div class="list-group-item active">
                <h1 >Carrito de Compras</h1>
            </div>           
        </div>
    </div>
    <div class="container col-md-4">
      <form method="POST" class="list-group m-5">
        <div class="list-group-item">
            <h3 style="font-size: 18px;text-align:center;">Resumen de Compras</h3>
        </div>
        <div class="list-group-item" style="display:flex;justify-content: space-between;">
          Subtotal (2) <span style="color:red;">S/ <strong id="subtotal"></strong></span>
        </div>
        <div class="list-group-item" style="display:flex;justify-content: space-between;">
          Envio <strong>Envio Gratis</strong>
        </div>
        <div class="list-group-item" style="display:flex;justify-content: space-between;">
          IGV <strong>18%</strong>
        </div>
        <div class="list-group-item" style="display:flex;justify-content: space-between;font-size:20px">
          Total a pagar <span style="color:red;">S/ <strong id="total"></strong></span>
        </div>
        <div class="list-group-item">
            <button class="btn btn-dark" style="width: 100%;" type="button" onClick="FinalizarCompra()">Finalizar Compra</button>
        </div>
      </form>
    </div>
  </div>
  <script>
    console.log( localStorage.getItem("carrito"))
    const textproductos = localStorage.getItem("carrito");
    let jsonproductos = (textproductos == null) ? []: JSON.parse(textproductos);
    let copiaproductos = [...jsonproductos]
    let subtotal = 0;
    const mensajeStock = document.querySelector('#mensaje-cantidad-limite');
    const div = document.createElement("div")

    if(textproductos.getItem("carrito") == null){
      div.innerHTML = `<a href="../../">No Tiene productos, Regresar a la página Principal</a>`

    }else{
      jsonproductos.map(function(element) {
        const totalprecio = element.cantidad * element.precio;
        div.innerHTML = `
          <form class="list-group-item p-5">
            <div style="display:flex;">
              <img style="width: 100px;" src="../../assets/products/${element.imagen}" alt="" class="card-img-top"/> 
              <div class="p-2" style="display: flex;justify-content: space-between;flex-direction: column;">
                <h2 style="font-size: 16px;word-break: break-word;"><strong>${element.nombre}</strong></h2> 
                <div style="margin: 10px 0;">
                  Disponibles : ${element.stock}
                </div> 
                <div style="display: flex;align-items: center;justify-content: space-between; margin: 10px 0;">
                    <input id="ProductoCantidad${element.idProducto}" type="text" value="${element.cantidad}" size="4" maxlength="4" onChange="Cambio(${element.idProducto})"/>
                    <span style="color:red;">S/ <strong  id="precio_producto">${totalprecio}</strong></span>
                </div>
                <div>
                  <button id="Editar${element.idProducto}" class="btn btn-dark" type="submit" onClick="CambiarCantidad(${element.idProducto},${element.stock},event)" disabled>Guardar</button>
                  <button class="btn btn-dark" type="submit" onClick="BorrarDato(${element.idProducto})">Eliminar</button>
                </div>
              </div>
            </div>
          </form>`;
        subtotal = subtotal + totalprecio
        document.getElementById("subtotal").innerHTML = subtotal;
        
      });
  }
  document.getElementById("Listar_Productos").appendChild(div) 

    const Cambio = (idProducto)=>{
      document.getElementById("Editar"+idProducto).removeAttribute("disabled");
    }
    const CambiarCantidad = (idProducto,stock,evt)=>{
      const nuevacantidad = document.getElementById("ProductoCantidad"+idProducto).value;
      const producto = copiaproductos.find(element => element.idProducto == idProducto)
      const index = copiaproductos.indexOf(producto);
      if(nuevacantidad<stock && nuevacantidad>0){
        producto.cantidad = nuevacantidad
        copiaproductos[index] = producto;
        localStorage.setItem('carrito', JSON.stringify(copiaproductos))
      }else{
        evt.preventDefault();
        var clone = document.importNode(mensajeStock.content, true);
        return document.body.appendChild(clone);
      }
    }

    const BorrarDato = (idProducto)=>{
      const producto = copiaproductos.find(element => element.idProducto == idProducto)
      const index = copiaproductos.indexOf(producto);
      if(index == 0){
        copiaproductos.shift();
      }else{
        copiaproductos.splice(index,1);
      }
      localStorage.setItem('carrito', JSON.stringify(copiaproductos))
    }

    const ObtenerTotal =()=>{
      const subtotal = parseInt(document.getElementById("subtotal").textContent);
      const IGV = 0.18;
      const total = subtotal + Math.round(subtotal * IGV)
      document.getElementById("total").innerHTML = total;
    }

    ObtenerTotal();
    const FinalizarCompra=async()=>{
      const misproductos = jsonproductos.map((element)=>
        ( 
          {
            idProduct: element.idProducto,
            count: element.cantidad,
            price: element.precio
          }
        )            
      )
      let productos = 
        {
        products : misproductos,
        total:jsonproductos.length,
        idUser:1
      }
      await fetch(`http://localhost/TiendaOnlineJulio/api/controllers/DetalleBoletaController.php?option=addDetalles`,
      {
        method : 'POST',
        body: JSON.stringify(productos),
        headers:{
          'Content-Type': 'application/json'
        }
      })
      .then(res => res.json())
      .catch(error => console.error('Error:', error))
      .then(response => {
        localStorage.removeItem("carrito")
        location.reload(); 
      })
    }
  </script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
</body>

</html>