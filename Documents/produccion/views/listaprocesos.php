<!-- vista de registro de produccion kista de ficha tecnica -->
<!DOCTYPE html>
<html lang="es" ng-app="myApp">
<head>
    <meta charset="UTF-8">
    <title>Producción</title>
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
    <!-- <script src="js/produccion.js"></script> -->
    <script src="../js/agregar_proceso.js"></script>
    <!-- <script src="../js/produccion.js"></script> -->
    <script src="../js/cargarProcesos.js"></script>
    <script src="../js/dirPagination.js"></script>
    <script src="../../js/printThis.js"></script> 
</head>
  <body>
<div class="ventanaAddInsumo">
    <div class="cerrar"><label style="font-size:20px">X</label></div>
    <div class="contenido">
    <form id="reInsumo" name="reInsumo">
    <br>
<table width="95%" border="1" cellspacing="0" align="center">
  <tbody><tr class="tittle">
    <td colspan="4">Insumo</td>
  </tr>
  <tr>
    <td class="bold" width="20%">Referencia</td>
    <td class="cont" width="30%">
    <input type="text" class="long red" id="tf_ref" value="" required name="ref"></td>
    <td class="bold" width="20%">Fecha de Creación</td>
    <td class="cont" width="30%"><input name="tf_fecha" type="text" name="fecha_crea" class="calinput long" required value="<?php echo $c_date; ?>"></td>
    </tr>
    <!--<tr>
    <td class="bold">Cod. Barras</td>
    <td class="cont"><input type="text" class="long" id="tf_codb" 
    readonly value="< echo $row_prod['cod_barra']?>"></td>
    <td class="bold">RFID</td>
    <td class="cont"><input type="text" class="long" id="tf_rfid" 
    readonly value="< echo $row_prod['rfid']?>"></td>
    </tr>-->
    <tr>
    <td class="bold">Descripcion</td>
    <td class="cont"><input type="text" class="long" id="tf_desc" value="" name="descripcion"></td>
    <td class="bold">Unidad de Medida</td>
    <td class="cont"><input type="text" class="long" id="tf_und" value="" required name="unidad"></td>
    </tr><tr>
    </tr><tr>
    <td class="bold">Presentación</td>
    <td class="cont"><input type="text" class="long" id="tf_desc" value="" name="presentacion" ></td>
    <td class="bold">Contenido</td>
    <td class="cont"><input type="text" class="long" id="tf_contenido" value="" name="contenido" ></td>
    </tr>
    <tr>
    <td class="bold">Código</td>
    <td class="cont"><input type="text" class="long" id="tf_codigo" value="" required name="codigo"></td>
    <td class="bold">Costo</td>
    <td class="cont"><input type="text" class="long" id="tf_costo" value="" required name="costo" onkeypress="return justNumbers(event);"></td>
    </tr>
    <tr>
    <td class="bold">Marca</td>
    <td class="cont"><input name="marca" type="text" class="long" id="tf_marca" value="" name="marca"></td>
    <td class="bold">Categoria</td>
    <td class="cont"><input type="text" class="long" id="tf_cat" value="" required  name="categoria"></td>
    </tr>
<!--     <tr>
    <td class="bold">Minimo</td>
    <td class="cont"><input type="text" class="long" id="tf_min" value="0.00" onkeyup="checkNum(this)"></td>
    <td class="bold">Maximo</td>
    <td class="cont"><input type="text" class="long" id="tf_max" value="0.00" onkeyup="checkNum(this)"></td>
    </tr> -->
  <!--
    <tr>
      <td colspan="4" align="center" class="cont" valign="middle">
        <div align="center" id="d_img" style="width:180px; height:180px" name=divs class="img">
          <div>
            <img src="../controllers/invent_agregarimg.php?idnum=< echo $row_prod['img_id']?>" alt="Img" id="art< echo $row_prod['img_id']?>" name="imgs" class="picture" />
            </div>
          </div>
      </td>
    </tr>-->
  <tr>
    <td colspan="4">&nbsp;</td>
  </tr>  
  <tr>
    <td colspan="4" align="center">
    <input name="bt_ok" type="submit" id="bt_ok" value="Aceptar" class="ext">
    &nbsp;
    <input name="bt_close" type="button" class="ext cerrar" id="bt_close" value="Cancelar">
    </td>
  </tr>
