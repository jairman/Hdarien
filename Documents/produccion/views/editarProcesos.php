<html>
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
    <script src="../js/dirPagination.js"></script>
    <script src="../../js/printThis.js"></script>    
    </head>
    <body>
        
    </body>
        <div id="error">
            <br>
        </div>    
        <table width="90%" align="center" id="table_header">
          <tr>
            <td width="93%" align="left">&nbsp;
             
            </td>
            <td width="7%" align="left">
            <input type="image" title="Imprimir" src="../../img/imprimir.png" alt="" 
            width="48" height="48" border="0" align="right" style="cursor:pointer" onclick="imprimir_esto('table_data')" > 
            </td>
          </tr>
        </table>
<!--         <table width="90%" align="center" id="tb_header">
          <tr>
            <td rowspan="3" width="34%" class="print"><img src="../../img/Logo.png" alt="logo" name="logo" width="200" height="70" id="logo" /></td>
          </tr>
        </table> -->
        <form id="modificar_proceso" name= "modificar_proceso">
        <table align="center" id="table_data" width="70%">
            <tr>
              <td colspan="4" align="center" class="tittle"><label style="font-size:18px">Modificar Proceso<span id="fecha_formato"></span></label></td>
            </tr>
            <tr>
                <td class="bold">Nombre</td>
                <td>
                 <label for=""><input type="text" required name="nombre" required value="<?php echo $nombre ?>"></label>
                </td>
                <td class="bold" width="10%">Código</td>
                <td>
                 <label for=""><input type="text" readonly name="codigo" required value="<?php echo $codigo ?>"></label>
                </td>
            </tr>
            <tr>
                <td class="bold">Descripción</td>
                <td colspan="3">

                <input type="text" name="descripcion" value="<?php echo $descripcion;  ?>">
                </td>      
            </tr> 
            <tr>
              <td colspan="4" align="center" class="tittle"><label style="font-size:18px"></label></td>
            </tr>                
        </table>
        <table width="98%">
            <tr>
                <td align="center" colspan="4"><button  class="ext">Aceptar</button>&nbsp;&nbsp;&nbsp;<button onclick="window.close()"  class="ext">Cancelar</button></td>
            </tr>
        </table>
        </form>          
     </body>   
</html>