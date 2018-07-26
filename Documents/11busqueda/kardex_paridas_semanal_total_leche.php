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
$query_ms = "SELECT * FROM d89xz_meses";
$ms = mysql_query($query_ms, $conexion) or die(mysql_error());
$row_ms = mysql_fetch_assoc($ms);
$totalRows_ms = mysql_num_rows($ms);

mysql_select_db($database_conexion, $conexion);
$query_ans = "SELECT * FROM d89xz_anos";
$ans = mysql_query($query_ans, $conexion) or die(mysql_error());
$row_ans = mysql_fetch_assoc($ans);
$totalRows_ans = mysql_num_rows($ans);

mysql_select_db($database_conexion, $conexion);
$query_le = "SELECT * FROM d89xz_detalle_leche WHERE fact = 5 and dedu !='si' and liquidado !='si'";
$le = mysql_query($query_le, $conexion) or die(mysql_error());
$row_le = mysql_fetch_assoc($le);
$totalRows_le = mysql_num_rows($le);
$date= date("d/m/Y");
$anoss= date("Y"); // Year (2012)
$mess= date('m'); 

$result = mysql_query("SELECT SUM(`klos`) as total FROM d89xz_detalle_leche where fact = 5 and dedu !='si' and liquidado !='si'"); 
$row = mysql_fetch_array($result, MYSQL_ASSOC);
$total= number_format ($row["total"]);
//echo $total;
$result1 = mysql_query("SELECT SUM(`klos`) as total FROM d89xz_detalle_leche where fact = 5 and dedu='si' and liquidado !='si'"); 
$row1 = mysql_fetch_array($result1, MYSQL_ASSOC);
$totaldes= number_format ($row1["total"]);
//echo $totaldes;

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Documento sin título</title>
<script src="SpryAssets/SpryValidationSelect.js" type="text/javascript"></script>
<link href="SpryAssets/SpryValidationSelect.css" rel="stylesheet" type="text/css" />
<style type="text/css">
#form1 table tr th p {
	color: #FFF;
}
</style>
<script src="SpryAssets/SpryMenuBar.js" type="text/javascript"></script>
<script src="SpryAssets/SpryValidationTextField.js" type="text/javascript"></script>
<link href="SpryAssets/SpryMenuBarHorizontal.css" rel="stylesheet" type="text/css" />
<link href="SpryAssets/SpryValidationTextField.css" rel="stylesheet" type="text/css" />
</head>

<body>
<ul id="MenuBar1" class="MenuBarHorizontal">
<li><a href="kardex_paridas.php" >Lechería</a></li>
  <li><a href="kardex_paridas_dedus.php">Deducciones</a>  </li>
  <li><a href="kardex_paridas_semanal_total_leche.php"class="current">Generar Factura</a></li>
  <li><a href="kardex_paridas_histor.php">Historial</a></li>
</ul>
<p>&nbsp;</p>
<a href="javascript:imprSelec('seleccion')" ><img src="imprimir.png" alt="" width="36" height="35" border="0" align="right" /></a>

<DIV ID="seleccion">
<p>&nbsp;</p>
<form id="form1" name="form1" method="post" action="">
  <table width="100%" border="1" align="center" cellspacing="0">
    <tr>
      <td colspan="5" bgcolor="#FFFFFF" style="color: #FFF"><img src="idsolutions--este.png" width="162" height="59" /></td>
    </tr>
    <tr>
      <th colspan="5" bgcolor="#4D68A2" style="color: #FFF">Generar Factura Semanal</th>
    </tr>
    <tr>
      <th width="189">Ingrese Fecha</th>
      <td width="606"><label for="semana"></label>
        <span id="spryselect2">
        <select name="semana" id="semana">
          <option>Semana N°</option>
          <option value="1">Semana 1</option>
          <option value="2">Semana 2</option>
          <option value="3">Semana 3</option>
          <option value="4">Semana 4</option>
          <option value="5">Semana 5</option>
        </select>
        </span> M
        <label for="mes"></label>
        <select name="mes" id="mes">
          <option value="" <?php if (!(strcmp("", $mess))) {echo "selected=\"selected\"";} ?>>M</option>
          <?php
do {  
?>
<option value="<?php echo $row_ms['meses']?>"<?php if (!(strcmp($row_ms['meses'], $mess))) {echo "selected=\"selected\"";} ?>><?php echo $row_ms['meses']?></option>
          <?php
} while ($row_ms = mysql_fetch_assoc($ms));
  $rows = mysql_num_rows($ms);
  if($rows > 0) {
      mysql_data_seek($ms, 0);
	  $row_ms = mysql_fetch_assoc($ms);
  }
