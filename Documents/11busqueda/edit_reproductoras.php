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
$query_hm = "SELECT id_vacuno, raza, madre, hierro, clase, ubicasion, reprd, tp_rep FROM d89xz_vacunos WHERE sexo = 'hembra'  ORDER BY id_vacuno ASC";
$hm = mysql_query($query_hm, $conexion) or die(mysql_error());
$row_hm = mysql_fetch_assoc($hm);
$totalRows_hm = mysql_num_rows($hm);

mysql_select_db($database_conexion, $conexion);
$query_ed = "SELECT `e_ingreso`, DATEDIFF( CURDATE(), `f_ingreso`)as e_actlb FROM d89xz_vacunos WHERE sexo = 'hembra' ORDER BY id_vacuno ASC";
$ed = mysql_query($query_ed, $conexion) or die(mysql_error());
$row_ed = mysql_fetch_assoc($ed);
$totalRows_ed = mysql_num_rows($ed);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Documento sin título</title>
<style type="text/css">
.s {
	color: #FFF;
}
</style>
</head>

<body>
<a href="javascript:imprSelec('seleccion')" ><img src="imprimir.png" alt="" width="36" height="35" border="0" align="right" /></a>

<DIV ID="seleccion">

<p><img src="idsolutions--este.png" width="162" height="59" /></p>
<table width="692" border="1">
  <tr class="s">
    <th width="99" bgcolor="#4D68A2">ID </th>
    <th width="72" bgcolor="#4D68A2">Hierro</th>
    <th width="106" bgcolor="#4D68A2">Raza</th>
    <th width="78" bgcolor="#4D68A2">Clase</th>
    <th width="78" bgcolor="#4D68A2">Edad(M)</th>
    <th width="138" bgcolor="#4D68A2">Estado</th>
    <th width="159" bgcolor="#4D68A2">Ubicacion </th>
  </tr>
  <?php do {?>
    <tr>
      <td align="center"><a href="krdex_reprod.php?id_vacuno=<?php echo $row_hm['id_vacuno']; ?>"><?php echo $row_hm['id_vacuno']; ?></a></td>
      <td><?php echo $row_hm['hierro']; ?></td>
      <td><?php echo $row_hm['raza']; ?></td>
      <td><?php echo $row_hm['clase']; ?></td>
      <td align="center"><?php echo (floor(($row_ed['e_actlb'])/30) +($row_ed['e_ingreso']) ); ?></td>
      
      <th><a href="repro_tipo_edit.php?id_vacuno=<?php echo $row_hm['id_vacuno']; ?>"><strong><?php echo $row_hm['tp_rep']; ?></strong></a></th>
      <td><?php echo $row_hm['ubicasion']; ?></td>
    </tr>
    <?php //} while ($row_hm = mysql_fetch_assoc($hm)); ?>
    <?php } while (($row_ed = mysql_fetch_assoc($ed))&& ($row_hm = mysql_fetch_assoc($hm)) ); ?>
</table>

</DIV>
</body>
</html>
<?php
mysql_free_result($hm);

mysql_free_result($ed);
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