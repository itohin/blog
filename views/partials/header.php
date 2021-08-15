<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Blog</title>

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
</head>
<body>

<div class="container">
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <a class="navbar-brand" href="/">Blog</a>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav ml-auto">
                <?php if (!isset($user) || !$user): ?>
                    <li class="nav-item">
                        <a class="nav-link" href="/login">Login</a>
                    </li>
                    <li>
                        <a class="nav-link" href="/register">Register</a>
                    </li>
                <?php else: ?>
                    <li>
                        <a class="nav-link" href="#"><?= $user->name ?></a>
                    </li>
                    <li>
                        <a class="nav-link" href="#" onclick="event.preventDefault(); document.getElementById('logout-form').submit()">Log out</a>
                    </li>
                <?php endif; ?>
            </ul>
            <form id="logout-form" action="/logout" method="POST" style="display: none">
                <input type="hidden" name="csrf_token" value="<?= $csrfToken?>">
            </form>
        </div>
    </nav>
</div>

<div class="container mt-5">
    <?php if (isset($error)): ?>
        <div class="alert alert-danger" role="alert">
            <?= $error ?>
        </div>
    <?php endif; ?>