<?
$ruta_a_joomla = "/../../Sganadero/";

define( '_JEXEC', 1 );
define( 'JPATH_BASE', realpath(dirname(__FILE__).$ruta_a_joomla ));
define( 'DS', DIRECTORY_SEPARATOR );

require_once ( JPATH_BASE .DS.'includes'.DS.'defines.php' );
require_once ( JPATH_BASE .DS.'includes'.DS.'framework.php' );
require_once ( JPATH_BASE .DS.'configuration.php' );
$mainframe =& JFactory::getApplication('site');
$mainframe->initialise();
$userx = &JFactory::getUser();
	$usuario= $userx->username;
if (JFactory::getUser()->usertype == NULL)
    JError::raiseError(1,"No puede acceder A esta Aplicación sin estar logueado... Consulte al Administrador....!!!");
$userx = JFactory::getUser();
?>
<?php require_once('Connections/conexion.php'); ?>
<?php
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

mysql_select_db($database_conexion, $conexion);
$query_ven = "SELECT * FROM d89xz_ventas ORDER BY fecha DESC";
$ven = mysql_query($query_ven, $conexion) or die(mysql_error());
$row_ven = mysql_fetch_assoc($ven);
$totalRows_ven = mysql_num_rows($ven);


$date= date("d/m/Y");
$anoss= date("Y"); // Year (2003)
//echo $anoss;
//echo date("m"); // Month (12)
//echo date("d"); // day (14)

//crias hembra enero
$sql = mysql_query("select * FROM d89xz_ventas WHERE  venta!='0' and YEAR(fecha) = '$anoss' AND MONTH(fecha) = '01' ",$conexion);
$cria_hembra_enero = mysql_num_rows($sql);
//crias hembra febrero
$sql = mysql_query("select * FROM d89xz_ventas WHERE  venta!='0' and YEAR(fecha) = '$anoss' AND MONTH(fecha) = '02' ",$conexion);
$cria_hembra_febrero = mysql_num_rows($sql);
//crias hembra marzo
$sql = mysql_query("select * FROM d89xz_ventas WHERE  venta!='0' and YEAR(fecha) = '$anoss' AND MONTH(fecha) = '03' ",$conexion);
$cria_hembra_marzo = mysql_num_rows($sql);
//crias hembra abril
$sql = mysql_query("select * FROM d89xz_ventas WHERE  venta!='0' and YEAR(fecha) = '$anoss' AND MONTH(fecha) = '04' ",$conexion);
$cria_hembra_abril = mysql_num_rows($sql);
//crias hembra mayo
$sql = mysql_query("select * FROM d89xz_ventas WHERE  venta!='0' and YEAR(fecha) = '$anoss' AND MONTH(fecha) = '05' ",$conexion);
$cria_hembra_mayo = mysql_num_rows($sql);
//crias hembra junio
$sql = mysql_query("select * FROM d89xz_ventas WHERE  venta!='0' and YEAR(fecha) = '$anoss' AND MONTH(fecha) = '06' ",$conexion);
$cria_hembrao_junio = mysql_num_rows($sql);
//crias hembra julio
$sql = mysql_query("select * FROM d89xz_ventas WHERE  venta!='0' and YEAR(fecha) = '$anoss' AND MONTH(fecha) = '07' ",$conexion);
$cria_hembra_julio = mysql_num_rows($sql);
//crias hembra agosto
$sql = mysql_query("select * FROM d89xz_ventas WHERE  venta!='0' and YEAR(fecha) = '$anoss' AND MONTH(fecha) = '08' ",$conexion);
$cria_hembra_agosto = mysql_num_rows($sql);
//crias hembra septiembre
$sql = mysql_query("select * FROM d89xz_ventas WHERE  venta!='0' and YEAR(fecha) = '$anoss' AND MONTH(fecha) = '09' ",$conexion);
$cria_hembra_septi = mysql_num_rows($sql);
//crias hembra octubre
$sql = mysql_query("select * FROM  d89xz_ventas WHERE  venta!='0' and YEAR(fecha) = '$anoss' AND MONTH(fecha) = '10'  ",$conexion);
$cria_hembra_octubre = mysql_num_rows($sql);
//crias hembra noviembre
$sql = mysql_query("select * FROM d89xz_ventas WHERE  venta!='0' and YEAR(fecha) = '$anoss' AND MONTH(fecha) = '11' ",$conexion);
$cria_hembra_noviem = mysql_num_rows($sql);
//crias hembra diciembre
$sql = mysql_query("select * FROM d89xz_ventas WHERE  venta!='0' and YEAR(fecha) = '$anoss' AND MONTH(fecha) = '12' ",$conexion);
$cria_hembra_dici = mysql_num_rows($sql);



?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Ventas Vacuno</title>

<style type="text/css">
.x {
	color: #FFF;
}
</style>
 <style> 
a{text-decoration:none} 
</style>
<script src="SpryAssets/SpryMenuBar.js" type="text/javascript"></script>
<link href="SpryAssets/SpryMenuBarHorizontal.css" rel="stylesheet" type="text/css" />
</head>

