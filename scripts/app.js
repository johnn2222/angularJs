//'use strict';

// declare modules

angular.module("myApp",["home","signup","ngRoute"])
.config(function($routeProvider){
    $routeProvider
    .when("/",{
                controller:"HomeController",
                templateUrl:"modules/home/views/home.html"
               })
});