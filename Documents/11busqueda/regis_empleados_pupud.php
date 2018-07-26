<?
/*$ruta_a_joomla = "/../../Sganadero/";

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
$userx = JFactory::getUser();*/
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

@$cedula=$_POST['cedula'];
$queEmp ="SELECT * FROM `d89xz_empleados` WHERE `cedula`= '$cedula'";
					$resEmp = mysql_query($queEmp, $conexion) or die(mysql_error());
					$totEmp = mysql_num_rows($resEmp);
			if ($totEmp> 0) {
				while ($rowEmp = mysql_fetch_assoc($resEmp)) {
					$id_docu=	$rowEmp['cedula'];
												
						}
					}






$editFormAction = $_SERVER['PHP_SELF'];
if (isset($_SERVER['QUERY_STRING'])) {
  $editFormAction .= "?" . htmlentities($_SERVER['QUERY_STRING']);
}

if ($cedula != 0){
	
if($id_docu != $cedula){

if ((isset($_POST["MM_insert"])) && ($_POST["MM_insert"] == "form1")) {
  $insertSQL = sprintf("INSERT INTO d89xz_empleados (cedula, nombre, apellido, funcion, sueldo, hacienda,tel) VALUES (%s, %s, %s, %s, %s, %s, %s)",
                       GetSQLValueString($_POST['cedula'], "text"),
                       GetSQLValueString($_POST['nombre'], "text"),
                       GetSQLValueString($_POST['apellido'], "text"),
                       GetSQLValueString($_POST['funcion'], "text"),
                       GetSQLValueString($_POST['sueldo'], "int"),
                       
                       GetSQLValueString($_POST['hacienda'], "text"),
					    GetSQLValueString($_POST['tel'], "text") );

  mysql_select_db($database_conexion, $conexion);
  $Result1 = mysql_query($insertSQL, $conexion) or die(mysql_error());
}
  echo "<script type=''>
				alert('Empleado Registrado  Exitosamente');
			</script>";
			
			echo "<script type=''>
		window.location='regis_empleados.php';
	</script>";
}
}
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
<form action="<?php echo $editFormAction; ?>" method="post" name="form1" id="form1">
  <table width="600" border="1" align="center" cellspacing="0">
    <tr valign="baseline" bgcolor="#4D68A2">
      <th colspan="2" align="center" nowrap="nowrap" style="font-weight: bold; color: #FFF;">Formulario de Ingreso</th>
    </tr>
    <tr valign="baseline" bgcolor="#FFFFFF">
      <th width="202" align="left" nowrap="nowrap" style="color: #000">Cedula</th>
      <td width="382" align="center"><span id="sprytextfield1">
        <input type="text" name="cedula" value="" size="60" />
      </span></td>
    </tr>
    <tr valign="baseline" bgcolor="#FFFFFF">
      <th align="left" nowrap="nowrap" style="color: #000">Nombre</th>
      <td align="center"><input type="text" name="nombre" value="" size="60" /></td>
    </tr>
    <tr valign="baseline" bgcolor="#FFFFFF">
      <th align="left" nowrap="nowrap" style="color: #000">Apellido</th>
      <td align="center"><input type="text" name="apellido" value="" size="60" /></td>
    </tr>
    <tr valign="baseline" bgcolor="#FFFFFF">
      <th align="left" nowrap="nowrap" style="color: #000">Funcion</th>
      <td align="center"><input type="text" name="funcion" value="" size="60" /></td>
    </tr>
    <tr valign="baseline" bgcolor="#FFFFFF">
      <th align="left" nowrap="nowrap" style="color: #000">Sueldo</th>
      <td align="center"><input type="text" name="sueldo" value="" size="60" /></td>
    </tr>
    <tr valign="baseline" bgcolor="#FFFFFF">
      <th align="left" nowrap="nowrap" style="color: #000">Sede</th>
      <td align="center"><span id="spryselect1">
        <label for="hacienda"></label>
        <select name="hacienda" id="hacienda" style="width:400px">
          <option>Seleccione</option>
          <option value="Hotel">Hotel</option>
          <option value="Restaurante">Restaurante</option>
        </select>
      </span></td>
    </tr>
    <tr valign="baseline" bgcolor="#FFFFFF">
      <th align="left" nowrap="nowrap" style="color: #000">Telefono</th>
      <td align="center"><input name="tel" type="text" id="tel" value="" size="60" /></td>
    </tr>
    <tr valign="baseline" bgcolor="#FFFFFF">
      <td colspan="2" align="center" nowrap="nowrap"><input type="image" src="aceptar.png"  onmouseover="src='aceptar1.png';"  onmouseout="src='aceptar.png';" value="Insertar Clientes" alt="aceptar" />
        <a  href="regis_empleados.php" onClick="javascript:window.parent.Shadowbox.close();"><img src="cancelar.png" width="68" height="20"></a>  </a></td>
    </tr>
  </table>
  <input type="hidden" name="MM_insert" value="form1" />
</form>
<p>&nbsp;</p>
<script type="text/javascript">
var sprytextfield1 = new Spry.Widget.ValidationTextField("sprytextfield1", "none", {hint:"Sugerencia: 8.234.543", validateOn:["blur"]});
var spryselect1 = new Spry.Widget.ValidationSelect("spryselect1", {validateOn:["blur"]});
</script>
</body>
</html>