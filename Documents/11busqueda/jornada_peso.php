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
$query_dias = "SELECT dias FROM d89xz_dias";
$dias = mysql_query($query_dias, $conexion) or die(mysql_error());
$row_dias = mysql_fetch_assoc($dias);
$totalRows_dias = mysql_num_rows($dias);

mysql_select_db($database_conexion, $conexion);
$query_meses = "SELECT meses FROM d89xz_meses";
$meses = mysql_query($query_meses, $conexion) or die(mysql_error());
$row_meses = mysql_fetch_assoc($meses);
$totalRows_meses = mysql_num_rows($meses);

mysql_select_db($database_conexion, $conexion);
$query_tareas = "SELECT * FROM d89xz_tareas ORDER BY fecha_ini DESC";
$tareas = mysql_query($query_tareas, $conexion) or die(mysql_error());
$row_tareas = mysql_fetch_assoc($tareas);
$totalRows_tareas = mysql_num_rows($tareas);

mysql_select_db($database_conexion, $conexion);
$query_anf = "SELECT * FROM d89xz_anos";
$anf = mysql_query($query_anf, $conexion) or die(mysql_error());
$row_anf = mysql_fetch_assoc($anf);
$totalRows_anf = mysql_num_rows($anf);

mysql_select_db($database_conexion, $conexion);
$query_raza = "SELECT raza FROM d89xz_razas";
$raza = mysql_query($query_raza, $conexion) or die(mysql_error());
$row_raza = mysql_fetch_assoc($raza);
$totalRows_raza = mysql_num_rows($raza);

mysql_select_db($database_conexion, $conexion);
$query_color = "SELECT color FROM d89xz_color_raza";
$color = mysql_query($query_color, $conexion) or die(mysql_error());
$row_color = mysql_fetch_assoc($color);
$totalRows_color = mysql_num_rows($color);

mysql_select_db($database_conexion, $conexion);
$query_hierro = "SELECT * FROM d89xz_hierros";
$hierro = mysql_query($query_hierro, $conexion) or die(mysql_error());
$row_hierro = mysql_fetch_assoc($hierro);
$totalRows_hierro = mysql_num_rows($hierro);

mysql_select_db($database_conexion, $conexion);
$query_vac = "SELECT * FROM d89xz_vacunos WHERE jpeso = 'si'";
$vac = mysql_query($query_vac, $conexion) or die(mysql_error());
$row_vac = mysql_fetch_assoc($vac);
$totalRows_vac = mysql_num_rows($vac);

mysql_select_db($database_conexion, $conexion);
$query_ubc = "SELECT hacienda FROM d89xz_hacienda";
$ubc = mysql_query($query_ubc, $conexion) or die(mysql_error());
$row_ubc = mysql_fetch_assoc($ubc);
$totalRows_ubc = mysql_num_rows($ubc);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Pendientes</title>


<script src="SpryAssets/SpryValidationTextarea.js" type="text/javascript"></script>
<script src="SpryAssets/SpryValidationSelect.js" type="text/javascript"></script>
<link href="SpryAssets/SpryValidationTextarea.css" rel="stylesheet" type="text/css" />
<link href="SpryAssets/SpryValidationSelect.css" rel="stylesheet" type="text/css" />
<style type="text/css">
#form1 table tr th {
	color: #FFF;
}
.c {
	color: #FFF;
}
</style>
</head>

<body>
<a href="javascript:imprSelec('seleccion')" ><img src="imprimir.png" alt="" width="36" height="35" border="0" align="right" /></a>

<DIV ID="seleccion">

<p><img src="idsolutions--este.png" width="162" height="59" /></p>
<form id="form1" name="form1" method="post" action="">
  <table width="700" border="1">
    <tr>
      <th colspan="6" bgcolor="#4D68A2"><p>Asignar Jornada de Vacunación</p></th>
    </tr>
    <tr>
      <td colspan="2"><span id="spry_tarea">
        <label for="text_tareas"></label>
        <textarea name="text_tareas" id="text_tareas" cols="30" rows="2"></textarea>
        </span></td>
      <td colspan="3">F.Final- D<span id="spry_dia">
        <label for="select_dia"></label>
        <select name="select_dia" id="select_dia">
          <?php
do {  
?>
          <option value="<?php echo $row_dias['dias']?>"><?php echo $row_dias['dias']?></option>
          <?php
} while ($row_dias = mysql_fetch_assoc($dias));
  $rows = mysql_num_rows($dias);
  if($rows > 0) {
      mysql_data_seek($dias, 0);
	  $row_dias = mysql_fetch_assoc($dias);
  }
