<?= $this->extend('layouts/master') ?>
<?= $this->section('content') ?>

<div class="container py-5">
    <div class="row">
        <!-- imagen -->
        <div class="col-md-6 mb-4">
            <div class="card">
                <img src="<?= $producto['imagen']
                    ? '/uploads/' . $producto['imagen']
                    : '/sin_imagen.jpg' ?>" class="card-img-top" alt="Imagen de producto">
            </div>
        </div>

        <!-- Detalles del producto -->
        <div class="col-md-6">
            <h1 class="h2 mb-3"><?= $producto['nombre'] ?></h1>
            <div class="mb-3">
                <span class="h4 me-2">$<?= number_format($producto['precio'] - $producto['precio'] * ($producto['descuento'] / 100), 2) ?></span>
                <span class="text-muted text-decoration-line-through">$<?= $producto['precio'] ?></span>
                <span class="badge bg-danger ms-2"><?= $producto['descuento'] ?>% OFF</span>
            </div>

            <div class="mb-3">
                   Categoria:<span class="text-secondary me-2"> <?= $categoria['nombre'] ?></span>
            </div>

            <p class="mb-4"><?= $producto['descripcion'] ?></p>

            <!-- cantidad -->
            <div class="mb-4">
                <label for="quantity" class="form-label">Cantidad:</label>
                <input type="number" class="form-control" id="quantity" value="1" min="1" style="width: 80px;">
            </div>

            <!-- acciones -->
            <div class="d-grid gap-2">
                <button class="btn btn-primary" type="button">Agregar al carrito</button>
            </div>
        </div>
    </div>
</div>

<?= $this->endSection() ?>