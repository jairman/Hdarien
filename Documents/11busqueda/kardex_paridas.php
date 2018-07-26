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
$query_pd = "SELECT * FROM d89xz_vacunos WHERE tp_rep ='Vaca Parida' and leche ='si'";
$pd = mysql_query($query_pd, $conexion) or die(mysql_error());
$row_pd = mysql_fetch_assoc($pd);
$totalRows_pd = mysql_num_rows($pd);

//aca
mysql_select_db($database_conexion, $conexion);
$query_mes = "SELECT * FROM d89xz_meses";
$mes = mysql_query($query_mes, $conexion) or die(mysql_error());
$row_mes = mysql_fetch_assoc($mes);
$totalRows_mes = mysql_num_rows($mes);

mysql_select_db($database_conexion, $conexion);
$query_anos = "SELECT * FROM d89xz_anos";
$anos = mysql_query($query_anos, $conexion) or die(mysql_error());
$row_anos = mysql_fetch_assoc($anos);
$totalRows_anos = mysql_num_rows($anos);

mysql_select_db($database_conexion, $conexion);
$query_cli = "SELECT * FROM d89xz_clientes";
$cli = mysql_query($query_cli, $conexion) or die(mysql_error());
$row_cli = mysql_fetch_assoc($cli);
$totalRows_cli = mysql_num_rows($cli);



?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Documento sin título</title>
<style type="text/css">
#form1 table tr th {
	color: #FFF;
}
</style>




<style type="text/css">
.a {
	color: #FFF;
}
</style>
<script src="SpryAssets/SpryMenuBar.js" type="text/javascript"></script>
<link href="SpryAssets/SpryMenuBarHorizontal.css" rel="stylesheet" type="text/css" />
</head>

<body>
<ul id="MenuBar1" class="MenuBarHorizontal">
<li><a href="kardex_paridas.php" class="current">Lechería</a></li>
  <li><a href="kardex_paridas_dedus.php">Deducciones</a>  </li>
  <li><a href="kardex_paridas_semanal_total_leche.php">Generar Factura</a></li>
  <li><a href="kardex_paridas_histor.php">Historial</a></li>
</ul>
<p>&nbsp;</p>

<table width="100%" border="0" align="center" cellspacing="0">
  <tr>
    <td width="121" align="left" bgcolor="#f0f0f0">&nbsp;</td>
    <td width="121" align="left" bgcolor="#f0f0f0">&nbsp;</td>
    <td width="308" align="center" bgcolor="#f0f0f0">&nbsp;</td>
    <td width="239" align="right" bgcolor="#f0f0f0"><a href="javascript:imprSelec('seleccion')" ><img src="imprimir.png" alt="" width="36" height="35" border="0" align="right" /></a></td>
  </tr>
</table>
<DIV ID="seleccion">

<table width="100%" border="1" align="center" cellspacing="0">
  <tr class="a">
    <td colspan="7" bgcolor="#FFFFFF"><img src="idsolutions--este.png" width="162" height="59" /></td>
  </tr>
  <tr class="a">
    <th width="153" bgcolor="#4D68A2">ID</th>
    <th width="129" bgcolor="#4D68A2">Hierro</th>
    <th width="167" bgcolor="#4D68A2">Raza</th>
    <th width="132" bgcolor="#4D68A2">Color</th>
    <th width="140" bgcolor="#4D68A2">Clase</th>
    <th width="257" bgcolor="#4D68A2">Ubicacion</th>
    <th width="91" bgcolor="#4D68A2">Ingreso </th>
  </tr>
  <?php do { ?>
    <tr align="center">
      <td><a href="kardex_leche_indiv.php?vacuno=<?php echo $row_pd['id_vacuno']; ?>"><?php echo $row_pd['id_vacuno']; ?></a></td>
      <td><?php echo $row_pd['hierro']; ?></td>
      <td><?php echo $row_pd['raza']; ?></td>
      <td><?php echo $row_pd['color']; ?></td>
      <td><?php echo $row_pd['clase']; ?></td>
      <td><?php echo $row_pd['ubicasion']; ?></td>
      <td><a href="kardex_paridas_semanal.php?vacuno=<?php echo $row_pd['id_vacuno']; ?>&amp;hierro=<?php echo $row_pd['hierro']; ?>&amp;raza=<?php echo $row_pd['raza']; ?>">Semanal</a></td>
    </tr>
    <?php } while ($row_pd = mysql_fetch_assoc($pd)); ?>
</table>
<p>&nbsp;</p>

<script type="text/javascript">
var sprytextfield1 = new Spry.Widget.ValidationTextField("sprytextfield1", "none", {validateOn:["blur"]});
var MenuBar1 = new Spry.Widget.MenuBar("MenuBar1", {imgDown:"SpryAssets/SpryMenuBarDownHover.gif", imgRight:"SpryAssets/SpryMenuBarRightHover.gif"});
</script>


</body>
</html>
<?php
mysql_free_result($mes);

mysql_free_result($anos);

mysql_free_result($cli);
mysql_free_result($pd);
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



