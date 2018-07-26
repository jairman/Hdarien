<?php require_once('../controllers/joom.php'); ?>
<?php require_once('../../Connections/conexion.php');
 


 $_GET['id'];
 
  ?>

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
<title>Ver Clientes</title>
<link href="../../css/clean.css" rel="stylesheet" type="text/css" />
<link rel="stylesheet" type="text/css" href="http://code.jquery.com/ui/1.11.0/themes/smoothness/jquery-ui.css" />
<link href="../../../css/style.css" rel="stylesheet" type="text/css" />
<link href="../../css/shadowbox.css" rel="stylesheet" type="text/css" />

<script src="http://code.jquery.com/jquery-2.1.1.js"></script>
<script src="http://code.jquery.com/ui/1.11.0/jquery-ui.js"></script>
<script src="../../js/shadowbox.js" type="text/javascript"></script>
<script src="../../js/jquery.validate.js" type="text/javascript"></script>
<script src="../../js/printThis.js" type="text/javascript"></script>
<script src="../js/Clientes.js" type="text/javascript"></script>
</head>

<body>
<table width="95%" align="center" id="table_header">
  <tr>
    <td width="93%" align="left">
    <div id="menu">
      <ul>
      <li>
      <a href="../views/verClientes.php?id=<?= $colname_clien ?>" class='active'>Información del Cliente</a>
      </li>
      <li>
      <a  href="../views/client_histo.php?id=<?= $colname_clien ?>" >Historial de Facturación</a>
      </li>
      <li>
      <a  href="../../caja/views/dia_dia_pendiente_cliente.php?id=<?= $colname_clien ?>" >Cuentas Por Cobrar</a>
      </li>
      </ul>
    </div>  
    </td>
    <td width="7%" align="left">&nbsp;</td>
  </tr>
</table>
<div id="main">
&nbsp;

<table width="95%" align="center">
  <tr>
    <td  align="left" ><img src="../../../img/Logo.png" alt="logo" name="logo" width="200" height="70" id="logo" /></td>
<td  align="center" ><input name="imgb" type="image" title="Imprimir" src="../../img/imprimir.png" alt="" 
    width="40" height="40" border="0" align="right" style="cursor:pointer" onclick="imprimir_esto('main')"/></td>
  </tr>
</table>

<form  id="form1" method="post" name="form1">

<input type="hidden" name="registro" id="categoria" >

  <table width="95%"  align="center" >
  <tr>
    <td colspan="4" align="center" class="tittle" style="">Información registro de Empleado</td>
  </tr>
  <tr>
    <td width="20%" class="bold">Cedula</td>
    <td width="30%" class="cont"><label for="textfield"></label>
      <input name="registro" type="text"  required="required" id="cedula" style="width:98%" value="<?= $row_clien['cedula']; ?>" readonly="readonly"/></td>
    <td width="20%" class="bold">Nombre</td>
    <td width="30%" class="cont"><input name="registro" type="text"  required="required" id="nombre" style="width:98%" value="<?= $row_clien['nombre']; ?>" readonly="readonly"/></td>
  </tr>
  <tr>
    <td class="bold">Apellido</td>
    <td class="cont"><input name="registro" type="text" id="telefono" style="width:98%" value="<?= $row_clien['apellido']; ?>" readonly="readonly" /></td>
    <td class="bold">Celular</td>
    <td class="cont"><input name="registro" type="text" id="cel" style="width:98%" value="<?= $row_clien['tel']; ?>" readonly="readonly" /></td>
  </tr>
  <tr>
    <td class="bold">Funcion</td>
    <td class="cont"><input name="registro" type="text" id="contacto" style="width:98%" value="<?= $row_clien['funcion']; ?>" readonly="readonly" /></td>
    <td class="bold">Salario</td>
    <td class="cont"><input name="registro" type="text" id="mail" style="width:98%" value="<?= $row_clien['sueldo']; ?>" readonly="readonly"/></td>
  </tr>
<tr>
<td class="bold">Sede</td>
<td class="cont"><input name="contacto" type="text" id="contacto3" style="width:98%" value="<?= $row_clien['hacienda']; ?>" readonly="readonly" /></td>
<td class="bold">&nbsp;</td>
<td class="cont">&nbsp;</td>
</tr>
  <tr>
    <td colspan="4" align="center" >&nbsp;</td>
  </tr>
</table>


<!-- Finaliza el primer Div de personas  --><!--<div id="segundo" style="display:none" >-->


<table width="95%" border="0" align="center" cellspacing="0">
  <tr>
    <td width="100%" align="center"><input name="button5" type="submit" class="ext" id="button5" value="Insertar Registro" style="width:150px; display:none"   onclick="confirmacion(); return false"/>
      <input type="button" name="button1" id="button1" value="Cerrar"  onclick="javascript:window.close();" class="ext" style="width:150px"/></td>
</tr>
</table>

<div id="dialog" >

</div>
 
</form>
</div>


</body>
</html>
<?php
mysql_free_result($clien);
?>
