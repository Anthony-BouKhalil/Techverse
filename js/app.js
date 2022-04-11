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
        .otherwise({redirectTo: '/'});
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
app.controller('CartController', function($scope, $http) {
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
});
app.controller('SignInController', function($scope, $http) {
    $scope.submit = function() {
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
                   //$rootScope.user = res.data[0];
                   window.location.href = "index.php";
                   //window.location.reload();/
                }
            });
        }
    }
});
app.controller('SignUpController', function($scope, $http) {
    $scope.submit = function() {
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
                   //$rootScope.user = res.data[0];
                   window.location.href = "index.php";
                   //window.location.reload();/
                }
            });
        }
    }
});
app.controller('SearchController', function($scope, $http) {
    $scope.submit = function() {
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