<?php require ROOT . "/partials/top.php"; ?>
<?php require ROOT . "/partials/nav.php"; ?>
<!-- Bootstrap 4 | visit: https://getbootstrap.com/-->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css"
    integrity="sha384-B0vP5xmATw1+K9KRQjQERJvTumQW0nPEzvF6L/Z6nronJ3oUOFUFpCjEUQouq2+l" crossorigin="anonymous">



<section class="container-fluid">
    <article class="d-flex justify-content-center align-items-center flex-column vh-100">
        <form action="register.php" class="col-md-4" method="post" enctype="multipart/form-data">
            <div class="mb-3">
                <img id="profil" src="" alt="">
                <input id="file_img" type="file" name="profil_img">
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
                <li><?php echo $err; ?></li>
                <?php endforeach; ?>
            </ul>
            <?php endif; ?>
        </form>
    </article>
</section>

<script src="main.js"></script>

<?php require ROOT . "/partials/bottom.php"; ?>