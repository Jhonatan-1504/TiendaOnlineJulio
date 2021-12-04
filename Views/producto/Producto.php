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
                <div class="row">
                    <div class="col-md" style="text-align: center;">
                        <h2><strong id="nombre_producto"></strong></h2>
                        <img id="imagen_producto" style="width: 40%" alt="" class="card-img-top" />
                    </div>
                    <div class="col-md" style="width: 100%;margin: 20px 0;">
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

                        <div class="pt-3 pb-3">
                            <span id="disponibles-stock"></span>
                        </div>
                        <div class="d-flex justify-content-between">
                            <div>
                                <span>Cantidad:</span>
                                <input type="number" id="cantidad-stock" min="1" value="1">
                            </div>
                            <strong style="color: red;" id="precio_producto"></strong>
                        </div>
                    </div>
                </div>
                <div style="display: flex;justify-content: flex-end;">
                    <button class="btn btn-dark" id="addCarrito">Añadir al carrito</button>
                </div>

            </div>
        </div>
    </div>

    <template id="mensaje-alvertencia">
        <div class="position-fixed top-0 end-0 p-3" style="z-index: 11">
            <div class="alert alert-info" role="alert" style="width: 25rem;">
                <div class="d-flex justify-content-between">
                    <h4 class="alert-heading">Producto, en el carrito!</h4>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
                <p>¿Deseas Editarlo? <a href="<?php echo constant('URL'); ?>Views/boleta/carrito.php" class="alert-link">click aqui</a></p>
            </div>
        </div>
    </template>

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


    <script>
        const url = new URL(document.URL);
        const addCarrito = document.getElementById('addCarrito')
        const idProducto = url.searchParams.get("idProducto");
        const contadorCarritos = document.getElementById("contador-carrito");
        const mensaje = document.querySelector('#mensaje-alvertencia');
        const mensajeStock = document.querySelector('#mensaje-cantidad-limite');

        var producto = null;

        const localCarritos = getCarritos()

        function getCarritos() {
            let local = localStorage.getItem("carrito");
            return local !== null ? [...JSON.parse(local)] : [];
        }

        function setCarritos() {
            localStorage.setItem('carrito', JSON.stringify(localCarritos))
        }

        function ShowMessageCarritos() {
            if (localCarritos.length) {
                contadorCarritos.classList.remove("visually-hidden");
                contadorCarritos.textContent = localCarritos.length;
            }
        }

        const ApiProduct = async () => {
            const response = await fetch(`http://localhost/TiendaOnlineJulio/api/controllers/ProductoController.php?option=editProduct&idProducto=${idProducto}`)
            const data = await response.json();
            producto = data
            renderProducto(data);
        }

        const renderProducto = (data) => {
            document.getElementById("nombre_producto").textContent = data.Nombre_Producto;
            document.getElementById("imagen_producto").src = `../../assets/products/${data.Imagen_Producto}`;
            document.getElementById("description_producto").textContent = data.Descripcion_Producto;
            document.getElementById("precio_producto").textContent = "S/." + data.Precio_Producto;
            document.getElementById('cantidad-stock').max = data.Stock_Producto;
            document.getElementById('disponibles-stock').textContent = "Disponibles: " + data.Stock_Producto;
        }

        const handleClick = () => {
            let object = {
                descripcion: producto.Descripcion_Producto,
                idEmpleado: producto.ID_Empleado,
                idProducto: producto.ID_Producto,
                imagen: producto.Imagen_Producto,
                nombre: producto.Nombre_Producto,
                precio: producto.Precio_Producto,
                stock: producto.Stock_Producto,
                cantidad: parseInt(document.getElementById('cantidad-stock').value),
            }

            const productos = localCarritos.filter(item => item.idProducto === object.idProducto).length

            if(object.cantidad>object.stock){
                var clone = document.importNode(mensajeStock.content, true);
                return document.body.appendChild(clone);
            }

            if (productos) {
                var clone = document.importNode(mensaje.content, true);
                return document.body.appendChild(clone);
            }

            localCarritos.push(object)
            setCarritos()
            ShowMessageCarritos()
        }

        ApiProduct();

        addCarrito.addEventListener('click', handleClick)
    </script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
</body>

</html>