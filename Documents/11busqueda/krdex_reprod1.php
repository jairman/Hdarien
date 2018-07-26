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
</style>
</head>

<body>
<body>
<a href="javascript:imprSelec('seleccion')" ><img src="imprimir.png" alt="" width="36" height="35" border="0" align="right" /></a>

<DIV ID="seleccion">

<img src="idsolutions--este.png" width="162" height="59" />

<form id="form1" name="form1" method="post" action="">
<td>&nbsp;</td>
  <table width="710" border="1">
    <tr>
      <th colspan="10" bgcolor="#4D68A2">Reproductora
      <label for="text_vaca"></label></th>
    </tr>
    <tr>
      <td width="72"><strong>Hacienda</strong></td>
      <td colspan="2"><?php echo $row_reg['ubicasion']; ?></td>
      <td>&nbsp;</td>
      <td colspan="2"><strong>Vaca No</strong></td>
      <td colspan="2"><?php echo $row_reg['id_vacuno']; ?></td>
      <td width="70">&nbsp;</td>
      <td width="139">&nbsp;</td>
    </tr>
    <tr>
      <td>Registro</td>
      <td colspan="2"><?php echo $row_reg['registro']; ?></td>
      <td width="99">&nbsp;</td>
      <td colspan="2">F.Nacimiento</td>
      <td colspan="2"><?php echo $row_reg['f_ingreso']; ?></td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
    </tr>
    <tr>
      <td>Padre</td>
      <td colspan="2"><?php echo $row_reg['padre']; ?></td>
      <td>Madre</td>
      <td colspan="2"><?php echo $row_reg['madre']; ?></td>
      <td width="79">&nbsp;</td>
      <td width="77">&nbsp;</td>
      <td>Clasificacion</td>
      <td><?php echo $row_reg['clasificasion']; ?></td>
    </tr>
    <tr>
      <td>P.205 D</td>
      <td colspan="2"><?php echo $row_reg['p_205']; ?></td>
      <td>P.18M</td>
      <td colspan="2"><?php echo $row_reg['p_18']; ?></td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
    </tr>
    <tr>
      <th rowspan="2" bgcolor="#4D68A2">Padre</th>
      <th width="96" rowspan="2" bgcolor="#4D68A2">F.Parto</th>
      <th width="65" rowspan="2" bgcolor="#4D68A2">Sexo</th>
      <th rowspan="2" bgcolor="#4D68A2">No. Cria</th>
      <th colspan="2" bgcolor="#4D68A2">Destete</th>
      <th colspan="3" bgcolor="#4D68A2">Pesos</th>
      <th rowspan="2" bgcolor="#4D68A2">OBSERVACION</th>
    </tr>
    <tr>
      <th width="67" bgcolor="#4D68A2">Fecha</th>
      <th width="69" bgcolor="#4D68A2">Peso</th>
      <th bgcolor="#4D68A2">Peso Ncto.</th>
      <th bgcolor="#4D68A2">P.A 205 Dias</th>
      <th bgcolor="#4D68A2">P.A 18 Meses</th>
    </tr>
   
    <?php do { ?>
   
    <tr>
      <td><?php echo $row_idv['padre']; ?></td>
      <td width="96"><?php echo $row_idv['f_ingreso']; ?></td>
      <td><?php echo $row_idv['sexo']; ?></td>
      <td><?php echo $row_idv['id_vacuno']; ?></td>
      <td><?php echo $row_idv['f_dtt']; ?></td>
      <td><?php echo $row_idv['p_dtt']; ?></td>
      
      
      <td><?php echo $row_idv['p_ncto']; ?></td>
      <td><?php echo $row_idv['p_205']; ?></td>
      <td><?php echo $row_idv['p_18']; ?></td>
      <td><?php echo $row_idv['observasiones']; ?></td>
    </tr>
   <?php } while ($row_idv = mysql_fetch_assoc($idv)); ?>
   
   
  </table>
</form>
</DIV>
</body>
</html>
<?php
mysql_free_result($idv);

mysql_free_result($reg);
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