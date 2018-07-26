<!-- vista de registro de produccion -->
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Agenda</title>
    <link rel="stylesheet" href="../../css/clean.css">
    <link rel="stylesheet" href="../../css/style.css">
    <link rel="stylesheet" href="//code.jquery.com/ui/1.11.0/themes/smoothness/jquery-ui.css">       
    <link rel="stylesheet" href="../css/css.css">  
</head>
<body onload="nobackbutton();">
    <div class="modalLoad"></div>
    <div class="ventana">
        <div class="cerrar"><label style="font-size:20px">X</label></div>
        <div class="contenido">
            <table width="98%" border="1" cellspacing="0" cellpadding="0">
              <tbody><tr bgcolor="#CCC">    
              </tr><tr bgcolor="#CCC">
                <td align="left" class="tittle"><span style="float:left;margin-left:25px"> Filtro    
                  <select name="b_tipo" id="b_tipo" style="width:200px">
                    <option value="todo">Todo</option>
                            <option value=" "></option>
                            <option value=""></option>
                        </select></span>
                <strong style="margin-right:250px; font-size:16px">Inventario de Insumos</strong></td>
              </tr>
            </tbody></table>
            <table width="98%" border="1" cellspacing="0" cellpadding="0" id="tabla_insumos_telas">
              <thead>
              <tr class="stittle" align="center">
                <th style="cursor:pointer" title="Ordenar por Tipo"><strong>Tipo</strong></th>
                <th style="cursor:pointer" title="Ordenar por Nombre"><strong>Nombre</strong></th>
                <th style="cursor:pointer" title="Ordenar por Marca"><strong>Marca</strong></th>
                <th style="cursor:pointer" title="Ordenar por Descripción"><strong>Descripción</strong></th>
                <th style="cursor:pointer" title="Ordenar por Presentación"><strong>Presentación</strong></th>
                <th style="cursor:pointer" title="Ordenar por Contenido"><strong>Contenido</strong></th>
                <th>Mínimo</th>
              </tr>
              </thead>
              <tbody>
              </tbody>
            </table>             
            <table width="98%" border="1" cellspacing="0" cellpadding="0" id="tabla_insumos">
              <thead>
              <tr class="stittle" align="center">
                <th style="cursor:pointer" title="Ordenar por Tipo"><strong>Tipo</strong></th>
                <th style="cursor:pointer" title="Ordenar por Nombre"><strong>Nombre</strong></th>
                <th style="cursor:pointer" title="Ordenar por Marca"><strong>Marca</strong></th>
                <th style="cursor:pointer" title="Ordenar por Descripción"><strong>Descripción</strong></th>
                <th style="cursor:pointer" title="Ordenar por Presentación"><strong>Presentación</strong></th>
                <th style="cursor:pointer" title="Ordenar por Contenido"><strong>Contenido</strong></th>
                <th>Mínimo</th>
              </tr>
              </thead>
              <tbody>
              </tbody>
            </table>                        
        </div>
    </div>
    <section>
        <div id="error">
            <br>
        </div>    
        <form name="procesos_enviar" id="procesos_enviar"  class="style-font">
            <table width="90%" align="center" id="table_header">
              <tbody><tr>
                <td width="84%" align="left">
                </td>
                <!--<td width="8%" align="left"><img title="Agregar procesos" src="../img/img.png" alt="" width="48" height="48" border="0" align="right" style="cursor:pointer"></td>-->
                <td width="8%" align="left"><img title="Agragar Isumos"  src="../../img/add.png" alt="" width="48" height="48" border="0" align="right" style="cursor:pointer"></td>
                <td width="8%" align="left"><input type="image" title="Imprimir" src="../../img/imprimir.png" alt="" width="48" height="48" border="0" align="right" style="cursor:pointer" onclick="imprimir_esto('historialEventos')"></td>            
              </tr>
            </tbody></table>        
        <div id="d_tables">
        <table width="90%" align="center">
          <tbody><tr class="tittle">
            <td colspan="4"><label style="font-size:18px" class="style-font">Ingresar Ficha Técnica de Producción</label></td>
          </tr>
            <tr>
                <td class="cont" width="20%"></td>
                <td class="cont" width="30%"></td>

                <td class="cont" width="20%" align="right"><strong style="font-size:16px">Orden N°</strong></td>
                <input type="hidden" id="orden" name="orden" value="" required/>
                <td align="left" class="cont"><label id="norden" style="font-size:18px"></label></td>            
              </tr>          
          <tr>          
            <td class="bold" width="20%">Fecha Inicio</td>
            <td class="cont" width="30%"><input type="text" id="fecha_inicio" name="fecha_inicio" class="calinput" required></td>
            <td class="bold" width="20%">Opción 1</td>
            <td class="cont" width="30%">
            <input type="text" id="opcion1" name="opcion1">
            </td>
            
          </tr>
          <tr>
            <td class="bold">Nombre</td>
            <td class="cont">
            <input name="nombre" id="nombre" type="text" value="" required>
            </td>
                <td class="bold">Opcion 2</td>
            <td class="cont">
            <input name="opcion2" id="opcion2" type="text" value="">
            </td>
          </tr>
          <tr>
            <td class="bold">Referencia</td>
            <td class="cont">
            <input name="referencia" id="referencia" type="text" value="" required>
            </td>
                <td class="bold">Opcion 3</td>
            <td class="cont">
            <input name="opcion3" id="opcion3" type="text" value="">
            </td>
          </tr>          
          <tr>
            <td class="bold">Descripción</td>
                <td class="cont" colspan="1">
            <textarea  name="descripcion" id="descripcion" cols="40" rows="3"></textarea>
            </td>
            <td class="bold">Imagen</td>
            <td class="cont">
              <input name="file" id="file" type="text" value="">
            </td>            
          </tr>
        </tbody></table>

        <table width="90%" border="1" cellspacing="0" align="center" id="t_insumos">
          <tbody>
          <tr class="tittle">
              <td colspan="7">Telas</td>
          </tr>
          <tr class="stittle">
            <td align="center" width="14%">Tipo</td>
            <td align="center" width="10%">Nombre</td>
            <td align="center" width="18%">Presentación</td>
            <td align="center" width="10%">Contenido</td>
            <td align="center" width="12%">Cantidad</td>
            <td align="center" width="11%">Costo Aproximado</td>
            <td align="center" width="5%"><img src="../../img/generate.png" id="agregarInsumoTelas" name="agregarInsumoTelas" width="20" height="20" style="cursor:pointer;" title="Insertar Insumo" onclick="buscarInsumoTela('agregarInsumo',this)"></td>
          </tr>
        </tbody></table>
        <table width="70%">
          <tr>
            <td colspan="6" align="right"  class="red" style="font-size:18px;"><label for="">Costo Total </label><label for="" style="font-size:18px" id="totalA">0</label>
            <input type="hidden" name="totalInsumo" id="totalInsumo" value="">
            </td>
          </tr>
        </table> 

        <table width="90%" border="1" cellspacing="0" align="center" id="t_insumos">
          <tbody>
          <tr class="tittle">
              <td colspan="7">Insumos Requeridos</td>
          </tr>
          <tr class="stittle">
            <td align="center" width="14%">Tipo</td>
            <td align="center" width="10%">Nombre</td>
            <td align="center" width="18%">Presentación</td>
            <td align="center" width="10%">Contenido</td>
            <td align="center" width="12%">Cantidad</td>
            <td align="center" width="11%">Costo Aproximado</td>
            <td align="center" width="5%"><img src="../../img/generate.png" id="agregarInsumo" name="agregarInsumo" width="20" height="20" style="cursor:pointer;" title="Insertar Insumo" onclick="buscarInsumo('agregarInsumo',this)"></td>
          </tr>
          
         <!-- <tr class="row" id="filahuecainsumo">  
            <td class="cont" align="center">
            <input type="text" name="tipo" id="tipo" class="ref" style="width:75%">
            <img src="" width="22" height="22" id="img_est1" style="display:none" disbled>
            </td>
            <td class="cont">
            <input type="text" id="nombre" name="nombre" class="long" required>
            </td>
            <td class="cont">
            <input type="text" id="pres" name="pres" class="long" required>
            </td>
            <td class="cont"> 
            <input type="text" id="cont" name="cont" class="long" required>
            </td>
            <td class="cont" align="center">
            <input type="text" id="canti" name="canti" class="long cant" required>
            </td>
            <td class="cont" align="center">
            <input type="text" id="costo" name="costo" class="long costo" required>
            </td>
            <td align="center">
                <img src="../img/erase.png" id="quitarInsumo" width="20" height="20" style="cursor:pointer;" title="Eliminar" onclick="removerChild('filahuecainsumo')">
            </td>
          </tr>-->
        </tbody></table>
        <table width="70%">
          <tr>
            <td colspan="6" align="right"  class="red" style="font-size:18px;"><label for="">Costo Total </label><label for="" style="font-size:18px" id="totalA">0</label>
            <input type="hidden" name="totalInsumo" id="totalInsumo" value="">
            </td>
          </tr>
        </table>       

        <table width="90%" border="1" cellspacing="0" align="center" id="t_procesos">
          <tbody>
          <tr class="tittle">
              <td colspan="5">Procesos</td>
          </tr>
          <tr class="stittle">
            <td align="center" width="10%">Nombre</td>
            <td align="center" width="18%">Descripción</td>
            <td align="center" width="12%">Costo</td>
            <td align="center" width="5%">
              <img id="agregarPro" src="../../img/add.png" width="20" height="20" style="cursor:pointer;" title="Insertar proceso">
            </td>
          </tr>
          
         <!-- <tr id="fila_1" class="row">  
            <td class="cont">
            <input type="text" class="long">
            </td>
            <td class="cont">
            <input type="text"  class="long">
            </td>
            <td class="cont">
            <input type="text" class="long">
            </td>
            <td align="center">
                <img src="../img/erase.png" id="img1" width="20" height="20" style="cursor:pointer;" title="Eliminar">
            </td>
          </tr>-->

        </tbody>
        </table>
        <table width="50%">
          <tr>
            <td colspan="6" align="right"  class="red" style="font-size:18px;"><label for="">Costo Total</label>
            <label for="" style="font-size:18px" id="totalP">0</label>
            <input type="hidden" name="totalProceso" id="totalProceso" value="">
            </td>
          </tr>
        </table>         
        <table>
          <tr>
            <td align="center"colspan="4">
            <button name="bt_ok" id="" class="ext">Aceptar</button>
            &nbsp;
            <button name="bt_close" class="ext" id="bt_close">Cancelar</button>
            </td>
          </tr>          
        </table>                

        </form>        
    </section>
</body>
    <script src="//code.jquery.com/jquery-1.10.2.js"></script>
    <script src="//code.jquery.com/ui/1.11.0/jquery-ui.js"></script> 
    <script src="../../js/printThis.js" type="text/javascript"></script>   
    <script src="http://code.jquery.com/ui/1.10.1/jquery-ui.js"></script> 
    <script src="../js/produccion.js"></script>
    <script src="../js/insumos_pro.js"></script>
    <script src="../js/procesos_pro.js"></script>  
</html>