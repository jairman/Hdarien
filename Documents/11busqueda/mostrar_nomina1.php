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
    JError::raiseError(1,"No puede acceder A esta Aplicación sin estar logueado... Consulte al Administrador....!!!");
$userx = JFactory::getUser();*/
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
$totalRows_nm = mysql_num_rows($nm);mysql_select_db($database_conexion, $conexion);
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
<link href="SpryAssets/SpryMenuBarHorizontal.css" rel="stylesheet" type="text/css" />
</head>

<body>
<ul id="MenuBar1" class="MenuBarHorizontal">
 
  <li><a href="mostrar_nomina.php"class="current" >Nomina</a>  </li>

  
</ul>
<p>&nbsp;</p>
<table width="100%" border="0" align="center" cellspacing="0">
  <tr bgcolor="#f0f0f0">
    <td width="121" align="left">&nbsp;</td>
    <td width="121" align="left">&nbsp;</td>
    <td width="308" align="center">&nbsp;</td>
    <td width="239" align="right"><a href="javascript:imprSelec('seleccion')" ><img src="imprimir.png" alt="" width="36" height="35" 

border="0" align="right" /></a></td>
  </tr>
</table>
<form id="form1" name="form1" method="post" action="">
  <table width="100%" border="1" align="center" cellspacing="0">
    <tr>
      <th bgcolor="#4D68A2">Movimientos Nomina</th>
      <th bgcolor="#4D68A2">&nbsp;</th>
      <th bgcolor="#4D68A2">&nbsp;</th>
      <th bgcolor="#4D68A2">&nbsp;</th>
    </tr>
    <tr>
      <td width="199"><strong>Empleado</strong></td>
      <td width="302" align="center"><span id="spryselect1">
        <label for="cedula2"></label>
        <select name="cedula" id="cedula2" style="width:140px">
          <option value="">Seleccione</option>
          <?php
do {  
?>
          <option value="<?php echo $row_em['cedula']?>"><?php echo $row_em['nombre'].'&nbsp;'. $row_em['apellido']?></option>
          <?php
} while ($row_em = mysql_fetch_assoc($em));
  $rows = mysql_num_rows($em);
  if($rows > 0) {
      mysql_data_seek($em, 0);
	  $row_em = mysql_fetch_assoc($em);
  }
?>
        </select>
      </span></td>
      <td width="184"><strong>Concepto</strong></td>
      <td width="349" align="center"><input type="text" name="concep" value="" size="30" /></td>
    </tr>
    <tr>
      <td><strong>Valor</strong></td>
      <td align="center"><span id="sprytextfield2">
      <label for="valor1"></label>
      <input name="valor1" type="text" id="valor1" size="18" />
      <span class="textfieldInvalidFormatMsg"></span></span></td>
      <td><strong>Método</strong></td>
      <td align="center"><span id="spryselect4">
        <label for="tipo"></label>
        <select name="tipo" id="tipo" style="width:137px">
          <option>Seleccione</option>
          <option value="Bonificacion">Bonificación</option>
          <option value="Prestamo">Préstamo</option>
          <option value="Pago">Pago Nomina</option>
          <option value="Abono">Abono De Empleado</option>
        </select>
      </span></td>
    </tr>
    <tr>
      <td><strong>Medio</strong></td>
      <th><span id="spryselect3">
        <label for="medio"></label>
        <select name="medio" id="medio"style="width:140px">
          <option value="">Seleccione Medio</option>
          <?php
do {  
?>
          <option value="<?php echo $row_met['metodo']?>"><?php echo $row_met['metodo']?></option>
          <?php
} while ($row_met = mysql_fetch_assoc($met));
  $rows = mysql_num_rows($met);
  if($rows > 0) {
      mysql_data_seek($met, 0);
	  $row_met = mysql_fetch_assoc($met);
  }
?>
        </select>
      </span></th>
      <td><strong>Referencia</strong></td>
      <td align="center"><label for="referncia"></label>
      <input name="referncia" type="text" id="referncia" size="30" /></td>
    </tr>
    <tr>
      <th colspan="4"><input type="image" src="aceptar.png"  onmouseover="src='aceptar1.png';"  onmouseout="src='aceptar.png';" value="Insertar Clientes" alt="aceptar" /></th>
    </tr>
  </table>
</form>




 <DIV ID="seleccion">
