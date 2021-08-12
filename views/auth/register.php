<?php
require base_path('/views/partials/header.php');
?>
    <div class="row justify-content-center">
        <div class="col-6">
            <h1 class="text-center">Register</h1>
            <form action="/register" method="POST">
                <div class="form-group">
                    <label for="email">Name</label>
                    <input type="text" class="form-control <?= isset($errors['name']) ? 'is-invalid' : '' ?>" name="name" id="name" value="<?= $old['name'] ?? '' ?>">
                    <?php if (isset($errors['name'])): ?>
                        <div class="invalid-feedback"><?= $errors['name'][0] ?></div>
                    <?php endif; ?>
                </div>
                <div class="form-group">
                    <label for="email">Email</label>
                    <input type="text" class="form-control <?= isset($errors['email']) ? 'is-invalid' : '' ?>" name="email" id="email" value="<?= $old['email'] ?? '' ?>">
                    <?php if (isset($errors['email'])): ?>
                        <div class="invalid-feedback"><?= $errors['email'][0] ?></div>
                    <?php endif; ?>
                </div>
                <div class="form-group">
                    <label for="password">Pasword</label>
                    <input type="password" class="form-control <?= isset($errors['password']) ? 'is-invalid' : '' ?>" name="password" id="password">
                    <?php if (isset($errors['password'])): ?>
                        <div class="invalid-feedback"><?= $errors['password'][0] ?></div>
                    <?php endif; ?>
                </div>
                <div class="form-group">
                    <label for="confirmation">Pasword confirmation</label>
                    <input type="password" class="form-control <?= isset($errors['confirmation']) ? 'is-invalid' : '' ?>" name="confirmation" id="confirmation">
                    <?php if (isset($errors['confirmation'])): ?>
                        <div class="invalid-feedback"><?= $errors['confirmation'][0] ?></div>
                    <?php endif; ?>
                </div>
                <div class="form-group mt-3">
                    <button class="btn btn-primary w-100">Register</button>
                </div>
            </form>
        </div>
    </div>

<?php
require base_path('/views/partials/footer.php');
