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
$query_dias = "SELECT dias FROM d89xz_dias";
$dias = mysql_query($query_dias, $conexion) or die(mysql_error());
$row_dias = mysql_fetch_assoc($dias);
$totalRows_dias = mysql_num_rows($dias);

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
<script src="SpryAssets/SpryValidationSelect.js" type="text/javascript"></script>
<link href="SpryAssets/SpryValidationSelect.css" rel="stylesheet" type="text/css" />
</head>

<body>
<img src="idsolutions--este.png" width="162" height="59" />
<form id="form1" name="form1" method="post" action="">
  <table width="423" border="1">
    <tr>
      <td colspan="3" bgcolor="#4D68A2">&nbsp;</td>
    </tr>
    <tr>
      <td width="194">Estado De Parto</td>
      <td width="213"><span id="spryselect4">
        <label for="select2"></label>
        <select name="estado" id="select2">
          <option>Seleccione</option>
          <option value="Si">Si</option>
          <option value="No ">No </option>
        </select>
      </span></td>
      <td width="51"><input type="submit" name="button" id="button" value="Enviar" /></td>
    </tr>
  </table>
</form>
<script type="text/javascript">
var spryselect4 = new Spry.Widget.ValidationSelect("spryselect4", {validateOn:["blur"]});
</script>
</body>
</html>
<?php
mysql_free_result($dias);

mysql_free_result($mes);

mysql_free_result($anos);
?>


<?
$id =$_GET['id'];
$vaca =$_GET['vaca'];
$estado=$_POST['estado'];
$diab=trim(strip_tags($_POST['dia']));
$mesb=trim(strip_tags($_POST['mes']));
$anob=trim(strip_tags($_POST['anos']));
$fecha_palpa=$anob.'-'.$mesb.'-'.$diab;

?>
<?

if ($estado!= "" ){
 
  		
	//$sql =mysql_query( "UPDATE d89xz_vacunos SET `ubicasion` = '$select_destino' WHERE `id_vacuno`= $id_vacuno");

$sql1 =mysql_query("UPDATE d89xz_inseminacion SET `pario`='$estado'  WHERE `id`='$id'");
			
	echo "<font size=13 color='#0000FF'>Registro  Exitoso</font>";
		
}
	   
?>	   