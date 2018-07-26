<?
$ruta_a_joomla = "/../../Hdarien/";

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
$query_nm = "SELECT * FROM d89xz_empleados";
$nm = mysql_query($query_nm, $conexion) or die(mysql_error());
$row_nm = mysql_fetch_assoc($nm);
$totalRows_nm = mysql_num_rows($nm);
$query_nm = "SELECT * FROM d89xz_empleados";
$nm = mysql_query($query_nm, $conexion) or die(mysql_error());
$row_nm = mysql_fetch_assoc($nm);
$totalRows_nm = mysql_num_rows($nm);
$query_nm = "SELECT * FROM d89xz_empleados";
$nm = mysql_query($query_nm, $conexion) or die(mysql_error());
$row_nm = mysql_fetch_assoc($nm);
$totalRows_nm = mysql_num_rows($nm);


//// aca

mysql_select_db($database_conexion, $conexion);
$query_dia = "SELECT dias FROM d89xz_dias";
$dia = mysql_query($query_dia, $conexion) or die(mysql_error());
$row_dia = mysql_fetch_assoc($dia);
$totalRows_dia = mysql_num_rows($dia);

mysql_select_db($database_conexion, $conexion);
$query_mes = "SELECT meses FROM d89xz_meses";
$mes = mysql_query($query_mes, $conexion) or die(mysql_error());
$row_mes = mysql_fetch_assoc($mes);
$totalRows_mes = mysql_num_rows($mes);

mysql_select_db($database_conexion, $conexion);
$query_em = "SELECT * FROM d89xz_empleados";
$em = mysql_query($query_em, $conexion) or die(mysql_error());
$row_em = mysql_fetch_assoc($em);
$totalRows_em = mysql_num_rows($em);

mysql_select_db($database_conexion, $conexion);
$query_anos = "SELECT * FROM d89xz_anos";
$anos = mysql_query($query_anos, $conexion) or die(mysql_error());
$row_anos = mysql_fetch_assoc($anos);
$totalRows_anos = mysql_num_rows($anos);

mysql_select_db($database_conexion, $conexion);
$query_empl = "SELECT * FROM d89xz_empleados";
$empl = mysql_query($query_empl, $conexion) or die(mysql_error());
$row_empl = mysql_fetch_assoc($empl);
$totalRows_empl = mysql_num_rows($empl);

mysql_select_db($database_conexion, $conexion);
$query_met = "SELECT * FROM d89xz_metodo_pago";
$met = mysql_query($query_met, $conexion) or die(mysql_error());
$row_met = mysql_fetch_assoc($met);
$totalRows_met = mysql_num_rows($met);

$colname_cd = "-1";
if (isset($_GET['cedula'])) {
  $colname_cd = $_GET['cedula'];
}
mysql_select_db($database_conexion, $conexion);
$query_cd = sprintf("SELECT * FROM d89xz_empleados WHERE cedula = %s", GetSQLValueString($colname_cd, "text"));
$cd = mysql_query($query_cd, $conexion) or die(mysql_error());
$row_cd = mysql_fetch_assoc($cd);
$totalRows_cd = mysql_num_rows($cd);
$fecha=date("Y-m-d");
//echo $fecha;
$date = strtotime($fecha);



?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Documento sin título</title>

<!-- aca -->
<script src="SpryAssets/SpryValidationSelect.js" type="text/javascript"></script>
<script src="SpryAssets/SpryValidationTextField.js" type="text/javascript"></script>
<link href="SpryAssets/SpryValidationSelect.css" rel="stylesheet" type="text/css" />
<link href="SpryAssets/SpryValidationTextField.css" rel="stylesheet" type="text/css" />
<style type="text/css">
#form1 table tr th {
	color: #FFF;
}
</style>



 <style> 
a{text-decoration:none} 
</style>




<style type="text/css">
.x {
	color: #FFF;
}
#v {
	color: #000;
}
.n {
	color: #000;
}
</style>
<script>
  
  function checkSubmit() {
    document.getElementById("btsubmit").value = "Enviando Pago Nomina...";
    document.getElementById("btsubmit").disabled = true;
    return true;
}
  
  </script>


<link href="SpryAssets/SpryMenuBarHorizontal.css" rel="stylesheet" type="text/css" />
</head>

<body>

