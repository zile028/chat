<?php
require "core/init.php";
if (isLoged()){
    $Messages = new Messages();


    $status=$Messages->delete($_POST["id"]);
echo $status;
}else{
    echo "You are not loged.";
}
?>