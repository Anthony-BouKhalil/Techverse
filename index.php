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
    <title>SCS Web Application</title>
    <link rel="stylesheet" type="text/css" href="styles/main-page.css">
    <link rel="stylesheet"  type="text/css" href="bootstrap/css/bootstrap.css"></link>
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/css/bootstrap.min.css" rel="stylesheet" >
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" ></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.min.js" integrity="sha384-Atwg2Pkwv9vp0ygtn1JAojH0nYbwNJLPhwyoVbhoPwBhjQPR5VtM2+xf0Uwh9KtT" crossorigin="anonymous"></script>
    <style>  
        .center {
            margin: auto;
            width: 60%;
            padding: 10px;
        }
    </style>
</head>
<body>
    <?php require 'header.php' ?>

    <div class="center">
        <div class="dropdown">
        <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton2" data-bs-toggle="dropdown" aria-expanded="false">
            Filter by Type
        </button>
        <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton2">
            <li><a class="dropdown-item" href="index.php">All</a></li>
            <li><a class="dropdown-item" href="index.php?fn=phones">Phones</a></li>
            <li><a class="dropdown-item" href="index.php?fn=laptops">Laptops</a></li>
            <li><a class="dropdown-item" href="index.php?fn=tablets">Tablets</a></li>
            <li><a class="dropdown-item" href="index.php?fn=accessories">Accessories</a></li>
        </ul>
        <?php
        if (isset($_SESSION['user'])) {
            if ($_SESSION['user']== 'Admin')
            echo "<a href='http://localhost/phpmyadmin/index.php?route=/database/structure&server=1&db=scsstore' target='_blank'>
                    <button type='button' class='btn btn-primary' style='float:right;'>
                    db Maintain
                    </button>
                    </a>";
        }       
        ?>
        </div>
    </div>

    <div class="album py-3 bg-light">
        <div class="container">
        <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 g-3">
        <?php
            if(empty($_SESSION['cart'])) {
                $_SESSION['cart'] = array();
            }

            if (isset($_POST['add'])) {
                if (!in_array($_POST['add'], $_SESSION['cart'])){
                    array_push($_SESSION["cart"], $_POST['add']);
                }
            }

            $conn = mysqli_connect('localhost', 'root', '', 'scsstore');
            $controller = new ProductController($conn);
            $result;
            
            $types = array("phones", "laptops", "tablets", "accessories");
            if (isset($_GET['fn']) && in_array($_GET['fn'], $types)) {
                $result = $controller->filter($_GET['fn']);
            } 
            else {
                $result = $controller->selectAll();
            }

            $i = 0;
            while($row = mysqli_fetch_assoc($result)) {
                $i = $i + 1;
                $id = $row["product_id"];
                $name = $row["name"];
                $address = $row["image"];
                $pic = "<img width='100%' height='100%' alt='$name' src='$address'/>";
                $type = $row["type"];
                $price = $row["unit_price"];
                $description = $row["description"];

                echo "<div class='col'>";
                echo "<div class='card shadow-sm'>";
                echo $pic;
                    echo "<div class='card-body'>";
                    echo "<div class='card-title'>";
                        echo $name;
                    echo "</div>";
                    echo "<p class='card-text'>" . $description . "</p>";
                    echo "<div class='d-flex justify-content-between align-items-center'>";
                    echo "<div class='btn-group'>";
                        echo "<form action='index.php' method='POST'>";
                        $id = $row['product_id'];
                        echo "<button type='submit' name='add' class='btn btn-sm btn-outline-secondary'  value='" . $id . "'>Add to Cart</button>";
                        echo "</form>";
                        echo "</div>";
                        echo "<small class='text-muted'>$" . $price . " CAD</small>";
                    echo "</div>";
                    echo "</div>";
                echo "</div>";
                echo "</div>";
                if ($i % 3 == 0) {
                    echo "</div>";
                    echo "</div>";
                    echo "<div class='album py-3 bg-light'>";
                    echo "<div class='container'>";
                    echo "<div class='row row-cols-1 row-cols-sm-2 row-cols-md-3 g-3'>";
                
                }
            }
	    require 'footer.php';
        ?>
</body>
</html>