<body>
<p><a href="javascript:imprSelec('seleccion')" ><img src="imprimir.png" alt="" width="36" height="35" border="0" align="right" /></a>
  

</p>
<ul id="MenuBar1" class="MenuBarHorizontal">
  <li><a href="kar_ventas.php" class="current">Vacunos Vendidos</a>  </li>
  <li><a href="ventas.php">Ventas</a></li>
    <li><a href="mostrar_nomina.php">Nomina</a>  </li>
   
     <li><a href="stin_bascula.php">Báscula</a>  </li>
      <li><a href="stin_buscar_bascula.php">Reporte Báscula</a>  </li>
  
</ul>
<p>&nbsp;</p>
<p>&nbsp; </p>
<DIV ID="seleccion">
<table width="399" border="1" align="center" cellspacing="0">
  <tr bgcolor="#4D68A2" style="color: #FFF">
    <th width="102" bgcolor="#4D68A2">ID</th>
    <th width="151">Meses</th>
    <th>Vacunos Vendidos</th>
  </tr>
  <tr align="center">
    <td style="font-weight: bold">1</td>
    <td style="font-weight: bold"><a href="kar_ventas_reporte_detalle.php?mes=01">Enero</a></td>
    <td width="124" style="font-weight: bold"><? echo $cria_hembra_enero ?></td>
  </tr>
  <tr align="center">
    <td style="font-weight: bold">2</td>
    <td style="font-weight: bold"><a href="kar_ventas_reporte_detalle.php?mes=02">Febrero</a></td>
    <td style="font-weight: bold"><? echo $cria_hembra_febrero ?></td>
  </tr>
  <tr align="center">
    <td style="font-weight: bold">3</td>
    <td style="font-weight: bold"><a href="kar_ventas_reporte_detalle.php?mes=03">Marzo</a></td>
    <td style="font-weight: bold"><? echo $cria_hembra_marzo ?></td>
  </tr>
  <tr align="center">
    <td style="font-weight: bold">4</td>
    <td style="font-weight: bold"><a href="kar_ventas_reporte_detalle.php?mes=04">Abril</a></td>
    <td style="font-weight: bold"><? echo $cria_hembra_abril?></td>
  </tr>
  <tr align="center">
    <td style="font-weight: bold">5</td>
    <td style="font-weight: bold"><a href="kar_ventas_reporte_detalle.php?mes=05">Mayo</a></td>
    <td style="font-weight: bold"><? echo $cria_hembra_mayo ?></td>
  </tr>
  <tr align="center">
    <td style="font-weight: bold">6</td>
    <td style="font-weight: bold"><a href="kar_ventas_reporte_detalle.php?mes=06">Junio</a></td>
    <td style="font-weight: bold"><? echo $cria_hembrao_junio?></td>
  </tr>
  <tr align="center">
    <td style="font-weight: bold">7</td>
    <td style="font-weight: bold"><a href="kar_ventas_reporte_detalle.php?mes=07">Julio</a></td>
    <td style="font-weight: bold"><? echo $cria_hembra_julio ?></td>
  </tr>
  <tr align="center">
    <td style="font-weight: bold">8</td>
    <td style="font-weight: bold"><a href="kar_ventas_reporte_detalle.php?mes=08">Agosto</a></td>
    <td style="font-weight: bold"><? echo $cria_hembra_agosto?></td>
  </tr>
  <tr align="center">
    <td style="font-weight: bold">9</td>
    <td style="font-weight: bold"><a href="kar_ventas_reporte_detalle.php?mes=09">Septiembre</a></td>
    <td style="font-weight: bold"><? echo $cria_hembra_septi?></td>
  </tr>
  <tr align="center">
    <td style="font-weight: bold">10</td>
    <td style="font-weight: bold"><a href="kar_ventas_reporte_detalle.php?mes=10">Octubre</a></td>
    <td style="font-weight: bold"><? echo $cria_hembra_octubre ?></td>
  </tr>
  <tr align="center">
    <td style="font-weight: bold">11</td>
    <td style="font-weight: bold"><a href="kar_ventas_reporte_detalle.php?mes=11">Noviembre</a></td>
    <td style="font-weight: bold"><? echo $cria_hembra_noviem?></td>
  </tr>
  <tr align="center">
    <td style="font-weight: bold">12</td>
    <td style="font-weight: bold"><a href="kar_ventas_reporte_detalle.php?mes=12">Diciembre</a></td>
    <td style="font-weight: bold"><? echo  $cria_hembra_dici?></td>
  </tr>
</table>
<p>&nbsp; </p>
<script type="text/javascript">
var MenuBar1 = new Spry.Widget.MenuBar("MenuBar1", {imgDown:"SpryAssets/SpryMenuBarDownHover.gif", imgRight:"SpryAssets/SpryMenuBarRightHover.gif"});
  </script>
</body>
</html>
<?php
mysql_free_result($ven);
?>

</DIV> 

<script language="Javascript">

  function imprSelec(nombre)

  {

  var ficha = document.getElementById(nombre);

  var ventimp = window.open(' ', 'popimpr');

  ventimp.document.write( ficha.innerHTML );

  ventimp.document.close();

  ventimp.print( );

  ventimp.close();

  } 

</script> 