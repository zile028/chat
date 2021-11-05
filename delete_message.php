<?php
require "core/init.php";
if (isLoged()) {
    $Messages = new Messages();

    $status = $Messages->delete($_POST["id"]);
    $number_msg=$Messages->numberMessages($_SESSION["id"]);

    echo json_encode($number_msg);

} else {
    echo "You are not loged.";
}