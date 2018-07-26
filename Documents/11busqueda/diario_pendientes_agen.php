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
$query_vac = "SELECT * FROM d89xz_vacunos WHERE vacuna = 'si'";
$vac = mysql_query($query_vac, $conexion) or die(mysql_error());
$row_vac = mysql_fetch_assoc($vac);
$totalRows_vac = mysql_num_rows($vac);

mysql_select_db($database_conexion, $conexion);
$query_ubc = "SELECT hacienda FROM d89xz_hacienda";
$ubc = mysql_query($query_ubc, $conexion) or die(mysql_error());
$row_ubc = mysql_fetch_assoc($ubc);
$totalRows_ubc = mysql_num_rows($ubc);

mysql_select_db($database_conexion, $conexion);
$query_vcn = "SELECT DISTINCT `vacuna`,`hierro`,`cmvac`,`resvac` FROM d89xz_vacunos WHERE vacuna !='0000-00-00' and `cmvac` !=' ' and `resvac` != ' '";
$vcn = mysql_query($query_vcn, $conexion) or die(mysql_error());
$row_vcn = mysql_fetch_assoc($vcn);
$totalRows_vcn = mysql_num_rows($vcn);

mysql_select_db($database_conexion, $conexion);
$query_res = "SELECT * FROM d89xz_empleados";
$res = mysql_query($query_res, $conexion) or die(mysql_error());
$row_res = mysql_fetch_assoc($res);
$totalRows_res = mysql_num_rows($res);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Pendientes</title>
<script src="SpryAssets/SpryValidationSelect.js" type="text/javascript"></script>
<link href="SpryAssets/SpryValidationSelect.css" rel="stylesheet" type="text/css" />
<style type="text/css">
#form1 table tr th {
	color: #FFF;
}
.c {
	color: #FFF;
}
</style>
 <style> 
a{text-decoration:none} 
</style>
</head>

<script src="SpryAssets/SpryMenuBar.js" type="text/javascript"></script>

<link href="SpryAssets/SpryMenuBarHorizontal.css" rel="stylesheet" type="text/css" />
<body>


<ul id="MenuBar1" class="MenuBarHorizontal">
<li><a href="index.php" >Agenda Mes</a>  </li>
  <li><a href="busqueda_jornada.php" >B&uacute;squeda</a>  </li>
  <li><a href="jornada_palpacion.php">Palpaci&oacute;n</a></li>
  <li><a href="inseminacion2_act.php">Inseminaci&oacute;n</a>  </li>
  <li><a href="diario_pendientes.php" class="current">Vacunas</a></li>
  <li><a href="jornada_peso1.php" >Peso</a></li>
  <li><a href="traslado.php" >Traslados</a></li>
</ul>


<p>&nbsp;</p>
<ul id="MenuBar1" class="MenuBarHorizontal">
  <li><a href="diario_pendientes_agen.php" class="current">Agenda / Grupo</a>  </li>
  <li><a href="ajax.php" >Individual</a></li>
  <li><a href="jornada_vacuna_detalle.php">Reportes</a>  </li>
 
</ul>
  
<p>&nbsp;</p>
<DIV ID="seleccion">
  <table width="100%" border="0" align="center" cellspacing="0">
    <tr>
    <th colspan="4" align="center" bgcolor="#4D68A2" style="color: #FFF">Agregar  Jornada  De Vacunación</th>
  </tr>
    <tr>
      <td align="left" style="font-weight: bold">&nbsp;</td>
      <td align="left">&nbsp;</td>
      <td align="center">&nbsp;</td>
      <td align="center">&nbsp;</td>
    </tr>
    <tr bgcolor="#f0f0f0">
    <td width="340" align="left" style="font-weight: bold">Por  Fecha  De Nacimiento</td>
    <td width="193" align="left"><a rel="shadowbox[ejemplos];options={continuous:true}" href="jornada_vacuna1_agregar.php"><img src="add.png" alt="" width="68" height="20" /></a></td>
    <td width="292" align="center">Por Hato</td>
    <td width="245" align="center"><a rel="shadowbox[ejemplos];options={continuous:true}" href="jornada_vacuna1seleccion.php"><img src="add.png" alt="" width="68" height="20" /></a></td>
  </tr>
    <tr>
      <td align="left" style="font-weight: bold">&nbsp;</td>
      <td align="left">&nbsp;</td>
      <td align="center">&nbsp;</td>
      <td align="center">&nbsp;</td>
    </tr>
  </table>
<table width="100%" border="1" align="center" cellspacing="0">
  <tr bgcolor="#4D68A2" style="color: #FFF">
    <th>Fecha</th>
    <th>Hierro</th>
    <th><p>Comentario</p></th>
    <th><p>Responsable</p></th>
  </tr>
  <?php do { ?>
  <tr align="center">
    <td><a href="diario_pendientes_detalle.php?vacuna=<?php echo $row_vcn['vacuna']; ?>&amp;hierro=<?php echo $row_vcn['hierro']; ?>&amp;cmvac=<?php echo $row_vcn['cmvac']; ?>&amp;resvac=<?php echo $row_vcn['resvac']; ?>"><?php echo $row_vcn['vacuna']; ?></a></td>
    <td><?php echo $row_vcn['hierro']; ?></td>
    <td><?php echo $row_vcn['cmvac']; ?></td>
    <td><?php echo $row_vcn['resvac']; ?></td>
  </tr>
  <?php } while ($row_vcn = mysql_fetch_assoc($vcn)); ?>
</table>
</DIV>
<script type="text/javascript">
var spryjamanield2 = new Spry.Widget.ValidationTextField("sprytextfield2", "integer", {validateOn:["blur"]});
</script>
<p>&nbsp;</p>
<p>&nbsp; </p>
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

mysql_free_result($vcn);

mysql_free_result($res);
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
$respon =$_POST['respon'];



$queEmp ="SELECT * FROM `d89xz_empleados` WHERE `nombre`= '$respon'";
					$resEmp = mysql_query($queEmp, $conexion) or die(mysql_error());
					$totEmp = mysql_num_rows($resEmp);
					if ($totEmp> 0) {
						
						while ($rowEmp = mysql_fetch_assoc($resEmp)) {
						$nombre=	$rowEmp['nombre'];	
						$apellido=	$rowEmp['apellido'];				
						}
					}
	$responsable = $nombre.$apellido;




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
$ubica =$_POST['ubica'];

?>

<?
if($sexo != 'sexo'){
	
	
$insertar = mysql_query("UPDATE `d89xz_vacunos` SET `vacuna`=NOW(), `resvac`= '$responsable', `cmvac`='$textarea_tarea' WHERE `raza`='$raza' and `color`='$color' and `sexo`='$sexo' and `clase`='$clase' and `hierro`='$hierro' and ubicasion='$ubica' ", $conexion);
}
?>
 


<?

mysql_close($conexion);
?> 