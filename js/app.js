var app = angular.module('SCSStore', ['ngRoute']);
app.config(function($routeProvider) {
    $routeProvider
        .when('/', {
            templateUrl : 'home.php',
            controller : 'HomeController'})
        .when('/aboutus', {
            templateUrl : 'about-page.php',
            controller : 'AboutusController'})
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
    $scope.filter = 'none';
}
);
app.controller('AboutusController', function($scope) {
    $scope.message = 'Hello from AboutusController';});
app.controller('ReviewsController', function($scope, $http) {
    $http.get("php/reviews-data.php")
        .then(function (res) {
        $scope.reviews = res.data;
    });
});
