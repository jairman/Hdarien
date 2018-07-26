<html ng-app="myApp">
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
    <script src="../js/produccion.js"></script>
    <script src="../js/insumos_pro.js"></script>
    <script src="../js/cargarInsumos.js"></script>
    <!-- <script src="../js/cargarProveedor.js"></script> -->
    <script src="../js/procesos_pro.js"></script>     
    <script src="../js/dirPagination.js"></script>
    <script src="../../js/printThis.js"></script>    
    </head>
<div class="modalLoad"></div>    
  <div id="error">
      <br>
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
<!--     <div>
      <h3>Estamos trabajando para mejorar esta operación, gracias por su comprensión</h3>
    </div> -->
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
    <tr>
    <td class="bold">Descripcion</td>
    <td class="cont"><input type="text" class="long" id="tf_desc" value="" name="descripcion"></td>
    <td class="bold">Unidad de Medida</td>
    <td class="cont"><!-- <input type="text" class="long" id="tf_und" value="" required name="unidad"> -->
      <select name="unidad" id="tf_und" style="width: 275px"></select>
    </td>
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
    <td class="cont"><!-- <input type="text" class="long" id="tf_cat" value="" required  name="categoria"> -->
      <select name="categoria" id="tf_cat" style="width: 275px" required></select>
    </td>
    </tr>
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
<div class="ventanaProve">
        <div class="cerrar"><label style="font-size:20px">X</label></div>
        <div class="contenido" ng-controller="MyController">
            <table width="90%" border="1" cellspacing="0" cellpadding="0">
              <tbody>
              <tr bgcolor="#CCC">    
              </tr><tr bgcolor="#CCC">
                <td class="tittle" colspan="5"style="margin-right:250px; font-size:16px">Procesos</td>
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
              </tr>
              <tr dir-paginate="proceso in procesos | filter:q | itemsPerPage: pageSize | orderBy:ordenSeleccionado" current-page="currentPage" class="row-m" id="pr{{proceso.id}}">
                <td align="center"  ng-click="agregarPro(proceso.id,proceso.codigo,proceso.nombre,proceso.descripcion)">{{proceso.codigo}}</td>
                <td align="center"  ng-click="agregarPro(proceso.id,proceso.codigo,proceso.nombre,proceso.descripcion)">{{proceso.nombre}}</td>
                <td align="center"  ng-click="agregarPro(proceso.id,proceso.codigo,proceso.nombre,proceso.descripcion)">{{proceso.descripcion}}</td>
              </tr>              
       </table> 
            <div ng-controller="OtherController" class="other-controller">
              <div class="text-center">
              <dir-pagination-controls boundary-links="true" on-page-change="pageChangeHandler(newPageNumber)" template-url="../views/dirPagination.tpl.html"></dir-pagination-controls>
              </div>
            </div>                                                         
        </div>
    </div>
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
                <td align="center"  ng-click="agregar(insumo.id,insumo.categoria,insumo.codigo,insumo.desc,insumo.present,insumo.unidad,insumo.costo_und)">{{insumo.codigo}}</td>
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
    <div class="fontaVnetana"></div>  
    <div id="table_data">
    <form id="modificarFicha" name="modificarFicha">
          <table width="90%" align="center" id="table_header">
            <tr>
              <td width="93%" align="left">&nbsp;
               
              </td>
              <td width="7%" align="left">
<!--               <input type="image" title="Imprimir" src="../../img/imprimir.png" alt="" 
              width="48" height="48" border="0" align="right" style="cursor:pointer" onclick="imprimir_esto('table_data')" >  -->
              </td>
            </tr>
          </table>
          <table width="90%" align="center" id="tb_header">
            <tr>
              <td rowspan="6" width="80%" class="print"><img src="../../img/Logo.png" alt="logo" name="logo" width="200" height="70" id="logo" />
              </td>
            </tr>
            <tr>
                <td rowspan="4"><h4>Ficha Técnica <?php  echo $fichan; ?></h4></td>
            </tr>
          </table>
          <table width="90%">
            <tr class="tittle" align="center">
              <td colspan="3" align="center">Ficha Técnica</td>
              <input type="hidden" value="<?php echo $idFicha; ?>" name="idFicha" >
            </tr>
            <tr>
              <td class="bold" width="15%">Referencia</td>
              <td><?php echo $referencia; ?></td>
            </tr>
            <tr>
              <td class="bold" width="15%">Nombre</td>
              <td><input type="text" name="nombre" value="<?php echo $nombre; ?>"></td>
            </tr>             
            <tr>
              <td class="bold" width="15%">Descripción</td>
              <td><input type="text" name="descripcion" value="<?php echo $descr; ?>"></td>
            </tr>          
            <tr>
              <td class="bold" width="15%">Fecha Creacón</td>
              <td><?php echo $fecha_creacion; ?></td>
            </tr> 
            <tr>
              <td class="bold" width="15%">Piezas</td>
              <td><input type="text" name="piezas" value="<?php echo $piezas; ?>"></td>
            </tr>       
            <tr>
              <td class="bold" width="15%">Tiempo Ciclo (dias)</td>
              <td><input type="text" name="ciclo" value="<?php echo $ciclo; ?>"></td>
            </tr>                         
          </table>
          <div class="tittle producccion"><span>Insumos</span><img src="../../img/generate.png" id="agregarInsumo" name="agregarInsumo" width="22" height="22" style="cursor:pointer;" title="Insertar Insumo" onclick="buscarInsumo('agregarInsumo',this)"><img src="../../img/add.png" id="registrarInsumo" name="registrarInsumo" width="22" height="22" style="cursor:pointer;" title="Registrar Insumo" onclick="ventanaRInsumo()"></div>
          <div id="tablas">           
              <?php echo $tabla; ?>
          </div>         
          <table width="90%" border="1" cellspacing="0" align="center" id="t_procesos">
            <tbody>
            <tr class="tittle produccion">
                <td colspan="6">Procesos<img src="../../img/add.png" width="22" height="22" style="cursor:pointer;" title="Insertar proceso" id="agregarProc"  onclick="buscarPro()" /></td>
            </tr>
             <tr class="stittle">
              <td align="center" width="10%">Código</td>
              <td align="center" width="18%">Nombre</td>
              <td align="center" width="18%">Descripción</td>
              <td align="center" width="18%">Provedor</td>
              <td align="center" width="12%">Costo</td>
              <td></td>
            </tr>
                  <?php echo $tr; ?>          
          </tbody>
          </table>
          <br>
              <?php echo $trc2; ?>             
         <table width="40%">
            <?php echo $trc3; ?>             
          </table>              
          <table width="40%" >
            <?php echo $trc1; ?>  
          </table>
          <table id="otrasCat" width="40%">
          </table>           
          <table id="agragarOtroCosto" width="40%">
            
          </table>         
          <table width="40%" >
            <?php echo $trc; ?>  
          </table>


          <p>
          
          </p>
        <table width="98%">
            <tr>
                <td align="center"><button  class="ext">Aceptar</button>&nbsp;&nbsp;&nbsp;<button onclick="window.close()"  class="ext">Cancelar</button></td>
            </tr>
        </table>            
  <!--         <div class="img">
              <img src="../../img/add21.png" alt="">
          </div>  --  >         
          </table>                  
    </form>                  
</div>        
     </body>   
</html>