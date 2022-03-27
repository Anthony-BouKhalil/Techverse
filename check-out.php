<?php
/*require 'controllers/order-controller.php';*/
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
    <title>Checkout</title>
    <link rel="stylesheet" type="text/css" href="styles/main-page.css">
    <link rel="stylesheet"  type="text/css" href="bootstrap/css/bootstrap.css"></link>
	  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/css/bootstrap.min.css" rel="stylesheet" >
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" ></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.min.js" integrity="sha384-Atwg2Pkwv9vp0ygtn1JAojH0nYbwNJLPhwyoVbhoPwBhjQPR5VtM2+xf0Uwh9KtT" crossorigin="anonymous"></script>
</head>
<body>
    <?php 
        require 'header.php';

        $errEmail=$errName=$errAddress=$errBranch=$errTime=$errCreditUser=$errCC=$errCVV = "";  
        if(isset($_POST['submit'])) {
          $_SESSION['email']= $_POST['email'];
          $_SESSION['name']= $_POST['user'];
          $_SESSION['date']= $_POST['date'];
          $_SESSION['branch']= $_POST['branch'];
          $_SESSION['creditUser']= $_POST['creditUser'];
          $_SESSION['CC']= $_POST['CC'];
          $_SESSION['expirationDate']= $_POST['expirationDate'];
          $_SESSION['CVV']= $_POST['CVV'];
          if (isset($_POST['time1'])) {
            $_SESSION['time']= $_POST['time1'];            
          }
          else if (isset($_POST['time2'])) {
            $_SESSION['time']= $_POST['time2'];            
          }
          if (isset($_POST['time3'])) {
            $_SESSION['time']= $_POST['time3'];            
          }

          // Check if email has been entered
          if(empty($_POST['email'])) {
            $errEmail = 'Please enter a valid email address';
          }
          // Check if name has been entered
          else if(empty($_POST['user'])) {
            $errName= 'Please enter your user name';
          }
          // Check if branch has been entered
          else if(empty($_POST['branch'])) {
            $errBranch= 'Please pick a branch';
          }
          // Check if time has been entered
          else if(empty($_POST['time1']) && empty($_POST['time2']) && empty($_POST['time3'])) {
            $errTime = 'Please pick a time';
          }
          // Check if name on credit card has been entered
          else if(empty($_POST['creditUser'])) {
            $errCreditUser= 'Please enter your name on your credit card';
          }
          // Check if credit card number has been entered
          else if(empty($_POST['CC'])) {
            $errCC= 'Please enter your credit card number';
          }
          // Check if CVV has been entered
          else if(empty($_POST['CVV'])) {
            $errCVV= 'Please enter your CVV';
          }
          else {
            header("Location: invoice.php");
          }
        }
    ?>
  <div class="container">
    <h2>Checkout</h2>
    <p>Please complete the information below to purchase the item(s):</p>
    <form role="form" method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
      <div class="form-group row">
        <label for="inputUser" class="col-sm-3 col-form-label">Name <font color='red'>*</font></label>
        <div class="col-sm-6">
          <input type="text" class="form-control" id="inputUser" name="user" placeholder="Name">
          <?php echo "<font color='red'>".$errName."</font>";?>
        </div>
      </div>
      <form role="form" method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
      <div class="form-group row">
        <label for="inputEmail" class="col-sm-3 col-form-label">Email <font color='red'>*</font></label>
        <div class="col-sm-6">
          <input type="text" class="form-control" id="inputEmail" name="email" placeholder="Email">         
          <?php echo "<font color='red'>".$errEmail."</font>";?> 
        </div>
      </div>
      <div class="form-group row">
      <label for="inputBranch" class="col-sm-3 col-form-label">Select a Branch <font color='red'>*</font></label>
        <div class="col-sm-6">
          <?php 
            echo '<select id="inputBranch" class="form-control" name="branch">;
                    <option value="43.832950,-79.243210">900 Passmore Ave, Scarborough, ON M1X 0A1, Canada</option>;
                    <option value="40.749643,-73.985337">6 W 35th St, New York, NY 10001, United States</option>;
                    <option value="43.618069,-79.790192">8050 Heritage Rd, Brampton, ON L6Y 0C9, Canada</option>;
                    <option value="42.374380,-83.425500">39000 Amrhein Rd, Livonia, MI 48150, United States</option>;
                    <option value="43.414280,-80.387589">125 Maple Grove Rd, Cambridge, ON N3H 4R7, Canada</option>;
                </select>'
          ?>
          <?php echo "<font color='red'>".$errBranch."</font>";?>
        </div>
      </div>
      <div class="form-group row">
      <label for="inputDate" class="col-sm-3 col-form-label">Select a Date <font color='red'>*</font></label>
        <div class="col-sm-6">
            <?php
                $today = date('Y-m-d');
                $future = date('Y-m-d', mktime(0, 0, 0, date("m")  , date("d")+6, date("Y")));
                echo '<input required="required" type="date" id="inputDate" name="date" value="'.$today.'" min="'.$today.'" max="'.$future.'" >';
            ?>
        </div>
      </div>
      <div class="form-group row">
      <label for="inputTime" class="col-sm-3 col-form-label">Select a Time <font color='red'>*</font></label>
        <div class="col-sm-6">
            <div class="form-check form-check-inline">
              <input class="form-check-input" type="radio" name="time1" id="time1" value="1:00 pm">
              <label class="form-check-label" for="time1">1:00 pm</label>
            </div>
            <div class="form-check form-check-inline">
              <input class="form-check-input" type="radio" name="time2" id="time2" value="3:00 pm">
              <label class="form-check-label" for="time2">3:00 pm</label>
            </div>
            <div class="form-check form-check-inline">
              <input class="form-check-input" type="radio" name="time3" id="time3" value="5:00 pm">
              <label class="form-check-label" for="time3">5:00 pm</label>
            </div>
            <?php echo "<font color='red'>".$errTime."</font>";?>
        </div>
      </div>
      <div class="form-group row">
      <label for="inputCreditName" class="col-sm-3 col-form-label">Name on Credit Card <font color='red'>*</font></label>
        <div class="col-sm-6">
        <input type="text" class="form-control" id="inputCreditUser" name="creditUser" placeholder="Name on Credit Card">
          <?php echo "<font color='red'>".$errCreditUser."</font>";?>
        </div>
      </div>
      <div class="form-group row">
      <label for="inputCreditName" class="col-sm-3 col-form-label">Credit Card Number <font color='red'>*</font></label>
        <div class="col-sm-6">
        <input type="text" class="form-control" id="inputCC" name="CC" placeholder="Credit Card Number">
          <?php echo "<font color='red'>".$errCC."</font>";?>
        </div>
      </div>
      <div class="form-group row">
      <label for="inputCreditName" class="col-sm-3 col-form-label">Expiration Date <font color='red'>*</font></label>
        <div class="col-sm-6">
            <?php
                echo '<input required="required" type="date" id="inputExpirationDate" name="expirationDate" value="'.$today.'">';
            ?>
        </div>
      </div>
      <div class="form-group row">
      <label for="inputCreditName" class="col-sm-3 col-form-label">CVV <font color='red'>*</font></label>
        <div class="col-sm-2">
        <input type="text" class="form-control" id="inputCVV" name="CVV" placeholder="CVV">
          <?php echo "<font color='red'>".$errCVV."</font>";?>
        </div>
      </div>
      
      <div class="form-group row">
        <div class="offset-sm-3 col-sm-6">
          <input type="submit" value="Continue to Checkout" name="submit" class="btn btn-primary"/>
        </div>
      </div>
    </form>
  </div>
  <script src="scripts/getLocation.js"></script>
  <?php require 'footer.php'; ?>
</body>
</html>
