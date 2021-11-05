<?php require ROOT . "/partials/top.php"; ?>
<?php require ROOT . "/partials/nav.php"; ?>
<!-- Bootstrap 4 | visit: https://getbootstrap.com/-->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css"
    integrity="sha384-B0vP5xmATw1+K9KRQjQERJvTumQW0nPEzvF6L/Z6nronJ3oUOFUFpCjEUQouq2+l" crossorigin="anonymous">
<main class="container">

    <h1 class="text-center my-5">

        <?php echo "{$user["first_name"]} {$user["last_name"]}"; ?>

    </h1>

    <section class="profil row no-gutters justify-content-between">
        <article class="profil-image col-md-3 mb-3 flex-grow-1">
            <img class="profil-img mx-auto" src="<?php echo SRC_PATH . $user['profil_img']; ?>" alt="">
            <ul class="list-unstyled mr-3">
                <li><a class="btn btn-primary mt-3 w-100 d-flex justify-content-between align-items-center"
                        href="edit_profil.php">Edit profil</a></li>
                <li><a class="btn btn-primary mt-3 w-100 d-flex justify-content-between align-items-center"
                        href="index.php">New message</a></li>
                <li><a class="btn btn-primary mt-3 w-100 d-flex justify-content-between align-items-center"
                        href="index.php?dir=inbox">Inbox<span class="badge badge-light"
                            data-mailbox="inbox"><?php echo $number_msg["inbox"]; ?></span></a></li>
                <li><a class="btn btn-primary mt-3 w-100 d-flex justify-content-between align-items-center"
                        href="index.php?dir=sent">Sent messages<span class="badge badge-light"
                            data-mailbox="sent"><?php echo $number_msg["sent"]; ?></span></a></li>
            </ul>
        </article>
        <article class="col-md-9">
            <form class="w-100" action="index.php" method="post">
                <input class="form-control mb-3" name="subject" type="text" placeholder="Subject"
                    value="<?php echo empty($subject) ? "" : $subject; ?>">
                <textarea class="form-control mb-3 no-resize" name="text_message" placeholder="Message" cols="30"
                    rows="10"><?php echo empty($text_message) ? "" : $text_message; ?></textarea>

                <select class="form-control mb-3" name="recipient">
                    <option value="" disabled selected>Recipient</option>
                    <?php foreach ($all_users as $user): if ($user["id"] != $_SESSION['id']): ?>
                    <option value="<?php echo $user["id"]; ?>">
                        <?php echo "{$user["first_name"]} {$user["last_name"]}"; ?>
                    </option>
                    <?php endif;endforeach; ?>
                </select>

                <div class="custom-control custom-radio custom-control-inline">
                    <input class="custom-control-input" type="radio" name="urgent" value="1" id="urgently">
                    <label class="custom-control-label" for="urgently">Urgently</label>
                </div>
                <div class="custom-control custom-radio custom-control-inline">
                    <input class="custom-control-input" type="radio" name="urgent" value="0" id="no-urgently">
                    <label class="custom-control-label" for="no-urgently">Not urgent</label>
                </div>
                <button class="btn btn-primary float-right" name="send_msg" type="submit">SEND</button>
                <?php if (isset($error) && count($error) > 0): ?>
                <ul>
                    <?php foreach ($error as $err): ?>
                    <li class="error-msg text-center">
                        <?php echo $err; ?>
                    </li>
                    <?php endforeach; ?>
                </ul>
                <?php endif; ?>
            </form>
        </article>
        <!--
        <article class="profil-info col-md-9">
            <ul class="list-group">
                <li class="list-group-item">First name: <span class="ml-2 font-weight-bold">
                        <?php echo $user["first_name"]; ?>
                    </span>
                </li>
                <li class="list-group-item">Last name: <span class="ml-2 font-weight-bold">
                        <?php echo $user["last_name"]; ?>
                    </span></li>
                <li class="list-group-item">E-mail: <span class="ml-2 font-weight-bold">
                        <?php echo $user["email"]; ?>
                    </span></li>
                <li class="list-group-item">Registered: <span class="ml-2 font-weight-bold">
                        <?php echo $user["register_at"]; ?>
                    </span>
                </li>
                <li class="list-group-item">Last login: <span class="ml-2 font-weight-bold">
                        <?php echo $user["last_login"]; ?>
                    </span>
                </li>
                <li class="list-group-item">Role: <span class="ml-2 font-weight-bold">
                        <?php echo $user["role"]; ?>
                    </span></li>
                <li class="list-group-item">Role description: <span class="ml-2 font-weight-bold">
                        <?php echo $user["description"]; ?>
                    </span></li>
            </ul>
        </article> -->
    </section>

    <section class="messages container mt-5">

        <article class="mt-4">
            <!-- urgently -->
            <?php if (isset($_GET["dir"]) && "inbox" == $_GET["dir"]): ?>
            <h2 class="text-center">INBOX</h2>
            <?php elseif (isset($_GET["dir"]) && "sent" == $_GET["dir"]): ?>
            <h2 class="text-center">SENT MESSAGE</h2>
            <?php endif; ?>

            <?php if (isset($allMessages)): foreach ($allMessages as $msg): ?>

            <div class="card mb-3">
                <div class="card-header d-flex bg-danger">
                    <div><img src="<?php echo SRC_PATH . $msg['profil_img']; ?>" alt=""></div>
                    <div>
                        <h4><?php echo "{$msg["first_name"]} {$msg["last_name"]}"; ?></h4>
                        <h5><?php echo $msg["subject"]; ?></h5>
                    </div>

                    <div class="text-right">
                        <p><?php echo date("d. m. Y. H:i", strtotime($msg["time"])); ?></p>
                        <?php if ($msg["is_read"]): ?>
                        <button class="btn-sm btn-dark" type="button"><i class="fas fa-envelope"></i></button>
                        <?php else: ?>
                        <button class="btn-sm btn-dark" type="button"><i class="fas fa-envelope-open-text"></i></button>
                        <?php endif; ?>
                        <button class="trash-btn btn-sm btn-dark" type="button"
                            data-msgid=<?php echo $msg["m_id"]; ?>><i class="fas fa-trash"></i></button>
                    </div>
                </div>
                <div class="card-body">
                    <p>
                        <?php echo $msg["message"]; ?>
                    </p>
                </div>
                <div class="card-footer">
                    <p>Read</p>
                    <p>Not read</p>
                </div>
            </div>

            <?php endforeach;endif; ?>


            <!-- not urgently -->
            <!-- <div class="card mb-3 bg-success">
                <div class="card-header">
                    <img src="upload/8871635536081.jpg" alt="">
                    <h4>Ime i prezime</h4>
                    <h3>Naslov</h3>
                    <p>Datum i vreme prijema/slanja</p>
                    <button class="btn-sm btn-dark" type="button"><i class="fas fa-envelope"></i></button>
                    <button class="btn-sm btn-dark" type="button"><i class="fas fa-envelope-open-text"></i></button>
                    <button class="btn-sm btn-dark" type="button"><i class="fas fa-trash"></i></button>
                </div>
                <div class="card-body">
                    <p>Lorem, ipsum dolor sit amet consectetur adipisicing elit. Inventore pariatur nemo corporis
                        quos,
                        asperiores modi, architecto dolore dolorum qui illum adipisci porro rem beatae, autem nulla
                        at
                        voluptate. Nisi alias fuga ipsa magni, praesentium nesciunt rem rerum perspiciatis, quaerat
                        obcaecati reprehenderit placeat, nulla perferendis. Nulla, earum repudiandae, placeat,
                        praesentium
                        vero sint magnam veniam obcaecati doloribus consequuntur asperiores velit voluptates
                        recusandae
                        non
                        blanditiis ex sapiente accusamus minima! Sapiente ad eos beatae cumque iure obcaecati fuga
                        reiciendis sit modi mollitia, in delectus inventore ullam tenetur similique veniam ipsam
                        maxime
                        soluta deserunt quisquam provident? Aperiam non atque nihil facilis iusto error ab neque
                        eaque,
                        provident possimus similique eius adipisci doloremque fugit unde ad explicabo eos laborum
                        cumque
                        laboriosam quaerat voluptas recusandae. Reprehenderit porro mollitia, ad earum dignissimos
                        dolore
                        quasi voluptates placeat iusto animi nisi molestias aspernatur temporibus. Unde similique,
                        atque
                        delectus quis dicta ratione esse vel veniam quibusdam commodi, expedita minus porro at
                        temporibus
                        dignissimos quaerat ab fuga error nobis non dolorem natus!</p>
                </div>
                <div class="card-footer">
                    <p>Read</p>
                    <p>Not read</p>
                </div>
            </div> -->
        </article>

    </section>







</main>

<?php require ROOT . "/partials/bottom.php"; ?>