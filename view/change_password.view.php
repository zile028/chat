<?php require ROOT . "/partials/top.php"; ?>
<?php require ROOT . "/partials/nav.php"; ?>


<section class="container-fluid">
    <article class="d-flex justify-content-center align-items-center flex-column vh-100">
        <form action="change_password.php" class="col-md-4" method="post">
            <div class="mb-3">

                <input class="form-control mb-3 text-center" type="email" placeholder="E-mail" name="email"
                    value="<?php echo empty($email) ? "": $email; ?>">
                <input class="form-control mb-3 text-center" type="password" placeholder="Old password"
                    name="old_password">
                <input class="form-control mb-3 text-center" type="password" placeholder="New password"
                    name="new_password">
                <input class="form-control mb-3 text-center" type="password" placeholder="Repeat new password"
                    name="repeat_new_password">
            </div>
            <div class=" mb-3 ">
                <button class="form-control btn-primary" type="submit">Change password</button>
            </div>
            <?php if(isset($error) && count($error)>0): ?>
            <ul>
                <?php foreach($error as $err): ?>
                <li class="error-msg text-center"><?php echo $err; ?></li>
                <?php endforeach; ?>
            </ul>
            <?php endif; ?>

        </form>
    </article>
</section>

<?php require ROOT . "/partials/bottom.php"; ?>