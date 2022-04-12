var app = angular.module('SCSStore', ['ngRoute']);
app.config(function($routeProvider) {
    $routeProvider
        .when('/', {
            templateUrl : 'home.php',
            controller : 'HomeController'})
        .when('/aboutus', {
            templateUrl : 'about-page.php'})
        .when('/contactus', {
            templateUrl : 'contact-us.php'})
        .when('/services', {
            templateUrl : 'services.php'})
        .when('/reviews', {
            templateUrl : 'reviews.php',
            controller : 'ReviewsController'})
        .when('/shopping-cart', {
            templateUrl: 'shopping-cart.php',
            controller : 'CartController'})
        .when('/sign-in', {
            templateUrl: 'sign-in.php',
            controller : 'SignInController'})
        .when('/sign-up', {
            templateUrl: 'sign-up.php',
            controller : 'SignUpController'})
        .when('/checkout', {
            templateUrl: 'check-out.php',
            controller : 'CheckoutController'})
        .when('/invoice', {
            templateUrl: 'invoice.php',
            controller : 'InvoiceController'})
        .when('/purchase', {
            templateUrl: 'purchase.php',
            controller : 'PurchaseController'})
        .otherwise({redirectTo: '/'});
});

app.controller('ParentController', function($scope, $http) {
    $http.get("php/current_user.php")
        .then(function(res) {
            $scope.name = res.data[0];
        });
});
app.controller('HomeController', function($scope, $http) {
    $http.get("php/products-data.php")
        .then(function (res) {
            $scope.products = res.data;
        });
    $scope.filter = '';
    $scope.addToCart = function(product_id) {
        var data = {"product_id": product_id};
        var request = $http({
            method: "post",
            url: "php/cart.php?action=add",
            data: data
        }).then(function (res) {
            alert("The item has been added to your cart.");
        });
    }
}
);
app.controller('ReviewsController', function($scope, $http) {
    $http.get("php/reviews-data.php?action=list")
        .then(function (res) {
            $scope.products = res.data;
        });
    $scope.submit = function() {
        if ($scope.review) {
            var request = $http({
                method: "post",
                url: "php/reviews-data.php?action=insert",
                data: $scope.review
            });
            delete $scope.review;
            $http.get("php/reviews-data.php?action=list")
                .then(function (res) {
                    $scope.products = res.data;
                });
        }
    }
});
app.controller('CartController', function($scope, $http, $location) {
    $scope.cart = [];
    $http.get("php/cart.php?action=list")
        .then(function (res) {
            $scope.cart = res.data;
        });
    $scope.delete = function(product_id) {
        var data = {"product_id": product_id};
        $http({
            method: "post",
            url: "php/cart.php?action=delete",
            data: data
        });
        $scope.cart.splice($scope.cart.findIndex(product => product.product_id === product_id), 1);
    }
    $scope.checkout = function() {
        $location.path("/checkout");
    }
});
app.controller('CheckoutController', function($scope, $http, $location, $filter) {
    if (!$scope.$parent.name) {
        $location.path("/");
    }
    $scope.get_invoice = function() {
        var newdate = new Date($scope.checkout.date);
        $scope.checkout.date = $filter('date')(newdate, "yyyy-MM-dd");
        $scope.$parent.checkout = $scope.checkout;
        $location.path("/invoice");
    }
});
app.controller('InvoiceController', function($scope, $http, $location) {
    if (!$scope.$parent.name) {
        $location.path("/");
    }
    $http.get("php/cart.php?action=list")
        .then(function (res) {
            $scope.cart = res.data;
            $scope.total_price = 0;
            for (let i = 0; i < $scope.cart.length; i++) {
                $scope.total_price += +$scope.cart[i].unit_price;
            }
            $scope.$parent.checkout.total_price = $scope.total_price;
        });

    $scope.latitude = function() {
        return parseFloat(parseFloat($scope.$parent.checkout.branch.split(',')[0]).toFixed(6));
    }

    $scope.longitude = function() {
        return parseFloat(parseFloat($scope.$parent.checkout.branch.split(',')[1]).toFixed(6));
    }

    $scope.loadScript = function() {
        var script = document.createElement('script');
        script.type = 'text/javascript';
        script.src = 'https://maps.googleapis.com/maps/api/js?key=AIzaSyC2mAYmeS6wL_5Tvn86c3Ij2xPQtHb5CaY';//&callback=initMap';
        document.body.appendChild(script);
        setTimeout(function() {
            $scope.initMap();
        }, 500);
    }

    $scope.haversine_distance = function(mk1, mk2) {
        var R = 3958.8; // Radius of the Earth in miles
        var rlat1 = mk1.position.lat() * (Math.PI/180); // Convert degrees to radians
        var rlat2 = mk2.position.lat() * (Math.PI/180); // Convert degrees to radians
        var difflat = rlat2-rlat1; // Radian difference (latitudes)
        var difflon = (mk2.position.lng()-mk1.position.lng()) * (Math.PI/180); // Radian difference (longitudes)

        var d = 2 * R * Math.asin(Math.sqrt(Math.sin(difflat/2) * Math.sin(difflat/2) + Math.cos(rlat1) * Math.cos(rlat2) * Math.sin(difflon/2) * Math.sin(difflon/2)));
        return d;
    }
    $scope.initMap = function() {
        let map, infoWindow;
        map = new google.maps.Map(document.getElementById("map"), {
            // once initialized, map centers around 'center'
            center: { lat: 40.774102, lng: -73.971734 },
            zoom: 11,
        });

        infoWindow = new google.maps.InfoWindow();
        const locationButton = document.createElement("button");

        locationButton.textContent = "Calculate Location";
        locationButton.classList.add("custom-map-control-button");
        map.controls[google.maps.ControlPosition.TOP_CENTER].push(locationButton);

        // the following only gets executed if the user hits "Calculate Location"
        locationButton.addEventListener("click", () => {
            if (navigator.geolocation) {
                navigator.geolocation.getCurrentPosition((position) => {
                    const userPosition = {
                        lat: position.coords.latitude,
                        lng: position.coords.longitude,
                    };
                    
                    infoWindow.setPosition(userPosition);
                    infoWindow.setContent("You are here!"); // current user location pointer (points to EXACT locaiton)
                    infoWindow.open(map);
                    map.setCenter(userPosition);
                    
                    const location = {lat: $scope.latitude(), lng: $scope.longitude()};

                    var position1 = new google.maps.Marker({position: userPosition, map: map});
                    var position2 = new google.maps.Marker({position: location, map: map});
                    var line = new google.maps.Polyline({path: [userPosition, location], map: map});

                    var distance = $scope.haversine_distance(posititon1, posititon2);

                    // calculates the distance between the points in miles
                    document.getElementById('msg').innerHTML = "Distance between location: " + distance.toFixed(2) + " mi.";

                }, () => {
                    handleLocationError(true, infoWindow, map.getCenter());
                }
            );
            } else {
                // User did not accept permission on browser
                handleLocationError(false, infoWindow, map.getCenter());
            }
        });
    }


    $scope.confirm_purchase = function() {
        console.log("purchase");
        $location.path("/purchase");
    }
});

