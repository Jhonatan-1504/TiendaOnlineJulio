<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="description" content="La mejor tienda online improvisada en 10 horas">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
  <link rel="stylesheet" href="./assets/styles.css">
  <title>Login</title>
</head>
<body>
  <?php include_once "../../components/header.php" ?>

  <div class="container">
    <div style="margin: 5%;">
      <div  class="row list-group-item" style="display:flex;align-items: end;background: #000;color: #fff">
        <h1 class="col-md">Detalle de Boleta</h1>
        <div class="col-md">
          <p  style="font-size:15px;justify-content: space-around;display: flex;align-items: center;">Fecha de Compra: 10/02/2021 <strong style="font-size: 1.5rem">Total: 200.00</strong> </p>
        </div> 
      </div>
      <div class=" list-group-item">
        <div class="row">
          <div class="col-md-4" style="text-align: center;">
            <img style="width:80%;" src="../../assets/products/airpods.webp" alt="" class="card-img-top"/> 
          </div>
          <div class="col-md-8">
            <h2 style="font-size: 20px"><strong>Lorem ipsum dolor sit amet consectetur adipisicing elit.</strong></h2>  
            <div style="margin: 50px 0;" class="accordion" id="accordionPanelsStayOpenExample">
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
            <div style="display: flex;align-items: center;">
              <input style="padding: 3px;font-size: 1.2rem;" type="text" value="1" size="1" maxlength="1" disabled/>
              <strong style="color:red;font-size: 1.5rem;margin-left: 20px;">S/ 190.00</strong>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
</body>

</html>