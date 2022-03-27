<?php
class ProductController
{
    private $dbcon;

    public function __construct($dbcon) {
        $this->dbcon = $dbcon;
    }

    public function filter($type) {
        $query = "SELECT * FROM product WHERE type='".$type."'";
        $result = mysqli_query($this->dbcon, $query);
        return $result;
    }

    public function selectAll() {
        $query = "SELECT * FROM product";
        return mysqli_query($this->dbcon, $query);
    }

    public function getProduct($id) {
        $query = "SELECT * FROM product WHERE product_id = " . $id;
        return mysqli_query($this->dbcon, $query);
    }
}
?>
