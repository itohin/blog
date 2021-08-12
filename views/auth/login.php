<?php
    require base_path('/views/partials/header.php');
?>

    <div class="row justify-content-center">
        <div class="col-6">
            <h1 class="text-center">Log In</h1>
            <form action="/login" method="POST">
                <div class="form-group">
                    <label for="email">Email</label>
                    <input type="text" class="form-control" name="email" id="email">
                </div>
                <div class="form-group">
                    <label for="email">Pasword</label>
                    <input type="password" class="form-control" name="password" id="password">
                </div>
                <div class="form-check">
                    <label for="remember" class="for-check-label">
                        <input type="checkbox" name="remember" id="remember" class="form-check-input">
                        Remember me
                    </label>
                </div>
                <div class="form-group mt-3">
                    <button class="btn btn-primary w-100">Log In</button>
                </div>
            </form>
        </div>
    </div>

<?php
    require base_path('/views/partials/footer.php');
