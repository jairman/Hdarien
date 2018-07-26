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

$colname_v = "-1";
if (isset($_GET['id_vacuno'])) {
  $colname_v = $_GET['id_vacuno'];
}
mysql_select_db($database_conexion, $conexion);
$query_v = sprintf("SELECT * FROM d89xz_vacunos WHERE id_vacuno = %s", GetSQLValueString($colname_v, "text"));
$v = mysql_query($query_v, $conexion) or die(mysql_error());
$row_v = mysql_fetch_assoc($v);
$totalRows_v = mysql_num_rows($v);$colname_v = "-1";
if (isset($_GET['id_vacuno'])) {
  $colname_v = $_GET['id_vacuno'];
}
mysql_select_db($database_conexion, $conexion);
$query_v = sprintf("SELECT * FROM d89xz_vacunos WHERE id_vacuno = %s", GetSQLValueString($colname_v, "text"));
$v = mysql_query($query_v, $conexion) or die(mysql_error());
$row_v = mysql_fetch_assoc($v);
$totalRows_v = mysql_num_rows($v);

$colname_vcu = "-1";
if (isset($_GET['id_vacuno'])) {
  $colname_vcu = $_GET['id_vacuno'];
}
mysql_select_db($database_conexion, $conexion);
$query_vcu = sprintf("SELECT * FROM d89xz_vacunasion WHERE id_vacuno = %s ORDER BY fecha DESC", GetSQLValueString($colname_vcu, "int"));
$vcu = mysql_query($query_vcu, $conexion) or die(mysql_error());
$row_vcu = mysql_fetch_assoc($vcu);
$totalRows_vcu = mysql_num_rows($vcu);

$colname_pes = "-1";
if (isset($_GET['id_vacuno'])) {
  $colname_pes = $_GET['id_vacuno'];
}
mysql_select_db($database_conexion, $conexion);
$query_pes = sprintf("SELECT * FROM d89xz_pesos WHERE id_vacuno = %s ORDER BY fecha DESC", GetSQLValueString($colname_pes, "int"));
$pes = mysql_query($query_pes, $conexion) or die(mysql_error());
$row_pes = mysql_fetch_assoc($pes);
$totalRows_pes = mysql_num_rows($pes);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Registro Vacuno</title>

<a href="javascript:window.print()"
<a href="diario.php"><img src="imprimir.png" alt="" width="36" height="35" border="0" align="right" /></a>
</head>

<body>

<p><img src="idsolutions--este.png" width="162" height="59" /></p>
<table width="692" border="1">
  <tr>
    <th colspan="7" bgcolor="#c0e3e9">Informacion General Vacuno</th>
  </tr>
  <tr>
    <th width="88" bgcolor="#c0e3e9">ID</th>
    <th width="81" bgcolor="#c0e3e9">Ingreso</th>
    <th width="84" bgcolor="#c0e3e9">Edad(M)</th>
    <th width="71" bgcolor="#c0e3e9">Raza</th>
    <th width="61" bgcolor="#c0e3e9">Padre</th>
    <th width="91" bgcolor="#c0e3e9">Madre</th>
    <th width="170" bgcolor="#c0e3e9">Ubicacion</th>
  </tr>
  <?php do { ?>
    <tr>
      <td><?php echo $row_v['id_vacuno']; ?></td>
      <td><?php echo $row_v['f_ingreso']; ?></td>
      <td><?php echo $row_v['e_ingreso']; ?></td>
      <td><?php echo $row_v['raza']; ?></td>
      <td><?php echo $row_v['padre']; ?></td>
      <td><?php echo $row_v['madre']; ?></td>
      <td><?php echo $row_v['ubicasion']; ?></td>
    </tr>
    <tr>
      <th bgcolor="#c0e3e9">Hierro</th>
      <th bgcolor="#c0e3e9">Sexo</th>
      <th bgcolor="#c0e3e9">Clasificacion</th>
      <th bgcolor="#c0e3e9">Registro</th>
      <th bgcolor="#c0e3e9">F. DTT</th>
      <th bgcolor="#c0e3e9">Clase</th>
      <th bgcolor="#c0e3e9">Observasiones</th>
    </tr>
    <tr>
      <td><?php echo $row_v['hierro']; ?></td>
      <td><?php echo $row_v['sexo']; ?></td>
      <td><?php echo $row_v['clasificasion']; ?></td>
      <td><?php echo $row_v['registro']; ?></td>
      <td><?php echo $row_v['f_dtt']; ?></td>
      <td><?php echo $row_v['reproductoras']; ?></td>
      <td><?php echo $row_v['observasiones']; ?></td>
    </tr>
    <?php } while ($row_v = mysql_fetch_assoc($v)); ?>
</table>
<p>&nbsp;</p>
<table width="692" border="1">
  <tr>
    <th colspan="6" bgcolor="#c0e3e9">Información Fito  Sanitaria</th>
  </tr>
  <tr>
    <th bgcolor="#c0e3e9">ID</th>
    <th bgcolor="#c0e3e9">Jornada</th>
    <th bgcolor="#c0e3e9">Diagnostico</th>
    <th bgcolor="#c0e3e9">Tratamiento</th>
    <th bgcolor="#c0e3e9">Observ.</th>
    <th bgcolor="#c0e3e9">Fecha</th>
  </tr>
  <?php do { ?>
    <tr>
      <td><?php echo $row_vcu['id_vacuno']; ?></td>
      <td><?php echo $row_vcu['jornada']; ?></td>
      <td><?php echo $row_vcu['diagnostico']; ?></td>
      <td><?php echo $row_vcu['tratamiento']; ?></td>
      <td><?php echo $row_vcu['fecha']; ?></td>
      <td><?php echo $row_vcu['fecha']; ?></td>
    </tr>
    <?php } while ($row_vcu = mysql_fetch_assoc($vcu)); ?>
</table>
<p>&nbsp;</p>
<table width="692" border="1">
  <tr>
    <th colspan="5" bgcolor="#c0e3e9">Información  Pesajes</th>
  </tr>
  <tr>
    <th bgcolor="#c0e3e9">ID</th>
    <th bgcolor="#c0e3e9">Hierro</th>
    <th bgcolor="#c0e3e9">Tipo Pesaje</th>
    <th bgcolor="#c0e3e9">Peso</th>
    <th bgcolor="#c0e3e9">Fecha</th>
  </tr>
  <?php do { ?>
    <tr>
      <td><?php echo $row_pes['id_vacuno']; ?></td>
      <td><?php echo $row_pes['hierro']; ?></td>
      <td><?php echo $row_pes['tipo_pesaje']; ?></td>
      <td><?php echo $row_pes['peso']; ?></td>
      <td><?php echo $row_pes['fecha']; ?></td>
    </tr>
    <?php } while ($row_pes = mysql_fetch_assoc($pes)); ?>
</table>


  
</body>
</html>
<?php
mysql_free_result($v);;

mysql_free_result($vcu);

mysql_free_result($pes);
?>
