<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Angular Tutorial 1.4.8</title>
          <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
  
       <script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.4.8/angular.min.js"></script>
       <script src="//ajax.googleapis.com/ajax/libs/angularjs/1.4.8/angular-route.js"></script>
       <style>
           header{background:#ccc;padding-bottom: 30px;width:100%;float:left;}
       </style>
    </head>
    <body ng-app="myApp" >       
        
               
            <div class="container"> 
                <div ng-controller="itemsView"> 
                <div class="row">
                    <header>
                        <div class="col-lg-12">
                            <div class="col-lg-4">
                                <h2>Learning AngularJs</h2>
                            </div>
                        </div>
                    </header>
                    
                </div>
              
                <div class="row">
                    <div class="col-lg-12">
                        
                        <div class="col-lg-3" ng-repeat="i in items">
                            <h3>{{i.name}}</h3>
                            <p>{{i.desc}}</p>
                            <p>{{"MRP: "+i.mrp}}</p>
                            <p>{{"Price: "+i.price}}</p>
                            Qty: <input id="qty" type="number" ng-model="qtyModel" min="1" name="qty">  
                            <span></span>
                            <a ng-click="saveCart(i,qtyModel);" class="btn btn-default">Add To cart</a>
                        </div>
                        
                        <hr>
                        <div class="row">
                            <div class="col-sm-6">
                                <h3>Your Cart</h3>
                                <table border="0" width="100%">
                                    <thead>
                                        <tr>
                                            <th>Name</th>  
                                            <th>Desc.</th>  
                                            <th>Price</th>  
                                            <th>Qty</th>  
                                            <th>Total</th>  
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr ng-repeat="d in data">
                                            <td>{{d.name |uppercase}}</td>
                                            <td>{{d.desc}}</td>
                                            <td>{{d.price}}</td>
                                            <td>{{d.qty}}</td>
                                            <td>{{d.price*d.qty}}</td>                                            
                                        </tr>
                                        <tr>
                                            <td colspan="4"><strong>Total:</strong></td>
                                            <td><strong>{{grandTotal}}</strong></td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        
                    </div>
                </div>
            </div>
            
            
             
            
        <div ng-controller="allProduct">
            <div class="row">            
            <div class="col-lg-12">
                <a href="#my">Get Content from my page</a>
                <h3>Use Filter in search and also use orderby </h3>
                <ng-view></ng-view>
                <input type="text" ng-model="search" placeholder="search...">                 <table border="0" width="100%">
                                    <thead>
                                        <tr>
                                            <th>Id</th>
                                            <th ng-click="orderByMe('name');">Name</th>  
                                            <th>Desc.</th>  
                                            <th ng-click="orderByMe('mrp');">Mrp</th>                                                                                        
                                            <th>Price</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr ng-repeat="d in items | filter:search | orderBy : myOrder">
                                            <td>{{d.id}}</td>
                                            <td>{{d.name}}</td>
                                            <td>{{d.desc}}</td>
                                            <td>{{d.mrp}}</td>
                                            <td>{{d.price}}</td>                                            
                                        </tr>                                        
                                    </tbody>
                                </table>
                
                <h3>Get data from file using http service </h3>
                <ul>
                    <li ng-repeat="i in cont">
                 {{i.name+' , '+i.age}}       
                    </li>
                </ul>
                
                
                <h3>Create Dropdown list</h3>
                <select ng-model="myDropDown" ng-options="x for (x,y) in list"></select>
                
               
                
            </div>
            </div>
        </div>
   </div>
     
        <script>
            angular.module("myApp",["ngRoute"])       
            .controller("itemsView",function($scope){
                  
          $scope.data=[];  
                if(sessionStorage.getItem("cart")!=undefined){
                   // console.log("hello");
                     $scope.saved=sessionStorage.getItem("cart");
                    $scope.data=JSON.parse($scope.saved); 
                 }
              
                  $scope.items=[
                   {'id':'1','name':'t-shirt black', 'desc':'cotton half sleves t-shirt','mrp':'500','price':'350'},
                   {'id':'2','name':'t-shirt red', 'desc':'levies red half sleves t-shirt','mrp':'1500','price':'1200'},
                   {'id':'3','name':'Jeans (Black)', 'desc':'levies new pattern black jeans','mrp':'3500','price':'2500'},
                   {'id':'4','name':'wallet (Black)', 'desc':'levies black pure leather wallet','mrp':'1200','price':'1000'}
                    ];                                     
                   $scope.qtyModel=1; 
                 
           $scope.saveCart = function(n,qty){
               var found=false;
               $scope.data.forEach(function(prd){
                   if(prd.id==n.id)
                   {
                       prd.qty=qty;
                      found=true;
                   }
               });
               if(!found){
                   $scope.data[$scope.data.length]={'id':n.id,'name':n.name,'desc':n.desc,'price':n.price,'mrp':n.mrp,'qty':qty};                                      
                 }
                   sessionStorage.setItem("cart",JSON.stringify($scope.data));                  
                   //get saved data
                   
                   //get total
                   var grand=0;
                    $scope.data.forEach(function(prd){                        
                     grand+=prd.price*prd.qty;                    
                    });
                    $scope.grandTotal=grand;
                  }
                
                
                    
                         
                  
                
            })
            //other controller
            .controller("allProduct",function($scope,$http){
                    $scope.items=[
                   {'id':'1','name':'t-shirt black', 'desc':'cotton half sleves t-shirt','mrp':'500','price':'350'},
                   {'id':'2','name':'t-shirt red', 'desc':'levies red half sleves t-shirt','mrp':'1500','price':'1200'},
                   {'id':'3','name':'Jeans (Black)', 'desc':'levies new pattern black jeans','mrp':'3500','price':'2500'},
                   {'id':'4','name':'wallet (Black)', 'desc':'levies black pure leather wallet','mrp':'1200','price':'1000'}
                    ]; 
                    $scope.orderByMe=function(x){
                    $scope.myOrder=x;
                }
                  
                  $http.get("myfile.json").then(function(res){
                      $scope.cont=res.data.data;
                  });
                  
                  $scope.list=["java","javascript","php","html","css"];
                             
                             
                })
                  .config(function($routeProvider){     
                
                $routeProvider
                        .when("/my",{
                    templateUrl:"mypage.php"
                    })
                
                });
                
                
                
             
            
                
                
           
        </script>
       
    </body>
</html>
