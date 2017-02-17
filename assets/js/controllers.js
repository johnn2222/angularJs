myApp.controller("loginController",function($scope,$location,loginService){       
               
    //get login  onclick
    $scope.login=function(){
        var user=$scope.user;
        var pass=$scope.pass;
        var resultObj=loginService.login(user,pass);        
        if(resultObj.result=="success"){
            sessionStorage.setItem("token",resultObj.ACCESS_TOKEN); 
            sessionStorage.setItem("admin",JSON.stringify(resultObj.data));
            sessionStorage.setItem("logged",true);            
            
            $location.path("/dashboard");
        }else if(resultObj.result=="error"){
            $scope.errMsg="invalid Id or Password!";
        }
        
    }
});


myApp.controller("dashboardController",function($scope,$location){
    var admin=sessionStorage.getItem("admin");
        adminObj=JSON.parse(admin);
   $scope.userId=adminObj.USER_ID;
   
   //logout funciton 
    $scope.logout=function(){
       sessionStorage.setItem("logged","");
       $location.path("/");
   }
    //end
    
})