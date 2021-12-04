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

  <div class="row" style="align-items: center;">
    <div class="container col-md-7">
        <div class="list-group" id="Listar_Productos" style="margin: 5%;align-items: center;">
            <div class="list-group-item active">
                <h1 >Carrito de Compras</h1>
            </div>           
        </div>
    </div>
    <div class="container col-md-5">
      <div class="list-group p-5 m-5" >
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
            <button class="btn btn-dark" style="width: 100%;" type="submit">Finalizar Compra</button>
        </div>
      </div>
    </div>
  </div>
  <script>
    const array = [
      { cantidad: 1, descripcion: "Audifonos:Inalambricos | Marca: apple",idEmpleado: 1,idProducto: 1,imagen: "airpods.webp",nombre: "airpods",precio: "150.00",stock: 10},
      { cantidad: 2, descripcion: "Audifonos:Inalambricos | Marca: apple| dasdasdasdasdasdasdasdasdqewqwes",idEmpleado: 1,idProducto: 1,imagen: "Televisor LG.webp",nombre: "airpods",precio: "180.00",stock: 10},
    ];
    let subtotal = 0;
    array.map(function(element) {
      const div = document.createElement("div")
      const totalprecio = element.cantidad * element.precio;
      div.style.width = "480px"
      div.innerHTML = `
        <div class="list-group-item p-5">
          <div style="display:flex;">
            <img style="width: 100px;" src="../../assets/products/${element.imagen}" alt="" class="card-img-top"/> 
            <div class="p-2" style="display: flex;justify-content: space-between;flex-direction: column;">
              <h2 style="font-size: 16px;word-break: break-word;">${element.descripcion}</h2>  
              <div style="display: flex;align-items: center;justify-content: space-between;">
                <div>
                  <input type="text" value="${element.cantidad}" size="1" maxlength="1"/>
                  <span style="color:red;">S/ <strong  id="precio_producto">${totalprecio}</strong></span>
                </div>
                <button class="btn btn-dark">Eliminar</button>
              </div>
            </div>
          </div>
        </div>`;
      document.getElementById("Listar_Productos").appendChild(div) 
      subtotal = subtotal + totalprecio
      document.getElementById("subtotal").innerHTML = subtotal;

    });

    const ObtenerTotal =()=>{
      const subtotal = parseInt(document.getElementById("subtotal").textContent);
      const IGV = 0.18;
      const total = subtotal + Math.round(subtotal * IGV)
      document.getElementById("total").innerHTML = total;
    }
    ObtenerTotal();


  </script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
</body>

</html>