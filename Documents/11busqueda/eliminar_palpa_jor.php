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

  
@$vacuno =$_GET['id_vacuno'];
@$hacien =$_GET['hacien'];
//$estado =$_GET['estado'];
@$jornada=$_GET['jpalpa'];

@$responsable =$_GET['responsable'];
@$estado=VOE;
@$cmpal=$_GET['cmpal'];
@$comen=$_POST['comen'];

@$jpalpa = $_GET['jpalpa'];
  @$respal= $_GET['respal'];
  @$cmpal = $_GET['cmpal'];
  @$raza1=$_GET['raza1'];
  @$color1 =$_GET['color1'];
  @$clase1 =$_GET['clase1'];
  @$hierro1=$_GET['hierro1'];

$colname_v = "-1";
if (isset($_GET['id_vacuno'])) {
  $colname_v = $_GET['id_vacuno'];
}
mysql_select_db($database_conexion, $conexion);
$query_v = sprintf("SELECT * FROM d89xz_vacunos WHERE id_vacuno = %s", GetSQLValueString($colname_v, "text"));
$v = mysql_query($query_v, $conexion) or die(mysql_error());
$row_v = mysql_fetch_assoc($v);
$totalRows_v = mysql_num_rows($v);
?>


<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Documento sin título</title>
</head>

<body>
<p></p>
<p>&nbsp;</p>
<p> </p>

  <?

  
@$vacuno =$_GET['id_vacuno'];
@$hacien =$_GET['hacien'];
//$estado =$_GET['estado'];
@$jornada=$_GET['jpalpa'];

@$responsable =$_GET['responsable'];
@$estado=VOE;
@$cmpal=$_GET['cmpal'];
@$comen=$_POST['comen'];

@$jpalpa = $_GET['jpalpa'];
  @$respal= $_GET['respal'];
  @$cmpal = $_GET['cmpal'];
  @$raza1=$_GET['raza1'];
  @$color1 =$_GET['color1'];
  @$clase1 =$_GET['clase1'];
  @$hierro1=$_GET['hierro1'];	


if ((isset($_GET['id_vacuno'])) && ($_GET['id_vacuno'] != "")) {
	
 $sql1 =mysql_query("UPDATE `d89xz_vacunos` SET `jpalpa`='' ,`respal`='',`cmpal`=''   WHERE `id_vacuno`='$vacuno'");

echo "<script type=''>


		window.location='jornada_palpacion+++.php?jpalpa=" . $row_v['jpalpa'] . "&respal=" .$respal. "&cmpal=" .$cmpal. "&raza1=" .$raza1. "&color1=" .$color1. "&clase1=" .$clase1. "&hierro1=" .$hierro1. "';
		
	
	</script>";
	

}

	?>
</body>

</html>
<script language="JavaScript">
<!--
       document.form1.comen.focus();

//-->
  </script>
<?php
mysql_free_result($v);
?>
