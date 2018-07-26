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
 
$cliente1=$_GET['clientes'];
$diab=trim(strip_tags($_GET['dia']));
$mesb=trim(strip_tags($_GET['mes']));
$anob=trim(strip_tags($_GET['anos']));
$fecha=$anob.'-'.$mesb.'-'.$diab;
  
mysql_select_db($database_conexion, $conexion);
$query_vnt = "SELECT * FROM d89xz_ventas WHERE fecha = '$fecha' AND client='$cliente1' ";
$vnt = mysql_query($query_vnt, $conexion) or die(mysql_error());
$row_vnt = mysql_fetch_assoc($vnt);
$totalRows_vnt = mysql_num_rows($vnt);

mysql_select_db($database_conexion, $conexion);
$query_hd = "SELECT * FROM d89xz_empresa";
$hd = mysql_query($query_hd, $conexion) or die(mysql_error());
$row_hd = mysql_fetch_assoc($hd);
$totalRows_hd = mysql_num_rows($hd);

mysql_select_db($database_conexion, $conexion);
$query_clien = "SELECT * FROM d89xz_clientes";
$clien = mysql_query($query_clien, $conexion) or die(mysql_error());
$row_clien = mysql_fetch_assoc($clien);
$totalRows_clien = mysql_num_rows($clien);

mysql_select_db($database_conexion, $conexion);
$query_dia = "SELECT * FROM d89xz_dias";
$dia = mysql_query($query_dia, $conexion) or die(mysql_error());
$row_dia = mysql_fetch_assoc($dia);
$totalRows_dia = mysql_num_rows($dia);

mysql_select_db($database_conexion, $conexion);
$query_mes = "SELECT * FROM d89xz_meses";
$mes = mysql_query($query_mes, $conexion) or die(mysql_error());
$row_mes = mysql_fetch_assoc($mes);
$totalRows_mes = mysql_num_rows($mes);

mysql_select_db($database_conexion, $conexion);
$query_anos = "SELECT * FROM d89xz_anos";
$anos = mysql_query($query_anos, $conexion) or die(mysql_error());
$row_anos = mysql_fetch_assoc($anos);
$totalRows_anos = mysql_num_rows($anos);

$colname_clenfact = "-1";
if (isset($_POST['clientes'])) {
  $colname_clenfact = $_POST['clientes'];
}

mysql_select_db($database_conexion, $conexion);
$cedulacli =$_GET["clientes"];
$query_clenfact = "SELECT * FROM d89xz_clientes WHERE cedula = '$cedulacli' ";
$clenfact = mysql_query($query_clenfact, $conexion) or die(mysql_error());
$row_clenfact = mysql_fetch_assoc($clenfact);
$totalRows_clenfact = mysql_num_rows($clenfact);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Documento sin título</title>
<script src="SpryAssets/SpryValidationSelect.js" type="text/javascript"></script>
<link href="SpryAssets/SpryValidationSelect.css" rel="stylesheet" type="text/css" />
<style type="text/css">
#seleccion table tr th {
	color: #FFF;
}
#seleccion table tr th {
	color: #FFF;
}
.s {
	color: #FFF;
}
.x {
	color: #FFF;
}
a {
	color: #000;
}
</style>
</head>

<body>
<td>&nbsp;</td>
<form action="" method="get">
  <table width="692" border="1" align="center">
    <tr>
      <th colspan="5" bgcolor="#4D68A2" class="x">Ingrese datos de Factura</th>
    </tr>
    <tr>
      <td width="100">Cedula Cliente</td>
      <td width="68"><label for="clientes"></label>
        <select name="clientes" id="clientes">
          <?php
do {  
?>
          <option value="<?php echo $row_clien['cedula']?>"><?php echo $row_clien['nombre']?></option>
          <?php
} while ($row_clien = mysql_fetch_assoc($clien));
  $rows = mysql_num_rows($clien);
  if($rows > 0) {
      mysql_data_seek($clien, 0);
	  $row_clien = mysql_fetch_assoc($clien);
  }
?>
      </select></td>
      <td width="128">Fecha De Venta</td>
      <td width="229">D
        <label for="dia"></label>
        <span id="spryselect1">
        <label for="dia"></label>
        <select name="dia" id="dia">
          <option value="">D</option>
          <?php
do {  
?>
          <option value="<?php echo $row_dia['dias']?>"><?php echo $row_dia['dias']?></option>
          <?php
} while ($row_dia = mysql_fetch_assoc($dia));
  $rows = mysql_num_rows($dia);
  if($rows > 0) {
      mysql_data_seek($dia, 0);
	  $row_dia = mysql_fetch_assoc($dia);
  }
