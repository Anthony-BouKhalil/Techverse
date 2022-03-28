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
    <link rel="stylesheet" type="text/css" href="styles/main-page.css">
    <link rel="stylesheet"  type="text/css" href="bootstrap/css/bootstrap.css"></link>
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/css/bootstrap.min.css" rel="stylesheet" >
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" ></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.min.js" integrity="sha384-Atwg2Pkwv9vp0ygtn1JAojH0nYbwNJLPhwyoVbhoPwBhjQPR5VtM2+xf0Uwh9KtT" crossorigin="anonymous"></script>
</head>
<body>
<?php 
    //TODO:
    //Refactor code to MVC Design Pattern & AngularJS Framework if needed

    require 'header.php';
    $conn = mysqli_connect('localhost', 'root', '', 'scsstore'); 

    //TODO:
    //Implement form to input reviews
    //Only if logged in 
    
    for ($i = 1; $i <= 12; $i++) {
        $total_query = "SELECT COUNT(review.product_id) AS TotalReviews, ROUND(AVG(stars), 1) AS AverageRating, text, product.name
                        FROM review
                        JOIN product ON product.product_id = review.product_id
                        WHERE review.product_id = $i";                        
        $total = mysqli_query($conn, $total_query);
        $reviews_query = "SELECT text, stars
                          FROM review 
                          WHERE review.product_id = $i
                          ORDER BY stars DESC";                        
        $reviews = mysqli_query($conn, $reviews_query);

        echo "<div class='col'>";
        echo "<div class='card shadow-sm'>";
            echo "<div class='card-body'>";
            echo "<div class='card-title'>";
            while($row = mysqli_fetch_assoc($total)) {
                echo "<b>" . $row['name'] . "</b>";
                echo "</div>";
                echo "<p class='card-text'>Total Reviews (". $row['TotalReviews'] . ")</h5>";
                $avg = $row["AverageRating"];
            }
            while($row = mysqli_fetch_assoc($reviews)) {
                echo "<p class='card-text'>" . $row["stars"] . " Star Review: " . $row['text'] . "</p>";
            }
            echo "<div class='d-flex justify-content-between align-items-center'>";
            echo "<div class='btn-group'>";
               echo "</div>";
               echo "<small class='text-muted'> Average Rating: " . $avg . " Stars</small>";
            echo "</div>";
            echo "</div>";
        echo "</div>";
        echo "</div>";
    } 
?>
<?php require 'footer.php' ?>
</body>
</html>