?>
         


        </select> 
        A<span id="spryselect1">
        <label for="anos"></label>
        <select name="anos" id="anos">
          <option value="" <?php if (!(strcmp("", $anoss))) {echo "selected=\"selected\"";} ?>>Seleccione</option>
          <?php
do {  
?>
          <option value="<?php echo $row_ans['anos']?>"<?php if (!(strcmp($row_ans['anos'], $anoss))) {echo "selected=\"selected\"";} ?>><?php echo $row_ans['anos']?></option>
          <?php
} while ($row_ans = mysql_fetch_assoc($ans));
  $rows = mysql_num_rows($ans);
  if($rows > 0) {
      mysql_data_seek($ans, 0);
	  $row_ans = mysql_fetch_assoc($ans);
  }
?>
        </select>
        </span></td>
      <td width="114" align="left"><strong>Valor (Kg)</strong></td>
      <td width="83"><span id="sprytextfield1">
        <label for="valor"></label>
        <input name="valor" type="text" id="valor" size="12" />
      </span></td>
      <th width="68"><input type="image" src="aceptar.png"  onmouseover="src='aceptar1.png';"  onmouseout="src='aceptar.png';" value="Insertar Clientes" alt="aceptar" /></th>
    </tr>
  </table>
</form>
<p>
  <?

$semana=$_POST["semana"];
$mes=$_POST['mes'];
$anos=$_POST['anos'];
$valor=$_POST['valor'];

if($anos !=0){
if($valor != 0){
	
$insertar1 = mysql_query("UPDATE  `d89xz_detalle_leche` SET `fact`= '5', `valor_unid`='$valor' WHERE YEAR(fecha) = '$anos' AND MONTH(fecha) = '$mes' AND semana = '$semana' and dedu!='si' ", $conexion);

	echo "<script type=''>
		window.location='kardex_paridas_semanal_total_leche.php';
	</script>";
}
}
?>
</p>
<table width="100%" border="1" align="center" cellspacing="0">
  <tr bgcolor="#4D68A2" style="color: #000">
    <th colspan="3">&nbsp;</th>
    <th colspan="4" bgcolor="#FFFFFF"><a href="kardex_paridas_generar_factu.php?valor_unit=<?php echo $row_le['valor_unid']; ?>&amp;semana=<?php echo $row_le['semana']; ?>&amp;total=<?php echo $total ?>&amp;fecha1=<?php echo $row_le['fecha']; ?>&amp;totaldes=<?php echo $totaldes ?>">Desea Generar Factura</a></th>
  </tr>
  <tr bgcolor="#f0f0f0" style="color: #FFF">
    <th colspan="7">&nbsp;</th>
  </tr>
  <tr bgcolor="#4D68A2" style="color: #FFF">
    <th width="15%">Vacuno</th>
    <th width="14%">Semana</th>
    <th width="18%">Semana Año</th>
    <th width="13%">Kilos(Kg)</th>
    <th width="15%">Valor(Kg)</th>
    <th width="12%">Total($)</th>
    <th width="13%">Fecha</th>
  </tr>
 
  <?php do { ?>
    <tr>
      <td><?php echo $row_le['vacuno']; ?></td>
      <td align="center"><?php echo $row_le['semana']; ?></td>
      <td align="center"><?php echo $row_le['sen_ano']; ?></td>
      <td align="center"><?php echo $row_le['klos']; ?></td>
      <td align="center"><?php echo $row_le['valor_unid']; ?></td>
     
      <td align="center"><?php echo number_format ($row_le['klos']*$row_le['valor_unid']) ?></td>
      <td align="center"><?php echo $row_le['fecha']; ?></td>
    </tr>
    <?php } while ($row_le = mysql_fetch_assoc($le)); ?>
</table>
<script type="text/javascript">
var sprytextfield1 = new Spry.Widget.ValidationTextField("sprytextfield1", "none", {validateOn:["blur"]});
var spryselect2 = new Spry.Widget.ValidationSelect("spryselect2");
</script>
</body>
</html>
<?php
//mysql_close($conexion);
mysql_free_result($ms);

mysql_free_result($ans);

mysql_free_result($le);
?>

<script type="text/javascript">
var spryselect1 = new Spry.Widget.ValidationSelect("spryselect1", {validateOn:["blur"]});
</script>