?>
        </select>
        </span> M
        <label for="mes"></label>
        <span id="spryselect2">
        <label for="mes"></label>
        <select name="mes" id="mes">
          <option value="">M</option>
          <?php
do {  
?>
          <option value="<?php echo $row_mes['meses']?>"><?php echo $row_mes['meses']?></option>
          <?php
} while ($row_mes = mysql_fetch_assoc($mes));
  $rows = mysql_num_rows($mes);
  if($rows > 0) {
      mysql_data_seek($mes, 0);
	  $row_mes = mysql_fetch_assoc($mes);
  }
?>
        </select>
        </span> A
        <label for="anos"></label>
<span id="spryselect3">
<label for="anos"></label>
<select name="anos" id="anos">
  <option value="">A</option>
  <?php
do {  
?>
  <option value="<?php echo $row_anos['anos']?>"><?php echo $row_anos['anos']?></option>
  <?php
} while ($row_anos = mysql_fetch_assoc($anos));
  $rows = mysql_num_rows($anos);
  if($rows > 0) {
      mysql_data_seek($anos, 0);
	  $row_anos = mysql_fetch_assoc($anos);
  }
?>
</select>
</span></td>
      <td width="64"><input type="submit" name="button" id="button" value="Enviar" /></td>
    </tr>
  </table>
</form>
<a href="javascript:imprSelec('seleccion')" ><img src="imprimir.png" alt="" width="36" height="35" border="0" align="right" /></a>

<DIV ID="seleccion">
<p><img src="idsolutions--este.png" align="baseline" width="162" height="59" /></p>
<table width="692" align="center">
  <tr>
    <td><strong>Empresa:</strong></td>
    <td><strong><?php echo $row_hd['empresa']; ?></strong></td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td width="127"><strong>Nit:</strong></td>
    <td width="146"><strong><?php echo $row_hd['nit']; ?></strong></td>
    <td width="397">&nbsp;</td>
  </tr>
  <tr>
    <td><strong>Telefono:</strong></td>
    <td><strong><?php echo $row_hd['telefono']; ?></strong></td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td><strong>Cliente:</strong></td>
    <td><strong><?php echo $row_clenfact['empresa']; ?></strong></td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td><strong>Concepto:</strong></td>
    <td><p><strong>Venta Vacunos</strong></p></td>
    <td>&nbsp;</td>
  </tr>
</table>
<p>&nbsp;</p>
<table width="692" border="1" align="center">
  <tr>
    <th width="169" bgcolor="#4D68A2">ID</th>
    <th width="186" bgcolor="#4D68A2">Peso</th>
    <th width="182" bgcolor="#4D68A2">Valor(Kg)</th>
    <th width="127" bgcolor="#4D68A2">Venta($)</th>
  </tr>
  <?php do { ?>
    <tr>
      <td align="center"><?php echo $row_vnt['vacuno']; ?></td>
      <td align="center"><?php echo $row_vnt['peso']; ?></td>
      <td align="center"><?php echo number_format ($row_vnt['v_kilo']); ?></td>
      <td width="127" align="right"><?php echo number_format ($row_vnt['venta']); ?></td>
    </tr>
    <?php } while ($row_vnt = mysql_fetch_assoc($vnt)); ?>
</table>

<?

$result = mysql_query("SELECT SUM(`venta`) as total FROM d89xz_ventas where `fecha` = '$fecha' AND client = '$cliente1'"); 
$row1 = mysql_fetch_array($result, MYSQL_ASSOC);
?>


<table width="692" border="1" align="center">
  <tr>
    <th width="549" align="center" bgcolor="#4D68A2">Valor Total</th>
    <th width="127" bgcolor="#4D68A2"><? echo number_format ($row1['total']);?></th>
  </tr>
</table>




<p>&nbsp;</p>
</DIV>
<script type="text/javascript">
var spryselect1 = new Spry.Widget.ValidationSelect("spryselect1", {validateOn:["blur"]});
var spryjamanct2 = new Spry.Widget.ValidationSelect("spryselect2", {validateOn:["blur"]});
var spryselect3 = new Spry.Widget.ValidationSelect("spryselect3", {validateOn:["blur"]});
</script>
</body>
</html>
<?php
mysql_free_result($vnt);

mysql_free_result($hd);

mysql_free_result($clien);

mysql_free_result($dia);

mysql_free_result($mes);

mysql_free_result($anos);

mysql_free_result($clenfact);
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