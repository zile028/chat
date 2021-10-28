<?php

function logIn($email, $password)
{
    $db = new Db();

    $sql = "SELECT * FROM users WHERE email = ?";
    $qry = $db->db->prepare($sql);
    $qry->bind_param("s", $email);
    $qry->execute();
    $result = $qry->get_result();

    $get_data = $result->fetch_assoc();

    if (0 == $qry->errno && 1 == $result->num_rows) {
        if (password_verify($password, $get_data['password'])) {
            $_SESSION["id"] = $get_data['id'];
            $sql            = "UPDATE users SET last_login=now() WHERE id = ?";
            $qry            = $db->db->prepare($sql);
            $qry->bind_param("i", $get_data['id']);
            $qry->execute();
            return true;
        } else {
            return false;
        }
        return true;
    } else {
        return false;
    }

}

function isLoged()
{
    if (isset($_SESSION["id"])) {
        return true;
    } else {
        return false;
    }
}

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