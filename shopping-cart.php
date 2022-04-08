<?php
if (!isset($_SESSION)) {
    session_start();
}
require_once 'controllers/product-controller.php';
?>
<body ng-controller="CartController">
    <table id="devices" style="width:100%">
  	    <col style="width:20%">
        <col style="width:20%">
        <col style="width:30%">
        <col style="width:10%">
        <col style="width:10%">
        <col style="width:10%">
        <tr>
          <th>Image</th>
          <th>Name</th>
          <th>Description</th>
          <th>Price</th>
          <th>Type</th>
          <th>Actions</th>
        </tr>
        <tr ng-repeat="product in cart">
            <td>
                <img src='{{product.image}}' alt='{{product.name}}' width='100%'>
            </td>
            <td> {{product.name}} </td>
            <td> {{product.description}} </td>
            <td> ${{product.unit_price}} CAD </td>
            <td> {{product.type}} </td>
            <td>
                <button ng-click='delete(product.product_id)'>Delete</button>
            </td>
        </tr>
    </table><br>
    <?php            
        if (isset($_SESSION['user'])) {
            if ((isset($_SESSION["cart"])) && count($_SESSION["cart"]) != 0) {
                echo "<form action='check-out.php' method='POST'>
                    <a href='check-out.php'><button type='button' class='btn btn-warning' name='checkout' style='float:right;'>Proceed to Checkout</button></a>
                    </form>";
            }
            else {
                echo "<font color='red'>You must have items in your cart to checkout</font>";
            }
        } else {
            echo "<font color='red'>You must be signed in to checkout</font>";
        }
    ?>
</body>
