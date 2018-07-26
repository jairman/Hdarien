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

$editFormAction = $_SERVER['PHP_SELF'];
if (isset($_SERVER['QUERY_STRING'])) {
  $editFormAction .= "?" . htmlentities($_SERVER['QUERY_STRING']);
}

if ((isset($_POST["MM_update"])) && ($_POST["MM_update"] == "form1")) {
	
$diab=trim(strip_tags($_POST['dia']));
$mesb=trim(strip_tags($_POST['mes']));
$anob=trim(strip_tags($_POST['anos']));
$f_final=$anob.'-'.$mesb.'-'.$diab;
	
	
	
  $updateSQL = sprintf("UPDATE d89xz_diario SET estado=%s , f_alarma =%s WHERE id=%s",
                       GetSQLValueString($_POST['estado'], "text"),
					   GetSQLValueString($f_final, "text"),
                       GetSQLValueString($_POST['id'], "int"));

  mysql_select_db($database_conexion, $conexion);
  $Result1 = mysql_query($updateSQL, $conexion) or die(mysql_error());

  $updateGoTo = "dia_dia_pendiente.php";
  if (isset($_SERVER['QUERY_STRING'])) {
    $updateGoTo .= (strpos($updateGoTo, '?')) ? "&" : "?";
    $updateGoTo .= $_SERVER['QUERY_STRING'];
  }
  header(sprintf("Location: %s", $updateGoTo));
}

$colname_diar = "-1";
if (isset($_GET['id'])) {
  $colname_diar = $_GET['id'];
}
mysql_select_db($database_conexion, $conexion);
$query_diar = sprintf("SELECT * FROM d89xz_diario WHERE id = %s", GetSQLValueString($colname_diar, "int"));
$diar = mysql_query($query_diar, $conexion) or die(mysql_error());
$row_diar = mysql_fetch_assoc($diar);
$totalRows_diar = mysql_num_rows($diar);

mysql_select_db($database_conexion, $conexion);
$query_dia = "SELECT dias FROM d89xz_dias";
$dia = mysql_query($query_dia, $conexion) or die(mysql_error());
$row_dia = mysql_fetch_assoc($dia);
$totalRows_dia = mysql_num_rows($dia);

mysql_select_db($database_conexion, $conexion);
$query_mes = "SELECT meses FROM d89xz_meses";
$mes = mysql_query($query_mes, $conexion) or die(mysql_error());
$row_mes = mysql_fetch_assoc($mes);
$totalRows_mes = mysql_num_rows($mes);

mysql_select_db($database_conexion, $conexion);
$query_anos = "SELECT anos FROM d89xz_anos";
$anos = mysql_query($query_anos, $conexion) or die(mysql_error());
$row_anos = mysql_fetch_assoc($anos);
$totalRows_anos = mysql_num_rows($anos);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Documento sin título</title>
<style type="text/css">
#form1 table tr td {
	color: #FFF;
}
</style>
</head>

<body>
<form action="<?php echo $editFormAction; ?>" method="post" name="form1" id="form1">
  <table width="350" border="1" align="center" cellspacing="0">
    <tr valign="baseline">
      <td width="100" align="left" nowrap="nowrap" bgcolor="#4D68A2">ID</td>
      <td width="150" bgcolor="#4D68A2"><?php echo $row_diar['id']; ?></td>
    </tr>
    <tr valign="baseline">
      <td align="left" nowrap="nowrap" bgcolor="#FFFFFF" style="color: #000">Estado:</td>
      <td bgcolor="#FFFFFF"><input type="text" name="estado1" value="<?php echo htmlentities($row_diar['estado'], ENT_COMPAT, 'utf-8'); ?>" size="25" /></td>
    </tr>
    <tr valign="baseline">
      <td align="left" nowrap="nowrap" bgcolor="#FFFFFF" style="color: #000">Cambiar Por</td>
      <td bgcolor="#FFFFFF"><label for="estado"></label>
        <select name="estado" id="estado" style="width:200px">
          <option value="Pendiente">Pendiente</option>
          <option value="Pago">Pago</option>
      </select></td>
    </tr>
    <tr valign="baseline">
      <th colspan="2" align="center" nowrap="nowrap" bgcolor="#FFFFFF"><input type="image" src="modificar.png"  onmouseover="src='modificar1.png';"  onmouseout="src='modificar.png';" value="Insertar Clientes" alt="aceptar" /></th>
    </tr>
  </table>
  <input type="hidden" name="MM_update" value="form1" />
  <input type="hidden" name="id" value="<?php echo $row_diar['id']; ?>" />
</form>
<p>&nbsp;</p>
</body>
</html>
<?php
mysql_free_result($diar);

mysql_free_result($dia);

mysql_free_result($mes);

mysql_free_result($anos);
?>
