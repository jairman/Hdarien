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
$x_url= $_GET['x'];
$i_url= $_GET['i']; 
$p_url= $_GET['p']; 
$id_url= $_GET['id'];
$order_url=$_GET['o']; 

?>
<!doctype html>
<html>
<head>
<meta charset="UTF-8">
<title>Busqueda de Productos</title>
<link href="../../css/clean.css" rel="stylesheet" type="text/css" />
<link rel="stylesheet" type="text/css" href="http://code.jquery.com/ui/1.11.0/themes/smoothness/jquery-ui.css" />
<link href="../../css/style.css" rel="stylesheet" type="text/css" />
<link href="../../css/shadowbox.css" rel="stylesheet" type="text/css" />

<script src="http://code.jquery.com/jquery-2.1.1.js"></script>
<script src="http://code.jquery.com/ui/1.11.0/jquery-ui.js"></script>
<script src="../../js/shadowbox.js" type="text/javascript"></script>
<script src="../../js/jquery.validate.js" type="text/javascript"></script>
<script src="../js/compras_isearch.js" type="text/javascript"></script>

</head>
<body>
<input type="hidden" id="tf_i" value="<?php echo $i_url?>">
<input type="hidden" id="tf_p" value="<?php echo $p_url?>">
<input type="hidden" id="tf_x" value="<?php echo $x_url?>">
<input type="hidden" id="tf_ref" >
<div id="dialog"></div>

<table width="90%" align="center" id="table_header">
    <tr>
    	<td colspan="4" class="tittle">
       <label style="font-size:18px">Busqueda</label> 
       </td>
    </tr>
</table>

<table width="90%" align="center" >
  <tr>
    <td align="right" width="20%">&nbsp;</td>
    <td width="30%" align="center">&nbsp;</td>
    <td align="right" class="bold" width="20%">Referencia</td>
    <td width="30%" align="center" class="cont">
      <input type="text" name="tf_idr" id="tf_idr" class="long" onKeyUp="load1()">
    </td>
  </tr>
</table>
<div id="d_table">
<table width="90%" border="1" align="center">
  <tr class="stittle">
    <td width="10%" onClick="orden_bus('ref')" style="cursor:pointer" title="Ordenar por Referencia">Referencia</td>
    <td width="16%" onClick="orden_bus('desc')" style="cursor:pointer" title="Ordenar por Descripción">Descripcion</td>
    <td width="10%" onClick="orden_bus('unidad')" style="cursor:pointer" title="Ordenar por Unidad de Medida">Unidad</td>
    <td width="10%" onClick="orden_bus('present')" style="cursor:pointer" title="Ordenar por Presentación">Presentación</td>
    <td width="10%" onClick="orden_bus('contenido')" style="cursor:pointer" title="Ordenar por Contenido">Contenido</td>
    <td width="10%" onClick="orden_bus('codigo')" style="cursor:pointer" title="Ordenar por Código">Código</td>
    <td width="12%" onClick="orden_bus('marca')" style="cursor:pointer" title="Ordenar por Marca">Marca</td>
    <td width="12%" onClick="orden_bus('categoria')" style="cursor:pointer" title="Ordenar por Categoria">Categoria</td>
    <td width="10%" onClick="orden_bus('costo_und')" style="cursor:pointer" title="Ordenar por Costo">Costo</td>
  </tr>
  <?php
  $i = 0;
  //echo $order_url;
  mysql_select_db($database_conexion, $conexion);
  	if ($id_url == ''){
		$query_search = "SELECT * FROM `h01sg_insumos` WHERE `delete`<>1 $order_url";  
  	}else{
		$query_search = "SELECT * FROM `h01sg_insumos` WHERE `delete`<>1 AND `ref` LIKE '%".mysql_real_escape_string($id_url)."%'
		$order_url";
	}
  
  $search = mysql_query($query_search, $conexion) or die(mysql_error());
  while($row_search = mysql_fetch_assoc($search)){
  	$ref = $row_search['ref'];
  ?>
  <tr class="row" id="fila_<?php echo $i?>">
    <td align="center"
    onclick="insertprod('<?php echo $ref ?>', <?php echo $i?>)">
	<?php echo $ref?></td>
    <td align="center"
    onclick="insertprod('<?php echo $ref ?>', <?php echo $i?>)">
	<?php echo $row_search['desc']?></td>
    <td align="center"
    onclick="insertprod('<?php echo $ref ?>', <?php echo $i?>)">
	<?php echo $row_search['unidad']?></td>
    <td align="center"
    onclick="insertprod('<?php echo $ref ?>', <?php echo $i?>)">
	<?php echo $row_search['present']?></td>
    <td align="center"
    onclick="insertprod('<?php echo $ref ?>', <?php echo $i?>)">
	<?php echo $row_search['contenido']?></td>
    <td align="center"
    onclick="insertprod('<?php echo $ref ?>', <?php echo $i?>)">
	<?php echo $row_search['codigo']?></td>
    <td align="center"
    onclick="insertprod('<?php echo $ref ?>', <?php echo $i?>)">
	<?php echo $row_search['marca']?></td>
    <td align="center"
    onclick="insertprod('<?php echo $ref ?>', <?php echo $i?>)">
	<?php echo $row_search['categoria']?></td>
    <td align="center"
    onclick="insertprod('<?php echo $ref ?>', <?php echo $i?>)">
	<?php echo $row_search['costo_und']?></td>
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
    value="Cerrar" onclick="window.parent.Shadowbox.close()">
    </td>
    </tr>
</table>
</div>
</body>
</html>
<?php
}
?>