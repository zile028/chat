<?php

require "core/init.php";

$error = [];
if ("POST" == $_SERVER["REQUEST_METHOD"]) {
    $Users = new Users();

    // validation data

    if (!isset($_POST['email']) || empty($_POST['email'])) {
        $error["email"] = "Email is required!";
    } else {
        $email = $_POST['email'];
    }

    if (!isset($_POST["old_password"]) || empty($_POST["old_password"])) {
        $error["old_password"] = "Old password is required!";
    } else {
        $old_password = $_POST["old_password"];
    }

    if (!isset($_POST['new_password']) || empty($_POST['new_password'])) {
        $error["new_password"] = "New password is required!";
    } elseif (!isset($_POST['repeat_new_password']) || empty($_POST['repeat_new_password'])) {
        $error["repeat_new_password"] = "Repeated password is required!";
    } elseif ($_POST['repeat_new_password'] !== $_POST['repeat_new_password']) {
        $error["repeat_new_password"] = "Repeated password not equal with new password!";
    } else {
        $new_password = $_POST['new_password'];
    }

    if (count($error) == 0) {
        // check exist user email
        if ($Users->checkUserEmail($email)) {
            if($Users->changePassword($email,$old_password,$new_password)){
                header("location: login.php");
            }else{
                $error["err_msg"] = "The old password you entered does not match the current one.";
            };
        } else {
            $error["err_msg"] = "User with this email is not exists.";
        }

    }

}

require "view/change_password.view.php";