<p>&nbsp;</p>
<form id="form1" name="form1" method="post" action="" onsubmit="return checkSubmit();">
  <table width="500" border="1" align="center" cellspacing="0">
    <tr>
      <th bgcolor="#4D68A2">Movimientos Nomina</th>
      <th bgcolor="#4D68A2">&nbsp;</th>
    </tr>
    <tr>
      <th align="left" style="color: #000">Fecha</th>
      <td align="center"><div id="cid_3" class="form-input"><span class="form-sub-label-container"> D
        <input class="form-textbox" id="day_3" name="dia" type="tel" size="2" maxlength="2" value="<? echo date("d", $date);?>" />
        <span class="date-separate">&nbsp;M</span> <span class="form-sub-label-container">
          <input class="form-textbox" id="month_3" name="mes" type="tel" size="2" maxlength="2" value="<? echo date("m", $date);?>" />
          <span class="date-separate">&nbsp;A</span></span><span class="form-sub-label-container">
            <input class="form-textbox" id="year_3" name="anos" type="tel" size="4" maxlength="4" value="<? echo date("Y", $date);?>" />
            </span><span class="form-sub-label-container"><img class="showAutoCalendar" alt="Seleccióna una fecha" id="input_3_pick" src="http://cdn.jotfor.ms/images/calendar.png" align="absmiddle" />
              <label class="form-sub-label" for="input_3_pick"> </label>
      </span></div></td>
    </tr>
    <tr>
      <td width="199"><strong>Empleado</strong></td>
      <td width="302" align="center"><span id="spryselect1">
        <label for="cedula2"></label>
        <input name="cedula " type="text" id="cedula " value="<?php echo $row_cd['nombre'].'&nbsp;'. $row_cd['apellido'] ?>" size="44" />
      </span></td>
    </tr>
    <tr>
      <td><strong>Concepto</strong></td>
      <td align="center"><input type="text" name="concep" value="Pago " size="44" /></td>
    </tr>
    <tr>
      <td><strong>Método</strong></td>
      <td align="center"><span id="spryselect4">
        <label for="tipo"></label>
        <select name="tipo" id="tipo" style="width:300px">
          <option>Seleccione</option>
          <option value="Bonificacion">Bonificación</option>
          <option value="Prestamo">Préstamo</option>
          <option value="Pago" selected="selected">Pago Nomina</option>
          <option value="Abono">Abono De Empleado</option>
        </select>
      </span></td>
    </tr>
    <tr>
      <td><strong>Valor</strong></td>
      <td align="center"><span id="sprytextfield2">
        <label for="valor1"></label>
        <input name="valor1" type="text" id="valor1" value="<?php echo $row_cd['sueldo']; ?>" size="44" />
      <span class="textfieldInvalidFormatMsg"></span></span></td>
    </tr>
    <tr>
      <th colspan="2"><input type="submit" name="btsubmit" id="btsubmit" value="Pago Nomina" /></th>
    </tr>
  </table>
</form>




 <DIV ID="seleccion">
<p>&nbsp;</p>
<p>&nbsp;</p>


<script type="text/javascript">
var spryselect1 = new Spry.Widget.ValidationSelect("spryselect1", {validateOn:["blur"]});
var sprytjamanield2 = new Spry.Widget.ValidationTextField("sprytextfield2", "integer", {validateOn:["blur"]});
var spryselect4 = new Spry.Widget.ValidationSelect("spryselect4", {validateOn:["blur"]});
   </script>
</body>
</html>

</DIV> 

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





<?
 $cedula =$row_cd['cedula'];

  $nombre=$row_cd['nombre'].'&nbsp;'. $row_cd['apellido'];

$sede1= $row_cd['hacienda'];

$concep =$_POST['concep'];
$tipo =$_POST['tipo'];
$valor =$_POST['valor1'];
$respon ="Teresa C";
$medio=$_POST['medio'];
$referencia = $_POST['referncia'];

@$diab=trim(strip_tags($_POST['dia']));
@$mesb=trim(strip_tags($_POST['mes']));
@$anob=trim(strip_tags($_POST['anos']));
@$siembra=$anob.'-'.$mesb.'-'.$diab;

