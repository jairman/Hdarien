'use strict';
/* Controllers */
var myApp = angular.module('myApp', []);

//controlador mostrar datos
myApp.factory('colores',['$http','$q',function($http,$q){
    function all(){
        var deferred = $q.defer();

        $http.get('../controllers/controlador.php?listarColor')
        .success(function(data) {
            deferred.resolve(data);
        });

        return deferred.promise;        
    }

    return  {
        all:all
    };
}]);


myApp.controller('MyController',['$scope','colores', function($scope,colores){
    // $scope.data = {};
  $scope.currentPage = 1;
  $scope.pageSize = 50;
  $scope.fichaColor = [];

    colores.all().then(function(data){
       $scope.fichaColor = data;
      $scope.pageChangeHandler = function(num) {
        //  console.log('meals page changed to ' + num);
      };
        
    }); 

    $scope.ordenarPor = function(orden){
         $scope.ordenSeleccionado = orden;       
    }     

    $scope.eliminarCol = function (id) {
      console.log('carga colores'+id)
       eliminarColor(id);
    }    
}]);

function OtherController($scope) {
  $scope.pageChangeHandler = function(num) {
   // console.log('going to page ' + num);
  };
}