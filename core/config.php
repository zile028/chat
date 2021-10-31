<?php
/* connection */
define("PORT",":8888");
define("HOST","localhost" . PORT);
define("DB","chat");
define("USER","root");
define("PASSWOPRD","root");


define ("HTTP","http://localhost" . PORT);
define ("ROOT_DIR","/chat");


/* paths */
define("ROOT",realpath(__DIR__."./.."));//root for include
define("URL_ROOT",HTTP . ROOT_DIR);

// define("UPLOAD" , $_SERVER["DOCUMENT_ROOT"])
define ("UPLOAD_DIR_NAME", "upload");
define("UPLOAD_PATH" , ROOT . "/". UPLOAD_DIR_NAME);
define("SRC_PATH" , URL_ROOT . "/". UPLOAD_DIR_NAME . "/");


/* time zone config */
date_default_timezone_set("Europe/Belgrade");

/* unit config */
define('KB', 1024);
define('MB', 1048576);
define('GB', 1073741824);
define('TB', 1099511627776);


?>