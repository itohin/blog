<?php
require base_path('/views/partials/header.php');
?>

    <div class="row">
        <div class="col">
            <h3><?= $post->title ?></h3>
            <h6 class="card-subtitle mb-2 text-muted"><?= $post->date ?></h6>
            <p><?= nl2br($post->content) ?></p>
            <?php if (isset($user) && $user): ?>
                <a href="/editblog-<?= $post->date ?>" class="card-link">Edit post</a>
            <?php endif; ?>
        </div>
    </div>

<?php
require base_path('/views/partials/footer.php');
