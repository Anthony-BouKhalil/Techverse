<?php
require_once '../controllers/order-controller.php';
if (!isset($_SESSION)) {
    session_start();
}
$req = file_get_contents("php://input");
$data = mb_convert_encoding($req,'UTF-8', 'UTF-8');
$post= json_decode($data);

$conn = mysqli_connect('localhost', 'root', '', 'scsstore');
$controller = new OrderController($conn);

if (isset($_SESSION['cart'])) {
    $result = $controller->createOrder($_SESSION['userId'], $post->checkout_data->date, $post->checkout_data->total_price);
    $order_id = $conn->insert_id;
    $_SESSION['lastOrder'] = $order_id;
    $len = count($_SESSION['cart']);
    for ($i = 0; $i <= $len; $i++) {
        if(isset($_SESSION['cart'][$i])) {
            $controller->createProductOrder($_SESSION['cart'][$i], $order_id);
        }
    }
}
unset($_SESSION['cart']);

$data = mb_convert_encoding(array('order_id' => $_SESSION['lastOrder'], 'user_id' => $_SESSION['userId']), 'UTF-8', 'UTF-8');
echo json_encode($data);
?>
