<?= $this->include('Layouts/partials/header') ?>

<div class="container mt-4">
    <h3>Registro de Vendedor</h3>

    <?= $this->include('common/msg-error') ?>

    <form method="POST" action="<?= base_url('vendedores/save_db') ?>">
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
                        <label>Username</label>
                        <input type="text" name="username" class="form-control" minlength="4" maxlength="70" required>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="userpass">Contraseña</label>
                        <div class="input-group">
                            <input
                                type="password"
                                id="userpass"
                                name="userpass"
                                class="form-control"
                                pattern="^(?=.*[A-Z])(?=.*\d)(?=.*[^A-Za-z\d]).{8,}$"
                                title="La contraseña debe tener mínimo 8 caracteres, una mayúscula, un número y un carácter especial"
                                required>
                            <button class="btn btn-outline-secondary" type="button" id="togglePassword">
                                <i data-lucide="eye"></i>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- DATOS DE VENDEDOR -->
        <div class="card mb-3">
            <div class="card-header">Datos de Vendedor</div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label>Email</label>
                        <input type="email" name="email" class="form-control" maxlength="70" required>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label>Teléfono</label>
                        <input type="tel" name="telefono" minlength="6" maxlength="12" class="form-control">
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label>¿Como se llama tu tiendita?</label>
                        <input type="text" name="nombre_tienda" class="form-control" maxlength="255" required>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label>Ruc</label>
                        <input type="text" name="ruc" class="form-control" minlength="11" maxlength="11" required>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12 mb-3">
                        <label>Descripción</label>
                        <input type="text" name="descripcion" class="form-control" minlength="100" maxlength="500" required>
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
                        <select class="form-select" name="departamento" id="departamento" required onchange="loadProvincias()">
                        </select>
                    </div>
                    <div class="col-md-4">
                        <label>Provincia</label>
                        <select class="form-select" name="provincia" id="provincia" required onchange="loadDistritos()">
                            <option value="">Seleccione</option>
                        </select>
                    </div>
                    <div class="col-md-4">
                        <label>Distrito</label>
                        <select class="form-select" name="distrito" id="distrito" required>
                            <option value="">Seleccione</option>
                        </select>
                    </div>
                </div>
                <div class="mb-2">
                    <label>Dirección</label>
                    <input type="text" name="direccion" class="form-control" minlength="5" required>
                </div>
                <div class="mb-2">
                    <label>Referencia</label>
                    <input type="text" name="referencia" class="form-control" minlength="3">
                </div>
                <div class="row">
                    <div class="col-md-6 mb-2">
                        <label>Latitud</label>
                        <input type="number" step="any" name="lat" class="form-control">
                    </div>
                    <div class="col-md-6 mb-2">
                        <label>Longitud</label>
                        <input type="number" step="any" name="lng" class="form-control">
                    </div>
                </div>
            </div>
        </div>

        <button type="submit" class="btn btn-success">Registrarse</button>
    </form>
</div>

<?= $this->include('Layouts/partials/footer') ?>