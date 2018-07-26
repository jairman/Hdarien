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

$editFormAction = $_SERVER['PHP_SELF'];
if (isset($_SERVER['QUERY_STRING'])) {
  $editFormAction .= "?" . htmlentities($_SERVER['QUERY_STRING']);
}

if ((isset($_POST["MM_insert"])) && ($_POST["MM_insert"] == "form15")) {
  $insertSQL = sprintf("INSERT INTO d89xz_vacunos (id_vacuno, f_ingreso, e_ingreso, raza, padre, madre, clasificasion, calificasion, sexo, observasiones, hierro) VALUES (%s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s)",
                       GetSQLValueString($_POST['id_vacuno'], "int"),
                       GetSQLValueString($_POST['f_ingreso'], "date"),
                       GetSQLValueString($_POST['e_ingreso'], "int"),
                       GetSQLValueString($_POST['raza'], "text"),
                       GetSQLValueString($_POST['padre'], "int"),
                       GetSQLValueString($_POST['madre'], "int"),
                       GetSQLValueString($_POST['clasificasion'], "text"),
                       GetSQLValueString($_POST['calificasion'], "int"),
                       GetSQLValueString($_POST['sexo'], "text"),
                       GetSQLValueString($_POST['observasiones'], "text"),
                       GetSQLValueString($_POST['hierro'], "text"));

  mysql_select_db($database_conexion, $conexion);
  $Result1 = mysql_query($insertSQL, $conexion) or die(mysql_error());
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
<table width="700" border="2">
  <tr>
    <th colspan="6" bgcolor="#c0e3e9" scope="col"><p><strong>Ingrese los datos del vacuno</strong></p></th>
  </tr>
  <tr>
    <td width="108" scope="col"><strong>ID Vacuno</strong></td>
    <td width="72" scope="col"><form id="form1" name="form1" method="post" action="">
      <span id="spry_idvacuno">
      <label for="text3"></label>
      <input name="text1" type="text" id="text3" size="8" />
      <span class="textfieldInvalidFormatMsg">ormato no válido.</span></span>
    </form></td>
    <td width="104" scope="col"><strong>Fecha Ingreso</strong></td>
    <td width="71" scope="col"><form id="form3" name="form3" method="post" action="">
      <span id="spry_fechaing">
      <label for="text4"></label>
      <input name="text2" type="text" id="text4" size="10" />
      </span>
    </form></td>
    <td width="118" scope="col"><strong>Edad Ingreso</strong></td>
    <td width="71" scope="col"><form id="form10" name="form10" method="post" action="">
      <span id="spry_edad">
      <label for="text_edad_ingreso"></label>
      <input name="text_edad_ingreso" type="text" id="text_edad_ingreso" size="10" />
      <span class="textfieldInvalidFormatMsg">Formato no válido.</span></span>
    </form></td>
  </tr>
  <tr>
    <td><strong>Raza</strong></td>
    <td><form id="form2" name="form2" method="post" action="">
      <span id="spry_raza">
        <label for="select_raza"></label>
        <select name="select_raza" id="select_raza">
        </select>
      </span>
    </form></td>
    <td><strong>Padre</strong></td>
    <td width="71"><form id="form4" name="form4" method="post" action="">
      <span id="spry_padre">
      <label for="text5"></label>
      <input name="text5" type="text" id="text5" size="10" />
      </span>
    </form></td>
    <td><strong>Madre</strong></td>
    <td width="71"><form id="form11" name="form11" method="post" action="">
      <span id="spry_madre">
      <label for="text6"></label>
      <input name="text6" type="text" id="text6" size="10" />
      </span>
    </form></td>
  </tr>
  <tr>
    <td> <strong>Calificación </strong></td>
    <td><form id="form5" name="form5" method="post" action="">
      <span id="spry_calificacion">
        <label for="select_calificacion"></label>
        <select name="select_calificacion" id="select_calificacion">
        </select>
      </span>
    </form></td>
    <td> <strong>Clasificación </strong></td>
    <td><form id="form7" name="form7" method="post" action="">
      <span id="spry_clasificacion">
        <label for="select_clasicicacion"></label>
        <select name="select_clasicicacion" id="select_clasicicacion">
        </select>
      </span>
    </form></td>
    <td><strong>Sexo</strong></td>
    <td width="71"><form id="form12" name="form12" method="post" action="">
      <span id="spry_sexo">
        <label for="select_sexo"></label>
        <select name="select_sexo" id="select_sexo">
          <option>Seleccione Sexo</option>
          <option value="Macho">Macho</option>
          <option value="Hembra">Hembra</option>
        </select>
      </span>
    </form></td>
  </tr>
  <tr>
    <td><strong>Hierro</strong></td>
    <td><form id="form6" name="form6" method="post" action="">
      <span id="spry_hierro">
        <label for="select_hierro"></label>
        <select name="select_hierro" id="select_hierro">
        </select>
      </span>
    </form></td>
    <td> <strong>Reproductora </strong></td>
    <td><form id="form8" name="form8" method="post" action="">
      <label for="select_reproductora"></label>
      <select name="select_reproductora" id="select_reproductora">
        <option>Seleccione </option>
        <option value="si">Si</option>
        <option value="no">No</option>
      </select>
    </form></td>
    <td> <strong>Ubic.  Hda </strong></td>
    <td><form id="form13" name="form13" method="post" action="">
      <span id="spry_ubichada">
        <label for="select1"></label>
        <select name="select1" id="select1">
        </select>
      </span>
    </form></td>
  </tr>
  <tr>
    <td> <strong>Observasiones </strong></td>
    <td colspan="3"><form id="form9" name="form9" method="post" action="">
      <label for="textarea_observa"></label>
      <textarea name="textarea_observa" id="textarea_observa" cols="40" rows="1"></textarea>
    </form></td>
    <td>&nbsp;</td>
    <th><form id="form14" name="form14" method="post" action="">
      <input type="submit" name="button" id="button" value="Enviar" />
    </form></th>
  </tr>
</table>
<p>&nbsp; </p>
<script type="text/javascript">
var sprytextfield1 = new Spry.Widget.ValidationTextField("spry_idvacuno", "integer", {hint:"10001", validateOn:["blur"]});
var sprytextfield2 = new Spry.Widget.ValidationTextField("spry_fechaing", "date", {format:"yyyy/mm/dd", hint:"2012-03-13", validateOn:["blur"]});
var sprytextfield3 = new Spry.Widget.ValidationTextField("spry_padre", "integer", {hint:"10001", validateOn:["blur"]});
var spryselect1 = new Spry.Widget.ValidationSelect("spry_raza", {validateOn:["blur"]});
var spryselect2 = new Spry.Widget.ValidationSelect("spry_calificacion", {validateOn:["blur"]});
var spryselect3 = new Spry.Widget.ValidationSelect("spry_hierro", {validateOn:["blur"]});
var spryselect4 = new Spry.Widget.ValidationSelect("spry_clasificacion", {validateOn:["blur"]});
var sprytextfield4 = new Spry.Widget.ValidationTextField("spry_edad", "integer", {hint:"3", validateOn:["blur"]});
var sprytextfield5 = new Spry.Widget.ValidationTextField("spry_madre", "integer", {hint:"10002", validateOn:["blur"]});
var spryselect5 = new Spry.Widget.ValidationSelect("spry_sexo", {validateOn:["blur"]});
var spryselect6 = new Spry.Widget.ValidationSelect("spry_ubichada", {validateOn:["blur"]});
  </script>
</body>
</html>