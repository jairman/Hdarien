<?php
date_default_timezone_set('America/Bogota');

$c_date = date('Y-m-d');
?>
<!-- vista de registro de produccion -->
<!DOCTYPE html>
<html lang="es" ng-app="myApp">
<head>
    <meta charset="UTF-8">
    <title>Producción</title>
<!--     <script src="//code.jquery.com/ui/1.11.0/jquery-ui.js"></script> -->
    <script data-require="jquery@*" data-semver="2.0.3" src="http://code.jquery.com/jquery-2.0.3.min.js"></script>
    <link rel="stylesheet" href="../../css/clean.css">
    <link rel="stylesheet" href="../../css/style.css">
    <link rel="stylesheet" href="../css/css.css">
    <link rel="stylesheet" href="../css/bootstrap.css">
    <link rel="stylesheet" href="../css/bootstrap-theme.css">
    <link href="//netdna.bootstrapcdn.com/font-awesome/4.0.3/css/font-awesome.css" rel="stylesheet">
    <script data-require="angular.js@1.3.0-beta.5" data-semver="1.3.0-beta.5" src="https://code.angularjs.org/1.3.0-beta.5/angular.js"></script>
    <script data-require="jquery@*" data-semver="2.0.3" src="http://code.jquery.com/jquery-2.0.3.min.js"></script>
    <link rel="stylesheet" href="//code.jquery.com/ui/1.11.0/themes/smoothness/jquery-ui.css">  
    <script src="http://code.jquery.com/ui/1.11.0/jquery-ui.js"></script>    
    <script data-require="bootstrap@3.1.1" data-semver="3.1.1" src="http://netdna.bootstrapcdn.com/bootstrap/3.1.1/js/bootstrap.min.js"></script>
    <script src="../js/produccion.js"></script>
     
    <!-- <script src="../js/cargarInsumos.js"></script> -->
    <!-- <script src="../js/cargarProveedor.js"></script> -->
    <!-- <script src="../js/procesos_pro.js"></script>      -->
    <script src="../js/dirPagination.js"></script>
    <script src="../../js/printThis.js"></script> 
