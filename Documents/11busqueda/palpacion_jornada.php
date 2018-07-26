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
$query_cli = "SELECT * FROM d89xz_empleados";
$cli = mysql_query($query_cli, $conexion) or die(mysql_error());
$row_cli = mysql_fetch_assoc($cli);
$totalRows_cli = mysql_num_rows($cli);

$vacuno =$_GET['vacuno'];
$hacien =$_GET['hacien'];
$estado =$_GET['estado'];
$jornada1=$_GET['jpalpa'];






?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Documento sin título</title>
<script src="SpryAssets/SpryValidationSelect.js" type="text/javascript"></script>
<link href="SpryAssets/SpryValidationSelect.css" rel="stylesheet" type="text/css" />
</head>

<body>
<img src="idsolutions--este.png" width="162" height="59" />
<form id="form1" name="form1" method="post" action="">
  <table width="559" border="1">
    <tr>
      <th colspan="3" bgcolor="#4D68A2" style="color: #FFF; font-size: 16px;"><?php echo "Vacuno =$vacuno .''. Hacienda =$hacien.''. Estado Actual =$estado" ?></th>
    </tr>
    <tr>
      <th width="269">Estado</th>
      <th><span id="spryselect4">
        <label for="select2"></label>
        <select name="estado" id="select2">
          <option value='1' >Seleccione</option>
          <option value="VOE">VOE</option>
          <option value="VCN">VCN</option>
          <option value="PPP">PPP</option>
          <option value="P(N)">P(N)</option>
        </select>
      </span></th>
      <td width="51"><input type="submit" name="button" id="button" value="Enviar" /></td>
    </tr>
  </table>
</form>
<p>&nbsp;</p>
<p><a href="jornada_palpacion+++.php?jpalpa=<?php echo $jornada1; ?>">Volver</a></p>
<script type="text/javascript">
var spryselect4 = new Spry.Widget.ValidationSelect("spryselect4", {validateOn:["blur"]});
  </script>
</body>
</html>
<?php
mysql_free_result($cli);
?>


<?
//$id =$_GET['id'];

$responsable =$_GET['responsable'];
$estado=$_POST['estado'];
$jornada=$_GET['jpalpa'];

$diab=trim(strip_tags($_POST['dia']));
$mesb=trim(strip_tags($_POST['mes']));
$anob=trim(strip_tags($_POST['anos']));
$fecha_palpa=$anob.'-'.$mesb.'-'.$diab;


?>
<?

if ($estado != '' ){				
					
    $insertar = mysql_query("INSERT INTO d89xz_detalle_palpacion(vaca,f_palpa,estado,resp,hda,jornd)
						VALUES ('{$vacuno}',NOW(),'{$estado}','{$responsable}','{$hacien}','{$jornada}')");
						echo "<br>";
						echo "<font size=5 color='#0000FF'>$V_1--Registro  Exitoso</font>";
						$sql1 =mysql_query("UPDATE `d89xz_vacunos` SET `tp_rep`='$estado'  WHERE `id_vacuno`='$vacuno'");
						
						
						// quita etiqueta
						$sql1 =mysql_query("UPDATE `d89xz_vacunos` SET `jpalpa`=''  WHERE `id_vacuno`='$vacuno'");
		
	
		mysql_close($conexion);
}
	   
?>	   


 



