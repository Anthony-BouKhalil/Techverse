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
    $http.get("php/reviews-data.php")
        .then(function (res) {
            $scope.reviews = res.data;
        });
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
