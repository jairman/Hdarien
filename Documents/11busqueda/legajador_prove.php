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

if ((isset($_POST["MM_update"])) && ($_POST["MM_update"] == "form1")) {
  $updateSQL = sprintf("UPDATE d89xz_prove SET cedula=%s, nombre=%s, apellido=%s, telefono=%s, empresa=%s, categ=%s, dir=%s, ciud=%s, fax=%s, mail=%s, cel=%s , comen=%s WHERE id=%s",
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
					   GetSQLValueString($_POST['celular'], "text"),
					   GetSQLValueString($_POST['comen'], "text"),
                       GetSQLValueString($_POST['id'], "int"));

  mysql_select_db($database_conexion, $conexion);
  $Result1 = mysql_query($updateSQL, $conexion) or die(mysql_error());

  $updateGoTo = "prove_kardex.php";
  if (isset($_SERVER['QUERY_STRING'])) {
    $updateGoTo .= (strpos($updateGoTo, '?')) ? "&" : "?";
    $updateGoTo .= $_SERVER['QUERY_STRING'];
  }
  header(sprintf("Location: %s", $updateGoTo));
}

$colname_ss = "-1";
if (isset($_GET['cedula'])) {
  $colname_ss =  $_GET['cedula'];
  
}


mysql_select_db($database_conexion, $conexion);
$query_ss = sprintf("SELECT * FROM d89xz_prove WHERE cedula = %s", GetSQLValueString($colname_ss, "text"));
$ss = mysql_query($query_ss, $conexion) or die(mysql_error());
$row_ss = mysql_fetch_assoc($ss);
$totalRows_ss = mysql_num_rows($ss);

mysql_select_db($database_conexion, $conexion);
$query_ctg = "SELECT * FROM d89xz_catego_prove";
$ctg = mysql_query($query_ctg, $conexion) or die(mysql_error());
$row_ctg = mysql_fetch_assoc($ctg);
$totalRows_ctg = mysql_num_rows($ctg);

@$prove=$_GET['prove'];
mysql_select_db($database_conexion, $conexion);
$query_fac = "SELECT * FROM d89xz_diario WHERE `cel_prove`='$prove'";
$fac = mysql_query($query_fac, $conexion) or die(mysql_error());
$row_fac = mysql_fetch_assoc($fac);
$totalRows_fac = mysql_num_rows($fac);

$colname_inb = "-1";
if (isset($_GET['cedula'])) {
  $colname_inb = $_GET['cedula'];
}
mysql_select_db($database_conexion, $conexion);
$query_inb = sprintf("SELECT * FROM d89xz_prove WHERE cedula = %s", GetSQLValueString($colname_inb, "text"));
$inb = mysql_query($query_inb, $conexion) or die(mysql_error());
$row_inb = mysql_fetch_assoc($inb);
$totalRows_inb = mysql_num_rows($inb);

?>
<script src="SpryAssets/SpryValidationSelect.js" type="text/javascript"></script>
<link href="SpryAssets/SpryValidationSelect.css" rel="stylesheet" type="text/css" />



<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Documento sin título</title>
<script src="SpryAssets/SpryTabbedPanels.js" type="text/javascript"></script>
<link href="SpryAssets/SpryTabbedPanels.css" rel="stylesheet" type="text/css" />
<style type="text/css">
body {
	background-color: #FFF;
}
</style>
</head>

<body>
<div id="TabbedPanels1" class="TabbedPanels">
  <ul type="square" class="TabbedPanelsTabGroup">
    <li class="TabbedPanelsTab" tabindex=""> Información Básica </li>
    <li class="TabbedPanelsTab" tabindex="">Historial</li>
<li type="square" class="TabbedPanelsTab" tabindex="">Editar Proveedores</li>
<!--  le quite el recuadrito maluquito  tabindex="0"  -->
</p>
<p>&nbsp;</p>
<table width="100%" border="0" align="center" cellspacing="0">
  <tr>
    <td width="121" align="left">&nbsp;</td>
    <td width="121" align="left">&nbsp;</td>
    <td width="308" align="center"><a href="prove_kardex.php?cedula=<?php echo $cedula; ?>&amp;hierro=<?php echo $hierro; ?>&amp;cmpes=<?php echo $cmpes; ?>&amp;respes=<?php echo $respon; ?>"><img src="last.png" alt="" width="29" height="31" border="0" /></a></td>
    <td width="239" align="right"><a href="javascript:imprSelec('seleccion')" ><img src="imprimir.png" alt="" width="36" height="35" border="0" align="right" /></a></td>
  </tr>
