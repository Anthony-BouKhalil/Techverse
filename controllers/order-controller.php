<?php
class OrderController
{
    private $dbcon;

    public function __construct($dbcon) {
        $this->dbcon = $dbcon;
    }

    public function createOrder($user_id, $order_date, $total_price) {
        $today = date("Y-m-d");
        $query = "INSERT INTO orders
        (user_id, date_issued, order_date, total_price) 
        VALUES
        ('".$user_id."', '".$today."', '".$order_date."', '".$total_price."')";
        $result = mysqli_query($this->dbcon, $query);
        return $result;
    }

    public function createProductOrder($product_id, $order_id) {
        $query = "INSERT INTO productorder (product_id, order_id)
            VALUES ('".$product_id."','".$order_id."')";
        mysqli_query($this->dbcon, $query);
    }

    public function getProducts($order_id) {
        $query = "SELECT name from product
           JOIN productorder ON productorder.product_id = product.product_id
           JOIN orders ON productorder.order_id = orders.order_id
           WHERE orders.order_id = '".$order_id."'";
        return mysqli_query($this->dbcon, $query);
    }

    public function search($user_id, $order_id) {
        $query = "SELECT * from orders WHERE user_id='".$user_id."' AND order_id='".$order_id."'";
        return mysqli_query($this->dbcon, $query);
    }
}
?>
