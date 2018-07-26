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

    <!-- load angular, nganimate, and ui-router -->
    <script src="//cdnjs.cloudflare.com/ajax/libs/angular-ui-router/0.2.10/angular-ui-router.min.js"></script>
    <script src="//ajax.googleapis.com/ajax/libs/angularjs/1.2.16/angular-animate.min.js"></script>
    <link rel="stylesheet" href="//code.jquery.com/ui/1.11.0/themes/smoothness/jquery-ui.css">  
    <script src="http://code.jquery.com/ui/1.11.0/jquery-ui.js"></script>    
    <script data-require="bootstrap@3.1.1" data-semver="3.1.1" src="http://netdna.bootstrapcdn.com/bootstrap/3.1.1/js/bootstrap.min.js"></script>
    <script src="../js/produccion.js"></script>
    <script src="../js/insumos_Integracion.js"></script>
    <script src="../js/CargarOrdenP.js"></script>
    <script src="../js/dirPagination.js"></script>
    <script src="../../js/printThis.js"></script> 
</head>
<body>
<div class="fontaVnetana"></div>  
    <div class="modalLoad"></div>
    <section>
 
        <table width="90%" align="center" id="table_header">
          <tbody><tr>
            <td width="84%" align="left">
            </td>
            <td width="8%">
             <a href="../views/listafichaTecnica.php"><img src="../../img/add2.png" alt="" width="48" height="48" border="0" align="right" title="Crear Orden de Producción" id="bt_addp" style="cursor:pointer"></a>    
            </td>            
            <td width="8%" align="left"><input type="image" title="Imprimir" src="../../img/imprimir.png" alt="" width="48" height="48" border="0" align="right" style="cursor:pointer" onclick="imprimir_esto('OrdenIntegracion')"></td>            
          </tr>
        </tbody></table>         
        <div class="contenido" id="contenido" ng-controller="MyController">
            <table width="90%" border="1" cellspacing="0" cellpadding="0">
              <tbody>
              <tr bgcolor="#CCC">    
              </tr><tr bgcolor="#CCC">
                <td class="tittle" colspan="5"style="margin-right:250px; font-size:16px">Lista de Ordenes de Producción</td>
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
                  <span ng-click="ordenarPor('consecutivo')">Orden N°</span>
                  <span class="fa fa-angle-down" ng-click="ordenarPor('-consecutivo')"></span>                 
                </td>               
                <td align="center" style="cursor:pointer" title="Ordenar por Fecha Inicio">
                  <span ng-click="ordenarPor('fecha_inicio')">Fecha Inicio</span>
                  <span class="fa fa-angle-down" ng-click="ordenarPor('-fecha_inicio')"></span>                    
                  </td>  
                <td align="center" style="cursor:pointer" title="Ordenar por Fecha Fin">
                  <span ng-click="ordenarPor('fecha_fin')">Fecha Fin</span>
                  <span class="fa fa-angle-down" ng-click="ordenarPor('-fecha_fin')"></span>                    
                  </td>                                                                                    
                <td align="center" style="cursor:pointer" title="Ordenar por Cantidad">
                  <span ng-click="ordenarPor('cantidad')">Cantidad</span>
                  <span class="fa fa-angle-down" ng-click="ordenarPor('-cantidad')"></span>                    
                  </td> 
                <td align="center" style="cursor:pointer" title="Ordenar por Nombre">
                  <span ng-click="ordenarPor('ficha')">Ficha Técnica</span>
                  <span class="fa fa-angle-down" ng-click="ordenarPor('-ficha')"></span>                    
                </td>                    
                <td align="center" style="cursor:pointer" title="Ordenar por Nombre">
                  <span ng-click="ordenarPor('estado')">Integración</span>
                  <span class="fa fa-angle-down" ng-click="ordenarPor('-estado')"></span>                    
                </td
                <tr>
                  <td>Procesos</td>          
                  <td></td>                    
              </tr>
              <tr dir-paginate="ficha in fichas | filter:q | itemsPerPage: pageSize | orderBy:ordenSeleccionado" current-page="currentPage" class="row-m lista" id="{{ficha.id}}">
                <td align="center"  ng-click="mostrarFicha(ficha.id)" title="Ver">{{ficha.consecutivo}}</td>
                <td align="center"  ng-click="mostrarFicha(ficha.id)" title="Ver">{{ficha.fecha_inicio}}</td>
                <td align="center"  ng-click="mostrarFicha(ficha.id)" title="Ver">{{ficha.fecha_fin}}</td>
                <td align="center"  ng-click="mostrarFicha(ficha.id)" title="Ver">{{ficha.cantidad}}</td> 
                <td align="center"  ng-click="mostrarFichaT(ficha.ficha)" title="Ver">{{ficha.ficha}}</td> 

                <td align="center"  ng-if="ficha.estado=='pendiente'">
                  <!-- <input type="image" src="../../img/search1.png" height="25" width="25" alt="ver" ng-click="buscarIntegracion(ficha.id,ficha.ficha,ficha.integracion,ficha.cantidad,ficha.consecutivo,ficha.fecha)" title="Ver Orden de Integración"> -->
                  <a class="btn-base btn-danger" style="width: 150px !important" ng-click="buscarIntegracion(ficha.id,ficha.ficha,ficha.integracion,ficha.cantidad,ficha.consecutivo,ficha.fecha,ficha.estado)">{{ficha.estado}}&nbsp;&nbsp;<!-- {{ficha.integracion}} --></a>
                </td>

                <td align="center"  ng-if="ficha.estado=='Completado'">
                  <!-- <input type="image" src="../../img/search1.png" height="25" width="25" alt="ver" ng-click="buscarIntegracion(ficha.id,ficha.ficha,ficha.integracion,ficha.cantidad,ficha.consecutivo,ficha.fecha)" title="Ver Orden de Integración"> -->
                  <a class="btn-base btn-good" style="width: 150px !important" ng-click="buscarIntegracion(ficha.id,ficha.ficha,ficha.integracion,ficha.cantidad,ficha.consecutivo,ficha.fecha,ficha.estado)">{{ficha.estado}}<!-- {{ficha.integracion}} --></a>
                </td>                
                <td align="center" >
                  <input type="image" style="cursor: pointer !important;" src="../../img/process.png" height="25" width="25" alt="" ng-click="procesosFicha(ficha.id,ficha.consecutivo,ficha.ficha,ficha.nombre,ficha.cantidad,ficha.consecutivo)" title="Procesos">
                </td>                 
                <td>
                <input type="image" style="cursor: pointer !important;" src="../../img/edit.png" height="25" width="25" alt="" ng-click="modificarProduccion(ficha.id)" title="Editar">
                <input type="image" style="cursor: pointer !important;" src="../../img/erase.png" height="25" width="25" alt="" ng-click="eliminar(ficha.id)" title="Eliminar">
                </td>
              </tr>              
       </table> 
            <div ng-controller="OtherController" class="other-controller">
              <div class="text-center">
              <dir-pagination-controls boundary-links="true" on-page-change="pageChangeHandler(newPageNumber)" template-url="../views/dirPagination.tpl.html"></dir-pagination-controls>
              </div>
            </div>                                                         
        </div>  

        <div id="OrdenIntegracion">
        <div id="solicitud">    
          <!-- <form name="guardarPedido" id="guardarpedido"> -->
            <div id="tablasol">
              
            </div>
            <table style="margin: 20px auto auto auto;">
                <tr>
                  <td colspan="6" align="center"><button name="bt_ok" id="ok" class="ext" onclick="return enviarPedido()">Aceptar</button>
                  &nbsp;&nbsp;&nbsp;
                  <a name="bt_can" id="cerrar" style="color:#fff;" class="ext" onclick="return noAccion();">Cancelar</a></td>
                </tr>              
            </table>                
          <!-- </form> -->
        </div>
          <form id="modificarIntegracion" name="modificarIntegracion">
            <table width="90%" align="center">
              <tbody><tr>
                <td width="68%">
                </td>
                  <td width="10%" align="rigth">Integración N°</td>
                  <td width="10%"><input type="hidden" id="ordenII" name="ordenII" value="" required/>
                  <label id="nordenII" style="font-size:18px"></label></td>            
                </tr>
            </tbody></table>           
              <table width="90%" border="1" cellspacing="0" align="center" id="tb_detail">
               <tr>
                   <td class="tittle" colspan="8">Orden de Integración</td>
                   <input type="hidden" value="si" id="modificarInsumosFicha">
               </tr>        
              <tr>
              <td width="10%">Ficha Técnica N°</td>
              <td width="10%"><span style="font-size:18px" id="nficha"></span><input type="hidden" id="ficha" name="fichaI" value="" required readonly></td>
              <td width="10%">Producción N°</td>
              <td width="10%"><span id="ordenpr" style="font-size:18px"></span><input type="hidden" name="ordenpro" id="ordenpro"></td>
              <td width="10%">Programación</td>
              <td width="20%"><span id="fechaI"></span></td>
              <td width="10%">Cantidad Programada</td>
              <td width="10%"><span id="cprogramada"></span><input type="hidden" id="cantidadOP" name="cantidadOP"></td>
              </tr>
                
              </table>

              <div id="tablas">
              </div>
            <table  width="90%">
                <tr>
                  <td colspan="6" align="center"><button name="bt_ok" id="ok" class="ext">Aceptar</button>&nbsp;&nbsp;&nbsp;
                  <a id="cerrar" class="ext" onclick="return window.location.href='../controllers/listaOrdenProduccion.php'">Cancelar</a></td>
                </tr>              
            </table>                              
          </form>          
        </div>                 

        <div id="Procesos">
          <!-- views will be injected here -->
          <div class="container">
              <div ui-view>
                <div class="row">
                <div class="col-sm-13">

                  <div id="form-container" ng-controller="listP">
                    <div id="status-buttons"> <!-- ng-repeat="proceso in procesos"  --> <!-- ng-repeat="data in procesos" -->
                          <!-- <a ui-sref-active="active" ui-sref=".profile"><span>{{ proceso.orden }}</span> {{ proceso.nombre }}</a> -->
                        <a ui-sref-active="active" ui-sref=".profile"><span>1</span> <!--Corte --></a>
                        <a ui-sref-active="active" ui-sref=".interests"><span>2</span><!-- Selección --></a>
                        <a ui-sref-active="active" ui-sref=".payment"><span>3</span> <!-- Producción--></a>
                    </div>          
                              
                    <div class="tittle text-center" style="width:100% !important">
                      <p>Corte</p>        
                    </div>
                    
                  </div      

                   <form id="encabezado" name="encabezado">

                        <table width="100%" border="1" cellspacing="0" align="center" id="tbl_detailP">
                        <tr>
                          <td class="bold" width="15%">Ficha Técnica N°</td>
                          <td width="25%">
                            <a href="#"> <span style="font-size:18px" id="nroficha" ng-click="mostrarFichaT('$(#ficha2).val()')">
                            <input type="hidden" id="ficha2" name="ficha2" value=""></span> </a>
                          </td>
                          <td class="bold" width="15%">Fecha Inicio</td>
                          <td width="25%">
                              <input type="text" id="fecha_inicio" name="fecha_inicio" class="calinput" required value="<?php echo $c_date; ?>" readonly>
                          </td>
                        </tr>
                        <tr>
                          <td class="bold" width="10%">Nombre</td>
                          <td width="25%"><span class="fecha"></span></td>
                          <td class="bold" width="10%">Fecha Fin</td>
                          <td width="25%">
                            <input type="text" id="fecha_fin" name="fecha_fin" class="calinput" required value="<?php echo $c_date; ?>" readonly >
                          </td>
                        </tr>
                        <tr>
                          <td class="bold" width="10%">Cantidad</td>
                          <td width="25%">
                            <input type="hidden" id="cantidadOPI2" name="cantidadOPI2"  value="" required>
                            <div id="cprogramada2"></div>
                          </td>
                          <td class="bold" width="10%">Estado</td>
                          <td><label id="nordenI2" class="btn-base btn-danger" style="font-size:18px; padding: 1%;">Pendiente</label></td>
                        </tr>  
                          <tr>
                            <td class="bold">Observaciones</td>
                                <td class="cont" colspan="4">
                            <textarea  name="descripcion" id="descripcion" cols="108" rows="3"></textarea>
                            </td>
                          </tr>
                        </table>

                        <hr class="style-eight" />
                        <br />

                        <table width="100%" border="1" cellspacing="0" align="center" id="tbl_proveedor">
          <!--                <tr>
                             <td class="tittle" colspan="6">Procesos</td>
                         </tr>   -->      
                        <tr>
                          <td width="15%">Proveedor</td>
                          <td width="20%">
                            <span style="font-size:18px" id="nroficha">
                            <input type="hidden" id="ficha2" name="ficha2" value=""></span>
                          </td>
                          <td width="15%">NIT</td>
                          <td width="20%">
                              <span id="ordenpr2" style="font-size:18px"></span>
                              <input type="hidden" id="ordenP2" name="ordenP2" value="">
                          </td>
                          <td width="17%">Teléfono</td>
                          <td width="20%">
                            <input type="hidden" id="ordenI2" name="ordenI2" value="" required/>
                            <label id="nordenI2" style="font-size:18px"></label>
                          </td>
                          <td width="17%">Email</td>
                          <td width="20%">
                            <input type="hidden" id="ordenI2" name="ordenI2" value="" required/>
                            <label id="nordenI2" style="font-size:18px"></label>
                          </td>                          
                        </tr>                          
                        </table>

                        <hr class="style-eight" />                        

                        <div class="tittle producccion" style="width:100% !important"><span>Insumos</span><img src="../../img/generate.png" id="agregarInsumo" name="agregarInsumo" width="22" height="22" style="cursor:pointer;" title="Cargar Insumo" onclick="buscarInsumo('agregarInsumo',this)"><img src="../../img/add.png" id="registrarInsumo" name="registrarInsumo" width="22" height="22" style="cursor:pointer;" title="Nuevo Insumo" onclick="ventanaRInsumo()"></div>
                        <div id="tablas">
                            <table id="TELA" width="90%" border="1" cellspacing="0">   
                             <tbody>
                                <tr>
                                   <td colspan="9" align="center" class="subtitle"><strong>TELA</strong></td>  
                                </tr>
                                <tr class="stittle">    
                                  <td align="center" width="10%">Código</td>
                                  <td align="center" width="10%">Descripción</td>
                                  <td align="center" width="12%">Presentación</td>
                                  <td align="center" width="15%">Und. Medida</td>
                                  <td align="center" width="5%">Consumo</td>
                                  <td align="center" width="5%">Costo Und.</td>
                                  <td align="center" width="11%">Proveedor</td>
                                  <td align="center" width="5%">Costo</td>
                                  <td align="center" width="10%"></td>
                                </tr>
                                <tr id="tr44" class="row-m">
                                  <td align="center">INDTEL<input type="hidden" name="idI[]" value="44"></td>
                                  <td align="center">TELA INDIGO</td><td align="center">UNIDAD</td>
                                  <td align="center">MT</td>
                                  <td align="center"><input style="width:50px; text-align:center;" type="text" required="" id="cant44" value="" onkeyup="costoFila(this,44,'TELA')" onkeypress="return justNumbers(event);" name="cantidadI[]"></td>
                                  <td align="center"><input type="text" value="5000.00" id="cost44" name="costoU[]" readonly=""></td>
                                  <td align="center">
                                    <select class="digitar selectProveedor" name="proveedor[]">
                                      <option value=""></option>
                                      <option value="1066732186">Dapps SA</option>
                                      <option value="3482312">Delva</option>
                                      <option value="32804256">textiles colorgama</option>
                                    </select>
                                  </td>
                                  <td align="center">
                                    <input type="text" class="TELA" style="width:80px; text-align:center;" required="" id="costa44" name="costoA[]" readonly="" value="">
                                  </td>
                                  <td align="center">
                                    <img src="../../img/erase.png" id="quitarInsumo" width="20" height="20" style="cursor:pointer;" title="Eliminar" onclick="removerChild('tr44','TELA',44)">
                                  </td>
                                </tr>
                                <tr id="tr42" class="row-m">
                                  <td align="center">JEANTEL<input type="hidden" name="idI[]" value="42"></td>
                                  <td align="center">TELA BLUEJEAN</td><td align="center">ROLLO</td>
                                  <td align="center">MT</td><td align="center">
                                    <input style="width:50px; text-align:center;" type="text" required="" id="cant42" value="" onkeyup="costoFila(this,42,'TELA')" onkeypress="return justNumbers(event);" name="cantidadI[]"></td>
                                  <td align="center"><input type="text" value="1000000.00" id="cost42" name="costoU[]" readonly=""></td>
                                  <td align="center">
                                    <select class="digitar selectProveedor" name="proveedor[]">
                                      <option value=""></option>
                                      <option value="1066732186">Dapps SA</option>
                                      <option value="3482312">Delva</option>
                                      <option value="32804256">textiles colorgama</option>
                                    </select>
                                  </td>
                                  <td align="center">
                                    <input type="text" class="TELA" style="width:80px; text-align:center;" required="" id="costa42" name="costoA[]" readonly="" value="">
                                  </td>
                                  <td align="center"><img src="../../img/erase.png" id="quitarInsumo" width="20" height="20" style="cursor:pointer;" title="Eliminar" onclick="removerChild('tr42','TELA',42)"></td>
                                </tr>
                              </tbody>
                            </table>

                            <table id="new2" width="90%" border="1" cellspacing="0"> 
                               <tbody>
                                  <tr>
                                    <td colspan="12" align="center" class="subtitle"><strong>new2</strong></td>
                                   </tr>  
                                   <tr class="stittle"> 
                                      <td align="center" width="10%">Código</td>
                                      <td align="center" width="10%">Descripción</td>
                                      <td align="center" width="5%">Unid. Medida</td>
                                      <td align="center" width="5%">Proveedor</td>
                                      <td align="center" width="5%">Consumo</td>
                                      <td align="center" width="5%">Costo consumo</td>
                                      <td align="center" width="5%">Cantidad</td>
                                      <td align="center" width="5%">Costo Total</td>
                                      <td align="center" width="5%">Inventario</td>
                                      <td align="center" width="5%">Solicitar</td>
                                      <td align="center" width="5%">Descargar</td>
                                      <td align="center" width="5%"></td>
                                    </tr>
                                    <tr id="tr37" class="row-m">
                                      <td align="center">new2<input type="hidden" name="idI[]" value="37"></td>
                                      <td align="center">new2<input type="hidden" name="idFicha[]" value="2"></td>
                                      <td align="center">
                                        2<input type="hidden" name="cantidad" value="1">
                                        <input type="hidden" name="cantidad_und[]">
                                      </td>
                                      <td align="center">
                                        <select class="selectProvee81" id="pr37" name="proveedor[]" onchange="resumenP(this.value,'81',37,'new2','new2')">
                                          <option value="0">Sin proveedor</option>
                                          <option value="1066732186">Dapps SA</option>
                                          <option value="3482312">Delva</option>
                                          <option value="32804256">textiles colorgama</option>
                                        </select>
                                      </td>
                                      <td align="center">1<input type="hidden" name="costo_uni[]" value="5656.00"></td>
                                      <td align="center">5656<input type="hidden" name="costo[]" value="5656"></td>
                                      <td align="center" class="bold">12<input type="hidden" name="cantidadTotal[]" id="t37" value="12"></td>
                                      <td align="center" class="bold">67872</td><td align="center">0</td>
                                      <td align="center">
                                        <input type="text" style="width:110px" required="" placeholder="Min 12" id="s37" value="" onblur="minimoI(this.value,12,37,0,'new2','new2')" onkeyup="validarCantidadCampo(this.value,12,37,0,'new2','new2')" class="accion" name="sol[]" onkeypress="return justNumbers(event);"> </td>
                                      <td align="center">
                                        <input type="text" readonly="" placeholder="Max 0" id="i37" value="" style="width:110px" class="accion" name="des[]" onkeypress="return justNumbers(event);">
                                      </td>
                                      <td align="center" width="5%" id="v37"><img src="" width="22" height="22" id="im37"></td>
                                    </tr>
                                    <tr>
                                      <td align="center"></td>
                                    </tr>
                                  </tbody>
                            </table>

                        </div>
                        <p><div class="costotoli totalCostoT">Costo Insumos 0</div>
                          <input type="hidden" name="" id="costotoli" class="costotoli" value="0">
                          <input type="hidden" name="" id="descli" value="Costo Insumos">
                        </p>

                        <div class="tittle producccion" style="width:100% !important"><span>Diseño</span><img src="../../img/generate.png" id="agregarInsumo" name="agregarInsumo" width="22" height="22" style="cursor:pointer;" title="Cargar Insumo" onclick="buscarInsumo('agregarInsumo',this)"><img src="../../img/add.png" id="registrarInsumo" name="registrarInsumo" width="22" height="22" style="cursor:pointer;" title="Nuevo Insumo" onclick="ventanaRInsumo()"></div>
                        <div id="tablas"></div>  

                        <br />
                        <!-- boton azul -->
<!--                         <div class="col-xs-2 col-xs-offset-5">
                            <a class="btn-base btn-block btn-info">
                              Aceptar <span class="glyphicon glyphicon-circle-arrow-right"></span>
                            </a>
                        </div> -->
                        <table id="btn_Actions">
                              <tr>
                                <td align="center"colspan="4">
                                <button name="bt_ok" id="" class="ext">Aceptar</button>
                                <input type="button" name="bt_ok" id="" class="ext" onclick="return location.href='../controllers/listaOrdenProduccion.php'" value="Cancelar">
                              </tr>
                        </table>
                    </form>
                </div>
                </div>
              </div>
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
        <div id="error">
            <br>
        </div>             
</body>    
    <!-- <<script src="js/produccion.js"></script> -->
    <!--<script data-require="ng-table@*" data-semver="0.3.0" src="http://bazalt-cms.com/assets/ng-table/0.3.0/ng-table.js"></script>-->
</html>