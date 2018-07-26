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

$ptov_url=$_GET['p'];
$marca_url=$_GET['m'];
$order_url=$_GET['o'];

$i = 0;

//Metodo para coger el inventario inicial desde el detalle de inventario  y crear el inventario inicial
/*
mysql_select_db($database_conexion, $conexion);
$query_inv = "SELECT `ref`, `punto_venta`, `cant`, `user` FROM `h01sg_inventario_detalle` WHERE `delete`<>1 AND `mov`='c'";
$inv = mysql_query($query_inv, $conexion) or die(mysql_error());
echo $x = mysql_num_rows($inv); 
while ($row_inv = mysql_fetch_assoc($inv)){
	echo $ref = $row_inv['ref'];
	$ptov = $row_inv['punto_venta'];
	echo $cant = $row_inv['cant'];
	$user = $row_inv['user'];
	
	$query_inv2 = mysql_query("SELECT * FROM `h01sg_inventario` WHERE `ref`='$ref' 
	AND `punto_venta`='$ptov' AND `delete`<>1", $conexion) or die(mysql_error());

	echo $n = mysql_num_rows($query_inv2);
	if ($n < 1){
		$query_insert = mysql_query("INSERT INTO `h01sg_inventario`( `ref`, `punto_venta`, `cant_ini`, `cant_final`, `user`) 
		VALUES ('$ref','$ptov','$cant','$cant','$user')", $conexion) or die(mysql_error());
	}	
}
*/
?>
<!doctype html>
<html>
<head>
<meta charset="UTF-8">
<title>Reporte Inventario</title>
<link href="../../css/clean.css" rel="stylesheet" type="text/css" />
<link rel="stylesheet" type="text/css" href="http://code.jquery.com/ui/1.11.0/themes/smoothness/jquery-ui.css" />
<link href="../../css/style.css" rel="stylesheet" type="text/css" />
<link href="../../css/shadowbox.css" rel="stylesheet" type="text/css" />

<script src="http://code.jquery.com/jquery-2.1.1.js"></script>
<script src="http://code.jquery.com/ui/1.11.0/jquery-ui.js"></script>
<script src="../../js/shadowbox.js" type="text/javascript"></script>
<script src="../../js/jquery.validate.js" type="text/javascript"></script>
<script src="../../js/printThis.js" type="text/javascript"></script>
<script src="../js/invent_ini2.js" type="text/javascript"></script>

</head>

<body>

<input type="hidden" id="tf_user" value="<?php echo $usuario2 ?>">
<input type="hidden" id="tf_user2" value="<?php echo $usuario ?>">

<table width="90%" align="center" id="table_header">
  <tr>
    <td width="76%" align="left">
    <div id="menu">
      <ul>
      <li>
      <a href="invent_ini.php" >Reporte de Inventario</a>
      </li>
      <li>
      <a  href="invent_ini2.php" class='active'>Reporte de Productos Vendidos</a>
      </li>
      <li>
      <a  href="../../cierre/views/cierre_histo.php" >Cierre de Inventario</a>
      </li>
      </ul>
    </div>  
    </td>
    <td width="8%">&nbsp;
        
    </td>
    <td width="8%" align="right">
    <input type="image" src="../../img/cierre.png" alt="" width="48" height="48" border="0" align="right" 
    title="Cierre de Inventario" id="bt_cierrei" style="cursor:pointer" >
    </td>
    <td width="8%" align="right">
    <input type="image" title="Imprimir" src="../../img/imprimir.png" alt="" 
    width="48" height="48" border="0" align="right" style="cursor:pointer" onclick="imprimir_esto('recargar2')" >
    </td>
    </tr>
</table>
<div id="main">

&nbsp;
<div id="recargar2">
<table width="90%" border="1" cellspacing="0" align="center">
    <tr class="tittle">
    <td>Reporte de Productos Vendidos</td>
    </tr>
