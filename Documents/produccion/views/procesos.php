<!-- vista de registro de produccion -->
<!-- Se Esta vista permite registrar color y procesos -->
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Producción</title>
    <link rel="stylesheet" href="../../css/clean.css">
    <link rel="stylesheet" href="../../css/style.css">
    <link rel="stylesheet" href="//code.jquery.com/ui/1.11.0/themes/smoothness/jquery-ui.css">       
    <link rel="stylesheet" href="../css/css.css">  
    
    <script src="//code.jquery.com/jquery-1.10.2.js"></script>
    <script src="//code.jquery.com/ui/1.11.0/jquery-ui.js"></script> 
    <script src="../../js/printThis.js" type="text/javascript"></script>   
    <script src="http://code.jquery.com/ui/1.10.1/jquery-ui.js"></script> 
    <script src="../js/produccion.js"></script>
    <script src="../js/insumos_pro.js"></script>
    <script src="../js/procesos_pro.js"></script>
    <script src="../js/agregar_proceso.js"></script>      
</head>
<body onload="nobackbutton();">
    <section>
        <div id="error">
            <br>
        </div>          
        <form name="procesos_enviar" id="procesos_enviar"  class="style-font">
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
            <!-- <td width="8%">
             <a href="../views/procesos.php"><img src="../../img/add2.png" alt="" width="48" height="48" border="0" align="right" title="Agregar Proceso" id="bt_addp" style="cursor:pointer"></a>    
            </td>            
            <td width="8%" align="left"><input type="image" title="Imprimir" src="../../img/imprimir.png" alt="" width="48" height="48" border="0" align="right" style="cursor:pointer" onclick="imprimir_esto('contenido')"></td>             -->
          </tr>
        </tbody></table>        
        <div id="d_tables">
        <table width="90%" align="center" id="agragar_proceso">
          <tbody>
            <tr class="tittle">
              <td colspan="5"><label style="font-size:18px" class="style-font">Agregar Procesos</label></td>
            </tr>  
            <tr class="stittle">
              <td>Código</td>
              <td>Nombre</td>
              <td>Descripcíon</td>
              <td></td>
            </tr>        
            <tr class="row">          
              <td class="cont" align="center" width="20%">
                <input type="text" id="codigo" name="codigo[]" class="codigo" onkeyup="codigoRepedito(this)" required>
                <!-- <input type="text" id="codigo" name="codigo[]" class="codigo" required> -->
              </td>
              <td class="cont" align="center" width="20%">
                <input type="text" id="nombre" name="nombre[]" required>
              </td>              
              <td class="cont" align="center" width="50%">
                <input  type="text" name="descripcion[]" id="descripcion" style="width: 90%;">
              </td>              
              <td>
                <a id="agregarFila"><img src="../../img/add.png" height="22" width="22" alt="Agregar" title="Agregar"></a>
              </td>
            </tr>         
          </tbody>
        </table>
        <table>
          <tr>
            <td align="center"colspan="4">
            <button name="bt_ok" id="" class="ext">Aceptar</button>
            &nbsp;
            <!-- <button name="bt_close" class="ext" id="bt_close">Cancelar</button> -->
            </td>
          </tr>          
        </table>  
        </form>                
    </section>
</body>
</html>