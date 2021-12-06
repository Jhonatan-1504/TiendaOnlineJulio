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

  <div class="container mt-3" style="text-align: center;">
    <div class="d-flex row border border-1 border-dark bg-dark text-white">
      <div class="col-8 p-2">Detalles</div>
      <div class="col-2 p-2">Cantidad</div>
      <div class="col-2 p-2">Precio</div>
    </div>
    <div class="d-flex row border border-1" style="font-size: 1.5rem;">
      <div class="col-8 border-end p-2 justify-content-center d-flex">
        <img src="../../assets/products/airpods.webp" class="" alt="" style="max-width:15%;min-width: 53px;">
        <div class="d-flex align-items-center">Lorem ipsum dolor sit amet</div>
      </div>
      <div class="col-2 border-end p-2 d-flex align-items-center justify-content-center">
        1
      </div>
      <div class="col-2 p-2 text-bold d-flex align-items-center justify-content-center">
        <strong>S/.200</strong>
      </div>
    </div>
  </div>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
</body>

</html>