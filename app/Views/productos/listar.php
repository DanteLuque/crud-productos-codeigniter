<?= $header; ?>

<div class="container mt-5">
  <h2 class="mb-4"> Productos disponibles </h2>
  <div class="row g-4">
    <?php foreach ($productos as $producto): ?>
      <div class="col-md-4">
        <div class="card h-100">

          <img
            src="<?= $producto['imagen']
                    ? '/uploads/' . $producto['imagen']
                    : '/sin_imagen.jpg' ?>"
            alt="imagen"
            class="
            card-img-top
            common-fixed-img
            ">

          <div class="card-body d-flex flex-column">
            <h5 class="card-title"><?= $producto['nombre'] ?></h5>
            <p class="card-text"><?= substr($producto['descripcion'], 0, 30) . '...' ?></p>

            <!-- precios -->
            <div class="mt-auto d-flex justify-content-between align-items-center gap-2">

              <!-- precio original -->
              <span class="h5 mb-0<?= $producto['descuento'] ? ' text-decoration-line-through' : '' ?>">
                $<?= $producto['precio'] ?>
              </span>

              <!-- precio con descuento -->
              <?php if ($producto['descuento']) { ?>
                <span class="h5 mb-0 text-success">
                  $<?= number_format($producto['precio'] - $producto['precio'] * ($producto['descuento'] / 100), 2) ?>
                </span>
              <?php } ?>

              <!-- descuento -->
              <div>
                <?php if ($producto['descuento']) { ?>
                  <i class="bi bi-star-fill text-success"><?= $producto['descuento'] ?>%</i>
                <?php } ?>
              </div>
            </div>
          </div>

          <!-- acciones -->
          <div class="card-footer d-flex justify-content-between bg-light">
            <a href="<?= base_url('productos/eliminar_db/') ?><?= $producto['id'] ?>" class="btn btn-outline-secondary btn-sm"><i class="bi bi-heart"></i> Eliminar</a>

            <a href="<?= base_url('productos/editar/') ?><?= $producto['id'] ?>" class="btn btn-primary btn-sm">Editar</a>
          </div>

        </div>
      </div>
    <?php endforeach; ?>
  </div>
</div>


<?= $footer; ?>