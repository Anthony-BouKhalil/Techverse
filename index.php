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
    <style>  
        .center {
            margin: auto;
            width: 60%;
            padding: 10px;
        }
        .bd-placeholder-img {
          font-size: 1.125rem;
          text-anchor: middle;
          -webkit-user-select: none;
          -moz-user-select: none;
          user-select: none;
        }

        @media (min-width: 768px) {
          .bd-placeholder-img-lg {
            font-size: 3.5rem;
          }
        }
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
<body ng-app="SCSStore">
    <?php require 'header.php' ?>
    <div ng-view></div>
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
    <?php require 'footer.php' ?>
    <script src="js/app.js"></script>
</body>
</html>
