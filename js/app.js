var app = angular.module('SCSStore', ['ngRoute']);
/*app.run(function($rootScope, $http) {
    $http.get("php/current_user.php")
        .then(function (res) {
            $rootScope.user = res.data[0];
       });
});*/
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
    if ($scope.$parent.name) {
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
    if ($scope.$parent.name) {
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

    console.log($scope.$parent.checkout);

    $scope.confirm_purchase = function() {
        console.log("purchase");
        $location.path("/purchase");
    }
});
app.controller('PurchaseController', function($scope, $http) {
    if ($scope.$parent.name) {
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
                    //$rootScope.user = res.data[0];
                    //window.location.href = "index.php";
                    //window.location.reload();/
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
                    $scope.$parent.name = res.data[0];
                    //$rootScope.user = res.data[0];
                    //window.location.href = "index.php";
                    //window.location.reload();/
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
