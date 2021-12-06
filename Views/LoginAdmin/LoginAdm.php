<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="description" content="La mejor tienda online improvisada en 10 horas">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
  <link rel="stylesheet" href="../../assets/styles.css">
  <title>Login</title>
</head>
<body>

    <!--  -->
    <section class="vh-100 gradient-custom">
  <div class="container py-3 h-100">
    <div class="row d-flex justify-content-center align-items-center h-100">
      <div class="col-12 col-md-8 col-lg-6 col-xl-5">
        <div class="card text-white" style="border-radius: 1rem;background:#1B212C">
        <form id="formRegister">
          <div class="card-body p-5 text-center">

            <div class="mb-md-1 mt-md-1 ">

              <h2 class="fw-bold mb-2 text-uppercase">Login ADM</h2>
              <p class="text-white-50 mb-5">ADM CORPORATION</p>

              <div class="form-outline form-white mb-4">
              <label class="form-label" for="typeEmailX">Correo:</label>
              <input name="email" type="email" id="typeEmailX" class="form-control form-control-lg" required />
               
              </div>

              <div class="form-outline form-white mb-4">
              <label class="form-label" for="typePasswordX">Contraseña:</label>
              <input minlength="6" name="password" type="password" id="typePasswordX" class="form-control form-control-lg" required/>
               
              </div>

              <p class="small mb-5 pb-lg-2"><a class="text-white-50" href="../LoginAdmin/RepassAdm.php">Se te olvidó tu contraseña?</a></p>

              <button class="btn btn-outline-light btn-lg px-5  m-2" type="submit">Inicia sesión</button>

            

            </div>

            <div>
              <p class="mb-0">No tengo una cuenta? <a href="../LoginAdmin/RegisterAdm.php" class="text-white-50 fw-bold">Registrate</a></p>
            </div>
            <div id="mesa-war" class="alert alert-danger d-none m-3" role="alert">
                        Los Datos no son Validos!
                    </div>
          </div>
        </form>
        </div>
      </div>
    </div>
  </div>
</section>
    <!--  -->
    <script>
    const Form = document.getElementById("formRegister");
    Form.addEventListener("submit", HandleSubmit)

    async function HandleSubmit(event) {
        event.preventDefault();
        let MisDatos = new FormData(Form);
        let response = await fetch(
            'http://localhost:8080/TiendaOnlineJulio/api/controllers/EmpleadoController.php?option=verificar', {
                method: "POST",
                body: MisDatos
            });
         if(response.status != 200){
            const mesaWar = document.getElementById("mesa-war");
            mesaWar.classList.remove("d-none");
         }else{
            let data = await response.json();
            await localStorage.setItem('session',JSON.stringify(data))
            window.location.href = "../../Views/HomeAdmin/HomeAdmin.php"
         };

    }
    </script>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
</body>

</html>