'use strict';

/* Controllers */
var myApp = angular.module('myApp', []);

//controlador mostrar datos
myApp.factory('ficha',['$http','$q',function($http,$q){
    function all(){
        var deferred = $q.defer();

        $http.get('../controllers/controlador.php?buscarHistorialR=""')
        .success(function(data) {
            deferred.resolve(data);
        });

        return deferred.promise;        
    }

    return  {
        all:all
    };
}]);


myApp.controller('MyController',['$scope','ficha', function($scope,ficha){
    // $scope.data = {};

  $scope.currentPage = 1;
  $scope.pageSize = 50;
  $scope.meals = [];

    ficha.all().then(function(data){
       // console.log('llegada '+data);
       $scope.meals = data;
      $scope.pageChangeHandler = function(num) {
          console.log('meals page changed to ' + num);
      };
        
    });   
    $scope.ordenarPor = function(orden){
         $scope.ordenSeleccionado = orden;       
    } 

    $scope.buscar = function (id) {
        mostrar('../controllers/mostrar.php?id='+id);
    }        
}]);

function OtherController($scope) {
  $scope.pageChangeHandler = function(num) {
    console.log('going to page ' + num);
  };
}