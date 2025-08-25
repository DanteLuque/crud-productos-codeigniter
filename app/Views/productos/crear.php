<?= $this->extend('layouts/master') ?>
<?= $this->section('content') ?>

<div class="container mt-2">
  <div class="my-2">
    <h4>Registro de productos</h4>
    <a href="<?= base_url() ?>">Volver</a>
  </div>

  <form method="POST" action="<?= base_url('productos/save_db') ?>" enctype="multipart/form-data">
    <div class="card">
      <div class="mb-3">
        <div class="card-body">

          <div>
            <label for="nombre">Nombre</label>
            <input type="text" class="form-control" name="nombre" id="nombre" autofocus required>
          </div>

          <div>
            <label for="imagen">Imagen</label>
            <input type="file" class="form-control" name="imagen" id="imagen" accept="image/png,image/jpeg,image/jpg"
              autofocus>
          </div>

          <div>
            <label for="descripcion" class="form-label">Descripción</label>
            <textarea class="form-control" name="descripcion" id="descripcion" rows="3" required></textarea>
          </div>

          <div>
            <label for="nombre">Precio</label>
            <input type="number" id="precio" name="precio" min="0" step="any" placeholder="0.00" class="form-control" required>
          </div>

          <div>
            <label for="nombre">Descuento</label>
            <input type="number" id="descuento" name="descuento" min="0" max="100" placeholder="0" class="form-control">
          </div>

          <div>
            <label for="categoria_id">Categoría</label>
            <select name="categoria_id" id="categoria_id" class="form-control" required>
              <option value="">-- Seleccione --</option>
              <?php foreach ($categorias as $categoria): ?>
                <option value="<?= $categoria['id'] ?>"><?= esc($categoria['nombre']) ?></option>
              <?php endforeach; ?>
            </select>
          </div>

        </div>
      </div>
      <div class="card-footer text-end">
        <a href="<?= base_url('') ?>" type="reset" class="btn btn-sm btn-outline-secondary">Cancelar</a>
        <button type="submit" class="btn btn-sm btn-primary">Guardar</button>
      </div>
    </div>
  </form>
</div>

<?= $this->endSection() ?>