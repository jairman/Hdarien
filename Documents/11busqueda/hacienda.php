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
}

$maxRows_hacienda = 10;
$pageNum_hacienda = 0;
if (isset($_GET['pageNum_hacienda'])) {
  $pageNum_hacienda = $_GET['pageNum_hacienda'];
}
$startRow_hacienda = $pageNum_hacienda * $maxRows_hacienda;

mysql_select_db($database_conexion, $conexion);
$query_hacienda = "SELECT empresa, nit, telefono, hacienda, departamento, municipio, extension, latitud, longitud, temperatura FROM d89xz_hacienda";
$query_limit_hacienda = sprintf("%s LIMIT %d, %d", $query_hacienda, $startRow_hacienda, $maxRows_hacienda);
$hacienda = mysql_query($query_limit_hacienda, $conexion) or die(mysql_error());
$row_hacienda = mysql_fetch_assoc($hacienda);

if (isset($_GET['totalRows_hacienda'])) {
  $totalRows_hacienda = $_GET['totalRows_hacienda'];
} else {
  $all_hacienda = mysql_query($query_hacienda);
  $totalRows_hacienda = mysql_num_rows($all_hacienda);
}
$totalPages_hacienda =  10;
$pageNum_hacienda = 0;
if (isset($_GET['pageNum_hacienda'])) {
  $pageNum_hacienda = $_GET['pageNum_hacienda'];
}
$startRow_hacienda = $pageNum_hacienda * $maxRows_hacienda;

mysql_select_db($database_conexion, $conexion);
$query_hacienda = "SELECT * FROM d89xz_hacienda";
$query_limit_hacienda = sprintf("%s LIMIT %d, %d", $query_hacienda, $startRow_hacienda, $maxRows_hacienda);
$hacienda = mysql_query($query_limit_hacienda, $conexion) or die(mysql_error());
$row_hacienda = mysql_fetch_assoc($hacienda);

if (isset($_GET['totalRows_hacienda'])) {
  $totalRows_hacienda = $_GET['totalRows_hacienda'];
} else {
  $all_hacienda = mysql_query($query_hacienda);
  $totalRows_hacienda = mysql_num_rows($all_hacienda);
}
$totalPages_hacienda = ceil($totalRows_hacienda/$maxRows_hacienda)-1;

$maxRows_empre = 10;
$pageNum_empre = 0;
if (isset($_GET['pageNum_empre'])) {
  $pageNum_empre = $_GET['pageNum_empre'];
}
$startRow_empre = $pageNum_empre * $maxRows_empre;

mysql_select_db($database_conexion, $conexion);
$query_empre = "SELECT empresa, nit, telefono FROM d89xz_empresa";
$query_limit_empre = sprintf("%s LIMIT %d, %d", $query_empre, $startRow_empre, $maxRows_empre);
$empre = mysql_query($query_limit_empre, $conexion) or die(mysql_error());
$row_empre = mysql_fetch_assoc($empre);

if (isset($_GET['totalRows_empre'])) {
  $totalRows_empre = $_GET['totalRows_empre'];
} else {
  $all_empre = mysql_query($query_empre);
  $totalRows_empre = mysql_num_rows($all_empre);
}
$totalPages_empre = ceil($totalRows_empre/$maxRows_empre)-1;
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Documento sin título</title>
<style type="text/css">
.c {
	color: #FFF;
}
</style>
 <style> 
a{text-decoration:none} 
</style>
</head>
<script src="SpryAssets/SpryMenuBar.js" type="text/javascript"></script>
<link href="SpryAssets/SpryMenuBarHorizontal.css" rel="stylesheet" type="text/css" />
<body>
<ul id="MenuBar1" class="MenuBarHorizontal">
 <li><a href="hacienda.php" class="current">Empresa</a>  </li>
  <li><a href="clientes_kardex.php" >Clientes</a> </li>
  <li><a href="prove_kardex.php">Proveedores</a></li>
  <li><a href="regis_empleados.php">Empleados</a>  </li>

  
</ul>
 <p>&nbsp;</p>
 <ul id="MenuBar1" class="MenuBarHorizontal">
 
    <li><a href="ingreso_empresa.php" class="current">Registro Empresa</a></li>

  
</ul>
 <p>&nbsp;</p>
 <DIV ID="seleccion">
</p>
<table width="100%" border="0" align="center" cellspacing="0">
  <tr bgcolor="#f0f0f0">
    <td width="244" align="left">&nbsp;</td>
    <td width="308" align="center">&nbsp;</td>
    <td width="239" align="right"><a href="javascript:imprSelec('seleccion')" ><img src="imprimir.png" alt="" width="36" height="35" 

border="0" align="right" /></a></td>
  </tr>
</table>
<DIV ID="seleccion">
<table width="100%" border="1" align="center" cellspacing="0">
  <tr class="c">
    <td colspan="3" bgcolor="#FFFFFF"><img src="idsolutions--este.png" width="162" height="59" /></td>
  </tr>
  <tr class="c">
    <th bgcolor="#4D68A2"><strong>Empresa</strong></th>
     <th bgcolor="#4D68A2"><strong>Nit</strong></th>
     <th bgcolor="#4D68A2"><strong>Telefono</strong></th>
   
  </tr>
  <?php do { ?>
    <tr align="center">
      <td><a href="editar_ empresa.php?empresa=<?php echo $row_empre['empresa']; ?>"><?php echo $row_empre['empresa']; ?></a></td>
      <td><?php echo $row_empre['nit']; ?></td>
      <td><?php echo $row_empre['telefono']; ?></td>
    </tr>
    <?php } while ($row_empre = mysql_fetch_assoc($empre)); ?>
</table>
</DIV>



</body>
</html>
<?php
mysql_free_result($hacienda);

mysql_free_result($empre);
?>
<script type="text/javascript">
var MenuBar1 = new Spry.Widget.MenuBar("MenuBar1", {imgDown:"SpryAssets/SpryMenuBarDownHover.gif", imgRight:"SpryAssets/SpryMenuBarRightHover.gif"});
</script>

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