</table>
  </ul>
  <div class="TabbedPanelsContentGroup">
    <div class="TabbedPanelsContent">
      <DIV ID="seleccion">
        
        <p>&nbsp;</p>
      <form id="form2" name="form2" method="post" action="">
       
        <table width="800" align="center">
          <tr>
            <th colspan="4" bgcolor="#4D68A2" style="color: #FFF">Información Básica Del Proveedores</th>
          </tr>
          <tr>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
          </tr>
          <tr>
            <td width="105"><strong>Nombre</strong></td>
            <td width="390"><label for="textfield"></label>
              <input name="textfield" type="text" id="textfield" value="<?php echo $row_inb['nombre']; ?>" size="60" readonly="readonly" /></td>
            <td width="86"><strong>Cedula/Nit</strong></td>
            <td width="301"><label for="textfield2"></label>
              <input name="textfield2" type="text" id="textfield2" value="<?php echo $row_inb['cedula']; ?>" size="40" readonly="readonly" /></td>
          </tr>
          <tr>
            <td><p><strong>Dirección</strong></p></td>
            <td><input name="textfield3" type="text" id="textfield3" value="<?php echo $row_inb['dir']; ?>" size="60" readonly="readonly" /></td>
            <td><strong>Ciudad</strong></td>
            <td><input name="textfield9" type="text" id="textfield9" value="<?php echo $row_inb['ciud']; ?>" size="40" readonly="readonly" /></td>
          </tr>
          <tr>
            <td><strong>Telefono</strong></td>
            <td><input name="textfield4" type="text" id="textfield4" value="<?php echo $row_inb['telefono']; ?>" size="60" readonly="readonly" /></td>
            <td><strong>Fax</strong></td>
            <td><input name="textfield10" type="text" id="textfield10" value="<?php echo $row_inb['fax']; ?>" size="40" readonly="readonly" /></td>
          </tr>
          <tr>
            <td><strong>Web</strong></td>
            <td><input name="textfield5" type="text" id="textfield5" value="<?php echo $row_inb['apellido']; ?>" size="60" readonly="readonly" /></td>
            <td><strong>Categoría</strong></td>
            <td><input name="textfield11" type="text" id="textfield11" value="<?php echo $row_inb['categ']; ?>" size="40" readonly="readonly" /></td>
          </tr>
          <tr>
            <td><strong>Contacto</strong></td>
            <td><input name="textfield6" type="text" id="textfield6" value="<?php echo $row_inb['empresa']; ?>" size="60" readonly="readonly" /></td>
            <td><p><strong>email</strong></p></td>
            <td><input name="textfield12" type="text" id="textfield12" value="<?php echo $row_inb['mail']; ?>" size="40" readonly="readonly" /></td>
          </tr>
          <tr>
            <td><strong>Observaciones</strong></td>
            <td><input name="textfield8" type="text" id="textfield8" value="<?php echo $row_inb['comen']; ?>" size="60" readonly="readonly" /></td>
            <td>Celular</td>
            <td><input name="textfield7" type="text" id="textfield7" value="<?php echo $row_inb['cel']; ?>" size="40" readonly="readonly" /></td>
          </tr>
        </table>
      </form>
    </DIV>
    </div>
    <div class="TabbedPanelsContent">
      <table width="100%" border="1" align="center" cellspacing="0">
        <tr bgcolor="#4D68A2" style="color: #FFF">
          <th width="138">Fecha</th>
          <th width="141" bgcolor="#4D68A2">Descripción</th>
          <th width="141" bgcolor="#4D68A2">N° Factura P.</th>
          <th width="157" bgcolor="#4D68A2">Fecha De Pago</th>
          <th width="167">Condicion De Pago</th>
          <th width="113">Valor</th>
        </tr>
        <?php do { ?>
        <tr align="center" bgcolor="#F0F0F0">
          <td><?php echo $row_fac['fecha']; ?></td>
          <td><?php echo $row_fac['descrip']; ?></td>
          <td><?php echo $row_fac['factura']; ?></td>
          <td><?php echo $row_fac['f_alarma']; ?></td>
          <td><?php echo $row_fac['estado']; ?></td>
          <td><?php echo abs($row_fac['v_tal']); ?></td>
        </tr>
        <?php } while ($row_fac = mysql_fetch_assoc($fac)); ?>
      </table>
    </div>
<div class="TabbedPanelsContent">
      <form method="post" name="form1" action="<?php echo $editFormAction; ?>">
        <table width="600" border="1" align="center" cellspacing="0">
          <tr valign="baseline" bgcolor="#4D68A2">
            <th width="214" align="center" nowrap bgcolor="#4D68A2"><p>Editar</p></th>
            <td width="374" align="center"><?php echo $row_ss['id']; ?></td>
          </tr>
          <tr valign="baseline" bgcolor="#FFFFFF">
            <th align="left" nowrap><span style="color: #000">Cedula</span></th>
            <td align="center"><input name="cedula" type="text" value="<?php echo htmlentities($row_ss['cedula'], ENT_COMPAT, ''); ?>" size="60" readonly="readonly" /></td>
          </tr>
          <tr valign="baseline" bgcolor="#FFFFFF">
            <th align="left" nowrap><span style="color: #000">Nombre</span></th>
            <td align="center"><input type="text" name="nombre" value="<?php echo htmlentities($row_ss['nombre'], ENT_COMPAT, ''); ?>" size="60" /></td>
          </tr>
          <tr valign="baseline" bgcolor="#FFFFFF">
            <th align="left" nowrap><span style="color: #000">Telefono</span></th>
            <td align="center"><input type="text" name="telefono" value="<?php echo htmlentities($row_ss['telefono'], ENT_COMPAT, ''); ?>" size="60" /></td>
          </tr>
          <tr valign="baseline" bgcolor="#FFFFFF">
            <th align="left" nowrap style="color: #000">Categor&iacutea</th>
            <td align="center"><span id="spryselect1">
              <label for="categ"></label>
              <select name="categ" id="categ" style="width:390">
                <?php
