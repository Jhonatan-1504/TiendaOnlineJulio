<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="description" content="La mejor tienda online improvisada en 10 horas">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
  <link rel="stylesheet" href="./assets/styles.css">
  <title>Tienda online Julio</title>
</head>

<body>

  <!-- <?php if (isset($_SESSION['usurio']))  ?> -->

  <?php include_once "./api/config/config.php" ?>

  <?php include_once "./api/models/database.php" ?>
  <?php include_once "./api/models/Productos.php" ?>

  <?php include_once "./components/header.php" ?>

  <?php include_once "./components/banner.php" ?>

  <div class="container p-3">

    <?php $reg = new Productos(); ?>

    <div class="row gap-2 justify-content-between" id="contenido-producto">

      <?php foreach ($reg->All() as $row) { ?>

        <div class="card" style="width: 18rem;">
          <img src="./assets/products/<?php echo $row['Imagen_Producto']; ?>" class="card-img-top" alt="<?php echo $row['Nombre_Producto']; ?>">
          <div class="card-body">
            <h5 class="card-title"><?php echo $row['Nombre_Producto']; ?></h5>
            <p class="card-text"><?php echo $row['Descripcion_Producto']; ?></p>

            <div class="d-flex justify-content-between">
              <h4 class="card-text float-end">S/.<?php echo $row['Precio_Producto']; ?></h4>
              <button href="#" data-description="<?php echo $row['Descripcion_Producto']; ?>" data-price="<?php echo $row['Precio_Producto']; ?>" data-name="<?php echo $row['Nombre_Producto']; ?>" data-img="<?php echo $row['Imagen_Producto']; ?>" data-id="<?php echo $row['ID_Producto']; ?>" class="btn btn-secondary float-end">
                Agregar
              </button>
            </div>
          </div>
        </div>

      <?php } ?>

    </div>

  </div>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
</body>

</html>

<script>
  const contenidoProducto = document.getElementById('contenido-producto');
  const contadorCarrito = document.getElementById('contador-carrito');

  const LocalCarrito = getCarrito();

  ShowMessageCarrito()

  function ShowMessageCarrito() {
    if (LocalCarrito.length) {
      contadorCarrito.classList.remove('visually-hidden')
      contadorCarrito.textContent = LocalCarrito.length;
    }
  }

  function getCarrito() {
    let local = localStorage.getItem('carrito');
    return local !== null ? [...JSON.parse(local)] : [];
  }

  function setCarrito() {
    localStorage.setItem('carrito', JSON.stringify(LocalCarrito));
  }

  function isExists(id) {
    return LocalCarrito.filter(carrito => carrito.id === id).length
  }

  const handleClick = (ev) => {
    if (ev.target.classList.contains('btn-secondary')) {
      const object = {
        id: ev.target.dataset.id,
        name: ev.target.dataset.name,
        description: ev.target.dataset.description,
        price: ev.target.dataset.price,
        img: ev.target.dataset.img,
      }

      if (isExists(object.id)) {
        console.log('no c puede agregar algo ya existente');
      } else {
        LocalCarrito.push(object);
        setCarrito();
        ShowMessageCarrito();
      }
    }
    ev.stopPropagation();
  }

  contenidoProducto.addEventListener('click', handleClick)
</script>