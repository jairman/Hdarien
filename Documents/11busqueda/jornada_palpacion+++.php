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



  @$jpalpa = $_GET['jpalpa'];
  @$respal= $_GET['respal'];
  @$cmpal = $_GET['cmpal'];
  @$raza1=$_GET['raza1'];
  @$color1 =$_GET['color1'];
  @$clase1 =$_GET['clase1'];
  @$hierro1=$_GET['hierro1'];

mysql_select_db($database_conexion, $conexion);
$query_vac = "SELECT * FROM d89xz_vacunos WHERE jpalpa = '$jpalpa' and respal='$respal' and cmpal='$cmpal'and `raza`='$raza1' and `color`='$color1' and `clase`='$clase1' and `hierro`='$hierro1'";
$vac = mysql_query($query_vac, $conexion) or die(mysql_error());
$row_vac = mysql_fetch_assoc($vac);
$totalRows_vac = mysql_num_rows($vac);

mysql_select_db($database_conexion, $conexion);
$query_rpn = "SELECT * FROM d89xz_empleados";
$rpn = mysql_query($query_rpn, $conexion) or die(mysql_error());
$row_rpn = mysql_fetch_assoc($rpn);
$totalRows_rpn = mysql_num_rows($rpn);

mysql_select_db($database_conexion, $conexion);
$query_jor = "SELECT DISTINCT  `jpalpa`,`raza`,`color`,`clase`,`hierro`,`ubicasion` FROM d89xz_vacunos WHERE `jpalpa` != '' ";
$jor = mysql_query($query_jor, $conexion) or die(mysql_error());
$row_jor = mysql_fetch_assoc($jor);
$totalRows_jor = mysql_num_rows($jor);
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

<script src="ajax.js"></script>





<link rel="stylesheet" type="text/css" href="shadowbox.css">

<script type="text/javascript" src="shadowbox.js"></script>



<body>
<table width="100%" border="0" align="center" cellspacing="0">
  <tr>
    <td width="121" align="left" bgcolor="#f0f0f0">&nbsp;</td>
    <td width="121" align="left" bgcolor="#f0f0f0">&nbsp;</td>
    <td width="308" align="center" bgcolor="#f0f0f0"><a href="jornada_palpacion.php"><img src="last.png" alt="" width="29" height="31" border="0" /></a></td>
    <td width="239" align="right" bgcolor="#f0f0f0"><a href="javascript:imprSelec('seleccion')" ><img src="imprimir.png" alt="" width="36" height="35" 

border="0" align="right" /></a></td>
  </tr>
</table>
<DIV ID="seleccion">
  
 
  <table width="100%" border="1" align="center" cellspacing="0">
    <tr bgcolor="#4D68A2" style="color: #FFF">
      <td colspan="11" bgcolor="#FFFFFF"><img src="idsolutions--este.png" width="162" height="59" /></td>
    </tr>
    <tr bgcolor="#4D68A2" style="color: #FFF">
    <th width="138"><p style="color: #FFF">Ubicacion</p></th>
    <th colspan="2" bgcolor="#FFFFFF" style="color: #000"><?php echo $row_vac['ubicasion']; ?></th>
    <th width="153" bgcolor="#4D68A2" style="color: #FFF">Hierro</th>
    <th colspan="2" bgcolor="#FFFFFF" style="color: #000"><?php echo $row_vac['hierro']; ?></th>
    <th colspan="5" style="color: #FFF">Seleccione</th>
    </tr>
  <tr bgcolor="#4D68A2" style="color: #FFF">
    <th bgcolor="#4D68A2">ID</th>
    <th width="123">Raza</th>
    <th width="107" bgcolor="#4D68A2">Color</th>
    <th>Clase</th>
    <th width="212" bgcolor="#4D68A2"><p>E. Fisiol.</p></th>
    <th width="94" bgcolor="#4D68A2">E. Repr.</th>
    <th width="50">VOE</th>
    <th width="51">VCN</th>
    <th width="47">P(N)</th>
    <th width="49">PP</th>
    <th width="49">Eliminar</th>
  </tr>
  <?php do { ?>
  <tr align="center">
    <td><?php echo $row_vac['id_vacuno']; ?></td>
    <td><?php echo $row_vac['raza']; ?></td>
    <td><?php echo $row_vac['color']; ?></td>
    <td><?php echo $row_vac['clase']; ?></td>
    <td><?php echo $row_vac['tp_rep']; ?></td>
    <td><?php echo $row_vac['estrepr']; ?></td>
    <td bgcolor="#FFFFFF"><a  rel="shadowbox[ejemplos];options={continuous:true}" href="estados_palpa_voe.php?jpalpa=<?php echo $row_vac['jpalpa']; ?>&amp;id_vacuno=<?php echo $row_vac['id_vacuno']; ?>&amp;responsable=<?php echo $row_vac['respal']; ?>&amp;hacien=<?php echo $row_vac['ubicasion']; ?>&amp;cmpal=<?php echo $row_vac['cmpal']; ?>&amp;hierro1=<?php echo $hierro1; ?>&amp;clase1=<?php echo $clase1; ?>&amp;color1=<?php echo $color1; ?>&amp;raza1=<?php echo $raza1; ?>&amp;cmpal=<?php echo $cmpal; ?>&amp;respal=<?php echo $respal; ?>">VOE</a></td>
      
    
    <td bgcolor="#FFFFFF"><a href="estados_palpa_vcn.php?jpalpa=<?php echo $row_vac['jpalpa']; ?>&amp;id_vacuno=<?php echo $row_vac['id_vacuno']; ?>&amp;hacien=<?php echo $row_vac['ubicasion']; ?>&amp;responsable=<?php echo $row_vac['respal']; ?>&amp;hierro1=<?php echo $hierro1; ?>&amp;clase1=<?php echo $clase1; ?>&amp;color1=<?php echo $color1; ?>&amp;raza1=<?php echo $raza1; ?>&amp;cmpal=<?php echo $cmpal; ?>&amp;respal=<?php echo $respal; ?>">VCN</a></td>
    
    <td bgcolor="#FFFFFF"><a href="estados_palpa_pn.php?jpalpa=<?php echo $row_vac['jpalpa']; ?>&amp;id_vacuno=<?php echo $row_vac['id_vacuno']; ?>&amp;responsable=<?php echo $row_vac['respal']; ?>&amp;hacien=<?php echo $row_vac['ubicasion']; ?>&amp;cmpal=<?php echo $row_vac['cmpal']; ?>&amp;hierro1=<?php echo $hierro1; ?>&amp;clase1=<?php echo $clase1; ?>&amp;color1=<?php echo $color1; ?>&amp;raza1=<?php echo $raza1; ?>&amp;cmpal=<?php echo $cmpal; ?>&amp;respal=<?php echo $respal; ?>&amp;vaca=<?php echo $row_vac['id_vacuno']; ?>">P(N)</a></td>
    
    
    <td bgcolor="#FFFFFF"><a href="estados_palpa_ppp.php?hacien=<?php echo $row_vac['ubicasion']; ?>&amp;responsable=<?php echo $row_vac['respal']; ?>&amp;id_vacuno=<?php echo $row_vac['id_vacuno']; ?>&amp;jpalpa=<?php echo $row_vac['jpalpa']; ?>&amp;hierro1=<?php echo $hierro1; ?>&amp;clase1=<?php echo $clase1; ?>&amp;color1=<?php echo $color1; ?>&amp;raza1=<?php echo $raza1; ?>&amp;cmpal=<?php echo $cmpal; ?>&amp;respal=<?php echo $respal; ?>">PP</a></td>
    <td bgcolor="#FFFFFF" onclick="return confirm('Desea eliminar Vacuno De La Palpación');" ><a href="eliminar_palpa_jor.php?jpalpa=<?php echo $row_vac['jpalpa']; ?>&amp;id_vacuno=<?php echo $row_vac['id_vacuno']; ?>&amp;hacien=<?php echo $row_vac['ubicasion']; ?>&amp;responsable=<?php echo $row_vac['respal']; ?>&amp;hierro1=<?php echo $hierro1; ?>&amp;clase1=<?php echo $clase1; ?>&amp;color1=<?php echo $color1; ?>&amp;raza1=<?php echo $raza1; ?>&amp;cmpal=<?php echo $cmpal; ?>&amp;respal=<?php echo $respal; ?>">Eliminar</td>
  </tr>
  <?php } while ($row_vac = mysql_fetch_assoc($vac)); ?>
