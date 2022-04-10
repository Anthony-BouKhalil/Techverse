<?php
    require '../controllers/user-controller.php';
    $req = file_get_contents("php://input");
    $data = mb_convert_encoding($req,'UTF-8', 'UTF-8');
    $post= json_decode($data);
 
    $error_data = = array(
        'errPass'  => '',
        'errEmail' => '',
        'success' => true,
    );

    // Check if a password is a valid password
    if(preg_match("/^.*(?=.{8,})(?=.*[0-9])(?=.*[a-z])(?=.*[A-Z]).*$/", $post->password) === 0) {
        $error_data['errPass'] = 'Password must be at least 8 characters and must contain at least one lower case letter, one upper case letter and one digit';
        $error_data['success'] = false;
    } 
    else {
        $conn = mysqli_connect('localhost', 'root', '', 'scsstore');
        $controller = new UserController($conn);
        $duplicate = $controller->duplicate($email);
        if ($duplicate == true) {
            $error_data['errEmail'] = 'Email already exists';
            $error_data['success'] = false;
        }
        else {
            $conn = mysqli_connect('localhost', 'root', '', 'scsstore');
            $controller = new UserController($conn);
            $controller->createUser($post->email, $post->name, $post->password, $post->phone, $post->address, $post->city_code);
            $controller->signIn($post->email, $post->password);
        }
    }

    $data = mb_convert_encoding($error_data, 'UTF-8', 'UTF-8');
    echo json_encode($data);
?>