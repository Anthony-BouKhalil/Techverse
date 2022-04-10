<?php
    require '../controllers/user-controller.php';
    $req = file_get_contents("php://input");
    $data = mb_convert_encoding($req,'UTF-8', 'UTF-8');
    $post= json_decode($data);

    $conn = mysqli_connect('localhost', 'root', '', 'scsstore');
    $controller = new UserController($conn);
    $result = $controller->signIn($post->email, $post->password);

    $data = mb_convert_encoding([$result], 'UTF-8', 'UTF-8');
    echo json_encode($data);
?>