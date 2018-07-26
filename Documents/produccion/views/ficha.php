<?php
date_default_timezone_set('America/Bogota');

$c_date = date('Y-m-d');
?>
<!-- vista de registro de produccion -->
<!DOCTYPE html>
<html lang="es" >
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

    <link rel="stylesheet" href="http://code.jquery.com/ui/1.11.0/themes/smoothness/jquery-ui.css">  
    <script src="http://code.jquery.com/ui/1.11.0/jquery-ui.js"></script>   


    <script data-require="bootstrap@3.1.1" data-semver="3.1.1" src="http://netdna.bootstrapcdn.com/bootstrap/3.1.1/js/bootstrap.min.js"></script>
    <script src="../js/produccion.js"></script>
    <script src="../js/insumos_pro.js"></script>
    <script src="../js/cargarInsumos.js"></script>
    <!-- <script src="../js/cargarProveedor.js"></script> -->
    <script src="../js/procesos_pro.js"></script>     
    <script src="../js/dirPagination.js"></script>
    <script src="../../js/printThis.js"></script> 

        <!-- <link rel="stylesheet" href="http://netdna.bootstrapcdn.com/bootstrap/3.0.0/css/bootstrap.min.css" /> -->

        <!-- Fix for old browsers -->
        <script src="http://nervgh.github.io/js/es5-shim.min.js"></script>
        <script src="http://nervgh.github.io/js/es5-sham.min.js"></script>
        <script src="../../CargarImagen/js/console-sham.js"></script>

        <script src="http://netdna.bootstrapcdn.com/bootstrap/3.0.0/js/bootstrap.min.js"></script>

        <!--<script src="../bower_components/angular/angular.js"></script>-->
        <script src="../CargarImagen/js/angular-file-upload.js"></script> 
        <script src="../CargarImagen/js/controllers.js"></script>

        <!--thumbnails for images-->
        <script src="../CargarImagen/js/directives.js"></script>

        <style>
            .my-drop-zone { border: dotted 3px lightgray; }
            .nv-file-over { border: dotted 3px red; } /* Default class applied to drop zones on over */
            .another-file-over-class { border: dotted 3px green; }

            html, body { height: 100%; }

            canvas {
                background-color: #f3f3f3;
                -webkit-box-shadow: 3px 3px 3px 0 #e3e3e3;
                -moz-box-shadow: 3px 3px 3px 0 #e3e3e3;
                box-shadow: 3px 3px 3px 0 #e3e3e3;
                border: 1px solid #c3c3c3;
                height: 100px;
                margin: 6px 0 0 6px;
            }
        </style>    
