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
$query_non = "SELECT * FROM d89xz_medicinas";
$non = mysql_query($query_non, $conexion) or die(mysql_error());
$row_non = mysql_fetch_assoc($non);
$totalRows_non = mysql_num_rows($non);

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
$query_tm = "SELECT * FROM d89xz_tipo_medininas";
$tm = mysql_query($query_tm, $conexion) or die(mysql_error());
$row_tm = mysql_fetch_assoc($tm);
$totalRows_tm = mysql_num_rows($tm);

mysql_select_db($database_conexion, $conexion);
$query_an = "SELECT * FROM d89xz_anos";
$an = mysql_query($query_an, $conexion) or die(mysql_error());
$row_an = mysql_fetch_assoc($an);
$totalRows_an = mysql_num_rows($an);
?>
<script src="SpryAssets/SpryValidationSelect.js" type="text/javascript"></script>
<link href="SpryAssets/SpryValidationSelect.css" rel="stylesheet" type="text/css">
<script src="SpryAssets/SpryValidationTextField.js" type="text/javascript"></script>
<link href="SpryAssets/SpryValidationTextField.css" rel="stylesheet" type="text/css">
<style type="text/css">
.x {
	color: #FFF;
}
</style>
<p><img src="idsolutions--este.png" width="162" height="59" /></p>
<form name="form1" method="post" action="">
  <table width="692" border="1">
  <tr>
    <th colspan="7" bgcolor="#4D68A2"><p class="x">Ingreso de  Medicinas</p></th>
    </tr>
  <tr>
    <td width="79">Tipo</td>
    <td width="246"><span id="spryselect1">
      <label for="select_tipo2"></label>
      <select name="select_tipo" id="select_tipo2">
        <option value="">Seleccione</option>
        <?php
do {  
?>
        <option value="<?php echo $row_tm['tipo']?>"><?php echo $row_tm['tipo']?></option>
        <?php
} while ($row_tm = mysql_fetch_assoc($tm));
  $rows = mysql_num_rows($tm);
  if($rows > 0) {
      mysql_data_seek($tm, 0);
	  $row_tm = mysql_fetch_assoc($tm);
  }
?>
      </select>
    </span></td>
    <td width="60">Cantidad</td>
    <td width="69"><span id="sprytextfield3">
      <label for="text_cantidad2"></label>
      <input name="text_cantidad" type="text" id="text_cantidad" size="2" maxlength="4" />
    </span></td>
    <td width="139"><p>Contenido</p></td>
    <td colspan="2"><label for="select_contenido"></label>
      <select name="select_contenido" id="select_contenido">
        <?php
do {  
?>
        <option value="<?php echo $row_non['cont']?>"><?php echo $row_non['cont']?></option>
        <?php
} while ($row_non = mysql_fetch_assoc($non));
  $rows = mysql_num_rows($non);
  if($rows > 0) {
      mysql_data_seek($non, 0);
	  $row_non = mysql_fetch_assoc($non);
  }
?>
      </select></td>
    </tr>
  <tr>
    <td>Nombre</td>
    <td><span id="spryselect6">
      <label for="select_nombre2"></label>
      <select name="select_nombre" id="select_nombre2">
        <?php
do {  
?>
        <option value="<?php echo $row_non['nombre']?>"><?php echo $row_non['nombre']?></option>
        <?php
} while ($row_non = mysql_fetch_assoc($non));
  $rows = mysql_num_rows($non);
  if($rows > 0) {
      mysql_data_seek($non, 0);
	  $row_non = mysql_fetch_assoc($non);
  }
?>
      </select>
    </span></td>
    <td><p>Concepto</p></td>
    <td colspan="3"><span id="spryselect2">
      <label for="select_entrada"></label>
      <select name="select_entrada" id="select_entrada">
        <option selected="selected">Seleccione</option>
        <option value="Entrada">Entrada</option>
        <option value="Salida">Salida</option>
      </select>
    </span></td>
    <td width="51">&nbsp;</td>
    </tr>
  <tr>
    <td><p>Marca</p></td>
    <td><span id="spryselect3">
      <label for="select_descrip"></label>
      <select name="select_descrip" id="select_descrip">
        <?php
do {  
?>
        <option value="<?php echo $row_non['mark']?>"><?php echo $row_non['mark']?></option>
        <?php
} while ($row_non = mysql_fetch_assoc($non));
  $rows = mysql_num_rows($non);
  if($rows > 0) {
      mysql_data_seek($non, 0);
	  $row_non = mysql_fetch_assoc($non);
  }
?>
        </select>
      </span></td>
    <td>Fecha</td>
    <td colspan="3">D<span id="spryselect4">
      <label for="select_dia2"></label>
      <select name="select_dia" id="select_dia2">
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
      </span>M<span id="spryselect5">
        <label for="select_mes2"></label>
        <select name="select_mes" id="select_mes2">
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
        </span>A<span id="spryselect7">
        <label for="text_anos"></label>
        <select name="text_anos" id="text_anos">
          <?php
