<?php
require '../controllers/product-controller.php';
$conn = mysqli_connect('localhost', 'root', '', 'scsstore');
$controller = new ProductController($conn);
$controller->getProducts();
?>
