<?php
require base_path('/views/partials/header.php');
?>

    <div class="row justify-content-center">
        <div class="col-6">
            <h1 class="text-center">Create new post</h1>
            <form action="/addblog" method="POST">
                <div class="form-group">
                    <label for="title">Title</label>
                    <input type="text" class="form-control <?= isset($errors['title']) ? 'is-invalid' : '' ?>" name="title" id="title" value="<?= $old['title'] ?? '' ?>">
                    <?php if (isset($errors['title'])): ?>
                        <div class="invalid-feedback"><?= $errors['title'][0] ?></div>
                    <?php endif; ?>
                </div>
                <div class="form-group">
                    <label for="content">Content</label>
                    <textarea class="form-control <?= isset($errors['title']) ? 'is-invalid' : '' ?>" name="content" id="content" cols="30" rows="10"><?= $old['content'] ?? '' ?></textarea>
                    <?php if (isset($errors['content'])): ?>
                        <div class="invalid-feedback"><?= $errors['content'][0] ?></div>
                    <?php endif; ?>
                </div>
                <div class="form-group mt-3">
                    <button class="btn btn-primary w-100">Create</button>
                </div>
            </form>
        </div>
    </div>

<?php
require base_path('/views/partials/footer.php');

