<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="description" content="La mejor tienda online improvisada en 10 horas">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
  <script defer src="../../assets/js/carrito.js"></script>
  <link rel="stylesheet" href="./assets/styles.css">
  <title>Login</title>
</head>

<body>

  <?php include_once "../../api/config/config.php"; ?>
  <?php include_once "../../components/header.php"; ?>

  <div class="d-flex justify-content-between bg-dark text-white p-3 position-relative" style="height: 10rem;">
    <h1>Detalle de Boleta</h1>
    <div class="d-flex flex-column align-items-end justify-content-end">
      <h2>S/.200</h2>
      <h6>20/02/2021 15:05:09</h6>
    </div>
  </div>

  <div class="container mt-3">
    <div class="d-flex row border border-1 border-dark bg-dark text-white">
      <div class="col-10 p-2">Detalles</div>
      <div class="col-2 p-2">Precio</div>
    </div>
    <div class="d-flex row border border-1">
      <div class="col-10 border-end p-2">
        <img src="../../assets/products/airpods.webp" class="" alt="">
      </div>
      <div class="col-2 p-2">
        S/.200
      </div>
    </div>
  </div>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
</body>

</html>