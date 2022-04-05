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

  $errReview = "";
  if(isset($_POST['submit'])) {
    // Check if review has been entered
    if(empty($_POST['review'])) {
      $errReview = 'Please enter a review';
    }
    else {
      $product_id = $_POST['product'];
      $rating = $_POST['rating'];
      $review = $_POST['review'];
      $insert_query = "INSERT INTO review (product_id, text, stars) VALUES ('$product_id', '$review', '$rating')";                        
      $insert = mysqli_query($conn, $insert_query);    
    }
  }

?>
  <div class="container">
    <h2>Reviews</h2>
    <p>Please complete the information below to review a product:</p>
    <form role="form" method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
      <div class="form-group row">
      <label for="inputProduct" class="col-sm-3 col-form-label">Select a Product <font color='red'>*</font></label>
        <div class="col-sm-3">
          <?php 
            echo '<select id="inputProduct" class="form-control" name="product">;
                    <option value="1">iPhone 11</option>;
                    <option value="2">AirPods Pro</option>;
                    <option value="3">Samsung Galaxy S22</option>;
                    <option value="4">Beats Studio3 Wireless Headphones</option>;
                    <option value="5">MacBook Air</option>;
                    <option value="6">iPad mini</option>;
                    <option value="7">Nikon Z6 II</option>;
                    <option value="8">Google Pixel 6</option>;
                    <option value="9">Dell XPS 15</option>;                    
                    <option value="10">Amazon Kindle Paperwhite</option>;                    
                    <option value="11">Microsoft Surface Pro 7</option>;                    
                    <option value="12">iPad Pro</option>;
                </select>'
          ?>
        </div>
      </div>
      <div class="form-group row">
      <label for="inputRating" class="col-sm-3 col-form-label">Select a Rating <font color='red'>*</font></label>
        <div class="col-sm-3">
          <?php 
            echo '<select id="inputRating" class="form-control" name="rating">;
                    <option value="1">1</option>;
                    <option value="2">2</option>;
                    <option value="3">3</option>;
                    <option value="4">4</option>;
                    <option value="5">5</option>;
                </select>'
          ?>
        </div>
      </div>
      <div class="form-group row">
      <label for="inputReview" class="col-sm-3 col-form-label">Enter a Review <font color='red'>*</font></label>
        <div class="col-sm-12">
          <?php 
            echo '<textarea id="inputReview" class="form-control" name="review" rows="10"></textarea>';
            echo "<font color='red'>".$errReview."</font>";
          ?>
        </div>
      </div>
      <?php
        if (isset($_SESSION['user'])) {
            echo "<div class='form-group row'>
                  <div class='offset-sm-3 col-sm-6'>
                  <input type='submit' value='Submit' name='submit' class='btn btn-primary'/>
                  </div>
                  </div>";
          }
          else {
                echo "<font color='red'>You must be signed in to checkout</font>";
          }
      ?>
    </form>
</div>
      
<?php 
    $reviews_by_product = array();
    for ($i = 1; $i <= 12; $i++) {
        $total_query = "SELECT COUNT(review.product_id) AS TotalReviews, ROUND(AVG(stars), 1) AS AverageRating, product.name, product.image
                        FROM review
                        JOIN product ON product.product_id = review.product_id
                        WHERE review.product_id = $i";                        
        $total = mysqli_query($conn, $total_query);


        $reviews_query = "SELECT text, stars
                          FROM review 
                          WHERE review.product_id = $i
                          ORDER BY stars DESC";                        
        $reviews = mysqli_query($conn, $reviews_query);

    
        $output = mysqli_fetch_assoc($total);
        
        $reviews_text = array();
        while($row = mysqli_fetch_assoc($reviews)) {
            array_push($reviews_text, $row);
        }

        array_push($reviews_by_product, array($output, $reviews_text));
        
        /*
        echo "<div class='row row-cols-1 row-cols-sm-2 row-cols-md-3 g-3'>";
        echo "<div class='card shadow-sm'>";
            while($row = mysqli_fetch_assoc($total)) {
                $name = $row["name"];
                $address = $row["image"];
                echo "<img width='100%' height='100%' alt='" . $name . "' src='" . $address . "'/>";
                echo "</div>";
                echo "<div class='card-body'>";
                echo "<div class='card-title'>";
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
    */
    } 
    $data = mb_convert_encoding($reviews_by_product,'UTF-8', 'UTF-8');
    echo json_encode($data);
?>
<?php require 'footer.php' ?>
</body>
</html>
