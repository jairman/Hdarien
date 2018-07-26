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

$colname_fac = "-1";
if (isset($_GET['fact'])) {
  $colname_fac = $_GET['fact'];
}
mysql_select_db($database_conexion, $conexion);
$query_fac = sprintf("SELECT * FROM d89xz_entra_ventas WHERE fact = %s", GetSQLValueString($colname_fac, "int"));
$fac = mysql_query($query_fac, $conexion) or die(mysql_error());
$row_fac = mysql_fetch_assoc($fac);
$totalRows_fac = mysql_num_rows($fac);$colname_fac = "-1";
if (isset($_GET['fact'])) {
  $colname_fac = $_GET['fact'];
}
mysql_select_db($database_conexion, $conexion);
$query_fac = sprintf("SELECT * FROM d89xz_entra_ventas WHERE fact = %s", GetSQLValueString($colname_fac, "int"));
$fac = mysql_query($query_fac, $conexion) or die(mysql_error());
$row_fac = mysql_fetch_assoc($fac);
$totalRows_fac = mysql_num_rows($fac);

$colname_nta = "-1";
if (isset($_GET['fact'])) {
  $colname_nta = $_GET['fact'];
}
mysql_select_db($database_conexion, $conexion);
$query_nta = sprintf("SELECT coment FROM d89xz_entra_ventas WHERE fact = %s", GetSQLValueString($colname_nta, "int"));
$nta = mysql_query($query_nta, $conexion) or die(mysql_error());
$row_nta = mysql_fetch_assoc($nta);
$totalRows_nta = mysql_num_rows($nta);

$colname_ced = "-1";
if (isset($_GET['cedula'])) {
  $colname_ced = $_GET['cedula'];
}
mysql_select_db($database_conexion, $conexion);
$query_ced = sprintf("SELECT * FROM d89xz_prove WHERE cedula = %s", GetSQLValueString($colname_ced, "text"));
$ced = mysql_query($query_ced, $conexion) or die(mysql_error());
$row_ced = mysql_fetch_assoc($ced);
$totalRows_ced = mysql_num_rows($ced);


$fact=$_GET['fact'];
$result = mysql_query("SELECT SUM(`total`) as total FROM  d89xz_entra_ventas WHERE `fact` ='$fact'"); 
$row = mysql_fetch_array($result, MYSQL_ASSOC);
// $total=$row['total'] ;
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Documento sin título</title>
<style type="text/css">
.p {	background:#4D68A2;
	border-collapse:collapse;
	color: #FFF;
}
#d {	font-family: Helvetica;
}
</style>
</head>

<body>
<table width="890" border="0" align="center">
  <tr>
    <td width="244" align="left">&nbsp;</td>
    <td width="308" align="center"><a href="legajador_clientes.php?prove=<?php echo $row_fac['prove']; ?>"><img src="last.png" alt="" width="29" height="31" /></a></td>
    <td width="239" align="right"><a href="javascript:imprSelec('seleccion2')" ><img src="imprimir.png" alt="" width="36" height="35" 

border="0" align="right" /></a>
</td>
  </tr>