</head>
<body onload="nobackbutton();">
<div class="modalLoad"></div>
<div class="fontaVnetana"></div>
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
    <div id="aplicacion" ng-app="myApp">
      
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
                      <span ng-click="ordenarPor('ref')">Referencia</span>
                      <span class="fa fa-angle-down" ng-click="ordenarPor('-ref')"></span>                 
                     
                    </td>                  
                    <td align="center" style="cursor:pointer" title="Ordenar por Tipo">
                      <span ng-click="ordenarPor('codigo')">Código</span>
                      <span class="fa fa-angle-down" ng-click="ordenarPor('-codigo')"></span>                 
                     
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
                    <td align="center"  ng-click="agregar(insumo.id,insumo.categoria,insumo.codigo,insumo.desc,insumo.present,insumo.unidad,insumo.costo_und)">{{insumo.ref}}</td>
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
            <div id="ventanaCostos">
                   <div class="contenido">
                   <form name="enviarTodo" id="enviarTodo">
                   <a href="" onclick="agragarOtrosC()"><img src="../../img/add.png" height="22" width="22" alt="">Agragar Mas costos</a>
                          <div id="CoPredefinidos">
                            
                          </div> 
                          <div id="agragarOtroCosto">
                            
                          </div>
                          <table width='100%'>
                            <tr class="row-m">
                              <td width='70%'>Otros Costos $</td>
                              <td class='bold' align='center' width='80%' ><input class="digitar" name="cosCO[]" onkeyup="sumarOtrosCostos(this.value)" onkeypress="return justNumbers(event);" type="text" value="0" id="otrosCostos"><input type="hidden" name="desCO[]" value="Otros Costos"/></td>
                            </tr>
                            <tr class="row-m subtotal">
                              <td width='70%' class="bold">Total Costo Referencia $</td>
                              <td class='bold' align='center' width='80%'><div id="subtotal"></div><input class="digitar" name="cosCO[]"  readonly id="totalref" onkeypress="return justNumbers(event);" type="hidden"><input type="hidden" name="desCO[]" value="Total Costo Referencia"/></td>
                            </tr>
                            <tr class="row-m">
                              <td width='70%'>Utilidad Esperada $</td>
                              <td class='bold' align='center' width='80%'><input class="digitar" name="cosCO[]" onkeypress="return justNumbers(event);" type="text" value="0" id="utilidad" onkeyup="hayarMargen(this.value)"><input type="hidden" name="desCO[]" value="Utilidad Esperada"/></td>
                            </tr>
                            <tr class="row-m">
                              <td width='70%'>Margen de Contribución %</td>
                              <td class='bold' align='center' width='80%'><input class="digitar" name="cosCO[]" onkeyup="sumarMargen(this.value)" onkeypress="return NumCheck(event,this);" type="text" value="0" id="margenContri"><input type="hidden" name="desCO[]" value="Margen de Contribución"/></td>
                            </tr>
                            <tr class="row-m subtotal">
                              <td width='70%' class='bold'>Precio Antes de Impuestos $</td>
                              <td  align='center' width='80%' class='bold'><div id="total"></div><input class="digitar" name="cosCO[]" value="0"  readonly id="CostoFinal" onkeypress="return justNumbers(event);" type="hidden"><input type="hidden" name="desCO[]" value="Precio Antes de Impuestos"/></td>
                            </tr>                        
                          </table>         
                          <table>
                            <tr>
                              <td align="center"colspan="4">
                              <button class="ext">Aceptar</button><!-- <button class="ext" onclick="noAccion()">Cancelar</button> -->
                              <button type="button" class="ext" onclick="return noAccion()">Cancelar</button>
                            </tr>          
                          </table>                       
                      </form>
                   </div>
            </div>    
            <form name="procesos_enviar" id="procesos_enviar">        
            <table width="90%" align="center">
              <tbody><tr>
                <td width="68%">
                </td>
                <td width="8%"><a href="../controllers/produccion.php"><img src="../../img/historial.png" width="48" height="48" title="Lista Ficha Técnica" align="right" border="0" id="historial" style="cursor:pointer"></a></td>            
                <td width="8%">
                 <a href="../views/listaprocesos.php"><img src="../../img/add2.png" alt="" width="48" height="48" border="0" align="right" title="Registro de Procesos" id="bt_addp" style="cursor:pointer"></a>    
                </td>
                </tr>
            </tbody></table>   

        <table align="center" width="90%">
                      <tbody><tr>
                        <td width="68%">
                        </td>
                          <td align="rigth" width="10%">Ficha Técnica N°</td>
                          <td width="10%"><input type="hidden" id="orden" name="orden" value="" required/>
                          <label id="norden" style="font-size:18px">0001</label></td>            
                        </tr>
                    </tbody></table>        
        <table width="90%" align="center">
          <tbody><tr class="tittle">
            <td colspan="5"><label  class="style-font">Ficha Técnica</label></td>
          </tr>       
          <tr>
          
            <td class="bold" width="20%">Fecha Creación</td>
            <td class="cont" width="40%"><input type="text" id="fecha_inicio" name="fecha_inicio" class="calinput" readonly required value="<?php echo $c_date; ?>"></td>
            <td class="bold" width="20%">Tiempo Ciclo (días)</td>
            <td class="cont" width="40%">
            <input type="text" id="opcion1" name="opcion1">
            </td>

          </tr>
          <tr>
            
            <td class="bold">Nombre</td>
            <td class="cont">
            <input name="nombre" id="nombre" type="text" value="" >
            </td>
                <td class="bold">N° Piezas</td>
            <td class="cont">
            <input name="opcion2" id="opcion2" type="text" value="">
            </td>
          </tr>

          <tr>
            <td class="bold">Referencia</td>
            <td class="cont">
            <!-- onblur="validarRef(this.value)" -->
            <input name="referencia" id="referencia" type="text" value="" required>
            </td>
            <td class="bold">Descripción</td>
                <td class="cont" colspan="4">
                <input type="text"  name="descripcion" id="descripcion">
            <!-- <textarea  name="descripcion" id="descripcion" cols="108" rows="3"></textarea> -->
            </td> 
            
          </tr>          
