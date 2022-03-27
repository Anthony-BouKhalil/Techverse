<?php
if (!isset($_SESSION)) {
    session_start();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="styles/shopping-cart.css">
    <link rel="stylesheet" type="text/css" href="styles/about-us.css">
    <link rel="stylesheet" type="text/css" href="styles/main-page.css">
    <link rel="stylesheet"  type="text/css" href="bootstrap/css/bootstrap.css"></link>
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/css/bootstrap.min.css" rel="stylesheet" >
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" ></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.min.js" integrity="sha384-Atwg2Pkwv9vp0ygtn1JAojH0nYbwNJLPhwyoVbhoPwBhjQPR5VtM2+xf0Uwh9KtT" crossorigin="anonymous"></script>

    <title>About Us</title>
</head>
<?php require 'header.php';?>
<body>
    <div class="global-container">
        <div class="container marketing">

        <div class="row">
            <div class="col-lg-4">
            <img src="images/profile_pic_1.png" height="140" width="140"/>
                <h2>Arnold</h2>
                <p>My responsibilites for this project included working on primarily the back-end services of the web application. My goal was to ensure that all the data are consistent and available to the user at
                    any given time. I worked on the database tables in MySQL, implementing the MVC pattern and diagrams, and the search mode dialogue.
                </p>
            </div>
            <div class="col-lg-4">
                <img src="images/profile_pic_2.png" height="140" width="140"/>
                <h2>Anthony</h2>
                <p>My responsibilities for the project include creating a database entity-relationship diagram, writing backend code in PHP and writing MySQL queries to retrieve and update information from our database. I used PHP to connect to our diagram and execute queries, as well as manage user logins/registrations and shopping cart items using session variables.</p>
            </div>
            <div class="col-lg-4">
                <img src="images/profile_pic_3.png" height="140" width="140"/>
                <h2>MD</h2>
                <p>My responsibilites for the project primarily focused on the front-end client side user interface. My goal was to make it as easy as possible for the user to perform actions all while using an aesthetically pleasing application. The technologies used in the front-end include JS Queries, Java Script, HTML & CSS, Google Maps APIs, and PHP.</p>
            </div>
        </div>
        </div>
    </div>
    
    <?php require 'footer.php';?>
</body>
</html>