</table>
<table width="90%" border="1" cellspacing="0" align="center">    
    <tr>
    <td width="20%" align="center" class="bold">Punto de Venta</td>
    <td width="30%" class="cont bold"><?php
        if ($usuario2 == 'general'){
        ?>
        <select name="sl_ptov" id="sl_ptov" class="long">
        <option value="Todo">Todos</option>
        <?php
        mysql_select_db($database_conexion, $conexion);
        $query_hac = "SELECT DISTINCT `hacienda` as hacienda , `hacienda` as hacienda1 FROM 
        `d89xz_hacienda` WHERE `delete`=0 order by hacienda";
        $hac = mysql_query($query_hac, $conexion) or die(mysql_error());
        while ($row_hac = mysql_fetch_assoc($hac)){
        ?>
        <option value="<?php echo $row_hac['hacienda']?>"><?php echo $row_hac['hacienda1']?></option>
        <?php
        } 
        ?>
        </select>
        <?php 
        }else{
        ?>
        <input type="text" readonly id="tf_ptov" class="long" value="<?php echo $usuario2 ?>">
        <?php
        }
        ?></td>
    <td align="center" class="bold" width="20%">Marca</td>
    <td class="bold cont" width="30%">
      <select name="sl_marca" id="sl_marca" class="long" onChange="load2()">
      <option value="">Seleccione</option>
		<?php
        mysql_select_db($database_conexion, $conexion);
        $query_clr = "SELECT DISTINCT `marca` FROM `h01sg_producto` WHERE `delete`<>1 ORDER BY `marca` ASC ";
        $clr = mysql_query($query_clr, $conexion) or die(mysql_error());
        //$row_clr = mysql_fetch_assoc($clr);
        while ($row_clr = mysql_fetch_assoc($clr)){
        ?>
      <option value="<?php echo ucwords(strtolower($row_clr['marca']))?>">
	  <?php echo ucwords(strtolower($row_clr['marca']))?>
      </option>
		<?php
        } 
        ?>
      </select>
    </td>
    </tr>
</table>

