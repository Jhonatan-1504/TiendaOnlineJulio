<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="La mejor tienda online improvisada en 10 horas">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <title>Producto</title>
    <script defer src="../../assets/js/carrito.js"></script>
</head>

<body>
    <?php include_once "../../api/config/config.php"; ?>
    <?php include_once "../../components/header.php" ?>

    <div class="container">
        <div class="card" style="margin: 5%;">
            <div class="card-body">
                <div style="display:flex;flex-direction: column;">
                    <div style="text-align: center;">
                        <h2><strong id="nombre_producto"></strong></h2>  
                        <img id="imagen_producto" style="width: 40%"  alt="" class="card-img-top"/> 
                    </div>
                    <div style="width: 100%;margin: 20px 0;">
                        <div class="accordion" id="accordionPanelsStayOpenExample">
                                <div class="accordion-item">
                                    <h2 class="accordion-header" id="panelsStayOpen-headingOne">
                                    <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#panelsStayOpen-collapseOne" aria-expanded="true" aria-controls="panelsStayOpen-collapseOne">
                                        Descripcion
                                    </button>
                                    </h2>
                                    <div id="panelsStayOpen-collapseOne" class="accordion-collapse collapse show" aria-labelledby="panelsStayOpen-headingOne">
                                    <div class="accordion-body">
                                        <p id="description_producto"></p>
                                    </div>
                                    </div>
                                </div>
                            </div>
                        <div style="margin-top: 20px;display: flex;align-items: center;justify-content: space-between;">
                            <div class="dropdown">
                                <a class="btn btn-secondary dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-bs-toggle="dropdown" aria-expanded="false">
                                    Cantidad
                                </a>
                                <ul class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                                    <li class="dropdown-item" value="1">1</li>
                                    <li class="dropdown-item" value="2">2</li>
                                    <li class="dropdown-item" value="3">3</li>
                                    <li class="dropdown-item" value="4">4</li>
                                    <li class="dropdown-item" value="5">5</li>
                                    <li class="dropdown-item" value="6">6</li>
                                </ul>
                            </div>
                            <strong style="color: red;" id="precio_producto">Precio: S/ 190.00</strong>
                        </div>
                    </div>
                </div>
                <div style="display: flex;justify-content: flex-end;">
                    <button class="btn btn-dark" id="addCarrito">Añadir al carrito</button>
                </div>

            </div>
        </div>
</div>
    <script>
        const url = new URL(document.URL);
        const idProducto = url.searchParams.get("idProducto");

        const teodio = async ()=>{
            const response = await fetch(`http://localhost/TiendaOnlineJulio/api/controllers/ProductoController.php?option=editProduct&idProducto=${idProducto}`)
            const data = await response.json();
            render(data);
        }

        teodio();

        const render = (data) =>{
            document.getElementById("nombre_producto").textContent = data.Nombre_Producto;
            document.getElementById("imagen_producto").src = `../../assets/products/${data.Imagen_Producto}`;
            document.getElementById("description_producto").textContent = data.Descripcion_Producto;
            document.getElementById("precio_producto").textContent = data.Precio_Producto;
        }
    </script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
</body>

</html>