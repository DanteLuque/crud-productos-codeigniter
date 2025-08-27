<?= $this->include('Layouts/partials/header') ?>

<div class="container mt-4">
    <h3>Registro de Cliente</h3>

    <!-- Mensajes flash -->
    <?= $this->include('common/msg-error') ?>

    <form method="POST" action="<?= base_url('auth/cliente/save_db') ?>">
        <!-- DATOS DE USUARIO -->
        <div class="card mb-3">
            <div class="card-header">Datos de Usuario</div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label>Nombres</label>
                        <input type="text" name="nombres" class="form-control" minlength="2" required>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label>Apellidos</label>
                        <input type="text" name="apellidos" class="form-control" minlength="2" required>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label>Tipo de Documento</label>
                        <select name="tipo_doi_id" class="form-select" required>
                            <option value="">Seleccione</option>
                            <?php foreach ($tiposDoi as $tipo): ?>
                                <option value="<?= $tipo['id'] ?>"><?= $tipo['nombre'] ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label>Número de Documento</label>
                        <input type="number" name="num_doi" class="form-control" min="1" step="1" required>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label>Username</label>
                        <input type="text" name="username" class="form-control" minlength="4" maxlength="70" required>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label>Contraseña</label>
                        <input
                            type="password"
                            name="userpass"
                            class="form-control"
                            pattern="^(?=.*[A-Z])(?=.*\d)(?=.*[^A-Za-z\d]).{8,}$"
                            title="La contraseña debe tener mínimo 8 caracteres, una mayúscula, un número y un carácter especial"
                            required>
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

        <!-- DIRECCIÓN -->
        <div class="card mb-3">
            <div class="card-header">Dirección</div>
            <div class="card-body">
                <div class="row mb-2">
                    <div class="col-md-4">
                        <label>Departamento</label>
                        <select class="form-select" name="departamento" id="departamento" onchange="loadProvincias()">

                        </select>
                    </div>
                    <div class="col-md-4">
                        <label>Provincia</label>
                        <select class="form-select" name="provincia" id="provincia" onchange="loadDistritos()">
                            <option value="">Seleccione</option>
                        </select>
                    </div>
                    <div class="col-md-4">
                        <label>Distrito</label>
                        <select class="form-select" name="distrito" id="distrito">
                            <option value="">Seleccione</option>
                        </select>
                    </div>
                </div>
                <div class="mb-2">
                    <label>Dirección</label>
                    <input type="text" name="direccion" class="form-control">
                </div>
                <div class="mb-2">
                    <label>Referencia</label>
                    <input type="text" name="referencia" class="form-control">
                </div>
                <div class="row">
                    <div class="col-md-6 mb-2">
                        <label>Latitud</label>
                        <input type="text" name="lat" class="form-control">
                    </div>
                    <div class="col-md-6 mb-2">
                        <label>Longitud</label>
                        <input type="text" name="lng" class="form-control">
                    </div>
                </div>
            </div>
        </div>

        <button type="submit" class="btn btn-success">Registrarse</button>
    </form>
</div>

<?= $this->include('Layouts/partials/footer') ?>