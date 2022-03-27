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
  <title>Sign-In</title>
  <link rel="stylesheet" type="text/css" href="styles/main-page.css">
  <link rel="stylesheet"  type="text/css" href="bootstrap/css/bootstrap.css"></link>
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/css/bootstrap.min.css" rel="stylesheet" >
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" ></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.min.js" integrity="sha384-Atwg2Pkwv9vp0ygtn1JAojH0nYbwNJLPhwyoVbhoPwBhjQPR5VtM2+xf0Uwh9KtT" crossorigin="anonymous"></script>
</head>
<body>
  <?php
    require 'header.php';

    $errEmail=$errPass=$errCredentials = "";  

    if(isset($_POST['submit'])) {
      $email= $_POST['email'];
      $password = $_POST['password'];

      // Check if email has been entered
      if(empty($_POST['email'])) {
        $errEmail = 'Please enter a valid email address';
      }
      // Check if password has been entered
      else if(empty($_POST['password'])) {
        $errPass = 'Please enter your password';
      } 
      else {
        $conn = mysqli_connect('localhost', 'root', '', 'scsstore');
        $controller = new UserController($conn);
        $result = $controller->signIn($email, $password);

        // Check if email and password combination is in the database
        if($result == false) {
          $errCredentials = 'The login credentials you entered are incorrect';
        }
      }
    }
    ?>
    <div class="container">
      <h2>Sign-In</h2>
      <p>Please complete the information below to create an account:</p>
      <form role="form" method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
        <div class="form-group row">
          <label for="inputEmail" class="col-sm-3 col-form-label">Email</label>
          <div class="col-sm-6">
            <?php echo "<font color='red'>".$errCredentials."</font>";?>
            <input type="email" class="form-control" id="inputEmail" name="email" placeholder="Email">
            <?php echo "<font color='red'>".$errEmail."</font>";?>
          </div>
        </div>
        <div class="form-group row">
          <label for="inputPassword" class="col-sm-3 col-form-label">Password</label>
          <div class="col-sm-6">
            <input type="password" class="form-control" id="inputPassword" name="password" placeholder="Password">
            <?php echo "<font color='red'>".$errPass."</font>";?>
          </div>
        </div>
        <div class="form-group row">
          <div class="offset-sm-3 col-sm-6">
            <input type="submit" value="Log In" name="submit" class="btn btn-primary"/>
          </div>
        </div>
      </form>
      <p>Don't have an account? <a href="sign-up.php">Sign-up</a>.</p>
    </div>
    <?php require 'footer.php'; ?>
</body>
</html>
