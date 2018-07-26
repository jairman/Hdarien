<?php require_once('../controllers/joom.php'); ?>
<?php require_once('../../Connections/conexion.php'); ?>
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

$colname_clien = "-1";
if (isset($_GET['id'])) {
  $colname_clien = $_GET['id'];
}
mysql_select_db($database_conexion, $conexion);
$query_clien = sprintf("SELECT * FROM d89xz_empleados WHERE id = %s", GetSQLValueString($colname_clien, "int"));
$clien = mysql_query($query_clien, $conexion) or die(mysql_error());
$row_clien = mysql_fetch_assoc($clien);
$totalRows_clien = mysql_num_rows($clien);
?>




<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Registrar Clientes</title>
<link href="../../css/clean.css" rel="stylesheet" type="text/css" />
<link rel="stylesheet" type="text/css" href="http://code.jquery.com/ui/1.11.0/themes/smoothness/jquery-ui.css" />
<link href="../../../css/style.css" rel="stylesheet" type="text/css" />
<link href="../../css/shadowbox.css" rel="stylesheet" type="text/css" />

<script src="http://code.jquery.com/jquery-2.1.1.js"></script>
<script src="http://code.jquery.com/ui/1.11.0/jquery-ui.js"></script>
<script src="../../js/shadowbox.js" type="text/javascript"></script>
<script src="../../js/jquery.validate.js" type="text/javascript"></script>
<script src="../../js/printThis.js" type="text/javascript"></script>
<script src="../js/EditClientes.js" type="text/javascript"></script>
</head>

<body>
<form  id="form1" method="post" name="form1">
  <div  id="primero">

   <p>
<input type="hidden" name="registro" id="funcion" >

  </p>
<p>&nbsp;</p>
<p>&nbsp;</p>
<table width="98%" border="1">
<tr>
<td><img src="../../../img/Logo.png" alt="" width="200" height="70" /></td>
</tr>
</table>
<p>&nbsp;</p>
<table width="90%" border="1" align="center" cellspacing="0">
  <tr>
    <td colspan="4" align="center" class="tittle" style="">Editar  Empleado</td>
</tr>
  <tr>
    <td width="20%" class="bold">Cedula </td>
  <td width="30%" class="cont"><label for="textfield"></label>
    <input name="registro" type="text"  required="required" id="cedula" style="width:98%" value="<?= $row_clien['cedula']; ?>" readonly="readonly"/></td>
  <td width="20%" class="bold">Nombre</td>
    <td width="30%" class="cont"><input name="registro" type="text"  required="required" id="nombre" style="width:98%" value="<?= $row_clien['nombre']; ?>"/></td>
  </tr>
  <tr>
    <td class="bold">Apellido</td>
    <td class="cont"><input name="registro" type="text" id="apellido" style="width:98%" value="<?= $row_clien['apellido']; ?>" /></td>
    <td class="bold">Celular</td>
    <td class="cont"><input name="registro" type="text" id="tel" style="width:98%" value="<?= $row_clien['tel']; ?>" /></td>
  </tr>
  <tr>
    <td class="bold">Categoria</td>
    <td class="cont"><input name="tf_lab" type="text" id="tf_lab" style="width:45%" onkeyup="desa()" value="<?= $row_clien['funcion']; ?>" />
      <select name="sl_lab" id="sl_lab" style="width:45%" onchange="desb()">
        <option value="">Seleccione Categoria.</option>
        <?php
        mysql_select_db($database_conexion, $conexion);
        $query_lab = "SELECT DISTINCT funcion FROM d89xz_empleados where funcion !=''  ORDER BY `funcion` ASC ";
        $lab = mysql_query($query_lab, $conexion) or die(mysql_error());
        while ($row_lab = mysql_fetch_assoc($lab)){
        ?>
        <option value="<?= ucwords(strtolower($row_lab['funcion']))?>"> <?= ucwords(strtolower($row_lab['funcion']))?></option>
        <?php
        } 
        ?>
      </select></td>
    <td class="bold">Salario</td>
    <td class="cont"><input name="registro" type="text" id="sueldo" style="width:98%" value="<?= $row_clien['sueldo']; ?>"/></td>
  </tr>
<tr>
<td class="bold">Sede</td>
<td class="cont"><select name="registro" id="hacienda" style="width:98%">
  <option value="" <?php if (!(strcmp("", $row_clien['hacienda']))) {echo "selected=\"selected\"";} ?>>Seleccione</option>
  <option value="Restaurante" <?php if (!(strcmp("Restaurante", $row_clien['hacienda']))) {echo "selected=\"selected\"";} ?>>Restaurante</option>
  <option value="Hotel" <?php if (!(strcmp("Hotel", $row_clien['hacienda']))) {echo "selected=\"selected\"";} ?>>Hotel</option>
  
</select></td>
<td class="bold">&nbsp;</td>
<td class="cont">&nbsp;</td>
</tr>
  <tr>
    <td colspan="4" align="center" >&nbsp;</td>
  </tr>
</table>

</div> 
<!-- Finaliza el primer Div de personas  -->

<!--<div  id="segundo">--><!--<div id="tercero" >-->
<table width="98%" border="1">
  <tr>
    <td align="center"><input name="button5" type="submit" class="ext" id="button5" value="Aceptar" style="width:150px; "   onclick="confirmacion(); return false"/>&nbsp;
    
  <input type="submit" name="button1" id="button1" value="Cancelar"  onclick="window.close();" class="ext" style="width:150px"/></td>
</tr>
</table>


<div id="dialog" >

</div>
</div>
<input type="hidden" name="registro" id="id" value="<?= $row_clien['id']?>" > 
</form>
<!-- Finaliza el primer Div de personas  segundo -->





</body>
</html>
<?php
mysql_free_result($clien);
?>
