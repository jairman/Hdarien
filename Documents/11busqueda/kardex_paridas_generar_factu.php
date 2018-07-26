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
$query_prov = "SELECT * FROM d89xz_clientes";
$prov = mysql_query($query_prov, $conexion) or die(mysql_error());
$row_prov = mysql_fetch_assoc($prov);
$totalRows_prov = mysql_num_rows($prov);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Documento sin título</title>
<script src="SpryAssets/SpryValidationSelect.js" type="text/javascript"></script>
<link href="SpryAssets/SpryValidationSelect.css" rel="stylesheet" type="text/css" />
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
    <td width="162" align="left"><img src="idsolutions--este.png" alt="" width="162" height="59" /></td>
    <td width="769" align="center"><a href="kardex_paridas_semanal_total_leche.php"><img src="last.png" alt="" width="29" height="31" /></a></td>
    <td width="162" align="right">&nbsp;</td>
  </tr>
</table>
<form id="form1" name="form1" method="post" action="">
  <table width="513" border="1" align="center" cellspacing="0">
    <tr bgcolor="#4D68A2" style="color: #FFF">
      <th colspan="3">Datos de Factura  De  Proveedor</th>
    </tr>
    <tr>
      <th width="182" align="left" bgcolor="#FFFFFF" style="color: #000">Cliente</th>
      <td width="315" colspan="2"><span id="spryselect1" style="width:500">
        <label for="prove"></label>
        <span id="spryselect3">
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
        </span></span></td>
    </tr>
    <tr>
      <th align="left" bgcolor="#FFFFFF" style="color: #000">Fecha de Ingreso</th>
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
      <th align="left" bgcolor="#FFFFFF" style="color: #000">Condiciones Pago</th>
      <td colspan="2"><span id="spryselect6">
        <label for="estado"></label>
        <select name="estado" id="estado" style="width:315px">
          <option>Seleccione Estado</option>
          <option value="Pago">Pago</option>
          <option value="Pendiente">Pendiente</option>
        </select>
      </span></td>
    </tr>
    <tr>
      <th align="left" bgcolor="#FFFFFF" style="color: #000">Fecha de Pago</th>
      <td colspan="2">  <span class="date-separate">&nbsp;D-</span>
        <input class="noDefault form-textbox" id="day_3" name="dia1" type="text" size="2" maxlength="2" value="<? echo date("d", $date);?>" />
        <span class="date-separate">&nbsp;M-</span>
<input class="form-textbox" id="month_3" name="mes1" type="text" size="2" maxlength="2" value="<? echo date("m", $date);?>" />
<span class="date-separate">&nbsp;A-</span>
<input class="form-textbox" id="year_3" name="anos1" type="text" size="4" maxlength="4" value="<? echo date("Y", $date);?>" />
           
            
<img alt="Elija una fecha" id="input_3_pick" src="http://spanish.jotform.com/images/calendar.png" align="absmiddle" /></td>
    </tr>
    <tr bgcolor="#4D68A2" style="color: #FFF">
      <th colspan="3" bgcolor="#FFFFFF"><input type="image" src="aceptar.png"  onmouseover="src='aceptar1.png';"  onmouseout="src='aceptar.png';" value="Insertar Clientes" alt="aceptar"  onclick="return confirm('Desea Generar Factura ');"/></th>
    </tr>
  </table>
</form>

<?php

mysql_free_result($prov);

?>
<script type="text/javascript">
var spryselect1 = new Spry.Widget.ValidationSelect("spryselect1", {validateOn:["blur"]});
var spryselect3 = new Spry.Widget.ValidationSelect("spryselect3", {validateOn:["blur"]});
var spryselect6 = new Spry.Widget.ValidationSelect("spryselect6", {validateOn:["blur"]});
var spryselect3 = new Spry.Widget.ValidationSelect("spryselect3", {validateOn:["blur"]});
</script>

<?
@$diab=trim(strip_tags($_POST['dia']));
@$mesb=trim(strip_tags($_POST['mes']));
@$anob=trim(strip_tags($_POST['anos']));
@$f_fact=$anob.'-'.$mesb.'-'.$diab;

//echo $f_fact;

@$dia=trim(strip_tags($_POST['dia1']));
@$mes=trim(strip_tags($_POST['mes1']));
@$ano=trim(strip_tags($_POST['anos1']));
@$f_pago=$ano.'-'.$mes.'-'.$dia;

//echo $f_pago;
@$prove=$_POST['prove'];
@$f_prove=$_POST['f_prove'];

@$estado=$_POST['estado'];
@$valor_unit=$_GET['valor_unit'];
@$fecha_sem =$_GET['fecha1'];
@$total =$_GET['total'];
@$semana=$_GET['semana'];
@$totaldes =$_GET['totaldes'];
@$total1=$total-$totaldes;

 $total_pesos = $total1 * $valor_unit;

// conse
@$queEmp ="SELECT * FROM  d89xz_consecu_orden";
					@$resEmp = mysql_query($queEmp, $conexion) or die(mysql_error());
					@$totEmp = mysql_num_rows($resEmp);
					if ($totEmp> 0) {
						
						while ($rowEmp = mysql_fetch_assoc($resEmp)) {
						@$consecutivo=	$rowEmp['factura'];	
							
						}
					}
					
					
@$queEmp ="SELECT * FROM  d89xz_clientes where cedula='$prove'";
					@$resEmp = mysql_query($queEmp, $conexion) or die(mysql_error());
					@$totEmp = mysql_num_rows($resEmp);
					if ($totEmp> 0) {
						
						while ($rowEmp = mysql_fetch_assoc($resEmp)) {
						@$nombre=	$rowEmp['nombre'];
						@$apellido=	$rowEmp['apellido'];
						@$empresa=	$rowEmp['empresa'];	
							
						}
					}
@$cliente="$nombre";
					
				
if($estado !=''){

$descrip = "Venta De Leche Semana:$semana";
$concepto = Ingreso;



					
$insertar = mysql_query("INSERT INTO d89xz_diario(`concep`,`descrip`,`estado`,`cantid`,`v_unit`,`v_tal`,`fecha`,`cliente`,`f_alarma`,`factura`,`cel_client`) VALUES ('{$concepto}','{$descrip}','{$estado}','{$total1}','{$valor_unit}','{$total_pesos}','{$f_fact}','{$cliente}','{$f_pago}','{$consecutivo}','{$prove}')",$conexion);

$insertar1 = mysql_query("UPDATE `d89xz_consecu_orden` SET `factura`= factura + 1", $conexion);
$insertar12 = mysql_query("UPDATE `d89xz_detalle_leche` SET `liquidado`='si' where fact='5' ", $conexion);

	if($estado==Pendiente){
		
		$insertar = mysql_query("INSERT INTO `d89xz_tareas`(`fecha`,`estado`,`tarea`,`comen`,`jorn`) VALUES ('{$f_pago}','{$estado}','Venta :Pendiente Pago de Factura N°.$consecutivo','Venta De Leche ','{$f_pago}')",$conexion);
		
		
		}



echo "<script type=''>
		window.location='kardex_paridas_semanal_total_leche.php';
	</script>";
}

?>

</body>
</html>
<?php
mysql_close($conexion);
//mysql_free_result($prov);
?>
