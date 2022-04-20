<?php
require_once 'product-controller.php';
class CartController
{
    private $dbcon;

    public function __construct($dbcon) {
        $this->dbcon = $dbcon;
    }

    public function getCartProducts() {
        $productcon = new ProductController($this->dbcon);
        $cart_products = array();
        if (isset($_SESSION['cart'])) {
            $len = count($_SESSION['cart']);
            for ($i = 0; $i <= $len; $i++) {
                if(isset($_SESSION['cart'][$i])) {
                    $result = $productcon->getProduct($_SESSION['cart'][$i]);
                    if (mysqli_num_rows($result) > 0) {
                        array_push($cart_products, mysqli_fetch_assoc($result));
                    }
                }
            }
        }
        $data = mb_convert_encoding($cart_products, 'UTF-8', 'UTF-8');
        echo json_encode($data);
    }
}
?>
