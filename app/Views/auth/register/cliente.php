<?= $this->include('Layouts/partials/header') ?>

<div class="container mt-4">
    <h3>Registro de Cliente</h3>
    <form method="POST" action="<?= base_url('auth/saveCliente') ?>">
        <!-- DATOS DE USUARIO -->
        <div class="card mb-3">
            <div class="card-header">Datos de Usuario</div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label>Nombres</label>
                        <input type="text" name="nombres" class="form-control" required>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label>Apellidos</label>
                        <input type="text" name="apellidos" class="form-control" required>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label>Tipo de Documento</label>
                        <select name="tipo_doi_id" class="form-select" required>
                            <?php foreach ($tiposDoi as $tipo): ?>
                                <option value="<?= $tipo['id'] ?>"><?= $tipo['nombre'] ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label>Número de Documento</label>
                        <input type="text" name="num_doi" class="form-control" required>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label>Username</label>
                        <input type="text" name="username" class="form-control" required>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label>Contraseña</label>
                        <input type="password" name="userpass" class="form-control" required>
                    </div>
                </div>
            </div>
        </div>

        <!-- DATOS DE CLIENTE -->
        <div class="card mb-3">
            <div class="card-header">Datos de Cliente</div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label>Email</label>
                        <input type="email" name="email" class="form-control" required>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label>Teléfono</label>
                        <input type="text" name="telefono" class="form-control">
                    </div>
                </div>
            </div>
        </div>

        <div class="card mb-3">
            <div class="card-header">Direcciones</div>
            <div class="card-body">
                <div id="direcciones-container"></div>
                <button type="button" class="btn btn-outline-primary" onclick="agregarDireccion()">Agregar dirección</button>
            </div>
        </div>

        <button type="submit" class="btn btn-success">Registrarse</button>
    </form>
</div>

<!-- Scripts -->


<?= $this->include('Layouts/partials/footer') ?>