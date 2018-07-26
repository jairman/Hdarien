<?php require_once('../controllers/joom.php'); ?>
<?php require_once('../../Connections/conexion.php') ?>

<?php

if ($acceso !='0'){
?>
<table width="70%" border="0" align="center">
  <tr>
    <td><img src="../../img/Logo.png" width="886" height="248" /></td>
  </tr>
  <tr>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <th>No puede acceder A este MENU sin estar HABILITADO... Consulte al Administrador....!!!</th>
  </tr>
</table>
<?php
}else{
	
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

$id_url= $_GET['id'];
$order_url=$_GET['o']; 

?>
<!doctype html>
<html>
<head>
<meta charset="UTF-8">
<title>Busqueda de Clientes</title>
<link href="../../css/clean.css" rel="stylesheet" type="text/css" />
<link rel="stylesheet" type="text/css" href="http://code.jquery.com/ui/1.11.0/themes/smoothness/jquery-ui.css" />
<link href="../../css/style.css" rel="stylesheet" type="text/css" />
<link href="../../css/shadowbox.css" rel="stylesheet" type="text/css" />

<script src="http://code.jquery.com/jquery-2.1.1.js"></script>
<script src="http://code.jquery.com/ui/1.11.0/jquery-ui.js"></script>
<script src="../../js/shadowbox.js" type="text/javascript"></script>
<script src="../../js/jquery.validate.js" type="text/javascript"></script>
<script src="../../js/printThis.js" type="text/javascript"></script>
<script src="../js/dev_csearch.js" type="text/javascript"></script>
</head>
<body>
<input type="hidden" id="tf_cliente" >
<div id="dialog"></div>

<table width="90%" align="center" id="table_header">
    <tr>
    	<td colspan="4" class="tittle">
       <label style="font-size:18px">Listado de Clientes</label> 
       </td>
    </tr>
</table>

<table width="90%" align="center" >
  <tr>
    <td align="right" width="20%">&nbsp;</td>
    <td width="30%" align="center">&nbsp;</td>
    <td align="right" class="bold" width="20%">NIT</td>
    <td width="30%" align="center" class="cont">
      <input type="text" name="tf_idr" id="tf_idr" class="long" onKeyUp="load1()">
    </td>
  </tr>
</table>
<div id="d_table">
<table width="90%" border="1" align="center">
  <tr class="tittle">
    <td width="30%" onClick="orden_bus('cedula')" style="cursor:pointer" title="Ordenar por NIT">NIT</td>
    <td width="40%" onClick="orden_bus('nombre')" style="cursor:pointer" title="Ordenar por Nombre">Nombre</td>
    <td width="30%" onClick="orden_bus('telefono')" style="cursor:pointer" title="Ordenar por Telefono">Telefono</td>
  </tr>
  <?php
  $i = 0;
  mysql_select_db($database_conexion, $conexion);
  	if ($id_url == ''){
		$query_search = "SELECT * FROM `d89xz_clientes` WHERE `delete`<>1 $order_url";  
  	}else{
		$query_search = "SELECT * FROM `d89xz_clientes` WHERE `delete`<>1 AND `cedula` LIKE '%".mysql_real_escape_string($id_url)."%'
		$order_url";
	}
  
  $search = mysql_query($query_search, $conexion) or die(mysql_error());
  while($row_search = mysql_fetch_assoc($search)){
  ?>
  <tr class="row" id="fila_<?php echo $i?>">
    <td align="center"
    onclick="idCheck('<?php echo $row_search['cedula'] ?>','<?php echo $row_search['nombre'] ?>')">
	<?php echo $row_search['cedula']?></td>
    <td align="center"
    onclick="idCheck('<?php echo $row_search['cedula'] ?>','<?php echo $row_search['nombre'] ?>')">
	<?php echo $row_search['nombre']?></td>
    <td align="center"
    onclick="idCheck('<?php echo $row_search['cedula'] ?>','<?php echo $row_search['nombre'] ?>')">
	<?php echo $row_search['telefono']?></td>
  </tr>
  <?php
  $i++;
  }
  ?>
</table>
<table align="center" width="90%" border="1">
	<tr>
    <td align="center">
    <input name="bt_close" type="button" class="ext" id="bt_close"
    value="Cancelar" onclick="window.parent.Shadowbox.close()">
    </td>
    </tr>
</table>
</div>
</body>

</html>
<?php
}
?>