</head>
<body onload="nobackbutton();">
    <div class="ventana">
        <div class="cerrar"><label style="font-size:20px">X</label></div>
        <div class="contenido" ng-controller="MyController">
            <table width="90%" border="1" cellspacing="0" cellpadding="0">
              <tbody>
              <tr bgcolor="#CCC">    
              </tr><tr bgcolor="#CCC">
                <td class="tittle" colspan="6"style="margin-right:250px; font-size:16px">Insumos</td>
              </tr>
              <tr>
                <td>    
                    <section class="input-group">
                     <span class="input-group-addon"><i class="glyphicon glyphicon-search"></i></span>
                     <input ng-model="q" id="search" placeholder="Buscar" class="input-search ng-valid">                
                    </section>
                </td>
              </tr>
            </tbody></table>
            <table width="90%" border="1" cellspacing="0" cellpadding="0" id="ta">
              <tr class="stittle">
                <td align="center" style="cursor:pointer" title="Ordenar por Tipo">
                  <span ng-click="ordenarPor('codigo')">Código</span>
                  <span class="fa fa-angle-down" ng-click="ordenarPor('-fecha_actividad')"></span>                 
                 
                </td>
                <td align="center" style="cursor:pointer" title="Ordenar por Nombre">
                  <span ng-click="ordenarPor('categoria')">Categoría</span>
                  <span class="fa fa-angle-down" ng-click="ordenarPor('-categoria')"></span>                    
                </td>
                <td align="center" style="cursor:pointer" title="Ordenar por Marca">
                  <span ng-click="ordenarPor('desc')">Descripción</span>
                  <span class="fa fa-angle-down" ng-click="ordenarPor('-desc')"></span>                    
                  </td>
                <td align="center" style="cursor:pointer" title="Ordenar por Marca">
                  <span ng-click="ordenarPor('unidad')">Unidad de medida</span>
                  <span class="fa fa-angle-down" ng-click="ordenarPor('-unidad')"></span>                    
                  </td>
                <td align="center" style="cursor:pointer" title="Ordenar por Presentación">
                  <span ng-click="ordenarPor('present')">Presentación</span>
                  <span class="fa fa-angle-down" ng-click="ordenarPor('-present')"></span>                    
                  </td>
                <td align="center" style="cursor:pointer" title="Ordenar por Contenido">
                  <span ng-click="ordenarPor('costo_und')">Costo</span>
                  <span class="fa fa-angle-down" ng-click="ordenarPor('-costo_und')"></span>                    
                  </td>

              </tr>
              <tr dir-paginate="insumo in meals | filter:q | itemsPerPage: pageSize | orderBy:ordenSeleccionado" current-page="currentPage" class="row-m" id="i{{insumo.id}}">
                <td align="center"  ng-click="agregar(meal.id,meal.categoria,meal.codigo,meal.desc,meal.present,meal.unidad,meal.costo_und)">{{insumo.codigo}}</td>
                <td align="center"  ng-click="agregar(insumo.id,insumo.categoria,insumo.codigo,insumo.desc,insumo.present,insumo.unidad,insumo.costo_und)">{{insumo.categoria}}</td>
                <td align="center"  ng-click="agregar(insumo.id,insumo.categoria,insumo.codigo,insumo.desc,insumo.present,insumo.unidad,insumo.costo_und)">{{insumo.desc}}</td>
                <td align="center"  ng-click="agregar(insumo.id,insumo.categoria,insumo.codigo,insumo.desc,insumo.present,insumo.unidad,insumo.costo_und)">{{insumo.unidad}}</td>
                <td align="center"  ng-click="agregar(insumo.id,insumo.categoria,insumo.codigo,insumo.desc,insumo.present,insumo.unidad,insumo.costo_und)">{{insumo.present}}</td>
                <td align="center"  ng-click="agregar(insumo.id,insumo.categoria,insumo.codigo,insumo.desc,insumo.present,insumo.unidad,insumo.costo_und)">{{insumo.costo_und}}</td>
              </tr>              
       </table> 
            <div ng-controller="OtherController" class="other-controller">
              <div class="text-center">
              <dir-pagination-controls boundary-links="true" on-page-change="pageChangeHandler(newPageNumber)" template-url="../views/dirPagination.tpl.html"></dir-pagination-controls>
              </div>
            </div>                                                         
        </div>
    </div>     
    <div id="OrdenProduccion">                 
        <table width="80%" align="center">
          <tbody><tr>
            <td width="68%">
            </td>
            <!-- <td width="8%"><a href="../controllers/produccion.php"><img src="../../img/historial.png" width="48" height="48" title="Lista Ficha Técnica" align="right" border="0" id="historial" style="cursor:pointer"></a></td>             -->
               <td width="8%">
             <input type="image" src="../../img/imprimir.png" alt="" width="48" height="48" border="0" align="right" title="Imprimir Orden" id="bt_addp" style="cursor:pointer" onclick="imprimir_esto('OrdenProduccion')">
            </td>           
            </tr>
        </tbody></table>        
        <table width="90%" align="center">
          <tbody><tr class="tittle">
            <td colspan="6"><label style="font-size:18px" class="style-font">Orden de Producción <?php echo $nombre; ?></label></td>
          </tr>
            <tr>
                <td class="bold" width="10%" align="left"><span style="font-size:12px">Ficha Técnica N°</span></td>
                <td class="cont" width="10%"><span style="font-size:18px"><?php echo $id_ficha?></span></td>

                 <td class="bold" width="10%" align="left"><span style="font-size:12px">Producción N°</span></td>
                 
                <td align="left" class="cont" width="10%"><label  style="font-size:18px"><?php echo $consecutivo; ?></label></td>  

                <td class="bold" width="10%" align="left"><span style="font-size:12px">Programacion</span></td>
                <td class="cont" width="10%"><span><?php echo  $fecha?></span></td> 
               
              </tr>                       
          <tr>
            <td class="bold" width="10%" align="left"><span style="font-size:12px">Cantidad Programada</span></td>
            <td class="cont" width="10%"><?php  echo $cantidad;?></td>           
            <td class="bold" width="10%" align="left" colspan=""><span style="font-size:12px" >Fecha Inicio</span></td>
            <td class="cont" width="10%" ><?php echo $fecha_inicio; ?></td>
            <td class="bold" width="10%" align="left" colspan=""><span style="font-size:12px">Fecha Fin</span></td>
            <td class="cont" width="10%"><?php echo $fecha_fin; ?></td>
            </td> 
          </tr>
            
                <tr>
            <td colspan="6" align="center">      <button name="bt_can" id="cerrar" class="ext" onclick="window.close()" >Cerrar</button></td>
                </tr>           
        </tbody></table>        
        </table>                
    </div>       
        <script src="../js/insumos_Integracion.js"></script>    
</body>  
</html>