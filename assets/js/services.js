myApp.service("loginService",function(){
      var service={};      
      
      service.login=function(user,pass){        
        var result={};
        var param={};      
            param.user=user;
            param.pass=pass;
        var data={};
            data.publicKey="easy123";
            data.service="EasyWay";
            data.action="login"; 
            data.accessToken="";
            data.parameter=param;
            var  str=JSON.stringify(data);
        $.ajax({
            type:'post',
            url:'http://localhost/easyWayService/api/v1/',
            async:false,
            dataType:"json",
            data:'data='+str,
            success:function(res){
              result=res;
            }
            
         })
        return result; 
      }
     
     return service;
})
