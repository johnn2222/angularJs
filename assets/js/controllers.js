myApp.controller("loginController",function($scope,$location,loginService){       
        var user=$scope.user;
        var pass=$scope.pass;       
    //get login  onclick
    $scope.login=function(){            
        if($scope.user=="" || $scope.user=="undefined"){
            $scope.errMsg="Plese enter user Id";
            return false;
        }
        if($scope.pass=="" || $scope.pass=="undefined"){
            $scope.errMsg="Plese enter Password";
            return false;
        }
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


myApp.controller("dashboardController",function($scope){
    var admin=sessionStorage.getItem("admin");
        adminObj=JSON.parse(admin);
   $scope.userId=adminObj.USER_ID;
    
})