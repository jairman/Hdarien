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

if ((isset($_POST["MM_insert"])) && ($_POST["MM_insert"] == "form1")) {
  $insertSQL = sprintf("INSERT INTO d89xz_razas (raza) VALUES (%s)",
                       GetSQLValueString($_POST['raza'], "text"));

  mysql_select_db($database_conexion, $conexion);
  $Result1 = mysql_query($insertSQL, $conexion) or die(mysql_error());
}

$maxRows_razas = 110;
$pageNum_razas = 0;
if (isset($_GET['pageNum_razas'])) {
  $pageNum_razas = $_GET['pageNum_razas'];
}
$startRow_razas = $pageNum_razas * $maxRows_razas;

mysql_select_db($database_conexion, $conexion);
$query_razas = "SELECT * FROM d89xz_razas";
$query_limit_razas = sprintf("%s LIMIT %d, %d", $query_razas, $startRow_razas, $maxRows_razas);
$razas = mysql_query($query_limit_razas, $conexion) or die(mysql_error());
$row_razas = mysql_fetch_assoc($razas);

if (isset($_GET['totalRows_razas'])) {
  $totalRows_razas = $_GET['totalRows_razas'];
} else {
  $all_razas = mysql_query($query_razas);
  $totalRows_razas = mysql_num_rows($all_razas);
}
$totalPages_razas = ceil($totalRows_razas/$maxRows_razas)-1;
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
</head>

<body>
<a href="javascript:imprSelec('seleccion')" ><img src="imprimir.png" alt="" width="36" height="35" border="0" align="right" /></a>

<DIV ID="seleccion">

<img src="idsolutions--este.png" width="162" height="59" />
<form action="<?php echo $editFormAction; ?>" method="post" name="form1" id="form1">
  <table width="426" border="1">
    <tr>
      <td colspan="3" bgcolor="#4D68A2">&nbsp;</td>
    </tr>
    <tr>
      <td width="147"><strong>Ingrese Razas</strong></td>
      <td width="199"><input type="text" name="raza" value="" size="32" /></td>
      <td width="58"><input type="submit" value="Enviar" /></td>
    </tr>
  </table>
  <p>
    <input type="hidden" name="MM_insert" value="form1" />
  </p>
</form>
<table width="426" border="1">
  <tr class="c">
    <th width="196" bgcolor="#4D68A2"><strong>Raza Existentes</strong></th>
    <th width="62" bgcolor="#4D68A2">Eliminar</th>
  </tr>
  <?php do { ?>
    <tr>
      <td align="center"><?php echo utf8_encode($row_razas['raza']); ?></td>
      <td align="center"><a href="eliminar_razas.php?id=<?php echo $row_razas['id']; ?>">Eliminar</a></td>
    </tr>
    <?php } while ($row_razas = mysql_fetch_assoc($razas)); ?>
</table>
</body>
</html>
<?php
mysql_free_result($razas);
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