<link rel="stylesheet" href="<?php echo constant('URL'); ?>/assets/styles.css">

<nav class="navbar navbar-expand-lg navbar-light bg-light">
  <div class="container-fluid">
    <a class="navbar-brand" href="<?php echo constant('URL'); ?>">Tienda Online</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarText" aria-controls="navbarText" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarText">
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">
        <li class="nav-item">
          <a class="nav-link active" aria-current="page" href="#">Articulos</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="#">Mis Compras</a>
        </li>
      </ul>
      <div class="d-flex flex-row-reverse">
        <div>
          <a href="<?php echo constant('URL'); ?>Views/perfil/perfil.php">
            <img src="<?php echo constant('URL'); ?>assets/usuario.svg" class="set-image m-3" alt="icono usuario">
          </a>
        </div>
        <div class="position-relative mt-3">
          <a href="<?php echo constant('URL'); ?>Views/boleta/carrito.php">
            <img src="<?php echo constant('URL'); ?>assets/carrito.svg" class="set-image" alt="icono carrito">
            <span id="contador-carrito" class="visually-hidden position-absolute top-25 start-100 translate-middle badge rounded-pill bg-danger">
              0
            </span>
          </a>
        </div>
      </div>
    </div>
  </div>
</nav>