<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Footer</title>
</head>
<body>
    <br/>
    <footer class="container">
        <p class="float-end"><a href="#">Back to top</a></p>
        <p>&copy; 2022 Techverse, Inc. &middot; <a href="#">Privacy</a> &middot; <a href="#">Terms</a></p>
    </footer>
</body>
</html>
<div class="modal fade" id="searchModal" tabindex="-1" role="dialog" aria-labelledby="searchModalLabel" aria-hidden="true" data-bs-backdrop="false">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle">Search for order status</h5>
        <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form role="form" method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
          <div class="form-group row">
            <label for="inputUserId" class="col-sm-3 col-form-label">User ID</label>
            <div class="col-sm-6">
              <input type="text" class="form-control" id="inputUserId" name="user_id" placeholder="User ID" required="true">
            </div>
          </div>
          <div class="form-group row">
            <label for="inputOrderId" class="col-sm-3 col-form-label">Order ID</label>
            <div class="col-sm-6">
              <input type="text" class="form-control" id="inputOrderId" name="order_id" placeholder="Order ID" required="true">
            </div>
          </div>
          <div class="form-group row">
            <div class="offset-sm-3 col-sm-6">
              <input type="submit" value="Search" name="submitsearch" class="btn btn-primary" />
            </div>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>
<?php
$result_title = "Order not found";
$result_body = "An order with that id and user id could not be found.";
if (isset($_POST['submitsearch'])) {
    require_once 'controllers/order-controller.php';
    $user_id = $_POST['user_id'];
    $order_id = $_POST['order_id']; 
    $conn = mysqli_connect('localhost', 'root', '', 'scsstore');
    $controller = new OrderController($conn);
    $result = $controller->search($user_id, $order_id);
    $row = mysqli_fetch_assoc($result);
    if ($row != null) {
        $result_title = "Order #" . $row['order_id'] . " status";
        $result_body = "<p>Order made on: " . $row['date_issued'] .
            "<br>Scheduled for: " . $row['order_date'] . "</p>" .
            "<h6>Products:</h6>";
        $products = $controller->getProducts($order_id);
        while($product_row = mysqli_fetch_assoc($products)) {
            $result_body .= $product_row['name'] . "<br>";
        }
        $result_body .= "<br>Amount paid: $" . $row['total_price'];
    }
}
?>
<div class="modal fade" id="searchResultModal" tabindex="-1" role="dialog" aria-labelledby="searchResultModalLabel" aria-hidden="true" data-bs-backdrop="false">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
      <h5 class="modal-title" id="exampleModalLongTitle"><?php echo $result_title ?></h5>
        <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <?php echo $result_body ?>
      </div>
    </div>
  </div>
</div>
<?php
if (isset($_POST['submitsearch'])) {
    echo "<script> 
        if ( window.history.replaceState ) {
            window.history.replaceState( null, null, window.location.href );
        }
        var myModal = new bootstrap.Modal(document.getElementById('searchResultModal'))
        myModal.show()
    </script>";
}
?>