do {  
?>
          <option value="<?php echo $row_an['anos']?>"><?php echo $row_an['anos']?></option>
          <?php
} while ($row_an = mysql_fetch_assoc($an));
  $rows = mysql_num_rows($an);
  if($rows > 0) {
      mysql_data_seek($an, 0);
	  $row_an = mysql_fetch_assoc($an);
  }
?>
        </select>
        </span></td>
    <th><input type="submit" name="button" id="button" value="Enviar" /></th>
  </tr>
</table>
</form>
<script type="text/javascript">
var spryselect1 = new Spry.Widget.ValidationSelect("spryselect1", {validateOn:["blur"]});
var spryselect3 = new Spry.Widget.ValidationSelect("spryselect3", {validateOn:["blur"]});
var spryselect4 = new Spry.Widget.ValidationSelect("spryselect4", {validateOn:["blur"]});
var spryselect5 = new Spry.Widget.ValidationSelect("spryselect5", {validateOn:["blur"]});
var spryselect6 = new Spry.Widget.ValidationSelect("spryselect6", {validateOn:["blur"]});
var sprytextfield3 = new Spry.Widget.ValidationTextField("sprytextfield3", "none", {validateOn:["blur"]});
var spryselect2 = new Spry.Widget.ValidationSelect("spryselect2", {validateOn:["blur"]});
var spryselect7 = new Spry.Widget.ValidationSelect("spryselect7", {validateOn:["blur"]});
</script>


<?
$select_tipo =$_POST['select_tipo'];
$select_nombre =$_POST['select_nombre'];
$text_cantidad =$_POST['text_cantidad'];
$select_descrip =$_POST['select_descrip'];
$select_contenido =$_POST['select_contenido'];

$entrada = $_POST['select_entrada'];


$diab=trim(strip_tags($_POST['select_dia']));
$mesb=trim(strip_tags($_POST['select_mes']));
$anob=trim(strip_tags($_POST['text_anos']));
$text_f_jornada=$anob.'-'.$mesb.'-'.$diab;


?>


<?

$conexion = mysql_connect("localhost","solucion_jairman","jairloco1727");

$seleccionar_bd = mysql_select_db("solucion_ganadero", $conexion);
 
  	if ($entrada == Entrada ){
	$dosis= $text_cantidad * $select_contenido;
	
			if (!$conexion) {
					die("Fallo la conexión a la Base de Datos: " . mysql_error());
				}		
			if (!$seleccionar_bd) {
					die("Fallo la selección de la Base de Datos: " . mysql_error());
				}
		
		$insertar = mysql_query("INSERT INTO d89xz_total_medicinas_salidas (tipo,nombre,cont,mark,cantid,fecha,concep)
		VALUES ('{$select_tipo}','{$select_nombre}','{$select_contenido}','{$select_descrip}','{$text_cantidad}','{$text_f_jornada}','{$entrada}')", $conexion);
/*		
$insertar = mysql_query("INSERT INTO d89xz_total_medicinas (tipo,nombre,cont,mark,cantid,fecha,concep)
		VALUES ('{$select_tipo}','{$select_nombre}','{$select_contenido}','{$select_descrip}','{$text_cantidad}','{$text_f_jornada}','{$entrada}')", $conexion);
*/				
		
$insertar = mysql_query("UPDATE  `d89xz_total_medicinas` SET `cantid`=cantid + $text_cantidad, `dosis`= dosis+ $dosis WHERE `tipo` = '$select_tipo' AND `nombre` = '$select_nombre' AND `concep`= 'Entrada' AND `cont` = '$select_contenido' AND `mark` = '$select_descrip'", $conexion);
		




		if (!$insertar) {
				die("Fallo en la insercion de registro en la Base de Datos: " . mysql_error());
					}

echo "<br>"; 
 echo"Registro exitoso";

		}
	
 
?>

<?

 
  	if ($entrada == Salida ){
	
$dosis= $text_cantidad * $select_contenido;
		
		
			if (!$conexion) {
					die("Fallo la conexión a la Base de Datos: " . mysql_error());
				}
	
			if (!$seleccionar_bd) {
					die("Fallo la selección de la Base de Datos: " . mysql_error());
				}
		
		$insertar = mysql_query("INSERT INTO d89xz_total_medicinas_salidas (tipo,nombre,cont,mark,cantid,fecha,concep)
		VALUES ('{$select_tipo}','{$select_nombre}','{$select_contenido}','{$select_descrip}','{$text_cantidad}','{$text_f_jornada}','{$entrada}')", $conexion);
		
$insertar = mysql_query("UPDATE  `d89xz_total_medicinas` SET `cantid`=`cantid`- $text_cantidad, `dosis`= dosis - $dosis WHERE `tipo` = '$select_tipo' AND `nombre` = '$select_nombre' AND `concep`= 'Entrada' AND `cont` = '$select_contenido' AND `mark` = '$select_descrip'", $conexion);
		


$select_descrip =$_POST['select_descrip'];

		if (!$insertar) {
				die("Fallo en la insercion de registro en la Base de Datos: " . mysql_error());
					}


echo "<br>"; 
 echo"Registro exitoso";

		}
	
 
?>


<?php
mysql_close($conexion);
mysql_free_result($non);

mysql_free_result($dia);

mysql_free_result($mes);

mysql_free_result($tm);

mysql_free_result($an);
?>



