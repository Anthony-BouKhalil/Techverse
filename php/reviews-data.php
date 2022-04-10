<?php
require '../controllers/reviews-controller.php';
$req = file_get_contents("php://input");
$data = mb_convert_encoding($req,'UTF-8', 'UTF-8');
$post= json_decode($data);
$conn = mysqli_connect('localhost', 'root', '', 'scsstore');
$controller = new ReviewsController($conn);

if (!isset($_SESSION)) {
    session_start();
}

$action = $_GET['action'];
switch($action) {
case "insert":
    $controller->insert($post->product, $post->text, $post->rating);
    break;
case "list":
    $controller->getReviews();
    break;
}

?>