<table width="100%" border="1" align="center" cellspacing="0">
  <tr class="x">
    <th colspan="8" align="left" bgcolor="#FFFFFF"><img src="idsolutions--este.png" width="162" height="59" /></th>
  </tr>
  <tr class="x">
    <th colspan="6" bgcolor="#4D68A2">&nbsp;</th>
    <th colspan="2" bgcolor="#FFFFFF" class="n"><a href="nomina_alerta.php?cedula=<?php echo $row_nm['cedula']; ?>">Pago Completo</a></th>
  </tr>
  <tr class="x">
    <th width="79" bgcolor="#4D68A2">Cedula</th>
    <th width="91" bgcolor="#4D68A2">Nombre</th>
    <th width="90" bgcolor="#4D68A2">Apellido</th>
    <th width="84" bgcolor="#4D68A2">Funcion</th>
    <th width="76" bgcolor="#4D68A2">Salario</th>
    <th width="52" bgcolor="#4D68A2">Saldo</th>
    <th width="109" bgcolor="#4D68A2">Hacienda</th>
    <th width="50" bgcolor="#4D68A2">Pago</th>
  </tr>
  <?php do { ?>
    <tr align="center">
      <th><a href="nomina_este_si.php?cedula=<?php echo $row_nm['cedula']; ?>&amp;nombre=<?php echo $row_nm['nombre']; ?>&amp;apellido=<?php echo $row_nm['apellido']; ?>"><?php echo $row_nm['cedula']; ?></a></th>
      <td><?php echo $row_nm['nombre']; ?></td>
      <td><?php echo $row_nm['apellido']; ?></td>
      <td><?php echo $row_nm['funcion']; ?></td>
      <td><?php echo number_format ($row_nm['sueldo']); ?></td>
      <th><?php echo number_format( - $row_nm['s_total']+ $row_nm['bonifi']); ?></th>
      <td><?php echo $row_nm['hacienda']; ?></td>
      <td width="50" style="color: #4D68A2"><?php echo $row_nm['pago']; ?></td>
    </tr>
    <?php } while ($row_nm = mysql_fetch_assoc($nm)); ?>
</table>


<script type="text/javascript">
var spryselect1 = new Spry.Widget.ValidationSelect("spryselect1", {validateOn:["blur"]});
var sprytjamanield2 = new Spry.Widget.ValidationTextField("sprytextfield2", "integer", {validateOn:["blur"]});
var spryselect3 = new Spry.Widget.ValidationSelect("spryselect3", {validateOn:["blur"]});
var spryselect4 = new Spry.Widget.ValidationSelect("spryselect4", {validateOn:["blur"]});
</script>


</body>
</html>
<?php
mysql_free_result($nm);



mysql_free_result($dia);

mysql_free_result($mes);

mysql_free_result($em);

mysql_free_result($anos);

mysql_free_result($empl);

mysql_free_result($met);


?>
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
$cedula =$_POST['cedula'];
$concep =$_POST['concep'];
$tipo =$_POST['tipo'];
$valor =$_POST['valor1'];
$respon ="Teresa C";
$medio=$_POST['medio'];
$referencia = $_POST['referncia'];

$diab=trim(strip_tags($_POST['dia']));
$mesb=trim(strip_tags($_POST['mes']));
$anob=trim(strip_tags($_POST['anos']));

