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

$editFormAction = $_SERVER['PHP_SELF'];
if (isset($_SERVER['QUERY_STRING'])) {
  $editFormAction .= "?" . htmlentities($_SERVER['QUERY_STRING']);
}

if ((isset($_POST["MM_insert"])) && ($_POST["MM_insert"] == "form1")) {
$diab=trim(strip_tags($_POST['dia']));
$mesb=trim(strip_tags($_POST['mes']));
$anob=trim(strip_tags($_POST['anos']));
$fecha=$anob.'-'.$mesb.'-'.$diab;
	
  $insertSQL = sprintf("INSERT INTO d89xz_empleados (cedula, nombre, apellido, funcion, sueldo, hacienda, fecha) VALUES (%s, %s, %s, %s, %s, %s, %s)",
                       GetSQLValueString($_POST['cedula'], "text"),
                       GetSQLValueString($_POST['nombre'], "text"),
                       GetSQLValueString($_POST['apellido'], "text"),
                       GetSQLValueString($_POST['funcion'], "text"),
					   GetSQLValueString($_POST['sueldo'], "text"),
                       GetSQLValueString($_POST['hacienda'], "text"),
					    GetSQLValueString( $fecha, "text"));

  mysql_select_db($database_conexion, $conexion);
  $Result1 = mysql_query($insertSQL, $conexion) or die(mysql_error());
}



mysql_select_db($database_conexion, $conexion);
$query_em = "SELECT * FROM d89xz_empleados where esta !='no' ORDER BY cedula DESC";
$em = mysql_query($query_em, $conexion) or die(mysql_error());
$row_em = mysql_fetch_assoc($em);
$totalRows_em = mysql_num_rows($em);


?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Documento sin título</title>
<link href="../../css/clean.css" rel="stylesheet" type="text/css" />
<link rel="stylesheet" type="text/css" href="http://code.jquery.com/ui/1.11.0/themes/smoothness/jquery-ui.css" />
<link href="../../../css/style.css" rel="stylesheet" type="text/css" />
<link href="../../css/shadowbox.css" rel="stylesheet" type="text/css" />

<script src="http://code.jquery.com/jquery-2.1.1.js"></script>
<script src="http://code.jquery.com/ui/1.11.0/jquery-ui.js"></script>
<script src="../../js/shadowbox.js" type="text/javascript"></script>
<script src="../../js/jquery.validate.js" type="text/javascript"></script>
<script src="../../js/printThis.js" type="text/javascript"></script>
<script src="../js/kardex.js" type="text/javascript"></script>
</head>


<body>
<table width="98%" align="center">
  <tr>
    <td width="87%" align="right"><p class="s">&nbsp;</p></td>
    <td width="7%" align="center"><img src="../../img/addpersonas.png" alt="" width="48" height="48" style="cursor:pointer" title="Agregar Nuevo"  onclick="agregar()"  /></td>
    <td width="6%" align="center"><img  title="Imprimir" src="../../img/imprimir.png" alt="" 
    width="40" height="40" border="0"  style="cursor:pointer" onclick="imprimir_esto('registros')"/></td>
  </tr>
</table>
<p>
  <DIV ID="seleccion">
</p>
<table width="98%" align="center" >
  <tr  class="t">
    <th colspan="6"  class="tittle">Listado de  Empleados</th>
  </tr>
  <tr  class="tittle">
    <th width="89">Cedula</th>
    <th width="372">Nombre</th>
    <th width="193">Función</th>
    <th width="181">Salario</th>
    <th width="165">Sede</th>
    <th width="80">&nbsp;</th>
  </tr>
  <?php do { ?>
    <tr align="center" class="row">
      <td  onClick="mostrar('<?php echo $row_em['id'];  ?>');"><?php echo $row_em['cedula']; ?></a></td>
      <td  onClick="mostrar('<?php echo $row_em['id'];  ?>');"><?php echo $row_em['nombre'].' '.$row_em['apellido']; ?></td>
      <td  onClick="mostrar('<?php echo $row_em['id'];  ?>');"><?php echo $row_em['funcion']; ?></td>
      <td  onClick="mostrar('<?php echo $row_em['id'];  ?>');"><?php echo number_format( $row_em['sueldo']); ?></td>
      <td  onClick="mostrar('<?php echo $row_em['id'];  ?>');"><?php echo $row_em['hacienda']; ?></td>
      <td>
        <input name="imgb2" type="image" src="../../img/edit.png" width="20" height="20"  style="cursor:pointer"
         title="Editar" onClick="mostrar1('<?php echo $row_em['id'];  ?>');" />
        <input name="imgb" type="image" src="../../img/erase.png" width="20" height="20"  style="cursor:pointer"
          title="Eliminar" onClick="eliminar('<?php echo $row_em['id'];  ?>');" />
      </td>
    </tr>
    <?php } while ($row_em = mysql_fetch_assoc($em)); ?>
</table>
</body>
</html>
<?php


mysql_free_result($em);


?>
</DIV> 
<div id="dialog2"></div> 
