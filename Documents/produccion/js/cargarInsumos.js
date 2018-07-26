'use strict';
/* Controllers */
var myApp = angular.module('myApp', []);



//controlador mostrar datos
myApp.factory('ficha',['$http','$q',function($http,$q){
    function all(){
        var deferred = $q.defer();

        $http.get('../controllers/controlador.php?buscarInsumo=""')
        .success(function(data) {
            deferred.resolve(data);
        });

        return deferred.promise;        
    }

    return  {
        all:all
    };
}]);

myApp.factory('prove',['$http','$q',function($http,$q){
    function all(){
        var deferred = $q.defer();

        $http.get('../controllers/controlador.php?buscarPro=""')
        .success(function(data) {
            deferred.resolve(data);
        });

        return deferred.promise;        
    }

    return  {
        all:all
    };
}]);


myApp.controller('MyController',['$scope','ficha','prove', function($scope,ficha,prove){
    // $scope.data = {};
  $scope.currentPage = 1;
  $scope.pageSize = "";
  $scope.meals = [];
  $scope.procesos = [];

    ficha.all().then(function(data){
     // console.log('llegada '+data);
       $scope.meals = data;
      // $scope.pageChangeHandler = function(num) {
      //    // console.log('meals page changed to ' + num);
      // };
        
    }); 

    prove.all().then(function(data){
       $scope.procesos = data;
      // $scope.pageChangeHandler = function(num) {
      //   //  console.log('meals page changed to ' + num);
      // };
        
    }); 
          
    $scope.ordenarPor = function(orden){
         $scope.ordenSeleccionado = orden;       
    } 

    $scope.agregar = function (id,tipo,codigo,desc,present,unidad,costo) {
       agregarInsumos(id,tipo,codigo,desc,present,unidad,costo);
    }        

    $scope.agregarPro = function (id,codigo,nombre,descripcion) {
       agregarProcesos(id,codigo,nombre,descripcion);
    }    
}]);

function OtherController($scope) {
  $scope.pageChangeHandler = function(num) {
   // console.log('going to page ' + num);
  };
}

//angular.bootstrap(document.getElementById('aplicacion'),['myApp']);