?>
          </select>
        </span>M<span id="spry_mes">
          <label for="select_mes"></label>
          <select name="select_mes" id="select_mes">
            <?php
do {  
?>
            <option value="<?php echo $row_meses['meses']?>"><?php echo $row_meses['meses']?></option>
            <?php
} while ($row_meses = mysql_fetch_assoc($meses));
  $rows = mysql_num_rows($meses);
  if($rows > 0) {
      mysql_data_seek($meses, 0);
	  $row_meses = mysql_fetch_assoc($meses);
  }
?>
          </select>
          </span>A<span id="spryselect5">
          <label for="text_anos"></label>
          <select name="text_anos" id="text_anos">
            <?php
do {  
?>
            <option value="<?php echo $row_anf['anos']?>"><?php echo $row_anf['anos']?></option>
            <?php
} while ($row_anf = mysql_fetch_assoc($anf));
  $rows = mysql_num_rows($anf);
  if($rows > 0) {
      mysql_data_seek($anf, 0);
	  $row_anf = mysql_fetch_assoc($anf);
  }
?>
          </select>
        </span></td>
      <td width="80" align="center"><input name="hiddenFiel_estado" type="hidden" id="hiddenFiel_estado" value="Pendiente" />        <input type="submit" name="button" id="button" value="Enviar" /></td>
    </tr>
    <tr>
      <td width="131"><label for="raza"></label>
        <span id="spryselect3">
        <select name="raza" id="raza">
          <option value="">Seleccione Raza</option>
          <?php
do {  
?>
          <option value="<?php echo $row_raza['raza']?>"><?php echo $row_raza['raza']?></option>
          <?php
} while ($row_raza = mysql_fetch_assoc($raza));
  $rows = mysql_num_rows($raza);
  if($rows > 0) {
      mysql_data_seek($raza, 0);
	  $row_raza = mysql_fetch_assoc($raza);
  }
?>
        </select>
        </span></td>
      <td width="133"><label for="color"></label>
        <span id="spryselect4">
        <select name="color" id="color">
          <option value="">Seleccione Color</option>
          <?php
do {  
?>
          <option value="<?php echo $row_color['color']?>"><?php echo $row_color['color']?></option>
          <?php
} while ($row_color = mysql_fetch_assoc($color));
  $rows = mysql_num_rows($color);
  if($rows > 0) {
      mysql_data_seek($color, 0);
	  $row_color = mysql_fetch_assoc($color);
  }
?>
        </select>
        </span></td>
      <td width="99"><label for="clase"></label>
        <span id="spryselect6">
        <select name="clase" id="clase">
          <option>Seleccione</option>
          <option value="Puro">Puro</option>
          <option value="Comercial">Comercial</option>
        </select>
        </span></td>
      <td width="83"><label for="sexo"></label>
        <span id="spryselect7">
        <select name="sexo" id="sexo">
          <option>Sexo</option>
          <option value="Macho">Macho</option>
          <option value="Hembra">Hembra</option>
        </select>
        </span></td>
      <td width="134"><span id="spryselect9">
        <label for="select1"></label>
        <select name="select1" id="select1">
          <option value="">Ubicacion</option>
          <?php
do {  
?>
          <option value="<?php echo $row_ubc['hacienda']?>"><?php echo $row_ubc['hacienda']?></option>
          <?php
} while ($row_ubc = mysql_fetch_assoc($ubc));
  $rows = mysql_num_rows($ubc);
  if($rows > 0) {
      mysql_data_seek($ubc, 0);
	  $row_ubc = mysql_fetch_assoc($ubc);
  }
?>
        </select>
      </span></td>
      <td><label for="hierro"></label>
        <span id="spryselect8">
        <select name="hierro" id="hierro">
          <option value="">Hierro</option>
          <?php
do {  
?>
          <option value="<?php echo $row_hierro['hierro']?>"><?php echo $row_hierro['hierro']?></option>
          <?php
} while ($row_hierro = mysql_fetch_assoc($hierro));
  $rows = mysql_num_rows($hierro);
  if($rows > 0) {
      mysql_data_seek($hierro, 0);
	  $row_hierro = mysql_fetch_assoc($hierro);
  }
?>
        </select>
        </span></td>
    </tr>
    </table>
  