</tbody></table>          
    </form>      
    </div>  
    </div>   
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
            <div id="menu">
              <ul> 
              <li>
              <a href="../controllers/listaprocesos.php" class=" menur active">Procesos</a>
              </li>              
              <li>
                <a href="../controllers/listacolores.php" class="menur">Colores</a>
              </li>
              <li>
              <a href="../../param_insumos/views/params_und.php">Unidad de Medida</a>
              </li>              
              <li>
                <a href="../../param_insumos/views/params_cat.php" >Categoría</a>
              </li>                                         
              </ul>
            </div>  
            </td>
            <td width="8%">
             <a href="../views/procesos.php"><img src="../../img/add2.png" alt="" width="48" height="48" border="0" align="right" title="Agregar Proceso" id="bt_addp" style="cursor:pointer"></a>    
            </td>            
            <td width="8%" align="left"><input type="image" title="Imprimir" src="../../img/imprimir.png" alt="" width="48" height="48" border="0" align="right" style="cursor:pointer" onclick="imprimir_esto('contenido')"></td>            
          </tr>
        </tbody></table>               
<!--         <table width="90%" align="center" id="table_header">
          <tbody><tr>
            <td width="84%" align="left">
            <div id="menu">
              <ul> 
              <li>
              <a href="../controllers/procesos.php" class=" menur">Agregar Procesos</a>
              </li>              
              <li>
                <a href="../controllers/listaprocesos.php" class="menur active">Lista de procesos</a>
              </li>                           
<!--               <li>
              <a href="#" class="menur" id="agregarColor">Agrega Colores</a>
              </li>  -->             
   <!--           </ul>
            </div>  
            </td>
            <td width="8%" align="left"><input type="image" title="Imprimir" src="../../img/imprimir.png" alt="" width="48" height="48" border="0" align="right" style="cursor:pointer" onclick="imprimir_esto('contenido')"></td>            
          </tr>
        </tbody></table>  -->        
        <div class="contenido" id="contenido" ng-controller="MyController">
            <table width="90%" border="1" cellspacing="0" cellpadding="0">
              <tbody>
              <tr bgcolor="#CCC">    
              </tr><tr bgcolor="#CCC">
                <td class="tittle" colspan="5"style="margin-right:250px; font-size:16px">Procesos</td>
              </tr>
            <tr>
                <td colspan="4">

                    <div class="input-group">
                     <span class="input-group-addon"><i class="glyphicon glyphicon-search"></i></span>
                     <input ng-model="q" id="search" placeholder="Buscar" class="input-search ng-valid">                
                    </div>
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
            </tbody>
            </table>
            <table width="90%" border="1" cellspacing="0" cellpadding="0" id="ta">
              <tr class="stittle">
                <td align="center" style="cursor:pointer" title="Ordenar por Código">
                  <span ng-click="ordenarPor('codigo')">Código</span>
                  <span class="fa fa-angle-down" ng-click="ordenarPor('-codigo')"></span>                 
                 
                </td>
                <td align="center" style="cursor:pointer" title="Ordenar por Nombre">
                  <span ng-click="ordenarPor('nombre')">Nombre</span>
                  <span class="fa fa-angle-down" ng-click="ordenarPor('-nombre')"></span>                    
                </td>
                <td align="center" style="cursor:pointer" title="Ordenar por Descripción">
                  <span ng-click="ordenarPor('descripcion')">Descripción</span>
                  <span class="fa fa-angle-down" ng-click="ordenarPor('-descripcion')"></span>                    
                  </td>
                  <td></td>                  
              </tr>
              <tr dir-paginate="proceso in procesos | filter:q | itemsPerPage: pageSize | orderBy:ordenSeleccionado" current-page="currentPage" class="row-m lista" id="{{proceso.id}}">
                 <td align="center"  ng-click="mostrarP(proceso.id)">{{proceso.codigo}}</td>
                <td align="center"  ng-click="mostrarP(proceso.id)">{{proceso.nombre}}</td>
                <td align="center"  ng-click="mostrarP(proceso.id)">{{proceso.descripcion}}</td> <!-- href="../controllers/editarProcesos.php?id={{proceso.id}}"  -->
                <td style="cursor: pointer !important;"><a ng-click="editarP(proceso.id)" ><input type="image" src="../../img/edit.png" height="25" width="25" alt="edit" title="Editar" ></a><input type="image" src="../../img/erase.png" height="25" width="25" alt="erase" ng-click="eliminarP(proceso.id)" title="Eliminar"></td>
              </tr>
       </table> 
            <div ng-controller="f" class="other-controller">
              <div class="text-center">
              <dir-pagination-controls boundary-links="true" on-page-change="pageChangeHandler(newPageNumber)" template-url="../views/dirPagination.tpl.html"></dir-pagination-controls>
              </div>
            </div>                                                         
        </div>          
</body>    
    <!-- <<script src="js/produccion.js"></script> -->
    <!--<script data-require="ng-table@*" data-semver="0.3.0" src="http://bazalt-cms.com/assets/ng-table/0.3.0/ng-table.js"></script>-->
</html>