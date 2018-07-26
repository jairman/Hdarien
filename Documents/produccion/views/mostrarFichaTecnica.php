<html>
    <head>
        <meta charset="UTF-8">
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
    <script src="../../js/printThis.js"></script>     
    </head>
    <body>
    <div id="table_data">
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
          </tr>
<!--           <tr>
            <td class="bold" width="15%">Ficha Técnica</td>
            <td><?php ?></td>
            <td rowspan="2"><h4>Imagen</h4></td>
          </tr> -->
          <tr>
            <td class="bold" width="15%">Referencia</td>
            <td><?php echo $referencia; ?></td>
          </tr>
         <tr>
            <td class="bold" width="15%">Nombre</td>
            <td><?php echo $nombre; ?></td>
          </tr>          
          <tr>
            <td class="bold" width="15%">Descripción</td>
            <td><?php echo $descr; ?></td>
          </tr>          
          <tr>
            <td class="bold" width="15%">Fecha Creacón</td>
            <td><?php echo $fecha_creacion; ?></td>
          </tr> 
          <tr>
            <td class="bold" width="15%">Piezas</td>
            <td><?php echo $piezas; ?></td>
          </tr>       
          <tr>
            <td class="bold" width="15%">Tiempo Ciclo (dias)</td>
            <td><?php echo $ciclo; ?></td>
          </tr>                         
        </table>
        <div class="tittle producccion"><span>Insumos</span></div>          
        <div id="tablas">           
            <?php echo $tabla; ?>
        </div>         
        <table width="90%" border="1" cellspacing="0" align="center" id="t_procesos">
          <tbody>
          <tr class="tittle produccion">
              <td colspan="5">Procesos</td>
          </tr>
           <tr class="stittle">
            <td align="center" width="10%">Código</td>
            <td align="center" width="18%">Nombre</td>
            <td align="center" width="18%">Descripción</td>
            <td align="center" width="18%">Provedor</td>
            <td align="center" width="12%">Costo</td>
            </td>
          </tr>
                <?php echo $tr; ?>          
        </tbody>
        </table>
        <br>
        
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
        <table width="98%">
            <tr>
                <td align="center"><button onclick="window.close()"  class="ext">Cerrar</button></td>
            </tr>
        </table>          
</div>        
     </body>   
</html>