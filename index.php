<?php 

require "core/init.php";

if(isLoged()){
    require "view/index.view.php";
}else{
    require "view/login.view.php";
}



?>