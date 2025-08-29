<?= $this->include('Layouts/partials/header') ?>

<div class="container mt-4">
    <h3>Iniciar Sesión</h3>

    <?= $this->include('common/msg-error') ?>
    <?= $this->include('common/msg-success') ?>

    <form method="POST" action="<?= base_url('auth/doLogin') ?>">
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
        <button type="submit" class="btn btn-primary">Ingresar</button>
    </form>
</div>

<?= $this->include('Layouts/partials/footer') ?>