<div id="d_table">
<table width="90%" border="1" cellspacing="0" align="center" id="tb_detail">
  <tr class="stittle" id="tittle">
    <td width="13%" onClick="orden_bus('h01sg_inventario.ref')" style="cursor:pointer" title="Ordenar por Referencia">Referencia</td>
    <td width="13%" onClick="orden_bus('h01sg_inventario.punto_venta')" style="cursor:pointer" title="Ordenar por Punto de Venta">Ubicación</td>
    <td width="20%" onClick="orden_bus('h01sg_producto.desc')" style="cursor:pointer" title="Ordenar por Descripción">Descripción</td>
    <td width="14%" onClick="orden_bus('h01sg_producto.marca')" style="cursor:pointer" title="Ordenar por Marca">Marca</td>
    <td width="8%" onClick="orden_bus('h01sg_inventario.cant_ini')" style="cursor:pointer" title="Ordenar por Cantidad Inicial">Inicial</td>
    <td width="8%" onClick="orden_bus('h01sg_inventario.cant_trasl')" style="cursor:pointer" title="Ordenar por Cantidad Trasladada">Traslados</td>
    <td width="8%" onClick="orden_bus('h01sg_inventario.cant_vend')" style="cursor:pointer" title="Ordenar por Cantidad Vendida">Vendida</td>
    <td width="8%" onClick="orden_bus('h01sg_inventario.cant_devo')" style="cursor:pointer" title="Ordenar por Devoluciones ">Devolución</td>
    <td width="8%" onClick="orden_bus('h01sg_inventario.cant_final')" style="cursor:pointer" title="Ordenar por Cantidad Disponible">Disponible</td>
  </tr>
  <?php
  	//echo $order_url;
	mysql_select_db($database_conexion, $conexion);
	if ($ptov_url == 'Todo'){
		if ($marca_url == ''){
			$query_inv = mysql_query("SELECT * FROM `h01sg_inventario` LEFT JOIN  `h01sg_producto`
			ON h01sg_inventario.ref=h01sg_producto.ref
			WHERE h01sg_inventario.delete='0' AND h01sg_producto.delete<>1 $order_url", $conexion)  or die(mysql_error());
		}else{
			
			$query_inv = mysql_query("SELECT * FROM `h01sg_inventario` LEFT JOIN  `h01sg_producto`
			ON h01sg_inventario.ref=h01sg_producto.ref
			WHERE h01sg_inventario.delete='0' AND h01sg_producto.delete<>1
			AND h01sg_producto.marca='$marca_url' '$order_url", $conexion) or die(mysql_error());
		}
			
	}else{
		if ($marca_url == ''){
			$query_inv = mysql_query("SELECT * FROM `h01sg_inventario` LEFT JOIN  `h01sg_producto`
			ON h01sg_inventario.ref=h01sg_producto.ref WHERE h01sg_inventario.delete='0' 
			AND h01sg_producto.delete<>1 AND h01sg_inventario.punto_venta='$ptov_url '$order_url", $conexion) or die(mysql_error());
		}else{
			$query_inv = mysql_query("SELECT * FROM `h01sg_inventario` LEFT JOIN  `h01sg_producto`
			ON h01sg_inventario.ref=h01sg_producto.ref
			WHERE h01sg_inventario.delete='0' AND h01sg_producto.delete<>1
			AND h01sg_producto.marca='$marca_url' AND h01sg_inventario.punto_venta='$ptov_url' 
			'$order_url", $conexion) or die(mysql_error());
		}
	}
	while($row_inv = mysql_fetch_assoc($query_inv)){
		$inv = $row_inv['cant_vend'];
		if ($inv != 0){
  ?>
  <tr class="row" id="fila_<?php echo $i?>"
  	onclick="mostrar('../views/invent_ficha.php?r=<?php echo $row_inv['ref']?>')">
    <td align="center"><?php echo $row_inv['ref']?></td>
    <td align="center"><?php echo $row_inv['punto_venta']?></td>
    <td align="center">
	<?php
	$ref=$row_inv['ref'];
	$query_det = mysql_query("SELECT * FROM `h01sg_producto` WHERE `ref`='$ref' AND `delete`<>1 ", $conexion) or die(mysql_error());
	$row_det = mysql_fetch_assoc($query_det);
	$talla = $row_det['talla'];
	$color = $row_det['color'];
	$string = $row_det['desc'];
	if ($talla){
		if ($color){
			echo $string.' - '.$talla.' - '.$color;	
		}else{
			echo $string.' - '.$talla;
		}
	}else{
		if ($color){
			echo $string.' - '.$color;	
		}else{
			echo $string;
		}	
	}
	?>
    </td>
    <td align="center"><?php echo $row_det['marca']?></td>
    <td align="center"><label id="ini<?php echo $i?>" class="ini"><?php echo $row_inv['cant_ini']?></label></td>
    <td align="center"><label id="tras<?php echo $i?>"><?php echo abs($row_inv['cant_trasl'])?></label></td>
    <td align="center"><label id="vent<?php echo $i?>"><?php echo $inv?></label></td>
    <td align="center">
    <?php 
	$devo = $row_inv['cant_devo'];
	if ($devo > 0){
	?>
    <label id="devo<?php echo $i?>" class="green"><?php echo $devo?></label>
    <?php 
	}
	if ($devo == 0){
	?>
    <label id="devo<?php echo $i?>"><?php echo $devo?></label>
    <?php 
	}
	if ($devo < 0){
	?>
    <label id="devo<?php echo $i?>" class="red"><?php echo abs($devo)?></label>
    <?php 
	}
	?>
    </td>
    <td align="center"><label class="red" id="tot<?php echo $i?>"><?php echo $row_inv['cant_final']?></label></td>
    
  </tr>
  <?php
		}
  $i++;
	}
  ?>
  <tr>
  <td colspan="9">&nbsp;</td>
  </tr>
  <tr class="row" >
    <td colspan="4" align="right"><label class="red">Total </label></td>
    <td align="center"><label id="lb_tinv" class="red"></label></td>
    <td align="center"><label id="lb_ttras" class="red"></label></td>
    <td align="center"><label id="lb_tvent" class="red"></label></td>
    <td align="center"><label id="lb_tdevo" class="red"></label></td>
    <td align="center"><label id="lb_total" class="red"></label></td>
    
  </tr>
</table>
</div>
</div> 
</div>

</body>
</html>
<?php
}
?>