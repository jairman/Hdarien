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
</head>
<body onload="nobackbutton();">
   <div class="modalLoad"></div>
    <section>
        <div id="error">
            <br>
        </div>           
        <form name="enviar_colors" id="enviar_colors"  class="style-font">
        <table width="90%" align="center" id="table_header">
          <tbody><tr>
            <td width="84%" align="left">
            <div id="menu">
              <ul> 
              <li>
              <a href="../controllers/listaprocesos.php" class=" menur">Procesos</a>
              </li>              
              <li>
                <a href="../controllers/listacolores.php" class="menur active">Colores</a>
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
          </tr>
        </tbody></table>         
        <div id="d_tables">
        <table width="90%" align="center" id="agragar_color">
          <tbody>
            <tr class="tittle">
              <td colspan="3"><label style="font-size:18px" class="style-font">Agregar Color</label></td>
            </tr>  
            <tr class="stittle">
              <td>Nombre</td>
              <td>Color</td>
              <td></td>            
            </tr>        
            <tr class="row">          
              <td class="cont" align="center" width="40%">
                <input type="text" id="nombre" name="nombre[]" class="codigo" required>
              </td>
              <td class="cont" align="center" width="40%">
                <input type="color" required id="codigo" name="codigo[]" value="#f3f3f3" min="1" max="10">
              </td>                           
              <td>
                <a id="agregarFilaColor"><img src="../../img/add.png" height="22" width="22" alt="Agregar" title="Agregar"></a>
              </td>
            </tr>         
          </tbody>
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
    <script src="../js/agregar_proceso.js"></script>  
</html>