<?php require ROOT . "/partials/top.php"; ?>
<?php require ROOT . "/partials/nav.php"; ?>

<section class="container-fluid">
    <article class="d-flex justify-content-center align-items-center flex-column vh-100">
        <form class="col-md-4" action="login.php" method="post">
            <div class="col-md-6 offset-md-3 mb-3">
                <input class="form-control mb-3 text-center" type="text" placeholder="E-mail" name="email">
                <input class="form-control text-center" type="password" placeholder="Password" name="password">
            </div>
            <div class="col-md-6 offset-md-3  text-center">
                <a class="btn btn-warning mb-3" href="change_password.php">Change password</a>
                <a class="btn btn-warning mb-3" href="register.php">Register</a>
            </div>
            <div class="col-md-6 offset-md-3 mb-3 ">
                <button class="form-control btn-primary" type="submit">Login</button>
            </div>
            <?php if(isset($error) && count($error)>0): ?>
            <ul>
                <?php foreach($error as $err): ?>
                <li><?php echo $err; ?></li>
                <?php endforeach; ?>
            </ul>
            <?php endif; ?>

            <?php if($err_login != null): ?>
            <p class="error-msg text-center"><?php echo $err_login; ?></p>
            <?php endif; ?>
        </form>
    </article>
</section>

<?php require ROOT . "/partials/bottom.php"; ?>