$queEmp ="SELECT * FROM `d89xz_empleados` WHERE `cedula`= '$cedula' ";
			$resEmp = mysql_query($queEmp, $conexion) or die(mysql_error());
			$totEmp = mysql_num_rows($resEmp);
					if ($totEmp> 0) {
						while ($rowEmp = mysql_fetch_assoc($resEmp)) {
							/*$nombre=$rowEmp['nombre'];
							$sede1= $rowEmp['hacienda'];*/
							
																	
								}
							}
							//echo $sede1;

  	if ($tipo == Bonificacion ){

$insertar = mysql_query("INSERT INTO d89xz_detalle_nomina (cedula,concep,valor,tipo,respon,metd,refer,fecha)
					VALUES ('{$cedula}','{$concep}','{$valor}','{$tipo}','{$respon}','{$medio}','{$referencia}','{$siembra}')", $conexion);				
		
$insertar = mysql_query("UPDATE  `d89xz_empleados` SET `bonifi`=`bonifi` + $valor WHERE `cedula` = '$cedula'", $conexion);


echo " <script type='text/javascript'>

  		 parent.location.reload();

			</script>";

		}
		
		
			if ($tipo == Abono ){
$queEmp ="SELECT * FROM  d89xz_consecu_orden";
					$resEmp = mysql_query($queEmp, $conexion) or die(mysql_error());
					$totEmp = mysql_num_rows($resEmp);
					if ($totEmp> 0) {
						
						while ($rowEmp = mysql_fetch_assoc($resEmp)) {
						$factura=	$rowEmp['factura'];	
								
							}
					}				


$queEmp ="SELECT * FROM `d89xz_empleados` WHERE `cedula`= '$cedula' ";
			$resEmp = mysql_query($queEmp, $conexion) or die(mysql_error());
			$totEmp = mysql_num_rows($resEmp);
					if ($totEmp> 0) {
						while ($rowEmp = mysql_fetch_assoc($resEmp)) {
							$s_total=	$rowEmp['s_total'];
							
																	
								}
							}
			if($s_total > 0){
$insertar = mysql_query("INSERT INTO d89xz_detalle_nomina (cedula,concep,valor,tipo,respon,metd,refer,fecha)
					VALUES ('{$cedula}','{$concep}','{$valor}','{$tipo}','{$respon}','{$medio}','{$referencia}','{$siembra}')", $conexion);				
		
$insertar = mysql_query("UPDATE  `d89xz_empleados` SET `s_total`=`s_total` + $valor WHERE `cedula` = '$cedula'", $conexion);

$descrip = "Abono : $nombre";
$concepto = Ingreso;
$estado =Pago;
$cantidad =1;
$valor_unt =$valor;
$valor_t = $cantidad * $valor_unt;
$insertar = mysql_query("INSERT INTO d89xz_diario(`concep`,`descrip`,`estado`,`cantid`,`v_unit`,`v_tal`,`fecha`,`cliente`,`factura`) VALUES ('{$concepto}','{$descrip}','{$estado}','{$cantidad}','{$valor_unt}','{$valor_t}','$siembra','{$nombre}','{$factura}')",$conexion);


$insertar1 = mysql_query("UPDATE `d89xz_consecu_orden` SET `factura`= factura + 1", $conexion);
echo " <script type='text/javascript'>

  		 parent.location.reload();

			</script>";
		
				}else{
				echo "<script type=''>
			alert('Cliente Paz  y  Salvo');
					</script>";
					
			echo " <script type='text/javascript'>

  		 parent.location.reload();

			</script>";
				
			}
		}
	
	
	
	if ($tipo == Prestamo ){
			
		
			$queEmp ="SELECT * FROM  d89xz_consecu_orden";
					$resEmp = mysql_query($queEmp, $conexion) or die(mysql_error());
					$totEmp = mysql_num_rows($resEmp);
					if ($totEmp> 0) {
						
						while ($rowEmp = mysql_fetch_assoc($resEmp)) {
						$factura=	$rowEmp['factura'];	
								
							}
					}
					
$insertar = mysql_query("INSERT INTO d89xz_detalle_nomina (cedula,concep,valor,tipo,respon,metd,refer,fecha)
					VALUES ('{$cedula}','{$concep}','{$valor}','{$tipo}','{$respon}','{$medio}','{$referencia}','{$siembra}')", $conexion);				
		
$insertar = mysql_query("UPDATE  `d89xz_empleados` SET `s_total`=`s_total` + $valor WHERE `cedula` = '$cedula'", $conexion);

$descrip = "Prestamo:$nombre";
$concepto = Egreso;
$estado =Pago;
$cantidad =1;
$valor_unt =$valor;
$valor_t = $cantidad * $valor_unt *-1;

					
$insertar = mysql_query("INSERT INTO d89xz_diario(`concep`,`descrip`,`estado`,`cantid`,`v_unit`,`v_tal`,`fecha`,`cliente`,`factura`) VALUES ('{$concepto}','{$descrip}','{$estado}','{$cantidad}','{$valor_unt}','{$valor_t}','$siembra','{$nombre}','{$factura}')",$conexion);

$insertar1 = mysql_query("UPDATE `d89xz_consecu_orden` SET `factura`= factura + 1", $conexion);
echo " <script type='text/javascript'>

  		 parent.location.reload();

			</script>";

		}
		
		
if ($tipo == Pago ){
	
	
		$queEmp ="SELECT * FROM  d89xz_consecu_orden";
					$resEmp = mysql_query($queEmp, $conexion) or die(mysql_error());
					$totEmp = mysql_num_rows($resEmp);
					if ($totEmp> 0) {
						
						while ($rowEmp = mysql_fetch_assoc($resEmp)) {
						$factura=	$rowEmp['factura'];	
								
							}
					}
	
	
	$queEmp ="SELECT * FROM `d89xz_empleados` WHERE `cedula`= '$cedula'";
					$resEmp = mysql_query($queEmp, $conexion) or die(mysql_error());
					$totEmp = mysql_num_rows($resEmp);

					if ($totEmp> 0) {
							 
						while ($rowEmp = mysql_fetch_assoc($resEmp)) {
						$sueldo=	$rowEmp['sueldo'];
						$prestamo=	$rowEmp['s_total'];
						$bonificasiones= $rowEmp['bonifi'];
						
										
						}
					}
	$sede= $sede1;				
	$total_sueldo =  - $prestamo + $bonificasiones;
	$total_sueldo1= number_format( $total_sueldo);
	//echo"Saldo Total: $total_sueldo1";
	//echo"<br>";
	$abono=$sueldo- $valor;
	$abono1 = number_format( $abono);
	//echo"Abono Total: $abono1";
	//echo"<br>";
	$sumas=$abono + $total_sueldo;
	$sumastales =$sumas * -1;
	//echo "Antes Sumas: $sumas";
	//echo"<br>";
	$suel_total = $sueldo - $prestamo + $bonificasiones;
	//echo"suel_total:$suel_total";
	//echo"<br>";
	$favor =$suel_total - $valor;
	//echo"Saldo a Favor : $favor";
	
$insertar = mysql_query("UPDATE  `d89xz_empleados` SET `s_total`= '0',`bonifi`='0' WHERE `cedula` = '$cedula'", $conexion);
					
$insertar = mysql_query("INSERT INTO d89xz_detalle_nomina (cedula,concep,valor,tipo,respon,metd,refer,fecha)
					VALUES ('{$cedula}','{$concep}','{$valor}','{$tipo}','{$respon}','{$medio}','{$referencia}','{$siembra}')", $conexion);				
		 
// Saldo en	Contra	
		if ($total_sueldo < 0){
			//echo"Despues sumas: $sumas";
$insertar1 = mysql_query("UPDATE  `d89xz_empleados` SET `s_total`= '$sumastales' WHERE `cedula` = '$cedula'", $conexion);
}
// Saldo  a Favor
	if ($favor > 0){
		$favor1 = number_format($favor);
			//echo"Saldo a Favor: $favor1";
$insertar1 = mysql_query("UPDATE  `d89xz_empleados` SET `bonifi`= '$favor' WHERE `cedula` = '$cedula'", $conexion);
}
		
		
$descrip = "Pago Nomina : $nombre";
$concepto = Egreso;
$estado =Pago;
$cantidad =1;
$valor_unt =$valor;
$valor_t = $cantidad * $valor_unt * -1;

$insertar1 = mysql_query("UPDATE  `d89xz_empleados` SET `pago`= 'Pago' WHERE `cedula` = '$cedula'", $conexion);
					
$insertar = mysql_query("INSERT INTO d89xz_diario(`concep`,`descrip`,`estado`,`cantid`,`v_unit`,`v_tal`,`fecha`,`cliente`,`factura`,`comen`) VALUES ('{$concepto}','{$descrip}','{$estado}','{$cantidad}','{$valor_unt}','{$valor_t}','$siembra','{$nombre}','{$factura}','{$sede}')",$conexion);

$insertar1 = mysql_query("UPDATE `d89xz_consecu_orden` SET `factura`= factura + 1", $conexion);	

echo " <script type='text/javascript'>

  		 parent.location.reload();

			</script>";

}
 
?>
<?
mysql_close($conexion);
?>
<?php
mysql_free_result($nm);



mysql_free_result($dia);

mysql_free_result($mes);

mysql_free_result($em);

mysql_free_result($anos);

mysql_free_result($empl);

mysql_free_result($met);

mysql_free_result($cd);


?>

<script src="http://cdn.jotfor.ms/static/jotform.js?3.1.1008" type="text/javascript"></script>
<script type="text/javascript">
   JotForm.init(function(){
      JotForm.setCalendar("3", false);
      JotForm.displayLocalTime("hour_3", "min_3", "ampm_3");
   });
</script>
<link href="http://cdn.jotfor.ms/static/formCss.css?3.1.1008" rel="stylesheet" type="text/css" />
<link type="text/css" rel="stylesheet" href="http://cdn.jotfor.ms/css/styles/nova.css?3.1.1008" />
<link type="text/css" media="print" rel="stylesheet" href="http://cdn.jotfor.ms/css/printForm.css?3.1.1008" />
<style type="text/css">
    .form-label{
        width:150px !important;
    }
    .form-label-left{
        width:150px !important;
    }
    .form-line{
        padding-top:12px;
        padding-bottom:12px;
    }
    .form-label-right{
        width:150px !important;
    }
    .form-all{
        width:650px;
        color:#555 !important;
        font-family:'Lucida Grande';
        font-size:14px;
    }
</style>
  <script type="text/javascript">
  document.getElementById("si" + "mple" + "_spc").value = "31845393089666-31845393089666";
  
  
  

  </script>

