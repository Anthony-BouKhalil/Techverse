<?php
class UserController
{
    private $dbcon;

    public function __construct($dbcon) {
        $this->dbcon = $dbcon;
    }

    public function createUser($email, $name, $password, $phone, $address, $city_code) {
        $query = "INSERT INTO user (email, name, password, tel_no, address, city_code) VALUES ('$email', '$name', '$password', '$phone', '$address', '$city_code')";
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
        
        $query = "SELECT name, user_id FROM user WHERE email='$email' AND password='$password'";
        $result = mysqli_query($this->dbcon, $query);
        $row_cnt = mysqli_num_rows($result);

        if ($row_cnt > 0) {
            $row = $result->fetch_array(MYSQLI_ASSOC);
            $_SESSION['user'] = $row['name'];
            $_SESSION['userId'] = $row['user_id'];
            //header("Location: index.php");
            return $_SESSION['user'];
        } else {
            return false;
        }
    }
}
?>
