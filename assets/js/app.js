var myApp=angular.module('myApp',["ngRoute"]);
myApp.config(function($routeProvider){
    $routeProvider
            .when("/",{
                resolve:{
                        "check":function($location){
                          var logged=sessionStorage.getItem('logged'); 
                          if(logged=="true"){
                              $location.path("/dashboard");
                          }
                        }
                    },
                   controller:'loginController',
                   templateUrl:'app/src/views/login.html' 
                })
            .when("/dashboard",{
                    resolve:{
                        'check':function($location){
                          var logged=sessionStorage.getItem('logged'); 
                          if(!logged){
                              $location.path("/");
                          }
                        }
                    },
                    controller:'dashboardController',
                    templateUrl:'app/src/views/dashboard.html'
                })
                
                
    
});