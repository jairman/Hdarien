<?
$ruta_a_joomla = "/../../../carnesdana/";
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
  $usuario2= $userx->usertype2;
	$acceso= $userx->agenda;
if (JFactory::getUser()->usertype == NULL)
    JError::raiseError(1,"No puede acceder A esta Aplicación sin estar logueado... Consulte al Administrador....!!!");
$userx = JFactory::getUser();

?>
<?php require_once('../Connections/conexion.php'); ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Documento sin título</title>
<script src="../SpryAssets/SpryValidationTextField.js" type="text/javascript"></script>
<link href="../SpryAssets/SpryValidationTextField.css" rel="stylesheet" type="text/css" />
<link href="../ingreso/css/clean.css" rel="stylesheet" type="text/css" />
<link rel="stylesheet" type="text/css" href="http://code.jquery.com/ui/1.10.3/themes/smoothness/jquery-ui.css" />
<link href="../ingreso/css/shadowbox.css" rel="stylesheet" type="text/css" />
<link href="../ingreso/css/style.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.3.1/jquery.min.js"></script>
<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.8.18/jquery-ui.min.js"></script>
<script type="text/javascript" src="//ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
<script type="text/javascript" src="http://code.jquery.com/ui/1.10.3/jquery-ui.js"></script>
<script src="../ingreso/js/shadowbox.js" type="text/javascript"></script>
<script src="../ingreso/js/jquery.validate.js" type="text/javascript"></script>
</head>

<body>
<?
///////////////////////HORA LOCAL////////////////////////
function hora_local($zona_horaria = 0)
{
	if ($zona_horaria > -12.1 and $zona_horaria < 12.1)
	{
		$hora_local = time() + ($zona_horaria * 3600);
		return $hora_local;
	}
	return 'error';
}

  $hora=gmdate('H:i:s', hora_local(-5));

 $fecha=gmdate('Y-m-d', hora_local(-5));
  //////////////////////////////////////////////////////////
 $cedula=$_GET['cedula'];
  $variable=$_GET['variable'];
 
