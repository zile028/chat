<?php

require "core/init.php";

if(isLoged()){
    header("location: index.php");
}
$err_login=null;
if ("POST" == $_SERVER["REQUEST_METHOD"]) {

    $users = new Users();
    $error = [];

    if (!isset($_POST['email']) || empty($_POST['email'])) {
        $error["email"] = "Email is required!";
    } else {
        $email = $_POST['email'];
    }

    if (!isset($_POST['password']) || empty($_POST['password'])) {
        $error["password"] = "Password is required!";
    } else {
        $password = $_POST['password'];
    }

    if (count($error) == 0) {
        if(logIn($email, $password)){
            header("location: " . URL_ROOT . "/index.php");
        }else{
            $err_login="Wrong email or password!";
        };
    }

}

require "view/login.view.php";