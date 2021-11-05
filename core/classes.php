<?php

class Users extends Db
{
    public function addUser($first_name, $last_name, $email, $password, $profil_img)
    {
        $password_hash = password_hash($password, PASSWORD_DEFAULT);
        $sql           = "INSERT INTO users (first_name, last_name, email, password, profil_img) VALUES (?,?,?,?,?)";
        $qry           = $this->db->prepare($sql);
        $qry->bind_param("sssss", $first_name, $last_name, $email, $password_hash, $profil_img);
        $qry->execute();
        if (0 == $qry->errno) {
            return true;
        } else {
            return false;
        }
    }

    public function checkUserEmail($email)
    {
        $sql = "SELECT * FROM users WHERE email = ?";
        $qry = $this->db->prepare($sql);
        $qry->bind_param("s", $email);
        $qry->execute();

        if (0 == $qry->errno && 0 != $qry->get_result()->num_rows) {
            return true;
        } else {
            return false;
        }
    }
    public function getUser($id)
    {
        $sql = "SELECT
                    u.*,
                    r.role,
                    r.description
                    FROM users u
                    LEFT JOIN role r ON r.id = u.role_id
                    WHERE u.id = ?";
        $qry = $this->db->prepare($sql);
        $qry->bind_param("i", $id);
        $qry->execute();
        $result = $qry->get_result();

        if (0 == $qry->errno) {
            return $result->fetch_assoc();
        } else {
            return false;
        }
    }

    public function getAllUser()
    {
        $sql = "SELECT
                    u.*,
                    r.role,
                    r.description
                    FROM users u
                    LEFT JOIN role r ON r.id = u.role_id";
        $qry = $this->db->prepare($sql);
        $qry->execute();
        $result = $qry->get_result();
        if (0 == $qry->errno) {
            return $result->fetch_all(MYSQLI_ASSOC);
        } else {
            return false;
        }
    }

    public function changePassword($email, $old_password, $new_password)
    {
        if (password_verify($old_password, getPassword($email))) {
            $password_hash = password_hash($new_password, PASSWORD_DEFAULT);
            $sql           = "UPDATE users SET password = ? WHERE email = ?";
            $qry           = $this->db->prepare($sql);
            $qry->bind_param("ss", $password_hash, $email);
            $qry->execute();
            if (0 == $qry->errno) {
                return true;
            } else {
                return false;
            }
        } else {
            // return []
        }
    }
}

class Messages extends Db
{

    public function sendMessage($sender_id, $subject, $text_message, $recipient, $urgent)
    {
        $sql = "INSERT INTO messages (sender_id,recipient_id,subject,message,urgently) VALUES (?,?,?,?,?)";
        $qry = $this->db->prepare($sql);
        $qry->bind_param("iissi", $sender_id, $recipient, $subject, $text_message, $urgent);
        $qry->execute();

        if (0 == $qry->errno) {
            return true;
        } else {
            return false;
        }
    }

    public function getAll($user_id, $type)
    {

        $sql = "SELECT m.*, u.*,
                    m.id m_id,
                    u.id u_id
                FROM messages m
                JOIN users u
                ON u.id = m.recipient_id ";
        if ("inbox" == $type):
            $sql .= "WHERE m.recipient_id = ? ";
        elseif ("sent" == $type):
            $sql .= "WHERE m.sender_id = ? ";
        endif;
        $sql .= "ORDER BY m.time DESC";

        $qry = $this->db->prepare($sql);
        $qry->bind_param("i", $user_id);
        $qry->execute();
        $result = $qry->get_result();
        if (0 == $qry->errno) {
            return $result->fetch_all(MYSQLI_ASSOC);
        } else {
            return false;
        }
    }

    public function numberMessages($sender_id)
    {
        $sql = "SELECT * FROM messages WHERE recipient_id = ?";
        $qry = $this->db->prepare($sql);
        $qry->bind_param("i", $sender_id);
        $qry->execute();
        $res_inbox = $qry->get_result();

        $sql = "SELECT * FROM messages WHERE sender_id = ?";
        $qry = $this->db->prepare($sql);
        $qry->bind_param("i", $sender_id);
        $qry->execute();
        $res_sent = $qry->get_result();

        $result = [
            "inbox" => $res_inbox->num_rows,
            "sent"  => $res_sent->num_rows,
        ];

        if (0 == $qry->errno) {
            return $result;
        } else {
            return false;
        }
    }

    public function delete($id)
    {
        $sql = "DELETE FROM messages WHERE id = ?";
        $qry = $this->db->prepare($sql);
        $qry->bind_param("i", $id);
        $qry->execute();
        if (0 == $qry->errno) {
            return true;
        } else {
            return false;
        }
    }

}