</table>




</DIV>
<script type="text/javascript">
var spjamanield2 = new Spry.Widget.ValidationTextField("sprytextfield2", "integer", {validateOn:["blur"]});
</script>
<p><a href="jornada_palpacion.php"></a></p>
</body>
</html>
<?php
mysql_free_result($vac);

mysql_free_result($rpn);

mysql_free_result($jor);
?>

<?
@$textarea_tarea =$_POST['text_tareas'];
@$estado =$_POST['hiddenFiel_estado'];


@$diabini=trim(strip_tags($_POST['select_dia_ini']));
@$mesbini=trim(strip_tags($_POST['select_mes_ini']));
@$anobini=trim(strip_tags($_POST['text_anos_ini']));
@$text_f_tareaini=$anobini.'-'.$mesbini.'-'.$diabini;


@$diab=trim(strip_tags($_POST['select_dia']));
@$mesb=trim(strip_tags($_POST['select_mes']));
@$anob=trim(strip_tags($_POST['text_anos']));
@$text_f_tarea=$anob.'-'.$mesb.'-'.$diab;

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
@$comen=$_GET['comen'];
echo $comen;
@$raza = $_POST['raza'];
@$color = $_POST['color'];
@$sexo = $_POST['sexo'];
@$clase = $_POST['clase'];
@$hierro = $_POST['hierro'];
@$respon =$_POST['respon'];



$queEmp ="SELECT * FROM `d89xz_empleados` WHERE `nombre`= '$respon'";
					$resEmp = mysql_query($queEmp, $conexion) or die(mysql_error());
					$totEmp = mysql_num_rows($resEmp);
					if ($totEmp> 0) {
						
						while ($rowEmp = mysql_fetch_assoc($resEmp)) {
						$nombre=	$rowEmp['nombre'];	
						$apellido=	$rowEmp['apellido'];				
						}
					}
	@$responsable = $nombre.$apellido;


?>

<?
if($sexo != 'sexo'){
$queEmp ="SELECT * FROM  d89xz_consecu_orden";
					$resEmp = mysql_query($queEmp, $conexion) or die(mysql_error());
					$totEmp = mysql_num_rows($resEmp);
					if ($totEmp> 0) {
						
						while ($rowEmp = mysql_fetch_assoc($resEmp)) {
						@$consecutivo=	$rowEmp['palpa'];	
									
						}
					}	
	
	
$insertar = mysql_query("UPDATE `d89xz_vacunos` SET `jpalpa`='$consecutivo',`respal`='$responsable'  WHERE `raza`='$raza' and `color`='$color' and `sexo`='hembra' and `clase`='$clase' and `hierro`='$hierro' ", $conexion);

$insertar = mysql_query("UPDATE `d89xz_consecu_orden` SET `palpa`= palpa+ 1", $conexion);
}
?>
 


<?

mysql_close($conexion);
?> 