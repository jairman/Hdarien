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
$query_prov = "SELECT * FROM d89xz_empleados";
$prov = mysql_query($query_prov, $conexion) or die(mysql_error());
$row_prov = mysql_fetch_assoc($prov);
$totalRows_prov = mysql_num_rows($prov);

mysql_select_db($database_conexion, $conexion);
$query_anos = "SELECT anos FROM d89xz_anos";
$anos = mysql_query($query_anos, $conexion) or die(mysql_error());
$row_anos = mysql_fetch_assoc($anos);
$totalRows_anos = mysql_num_rows($anos);

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
$query_hc = "SELECT * FROM d89xz_hacienda";
$hc = mysql_query($query_hc, $conexion) or die(mysql_error());
$row_hc = mysql_fetch_assoc($hc);
$totalRows_hc = mysql_num_rows($hc);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Documento sin título</title>
<script src="SpryAssets/SpryValidationSelect.js" type="text/javascript"></script>
<script src="SpryAssets/SpryValidationTextField.js" type="text/javascript"></script>
<link href="SpryAssets/SpryValidationSelect.css" rel="stylesheet" type="text/css" />
<link href="SpryAssets/SpryValidationTextField.css" rel="stylesheet" type="text/css" />

<?

$fecha=date("Y-m-d");
//echo $fecha;
$date = strtotime($fecha);

?>
<!--  esto para el calendario -->
<script src="http://spanish.jotform.com/min/g=jotform?3.1.176" type="text/javascript"></script>
<script type="text/javascript">
   JotForm.init(function(){
      JotForm.setCalendar("1");
      JotForm.setCalendar("3");
   });
</script>
<link href="http://spanish.jotform.com/min/g=formCss?3.1.176" rel="stylesheet" type="text/css" />
<link type="text/css" rel="stylesheet" href="http://spanish.jotform.com/css/styles/nova.css?3.1.176" />

</head>

<body>
<p>&nbsp;</p>
<table width="100%" border="0" align="center" cellspacing="0">
  <tr>
    <td colspan="3" align="center"><a href="agregar_lotes_princi.php"><img src="last.png" alt="" width="29" height="31" /></a></td>
  </tr>
  <tr>
    <td width="162" align="left"><img src="idsolutions--este.png" alt="" width="162" height="59" /></td>
    <th width="851" align="center">&nbsp;</th>
    <td width="63" align="right">&nbsp;</td>
  </tr>
</table>
<form id="form1" name="form1" method="post" action="">
  <table width="513" border="1" align="center" cellspacing="0">
    <tr bgcolor="#4D68A2" style="color: #FFF">
      <th colspan="3">Generar Lotes</th>
    </tr>
    <tr>
      <th width="182" align="left" bgcolor="#FFFFFF" style="color: #000">Responsable</th>
      <td width="315" colspan="2"><span id="spryselect1" style="width:500">
        <label for="prove"></label>
        <select name="prove" id="prove" style="width:315px">
          <option value="">Seleccione</option>
          <?php
do {  
?>
          <option value="<?php echo $row_prov['cedula']?>"><?php echo $row_prov['nombre']?></option>
          <?php
} while ($row_prov = mysql_fetch_assoc($prov));
  $rows = mysql_num_rows($prov);
  if($rows > 0) {
      mysql_data_seek($prov, 0);
	  $row_prov = mysql_fetch_assoc($prov);
  }
?>
        </select>
      </span></td>
    </tr>
    <tr>
      <th align="left" bgcolor="#FFFFFF" style="color: #000">Fecha de Creación</th>
      <td colspan="2"><span class="form-input"><span class="form-sub-label-container">
      <span class="date-separate">&nbsp;D-</span>
        <input class="form-textbox" id="day_1" name="dia" type="text" size="2" maxlength="2" value="<? echo date("d", $date);?>" />
        <span class="date-separate">&nbsp;M-</span>
        </span><span class="form-sub-label-container">
      <input class="form-textbox" id="month_1" name="mes" type="text" size="2" maxlength="2" value="<? echo date("m", $date);?>" />
      <span class="date-separate">&nbsp;A-</span>
      </span><span class="form-sub-label-container">
      <input class="form-textbox" id="year_1" name="anos" type="text" size="4" maxlength="4" value="<? echo date("Y", $date);?>" />
      
      </span><span class="form-sub-label-container"><img alt="Elija una fecha" id="input_1_pick" src="http://spanish.jotform.com/images/calendar.png" align="absmiddle" /></span></span></td>
    </tr>
    <tr>
      <th align="left" bgcolor="#FFFFFF" style="color: #000">Hacienda</th>
      <td colspan="2"><span id="spryselect2">
        <label for="hacienda"></label>
        <select name="hacienda" id="hacienda"style="width:315px">
          <option value="">Seleccione</option>
          <?php