app.controller('PurchaseController', function($scope, $http, $location) {
    if (!$scope.$parent.name) {
        $location.path("/");
    }
    $http({
        method: "post",
        url: "php/purchase-submit.php",
        data: {'checkout_data' : $scope.$parent.checkout }
    }).then(function(res) {
        $scope.order_id = res.data.order_id;
        $scope.user_id = res.data.user_id;
    });
});
app.controller('SignInController', function($scope, $http, $location) {
    if ($scope.$parent.name) {
        $location.path("/");
    }
    $scope.submit_signin = function() {
        if ($scope.user) {
            var request = $http({
                method: "post",
                url: "php/sign-in-submit.php",
                data: $scope.user
            }).then(function (res) {
                if (res.data[0] === false) {
                    $scope.errCredentials = "The login credentials you entered are incorrect";
                }
                else {
                    $scope.$parent.name = res.data[0];
                    $location.path("/");
                }
            });
        }
    }
});
app.controller('SignUpController', function($scope, $http, $location) {
    if ($scope.$parent.name) {
        $location.path("/");
    }
    $scope.submit_signup = function() {
        if ($scope.user) {
            var request = $http({
                method: "post",
                url: "php/sign-up-submit.php",
                data: $scope.user
            }).then(function (res) {
                console.log(res.data);
                if (res.data["success"] === false) {
                    $scope.errEmail = res.data["errEmail"];
                    $scope.errPass = res.data["errPass"];
                }
                else {
                    $scope.$parent.name = res.data["name"];
                    $location.path("/");
                }
            });
        }
    }
});
app.controller('SearchController', function($scope, $http) {
    $scope.submit_search = function() {
        var request = $http({
            method: "post",
            url: "php/search-data.php",
            data: $scope.order
        }).then(function (res) {
            console.log(res.data);
            $scope.result = res.data;
            
            var myModal = new bootstrap.Modal(document.getElementById('searchResultModal'));
            myModal.show();
        });
    }
});
app.controller('HeaderController', function($scope, $http, $location) {
    $scope.signout = function() {
        $http({
            method: "post",
            url: "sign-out.php"
        });
        $scope.$parent.name = "";
        delete $scope.$parent.checkout;
        $location.path("/");
    }
});
