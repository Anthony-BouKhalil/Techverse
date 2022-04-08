<?php
require '../controllers/reviews-controller.php';
$conn = mysqli_connect('localhost', 'root', '', 'scsstore');
$controller = new ReviewsController($conn);
$controller->getReviews();
?>