do {  
?>
                <option value="<?php echo $row_ctg['categ']?>"<?php if (!(strcmp($row_ctg['categ'], $row_ss['categ']))) {echo "selected=\"selected\"";} ?>><?php echo $row_ctg['categ']?></option>
                <?php
} while ($row_ctg = mysql_fetch_assoc($ctg));
  $rows = mysql_num_rows($ctg);
  if($rows > 0) {
      mysql_data_seek($ctg, 0);
	  $row_ctg = mysql_fetch_assoc($ctg);
  }
?>
              </select>
              <span class="selectRequiredMsg">Seleccione un elemento.</span></span></td>
          </tr>
          <tr valign="baseline" bgcolor="#FFFFFF">
            <th align="left" nowrap style="color: #000">Direcci&oacuten</th>
            <td align="center"><input type="text" name="dir" value="<?php echo htmlentities($row_ss['dir'], ENT_COMPAT, ''); ?>" size="60" /></td>
          </tr>
          <tr valign="baseline" bgcolor="#FFFFFF">
            <th align="left" nowrap style="color: #000">Ciudad</th>
            <td align="center"><input type="text" name="ciud" value="<?php echo htmlentities($row_ss['ciud'], ENT_COMPAT, ''); ?>" size="60" /></td>
          </tr>
          <tr valign="baseline" bgcolor="#FFFFFF">
            <th align="left" nowrap style="color: #FFF"><span style="color: #000">Fax</span></th>
            <td align="center"><input type="text" name="fax" value="<?php echo htmlentities($row_ss['fax'], ENT_COMPAT, ''); ?>" size="60" /></td>
          </tr>
          <tr valign="baseline" bgcolor="#FFFFFF">
            <th align="left" nowrap style="color: #000">Web </th>
            <td align="center"><input type="text" name="apellido" value="<?php echo htmlentities($row_ss['apellido'], ENT_COMPAT, ''); ?>" size="60" /></td>
          </tr>
          <tr valign="baseline" bgcolor="#FFFFFF">
            <th align="left" nowrap style="color: #000">Contacto </th>
            <td align="center"><input type="text" name="empresa" value="<?php echo htmlentities($row_ss['empresa'], ENT_COMPAT, ''); ?>" size="60" /></td>
          </tr>
          <tr valign="baseline" bgcolor="#FFFFFF">
            <th align="left" nowrap style="color: #000">Celular</th>
            <td align="center"><input name="celular" type="text" id="celular" value="<?php echo $row_ss['cel']; ?>" size="60" /></td>
          </tr>
          <tr valign="baseline" bgcolor="#FFFFFF">
            <th align="left" nowrap style="color: #000">E mail</th>
            <td align="center"><input type="text" name="mail" value="<?php echo htmlentities($row_ss['mail'], ENT_COMPAT, ''); ?>" size="60" /></td>
          </tr>
          <tr valign="baseline" bgcolor="#FFFFFF">
            <th align="left" nowrap style="color: #000">Observaciones</th>
            <td align="center"><input name="comen" type="text" id="comen" value="<?php echo $row_ss['comen']; ?>" size="60" /></td>
          </tr>
          <tr valign="baseline">
            <th colspan="2" align="center" nowrap bgcolor="#4D68A2"><input type="image" src="modificar.png"  onmouseover="src='modificar1.png';"  onmouseout="src='modificar.png';" value="Insertar Clientes" alt="aceptar" /></th>
          </tr>
        </table>
        <input type="hidden" name="MM_update" value="form1" />
        <input type="hidden" name="id" value="<?php echo $row_ss['id']; ?>" />
      </form>
    </div>
</div>
</div>
<script type="text/javascript">
var TabbedPanels1 = new Spry.Widget.TabbedPanels("TabbedPanels1");
</script>


</body>
</html>

<script type="text/javascript">
var sprytextfield1 = new Spry.Widget.ValidationTextField("sprytextfield1", "none", {validateOn:["blur"]});
var sprytextfield2 = new Spry.Widget.ValidationTextField("sprytextfield2", "email", {validateOn:["blur"]});
var spryselect1 = new Spry.Widget.ValidationSelect("spryselect1", {validateOn:["blur"]});
</script>

<p>&nbsp;</p>
<script type="text/javascript">
var spryselect1 = new Spry.Widget.ValidationSelect("spryselect1");
</script>
<?

mysql_free_result($fac);
mysql_free_result($ss);

mysql_free_result($ctg);
?>
<?php
mysql_free_result($inb);
?>
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