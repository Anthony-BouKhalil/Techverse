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
        .otherwise({redirectTo: '/'});
});

app.controller('HomeController', function($scope, $http) {
    $http.get("controllers/product-controller.php")
        .then(function (res) {
        $scope.products = res.data;
    });
    $scope.filter = '';
}
);
app.controller('ReviewsController', function($scope, $http) {
    $http.get("php/reviews-data.php")
        .then(function (res) {
        $scope.reviews = res.data;
    });
});
