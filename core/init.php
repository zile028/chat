<?php
require "config.php";
require "conection.php";
require "function.php";
require "classes.php";
require "test_function.php";

if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

?>