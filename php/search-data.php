<?php
    require '../controllers/order-controller.php';
    $req = file_get_contents("php://input");
    $data = mb_convert_encoding($req,'UTF-8', 'UTF-8');
    $post= json_decode($data);

    $result_title = "Order not found";
    $result_body = "An order with that id and user id could not be found.";
    
    $user_id = $post->user_id;
    $order_id = $post->order_id; 
    $conn = mysqli_connect('localhost', 'root', '', 'scsstore');
    $controller = new OrderController($conn);
    $result = $controller->search($user_id, $order_id);
    $row = mysqli_fetch_assoc($result);
    
    $products_list = array();
    $orderID=$date_issued=$order_date=$total_price = null;

    if ($row != null) {
        $orderID = $row['order_id'];
        $date_issued = $row['date_issued'];
        $order_date = $row['order_date'];
        $products = $controller->getProducts($order_id);
        while($product_row = mysqli_fetch_assoc($products)) {
            array_push($products_list, $product_row['name']);
        }
        $total_price = $row['total_price'];
    }

    $search_data = array(
        'orderID'  => $orderID,
        'dateIssued' => $date_issued,
        'orderDate' => $order_date,
        'products' => $products_list,
        'totalPrice' => $total_price
    );

    $data = mb_convert_encoding($search_data, 'UTF-8', 'UTF-8');
    echo json_encode($data);
?>