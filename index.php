<?php

require "core/init.php";

if (isLoged()) {
    $Users     = new Users();
    $Message   = new Messages();
    $user      = $Users->getUser($_SESSION['id']);
    $all_users = $Users->getAllUser();

    $error     = [];

    $number_msg = $Message->numberMessages($_SESSION['id']);

    if (isset($_POST["send_msg"])) {
        // validation data
        if (!isset($_POST['subject']) || empty($_POST['subject'])) {
            $error["subject"] = "Subject is required!";
        } else {
            $subject = $_POST['subject'];
        }

        if (!isset($_POST['text_message']) || empty($_POST['text_message'])) {
            $error["text_message"] = "Text message is required!";
        } elseif (strlen($_POST['text_message']) > 160) {
            $error["text_message"] = "Text message is to long, maximum character is 160!";
        } else {
            $text_message = $_POST['text_message'];
        }

        if (!isset($_POST['recipient']) || empty($_POST['recipient'])) {
            $error["recipient"] = "Recipient is required!";
        } else {
            $recipient = $_POST['recipient'];
        }

        if (!isset($_POST['urgent'])) {
            $error["urgent"] = "Urgency is required!";
        } else {
            $urgent = $_POST['urgent'];
        }

        if (count($error) == 0) {

            $Message->sendMessage($_SESSION['id'], $subject, $text_message, $recipient, $urgent);

            header("location: index.php");
        }
    }elseif(isset($_GET["dir"])){
        $allMessages = $Message->getAll($_SESSION['id'],$_GET["dir"]);
    }

    require "view/index.view.php";
} else {
    header("location: login.php");
}