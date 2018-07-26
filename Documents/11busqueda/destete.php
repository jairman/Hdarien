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
$query_dia = "SELECT * FROM d89xz_dias";
$dia = mysql_query($query_dia, $conexion) or die(mysql_error());
$row_dia = mysql_fetch_assoc($dia);
$totalRows_dia = mysql_num_rows($dia);

mysql_select_db($database_conexion, $conexion);
$query_mes = "SELECT * FROM d89xz_meses";
$mes = mysql_query($query_mes, $conexion) or die(mysql_error());
$row_mes = mysql_fetch_assoc($mes);
$totalRows_mes = mysql_num_rows($mes);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Documento sin título</title>
<script src="SpryAssets/SpryValidationTextField.js" type="text/javascript"></script>
<script src="SpryAssets/SpryValidationSelect.js" type="text/javascript"></script>
<link href="SpryAssets/SpryValidationTextField.css" rel="stylesheet" type="text/css" />
<link href="SpryAssets/SpryValidationSelect.css" rel="stylesheet" type="text/css" />
</head>

<body>
<form id="form1" name="form1" method="post" action="">
  <table width="435" border="1">
    <tr>
      <th colspan="4" bgcolor="#c0e3e9">Ingrese datos  de Destete</th>
    </tr>
    <tr>
      <td width="51"><strong>Vacuno</strong></td>
      <td width="178"><span id="sprytextfield1">
        <label for="text_idvacuno"></label>
        <input type="text" name="text_idvacuno" id="text_idvacuno" />
      </span></td>
      <td width="34"><strong>Peso</strong></td>
      <td width="144"><span id="sprytextfield2">
      <label for="text_peso"></label>
      <input type="text" name="text_peso" id="text_peso" />
      <span class="textfieldInvalidFormatMsg">Formato no válido.</span></span></td>
    </tr>
    <tr>
      <td height="28"><strong>Fecha</strong></td>
      <td><span id="spryselect1">
        <label for="select_dias"></label>
        <select name="select_dias" id="select_dias">
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
      </span><span id="spryselect2">
      <label for="select_meses"></label>
      <select name="select_meses" id="select_meses">
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
      </span><span id="sprytextfield3">
      <label for="text_anos"></label>
      <input name="text_anos" type="text" id="text_anos" size="4" maxlength="4" />
      </span></td>
      <td>&nbsp;</td>
      <th><input type="submit" name="button" id="button" value="Enviar" /></th>
    </tr>
  </table>
</form>
<script type="text/javascript">
var sprytextfield1 = new Spry.Widget.ValidationTextField("sprytextfield1", "none", {validateOn:["blur"]});
var sprytextfield2 = new Spry.Widget.ValidationTextField("sprytextfield2", "integer", {validateOn:["blur"]});
var spryselect1 = new Spry.Widget.ValidationSelect("spryselect1", {validateOn:["blur"]});
var spryselect2 = new Spry.Widget.ValidationSelect("spryselect2", {validateOn:["blur"]});
var sprytextfield3 = new Spry.Widget.ValidationTextField("sprytextfield3", "integer", {validateOn:["blur"]});
</script>
</body>
</html>
<?php
mysql_free_result($dia);

mysql_free_result($mes);
?>

<?
$text_idvacuno =$_POST['text_idvacuno'];
$text_peso =$_POST['text_peso'];


$diab=trim(strip_tags($_POST['select_dias']));
$mesb=trim(strip_tags($_POST['select_meses']));
$anob=trim(strip_tags($_POST['text_anos']));
$text_f_tarea=$anob.'-'.$mesb.'-'.$diab;

?>

<?
//echo"$estado";
if ($anob!=0000){	 

		$conexion = mysql_connect("localhost", "solucion_jairman", "jairloco1727"); 
		
			if (!$conexion) {
					die("Fallo la conexión a la Base de Datos: " . mysql_error());
				}
		
		$seleccionar_bd = mysql_select_db("solucion_ganadero", $conexion);
			if (!$seleccionar_bd) {
					die("Fallo la selección de la Base de Datos: " . mysql_error());
				}

$insertar = mysql_query("INSERT INTO d89xz_destete(`vacuno`,`peso`,`fecha`) VALUES ('{$text_idvacuno }','{$text_peso}','{$text_f_tarea}')",$conexion);
echo "<br>"; 
echo"Registro Exitoso";

		if (!$insertar) {
				die("Fallo en la insercion de registro en la Base de Datos: " . mysql_error());
					}

mysql_close($conexion);

	}


?>

