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
$query_mes = "SELECT * FROM d89xz_meses";
$mes = mysql_query($query_mes, $conexion) or die(mysql_error());
$row_mes = mysql_fetch_assoc($mes);
$totalRows_mes = mysql_num_rows($mes);

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
<p><img src="idsolutions--este.png" width="162" height="59" /></p>
<form id="form1" name="form1" method="post" action="">
  <table width="663" border="1">
    <tr>
      <th colspan="5" bgcolor="#4D68A2">Ingreso  de  Leche Semanal</th>
      <th bgcolor="#4D68A2">&nbsp;</th>
    </tr>
    <tr>
      <th width="94" bgcolor="#4D68A2">ID</th>
      <th width="103" bgcolor="#4D68A2">Semana</th>
      <th width="81" bgcolor="#4D68A2">Peso(Kg)</th>
      <th width="87" bgcolor="#4D68A2">Valor(Kg)</th>
      <th width="207" bgcolor="#4D68A2">Fecha</th>
      <td width="51" rowspan="2" bgcolor="#4D68A2"><input type="submit" name="button" id="button" value="Enviar" /></td>
    </tr>
    <tr>
      <td><span id="vacuno">
        <label for="vacuno"></label>
        <input name="vacuno" type="text" id="vacuno" size="15" />
      </span></td>
      <td><span id="spryselect1">
        <label for="semana"></label>
        <select name="semana" id="semana">
<option selected="selected">Seleccione</option>
<option value="Semana1">Semana1</option>
          <option value="Semana2">Semana2</option>
          <option value="Semana3">Semana3</option>
          <option value="Semana4">Semana4</option>
        </select>
      </span></td>
      <td><span id="sprytextfield2">
      <label for="klos"></label>
      <input name="klos" type="text" id="klos" size="10" />
      <span class="textfieldInvalidFormatMsg">Formato no válido.</span></span></td>
      <td><span id="sprytextfield3">
      <label for="valor"></label>
      <input name="valor" type="text" id="valor" size="10" />
      <span class="textfieldInvalidFormatMsg">Formato no válido.</span></span></td>
      <td>M<span id="spryselect2">
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
      <span class="selectRequiredMsg">Seleccione un elemento.</span></span>A<span id="spryselect3">
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
      <span class="selectRequiredMsg">Seleccione un elemento.</span></span></td>
    </tr>
  </table>
</form>
<script type="text/javascript">
var spryselect1 = new Spry.Widget.ValidationSelect("spryselect1", {validateOn:["blur"]});
var sprytextfield1 = new Spry.Widget.ValidationTextField("sprytextfield1", "none", {validateOn:["blur"]});
var sprytextfield2 = new Spry.Widget.ValidationTextField("sprytextfield2", "integer", {validateOn:["blur"]});
var sprytexjamanld3 = new Spry.Widget.ValidationTextField("sprytextfield3", "integer", {validateOn:["blur"]});
var spryselect2 = new Spry.Widget.ValidationSelect("spryselect2");
var spryselect3 = new Spry.Widget.ValidationSelect("spryselect3");
</script>
</body>
</html>
<?php
mysql_free_result($mes);

mysql_free_result($anos);
?>



<?

$action =$_POST['vacuno'];
$semana =$_POST['semana'];
$klos = $_POST['klos'];
$valor =$_POST['valor'];

$diab= 00;
$mesb=trim(strip_tags($_POST['mes']));
$anob=trim(strip_tags($_POST['anos']));
$fecha=$anob.'-'.$mesb.'-'.$diab;


?>
<p>&nbsp;</p>

<?
 $total_klos = $klos * $valor;
?>

<?

			
				
					
$queEmp ="SELECT * FROM `d89xz_vacunos` WHERE `id_vacuno`= '$action' AND sexo='hembra' AND tp_rep= 'paridas'";
					
					
					
					$resEmp = mysql_query($queEmp, $conexion) or die(mysql_error());
					$totEmp = mysql_num_rows($resEmp);
				if ($totEmp> 0) {
						
						while ($rowEmp = mysql_fetch_assoc($resEmp)) {
						$id_vacuno=	$rowEmp[id_vacuno];
						//$select_hierro=	$rowEmp[hierro];
																	
						}
					}
						//mysql_close($conexion);				
						
?>

<?
 
  	if ($id_vacuno != 0 ){
		
	
		
			if (!$conexion) {
					die("Fallo la conexión a la Base de Datos: " . mysql_error());
				}
		
		
		
			if (!$seleccionar_bd) {
					die("Fallo la selección de la Base de Datos: " . mysql_error());
				}		
		
		$insertar = mysql_query("INSERT INTO d89xz_detalle_leche (vacuno,semana,klos,valor_unid,valor,fecha)
					VALUES ('{$id_vacuno}','{$semana}', '{$klos}', '{$valor}', '{$total_klos}', '{$fecha}')", $conexion);
			
$descrip = Venta_de_Leche;
$concepto = Venta;
$estado =Pago;
$cantidad =$_POST['klos'];
$valor_unt =$_POST['valor'];
$valor_t = $cantidad * $valor_unt;

					
$insertar = mysql_query("INSERT INTO d89xz_diario(`concep`,`descrip`,`estado`,`cantid`,`v_unit`,`v_tal`,`fecha`) VALUES ('{$concepto}','{$descrip}','{$estado}','{$cantidad}','{$valor_unt}','{$valor_t}',NOW())",$conexion);
		
			
					
			echo "<font size=13 color='#0000FF'>Registro  Exitoso</font>";
		
			
		if (!$insertar) {
				die("Fallo en la insercion de registro en la Base de Datos: " . mysql_error());
					}
	


		}
		
		if ($action!=$id_vacuno ){
		echo "<br>"; 
		
		echo "<font  size=16 color='red'>Vacuno No Existe</font>";
		
		
	   }
	   mysql_close($conexion);
?>