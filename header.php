<!DOCTYPE html>
<body>
    <header class="p-3 bg-dark text-white">
        <div class="header-container">
            <div class="d-flex flex-wrap align-items-center justify-content-center justify-content-lg-start">
                <a href="/" class="d-flex align-items-center mb-2 mb-lg-0 text-white text-decoration-none">
                    <svg class="bi me-2" width="40" height="32" role="img" aria-label="Bootstrap"><use xlink:href="#bootstrap"/></svg>
                </a>

                <ul class="nav col-12 col-lg-auto me-lg-auto mb-2 justify-content-center mb-md-0">
                    <div class="logo-container">
                        <img width="40" height="40" src="images/techverse-logo.png"></img>
                    </div>
                    <li><a href="index.php" class="nav-link px-2 text-white">Home</a></li>
                    <li><a href="about-page.php" class="nav-link px-2 text-white">About Us</a></li>
                    <li><a href="contact-us.php" class="nav-link px-2 text-white">Contact Us</a></li>
                    <li><a href="services.php" class="nav-link px-2 text-white">Types of Services</a></li>
                    <li><a href="reviews.php" class="nav-link px-2 text-white">Reviews</a></li>
                </ul>

                <div class="text-end">
                    <button type='button' class='btn btn-outline-light me-2' data-bs-toggle="modal" data-bs-target="#searchModal">Search</button>
                    <a href='shopping-cart.php'><button type='button' class='btn btn-outline-light me-2'>Shopping Cart</button></a>
                    <?php
                      if (isset($_SESSION['user'])) {
                        echo 
                        "<div class='dropdown'>
                            <button class='btn btn-warning dropdown-toggle' type='button' id='dropdownMenuButton1' data-bs-toggle='dropdown' aria-expanded='false'>"
                            . $_SESSION['user'] .
                            "</button>
                            <ul class='dropdown-menu' aria-labelledby='dropdownMenuButton1'>
                                <li><a class='dropdown-item' href='sign-out.php'>Sign-out</a></li>
                            </ul>
                        </div>";
                      }
                      else {
                        echo "<a href='sign-in.php'><button type='button' class='btn btn-outline-light me-2'>Sign-in</button></a>";
                        echo "<a href='sign-up.php'><button type='button' class='btn btn-warning'>Sign-up</button></a>";
                      }
                    ?>
                </div>
            </div>
        </div>
    </header>
</body>
