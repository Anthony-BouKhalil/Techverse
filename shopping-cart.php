<?php
require 'controllers/product-controller.php';
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
    <link rel="stylesheet" type="text/css" href="styles/main-page.css">
    <link rel="stylesheet"  type="text/css" href="bootstrap/css/bootstrap.css"></link>
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/css/bootstrap.min.css" rel="stylesheet" >
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" ></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.min.js" integrity="sha384-Atwg2Pkwv9vp0ygtn1JAojH0nYbwNJLPhwyoVbhoPwBhjQPR5VtM2+xf0Uwh9KtT" crossorigin="anonymous"></script>
    <title>Shopping Cart</title>
    <style>
        #devices th, #devices td {
            border: 1px solid black;
            padding: 10px;
        }

        #devices {
            margin-top: 18px;
            margin-right: 18px;
            border-collapse: collapse;
            width: 100%;
        }

        th, td {
            text-align: center;
        }
    </style>
</head>
<body>
    <?php require 'header.php' ?>
     
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
        <?php
            $conn = mysqli_connect('localhost', 'root', '', 'scsstore');
            $controller = new ProductController($conn);

            if (isset($_POST['delete'])) {
                unset($_SESSION['cart'][$_POST['delete']]);
            } 

            if (isset($_SESSION['cart'])) {
                $len = array_key_last($_SESSION['cart']);
    
                for ($i = 0; $i <= $len; $i++) {
                    if(isset($_SESSION['cart'][$i])) {
                        $result = $controller->getProduct($_SESSION['cart'][$i]);

                        if (mysqli_num_rows($result) > 0) {
                            while ($row = mysqli_fetch_assoc($result)) {
                                echo "<tr>";
                                    echo "<td>";
                                        echo "<img src='" . $row["image"] . "' alt='". $row["name"] . "' width='100%'>";
                                    echo "</td>";
                                    echo "<td>" . $row["name"] . "</td>";
                                    echo "<td>" .  $row["description"] . "</td>";
                                    echo "<td> $" . $row["unit_price"] . " CAD</td>";
                                    echo "<td>" . $row["type"] . "</td>";
                                    echo "<td>";
                                        echo "<form action='shopping-cart.php' method='POST'>";
                                        echo "<button type='submit' name='delete' value='" . $i . "'>Delete</button>";
                                        echo "</form>";
                                    echo "</td>";
                                echo "</tr>";
                            }
                        }
                    }
                }
            }
            echo "</table><br>";
            
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
            require 'footer.php';
        ?>
</body>
</html>
