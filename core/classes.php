<?php

class Users extends Db
{
    public function addUser($first_name, $last_name, $email, $password)
    {
        $password_hash = password_hash($password, PASSWORD_DEFAULT);
        $sql           = "INSERT INTO users (first_name, last_name, email, password) VALUES (?,?,?,?)";
        $qry           = $this->db->prepare($sql);
        $qry->bind_param("ssss", $first_name, $last_name, $email, $password_hash);
        $qry->execute();
        if (0 == $qry->errno) {
            return true;
        } else {
            return false;
        }
    }
}
?>