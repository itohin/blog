<?php
    require base_path('/views/partials/header.php');
?>
<?php if (isset($user) && $user): ?>
    <div class="row mb-5">
        <div class="col">
            <a href="/addblog" class="btn btn-primary">Create new post</a>
        </div>
    </div>
<?php endif ?>
<div class="row">
    <div class="col">
        <?php foreach ($posts as $post): ?>
            <div class="card mb-4">
                <div class="card-body">
                    <h5 class="card-title"><?= $post->title ?></h5>
                    <h6 class="card-subtitle mb-2 text-muted"><?= $post->date ?></h6>
                    <p class="card-text"><?= $post->content ?></p>
                    <a href="/blog-<?= $post->date ?>" class="card-link">Read more</a>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
</div>

<?php
    require base_path('/views/partials/footer.php');
