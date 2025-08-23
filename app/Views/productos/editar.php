<?= $header; ?>

<div class="container mt-2">
  <div class="my-2">
    <h4>Actualización de productos</h4>
    <a href="<?= base_url('/') ?>">Volver</a>
  </div>

  <form method="POST" action="<?= base_url('productos/update_db/') ?><?= $producto['id'] ?>" enctype="multipart/form-data">
    <div class="card">
      <div class="mb-3">
        <div class="card-body">

          <div>
            <label for="nombre">Nombre</label>
            <input type="text" class="form-control" name="nombre" id="nombre" autofocus required
            value="<?=$producto['nombre']?>"
            >
          </div>

          <div>
            <label for="imagen">Imagen</label>
            <input type="file" class="form-control" name="imagen" id="imagen" accept="image/png,image/jpeg,image/jpg"
              autofocus>
          </div>

          <?php if($producto['imagen']){ ?>
          <div>
            <label for="preview">Imagen actual:</label>
            <img src="/uploads/<?= $producto['imagen']?>" width="85px" class="mt-3">
          </div>
          <?php } ?>

          <div>
            <label for="descripcion" class="form-label">Descripción</label>
            <textarea class="form-control" name="descripcion" id="descripcion" rows="3" required><?=$producto['descripcion']?></textarea>
          </div>

          <div>
            <label for="nombre">Precio</label>
            <input type="number" id="precio" name="precio" min="0" step="any" placeholder="0.00" class="form-control"
              required
              value="<?=$producto['precio']?>"
              >
          </div>

          <div>
            <label for="nombre">Precio</label>
            <input type="number" id="descuento" name="descuento" min="0" max="100" placeholder="0" class="form-control"
            value="<?=$producto['descuento']?>"
            >
          </div>

        </div>
      </div>
      <div class="card-footer text-end">
        <a href="<?= base_url('') ?>" type="reset" class="btn btn-sm btn-outline-secondary">Cancelar</a>
        <button type="submit" class="btn btn-sm btn-primary">Actualizar</button>
      </div>
    </div>
  </form>
</div>

<?= $footer; ?>