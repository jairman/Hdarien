<!-- vista de registro de produccion kista de ficha tecnica -->
<!DOCTYPE html>
<html lang="es" ng-app="myApp">
<head>
    <meta charset="UTF-8">
    <title>Producción</title>
    <script data-require="angular.js@1.3.0-beta.5" data-semver="1.3.0-beta.5" src="https://code.angularjs.org/1.3.0-beta.5/angular.js"></script>
    <script data-require="jquery@*" data-semver="2.0.3" src="http://code.jquery.com/jquery-2.0.3.min.js"></script>
    <link rel="stylesheet" href="../../css/clean.css">
    <link rel="stylesheet" href="../../css/style.css">
    <link rel="stylesheet" href="../css/css.css">
    <link rel="stylesheet" href="../css/bootstrap.css">
    <link rel="stylesheet" href="../css/bootstrap-theme.css">
    <link href="//netdna.bootstrapcdn.com/font-awesome/4.0.3/css/font-awesome.css" rel="stylesheet">
    
    <script data-require="jquery@*" data-semver="2.0.3" src="http://code.jquery.com/jquery-2.0.3.min.js"></script>
    <link rel="stylesheet" href="//code.jquery.com/ui/1.11.0/themes/smoothness/jquery-ui.css">  
    <script src="http://code.jquery.com/ui/1.11.0/jquery-ui.js"></script>    
    <script data-require="bootstrap@3.1.1" data-semver="3.1.1" src="http://netdna.bootstrapcdn.com/bootstrap/3.1.1/js/bootstrap.min.js"></script>
    <script src="../js/produccion.js"></script>
    <script src="../js/cargarFichas.js"></script>
    <script src="../js/dirPagination.js"></script>    
    <script src="../../js/printThis.js"></script> 
</head>
<body>
<div class="fontaVnetana"></div>
  <div id="dialog">
      <div id="mensaje">        
      </div>
      <br>
      <div class="button">
          <img src="../../img/good.png" alt="" id="si" width="36" height="36" title="Aceptar">
          &nbsp;
          <img src="../../img/erase.png" alt="" id="no" width="36" height="36" title="Cancelar">
      </div>
  </div>
    <div class="modalLoad"></div>
    <section>
        <div id="error">
            <br>
        </div>    
        <table width="90%" align="center" id="table_header">
          <tbody><tr>
            <td width="84%" align="left">
