<?php
class UserController
{
    private $dbcon;

    public function __construct($dbcon) {
        $this->dbcon = $dbcon;
    }

    public function createUser($email, $name, $password, $phone, $address, $city_code) {
        $salt = $this->generateRandomString(20);
        $password_hash = md5($password . $salt);
        $query = "INSERT INTO user (email, name, password_hash, salt, tel_no, address, city_code) VALUES ('$email', '$name', '$password_hash', '$salt', '$phone', '$address', '$city_code')";
        $result = mysqli_query($this->dbcon, $query);
        return $result;
    }

    public function duplicate($email) {
        $query = "SELECT email FROM user WHERE email='$email'";
        $result = mysqli_query($this->dbcon, $query);
        $row_cnt = mysqli_num_rows($result);
        if ($row_cnt > 0) {
            return true;
        }
        return false;
    }

    public function signIn($email, $password) {
        if (!isset($_SESSION)) {
            session_start();
        }
        $query = "SELECT salt FROM user WHERE email='$email'";
        $result = mysqli_query($this->dbcon, $query);
        if (mysqli_num_rows($result) == 0) {
            return false;
        }
        $row = $result->fetch_array(MYSQLI_ASSOC);
        $salt = $row['salt'];
        $password_hash = md5($password . $salt);

        $query = "SELECT name, user_id FROM user WHERE email='$email' AND password_hash='$password_hash'";
        $result = mysqli_query($this->dbcon, $query);
        $row_cnt = mysqli_num_rows($result);

        if ($row_cnt > 0) {
            $row = $result->fetch_array(MYSQLI_ASSOC);
            $_SESSION['user'] = $row['name'];
            $_SESSION['userId'] = $row['user_id'];
            return $_SESSION['user'];
        } else {
            return false;
        }
    }

    public function generateRandomString($length) {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }
        return $randomString;
    }
}
?>
