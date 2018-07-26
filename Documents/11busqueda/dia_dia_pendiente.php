<?
/*$ruta_a_joomla = "/../../Sganadero/";

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
$userx = JFactory::getUser();*/
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
$query_pen = "SELECT * FROM d89xz_diario WHERE estado = 'Pendiente' order by f_alarma asc";
$pen = mysql_query($query_pen, $conexion) or die(mysql_error());
$row_pen = mysql_fetch_assoc($pen);
$totalRows_pen = mysql_num_rows($pen);

//Detalle

$result = mysql_query("SELECT SUM(`v_tal`) as total FROM  d89xz_diario WHERE `factura` = '$row_pen[factura]'"); 
$row = mysql_fetch_array($result, MYSQL_ASSOC);
$total=$row['total'];

$tal1 = abs($total);
//el total de abonos
$result = mysql_query("SELECT SUM(`abono`) as total FROM  d89xz_abonos WHERE  `orden` = '$row_pen[factura]'"); 
$row_abono = mysql_fetch_array($result, MYSQL_ASSOC);
$total_abono1=$row_abono['total'];
$total_abono2= abs($total_abono1);
// Saldo
	$saldo1 = $tal1 - $total_abono1;
	$saldo =  number_format($saldo1);

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Documento sin título</title>
<script langiage="javascript" type="text/javascript">


function mano(a) { 
    if (navigator.appName=="Netscape") { 
        a.style.cursor='pointer'; 
    } else { 
        a.style.cursor='hand'; 
    } 
}

// RESALTAR LAS FILAS AL PASAR EL MOUSE
function ResaltarFila(id_fila) {
    document.getElementById(id_fila).style.backgroundColor = '#C0C0C0';
}
 
// RESTABLECER EL FONDO DE LAS FILAS AL QUITAR EL FOCO
function RestablecerFila(id_fila) {
    document.getElementById(id_fila).style.backgroundColor = '#FFFFFF';
}
 
// CONVERTIR LAS FILAS EN LINKS
function CrearEnlace(url) {
    location.href=url;
}
</script>
</head>
<script src="SpryAssets/SpryMenuBar.js" type="text/javascript"></script>
<link href="SpryAssets/SpryMenuBarHorizontal.css" rel="stylesheet" type="text/css" />

<body>
<ul id="MenuBar1" class="MenuBarHorizontal">
 <li></li>
 <li></li>
 <li><a href="dia_dia.php" >Registro Diario</a> </li>
  <li><a href="dia_dia_pendiente.php"class="current" >Facturas  Pendientes</a> </li>
  <li><a href="bus_detalle_dia_dia.php" >Reportes</a>  </li>
  <li><a href="dia_dia_histo.php" >Historial</a> </li>
</ul>
  
</ul>
<p>&nbsp;</p>
<table width="100%" border="1" align="center" cellspacing="0">
  <tr bgcolor="#4D68A2" style="color: #FFF">
    <th width="10%">Factura</th>
    <th width="35%">Descripción</th>
    <th width="9%">Valor T.</th>
    <th width="17%">Cliente</th>
    <th width="13%">Fecha Pago</th>
    <th width="8%">Saldo</th>
    <th width="8%">Abonar</th>
  </tr>
  <?php do { ?>
   
      <tr align="center" id="fila_<? echo $row_pen['id']; ?>" onMouseOver="ResaltarFila('fila_<? echo $row_pen['id']; ?>');mano(this);"  onMouseOut="RestablecerFila('fila_<? echo $row_pen['id']; ?>')" >
        <td align="center" style="font-size: 16px; font-weight: bold;"><?php echo $row_pen['factura']; ?></td>
   
   
      <td align="left" style="font-size: 14px"><?php echo $row_pen['descrip']; ?></td>
      <td align="center" style="font-size: 16px; font-weight: bold;"><?php echo number_format (abs($row_pen['v_tal'])); ?></td>
      <td><?php echo $row_pen['cliente']; ?></td>
      <td align="center"><?php echo $row_pen['f_alarma']; ?></td>
      <td align="center" style="font-weight: bold"><?
	  //Detalle

$result = mysql_query("SELECT SUM(`v_tal`) as total FROM  d89xz_diario WHERE `factura` = '$row_pen[factura]' and estado ='Pendiente '"); 
$row = mysql_fetch_array($result, MYSQL_ASSOC);
$total=$row['total'];

$tal1 = abs($total);
//el total de abonos
$result = mysql_query("SELECT SUM(`abono`) as total FROM  d89xz_abonos WHERE  `orden` = '$row_pen[factura]'"); 
$row_abono = mysql_fetch_array($result, MYSQL_ASSOC);
$total_abono1=$row_abono['total'];
$total_abono2= abs($total_abono1);
// Saldo
	$saldo1 = $tal1 - $total_abono1;
	$saldo =  number_format($saldo1);
	  
	  echo $saldo;
	  
	  if ($saldo <= 0){
		  $insertar1 = mysql_query("UPDATE `d89xz_diario` SET `estado`= 'Cancelada' where `factura` = '$row_pen[factura]' ", $conexion);
	  }
	  
	   ?></td>
      <td align="center" style="font-weight: bold"><a href="detalle_abono.php?factura=<?php echo $row_pen['factura']; ?>"><img src="dinero.jpg" width="20" height="20" /></a></td>
    </tr>
    <?php } while ($row_pen = mysql_fetch_assoc($pen)); ?>
</table>
</body>
</html>
<?php
mysql_free_result($pen);
?>
