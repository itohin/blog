<?php
    require base_path('/views/partials/header.php');
?>

    <div class="row justify-content-center">
        <div class="col-6">
            <h1 class="text-center">Log In</h1>
            <form action="/login" method="POST">
                <input type="hidden" name="csrf_token" value="<?= $csrfToken?>">
                <div class="form-group">
                    <label for="email">Email</label>
                    <input type="text" class="form-control <?= isset($errors['email']) ? 'is-invalid' : '' ?>" name="email" id="email" value="<?= $old['email'] ?? '' ?>">
                    <?php if (isset($errors['email'])): ?>
                        <div class="invalid-feedback"><?= $errors['email'][0] ?></div>
                    <?php endif; ?>
                </div>
                <div class="form-group">
                    <label for="email">Pasword</label>
                    <input type="password" class="form-control <?= isset($errors['password']) ? 'is-invalid' : '' ?>"" name="password" id="password">
                    <?php if (isset($errors['password'])): ?>
                        <div class="invalid-feedback"><?= $errors['password'][0] ?></div>
                    <?php endif; ?>
                </div>
                <div class="form-group mt-3">
                    <button class="btn btn-primary w-100">Log In</button>
                </div>
            </form>
        </div>
    </div>

<?php
    require base_path('/views/partials/footer.php');