////////////////////////////////////////////////////////////
if($variable=='salida'){///////////////////////SALIDA JORNADA //////////////////////////////////////////
	mysql_select_db($database_conexion, $conexion);
	$query_det = sprintf("SELECT * FROM nomina_ingreso WHERE cedulaorg ='$cedula' order by fecha desc");
	$det = mysql_query($query_det, $conexion) or die(mysql_error());
	$row_det = mysql_fetch_assoc($det);
	
	

	if ($row_det['fecha'] == $fecha){	
				
						//echo "final". $row_det['inicio'];
						 $h1=substr($row_det['inicio'],0,-3);
						 $m1=substr($row_det['inicio'],3,2);
						 $h2=substr($hora,0,-3);
						 $m2=substr($hora,3,2);
						 $ini=(($h1*60)*60)+($m1*60);
						 $fin=(($h2*60)*60)+($m2*60);
						 $dif=$fin-$ini;
						$difh=floor($dif/3600);
						//echo "<br>";
						 $difm=floor(($dif-($difh*3600))/60);
						//return date("H:i:s",mktime($difh,$difm,'00'));
						$hnormales=1;
						$htotales=$difh;
						$htrabajo=8;/////Horas laborales de empresa
						$hextras1=($htotales-$htrabajo);
						if($hextras1 >0){
							$hextras=$hextras1;
						}
						$hnormales=$htotales-$hextras;
			$insertar = mysql_query("UPDATE `nomina_ingreso` SET `final`='$hora', htotales='$htotales', hextras='$hextras',hnormales='$hnormales' WHERE cedulaorg ='$cedula' and fecha = '$fecha'");
	
echo "<script type=''>
		window.location='kardex.php';
	</script>";						
}
}
////////////////////////////////////////////////////////////
if($variable =='salalmuer'){///////////////////////SALIDA ALMUERZO //////////////////////////////////////////
$insertar = mysql_query("UPDATE `nomina_ingreso` SET `h_sali`='$hora' WHERE cedulaorg ='$cedula' and fecha = '$fecha'");

	echo "<script type=''>
		window.location='kardex.php';
	</script>";	
	////////////////////////////////////////////////////////////

}
////////////////////////////////////////////////////////////
if($variable =='permiso'){///////////////////////Permisos //////////////////////////////////////////
if ((isset($_POST["tiemp"])) && ($_POST["MM_insert"] == "form1")) {
	$insertar = mysql_query("UPDATE `nomina_ingreso` SET `permisos`='$_POST[tiemp]',`h_permiso`='$hora',`comen`='$_POST[comen]' WHERE cedulaorg ='$cedula' and fecha = '$fecha'");

	echo "<script type=''>
		window.location='kardex.php';
	</script>";	
	
}

?>

<form id="form1" name="form1" method="post" action="">
<table width="60%" border="0" align="center">
  <tr>
    <td colspan="2" align="left" ><img src="img/logo3.png" width="300" height="140" /></td>
  </tr>
  <tr>
    <td colspan="2" align="center" class="tittle">Permisos</td>
  </tr>
  <tr>
    <td width="49%" class="bold">Justificación</td>
    <td width="51%" align="center"><label for="comen"></label>
      <input name="comen" type="text" class="cont" id="comen" style="width:90%" /></td>
  </tr>
  <tr>
    <td class="bold">Tiempo Estimado</td>
    <td align="center"><span id="sprytextfield1">
    <input name="tiemp" type="text" class="cont" id="tiemp" style="width:90%" />
    <span class="textfieldRequiredMsg">Se necesita un valor.</span><span class="textfieldInvalidFormatMsg">Formato no válido.</span></span></td>
  </tr>
  <tr>
    <td colspan="2" align="center" >&nbsp;</td>
  </tr>
  <tr>
    <td colspan="2" align="center" ><input type="submit" name="button" id="button" value="Registrar  Permiso"  class="ext"/></td>
    </tr>
</table>
<input type="hidden" name="MM_insert" value="form1" />
</form>
<? }

if($variable =='citas'){//////////////////////Incapacidad  Médica//////////////////////////////////////////
if ((isset($_POST["tiemp"])) && ($_POST["MM_insert"] == "form1")) {
	$insertar = mysql_query("UPDATE `nomina_ingreso` SET `incapacidad`='$_POST[tiemp]',`h_incapa`='$hora',`comen`='$_POST[comen]' WHERE cedulaorg='$cedula' and fecha = '$fecha'");

	echo "<script type=''>
		window.location='kardex.php';
	</script>";	
	
}

?>

<form id="form1" name="form1" method="post" action="">
<table width="60%" border="0" align="center">
  <tr>
    <td colspan="2" align="left" ><img src="img/logo3.png" alt="" width="300" height="140" /></td>
  </tr>
  <tr>
    <td colspan="2" align="center" class="tittle">Incapacidad  Médica</td>
  </tr>
  <tr>
    <td width="49%" class="bold">Justificación</td>
    <td width="51%" align="center"><label for="comen"></label>
      <input name="comen" type="text" class="cont" id="comen" style="width:90%" /></td>
  </tr>
  <tr>
    <td class="bold">Tiempo Estimado</td>
    <td align="center"><span id="sprytextfield1">
    <input name="tiemp" type="text" class="cont" id="tiemp" style="width:90%" />
    <span class="textfieldRequiredMsg">Se necesita un valor.</span><span class="textfieldInvalidFormatMsg">Formato no válido.</span></span></td>
  </tr>
  <tr>
    <td colspan="2" align="center" >&nbsp;</td>
  </tr>
  <tr>
    <td colspan="2" align="center" ><input type="submit" name="button" id="button" value="Registrar  Permiso"  class="ext"/></td>
    </tr>
</table>
<input type="hidden" name="MM_insert" value="form1" />
</form>
<? }?>

<script type="text/javascript">
var sprytextfield1 = new Spry.Widget.ValidationTextField("sprytextfield1", "integer", {validateOn:["blur"]});
</script>
</body>
</html>