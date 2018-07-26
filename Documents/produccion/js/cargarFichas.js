'use strict';
/* Controllers */
var myApp = angular.module('myApp', []);

//controlador mostrar datos
myApp.factory('listaFicha',['$http','$q',function($http,$q){
    function all(){
        var deferred = $q.defer();

        $http.get('../controllers/controlador.php?ListaFicha=""')
        .success(function(data) {
            deferred.resolve(data);
        });

        return deferred.promise;        
    }

    return  {
        all:all
    };
}]);


myApp.controller('MyController',['$scope','listaFicha', function($scope,listaFicha){
    // $scope.data = {};
  $scope.currentPage = 1;
  $scope.pageSize = 50;
  $scope.fichas = [];

    listaFicha.all().then(function(data){
      //console.log('fichas '+data)
       $scope.fichas = data;
      $scope.pageChangeHandler = function(num) {
         // console.log('meals page changed to ' + num);
      };
        
    });   
    $scope.ordenarPor = function(orden){
         $scope.ordenSeleccionado = orden;       
    } 

    $scope.agregar = function (id,tipo,codigo,desc,present,unidad,costo) {
       agregarInsumos(id,tipo,codigo,desc,present,unidad,costo);
    }  

    $scope.mostrarFicha = function (id) {
       mostrar('../controllers/mostrarFichaTecnica.php?id='+id);
    }           

    $scope.eliminarFicha = function (id,id2) {
       eliminarF(id,id2);
    }    

    $scope.modFicha = function (id,id2) {
      pmodificarf(id,id2)  ;
    //   mostrar('../controllers/modificarFichaTecnica.php?id='+id);
    }    

    $scope.ProgramarFicha = function (id,ref,nom) {
       OrdenFicha(id,ref,nom);
    }     
}]);

function OtherController($scope) {
  $scope.pageChangeHandler = function(num) {
   // console.log('going to page ' + num);
  };
}