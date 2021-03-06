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

    <div class="c">
        <div class="show-chat-btn" id="showchat-btn">
            <button class="show-btn" onclick="myFunction()">Toggle Chat</button>
        </div>
        <div id="chat-ui" class="chat-ui-container" style="display:none">
            <div class="render-container">
                <div class="render-output-field">
                    <div class="sale-text" id="render1">
                        <p>
                            Hi, I'm Techy, your personal bot! I will help you learn more about Techverse!  
                        </p>
                        <p>
                            Click one of the options to learn more about Techverse!
                        </p>
                    </div>
                </div>
            </div>

            <div class="a">
                <div class="btn-container">
                    <button class="btn" id="btn1" ng-click="showDiv1 = true">What is Techverse?</button>
                    <button class="btn" id="btn2" ng-click="showDiv2 = true">Our Location</button>
                    <button class="btn" id="btn3" ng-click="showDiv3 = true">Safeguarding Personal Info</button>
                    <button class="btn" id="btn4" ng-click="showDiv4 = true">Shopping Cart</button>
                    <button class="btn" id="btn5" ng-click="showDiv5 = true">Checkout</button>
                    <button class="btn" id="btn6" ng-click="showDiv6 = true">Search Your Order</button>
                    <button class="btn" id="btn7" ng-click="showDiv7 = true">Reviews</button>
                </div>
            </div>
        </div>
    </div>
    
    <script>
        document.getElementById("btn1").onclick = function () {
            document.getElementById("render1").innerHTML = 
            "Techverse is an online e-commerce website that allows you to purchase a wide selection of electronics!\n";
        }
        document.getElementById("btn2").onclick = function () {
            document.getElementById("render1").innerHTML = 
            "We ship our products from different locations in Canada and the U.S. <br>" +
            "We are located in Ontario, New York and Michigan.";
        }
        document.getElementById("btn3").onclick = function () {
            document.getElementById("render1").innerHTML = 
            "All passwords are encrypted and stored securely on our servers.";
        }
        document.getElementById("btn4").onclick = function () {
            document.getElementById("render1").innerHTML = 
            "To buy products, you must first register an account on the Sign-up page. <br>" +
            "After you register, click the 'Add to Cart' button for the product you're interetsed in. <br>" +
            "On the 'Shopping Cart', click the 'Proceed to Checkout' to begin the checkout process.";
        }
        document.getElementById("btn5").onclick = function () {
            document.getElementById("render1").innerHTML = 
            "Enter your shipping and payment details and click 'Continue to Checkout' to complete your purchase. <br>" +
            "After you will be able to review your invoice and click 'Confirm Purchase' to place your order.";
        }
        document.getElementById("btn6").onclick = function () {
            document.getElementById("render1").innerHTML = 
            "To search for your order, click on the 'Search' button in the header & enter your User ID and Order ID in the fields below.";
        }
        document.getElementById("btn7").onclick = function () {
            document.getElementById("render1").innerHTML = 
            "To review products, you must first register an account on the Sign-up page. <br>" +
            "After you register, click the 'Reviews' button in the header to view the reviews page. <br>" +
            "Input your review and click the 'Submit' button add your review.";
        }
        function myFunction(){
            var visible = document.getElementById("chat-ui");

            if (visible.style.display === "none") {
                visible.style.display = "block";
            } else {
                visible.style.display = "none";
            }
        }
    </script>

</body>
</html>
