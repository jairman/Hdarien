<!DOCTYPE html>
<html ng-app="myApp">

<head>
    <script data-require="jquery@*" data-semver="2.0.3" src="http://code.jquery.com/jquery-2.0.3.min.js"></script>
  <link rel="stylesheet" href="../../css/clean.css">
  <link rel="stylesheet" href="../../../css/style.css">
  <link rel="stylesheet" href="../css/css.css">
  <link rel="stylesheet" href="../css/bootstrap.css">
  <link rel="stylesheet" href="../css/bootstrap-theme.css">
  <link href="//netdna.bootstrapcdn.com/font-awesome/4.0.3/css/font-awesome.css" rel="stylesheet">  
  <link rel="stylesheet" href="//code.jquery.com/ui/1.11.0/themes/smoothness/jquery-ui.css">  
  <script data-require="angular.js@1.3.0-beta.5" data-semver="1.3.0-beta.5" src="https://code.angularjs.org/1.3.0-beta.5/angular.js"></script>
  <script data-require="bootstrap@3.1.1" data-semver="3.1.1" src="http://netdna.bootstrapcdn.com/bootstrap/3.1.1/js/bootstrap.min.js"></script>
  <!-- <script src="../views/script.js"></script -->
  <script src="../js/reportes.js"></script>
  <script src="../js/dirPagination.js"></script>
  <script src="../js/calendario.js"></script>
  <script src="../../js/printThis.js" type="text/javascript"></script>   
</head>

<body>
      
        <div ng-controller="MyController" class="my-controller" id="historialEventos">
            <table width="90%" align="center" id="table_header">
              <tbody><tr>
                <td width="84%" align="left">
                <div id="menu">
                  <ul>
                  <li>
                    <a href="reportes.php" class="menur active">Eventos</a>
                  </li>  
                  <li>
                    <a href="repetidos.php" class="menur">Eventos peridodicos</a>
                  </li>                           
                  <li>
                  <img src="../../../img/Logo.png" id="logo" class="logo" alt="" width="200" height="70">
                  </li>
                  </ul>
                </div>
                </td>
                <td width="8%" align="left"><input type="image" title="Imprimir" src="../../img/imprimir.png" alt="" width="48" height="48" border="0" align="right" style="cursor:pointer" onclick="imprimir_esto('historialEventos')"></td>
              </tr>
            </tbody></table>

            <table width="90%" id="Table_Resultadohistorial">             
            <tr class="tittle">
                <td colspan="8">Reporte de Eventos Peridodicos</td>
            </tr>   
                <td colspan="4">

                    <div class="input-group">
                     <span class="input-group-addon"><i class="glyphicon glyphicon-search"></i></span>
                     <input ng-model="q" id="search" placeholder="Buscar" class="input-search ng-valid">                
                    </div>
                </td>
                <td colspan="4">

                    <div class="input-group">
                     <span class="input-group-addon"><i class="glyphicon glyphicon-search"></i></span>
                     <select ng-model="pageSize" class="input-search ng-valid">
                       <option value="50" selected>Número de items</option>
                       <option value="10">10</option>
                       <option value="20">25</option>
                       <option value="50">50</option>
                       <option value="100">100</option>
                       <option value="">Todos</option>
                     </select>
                    <!-- <input type="number" min="1" max="100" ng-model="pageSize" class="input-search ng-valid"> -->
                    </div>
                </td>                                     
            <tr class="stittle">
                  <td>
                      <span ng-click="ordenarPor('fecha_actividad')">Fecha</span>
                      <span class="fa fa-angle-down" ng-click="ordenarPor('-fecha_actividad')"></span>                    
                  </td>
                  <td>
                      <span ng-click="ordenarPor('hora_ini')">Hora Inicio</span>
                      <span class="fa fa-angle-down" ng-click="ordenarPor('-hora_ini')"></span>                   
                  </td>
                  <td>
                      <span ng-click="ordenarPor('hora_fin')">Hora Fin</span>
                      <span class="fa fa-angle-down" ng-click="ordenarPor('-hora_fin')"></span>                                     
                  </td>
                  <td>
                      <span ng-click="ordenarPor('actividad')">Evento</span>
                      <span class="fa fa-angle-down" ng-click="ordenarPor('-activiad')"></span>                                                       
                  </td>
                  <td>
                      <span ng-click="ordenarPor('responsable')">Responsable</span>
                      <span class="fa fa-angle-down" ng-click="ordenarPor('-responsable')"></span>
                  </td>
                  <td>
                      <span ng-click="ordenarPor('lugar')">Lugar</span>
                      <span class="fa fa-angle-down" ng-click="ordenarPor('-lugar')"></span>                  
                  </td>
                  <td>
                      <span ng-click="ordenarPor('punto_venta')">Punto de Venta</span>
                      <span class="fa fa-angle-down" ng-click="ordenarPor('-punto_venta')"></span>
                  </td>                  
                  <td>
                      <span ng-click="ordenarPor('estado')">Estado</span>
                      <span class="fa fa-angle-down" ng-click="ordenarPor('-estado')"></span>                                    
                  </td>
              </tr>               
            </tr>
              <tr dir-paginate="meal in meals | filter:q | itemsPerPage: pageSize | orderBy:ordenSeleccionado" current-page="currentPage" class="row-m">
                <td align="center" data-title="'Fecha'" sortable="'fecha'" ng-click="buscar(meal.id)">{{meal.fecha_actividad}}</td>
                <td align="center" ng-click="buscar(meal.id)">{{meal.hora_ini}}</td>
                <td align="center" ng-click="buscar(meal.id)">{{meal.hora_fin}}</td>
                <td align="center" ng-click="buscar(meal.id)">{{meal.actividad}}</td>
                <td align="center" ng-click="buscar(meal.id)">{{meal.responsable}}</td>
                <td align="center" ng-click="buscar(meal.id)">{{meal.lugar}}</td>
                <td align="center" ng-click="buscar(meal.id)">{{meal.punto_venta}}</td>
                <td align="center" ng-click="buscar(meal.id)" ng-if="meal.estado==0">Pendiente</td>
                <td align="center" ng-click="buscar(meal.id)" ng-if="meal.estado==1">Cumplido</td>
                <td align="center" ng-click="buscar(meal.id)" ng-if="meal.estado==2">Aplazado</td>
              </tr>
            </table>            

        <div ng-controller="OtherController" class="other-controller">
          <div class="text-center">
          <dir-pagination-controls boundary-links="true" on-page-change="pageChangeHandler(newPageNumber)" template-url="../views/dirPagination.tpl.html"></dir-pagination-controls>
          </div>
        </div>
      </div>
    </div>
  </div>
</body>

</html>