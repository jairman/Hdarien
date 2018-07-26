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

$colname_idv = "-1";
if (isset($_GET['id_vacuno'])) {
  $colname_idv = $_GET['id_vacuno'];
}


mysql_select_db($database_conexion, $conexion);
$query_idv = sprintf("SELECT * FROM d89xz_vacunos WHERE madre = %s", GetSQLValueString($colname_idv, "text"));
$idv = mysql_query($query_idv, $conexion) or die(mysql_error());
$row_idv = mysql_fetch_assoc($idv);
$totalRows_idv = mysql_num_rows($idv);

$colname_reg = "-1";
if (isset($_GET['id_vacuno'])) {
  $colname_reg = $_GET['id_vacuno'];
}
mysql_select_db($database_conexion, $conexion);
$query_reg = sprintf("SELECT * FROM d89xz_vacunos WHERE id_vacuno = %s", GetSQLValueString($colname_reg, "text"));
$reg = mysql_query($query_reg, $conexion) or die(mysql_error());
$row_reg = mysql_fetch_assoc($reg);
$totalRows_reg = mysql_num_rows($reg);

$maxRows_ins = 1;
$pageNum_ins = 0;
if (isset($_GET['pageNum_ins'])) {
  $pageNum_ins = $_GET['pageNum_ins'];
}
$startRow_ins = $pageNum_ins * $maxRows_ins;

$colname_ins = "-1";
if (isset($_GET['id_vacuno'])) {
  $colname_ins = $_GET['id_vacuno'];
}
mysql_select_db($database_conexion, $conexion);
$query_ins = sprintf("SELECT * FROM d89xz_inseminacion WHERE vaca = %s ORDER BY id DESC", GetSQLValueString($colname_ins, "text"));
$query_limit_ins = sprintf("%s LIMIT %d, %d", $query_ins, $startRow_ins, $maxRows_ins);
$ins = mysql_query($query_limit_ins, $conexion) or die(mysql_error());
$row_ins = mysql_fetch_assoc($ins);

if (isset($_GET['totalRows_ins'])) {
  $totalRows_ins = $_GET['totalRows_ins'];
} else {
  $all_ins = mysql_query($query_ins);
  $totalRows_ins = mysql_num_rows($all_ins);
}
$totalPages_ins = ceil($totalRows_ins/$maxRows_ins)-1;

$colname_pal = "-1";
if (isset($_GET['id_vacuno'])) {
  $colname_pal = $_GET['id_vacuno'];
}
mysql_select_db($database_conexion, $conexion);
$query_pal = sprintf("SELECT * FROM d89xz_detalle_palpacion WHERE vaca = %s", GetSQLValueString($colname_pal, "text"));
$pal = mysql_query($query_pal, $conexion) or die(mysql_error());
$row_pal = mysql_fetch_assoc($pal);
$totalRows_pal = mysql_num_rows($pal);

$colname_inse = "-1";
if (isset($_GET['id_vacuno'])) {
  $colname_inse = $_GET['id_vacuno'];
}
mysql_select_db($database_conexion, $conexion);
$query_inse = sprintf("SELECT * FROM d89xz_detalle_inseminacion WHERE vaca = %s", GetSQLValueString($colname_inse, "text"));
$inse = mysql_query($query_inse, $conexion) or die(mysql_error());
$row_inse = mysql_fetch_assoc($inse);
$totalRows_inse = mysql_num_rows($inse);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Reproductora</title>


<style type="text/css">
#form1 table tr th {
	color: #FFF;
}
ss {
	color: #000;
}
#seleccion #form1 table {
	font-weight: bold;
}
.xx {
	color: #000;
}
</style>

<script src="SpryAssets/SpryMenuBar.js" type="text/javascript"></script>
<link href="SpryAssets/SpryMenuBarHorizontal.css" rel="stylesheet" type="text/css" />

</head>

<body>
<? 
@$vacuno=$_GET['vacuno'];

?>
<ul id="MenuBar1" class="MenuBarHorizontal" >
  <li><a href="krdex_reprod.php?vacuno=<?php echo $vacuno ?>&amp;id_vacuno=<?php echo $vacuno ?>" >Informacion</a>  </li>
  <li><a href="krdex_reprod_insemin.php?vacuno=<?php echo $vacuno ?>&amp;id_vacuno=<?php echo $vacuno ?>" class="current">Detalle inseminaci&oacute;n</a></li>
   <li><a href="krdex_reprod_palp.php?vacuno=<?php echo $vacuno ?>&amp;id_vacuno=<?php echo $vacuno ?>" >Detalle Palpaci&oacute;n</a></li>
</ul>

  
  <table width="99%" border="0" align="center">
  <tr>
    <td width="121" align="left">&nbsp;</td>
    <td width="121" align="left">&nbsp;</td>
    <td width="308" align="center"><a href="krdex_reprod.php"><img src="last.png" alt="" width="29" height="31" border="0" /></a></td>
    <td width="239" align="right"><a href="javascript:imprSelec('seleccion')" ><img src="imprimir.png" alt="" width="36" height="35" 

border="0" align="right" /></a></td>
  </tr>
</table>

<DIV ID="seleccion">
<p><img src="idsolutions--este.png" width="162" height="59" />
  
</p>
<form id="form1" name="form1" method="post" action="">
  <table width="99%" border="1" align="center">
    <tr>
      <th colspan="4" bgcolor="#4D68A2">Detalle inseminación</th>
      </tr>
    <tr>
      <td align="center">Vaca</td>
      <td align="center">Toro de Servicio</td>
      <td align="center">Tipo  de Servicio</td>
      <th>F<span class="xx">Fecha de Servicio</span></th>
    </tr>
    <?php do { ?>
      <tr>
        <td align="center"><?php echo $row_inse['vaca']; ?></td>
        <td align="center"><?php echo $row_inse['toro']; ?></td>
        <td align="center"><?php echo $row_inse['t_serv']; ?></td>
        <td align="center"><?php echo $row_inse['f_serv']; ?></td>
      </tr>
      <?php } while ($row_inse = mysql_fetch_assoc($inse)); ?>
</table>
  <p>&nbsp;</p>
</form>
</DIV>
</body>
</html>
<?php
mysql_free_result($idv);

mysql_free_result($reg);

mysql_free_result($ins);

mysql_free_result($pal);

mysql_free_result($inse);
?>

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
<script type="text/javascript">
var MenuBar1 = new Spry.Widget.MenuBar("MenuBar1", {imgDown:"SpryAssets/SpryMenuBarDownHover.gif", imgRight:"SpryAssets/SpryMenuBarRightHover.gif"});
</script>