</table>
<DIV ID="seleccion2">
<table width="890" cellspacing="0" border="0" align="center">
  <tr>
    <td colspan="3" rowspan="9"><font face="Helvetica"><img src="logo.png" alt="" width="306" height="112" /></font></td>
    <td colspan="2" align="center" style="font-size:24px">&nbsp;</td>
  </tr>
  <tr>
    <td colspan="2" align="center" style="font-size:24px">&nbsp;</td>
  </tr>
  <tr>
    <td colspan="2" align="center" style="font-size:24px">&nbsp;</td>
  </tr>
  <tr>
    <th colspan="2"><strong><font face="Helvetica" style="font-size: 24px">FACTURA COMPRA</font></strong></th>
  </tr>
  <tr>
    <td align="left" style="font-weight:bold;">&nbsp;</td>
    <td align="center" bgcolor="#FFFFFF" style="font-weight:bold; color:#FFF">&nbsp;</td>
  </tr>
  <tr>
    <td width="137" align="left" style="font-weight:bold;"><font face="Helvetica">FACTURA N°</font></td>
    <td width="171" align="center" bgcolor="#4D68A2"class="p"  style="font-weight:bold; color:#FFF"><?php echo $row_fac['fact']; ?></td>
  </tr>
  <tr>
    <td colspan="2">&nbsp;</td>
  </tr>
  <tr>
    <td><font face="Helvetica"><span style="font-weight:bold;">FECHA</span></font></td>
    <th bgcolor="#4D68A2"><span style="font-weight:bold; color: #FFF;"><?php echo $row_fac['f_fact']; ?></span></th>
  </tr>
  <tr>
    <td colspan="2" align="center" style="font-weight:bold;">&nbsp;</td>
  </tr>
  <tr>
    <td width="227" style="font-weight:bold;"><font face="Helvetica">NOMBRE:</font></td>
    <th class="p" colspan="2" align="left" bgcolor="#4D68A2" style="font-weight:bold; color:#FFF"><?php echo $row_ced['nombre'].'&nbsp;'.$row_ced['apellido']; ?></th>
    <td align="center" bgcolor="#4D68A2">&nbsp;</td>
    <td align="center" bgcolor="#4D68A2">&nbsp;</td>
  </tr>
  <tr>
    <td style="font-weight:bold;">NIT</td>
    <th class="p" colspan="2" align="left" bgcolor="#4D68A2" style="font-weight:bold; color:#FFF"><?php echo $row_ced['cedula']; ?></th>
    <td bgcolor="#4D68A2">&nbsp;</td>
    <td bgcolor="#4D68A2">&nbsp;</td>
  </tr>
  <tr>
    <td style="font-weight:bold;"><font face="Helvetica">TELEFONO:</font></td>
    <th class="p" colspan="2" align="left" bgcolor="#4D68A2" style="font-weight:bold; color:#FFF"><?php echo $row_ced['telefono']; ?></th>
    <td bgcolor="#4D68A2">&nbsp;</td>
    <td bgcolor="#4D68A2">&nbsp;</td>
  </tr>
  <tr>
    <td style="font-weight:bold;"><font face="Helvetica">EMAIL:</font></td>
    <th class="p" colspan="2" align="left" bgcolor="#4D68A2" style="font-weight:bold; color:#FFF"><?php echo $row_ced['mail']; ?></th>
    <td bgcolor="#4D68A2">&nbsp;</td>
    <td bgcolor="#4D68A2">&nbsp;</td>
  </tr>
  <tr>
    <td style="font-weight:bold;"><font face="Helvetica">DIRECCI&Oacute;N:</font></td>
    <th class="p" colspan="2" align="left" bgcolor="#4D68A2" style="font-weight:bold; color:#FFF"><?php echo $row_ced['dir'].'&nbsp;'.$row_ced['ciud'];?></th>
    <td bgcolor="#4D68A2">&nbsp;</td>
    <td bgcolor="#4D68A2">&nbsp;</td>
  </tr>
  <tr>
    <td colspan="5">&nbsp;</td>
  </tr>
</table>
<p>&nbsp;</p>
<table width="890" border="1" align="center">
  <tr bgcolor="#4D68A2" style="color: #FFF">
    <th width="558" bgcolor="#4D68A2">Articulo</th>
    <th width="84">Valor</th>
    <th width="62">Cant</th>
    <th width="79">Total</th>
    </tr>
  <?php do { ?>
    <tr align="center">
      <td align="left"><?php echo $row_fac['nombre']; ?>/<?php echo $row_fac['refer']; ?>/<?php echo $row_fac['marca']; ?>/<?php echo $row_fac['presen']; ?>/<?php echo $row_fac['conte']; ?></td>
      <td><?php echo number_format($row_fac['pcom']); ?></td>
      <td><?php echo number_format($row_fac['cant']); ?></td>
      <td><?php echo number_format($row_fac['total']); ?></td>
      </tr>
      <?
	  $iva=$row_fac['iva'];
	 // echo $iva;
	  ?>
    <?php } while ($row_fac = mysql_fetch_assoc($fac)); ?>
</table>
<table width="890" border="1" align="center">
  <tr>
    <th align="right">SUBTOTAL</th>
    <th align="right"><?php echo number_format(($total=$row['total']),2); ?></th>
  </tr>
  <tr>
    <th align="right">IVA  <?php echo $iva*100; ?>% </th>
    <th align="right"><?php echo number_format(($total=$row['total']*$iva),2); ?></th>
  </tr>
  <tr>
    <th width="706" align="right">TOTAL</th>
    <th width="194" align="right"><?php echo number_format($total=$row['total']+($total=$row['total']*$iva),2); ?></th>
  </tr>
</table>
<table width="890" align="center" cellspacing="0">
  <?php do { ?>
    <tr>
      <td style="font-size: 9px; font-family: Helvetica; font-style: italic;"><?php echo $row_nta['coment']; ?></td>
    </tr>
    <?php } while ($row_nta = mysql_fetch_assoc($nta)); ?>
</table>
<p>&nbsp;</p>
<p>&nbsp;</p>
<table width="890" align="center">
  <tr>
    <td align="center">_________________________________________</td>
    <td align="center">__________________________________________</td>
  </tr>
  <tr>
    <td align="center"><p>Recibido  Por</p></td>
    <td align="center"><p>Administrador</p></td>
  </tr>
</table>
<p>&nbsp;</p>
<p>&nbsp;</p>
<p>&nbsp;</p>
<p>&nbsp;</p>
</DIV>

</body>
</html>
<?php
mysql_free_result($fac);

mysql_free_result($nta);

mysql_free_result($ced);
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