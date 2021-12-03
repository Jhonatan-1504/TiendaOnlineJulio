<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="La mejor tienda online improvisada en 10 horas">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="./assets/styles.css">
    <title>Login</title>
</head>

<body>

    <!--  -->
    <section class="vh-100 gradient-custom">
        <div class="container py-3 h-100">
            <div class="row d-flex justify-content-center align-items-center h-100">
                <div class="col-12 col-md-8 col-lg-6 col-xl-5">
                    <div class="card bg-dark text-white" style="border-radius: 1rem;">
                        <div class="card-body p-5 text-center">
                            <form id="formRegister">
                                <div class="mb-md-1 mt-md-1 ">

                                    <h2 class="fw-bold mb-2 text-uppercase">Modificar Contraseña</h2>
                                    <p class="text-white-50 mb-5">Por favor introduce tus datos!</p>

                                    <div class="form-outline form-white mb-4">
                                        <label class="form-label" for="typeEmailX">Correo:</label>
                                        <input name="email" type="email" id="typeEmailX"
                                            class="form-control form-control-lg" required />

                                    </div>

                                    <div class="form-outline form-white mb-4">
                                        <label class="form-label" for="typePasswordX">Nueva Contraseña:</label>
                                        <input name="password" type="password" id="typePasswordX"
                                            class="form-control form-control-lg" required />

                                    </div>

                                    <p class="small mb-5 pb-lg-2"><a class="text-white-50" href="#!">Registrate !!</a>
                                    </p>

                                    <button class="btn btn-outline-light btn-lg px-5  m-2" id="submit"
                                        type="submit">Guardar</button>
                                </div>
                                <div>
                                    <p class="mb-0">Ya tienes una cuenta? <a href="#!"
                                            class="text-white-50 fw-bold">Inicia sesión</a></p>
                                </div>
                        </div>

                    </div>
                    <div id="mesa-war" class="alert alert-danger d-none m-3" role="alert">
                        Las contraseñas no son las mismas!
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
            'http://localhost/TiendaOnlineJulio/api/controllers/UsuarioController.php?option=updatePassword', {
                method: "POST",
                body: MisDatos
            });
        let Datos = await response.json();
        console.log(Datos);
        //  if(dato.status != 200){
        //     const mesaWar = document.getElementById("mesa-war");
        //     mesaWar.classList.remove("d-none");
        //  }
        // window.location.href = "../../index.php";

    }
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous">
    </script>
</body>

</html>