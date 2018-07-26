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
     <script src="../js/insumos_Integracion.js"></script>
    <!-- <script src="../js/cargarInsumos.js"></script> -->
    <!-- <script src="../js/cargarProveedor.js"></script> -->
    <!-- <script src="../js/procesos_pro.js"></script>      -->
    <script src="../js/dirPagination.js"></script>
    <script src="../../js/printThis.js"></script>
</head>
<body onload="nobackbutton();">
<div class="modalLoad"></div>
<div id="error">
    <br>
</div>
  <div id="dialog">
      <div id="mensaje">        
      </div>
      <br>
      <div class="button">
          <img src="../img/good.png" alt="" id="si" width="36" height="36" title="Aceptar">
          &nbsp;
          <img src="../img/erase.png" alt="" id="no" width="36" height="36" title="Cancelar">
      </div>
  </div>
    <div id="">
        <table width="90%" align="center">
          <tbody><tr>
            <td width="68%">
            </td>
            <td width="8%"><a href="../controllers/produccion.php"><img src="../../img/historial.png" width="48" height="48" title="Lista Ficha Técnica" align="right" border="0" id="historial" style="cursor:pointer"></a></td>            
            <td width="8%">
             <a href="../views/procesos.php"><img src="../../img/add2.png" alt="" width="48" height="48" border="0" align="right" title="Registro de Procesos" id="bt_addp" style="cursor:pointer"></a>    
            </td>
            </tr>
        </tbody></table>     
        <div id="">
            <table width="90%" border="1" cellspacing="0" align="center" id="tb_detail">
             <tr>
                 <td class="tittle" colspan="6">Orden de Integración  <?php echo $_GET['nombre']; ?></td>
             </tr>        
            <tr>
              <td width="10%">Ficha Técnica N°</td>
              <td width="30%"><span style="font-size:18px"><?php echo $_GET['ref']; ?><input type="hidden" id="ficha" name="ficha" value="<?php echo $_GET['ref']?>"></span></td>
              <td width="10%">Producción N°</td>
              <td width="30%"><span id="ordenpr" style="font-size:18px"><?php if(isset($_GET['ordenproduccion'])){ echo $_GET["ordenproduccion"];} ?></span></td>
              <td width="10%">Integración N°</td>
                <input type="hidden" id="ordenI" name="ordenI" value="<?php if(isset($_GET['cantidad'])){ echo $_GET['cantidad']; }?>" required/>
              <td width="30%"><label id="nordenI" style="font-size:18px"></label></td>
            </tr>
            <tr>
              <td width="10%">Programación</td>
              <td width="30%"><span class="fecha"></span></td>
              <td width="10%">Programada</td>
              <td width="30%"><span id="cprogramada"><?php if(isset($_GET['cantidad'])){ echo $_GET['cantidad']; }?></span></td>
            </tr>
              
            </table>

            <div id="tablas">
            </div>            
        </div>        
    <script>
        buscarInsumosFicha($('#ficha').val());
    </script>         
    </body>  

</html>