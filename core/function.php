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

function singleFileInfo($files)
{
    $file_info = [];

    array_push($file_info, [
        "name"       => $files['name'],
        "temp_name"  => $files['tmp_name'],
        "size"       => $files['size'],
        "doc_name"   => strtolower($files['name']),
        "doc_ext"    => pathinfo(strtolower($files['name']), PATHINFO_EXTENSION),
        "input_name" => $_POST['file_name'],
        "store_name" => rand(100, 999) . time() . "." . pathinfo(strtolower($files['name']), PATHINFO_EXTENSION),
    ]);

    return $file_info;
}

function checkFile($file_info, $valid_ext, $valid_size, $required_name = true)
{
    $file_err = [];
    for ($i = 0; $i < count($file_info); $i++) {
        $file_err[$i] = [];
        if ($valid_size * MB < $file_info[$i]['size']) {
            $file_err[$i]["err_size"] = "File to large, " . $valid_size . "MB";
        }
        if (!in_array($file_info[$i]['doc_ext'], $valid_ext)) {
            $file_err[$i]["err_ext"] = "Your file format not alowed, alow format is: " . implode(",", $valid_ext);
        }
        if (empty($file_info[$i]['input_name']) && $required_name) {
            $file_err[$i]["err_name"] = "File name is required.";
        }
        if (count($file_info) == 1) {
            $result = ["info" => $file_info[$i], "errors" => $file_err[$i]];
        } else {
            $result   = [];
            array_push($result, ["info" => $file_info[$i], "errors" => $file_err[$i]]);
        }

    }

    return $result;
}