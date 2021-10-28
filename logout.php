<?php 

require "core/init.php";

if(isLoged()){
    session_destroy();
    header("location: index.php");
}



?>