$queEmp ="SELECT * FROM `d89xz_empleados` WHERE `cedula`= '$cedula' ";
			$resEmp = mysql_query($queEmp, $conexion) or die(mysql_error());
			$totEmp = mysql_num_rows($resEmp);
					if ($totEmp> 0) {
						while ($rowEmp = mysql_fetch_assoc($resEmp)) {
							$nombre=$rowEmp['nombre'];
							
																	
								}
							}




  	if ($tipo == Bonificacion ){

$insertar = mysql_query("INSERT INTO d89xz_detalle_nomina (cedula,concep,valor,tipo,respon,metd,refer,fecha)
					VALUES ('{$cedula}','{$concep}','{$valor}','{$tipo}','{$respon}','{$medio}','{$referencia}',NOW())", $conexion);				
		
$insertar = mysql_query("UPDATE  `d89xz_empleados` SET `bonifi`=`bonifi` + $valor WHERE `cedula` = '$cedula'", $conexion);


echo "<script type=''>
		window.location='mostrar_nomina.php';
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
					VALUES ('{$cedula}','{$concep}','{$valor}','{$tipo}','{$respon}','{$medio}','{$referencia}',NOW())", $conexion);				
		
$insertar = mysql_query("UPDATE  `d89xz_empleados` SET `s_total`=`s_total` + $valor WHERE `cedula` = '$cedula'", $conexion);

$descrip = "Abono : $nombre";
$concepto = Ingreso;
$estado =Pago;
$cantidad =1;
$valor_unt =$valor;
$valor_t = $cantidad * $valor_unt;
$insertar = mysql_query("INSERT INTO d89xz_diario(`concep`,`descrip`,`estado`,`cantid`,`v_unit`,`v_tal`,`fecha`,`cliente`,`factura`) VALUES ('{$concepto}','{$descrip}','{$estado}','{$cantidad}','{$valor_unt}','{$valor_t}',NOW(),'{$nombre}','{$factura}')",$conexion);


$insertar1 = mysql_query("UPDATE `d89xz_consecu_orden` SET `factura`= factura + 1", $conexion);
echo "<script type=''>
		window.location='mostrar_nomina.php';
	</script>";
		
				}else{
				echo "<script type=''>
			alert('Cliente Paz  y  Salvo');
					</script>";
					
					echo "<script type=''>
		window.location='mostrar_nomina.php';
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
					VALUES ('{$cedula}','{$concep}','{$valor}','{$tipo}','{$respon}','{$medio}','{$referencia}',NOW())", $conexion);				
		
$insertar = mysql_query("UPDATE  `d89xz_empleados` SET `s_total`=`s_total` + $valor WHERE `cedula` = '$cedula'", $conexion);

$descrip = "Prestamo:$nombre";
$concepto = Egreso;
$estado =Pago;
$cantidad =1;
$valor_unt =$valor;
$valor_t = $cantidad * $valor_unt *-1;

					
$insertar = mysql_query("INSERT INTO d89xz_diario(`concep`,`descrip`,`estado`,`cantid`,`v_unit`,`v_tal`,`fecha`,`cliente`,`factura`) VALUES ('{$concepto}','{$descrip}','{$estado}','{$cantidad}','{$valor_unt}','{$valor_t}',NOW(),'{$nombre}','{$factura}')",$conexion);

$insertar1 = mysql_query("UPDATE `d89xz_consecu_orden` SET `factura`= factura + 1", $conexion);
echo "<script type=''>
		window.location='mostrar_nomina.php';
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
	$total_sueldo =  - $prestamo + $bonificasiones;
	$total_sueldo1= number_format( $total_sueldo);
	echo"Saldo Total: $total_sueldo1";
	echo"<br>";
	$abono=$sueldo- $valor;
	$abono1 = number_format( $abono);
	echo"Abono Total: $abono1";
	echo"<br>";
	$sumas=$abono + $total_sueldo;
	$sumastales =$sumas * -1;
	//echo "Antes Sumas: $sumas";
	//echo"<br>";
	$suel_total = $sueldo - $prestamo + $bonificasiones;
	//echo"suel_total:$suel_total";
	echo"<br>";
	$favor =$suel_total - $valor;
	//echo"Saldo a Favor : $favor";
	
$insertar = mysql_query("UPDATE  `d89xz_empleados` SET `s_total`= '0',`bonifi`='0' WHERE `cedula` = '$cedula'", $conexion);
					
$insertar = mysql_query("INSERT INTO d89xz_detalle_nomina (cedula,concep,valor,tipo,respon,metd,refer,fecha)
					VALUES ('{$cedula}','{$concep}','{$valor}','{$tipo}','{$respon}','{$medio}','{$referencia}',NOW())", $conexion);				
		 
// Saldo en	Contra	
		if ($total_sueldo < 0){
			//echo"Despues sumas: $sumas";
$insertar1 = mysql_query("UPDATE  `d89xz_empleados` SET `s_total`= '$sumastales' WHERE `cedula` = '$cedula'", $conexion);
}
// Saldo  a Favor
	if ($favor > 0){
		$favor1 = number_format($favor);
			echo"Saldo a Favor: $favor1";
$insertar1 = mysql_query("UPDATE  `d89xz_empleados` SET `bonifi`= '$favor' WHERE `cedula` = '$cedula'", $conexion);
}
		
		
$descrip = "Pago Nomina : $nombre";
$concepto = Egreso;
$estado =Pago;
$cantidad =1;
$valor_unt =$valor;
$valor_t = $cantidad * $valor_unt * -1;

$insertar1 = mysql_query("UPDATE  `d89xz_empleados` SET `pago`= 'Pago' WHERE `cedula` = '$cedula'", $conexion);
					
$insertar = mysql_query("INSERT INTO d89xz_diario(`concep`,`descrip`,`estado`,`cantid`,`v_unit`,`v_tal`,`fecha`,`cliente`,`factura`) VALUES ('{$concepto}','{$descrip}','{$estado}','{$cantidad}','{$valor_unt}','{$valor_t}',NOW(),'{$nombre}','{$factura}')",$conexion);

$insertar1 = mysql_query("UPDATE `d89xz_consecu_orden` SET `factura`= factura + 1", $conexion);	

echo "<script type=''>
		window.location='mostrar_nomina.php';
	</script>";

}
 
?>
<?
mysql_close($conexion);
?>