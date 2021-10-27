<?php require ROOT . "/partials/top.php"; ?>
<?php require ROOT . "/partials/nav.php"; ?>

<section class="container-fluid">
    <article class="d-flex justify-content-center align-items-center flex-column vh-100">
        <form class="col-md-4" action="" method="post">
            <div class="col-md-6 offset-md-3 mb-3">
                <input class="form-control mb-3 text-center" type="text" placeholder="E-mail">
                <input class="form-control text-center" type="text" placeholder="Password">
            </div>
            <div class="col-md-6 offset-md-3  text-center">
                <a class="btn btn-warning mb-3" href="change_password">Change password</a>
                <a class="btn btn-warning mb-3" href="register.php">Register</a>
            </div>
            <div class="col-md-6 offset-md-3 mb-3 ">
                <button class="form-control btn-primary" type="submit">Login</button>
            </div>

        </form>
    </article>
</section>

<?php require ROOT . "/partials/bottom.php"; ?>