<!--             <div id="menu">
              <ul>
              <li>
                <a href="produccion.php" class="menur active">Lista de Ficha Técnica</a>
              </li>  
              <li>
              <a href="views/ficha.php" class="menur">Crear Ficha técnica</a>
              </li>                      
              </ul>
            </div>   -->
            </td>
            <td width="8%">
             <a href="../views/ficha.php"><img src="../../img/add2.png" alt="" width="48" height="48" border="0" align="right" title="Crear Ficha técnica" id="bt_addp" style="cursor:pointer"></a>    
            </td>            
            <td width="8%" align="left"><input type="image" title="Imprimir" src="../../img/imprimir.png" alt="" width="48" height="48" border="0" align="right" style="cursor:pointer" onclick="imprimir_esto('contenido')"></td>            
          </tr>
        </tbody></table>         
        <div class="contenido" id="contenido" ng-controller="MyController">
            <table width="90%" border="1" cellspacing="0" cellpadding="0">
              <tbody>
              <tr bgcolor="#CCC">    
              </tr><tr bgcolor="#CCC">
                <td class="tittle" colspan="6"style="margin-right:250px; font-size:16px">Lista de Ficha Técnica</td>
              </tr>
              <tr>
                <td colspan="4">    
                    <section class="input-group">
                     <span class="input-group-addon"><i class="glyphicon glyphicon-search"></i></span>
                     <input ng-model="q" id="search" placeholder="Buscar" class="input-search ng-valid">                
                    </section>
                </td>
                <td colspan="4">

                    <div class="input-group">
                     <!-- <span class="input-group-addon"><i class="glyphicon glyphicon-search"></i></span> -->
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
              </tr>
            </tbody></table>
            <table width="90%" border="1" cellspacing="0" cellpadding="0" id="ta">
              <tr class="stittle">
                <td align="center" style="cursor:pointer" title="Ordenar por Código">
                  <span ng-click="ordenarPor('consecutivo')">Consecutivo</span>
                  <span class="fa fa-angle-down" ng-click="ordenarPor('-consecutivo')"></span>                 
                </td>
                <td align="center" style="cursor:pointer" title="Ordenar por Fecha">
                  <span ng-click="ordenarPor('fecha_creacion')">Fecha</span>
                  <span class="fa fa-angle-down" ng-click="ordenarPor('-fecha_creacion')"></span>                    
                  </td>                 
                <td align="center" style="cursor:pointer" title="Ordenar por Nombre">
                  <span ng-click="ordenarPor('nombre')">Nombre</span>
                  <span class="fa fa-angle-down" ng-click="ordenarPor('-nombre')"></span>                    
                </td>                
                <td align="center" style="cursor:pointer" title="Ordenar por Referencia">
                  <span ng-click="ordenarPor('referencia')">Referencia</span>
                  <span class="fa fa-angle-down" ng-click="ordenarPor('-referencia')"></span>                    
                </td>                 
                <td align="center" style="cursor:pointer" title="Ordenar por Tiempo Ciclo">
                  <span ng-click="ordenarPor('tiempo_ciclo')">Tiempo Ciclo (días)</span>
                  <span class="fa fa-angle-down" ng-click="ordenarPor('-tiempo_ciclo')"></span>                    
                  </td>                  
                <td align="center" style="cursor:pointer" title="Ordenar por Costo">
                  <span ng-click="ordenarPor('valor')">Costo</span>
                  <span class="fa fa-angle-down" ng-click="ordenarPor('-valor')"></span>                    
                  </td> 
                  <td></td>                    
                  <td></td>
              </tr>
              <tr dir-paginate="ficha in fichas | filter:q | itemsPerPage: pageSize | orderBy:ordenSeleccionado" current-page="currentPage" class="row-m" id="{{ficha.id}}">
                <td align="center"  ng-click="mostrarFicha(ficha.id)" title="Ver">{{ficha.consecutivo}}</td>
                <td align="center"  ng-click="mostrarFicha(ficha.id)" title="Ver">{{ficha.fecha_creacion}}</td>                                 
                <td align="center"  ng-click="mostrarFicha(ficha.id)" title="Ver">{{ficha.nombre}}</td>
                <td align="center"  ng-click="mostrarFicha(ficha.id)" title="Ver">{{ficha.referencia}}</td>
                <td align="center"  ng-click="mostrarFicha(ficha.id)" title="Ver">{{ficha.tiempo_ciclo}}</td>                
                <td align="center"  ng-click="mostrarFicha(ficha.id)" title="Ver">{{ficha.valor}}</td>
                <td>
                <input type="image" style="cursor: pointer !important;" src="../../img/edit.png" height="25" width="25" alt="" ng-click="modFicha(ficha.id2,ficha.id)" title="Editar">
                <input type="image" style="cursor: pointer !important;" src="../../img/erase.png" height="25" width="25" alt="" ng-click="eliminarFicha(ficha.id2,ficha.id)" title="Eliminar">
                </td>
                <td>
                  <input type="image" style="cursor: pointer !important;" src="../../img/next.png" height="25" width="25" alt="" ng-click="ProgramarFicha(ficha.id,ficha.consecutivo,ficha.nombre)" title="Ordenar Producción">
                </td>
              </tr>              
       </table> 
            <div ng-controller="OtherController" class="other-controller">
              <div class="text-center">
              <dir-pagination-controls boundary-links="true" on-page-change="pageChangeHandler(newPageNumber)" template-url="../views/dirPagination.tpl.html"></dir-pagination-controls>
              </div>
            </div>                                                         
        </div>          
</body>    

    <!-- <<script src="js/produccion.js"></script> -->
    <!--<script data-require="ng-table@*" data-semver="0.3.0" src="http://bazalt-cms.com/assets/ng-table/0.3.0/ng-table.js"></script>-->
</html>