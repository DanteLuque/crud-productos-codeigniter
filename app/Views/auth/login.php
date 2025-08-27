<?= $this->include('Layouts/partials/header') ?>

<div class="container mt-4">
    <h3>Iniciar Sesión</h3>

    <?= $this->include('common/msg-error') ?>
    <?= $this->include('common/msg-success') ?>

    <form method="POST" action="<?= base_url('auth/doLogin') ?>">
        <div class="mb-3">
            <label>Usuario</label>
            <input type="text" name="username" class="form-control" required>
        </div>
        <div class="mb-3">
            <label>Contraseña</label>
            <input type="password" name="userpass" class="form-control" required>
        </div>
        <button type="submit" class="btn btn-primary">Ingresar</button>
    </form>
</div>

<?= $this->include('Layouts/partials/footer') ?>
