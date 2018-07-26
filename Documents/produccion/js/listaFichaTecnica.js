'use strict';

/* Controllers */
var phonecatApp = angular.module('ListaFicha',['ngTable']);

//controlador mostrar datos
phonecatApp.factory('ficha',['$http','$q',function($http,$q){
    function all(){
        var deferred = $q.defer();

        $http.get('../controllers/controlador.php?ListaPro=""')
        .success(function(data) {
            deferred.resolve(data);
        });

        return deferred.promise;        
    }

    return  {
        all:all
    };
}]);


phonecatApp.controller('DemoCtrl',['$scope','ficha','ngTableParams', function($scope,ficha,ngTableParams){
    // $scope.data = {};

    ficha.all().then(function(data){
        $scope.tableParams = new ngTableParams({
            page: 1,            // show first page
            count: 10           // count per page
        }, {
            total: data.length, // length of data
            getData: function($defer, params) {
                $defer.resolve(data.slice((params.page() - 1) * params.count(), params.page() * params.count()));
            }
        });         
    });   
    $scope.ordenarPor = function(orden){
         $scope.ordenSeleccionado = orden;       
    }     
}]);
       