</form>
</DIV>
<script type="text/javascript">
var sprytextarea1 = new Spry.Widget.ValidationTextarea("spry_tarea", {validateOn:["blur"]});
var spryselect1 = new Spry.Widget.ValidationSelect("spry_dia", {validateOn:["blur"]});
var spryselect2 = new Spry.Widget.ValidationSelect("spry_mes", {validateOn:["blur"]});
var spryjamanield2 = new Spry.Widget.ValidationTextField("sprytextfield2", "integer", {validateOn:["blur"]});
var spryselect5 = new Spry.Widget.ValidationSelect("spryselect5", {validateOn:["blur"]});
var spryselect3 = new Spry.Widget.ValidationSelect("spryselect3", {validateOn:["blur"]});
var spryselect4 = new Spry.Widget.ValidationSelect("spryselect4", {validateOn:["blur"]});
var spryselect6 = new Spry.Widget.ValidationSelect("spryselect6", {validateOn:["blur"]});
var spryselect7 = new Spry.Widget.ValidationSelect("spryselect7", {validateOn:["blur"]});
var spryselect8 = new Spry.Widget.ValidationSelect("spryselect8", {validateOn:["blur"]});
</script>
<table width="700" border="1">
  <tr bgcolor="#4D68A2" style="color: #000">
    <th colspan="8"><p>&nbsp;</p></th>
  </tr>
  <tr bgcolor="#4D68A2" style="color: #FFF">
    <th>ID</th>
    <th>Raza</th>
    <th>Color</th>
    <th>Clase</th>
    <th>Hierro</th>
    <th>Sexo</th>
    <th>Ubicacion</th>
    <th>Pesar</th>
  </tr>
  <?php do { ?>
    <tr align="center">
      <td><?php echo $row_vac['id_vacuno']; ?></td>
      <td><?php echo $row_vac['raza']; ?></td>
      <td><?php echo $row_vac['color']; ?></td>
      <td><?php echo $row_vac['clase']; ?></td>
      <td><?php echo $row_vac['hierro']; ?></td>
      <td><?php echo $row_vac['sexo']; ?></td>
      <td><?php echo $row_vac['ubicasion']; ?></td>
      <td bgcolor="#FFFFFF"><a href="peso_jornada.php?id_vacuno=<?php echo $row_vac['id_vacuno']; ?>&amp;hacienda=<?php echo $row_vac['ubicasion']; ?>&amp;hierro=<?php echo $row_vac['hierro']; ?>"><img src="peso.jpg" width="27" height="17" /></a></td>
    </tr>
    <?php } while ($row_vac = mysql_fetch_assoc($vac)); ?>
</table>
<script type="text/javascript">
var spryselect9 = new Spry.Widget.ValidationSelect("spryselect9", {validateOn:["blur"]});
</script>
</body>
</html>
<?php
mysql_free_result($dias);

mysql_free_result($meses);

mysql_free_result($tareas);

mysql_free_result($anf);

mysql_free_result($raza);

mysql_free_result($color);

mysql_free_result($hierro);

mysql_free_result($vac);

mysql_free_result($ubc);
?>

<?
$textarea_tarea =$_POST['text_tareas'];
$estado =$_POST['hiddenFiel_estado'];


$diabini=trim(strip_tags($_POST['select_dia_ini']));
$mesbini=trim(strip_tags($_POST['select_mes_ini']));
$anobini=trim(strip_tags($_POST['text_anos_ini']));
$text_f_tareaini=$anobini.'-'.$mesbini.'-'.$diabini;


$diab=trim(strip_tags($_POST['select_dia']));
$mesb=trim(strip_tags($_POST['select_mes']));
$anob=trim(strip_tags($_POST['text_anos']));
$text_f_tarea=$anob.'-'.$mesb.'-'.$diab;

?>

<?
//echo"$estado";
if ($text_f_tarea!=0000-00-00){
	

	
	   
		
			if (!$conexion) {
					die("Fallo la conexión a la Base de Datos: " . mysql_error());
				}
				if (!$seleccionar_bd) {
					die("Fallo la selección de la Base de Datos: " . mysql_error());
				}
		
	

$insertar = mysql_query("INSERT INTO d89xz_tareas(`tarea`,`fecha_ini`,`fecha`,`estado`) VALUES ('{$textarea_tarea}',NOW(),'{$text_f_tarea}','{$estado}')",$conexion);



		if (!$insertar) {
				die("Fallo en la insercion de registro en la Base de Datos: " . mysql_error());
					}



	}


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
$raza = $_POST['raza'];
$color = $_POST['color'];
$sexo = $_POST['sexo'];
$clase = $_POST['clase'];
$hierro = $_POST['hierro'];


?>

<?
if($sexo != 'sexo'){
	
	
$insertar = mysql_query("UPDATE `d89xz_vacunos` SET `jpeso`='si' WHERE `raza`='$raza' and `color`='$color' and `sexo`='$sexo' and `clase`='$clase' and `hierro`='$hierro' ", $conexion);
}
?>
 


<?

mysql_close($conexion);
?> 