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
<?php require_once('../Connections/import.php'); ?>
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

$colname_ftr = "-1";
if (isset($_GET['cotiza'])) {
  $colname_ftr = $_GET['cotiza'];
}
mysql_select_db($database_import, $import);
$query_ftr = sprintf("SELECT * FROM d89xz_solicitus WHERE cotiza = %s AND zado ='cotizado'", GetSQLValueString($colname_ftr, "int"));
$ftr = mysql_query($query_ftr, $import) or die(mysql_error());
$row_ftr = mysql_fetch_assoc($ftr);
$totalRows_ftr = mysql_num_rows($ftr);$colname_ftr = "-1";
if (isset($_GET['cotiza'])) {
  $colname_ftr = $_GET['cotiza'];
}
mysql_select_db($database_import, $import);
$query_ftr = sprintf("SELECT * FROM d89xz_solicitus WHERE cotiza = %s AND zado ='cotizado'", GetSQLValueString($colname_ftr, "int"));
$ftr = mysql_query($query_ftr, $import) or die(mysql_error());
$row_ftr = mysql_fetch_assoc($ftr);
$totalRows_ftr = mysql_num_rows($ftr);

$colname_cli = "-1";
if (isset($_GET['docu'])) {
  $colname_cli = $_GET['docu'];
}
mysql_select_db($database_import, $import);
$query_cli = sprintf("SELECT * FROM d89xz_clientes_proim WHERE docu = %s", GetSQLValueString($colname_cli, "text"));
$cli = mysql_query($query_cli, $import) or die(mysql_error());
$row_cli = mysql_fetch_assoc($cli);
$totalRows_cli = mysql_num_rows($cli);


?>

<?
$cotiza=$_GET['cotiza'];
$result = mysql_query("SELECT SUM(`vtal`) as total FROM  d89xz_solicitus WHERE `zado` ='Cotizado' and `cotiza` = '$cotiza'"); 
$row = mysql_fetch_array($result, MYSQL_ASSOC);
// $total=$row['total'] ;

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Documento sin título</title>
</head>

<body>

<?
$dolar1 = $row_ftr['dolar'];
$dolaeste = $dolar1 * 1000;
$dolar = 1786.21;

$costo = $total=$row['total'];
$costo4 = $total=$row['total'];

//$pesos = $dolar1 * $costo;
$op=number_format($pesos,2,'.','.'); 

//$resil= number_format($dolaeste * $costo4);
$pesos = number_format($dolaeste * $costo4);
//echo"Dolar :$dolar ----Costo :$costo ----Pesos : $pesos----Dolar_hoy: $dolar1-----Costo4:$costo4 -----= resul = $resil";
?>

<a href="javascript:imprSelec('seleccion')" ><img src="imprimir.png" alt="" width="36" height="35" border="0" align="right" /></a>

<DIV ID="seleccion">

<table width="700" border="0" align="center">
  <tr>
    <td colspan="3" rowspan="6"><img src="PRO Postal Imports SAS.png" width="419" height="143" /></td>
    <td colspan="2" align="center"><strong>COTIZACIÓN COMERCIAL</strong></td>
  </tr>
  <tr>
    <td colspan="2">&nbsp;</td>
  </tr>
  <tr>
    <td align="center">COTIZACIÓN #</td>
    <td><?php echo $row_ftr['cotiza']; ?></td>
  </tr>
  <tr>
    <td colspan="2">&nbsp;</td>
  </tr>
  <tr>
    <td colspan="2">&nbsp;</td>
  </tr>
  <tr>
    <td align="center">FECHA</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td width="190">NOMBRE DEL CLIENTE:</td>
    <td colspan="4"><?php echo $row_cli['nombre']; ?></td>
  </tr>
  <tr>
    <td>TEL:</td>
    <td colspan="4"><?php echo $row_cli['tel']; ?></td>
  </tr>
  <tr>
    <td>EMAIL:</td>
    <td colspan="4">&nbsp;</td>
  </tr>
  <tr>
    <td>ORIGEN:</td>
    <td colspan="4">Estados Unidos</td>
  </tr>
  <tr>
    <td>DIRECCIÓN:</td>
    <td colspan="4"><?php echo $row_cli['dire1']; ?></td>
  </tr>
  <tr>
    <td colspan="5">&nbsp;</td>
  </tr>
  <tr>
    <td colspan="2">SERVICIO:</td>
    <td width="167">Puerta a Puerta</td>
    <td width="119">TRM</td>
    <td width="147"><?php echo ($row_ftr['dolar']* 1000); ?></td>
  </tr>
  <tr>
    <td colspan="2">VALOR TOTAL EN DÓLARES:</td>
    <td><? echo number_format($total=$row['total'], 2, ',', '.') ;?></td>
   
    
    <td colspan="2">*(la TRM válida es la del día de la compra)</td>
  </tr>
  <tr>
    <td colspan="2">VALOR TOTAL EN PESOS:</td>
    <td><? echo $pesos ;?></td>
    <td colspan="2">&nbsp;</td>
  </tr>
</table>
<p>&nbsp;</p>
<table width="700" border="1" align="center">
  <tr>
    <th width="423">ARTÍCULO A IMPORTAR</th>
    <th width="74">VALOR</th>
    <th width="59">CANT.</th>
    <th width="116">VALOR TOTAL</th>
  </tr>
  <?php do { ?>
    <tr align="center">
      <td><?php echo $row_ftr['arti']; ?></td>
      <td><?php echo $row_ftr['vtal']; ?></td>
      <td><?php echo $row_ftr['cant']; ?></td>
      <td><? echo ($row_ftr['vtal'] * $row_ftr['cant']); ?></td>
    </tr>
    <?php } while ($row_ftr = mysql_fetch_assoc($ftr)); ?>
</table>
<table width="700" border="1" align="center">
  <tr>
    <th width="568">TOTAL</th>
    <td align="center"  colspan="2" width="116"><? echo number_format($total=$row['total'], 2, ',', '.') ;?></td>
  </tr>
</table>

</DIV>
<p>&nbsp;</p>
</body>
</html>





<?php
mysql_free_result($ftr);

mysql_free_result($cli);
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