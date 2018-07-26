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
$query_em = "SELECT cedula FROM d89xz_empleados";
$em = mysql_query($query_em, $conexion) or die(mysql_error());
$row_em = mysql_fetch_assoc($em);
$totalRows_em = mysql_num_rows($em);

mysql_select_db($database_conexion, $conexion);
$query_anos = "SELECT * FROM d89xz_anos";
$anos = mysql_query($query_anos, $conexion) or die(mysql_error());
$row_anos = mysql_fetch_assoc($anos);
$totalRows_anos = mysql_num_rows($anos);
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
<style type="text/css">
#form1 table tr th {
	color: #FFF;
}
</style>
</head>

<body>
<img src="idsolutions--este.png" width="162" height="59" />
<form id="form1" name="form1" method="post" action="">
  <table width="530" border="1">
    <tr>
      <th colspan="5" bgcolor="#4D68A2">Movimientos Nomina</th>
    </tr>
    <tr>
      <td width="77"><strong>Cedula</strong></td>
      <td width="101"><span id="spryselect1">
        <label for="cedula2"></label>
        <select name="cedula" id="cedula2">
          <option value="">Seleccione</option>
          <?php
do {  
?>
          <option value="<?php echo $row_em['cedula']?>"><?php echo $row_em['cedula']?></option>
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
      <td width="61">Concepto</td>
      <td width="193"><input type="text" name="concep" value="" size="30" /></td>
      <td width="84"><span id="spryselect4">
        <label for="tipo"></label>
        <select name="tipo" id="tipo">
          <option>Seleccione</option>
          <option value="Bonificacion">Bonificación</option>
          <option value="Prestamo">Préstamo</option>
          <option value="Pago">Pago</option>
        </select>
      </span></td>
</tr>
    <tr>
      <td>Valor</td>
      <td><span id="sprytextfield2">
      <label for="valor1"></label>
      <input name="valor1" type="text" id="valor1" size="12" />
      <span class="textfieldInvalidFormatMsg"></span></span></td>
      <td>Fecha</td>
      <td>D<span id="spryselect2">
        <label for="dia"></label>
        <select name="dia" id="dia">
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
      </span>M<span id="spryselect3">
      <label for="mes"></label>
      <select name="mes" id="mes">
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
      </span>A<span id="spryselect5">
      <label for="anos"></label>
      <select name="anos" id="anos">
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
      <td><input type="submit" value="Registrar" /></td>
    </tr>
    <tr> </tr>
    <tr> </tr>
  </table>
</form>
<script type="text/javascript">
var spryselect3 = new Spry.Widget.ValidationSelect("spryselect3", {validateOn:["blur"]});
var spryselect2 = new Spry.Widget.ValidationSelect("spryselect2", {validateOn:["blur"]});
var spryselect4 = new Spry.Widget.ValidationSelect("spryselect4", {validateOn:["blur"]});
var spryselect1 = new Spry.Widget.ValidationSelect("spryselect1", {validateOn:["blur"]});
var sprytjamanield2 = new Spry.Widget.ValidationTextField("sprytextfield2", "integer", {validateOn:["blur"]});
var spryselect5 = new Spry.Widget.ValidationSelect("spryselect5", {validateOn:["blur"]});
</script>
</body>
</html>


<?
$cedula =$_POST['cedula'];
$concep =$_POST['concep'];
$tipo =$_POST['tipo'];
$valor =$_POST['valor1'];

$diab=trim(strip_tags($_POST['dia']));
$mesb=trim(strip_tags($_POST['mes']));
$anob=trim(strip_tags($_POST['anos']));
$fecha=$anob.'-'.$mesb.'-'.$diab;


?>


<?

 
  	if ($tipo == Bonificacion ){

		
					if (!$conexion) {
								die("Fallo la conexión a la Base de Datos: " . mysql_error());
									}
	
					if (!$seleccionar_bd) {
								die("Fallo la selección de la Base de Datos: " . mysql_error());
									}
		$insertar = mysql_query("INSERT INTO d89xz_detalle_nomina (cedula,concep,valor,tipo,fecha)
					VALUES ('{$cedula}','{$concep}','{$valor}','{$tipo}','{$fecha}')", $conexion);				
		
$insertar = mysql_query("UPDATE  `d89xz_empleados` SET `s_total`=`s_total` + $valor WHERE `cedula` = '$cedula'", $conexion);
		
		if (!$insertar) {
				die("Fallo en la insercion de registro en la Base de Datos: " . mysql_error());
					}

//mysql_close($conexion);

		}
	
	
	
	if ($tipo == Prestamo ){

		
					if (!$conexion) {
								die("Fallo la conexión a la Base de Datos: " . mysql_error());
									}
		
					if (!$seleccionar_bd) {
								die("Fallo la selección de la Base de Datos: " . mysql_error());
									}
		$insertar = mysql_query("INSERT INTO d89xz_detalle_nomina (cedula,concep,valor,tipo,fecha)
					VALUES ('{$cedula}','{$concep}','{$valor}','{$tipo}','{$fecha}')", $conexion);				
		
$insertar = mysql_query("UPDATE  `d89xz_empleados` SET `s_total`=`s_total` - $valor WHERE `cedula` = '$cedula'", $conexion);

$descrip = Prestamo.'-'. $cedula;
$concepto = Compra;
$estado =Pago;
$cantidad =1;
$valor_unt =$valor;
$valor_t = $cantidad * $valor_unt *-1;

					
$insertar = mysql_query("INSERT INTO d89xz_diario(`concep`,`descrip`,`estado`,`cantid`,`v_unit`,`v_tal`,`fecha`) VALUES ('{$concepto}','{$descrip}','{$estado}','{$cantidad}','{$valor_unt}','{$valor_t}',NOW())",$conexion);

		
		if (!$insertar) {
				die("Fallo en la insercion de registro en la Base de Datos: " . mysql_error());
					}

//mysql_close($conexion);

		}
		
		
if ($tipo == Pago ){

		
					if (!$conexion) {
								die("Fallo la conexión a la Base de Datos: " . mysql_error());
									}
	
					if (!$seleccionar_bd) {
								die("Fallo la selección de la Base de Datos: " . mysql_error());
									}
		$insertar = mysql_query("INSERT INTO d89xz_detalle_nomina (cedula,concep,valor,tipo,fecha)
					VALUES ('{$cedula}','{$concep}','{$valor}','{$tipo}','{$fecha}')", $conexion);				
		
		$insertar = mysql_query("UPDATE  `d89xz_empleados` SET `s_total`=`s_total` + $valor WHERE `cedula` = '$cedula'", $conexion);
		
		
		
$descrip = Nomina.'-'. $cedula;
$concepto = Compra;
$estado =Pago;
$cantidad =1;
$valor_unt =$valor;
$valor_t = $cantidad * $valor_unt *-1;

					
$insertar = mysql_query("INSERT INTO d89xz_diario(`concep`,`descrip`,`estado`,`cantid`,`v_unit`,`v_tal`,`fecha`) VALUES ('{$concepto}','{$descrip}','{$estado}','{$cantidad}','{$valor_unt}','{$valor_t}',NOW())",$conexion);

		
		
		if (!$insertar) {
				die("Fallo en la insercion de registro en la Base de Datos: " . mysql_error());
					}

	

}
 
?>



<?php
mysql_close($conexion);
mysql_free_result($dia);

mysql_free_result($mes);

mysql_free_result($em);

mysql_free_result($anos);
?>
