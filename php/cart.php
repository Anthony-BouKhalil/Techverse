<?php
$req = file_get_contents("php://input");
$data = mb_convert_encoding($req,'UTF-8', 'UTF-8');
$post= json_decode($data);

if (!isset($_SESSION)) {
    session_start();
}

$action = $_GET['action'];
switch($action) {
case "add":
    if(empty($_SESSION['cart'])) {
        $_SESSION['cart'] = array();
    }

    if (isset($post->product_id) && !in_array($post->product_id, $_SESSION['cart'])){
        array_push($_SESSION["cart"], $post->product_id);
    }
    break;
case "delete":
    if (!empty($_SESSION['cart']) && isset($post->product_id)) {
        if (($key = array_search($post->product_id, $_SESSION['cart'])) !== false) {
            unset($_SESSION['cart'][$key]);
        }
    } 
    break;
case "list":
    require '../controllers/cart-controller.php';
    $conn = mysqli_connect('localhost', 'root', '', 'scsstore');
    $controller = new CartController($conn);
    $controller->getCartProducts();
    break;
}

?>
