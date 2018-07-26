'use strict';
/* Controllers */
var myApp = angular.module('myApp', []);

//controlador mostrar datos
myApp.factory('listaFicha',['$http','$q',function($http,$q){
    function all(){
        var deferred = $q.defer();

        $http.get('../controllers/controlador.php?ListaOrdenProduccion')
        .success(function(data) {
            deferred.resolve(data);
        }); 

        return deferred.promise;        
    }

    return  {
        all:all
    };
}]);

myApp.factory('listaProcesos',['$http','$q','$filter',function($http, $q, $filter){
    
    // var normalize = $filter('normalize');

    function all(){
        var deferred = $q.defer();

        $http.get('../controllers/controlador.php?listaProc')
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
      console.log('legada '+data);
       $scope.fichas = data;
      $scope.pageChangeHandler = function(num) {
         // console.log('meals page changed to ' + num);
      };
        
    });   
    $scope.ordenarPor = function(orden){
         $scope.ordenSeleccionado = orden;       
    } 

    // $scope.agregar = function (id,tipo,codigo,desc,present,unidad,costo) {
    //    agregarInsumos(id,tipo,codigo,desc,present,unidad,costo);
    // }  

    $scope.mostrarFicha = function (id) {
       mostrarPro('../controllers/mostrarOrden_produccion.php?id='+id);
    }           

    $scope.modificarProduccion = function (id) {
       //mostrar('../controllers/mostrarFichaTecnica.php?id='+id);
       //console.log(id);
       verificarExistencia(id);
    }

    $scope.eliminar = function (id) {
      //console.log(id);
       preguntaEliminarOrdenProduccion(id);
    }    

    $scope.buscarIntegracion = function (id,consecutivo,integracion,cantidad,cproduccion,fecha,estado) {
      //console.log('cantidad '+cantidad);
      $('.modalLoad').fadeIn();
      $('#contenido').fadeOut();
      $('#OrdenIntegracion').fadeIn();  

      $('#nficha').html(consecutivo);
      $('#ficha').val(consecutivo);

      $('#ordenpr').html(cproduccion);
      $('#ordenP').val(cproduccion);

      $('#cprogramada').html(cantidad);
      $('#cantidadOP').val(cantidad);

      $('#nordenII').html(integracion);
      // $('#ordenII').val(integracion);  
      $('#ordenII').val(integracion);  
      $('#fechaI').html(fecha);
      //console.log('fecga '+fecha);
      buscarInsumosFicha(consecutivo,estado);
      $('.modalLoad').fadeOut();                 
      // mostrar('../views/integracion.php?id='+id+'&nombre='+nombre+'&ref='+consecutivo+'&cantidad='+cantidad+'&ordenproduccion='+cproduccion);
    }    

    $scope.mostrarFichaT = function (id) {
       mostrar('../controllers/mostrarFichaTecnica.php?id='+id);
    }     

    $scope.procesosFicha = function (id, consecutivo, fichaT, nombre, cantidad) {

      $('.modalLoad').fadeIn();
      $('#contenido').fadeOut();
      $('#Procesos').fadeIn(); 

      $('#nroficha').html(fichaT);
      $('#ficha2').val(fichaT);

      $('#nombre').html(nombre);
      $('#nombre').val(nombre);

      $('#cprogramada2').html(cantidad);
      $('#cantidadOP2').val(cantidad);

      $('#').html();
      $('#').val();
      //buscarInsumosFicha(consecutivo);      
      $('.modalLoad').fadeOut();
    }      

    // $scope.ProgramarFicha = function (id,ref,nom) {
    //    OrdenFicha(id,ref,nom);
    // }     
}]);

myApp.controller('listP',['$scope','listaProcesos', function($scope,listaP){

    function fetchData() {
      listaP.all().then(function(procesos){
         //cant = (data.length) + 1;
         $scope.procesos = procesos;
         //console.log(procesos);
      });  
    }

    fetchData();

    // $scope.$on('refresh:procesos', function(){
    //   fetchData();
    // });     
      
}]);


function OtherController($scope) {
  $scope.pageChangeHandler = function(num) {
   // console.log('going to page ' + num);
  };
}