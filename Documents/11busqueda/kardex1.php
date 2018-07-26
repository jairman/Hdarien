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

$maxRows_kardex = 100;
$pageNum_kardex = 0;
if (isset($_GET['pageNum_kardex'])) {
  $pageNum_kardex = $_GET['pageNum_kardex'];
}
$startRow_kardex = $pageNum_kardex * $maxRows_kardex;

mysql_select_db($database_conexion, $conexion);
$query_kardex = "SELECT * FROM d89xz_vacunos";
$query_limit_kardex = sprintf("%s LIMIT %d, %d", $query_kardex, $startRow_kardex, $maxRows_kardex);
$kardex = mysql_query($query_limit_kardex, $conexion) or die(mysql_error());
$row_kardex = mysql_fetch_assoc($kardex);

if (isset($_GET['totalRows_kardex'])) {
  $totalRows_kardex = $_GET['totalRows_kardex'];
} else {
  $all_kardex = mysql_query($query_kardex);
  $totalRows_kardex = mysql_num_rows($all_kardex);
}
$totalPages_kardex = ceil($totalRows_kardex/$maxRows_kardex)-1;$maxRows_kardex = 10;
$pageNum_kardex = 0;
if (isset($_GET['pageNum_kardex'])) {
  $pageNum_kardex = $_GET['pageNum_kardex'];
}
$startRow_kardex = $pageNum_kardex * $maxRows_kardex;

mysql_select_db($database_conexion, $conexion);
$query_kardex = "SELECT * FROM d89xz_vacunos ORDER BY id_vacuno DESC";
$query_limit_kardex = sprintf("%s LIMIT %d, %d", $query_kardex, $startRow_kardex, $maxRows_kardex);
$kardex = mysql_query($query_limit_kardex, $conexion) or die(mysql_error());
$row_kardex = mysql_fetch_assoc($kardex);

if (isset($_GET['totalRows_kardex'])) {
  $totalRows_kardex = $_GET['totalRows_kardex'];
} else {
  $all_kardex = mysql_query($query_kardex);
  $totalRows_kardex = mysql_num_rows($all_kardex);
}
$totalPages_kardex = ceil($totalRows_kardex/$maxRows_kardex)-1;
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Documento sin t�tulo</title>
</head>

<body>
<table border="1" width="700">
  <tr>
    
    <th bgcolor="#c0e3e9">Vacuno</th>
    <th bgcolor="#c0e3e9">Raza</th>
    <th bgcolor="#c0e3e9">Sexo</th>
    <th bgcolor="#c0e3e9">Hierro</th>
    <th bgcolor="#c0e3e9">Ubicacion</th>
    <th bgcolor="#c0e3e9">Fecha Ingreso</th>
    
  </tr>
  <?php do { ?>
    <tr>
      <td><?php echo $row_kardex['id_vacuno']; ?></td>
      <td><?php echo utf8_encode($row_kardex['raza']); ?></td>
      <td><?php echo $row_kardex['sexo']; ?></td>
       <td><?php echo $row_kardex['hierro']; ?></td>
      <td><?php echo $row_kardex['ubicasion']; ?></td>
      <td><?php echo $row_kardex['f_ingreso']; ?></td>
      
      
      
    </tr>
    <?php } while ($row_kardex = mysql_fetch_assoc($kardex)); ?>
</table>
</body>
</html>
<?php
mysql_free_result($kardex);
?>
