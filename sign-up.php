<!DOCTYPE html>
<?php
require 'controllers/user-controller.php';
if (!isset($_SESSION)) {
  session_start();
}
?>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Sign-Up</title>
  <link rel="stylesheet" type="text/css" href="styles/main-page.css">
  <link rel="stylesheet"  type="text/css" href="bootstrap/css/bootstrap.css"></link>
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/css/bootstrap.min.css" rel="stylesheet" >
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" ></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.min.js" integrity="sha384-Atwg2Pkwv9vp0ygtn1JAojH0nYbwNJLPhwyoVbhoPwBhjQPR5VtM2+xf0Uwh9KtT" crossorigin="anonymous"></script>
</head>
<body>
  <?php
    require 'header.php';

    $errEmail=$errName=$errPass=$errPhone=$errAddress=$errCityCode = "";  
    if(isset($_POST['submit'])) {
      $email= $_POST['email'];
      $name= $_POST['user'];
      $password = $_POST['password']; 
      $phone = $_POST['phone']; 
      $address = $_POST['address'];
      $city_code = $_POST['city-code'];

      // Check if email has been entered
      if(empty($_POST['email'])) {
        $errEmail = 'Please enter a valid email address';
      }
      // Check if name has been entered
      else if(empty($_POST['user'])) {
        $errName= 'Please enter your user name';
      }
      // Check if a password has been entered and if it is a valid password
      else if(empty($_POST['password']) || (preg_match("/^.*(?=.{8,})(?=.*[0-9])(?=.*[a-z])(?=.*[A-Z]).*$/", $_POST["password"]) === 0)) {
        $errPass = 'Password must be at least 8 characters and must contain at least one lower case letter, one upper case letter and one digit';
      } 
      // Check if address has been entered 
      else if(empty($_POST['address'])) {
        $errAddress = 'Please enter a valid address';
      } 
      // Check if city code has been entered 
      else if(empty($_POST['city-code'])) {
        $errCityCode = 'Please enter a valid city code';
      } 
      else {
        $conn = mysqli_connect('localhost', 'root', '', 'scsstore');
        $controller = new UserController($conn);
        $duplicate = $controller->duplicate($email);
        if ($duplicate == true) {
          $errEmail = 'Email already exists';
        }
        else {
          $controller->createUser($email, $name, $password, $phone, $address, $city_code);
          $controller->signIn($email, $password);
        }
      }
    }
  ?>
  <div class="container">
    <h2>Sign Up</h2>
    <p>Please complete the information below to create an account:</p>
    <form role="form" method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
      <div class="form-group row">
        <label for="inputEmail" class="col-sm-3 col-form-label">Email <font color='red'>*</font></label>
        <div class="col-sm-6">
          <input type="email" class="form-control" id="inputEmail" name="email" placeholder="Email">
          <?php echo "<font color='red'>".$errEmail."</font>";?>
        </div>
      </div>
      <div class="form-group row">
        <label for="inputUser" class="col-sm-3 col-form-label">User Name <font color='red'>*</font></label>
        <div class="col-sm-6">
          <input type="text" class="form-control" id="inputUser" name="user" placeholder="Username">
          <?php echo "<font color='red'>".$errName."</font>";?>
        </div>
      </div>
      <div class="form-group row">
        <label for="inputPassword" class="col-sm-3 col-form-label">Password <font color='red'>*</font></label>
        <div class="col-sm-6">
          <input type="password" class="form-control" id="inputPassword" name="password" placeholder="Password">
          <?php echo "<font color='red'>".$errPass."</font>";?>
        </div>
      </div>
      <div class="form-group row">
      <label for="inputPhone" class="col-sm-3 col-form-label">Phone Number</label>
        <div class="col-sm-6">
          <input type="text" id="inputPhone" class="form-control" pattern="[0-9]{3}-[0-9]{3}-[0-9]{4}" name="phone" placeholder="416-000-0000">
          <?php echo "<font color='red'>".$errPhone."</font>";?>
        </div>
      </div>
      <div class="form-group row">
      <label for="inputAddress" class="col-sm-3 col-form-label">Address <font color='red'>*</font></label>
        <div class="col-sm-6">
          <input type="text" id="inputAddress" class="form-control" name="address" placeholder="Street Address">
          <?php echo "<font color='red'>".$errAddress."</font>";?>
        </div>
      </div>
      <div class="form-group row">
      <label for="inputCityCode" class="col-sm-3 col-form-label">City Code <font color='red'>*</font></label>
        <div class="col-sm-6">
          <input type="text" id="inputCityCode" class="form-control" name="city-code" placeholder="TO">
          <?php echo "<font color='red'>".$errCityCode."</font>";?>
        </div>
      </div>
      <div class="form-group row">
        <div class="offset-sm-3 col-sm-6">
          <input type="submit" value="Sign Up" name="submit" class="btn btn-primary"/>
        </div>
      </div>
    </form>
    <p>Already have an account? <a href="sign-in.php">Sign-in</a>.</p>
  </div>
  <?php require 'footer.php'; ?>
</body>
</html>
