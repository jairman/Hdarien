<?php require_once('joom.php'); ?>
<?php require_once('../Connections/conexion.php'); ?>

<?php

if ($acceso !='0'){
?>
<table width="70%" border="0" align="center">
  <tr>
    <td><img src="../img/Logo.png" width="886" height="248" /></td>
  </tr>
  <tr>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <th>No puede acceder A este MENU sin estar HABILITADO... Consulte al Administrador....!!!</th>
  </tr>
</table>
<?php
}else{
    
if (!function_exists("GetSQLValueString")) {
function GetSQLValueString($theValue, $theType, $theDefinedValue = "", $theNotDefinedValue = "") 
{
  if (PHP_VERSION < 6) {
    $theValue = get_magic_quotes_gpc() ? stripslashes($theValue) : $theValue;
  }

  $theValue = function_exists("mysql_real_escape_string") ? mysql_real_escape_string($theValue) : mysql_escape_string($theValue);

  switch ($theType) {
    case "text":
      $theValue = ($theValue != "") ? "'" . $theValue . "'" : "NULL";
      break;    
    case "long":
    case "int":
      $theValue = ($theValue != "") ? intval($theValue) : "NULL";
      break;
    case "double":
      $theValue = ($theValue != "") ? doubleval($theValue) : "NULL";
      break;
    case "date":
      $theValue = ($theValue != "") ? "'" . $theValue . "'" : "NULL";
      break;
    case "defined":
      $theValue = ($theValue != "") ? $theDefinedValue : $theNotDefinedValue;
      break;
  }
  return $theValue;
}
}

?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Agenda</title>
    <link rel="stylesheet" href="../css/clean.css">
    <link rel="stylesheet" href="../css/style.css">
    <link rel="stylesheet" href="css/css.css">  
    <link rel="stylesheet" href="//code.jquery.com/ui/1.11.0/themes/smoothness/jquery-ui.css">  
    <script src="js/jquery.js"></script>
    <script src="js/calendario.js"></script> 
    <script src="//code.jquery.com/jquery-1.10.2.js"></script>
    <script src="//code.jquery.com/ui/1.11.0/jquery-ui.js"></script> 
    <script src="../js/printThis.js" type="text/javascript"></script>             
</head>
<body>
<div id="dialog">
    <div id="mensaje">
        
    </div>
    <br>
    <div class="button">
        <img src="../img/good1.png" alt="" id="si" width="36" height="36">
        &nbsp;&nbsp;&nbsp;
        <img src="../img/erase1.png" alt="" id="no" width="36" height="36">
    </div>
</div>

<div id="dialogNotas">
    <div id="notaMensaje" contentEditable="true">
            
    </div>
        <br>
        <div class="button">
            <img src="../img/good.png" alt="" id="siN" width="36" height="36">
            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
            <img src="../img/erase.png" alt="" id="noN" width="36" height="36">
        </div>      
</div>
    <div id="historialEventos">
        <table width="98%" align="center" id="table_header">
          <tbody><tr>
            <td width="84%" align="left">
            <div id="menu">
              <ul>
              <li>
                <a href="reportes.php" class="active menur">Eventos</a>
              </li>  
              <li>
                <a href="repetidos.php" class="menur">Eventos peridodicos</a>
              </li>                           
              <li>
              <img src="../img/Logo.png" id="logo" class="logo" alt="" width="200" height="70">
              </li>
              </ul>
            </div>  
            </td>
            <td width="8%" align="left"><input type="image" title="Imprimir" src="../img/imprimir.png" alt="" width="48" height="48" border="0" align="right" style="cursor:pointer" onclick="imprimir_esto('historialEventos')"></td>            
          </tr>
        </tbody></table> 

        <table width="98%" align="center">
            <tr class="tittle">
                <td colspan="14">Reporte de Eventos</td>
                <input type="hidden" value="no" id="repetido">
            </tr>
            <tr>
                <td class="bold" width="6%"></td>
                <td class="bold" width="6%"></td>
                <td class="bold" width="20%">Punto de venta</td>
                <td class="bold" align="left"  width="30%">
                    <select name="lugar_r" id="lugar_r"></select>
                </td>             
                <td class="bold" width="10%">Fecha</td>
                <td class="bold" align="left"  width="30%">
                    <select name="anio_r" id="anio_r"></select>
                    <select name="mes_r" id="mes_r"  ></select>
                    <select name="dia_r" id="dia_r">
                    <option value=""></option>
                    </select>
                </td> 
                <td class="bold" width="6%"></td>
                <td class="bold" width="6%"></td>
            </tr>
        </table>                
        <table  width="98%" id="Table_Resultadohistorial">
        </table>          
    </div>
</body>
</html>
<?php
}
?>