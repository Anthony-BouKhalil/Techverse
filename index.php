<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SCS Web Application</title>
    <link rel="stylesheet" type="text/css" href="styles/style.css">
    <link rel="stylesheet" type="text/css" href="styles/main-page.css">
    <link rel="stylesheet"  type="text/css" href="bootstrap/css/bootstrap.css"></link>
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/css/bootstrap.min.css" rel="stylesheet" >
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" ></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.min.js" integrity="sha384-Atwg2Pkwv9vp0ygtn1JAojH0nYbwNJLPhwyoVbhoPwBhjQPR5VtM2+xf0Uwh9KtT" crossorigin="anonymous"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.6.9/angular.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.6.9/angular-route.js"></script>
    <style>  
        .center {
            margin: auto;
            width: 60%;
            padding: 10px;
        }
    </style>
</head>
<body ng-app="SCSStore">
    <?php
        if (!isset($_SESSION)) {
            session_start();
        }
        if(empty($_SESSION['cart'])) {
            $_SESSION['cart'] = array();
        }

        if (isset($_POST['add']) && !in_array($_POST['add'], $_SESSION['cart'])){
                array_push($_SESSION["cart"], $_POST['add']);
        }
    ?>
    <?php require 'header.php' ?>
    <div ng-view></div>
    <?php require 'footer.php' ?>
    <script src="js/app.js"></script>
</body>
</html>