do {  
?>
          <option value="<?php echo $row_hc['hacienda']?>"><?php echo $row_hc['hacienda']?></option>
          <?php
} while ($row_hc = mysql_fetch_assoc($hc));
  $rows = mysql_num_rows($hc);
  if($rows > 0) {
      mysql_data_seek($hc, 0);
	  $row_hc = mysql_fetch_assoc($hc);
  }
?>
        </select>
      </span></td>
    </tr>
    <tr>
      <th align="left" bgcolor="#FFFFFF" style="color: #000">Lote</th>
      <td colspan="2"><span id="sprytextfield2">
        <label for="lote"></label>
        <input name="lote" type="text" id="lote" size="46" />
      </span></td>
    </tr>
    <tr>
      <th align="left" bgcolor="#FFFFFF" style="color: #000">Potrero</th>
      <td colspan="2"><label for="potrero"></label>
      <input name="potrero" type="text" id="potrero" size="46" /></td>
    </tr>
    <tr>
      <th align="left" bgcolor="#FFFFFF" style="color: #000">Comentario</th>
      <td colspan="2"><span id="sprytextfield4">
      <label for="potrero"></label>
      <input name="comen" type="text" id="potrero" size="46" />
      </span></td>
    </tr>
    <tr bgcolor="#4D68A2" style="color: #FFF">
      <th colspan="3" bgcolor="#FFFFFF"><input type="submit" name="button" id="button" value="Enviar"  onclick="return confirm('Desea Generar Lote ');"/></th>
    </tr>
  </table>
</form>
<script type="text/javascript">
var spryselect1 = new Spry.Widget.ValidationSelect("spryselect1", {validateOn:["blur"]});
<?php

mysql_free_result($prov);

mysql_free_result($anos);

mysql_free_result($dia);

mysql_free_result($mes);


?>
var sprytextfield2 = new Spry.Widget.ValidationTextField("sprytextfield2", "none", {validateOn:["blur"]});
var sprytextfield4 = new Spry.Widget.ValidationTextField("sprytextfield4", "none", {validateOn:["blur"]});
var spryselect2 = new Spry.Widget.ValidationSelect("spryselect2", {validateOn:["blur"]});
</script>

<?
@$diab=trim(strip_tags($_POST['dia']));
@$mesb=trim(strip_tags($_POST['mes']));
@$anob=trim(strip_tags($_POST['anos']));
@$f_fact=$anob.'-'.$mesb.'-'.$diab;

//echo $f_pago;
@$respon=$_POST['prove'];
@$hacienda=$_POST['hacienda'];
@$lote=$_POST['lote'];
@$potrero = $_POST['potrero'];
@$comen=$_POST['comen'];

@$queEmp ="SELECT * FROM   d89xz_empleados where cedula='$respon'";
					@$resEmp = mysql_query($queEmp, $conexion) or die(mysql_error());
					@$totEmp = mysql_num_rows($resEmp);
					if ($totEmp> 0) {
						
						while ($rowEmp = mysql_fetch_assoc($resEmp)) {
						@$nombre=	$rowEmp['nombre'];
						@$apellido=	$rowEmp['apellido'];
						
							
						}
					}
@$nom_prov=$nombre.' '.$apellido;

if($lote !=''){

					
$insertar = mysql_query("INSERT INTO d89xz_lotes(`lote`,`ubica`,`resp`,`comen`,`fecha`,`potre`) VALUES ('{$lote}','{$hacienda}','{$nom_prov}','{$comen}','{$fecha}','{$potrero}')",$conexion);

mysql_close($conexion);

echo "<script type=''>
	window.location='agregar_lotes_princi.php';
	</script>";
}

?>

</body>
</html>
<?php
//mysql_free_result($prov);

mysql_free_result($hc);
?>
