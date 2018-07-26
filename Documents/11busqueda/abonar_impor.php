<?
/*$ruta_a_joomla = "/../../Sganadero/";
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
    JError::raiseError(1,"No puede acceder a esta página sin estar logueado.");
$userx = JFactory::getUser();*/
$orden = $_GET['orden'];

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
$fecha=date("Y-m-d");
//echo $fecha;
$date = strtotime($fecha);
$factura = $_GET['factura'];
//echo "Factu".$factura;

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Documento sin título</title>
<script src="../SpryAssets/SpryValidationTextField.js" type="text/javascript"></script>
<link href="../SpryAssets/SpryValidationTextField.css" rel="stylesheet" type="text/css" />
<style type="text/css">
.c {
	color: #FFF;
}
</style>

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
<table width="100%" border="0" cellspacing="0">
  <tr>
    <td align="center" bgcolor="#FFFFFF"><a href="detalle_abono.php?factura=<? echo $factura?>"><img src="last.png" alt="" width="29" height="31" border="0" /></a></td>
  </tr>
</table>
<form id="form1" name="form1" method="post" action="">	
  <table width="514" border="1" align="center" cellspacing="0">
    <tr>
      <th colspan="2" bgcolor="#4D68A2" style="font-family: Helvetica; color: #FFF;">Cantidad  a  Abonar Factura <? echo  $factura?> </th>
    </tr>
    <tr>
      <th align="left" style="font-family: Helvetica">Fecha</th>
      <th width="313" style="font-family: Helvetica"><span class="form-input"><span class="form-sub-label-container"><span class="date-separate">D-</span>
      <input class="form-textbox" id="day_1" name="dia" type="text" size="2" maxlength="2" value="<? echo date("d", $date);?>" />
      <span class="date-separate">&nbsp;M-</span></span><span class="form-sub-label-container">
      <input class="form-textbox" id="month_1" name="mes" type="text" size="2" maxlength="2" value="<? echo date("m", $date);?>" />
      <span class="date-separate">&nbsp;A-</span></span><span class="form-sub-label-container">
      <input class="form-textbox" id="year_1" name="ano" type="text" size="4" maxlength="4" value="<? echo date("Y", $date);?>" />
      </span><span class="form-sub-label-container"><img alt="Elija una fecha" id="input_1_pick" src="http://spanish.jotform.com/images/calendar.png" align="absmiddle" /></span></span></th>
    </tr>
    <tr>
      <th align="left" style="font-family: Helvetica">Comentario</th>
      <th style="font-family: Helvetica"><label for="comen"></label>
      <input name="comen" type="text" id="comen" size="38" /></th>
    </tr>
    <tr>
      <th width="191" align="left" style="font-family: Helvetica">Cantidad  a  Abonar</th>
      <th style="font-family: Helvetica"><span id="sprytextfield1">
        <label for="abono"></label>
        <input name="abono" type="text" id="abono" size="38" />
      </span></th>
    </tr>
    <tr>
      <th colspan="2"><input type="image" src="aceptar.png"  onmouseover="src='aceptar1.png';"  onmouseout="src='aceptar.png';" value="Insertar Clientes" alt="aceptar" /></th>
    </tr>
  </table>
  
</form>

<p>&nbsp;</p>
<script type="text/javascript">
var sprytjamanfield1 = new Spry.Widget.ValidationTextField("sprytextfield1", "none", {validateOn:["blur"]});
</script>
</body>
</html>
<?php
mysql_free_result($dia);

mysql_free_result($mes);

mysql_free_result($anos);
?>
<?
$orden = $_GET['orden'];
$empre = import;
$saldo = $_GET['saldo'];
$abono= $_POST['abono'];
$trm= $_POST['trm'];
$metodo= $_POST['metodo'];

$dia=trim(strip_tags($_POST['dia']));
$mes=trim(strip_tags($_POST['mes']));
$ano=trim(strip_tags($_POST['ano']));
$fecha=$ano.'-'.$mes.'-'.$dia;

$docum=$_GET['docu'];
$comen=$_POST['comen'];

@$queEmp ="SELECT * FROM   d89xz_diario where factura='$factura'";
		@$resEmp = mysql_query($queEmp, $conexion) or die(mysql_error());
		@$totEmp = mysql_num_rows($resEmp);
					if ($totEmp> 0) {
						
						while ($rowEmp = mysql_fetch_assoc($resEmp)) {
						@$nombrep=	$rowEmp['cliente'];
						@$concep=	$rowEmp['concep'];
						@$clien=	$rowEmp['cel_client'];
							
							
						}
					}
@$prevee="$nombrep";
$concep1 = $concep;
$cliente= $clien;
//echo $concep1;
if($ano!=0){
	
	if($abono != 0){
$insertar = mysql_query("INSERT INTO `d89xz_abonos`( `orden`,`abono`,`fecha`,`empre`,`docu`) VALUES ('{$factura}','{$abono}','{$fecha}','{$comen}','{$prevee}')",$conexion);

if ($concep1=='Ingreso'){
$insertar = mysql_query("INSERT INTO d89xz_diario(`concep`,`descrip`,`estado`,`cantid`,`v_unit`,`v_tal`,`fecha`,`cliente`,`factura`,`cel_client`,`comen`) VALUES ('Ingreso','Abono Factura:$factura','Pago','1','{$abono}','{$abono}','{$fecha}','{$prevee}','{$factura}','{$cliente}','{$comen}')",$conexion);

}else{
	
	@$queEmp ="SELECT * FROM   d89xz_diario where factura='$factura'";
		@$resEmp = mysql_query($queEmp, $conexion) or die(mysql_error());
		@$totEmp = mysql_num_rows($resEmp);
					if ($totEmp> 0) {
						
						while ($rowEmp = mysql_fetch_assoc($resEmp)) {
						@$preve=$rowEmp['cel_prove'];
						
							
							
						}
					}

$prove1=$preve;
	$abono1= $abono * -1;
	$insertar = mysql_query("INSERT INTO d89xz_diario(`concep`,`descrip`,`estado`,`cantid`,`v_unit`,`v_tal`,`fecha`,`cliente`,`factura`,`cel_prove`,`comen`) VALUES ('Egreso','Abono Factura:$factura','Pago','1','{$abono}','{$abono1}','{$fecha}','{$prevee}','{$factura}','{$prove1}','{$comen}')",$conexion);
	
}

echo "<script type=''>
		window.location='detalle_abono.php?factura=". $factura. "';
	</script>";
	

	}else{
		echo "<script type=''>
		alert('Cuenta Saldada');
	</script>";
	}
}
?>
