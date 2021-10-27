<?php

require "core/init.php";

if ("POST" == $_SERVER["REQUEST_METHOD"]) {
    $users = new Users();
    $error = [];

    if (!isset($_POST['first_name']) || empty($_POST['first_name'])) {
        $error["first_name"] = "First name is required!";
    } else {
        $first_name = $_POST['first_name'];
    }

    if (!isset($_POST['last_name']) || empty($_POST['last_name'])) {
        $error["last_name"] = "Last name is required!";
    } else {
        $last_name = $_POST['last_name'];
    }

    if (!isset($_POST['email']) || empty($_POST['email'])) {
        $error["email"] = "Email is required!";
    } else {
        $email = $_POST['email'];
    }

    if (!isset($_POST['password']) || empty($_POST['password'])) {
        $error["password"] = "Password is required!";
    } elseif (!isset($_POST['repeat_password']) || empty($_POST['repeat_password'])) {
        $error["repeat_password"] = "Repeated password is required!";
    } elseif ($_POST['repeat_password'] !== $_POST['password']) {
        $error["repeat_password"] = "Repeated password not equal with password!";
    } else {
        $password = $_POST['password'];
    }

    if (count($error) == 0) {
        if ($users->addUser($first_name, $last_name, $email, $password)){
            echo "User is succefuly added!";
        }else{
            echo "User is not added!";
        };
    }

}

require "view/register.view.php";