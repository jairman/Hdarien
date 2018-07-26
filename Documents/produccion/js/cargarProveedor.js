'use strict';
/* Controllers */
var myApp = angular.module('myApp', []);

//controlador mostrar datos
myApp.factory('prove',['$http','$q',function($http,$q){
    function all(){
        var deferred = $q.defer();

        $http.get('../controllers/controlador.php?buscarProve=""')
        .success(function(data) {
            deferred.resolve(data);
        });

        return deferred.promise;        
    }

    return  {
        all:all
    };
}]);


myApp.controller('MyControllerProve',['$scope','prove', function($scope,prove){
    // $scope.data = {};
  $scope.currentPage = 1;
  $scope.pageSize = 4;
  $scope.proveedores = [];

    prove.all().then(function(data){

       $scope.proveedores = data;
      $scope.pageChangeHandler = function(num) {
          console.log('meals page changed to ' + num);
      };
        
    });   
    $scope.ordenarPor = function(orden){
         $scope.ordenSeleccionado = orden;       
    } 

    $scope.agregar = function (id,tipo,codigo,desc,present,unidad,costo) {
       agregarInsumos(id,tipo,codigo,desc,present,unidad,costo);
    }        
}]);

function OtherController($scope) {
  $scope.pageChangeHandler = function(num) {
    console.log('going to page ' + num);
  };
}