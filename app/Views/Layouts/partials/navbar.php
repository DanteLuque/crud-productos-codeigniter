  <nav class="navbar navbar-expand-lg navbar-light bg-light">
    <div class="container-fluid">
      <a class="navbar-brand" href="<?= base_url() ?>">Tiendita :D</a>

      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarText"
        aria-controls="navbarText" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>

      <div class="collapse navbar-collapse" id="navbarText">

        <ul class="navbar-nav me-auto mb-2 mb-lg-0">
          <li class="nav-item">
            <a class="nav-link" href="<?= base_url() ?>">Inicio</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="<?= base_url('productos/crear') ?>">Crear producto</a>
          </li>
        </ul>

        <span class="navbar-text">
          <ul class="navbar-nav me-auto mb-2 mb-lg-0">
            <li class="nav-item">
              <a class="nav-link" href="<?= base_url('auth/login') ?>">Iniciar sesión</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="#" data-bs-toggle="modal" data-bs-target="#registerModal">Registrarse</a>
            </li>
          </ul>
        </span>

      </div>
    </div>

    <div class="modal fade" id="registerModal" tabindex="-1" aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content p-4">
          <h5 class="mb-3">¿Desea registrarse como?</h5>
          <div class="d-flex gap-3">
            <a href="<?= base_url('auth/register-cliente') ?>" class="btn btn-outline-primary d-flex align-items-center gap-2">
              <i data-lucide="user"></i> Cliente
            </a>
            <a href="<?= base_url('auth/register-vendedor') ?>" class="btn btn-outline-success d-flex align-items-center gap-2">
              <i data-lucide="store"></i> Vendedor
            </a>
          </div>
        </div>
      </div>
    </div>
  </nav>