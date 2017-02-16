var myApp=angular.module('myApp',["ngRoute"]);
myApp.config(function($routeProvider){
    $routeProvider
            .when("/",{   
                   controller:'loginController',
                   templateUrl:'app/src/views/login.html' 
                })
            .when("/dashboard",{
                    controller:'dashboardController',
                    templateUrl:'app/src/views/dashboard.html'
                })
                
                
    
});