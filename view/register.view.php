<?php require ROOT . "/partials/top.php"; ?>
<?php require ROOT . "/partials/nav.php"; ?>


<section class="container-fluid">
    <article class="d-flex justify-content-center align-items-center flex-column vh-100">
        <form action="register.php" class="col-md-4" method="post" enctype="multipart/form-data">
            <div class="mb-3">
                <div class="profil col-6 offset-3 text-center">
                    <label for="file-img"><img class="profil-img mx-auto" id="profil" src="" alt=""></label>
                    <label class="btn btn-primary" for="file-img">Choose image</label>
                    <input id="file-img" type="file" name="profil_img">
                </div>
                <input class="form-control mb-3 text-center" type="text" placeholder="First name" name="first_name"
                    value="<?php echo empty($first_name) ? "": $first_name; ?>">
                <input class="form-control mb-3 text-center" type="text" placeholder="Last name" name="last_name"
                    value="<?php echo empty($last_name) ? "": $last_name ?>">

                <input class="form-control mb-3 text-center" type="email" placeholder="E-mail" name="email"
                    value="<?php echo empty($email) ? "": $email; ?>">
                <input class="form-control mb-3 text-center" type="password" placeholder="Password" name="password">
                <input class="form-control mb-3 text-center" type="password" placeholder="Repeat password"
                    name="repeat_password">
            </div>
            <div class=" mb-3 ">
                <button class="form-control btn-primary" type="submit">Register</button>
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