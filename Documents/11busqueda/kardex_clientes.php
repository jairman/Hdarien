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
<?php require_once('../Connections/import.php'); ?>
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

mysql_select_db($database_import, $import);
$query_cl = "SELECT * FROM d89xz_clientes_proim";
$cl = mysql_query($query_cl, $import) or die(mysql_error());
$row_cl = mysql_fetch_assoc($cl);
$totalRows_cl = mysql_num_rows($cl);mysql_select_db($database_import, $import);
$query_cl = "SELECT * FROM d89xz_clientes_proim";
$cl = mysql_query($query_cl, $import) or die(mysql_error());
$row_cl = mysql_fetch_assoc($cl);
$totalRows_cl = mysql_num_rows($cl);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Documento sin título</title>
<style type="text/css">
#c {
	color: #FFF;
}
</style>
</head>

<body>
<p><img src="Logo-01.png" width="419" height="143" /><img src="Profesionales en importacio_n.png" width="419" height="143" /></p>
<table width="900" border="1" align="center">
  <tr bgcolor="#54B948" id="c">
    <th width="136">Nombre</th>
    <th width="165" bgcolor="#54B948">Apellido</th>
    <th width="174">  Email </th>
    <th width="108">Teléfono</th>
    <th width="89">Celular</th>
    <th width="77">Tipo P.</th>
    <th width="41">Editar</th>
    <th width="58">Historial</th>
  </tr>
  <?php do { ?>
    <tr align="center">
      <td><a href="detalle_cliente-php.php?docu=<?php echo $row_cl['docu']; ?>"><?php echo $row_cl['nombre']; ?></a></td>
      <td><?php echo $row_cl['apellido']; ?></td>
      <td><?php echo $row_cl['correo']; ?></td>
      <td><?php echo $row_cl['tel']; ?></td>
      <td><?php echo $row_cl['cel']; ?></td>
      <td width="77"><?php echo $row_cl['persone']; ?></td>
      <td width="41"><a href="editar_cliente.php?docu=<?php echo $row_cl['docu']; ?>">Editar</a></td>
      <td width="58"><a href="historial_cliente.php?docum=<?php echo $row_cl['correo']; ?>">Historial</a></td>
    </tr>
    <?php } while ($row_cl = mysql_fetch_assoc($cl)); ?>
</table>
</body>
</html>
<?php
mysql_free_result($cl);
?>
