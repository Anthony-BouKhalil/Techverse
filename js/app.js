var app = angular.module('SCSStore', ['ngRoute']);
app.config(function($routeProvider) {
    $routeProvider
        .when('/', {
            templateUrl : 'index.php',
            controller : 'HomeController'})
        .when('/aboutus', {
            templateUrl : 'about-page.php',
            controller : 'AboutusController'})
        .when('/reviews', {
            templateUrl : 'pages/reviews.html',
            controller : 'ReviewsController'})
        .otherwise({redirectTo: '/'});
});

app.controller('HomeController', function($scope, $http) {
    $scope.range = function(min, max, step) {
        step = step || 1;
        var input = [];
        for (var i = min; i <= max; i += step) {
            input.push(i);
        }
        return input;
    };
    //$scope.message = 'Hello from HomeController';
    $http.get("controllers/product-controller.php")
        .then(function (res) {
        $scope.products = res.data;
    });
    $scope.filter = 'none';
}
);
app.controller('AboutusController', function($scope) {
    $scope.message = 'Hello from AboutusController';});
app.controller('ReviewsController', function($scope) {
    $scope.message = 'Hello from ReviewsController';});
