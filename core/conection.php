<?php
class Db{
    public $db;
    function __construct()
    {
        $this->db=mysqli_connect(HOST,USER,PASSWOPRD,DB);
    }
}
?>