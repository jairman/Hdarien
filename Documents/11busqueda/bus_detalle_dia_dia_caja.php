<?
$ruta_a_joomla = "/../../Hdarien/";

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
}if (!function_exists("GetSQLValueString")) {
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

$date= date("d/m/Y");
$anoss= date("Y"); // Year (2003)
$mess= date("m"); // Year (2003)
mysql_select_db($database_conexion, $conexion);
$query_v = "SELECT * FROM d89xz_diario WHERE  YEAR(fecha) = '$anoss' AND MONTH(fecha) = '$mess'";
$v = mysql_query($query_v, $conexion) or die(mysql_error());
$row_v = mysql_fetch_assoc($v);
$totalRows_v = mysql_num_rows($v);mysql_select_db($database_conexion, $conexion);
$query_v = "SELECT * FROM d89xz_diario WHERE  YEAR(fecha) = '$anoss' AND MONTH(fecha) = '$mess'";
$v = mysql_query($query_v, $conexion) or die(mysql_error());
$row_v = mysql_fetch_assoc($v);
$totalRows_v = mysql_num_rows($v);
//total Ventas

$result = mysql_query("SELECT SUM(`v_tal`) as total FROM d89xz_diario where  YEAR(fecha) = '$anoss' AND MONTH(fecha) = '$mess' AND concep = 'Ingreso'"); 
		 
			$row = mysql_fetch_array($result, MYSQL_ASSOC);
			@$ventas =  number_format($row[total]);
			//echo $ventas;
				
				$result22 = mysql_query("SELECT SUM(`v_tal`) as total FROM d89xz_diario where  YEAR(fecha) = '$anoss' AND MONTH(fecha) = '$mess' AND concep = 'Ingreso'  and estado='Pago'"); 
			 
				$row22 = mysql_fetch_array($result22, MYSQL_ASSOC);
				@$ventasT = $row22[total];
			
				
//total Compras

$result1 = mysql_query("SELECT SUM(`v_tal`) as total FROM d89xz_diario where  YEAR(fecha) = '$anoss' AND MONTH(fecha) = '$mess' AND concep = 'Egreso' "); 
		 
			$row1 = mysql_fetch_array($result1, MYSQL_ASSOC);
			@$egreso =  number_format($row1[total]);
			//echo $ventas;
				$result11 = mysql_query("SELECT SUM(`v_tal`) as total FROM d89xz_diario where  YEAR(fecha) = '$anoss' AND MONTH(fecha) = '$mess' AND concep = 'Egreso' and estado='Pago'"); 
			 
				$row11 = mysql_fetch_array($result11, MYSQL_ASSOC);
				@$egresoT =  $row11[total];
				
	$final = $ventasT + $egresoT;
	
	$finalT= number_format($final);
	
				
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Documento sin título</title>
</head>
<script src="SpryAssets/SpryValidationSelect.js" type="text/javascript"></script>
<link href="SpryAssets/SpryValidationSelect.css" rel="stylesheet" type="text/css" />
</head>
<script src="SpryAssets/SpryMenuBar.js" type="text/javascript"></script>
<link href="SpryAssets/SpryMenuBarHorizontal.css" rel="stylesheet" type="text/css" />

<script type="text/javascript">
var MenuBar1 = new Spry.Widget.MenuBar("MenuBar1", {imgDown:"SpryAssets/SpryMenuBarDownHover.gif", imgRight:"SpryAssets/SpryMenuBarRightHover.gif"});
</script>
<body>
<ul id="MenuBar1" class="MenuBarHorizontal">
  <li><a href="dia_dia.php" >Registro Diario</a>  </li>
  <li><a href="dia_dia_pendiente.php" >Facturas  Pendientes</a> </li>
  <li><a href="bus_detalle_dia_dia.php" class="current">Reportes</a>  </li>
  <li><a href="dia_dia_histo.php" >Historial</a> </li>

 
</ul>
<p>&nbsp;</p>
<ul id="MenuBar1" class="MenuBarHorizontal">
  <li><a href="bus_detalle_dia_dia.php" >Reportes De Ventas</a>  </li>
  <li><a href="bus_detalle_dia_dia_compras.php">Reportes De Compras</a></li>
  <li><a href="bus_detalle_dia_dia_caja.php"  class="current">Reporte Mensual Caja</a></li>
</ul>
<p>&nbsp;</p>
<table width="100%" border="0" align="center" cellspacing="0">
  <tr bgcolor="#f0f0f0">
    <td width="121" align="left">&nbsp;</td>
    <td width="121" align="left">&nbsp;</td>
    <td width="308" align="center">&nbsp;</td>
    <td width="239" align="right"><a href="javascript:imprSelec('seleccion')" ><img src="imprimir.png" alt="" width="36" height="35" 

border="0" align="right" /></a></td>
  </tr>
</table>
<DIV ID="seleccion">
<table width="100%" border="1" align="center" cellspacing="0">
  <tr bgcolor="#4D68A2" style="color: #FFF">
    <th colspan="8" align="left" bgcolor="#FFFFFF"><img src="idsolutions--este.png" width="177" height="61" /></th>
  </tr>
  <tr bgcolor="#4D68A2" style="color: #FFF">
    <th>Total Compras</th>
    <th width="14%" bgcolor="#FFFFFF" style="color: #000"><? echo $egreso ?></th>
    <th width="19%">Total  Ventas</th>
    <th bgcolor="#FFFFFF" style="color: #000"><? echo $ventas?></th>
    <th colspan="3">Estado Caja</th>
   
	<? 
	  
	  if($finalT >=0){
	  	echo " <td bgcolor='#00CC00' align='center'>$finalT</td>";
	  }else{
		  	
		echo " <td bgcolor='#FF0000' align='center'>$finalT</td>";
		  }
		 
	  ?>
  </tr>
  <tr bgcolor="#4D68A2" style="color: #FFF">
    <th colspan="8">Reporte Mensual Caja</th>
  </tr>
  <tr bgcolor="#4D68A2" style="color: #FFF">
    <th width="16%">N° Factura</th>
    <th colspan="2"><strong>Descripción</strong></th>
    <th width="11%"><strong>Estado</strong></th>
    <th width="8%"><strong>Cantidad</strong></th>
    <th width="12%"><strong>Valor U.</strong></th>
    <th colspan="2"><strong>Valor Total</strong></th>
  </tr>
  <?php do { ?>
    <tr align="center">
      <td><?php echo $row_v['factura']; ?></td>
      <td colspan="2" align="left"><?php echo $row_v['descrip']; ?></td>
      <td align="left"><?php echo $row_v['estado']; ?></td>
      <td><?php echo $row_v['cantid']; ?></td>
      <td align="right"><?php echo number_format ($row_v['v_unit']); ?></td>
      <td colspan="2" align="right"><?php echo number_format (  abs($row_v['v_tal'])); ?></td>
    </tr>
    <?php } while ($row_v = mysql_fetch_assoc($v)); ?>
</table>
</body>
</html>
<?php
mysql_free_result($v);
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