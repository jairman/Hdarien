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

$colname_w = "-1";
if (isset($_GET['id_vacuno'])) {
  $colname_w = $_GET['id_vacuno'];
}
mysql_select_db($database_conexion, $conexion);
$query_w = sprintf("SELECT * FROM d89xz_vacunos WHERE id_vacuno = %s", GetSQLValueString($colname_w, "text"));
$w = mysql_query($query_w, $conexion) or die(mysql_error());
$row_w = mysql_fetch_assoc($w);
$totalRows_w = mysql_num_rows($w);

$colname_act = "-1";
if (isset($_GET['id_vacuno'])) {
  $colname_act = $_GET['id_vacuno'];
}
mysql_select_db($database_conexion, $conexion);
$query_act = sprintf("SELECT `e_ingreso`, DATEDIFF( CURDATE(), `f_ingreso`)as e_actlb FROM d89xz_vacunos WHERE id_vacuno =%s", GetSQLValueString($colname_act, "int"));
$act = mysql_query($query_act, $conexion) or die(mysql_error());
$row_act = mysql_fetch_assoc($act);
$totalRows_act = mysql_num_rows($act);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Registro Vacuno</title>
<style type="text/css">
#seleccion table tr th {
	color: #FFF;
}
s {
	color: #FFF;
}
#s {
	color: #fff;
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
  <li><a href="kardex_busquedaM.php?vacuno=<?php echo $vacuno ?>&amp;id_vacuno=<?php echo $vacuno ?>" class="current">Informacion</a>  </li>
  <li><a href="editar_vacunoM.php?vacuno=<?php echo $vacuno ?>&amp;id_vacuno=<?php echo $vacuno ?>">Editar</a></li>
  <li onclick="return confirm('Realmente Desea Eliminar Vacuno');"><a href="eliminar_vacuno.php?vacuno=<?php echo $vacuno ?>">Eliminar</a>  </li>
 
</ul>

<table width="99%" border="0" align="center">
  <tr>
    <td width="244" align="left">&nbsp;</td>
    <td width="308" align="center"><a href="edit_reproduc_machos.php"><img src="last.png" alt="" width="29" height="31" border="0" /></a></td>
    <td width="239" align="right"><a href="javascript:imprSelec('seleccion')" ><img src="imprimir.png" alt="" width="36" height="35" 

border="0" align="right" /></a></td>
  </tr>
</table>
<DIV ID="seleccion">
  <p><img src="idsolutions--este.png" width="167" height="56" /></p>
<table width="99%" border="1">
  <tr>
    <th colspan="7" bgcolor="#4D68A2">Informacion General Vacuno</th>
  </tr>
  <tr>
    <th width="92" bgcolor="#4D68A2">ID</th>
    <th width="85" bgcolor="#4D68A2">Ingreso</th>
    <th width="101" bgcolor="#4D68A2">Edad In.(M)</th>
    <th width="75" bgcolor="#4D68A2">Raza</th>
    <th width="89" bgcolor="#4D68A2">Padre</th>
    <th width="68" bgcolor="#4D68A2">Madre</th>
    <th width="136" bgcolor="#4D68A2">Ubicacion</th>
  </tr>
 
<tr>
      <td><?php echo $row_w['id_vacuno']; ?></td>
      <td><?php echo $row_w['f_ingreso']; ?></td>
      <td align="center"><?php echo $row_w['e_ingreso']; ?></td>
      <td><?php echo $row_w['raza']; ?></td>
      <td><?php echo $row_w['padre']; ?></td>
      <td><?php echo $row_w['madre']; ?></td>
      <td><?php echo $row_w['ubicasion']; ?></td>
    </tr>
    <tr>
      <th bgcolor="#4D68A2">Hierro</th>
      <th bgcolor="#4D68A2">Sexo</th>
      <th bgcolor="#4D68A2">Clasificacion</th>
      <th bgcolor="#4D68A2">Registro</th>
      <th bgcolor="#4D68A2">F. DTT</th>
      <th bgcolor="#4D68A2">Clase</th>
      <th bgcolor="#4D68A2">Observasiones</th>
    </tr>
<tr>
      <td><?php echo $row_w['hierro']; ?></td>
      <td><?php echo $row_w['sexo']; ?></td>
      <td><?php echo $row_w['clasificasion']; ?></td>
      <td><?php echo $row_w['registro']; ?></td>
      <td><?php echo $row_w['f_dtt']; ?></td>
      <td><?php echo $row_w['clase']; ?></td>
      <td><?php echo $row_w['observasiones']; ?></td>
    </tr>
<tr>
  <th bgcolor="#4D68A2">Color</th>
  <td><?php echo $row_w['color']; ?></td>
  <td bgcolor="#4D68A2" id="s">Edad Actual(M)</td>
  <td align="center" bgcolor="#CDDCE1"><?php  echo (floor(($row_act['e_actlb'])/30) +($row_act['e_ingreso']) ); ?></td>
 
  <td>&nbsp;</td>
  <td>&nbsp;</td>
  <td>&nbsp;</td>
</tr>
   
</table>
<table width="99%" border="1">
  <tr>
    <th colspan="6" bgcolor="#4D68A2">Información Sanitaria</th>
  </tr>
  <tr>
    <th bgcolor="#4D68A2">ID</th>
    <th bgcolor="#4D68A2">Tratamiento</th>
    <th bgcolor="#4D68A2">Nombre T.</th>
    <th bgcolor="#4D68A2">Dosis</th>
    <th bgcolor="#4D68A2">Observ.</th>
    <th bgcolor="#4D68A2">Fecha</th>
  </tr>
  <?php do { ?>
    <tr>
      <td><?php echo $row_vcu['id_vacuno']; ?></td>
      <td><?php echo $row_vcu['jornada']; ?></td>
      <td><?php echo $row_vcu['diagnostico']; ?></td>
      <td><?php echo $row_vcu['tratamiento']; ?></td>
      <td><?php echo $row_vcu['observasion']; ?></td>
      <td><?php echo $row_vcu['fecha']; ?></td>
    </tr>
    <?php } while ($row_vcu = mysql_fetch_assoc($vcu)); ?>
</table>
<table width="99%" border="1">
  <tr>
    <th colspan="5" bgcolor="#4D68A2">Información  Pesajes</th>
  </tr>
  <tr>
    <th bgcolor="#4D68A2">ID</th>
    <th bgcolor="#4D68A2">Hierro</th>
    <th bgcolor="#4D68A2">Tipo Pesaje</th>
    <th bgcolor="#4D68A2">Peso</th>
    <th bgcolor="#4D68A2">Fecha</th>
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

</DIV>
<script type="text/javascript">
var MenuBar1 = new Spry.Widget.MenuBar("MenuBar1", {imgDown:"SpryAssets/SpryMenuBarDownHover.gif", imgRight:"SpryAssets/SpryMenuBarRightHover.gif"});
</script>
</body>
</html>
<?php
mysql_free_result($w);;

mysql_free_result($vcu);

mysql_free_result($act);

mysql_free_result($pes)


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