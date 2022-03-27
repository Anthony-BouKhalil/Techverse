<?php
require_once 'controllers/order-controller.php';
if (!isset($_SESSION)) {
    session_start();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Invoice</title>
    <link rel="stylesheet" type="text/css" href="styles/main-page.css">
    <link rel="stylesheet"  type="text/css" href="bootstrap/css/bootstrap.css"></link>
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/css/bootstrap.min.css" rel="stylesheet" >
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" ></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.min.js" integrity="sha384-Atwg2Pkwv9vp0ygtn1JAojH0nYbwNJLPhwyoVbhoPwBhjQPR5VtM2+xf0Uwh9KtT" crossorigin="anonymous"></script>
    <style>
    .center {
        text-align: center;
        padding: 15px;
    }
    </style>
</head>
<body>
    <?php 
        require 'header.php';

        $conn = mysqli_connect('localhost', 'root', '', 'scsstore');
        $controller = new OrderController($conn);

        if (isset($_SESSION['cart'])) {
            $result = $controller->createOrder($_SESSION['userId'], $_SESSION['date'], $_SESSION['total']);
            $order_id = $conn->insert_id;
            $_SESSION['lastOrder'] = $order_id;
            $len = array_key_last($_SESSION['cart']);
            for ($i = 0; $i <= $len; $i++) {
                if(isset($_SESSION['cart'][$i])) {
                    $controller->createProductOrder($_SESSION['cart'][$i], $order_id);
                }
            }

        }
        echo "<div class='center'>";
        echo "<h1>Your order is confirmed and will be shipped soon!</h1>";
        echo "<p>Your user id is " . $_SESSION['userId'] . " and your order id is " . $_SESSION['lastOrder'] . ". Keep these to search for your order status later.</p>";
        echo "</div>";
        
        unset($_SESSION['cart']);
    ?>
<?php require 'footer.php'; ?>
</body>
</html>