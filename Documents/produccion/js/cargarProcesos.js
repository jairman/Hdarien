'use strict';
/* Controllers */
var myApp = angular.module('myApp', []);

//controlador mostrar datos
myApp.factory('listaProcesos',['$http','$q',function($http,$q){
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


myApp.controller('MyController',['$scope','listaProcesos', function($scope,listaProcesos){
    // $scope.data = {};
  $scope.currentPage = 1;
  $scope.pageSize = 50;
  $scope.procesos = [];

    listaProcesos.all().then(function(data){
      //console.log('procesos '+data)
       $scope.procesos = data;
      $scope.pageChangeHandler = function(num) {
         // console.log('meals page changed to ' + num);
      };
        
    });   
    $scope.ordenarPor = function(orden){
         $scope.ordenSeleccionado = orden;       
    } 

    $scope.mostrarP = function (id) {
       mostrar('../controllers/mostrarProcesos.php?id='+id);
    }        
    $scope.editarP = function (id) {
       editarPr('../controllers/editarProcesos.php?id='+id);
    }     
    $scope.eliminarP = function (id) {
       eliminarProceso(id);
    }      
}]);

function OtherController($scope) {
  $scope.pageChangeHandler = function(num) {
   // console.log('going to page ' + num);
  };
}