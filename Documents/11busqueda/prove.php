<?
$ruta_a_joomla = "/../../Hdarien/";

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


@$cedula=$_POST['cedula'];
$queEmp ="SELECT * FROM `d89xz_prove` WHERE `cedula`= '$cedula'";
					$resEmp = mysql_query($queEmp, $conexion) or die(mysql_error());
					$totEmp = mysql_num_rows($resEmp);
			if ($totEmp> 0) {
				while ($rowEmp = mysql_fetch_assoc($resEmp)) {
					$id_docu=	$rowEmp['cedula'];
												
						}
					}
//echo $id_docu;


$editFormAction = $_SERVER['PHP_SELF'];
if (isset($_SERVER['QUERY_STRING'])) {
  $editFormAction .= "?" . htmlentities($_SERVER['QUERY_STRING']);
}
if ($cedula != 0){
	
if($id_docu != $cedula){

if ((isset($_POST["MM_insert"])) && ($_POST["MM_insert"] == "form1")) {
  $insertSQL = sprintf("INSERT INTO  d89xz_prove (cedula, nombre, apellido, telefono, empresa, categ, dir, ciud, fax, mail,comen) VALUES (%s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s)",
                       GetSQLValueString($_POST['cedula'], "text"),
                       GetSQLValueString($_POST['nombre'], "text"),
                       GetSQLValueString($_POST['apellido'], "text"),
                       GetSQLValueString($_POST['telefono'], "text"),
                       GetSQLValueString($_POST['empresa'], "text"),
                       GetSQLValueString($_POST['categ'], "text"),
                       GetSQLValueString($_POST['dir'], "text"),
                       GetSQLValueString($_POST['ciud'], "text"),
                       GetSQLValueString($_POST['fax'], "text"),
					   GetSQLValueString($_POST['mail'], "text"),
                       GetSQLValueString($_POST['comen'], "text"));

  mysql_select_db($database_conexion, $conexion);
  $Result1 = mysql_query($insertSQL, $conexion) or die(mysql_error());
}

		echo "<script type=''>
				alert('Proveedor Registrado  Exitosamente');
			</script>";
			
			echo "<script type=''>
		window.location='prove_kardex.php';
	</script>";
		
		}
		
		if($id_docu == $cedula){
			echo "<script type=''>
				alert('Proveedor Existente');
			</script>";
		
		}
}

mysql_select_db($database_conexion, $conexion);
$query_cl = "SELECT * FROM d89xz_prove";
$cl = mysql_query($query_cl, $conexion) or die(mysql_error());
$row_cl = mysql_fetch_assoc($cl);
$totalRows_cl = mysql_num_rows($cl);

mysql_select_db($database_conexion, $conexion);
$query_ctg = "SELECT * FROM d89xz_catego_prove";
$ctg = mysql_query($query_ctg, $conexion) or die(mysql_error());
$row_ctg = mysql_fetch_assoc($ctg);
$totalRows_ctg = mysql_num_rows($ctg);


?>
<script src="SpryAssets/SpryValidationTextField.js" type="text/javascript"></script>
<link href="SpryAssets/SpryValidationTextField.css" rel="stylesheet" type="text/css" />

<script src="SpryAssets/SpryValidationSelect.js" type="text/javascript"></script>

<link href="SpryAssets/SpryValidationSelect.css" rel="stylesheet" type="text/css" />

<form action="<?php echo $editFormAction; ?>" method="post" name="form1" id="form1">
  <table width="600" border="1" align="center" cellspacing="0">
    <tr align="center" valign="baseline" bgcolor="#4D68A2" style="color: #FFF">
      <th colspan="2"><p>Formulario de Ingreso Proveedores</p></th>
    </tr>
    <tr valign="baseline" bgcolor="#FFFFFF">
      <th width="194" align="left" nowrap="nowrap" style="color: #000">Cedula / NIT</th>
      <td width="394" align="center"><span id="sprytextfield1">
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
      <th align="left" nowrap="nowrap" style="color: #000">Telefono</th>
      <td align="center"><input type="text" name="telefono" value="" size="60" /></td>
    </tr>
    <tr valign="baseline" bgcolor="#FFFFFF">
      <th align="left" nowrap="nowrap" style="color: #000">Empresa</th>
      <td align="center"><input type="text" name="empresa" value="" size="60" /></td>
    </tr>
    <tr valign="baseline" bgcolor="#FFFFFF">
      <th align="left" nowrap="nowrap" style="color: #000"><p>Categor&iacutea</p></th>
      <td align="center"><span id="spryselect1">
        <label for="categ"></label>
        <select name="categ" id="categ" style="width:390">
          <option value="">Seleccione  Categor&iacute;a  Del  Proveedor</option>
          <?php
do {  
?>
          <option value="<?php echo $row_ctg['categ']?>"><?php echo $row_ctg['categ']?></option>
          <?php
} while ($row_ctg = mysql_fetch_assoc($ctg));
  $rows = mysql_num_rows($ctg);
  if($rows > 0) {
      mysql_data_seek($ctg, 0);
	  $row_ctg = mysql_fetch_assoc($ctg);
  }
?>
        </select>
      </span></td>
    </tr>
    <tr valign="baseline" bgcolor="#FFFFFF">
      <th align="left" nowrap="nowrap" style="color: #000"><p>Direcci&oacuten</p></th>
      <td align="center"><input type="text" name="dir" value="" size="60" /></td>
    </tr>
    <tr valign="baseline" bgcolor="#FFFFFF">
      <th align="left" nowrap="nowrap" style="color: #000"><p>Ciudad</p></th>
      <td align="center"><input type="text" name="ciud" value="" size="60" /></td>
    </tr>
    <tr valign="baseline" bgcolor="#FFFFFF">
      <th align="left" nowrap="nowrap" style="color: #000">Fax</th>
      <td align="center"><input type="text" name="fax" value="" size="60" /></td>
    </tr>
    <tr valign="baseline" bgcolor="#FFFFFF">
      <th align="left" nowrap="nowrap" style="color: #000"><p>E mail</p></th>
      <td align="center"><span id="sprytextfield2">
      <input type="text" name="mail" value="" size="60" />
      <span class="textfieldInvalidFormatMsg">Formato no válido.</span></span></td>
    </tr>
    <tr valign="baseline" bgcolor="#FFFFFF">
      <th align="left" nowrap="nowrap" style="color: #000">Comentario</th>
      <td align="center"><input name="comen" type="text" id="comen" value="" size="60" /></td>
    </tr>
    <tr valign="baseline" bgcolor="#FFFFFF" style="color: #FFF">
      <td colspan="2" align="center" nowrap="nowrap"><input type="image" src="aceptar.png"  onmouseover="src='aceptar1.png';"  onmouseout="src='aceptar.png';" value="Insertar Clientes" alt="aceptar" />
      <a  href="prove_kardex.php" onclick="javascript:window.parent.Shadowbox.close();"><img src="cancelar.png" alt="" width="68" height="20" /></a> </a></td>
    </tr>
  </table>
  <input type="hidden" name="MM_insert" value="form1" />
</form>
<p>&nbsp;</p>
<script type="text/javascript">
var sprytextfield1 = new Spry.Widget.ValidationTextField("sprytextfield1", "none", {validateOn:["blur"], hint:"Sugerencia: 8.234.543"});
var spryselect1 = new Spry.Widget.ValidationSelect("spryselect1", {validateOn:["blur"]});
var sprytextfield2 = new Spry.Widget.ValidationTextField("sprytextfield2", "email", {validateOn:["blur"]});
</script>
<?

mysql_free_result($cl);

mysql_free_result($ctg);
?>