<!--           <tr>
            <td class="bold">Descripción</td>
                <td class="cont" colspan="4">
            <textarea  name="descripcion" id="descripcion" cols="108" rows="3"></textarea>
            </td>
          </tr> -->
        </tbody></table>
        <br>

              <?php
              // include('../CargarImagen/views/index.html');
              ?>          
        <!-- <div class="tittle producccion"><span>Insumos</span><img src="../../img/generate.png" id="agregarInsumo" name="agregarInsumo" width="22" height="22" style="cursor:pointer;" title="Cargar Insumo" onclick="buscarInsumo('agregarInsumo',this)"><img src="../../img/add.png" id="registrarInsumo" name="registrarInsumo" width="22" height="22" style="cursor:pointer;" title="Nuevo Insumo" onclick="ventanaRInsumo()"></div> -->
        <table width="90%" border="1" cellspacing="0" align="center">
          <tbody>
          <tr class="tittle produccion">
              <td align="center" width="100%">Insumos
              <img src="../../img/generate.png" id="agregarInsumo" name="agregarInsumo" width="22" height="22" style="cursor:pointer;" title="Cargar Insumo" onclick="buscarInsumo('agregarInsumo',this)"><img src="../../img/add.png" id="registrarInsumo" name="registrarInsumo" width="22" height="22" style="cursor:pointer;" title="Nuevo Insumo" onclick="ventanaRInsumo()"></td>
          </tr>
          </tbody></table>       
        <div id="tablas"></div>
        <p><div class="costotoli totalCostoT">Costo Insumos 0</div>
          <input type="hidden" name="" id="costotoli" class="costotoli" value="0">
          <input type="hidden" name="" id="descli" value="Costo Insumos">
          </p>
        <table width="90%" border="1" cellspacing="0" align="center" id="t_procesos">
          <tbody>
          <tr class="tittle produccion">
              <td colspan="6">Procesos<img src="../../img/generate.png" width="22" height="22" style="cursor:pointer;" title="Insertar proceso" id="agregarProc"  onclick="buscarPro()" /> <!-- id="agregarPro" --></td>
          </tr>
          
           <tr class="stittle proc">
            <td align="center" width="10%">Código</td>
            <td align="center" width="18%">Nombre</td>
            <td align="center" width="18%">Descripción</td>
            <td align="center" width="18%">Provedor</td>
            <td align="center" width="12%">Costo</td>
            <td align="center" width="5%">
        
            </td>
          </tr>
        </tbody>
        </table>
        <div class="totalCostoT">
            <label for="">Costo Procesos</label>
            <label for="" style="font-size:18px" id="totalP">0</label>
            <input type="hidden" id="totalProceso" value="0" name="costaLCC[]" class="costaLC">
            <input type="hidden" id="totalProc" value="Procesos" name="descLCC[]">          
        </div>
        <table width="90%" >
          <tr>
            <td align="center"colspan="4">
            <button name="bt_ok" id="" class="ext">Aceptar</button>
            <input type="button" name="bt_ok" id="" class="ext" onclick="return location.href='../controllers/produccion.php'" value="Cancelar">
          </tr>          
        </table>                

        </form>        
          <!-- Ng app -->
        </div>
    
</body>  
</html>