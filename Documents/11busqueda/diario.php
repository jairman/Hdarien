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
<script src="SpryAssets/SpryMenuBar.js" type="text/javascript"></script>
<link href="SpryAssets/SpryMenuBarHorizontal.css" rel="stylesheet" type="text/css" />
</head>

<body>

  
  <ul id="MenuBar1" class="MenuBarHorizontal">
    <li><a href="alert.php" >Alertas</a>    </li>
    <li><a href="diario.php" class="current">Pendientes</a></li>
    <li><a href="editar_diario.php" >Editar Pendientes</a>    </li>
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
  <table width="100%" border="1" cellspacing="0">
    <tr>
      <th colspan="3" bgcolor="#4D68A2">Asignar tareas</th>
    </tr>
    <tr>
      <td width="259" rowspan="2"><span id="spry_tarea">
        <label for="text_tareas"></label>
        <textarea name="text_tareas" id="text_tareas" cols="39" rows="5"></textarea>
      </span></td>
      <td height="43">F.Inicio- D<span id="spryselect3">
        <label for="select_dia_ini"></label>
        <select name="select_dia_ini" id="select_dia_ini">
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
      </span>M<span id="spryselect4">
      <label for="select_mes_ini"></label>
      <select name="select_mes_ini" id="select_mes_ini">
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
      </span>A<span id="spryselect6">
      <label for="text_anos_ini"></label>
      <select name="text_anos_ini" id="text_anos_ini">
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
      <td height="43"><input name="hiddenFiel_estado" type="hidden" id="hiddenFiel_estado" value="Pendiente" /></td>
    </tr>
    <tr>
      <td width="339">F.Final- D<span id="spry_dia">
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
      <th width="51"><input type="submit" name="button" id="button" value="Enviar" /></th>
    </tr>
  </table>
  
</form>

<DIV ID="seleccion">
<table width="100%" border="1" cellspacing="0">
  <tr class="c">
    <th colspan="4" bgcolor="#FFFFFF">&nbsp;</th>
    </tr>
  <tr class="c">
    <th width="469" bgcolor="#4D68A2"><strong>Tares pendientes</strong></th>
    <th width="110" bgcolor="#4D68A2">Fecha Inicial</th>
    <th width="110" bgcolor="#4D68A2"><strong>Fecha </strong>Final</th>
    <th width="91" bgcolor="#4D68A2">Estado</th>
  </tr>
  <?php do { ?>
    <tr>
      <td><?php echo $row_tareas['tarea']; ?></td>
      <td><?php echo $row_tareas['fecha_ini']; ?></td>
      <td><?php echo $row_tareas['fecha']; ?></td>
      
      <td><?php echo $row_tareas['estado']; ?></td>
      
    </tr>
    <?php } while ($row_tareas = mysql_fetch_assoc($tareas)); ?>
</table>
</DIV>
<script type="text/javascript">
var sprytextarea1 = new Spry.Widget.ValidationTextarea("spry_tarea", {validateOn:["blur"]});
var spryselect1 = new Spry.Widget.ValidationSelect("spry_dia", {validateOn:["blur"]});
var spryselect2 = new Spry.Widget.ValidationSelect("spry_mes", {validateOn:["blur"]});
var spryselect3 = new Spry.Widget.ValidationSelect("spryselect3", {validateOn:["blur"]});
var spryselect4 = new Spry.Widget.ValidationSelect("spryselect4", {validateOn:["blur"]});
var spryjamanield2 = new Spry.Widget.ValidationTextField("sprytextfield2", "integer", {validateOn:["blur"]});
var spryselect5 = new Spry.Widget.ValidationSelect("spryselect5", {validateOn:["blur"]});
var spryselect6 = new Spry.Widget.ValidationSelect("spryselect6", {validateOn:["blur"]});
</script>
</body>
</html>
<?php
mysql_free_result($dias);

mysql_free_result($meses);

mysql_free_result($tareas);

mysql_free_result($anf);
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
	
				 

		//$conexion = mysql_connect("localhost", "solucion_jairman", "jairloco1727");
		
	
	   
		
			if (!$conexion) {
					die("Fallo la conexión a la Base de Datos: " . mysql_error());
				}
		
		//$seleccionar_bd = mysql_select_db("solucion_ganadero", $conexion);
			if (!$seleccionar_bd) {
					die("Fallo la selección de la Base de Datos: " . mysql_error());
				}
		
	

$insertar = mysql_query("INSERT INTO d89xz_tareas(`tarea`,`fecha_ini`,`fecha`,`estado`) VALUES ('{$textarea_tarea}','{$text_f_tareaini}','{$text_f_tarea}','{$estado}')",$conexion);



		if (!$insertar) {
				die("Fallo en la insercion de registro en la Base de Datos: " . mysql_error());
					}

mysql_close($conexion);

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