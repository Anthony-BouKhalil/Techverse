<?php
if (!isset($_SESSION)) {
    session_start();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
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

    <link href="features.css" rel="stylesheet">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="styles/shopping-cart.css">
    <link rel="stylesheet" type="text/css" href="styles/main-page.css">
    <link rel="stylesheet"  type="text/css" href="bootstrap/css/bootstrap.css"></link>
	  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/css/bootstrap.min.css" rel="stylesheet" >
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" ></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.min.js" integrity="sha384-Atwg2Pkwv9vp0ygtn1JAojH0nYbwNJLPhwyoVbhoPwBhjQPR5VtM2+xf0Uwh9KtT" crossorigin="anonymous"></script>

    <title>Contact Us</title>
</head>
<body>
    <?php require 'header.php';?>

    <div class="container px-4 py-5" id="featured-3">
    <h2 class="pb-2 border-bottom">Get in Touch!</h2>
    <div class="row g-4 py-5 row-cols-1 row-cols-lg-3">
      <div class="feature col">
        <h2>Anthony</h2>
        <p>Student Email: anthony.boukhalil@ryerson.ca</p>
        <p>Student ID: 500900080</p>
        <p>Role: Backend Software Engineer</p>
        <a href="mailto:anthony.boukhalil@ryerson.ca" target="_blank" class="icon-link">
          Contact Me!
          <svg class="bi" width="1em" height="1em"><use xlink:href="#chevron-right"/></svg>
        </a>
      </div>

      <div class="feature col">
        <h2>Arnold</h2>
        <p>Student Email: agozum@ryerson.ca</p>
        <p>Student ID: 500686416</p>
        <p>Role: Backend Software Engineer</p>
        <a href="mailto:agozum@ryerson.ca" target="_blank" class="icon-link">
          Contact Me!
          <svg class="bi" width="1em" height="1em"><use xlink:href="#chevron-right"/></svg>
        </a>
      </div>

      <div class="feature col">
        <h2>MD</h2>
        <p>Studente Email: m14rahman@ryerson.ca</p>
        <p>Student ID: 500816158</p>
        <p>Role: Frontend Software Engineer</p>
        <a href="mailto:m14rahman@ryerson.ca" target="_blank" class="icon-link">
          Contact Me!
          <svg class="bi" width="1em" height="1em"><use xlink:href="#chevron-right"/></svg>
        </a>
      </div>
    </div>
  </div>

  <script src="../assets/dist/js/bootstrap.bundle.min.js"></script>
  
  <?php require 'footer.php';?>
</body>
</html>