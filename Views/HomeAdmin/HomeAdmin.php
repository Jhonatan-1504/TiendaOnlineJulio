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
    <?php include_once "../../api/models/Productos.php" ?>
    <?php include_once "../../components/header.php" ?>

    <div class="container p-3">

        <div class="row">

            <div class="col-md-4">

                <div class="card">
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
                                    <input name="imagen" type="file" class="form-control input-perfil visually-hidden" required>
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
            <div class="col-md-8">


                <!--  -->
                <div class="container p-3">

                    <?php $reg = new Productos(); ?>

                    <div class="row gap-5 justify-content-center" id="contenido-producto">

                        <?php foreach ($reg->All() as $row) { ?>

                            <div class="card" style="width: 18rem;">
                                <img src="../../assets/products/<?php echo $row['Imagen_Producto']; ?>" class="card-img-top" alt="<?php echo $row['Nombre_Producto']; ?>">
                                <div class="card-body">
                                    <h5 class="card-title"><?php echo $row['Nombre_Producto']; ?></h5>
                                    <p class="card-text"><?php echo $row['Descripcion_Producto']; ?></p>

                                    <div class="d-flex justify-content-between">
                                        <h4 class="card-text float-end">S/.<?php echo $row['Precio_Producto']; ?></h4>
                                        <a href=" ./Views/producto/Producto.php?idProducto=<?php echo $row['ID_Producto']; ?>" class="btn btn-secondary float-end">
                                            Editar
                                        </a>
                                    </div>
                                </div>
                            </div>

                        <?php } ?>

                    </div>

                </div>
                <!--  -->

            </div>

        </div>

    </div>

    <div class="position-fixed bottom-0 end-0 p-3" style="z-index: 11">
        <div id="liveToast" class="toast bg-secondary" role="alert" aria-live="assertive" aria-atomic="true">
            <div class="toast-header">
                <strong class="me-auto info-msg-user"></strong>
                <small>Justo Ahora</small>
                <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
            </div>
            <div class="toast-body text-white info-msg-text"></div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
</body>

</html>