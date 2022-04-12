<?php
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
    <link rel="stylesheet" type="text/css" href="styles/index.css">
    <link rel="stylesheet" type="text/css" href="styles/style.css">
    <link rel="stylesheet" type="text/css" href="styles/main-page.css">
    <link rel="stylesheet"  type="text/css" href="bootstrap/css/bootstrap.css"></link>
    <link href="features.css" rel="stylesheet">
    <link rel="canonical" href="https://getbootstrap.com/docs/5.1/examples/jumbotron/">
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/css/bootstrap.min.css" rel="stylesheet" >
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" ></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.min.js" integrity="sha384-Atwg2Pkwv9vp0ygtn1JAojH0nYbwNJLPhwyoVbhoPwBhjQPR5VtM2+xf0Uwh9KtT" crossorigin="anonymous"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.6.9/angular.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.6.9/angular-route.js"></script>
</head>
<body ng-app="SCSStore">
    <div ng-controller="ParentController">
        <?php require 'header.php' ?>
        <div ng-view></div>
    </div>
    <h3 id="browser" style="text-align: center;"></h3>
    <script>
            let agent = navigator.userAgent;
            let browser = "";
            if (navigator.userAgent.indexOf("Edg") != -1 ) {
                browser = "Edge";
            } else if (navigator.userAgent.indexOf("Chrome") != -1){
                browser = "Chrome";
            } else if (navigator.userAgent.indexOf("Firefox") != -1) {
                browser = "Firefox"
            }
            document.getElementById("browser").innerHTML = "You are currently using: " + browser;
    </script>
    </script>
    <?php include 'search.html' ?>
    <?php require 'footer.php' ?>
    <script src="js/app.js"></script>
</body>
</html>
