<?php
if (!isset($_SESSION)) {
    session_start();
}
?>
<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet"  type="text/css" href="bootstrap/css/bootstrap.css"></link>
    <link rel="stylesheet" type="text/css" href="styles/main-page.css">
	  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/css/bootstrap.min.css" rel="stylesheet" >
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" ></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.min.js" integrity="sha384-Atwg2Pkwv9vp0ygtn1JAojH0nYbwNJLPhwyoVbhoPwBhjQPR5VtM2+xf0Uwh9KtT" crossorigin="anonymous"></script>
    
    <title>Types of Services</title>

    <link rel="canonical" href="https://getbootstrap.com/docs/5.1/examples/jumbotron/">
    <link href="../assets/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
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
    </style>
  </head>

<body>
  <?php require 'header.php';?>

  <main>
    <div class="container py-4">
      <div class="p-5 mb-4 bg-light rounded-3">
        <div class="container-fluid py-5">
          <h1 class="display-5 fw-bold">Services we offer!</h1>
          <p class="col-md-8 fs-4">Techverse provides a userfriendly web application for users so that they can purchase products from around the city. We offer the ability to add items to your cart, checkout and your billing information will be shown.</p>
          <p class="col-md-8 fs-4">Our goal is simple. We strive to provide users with a smart customer service web application which aims to plan for smart green trips around the city for online shopping and delivery to a destination.</p>
        </div>
      </div>

      <div class="row align-items-md-stretch">
        <div class="col-md-6">
          <div class="h-100 p-5 text-white bg-dark rounded-3">
            <h2>Why Buy our Products?</h2>
            <p>We offer high-end electronics which you can filter by the type of product. For example, if you are interested in phones, click the filter drop down menu at the top and choose phones. You can also filter by 
              laptops, tablets or accessories.
            </p>
            <p>
              When you are done, click the 'Proceed to Checkout' button on the shopping cart page to complete the transaction and have the item shipped to you as soon as possible!
            </p>
          </div>
        </div>
        <div class="col-md-6">
          <div class="h-100 p-5 bg-light border rounded-3">
            <h2>Billing and Shipping</h2>
            <p>
              Before you get your amazing new product, you need to fill out a few pieces of information first.
              Please provide us with your shipping and payment information at the checkout page. You will then be prompted to the delivery path and your invoice.
              Once the order is accepted, a message will appear stating whether your order was successful or not.
            </p>
            <p>
              When you are on the checkout page, you will need to choose a date and time for your delivery, including a branch in which your item will be shipped from and grant
              location access on your browser so we can get all the correct information from you! Allowing location access on the browser
              will allow the application to create a path from the branch to your address which will be shown via Google Maps.
            </p>
          </div>
        </div>
      </div>

      <?php require 'footer.php';?>
    </div>
  </main>
</body>
</html>