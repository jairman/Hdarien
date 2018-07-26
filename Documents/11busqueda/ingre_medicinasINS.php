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



if ((isset($_POST["MM_insert"])) && ($_POST["MM_insert"] == "form2")) {			   
					   
  $insertSQL = sprintf("INSERT INTO d89xz_total_medicinasins (tipo, nombre, descrip, cont, mark, coment, m_uso, p_act, admin) VALUES (%s, %s, %s, %s, %s, %s, %s, %s, %s)",
                      
                       GetSQLValueString($_POST['tipo'], "text"),
                       GetSQLValueString($_POST['nombre'], "text"),
                       GetSQLValueString($_POST['descrip'], "text"),
                       GetSQLValueString($_POST['cont'], "text"),
					   GetSQLValueString($_POST['mark'], "text"),
					   GetSQLValueString($_POST['coment'], "text"),
					   GetSQLValueString($_POST['m_uso'], "text"),
					   GetSQLValueString($_POST['activo'], "text"),
						GetSQLValueString($_POST['admin'], "text"));
					  
					   

  mysql_select_db($database_conexion, $conexion);
  $Result1 = mysql_query($insertSQL, $conexion) or die(mysql_error());
  
}



mysql_select_db($database_conexion, $conexion);
$query_md = "SELECT * FROM d89xz_tipo_medininas";
$md = mysql_query($query_md, $conexion) or die(mysql_error());
$row_md = mysql_fetch_assoc($md);
$totalRows_md = mysql_num_rows($md);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Documento sin título</title>
<style type="text/css">
.c {
	color: #FFF;
}
#form2 table tr th {
	color: #FFF;
}
c {
	color: #FFF;
}
</style>
<script src="SpryAssets/SpryValidationTextField.js" type="text/javascript"></script>
<link href="SpryAssets/SpryValidationTextField.css" rel="stylesheet" type="text/css" />
</head><body>
<p>&nbsp; </p>
<DIV ID="seleccion">
<form action="<?php echo $editFormAction; ?>" method="post" name="form2" id="form2">
  <table width="500" border="1" align="center" cellspacing="0">
    <tr bgcolor="#4D68A2">
      <th colspan="2">Registrar Insumos</th>
    </tr>
    <tr>
      <td width="175" bgcolor="#FFFFFF" style="color: #000"><strong>Tipo</strong></td>
      <!--<td><input type="text" name="tipo" value="" size="25" /></td>-->
   	   <td bgcolor="#FFFFFF" ><span id="sprytextfield3">
   	     <label for="tipo"></label>
       <span id="sprytextfield4">
   	     <input name="tipo" type="text" id="tipo" size="50" />
       </span><span class="textfieldRequiredMsg">Se necesita un valor.</span></span>
   	     <input name="cantidad" type="hidden" id="cantidad" value="0" />
     	   <input name="entrada" type="hidden" id="entrada" value="Entrada" /></td>
    </tr>
    <tr>
      <td bgcolor="#FFFFFF" style="color: #000"><strong>Nombre</strong></td>
      <td bgcolor="#FFFFFF"><span id="sprytextfield2">
        <input type="text" name="nombre" value="" size="50" />
      </span></td>
    </tr>
    <tr>
      <td bgcolor="#FFFFFF" style="color: #000"><strong>Descripción</strong></td>
      <td bgcolor="#FFFFFF"><input type="text" name="descrip" value="" size="50" /></td>
    </tr>
    <tr>
      <td bgcolor="#FFFFFF" style="color: #000"><strong>Presentación</strong></td>
     
      <td bgcolor="#FFFFFF"><input type="text" name="m_uso" value="" size="50" /></td>
    </tr>
    <tr>
      <td bgcolor="#FFFFFF" style="color: #000"><strong>Dosificación</strong></td>
      <td bgcolor="#FFFFFF"><label for="coment"></label>
      <input name="coment" type="text" id="coment" size="50" /></td>
    </tr>
    <tr>
      <td bgcolor="#FFFFFF" style="color: #000"><strong>Contenido</strong></td>
      <td bgcolor="#FFFFFF"><span id="sprytextfield1">
      <input type="text" name="cont" value="" size="50" />
</span></td>
    </tr>
    <tr>
      <td bgcolor="#FFFFFF" style="color: #000"><strong>Vía Admin</strong></td>
      <td bgcolor="#FFFFFF"><input name="admin" type="text" id="admin" size="50" /></td>
    </tr>
    <tr>
      <td bgcolor="#FFFFFF" style="color: #000"><strong>Marca</strong></td>
      <td bgcolor="#FFFFFF"><input type="text" name="mark" value="" size="50" /></td>
    </tr>
    <tr>
      <td bgcolor="#FFFFFF" style="color: #000"><strong>P. Activo</strong></td>
      <td bgcolor="#FFFFFF"><input name="activo" type="text" id="activo" size="50" /></td>
    </tr>
    <tr bgcolor="#4D68A2">
      <td colspan="2" align="center">
        <input type="image" src="aceptar.png"  onmouseover="src='aceptar1.png';"  onmouseout="src='aceptar.png';" value="Insertar Clientes" alt="aceptar" />
      <a  href="kardex_medicinaINS.php" onclick="javascript:window.parent.Shadowbox.close();"><img src="cancelar.png" alt="" width="68" height="20" /></a> </a></td>
    </tr>
  </table>
<input type="hidden" name="MM_insert" value="form2" />
</form>
<p>&nbsp;</p>
<script type="text/javascript">
var sprytextfield1 = new Spry.Widget.ValidationTextField("sprytextfield1", "none", {validateOn:["blur"]});
var sprytextfield2 = new Spry.Widget.ValidationTextField("sprytextfield2", "none", {validateOn:["blur"]});
var sprytextfield4 = new Spry.Widget.ValidationTextField("sprytextfield4", "none", {validateOn:["blur"]});
</script>
</body>
</html>
<?php
//mysql_free_result($med);

mysql_free_result($md);
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
$tipo=$_POST['tipo'];
if ($tipo !=''){
echo "<script type=''>
      window.location='kardex_medicinaINS.php';
		
	</script>";

}
mysql_close($conexion);
?>
