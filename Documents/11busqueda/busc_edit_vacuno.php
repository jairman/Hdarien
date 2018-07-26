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

$colname_vcn = "-1";
if (isset($_POST['vacuno'])) {
  $colname_vcn = $_POST['vacuno'];
}
mysql_select_db($database_conexion, $conexion);
$query_vcn = sprintf("SELECT * FROM d89xz_vacunos WHERE id_vacuno = %s", GetSQLValueString($colname_vcn, "text"));
$vcn = mysql_query($query_vcn, $conexion) or die(mysql_error());
$row_vcn = mysql_fetch_assoc($vcn);
$totalRows_vcn = mysql_num_rows($vcn);
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
.z {
	color: #FFF;
}
</style>
</head>

<body>
<p><img src="idsolutions--este.png" width="162" height="59" /></p>
<form id="form1" name="form1" method="post" action="">
  <table width="454" border="1">
    <tr>
      <th width="73" bgcolor="#4D68A2">Ingrese ID  </th>
      <th width="176" bgcolor="#4D68A2"><label for="vacuno"></label>
      <input type="text" name="vacuno" id="vacuno" /></th>
      <th width="113" bgcolor="#4D68A2"><input type="submit" name="button" id="button" value="Buscar Vacuno" /></th>
    </tr>
  </table>
</form>


<table width="454" border="1">
  <tr class="z">
    <th bgcolor="#4D68A2">ID</th>
    <th bgcolor="#4D68A2">Raza</th>
    <th bgcolor="#4D68A2">Color</th>
    <th bgcolor="#4D68A2">Sexo</th>
    <th bgcolor="#4D68A2">Modificar</th>
    <th bgcolor="#4D68A2">Eliminar</th>
  </tr>
  <?php do { ?>
    <tr>
      <td><?php echo $row_vcn['id_vacuno']; ?></td>
      <td><?php echo $row_vcn['raza']; ?></td>
      <td><?php echo $row_vcn['color']; ?></td>
      <td><?php echo $row_vcn['sexo']; ?></td>
      <th><a href="editar_vacuno.php?vacuno=<?php echo $row_vcn['id_vacuno']; ?>">Modificar</a></th>
      <th><a href="eliminar_vacuno.php?vacuno=<?php echo $row_vcn['id_vacuno']; ?>">Eliminar</a></th>
    </tr>
    <?php } while ($row_vcn = mysql_fetch_assoc($vcn)); ?>
</table>
</body>
</html>
<?php
mysql_free_result($vcn);
?>
