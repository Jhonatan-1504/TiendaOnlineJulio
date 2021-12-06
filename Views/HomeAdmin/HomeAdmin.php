<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="La mejor tienda online improvisada en 10 horas">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <title>Home Admin</title>
    <script defer src="../../assets/js/carrito.js"></script>
    <script defer src="../../assets/js/Producto.js"></script>
</head>

<body>
    <?php include_once "../../api/config/config.php" ?>
    <?php include_once "../../api/models/database.php" ?>
    <?php include_once "../../components/header.php" ?>

    <div class="container p-3">

        <div class="row">

            <div class="col-md-4">

                <div class="position-relative">

                    <div class="card mb-2">
                        <form id="frmProducto">
                            <ol class="list-group">
                                <li class="list-group-item d-flex justify-content-between align-items-start">
                                    <div class="ms-2 me-auto">
                                        <div class="fw-bold">Nombre del producto: </div>
                                        <span class="show-text-span"></span>
                                        <input name="nombre" type="text" class="form-control input-perfil visually-hidden" required>
                                    </div>
                                    <span class="badge bg-danger rounded-pill intorregation" title="Falta el Nombre del producto">!</span>
                                </li>
                                <li class="list-group-item d-flex justify-content-between align-items-start">
                                    <div class="ms-2 me-auto">
                                        <div class="fw-bold">Descripción del Producto: </div>
                                        <span class="show-text-span"></span>
                                        <textarea name="descripcion" class="form-control input-perfil visually-hidden" required></textarea>
                                    </div>
                                    <span class="badge bg-danger rounded-pill intorregation" title="Falta la Descripción del Producto">!</span>
                                </li>
                                <li class="list-group-item d-flex justify-content-between align-items-start">
                                    <div class="ms-2 me-auto">
                                        <div class="fw-bold">Imagen Producto: </div>
                                        <span class="show-text-span"></span>
                                        <input name="imagen" type="file" class="form-control input-perfil visually-hidden">
                                    </div>
                                    <span class="badge bg-danger rounded-pill intorregation" title="Falta la Imagen del Producto">!</span>
                                </li>
                                <li class="list-group-item d-flex justify-content-between align-items-start">
                                    <div class="ms-2 me-auto">
                                        <div class="fw-bold">Stock del producto: </div>
                                        <span class="show-text-span"></span>
                                        <input name="stock" type="number" class="form-control input-perfil visually-hidden" required>
                                    </div>
                                    <span class="badge bg-danger rounded-pill intorregation" title="Falta el Stock del Producto">!</span>
                                </li>
                                <li class="list-group-item d-flex justify-content-between align-items-start">
                                    <div class="ms-2 me-auto">
                                        <div class="fw-bold">Precio del producto: </div>
                                        <span class="show-text-span"></span>
                                        <input name="precio" type="number" class="form-control input-perfil visually-hidden" required>
                                    </div>
                                    <span class="badge bg-danger rounded-pill intorregation" title="Falta el Precio del Producto">!</span>
                                </li>
                            </ol>

                            <div class="card-footer">
                                <div class="d-flex gap-2 justify-content-between align-items-start">
                                    <button type="button" id="editProducto" class="btn btn-light border border-dark">Agregar Producto</button>
                                    <button type="submit" id="sendProducto" disabled class="btn btn-dark">Guardar</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>

            </div>
            <div class="col-md-8">
                <div class="row gap-2  row-cols-auto" id="contenido-producto"></div>
            </div>
        </div>
    </div>

    <template id="template-card-producto">
        <div class="card" style="width: 16rem;">
            <img data-imagen class="card-img-top">
            <div class="card-body">
                <h5 class="card-title" data-title></h5>
                <p class="card-text" data-description></p>

                <h4 class="card-text">S/.<span data-price></span></h4>

                <div class="float-end">
                    <button class="btn border delete-card">Delete</button>
                    <button class="btn btn-secondary edit-card">Editar</button>
                </div>
            </div>
        </div>
    </template>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
</body>

</html>