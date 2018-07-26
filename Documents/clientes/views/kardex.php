<?php require_once('../controllers/joom.php'); ?>
<?php require_once('../../Connections/conexion.php');
if ($acceso =='0'){
	?>
<!DOCTYPE html>
<html ng-app="myApp">

<head>
	 <script data-require="angular.js@1.3.0-beta.5" data-semver="1.3.0-beta.5" 
     src="https://code.angularjs.org/1.3.0-beta.5/angular.js"></script>
    
    <script data-require="jquery@*" data-semver="2.0.3" src="http://code.jquery.com/jquery-2.0.3.min.js"></script>
    <script src="http://code.jquery.com/ui/1.11.0/jquery-ui.js"></script>
    
    <link rel="stylesheet" href="../../css/clean.css">
    <link rel="stylesheet" href="../../../css/style.css">
    <!--paginacion--> 
    <link rel="stylesheet" href="../css/css.css">
    <link rel="stylesheet" href="../../css/bootstrap.css">
    <link rel="stylesheet" href="../css/bootstrap-theme.css">
    <!--pag-->  
    <link href="//netdna.bootstrapcdn.com/font-awesome/4.0.3/css/font-awesome.css" rel="stylesheet">  
    <link rel="stylesheet" href="//code.jquery.com/ui/1.11.0/themes/smoothness/jquery-ui.css"> 
    
    <!--paginacion-->   
    <script data-require="angular.js@1.3.0-beta.5" data-semver="1.3.0-beta.5" src="https://code.angularjs.org/1.3.0-beta.5/angular.js"></script>
    <script data-require="bootstrap@3.1.1" data-semver="3.1.1" src="http://netdna.bootstrapcdn.com/bootstrap/3.1.1/js/bootstrap.min.js"></script>
    <!-- <script src="../views/script.js"></script -->
    <script src="../js/kardex_reportes.js"></script>
    <script src="../js/kardex.js"></script>
    <script src="../js/dirPagination.js"></script>
    <!--pag--> 
    <script src="../../js/printThis.js" type="text/javascript"></script>   
</head>
<body>
<div id="dialog2"></div> 
     
        <div ng-controller="MyController" class="my-controller">
          <table width="98%" align="center">
            <tr>
              <td align="right"><p class="s">&nbsp;</p></td>
              <td width="6%" align="center"><img src="../../img/addpersonas.png" alt="" width="48" height="48" style="cursor:pointer" title="Agregar Nuevo"  onclick="agregar()"  /></td>
              <td width="4%" align="center"><img src="../../img/Excell_Up.png" alt="" width="40" height="40" style="cursor:pointer" title="Agregar Excel"  onclick="agregar_excel()"  /></td>
              <td width="6%" align="center"><img  title="Imprimir" src="../../img/imprimir.png" alt="" 
    width="40" height="40" border="0"  style="cursor:pointer" onclick="imprimir_esto('registros')"/></td>
            </tr>
          </table>
          
 <div id="registros">         
          <table width="90%" id="Table_Resultadohistorial">             
            <tr class="tittle">
                <td colspan="8">Listado De Clientes</td>
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
      <td width="7%" align="center"><span ng-click="ordenarPor('cedula')">NIT</span>
         			  <span class="fa fa-angle-down" ng-click="ordenarPor('-cedula')"></span></td>
      <td width="20%" align="center"><span ng-click="ordenarPor('nombre')">Nombre</span>
                      <span class="fa fa-angle-down" ng-click="ordenarPor('-nombre')"></span></td>
      <td width="6%" align="center"><span ng-click="ordenarPor('telefono')">Teléfono</span>
                      <span class="fa fa-angle-down" ng-click="ordenarPor('-telefono')"></span></td>
      <td width="9%" align="center"><span ng-click="ordenarPor('cumple')">Cumpleaños</span>
      				  <span class="fa fa-angle-down" ng-click="ordenarPor('-cumple')"></span></td>
      <td width="7%" align="center"><span ng-click="ordenarPor('ciudad')">Ciudad</span>
      				  <span class="fa fa-angle-down" ng-click="ordenarPor('-ciudad')"></span></td>
      <td width="35%" align="center"><span ng-click="ordenarPor('mail')">Email</span>
      				  <span class="fa fa-angle-down" ng-click="ordenarPor('-mail')"></span></td>
      <td width="6%" align="center">&nbsp;</td>                  
      
               
</tr>
              <tr dir-paginate="meal in meals | filter:q | itemsPerPage: pageSize | orderBy:ordenSeleccionado" current-page="currentPage" class="row-m">
               	  <td align="center" ng-click="buscar(meal.id)">{{meal.cedula}}</td>
                  <td align="center" ng-click="buscar(meal.id)">{{meal.nombre}}</td>
                  <td align="center" ng-click="buscar(meal.id)">{{meal.telefono}}</td>
                <td align="center" ng-click="buscar(meal.id)">{{meal.cumple}}</td>
                  <td align="center" ng-click="buscar(meal.id)">{{meal.ciudad}}</td>
                <td align="center" ng-click="buscar(meal.id)">{{meal.mail}}</td>
                <td align="center" ><input name="imgb2" type="image" src="../../img/edit.png" width="20" height="20"  style="cursor:pointer"
         title="Editar" ng-click="buscarEdit(meal.id)">
                <input name="imgb" type="image" src="../../img/erase.png" width="20" height="20"  style="cursor:pointer"
          title="Eliminar" ng-click="buscarElim(meal.id)"></td>
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
  </div>
</body>

</html>
  
<?php }else{ ?>


<table width="70%" border="0" align="center">
  <tr>
    <td><img src="../../../img/Logo.png" width="886" height="248" /></td>
  </tr>
  <tr>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <th>No puede acceder A este MENU sin estar HABILITADO... Consulte al Administrador....!!!</th>
  </tr>
</table>

<?php } ?>