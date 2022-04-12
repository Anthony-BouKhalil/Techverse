<!DOCTYPE html>
    <header ng-controller="HeaderController" class="p-3 bg-dark text-white">
        <div class="header-container">
            <div class="d-flex flex-wrap align-items-center justify-content-center justify-content-lg-start">
                <a href="/" class="d-flex align-items-center mb-2 mb-lg-0 text-white text-decoration-none">
                    <svg class="bi me-2" width="40" height="32" role="img" aria-label="Bootstrap"><use xlink:href="#bootstrap"/></svg>
                </a>

                <ul class="nav col-12 col-lg-auto me-lg-auto mb-2 justify-content-center mb-md-0">
                    <div class="logo-container">
                        <img width="40" height="40" src="images/techverse-logo.png"></img>
                    </div>
                    <li><a href="#!" class="nav-link px-2 text-white">Home</a></li>
                    <li><a href="#!aboutus" class="nav-link px-2 text-white">About Us</a></li>
                    <li><a href="#!contactus" class="nav-link px-2 text-white">Contact Us</a></li>
                    <li><a href="#!services" class="nav-link px-2 text-white">Types of Services</a></li>
                    <li><a href="#!reviews" class="nav-link px-2 text-white">Reviews</a></li>
                </ul>

                <div class="text-end">
                    <button type='button' class='btn btn-outline-light me-2' data-bs-toggle="modal" data-bs-target="#searchModal">Search</button>
                    <a href='#!shopping-cart'><button type='button' class='btn btn-outline-light me-2'>Shopping Cart</button></a>
                    <div ng-if="$parent.name" class='dropdown'>
                        <button class='btn btn-warning dropdown-toggle' type='button' id='dropdownMenuButton1' data-bs-toggle='dropdown' aria-expanded='false'>
                        {{$parent.name}}
                        </button>
                        <ul class='dropdown-menu' aria-labelledby='dropdownMenuButton1'>
                            <li><button class='dropdown-item' ng-click="signout()">Sign-out</a></li>
                        </ul>  
                    </div>
                    <div ng-if="$parent.name === 'Admin'">
                        <a href='http://localhost/phpmyadmin/index.php?route=/database/structure&server=1&db=scsstore' target='_blank'>
                            <button type='button' class='btn btn-primary' style='float:right;'>
                                db Maintain
                            </button>
                        </a> 
                    </div>
                                <a ng-if="!name" href='#!sign-in'><button type='button' class='btn btn-outline-light me-2'>Sign-in</button></a>
                    <a ng-if="!name" href='#!sign-up'><button type='button' class='btn btn-warning'>Sign-up</button></a>
                </div>
            </div>
        </div>
    </header>
