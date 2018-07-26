<?php require_once('joom.php'); ?>
<?php require_once('../Connections/conexion.php'); ?>

<?php

if ($acceso !='0'){
?>
<table width="70%" border="0" align="center">
  <tr>
    <td><img src="../img/Logo.png" width="886" height="248" /></td>
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

//header("Content-Type: text/html;charset=UTF-8");
date_default_timezone_set('America/Bogota');

$consec_url=trim($_GET['c']);

$c_date = date('Y-m-d');

mysql_select_db($database_conexion, $conexion);
$fact = mysql_query("SELECT * FROM `h01sg_compra` WHERE `consec`='$consec_url' AND `delete`<>1 ", $conexion) or die(mysql_error());
$row_fact = mysql_fetch_assoc($fact);			

$i = 0;

?>
<!doctype html>
<html>
<head>
<meta charset="UTF-8">
<title>Registrar Producto</title>
<link href="../css/clean.css" rel="stylesheet" type="text/css" />
<link rel="stylesheet" type="text/css" href="http://code.jquery.com/ui/1.10.3/themes/smoothness/jquery-ui.css" />
<link href="../css/style.css" rel="stylesheet" type="text/css" />
<link href="../css/shadowbox.css" rel="stylesheet" type="text/css" />

<script src="http://code.jquery.com/jquery-1.9.1.js"></script>
<script src="http://code.jquery.com/ui/1.10.1/jquery-ui.js"></script>
<script src="../js/shadowbox.js" type="text/javascript"></script>
<script src="../js/jquery.validate.js" type="text/javascript"></script>
<script src="../js/printThis.js" type="text/javascript"></script>

<style>
.picture{
	width:80px;
	height:80px;
}
.img{
	padding-top:2px;
}
</style>
</head>

<body>

<input type="hidden" id="tf_user" value="<?php echo $usuario2 ?>">
<input type="hidden" id="tf_user2" value="<?php echo $usuario ?>">

<div id="dialog"></div>

<form id="form1" name="form1">

	<table width="98%" align="center" id="table_header">
  <tr>
    <td width="93%" align="left">&nbsp;
     
    </td>
    <td width="7%" align="left"><img  title="Imprimir" src="../img/imprimir.png" alt="" 
    width="40" height="40" border="0" align="right" style="cursor:pointer" onclick="imprimir_esto('recargar2')"/></td>
  </tr>
</table>
<div id="recargar2">

	<table width="98%" align="center" id="table_header">
    <tr>
      <td align="left" >
      <img src="../img/Logo.png" alt="logo" name="logo" width="200" height="70" id="logo" />
      </td>
    </tr>
   </table>
<table width="98%" border="1" cellspacing="0" align="center">
    <tr>
      <td class="bold" width="20%">No</td>
      <td width="30%" align="center" class="cont"><label><? echo $row_fact['consec']?></label></td>
      <td class="bold" width="20%">Fecha</td>
      <td width="30%" align="center" class="cont"><label><? echo $row_fact['f_fact']?></label></td>
    </tr>
    <tr>
      <td class="bold" >Provedor</td>
      <td align="center" class="cont">
      <label><?php echo $row_fact['cliente']?></label></td>
      <td class="bold" >Cedula o Nit</td>
      <td align="center" class="cont"><label><?php echo $row_fact['ced']?></label></td>
    </tr>
    <tr>
      <td class="bold" >Telefono</td>
      <td align="center" class="cont"><label><?php echo $row_fact['tel']?></label></td>
      <td class="bold" >Forma de Pago</td>
      <td align="center" class="cont"><label><?php echo $row_fact['forma_pago']?></label></td>
    </tr>
    <tr>
      <td class="bold" width="20%">Fecha Pago</td>
      <td align="center" class="cont"><label><?php echo $row_fact['f_pago']?></label></td>
      <td class="bold" >Observaciones</td>
      <td align="center" class="cont"><label><?php echo $row_fact['obs']?></label></td>
    </tr>
    <tr id="fila_con">
      <td class="bold" width="20%">Punto de venta</td>
      <td align="center" class="cont">
        <label><?php echo $row_fact['punto_venta']?></label>
      </td>
      <td class="bold" >&nbsp;</td>
      <td align="right" class="cont">&nbsp;</td>
    </tr>
  </table>
  <table width="98%" border="1" cellspacing="0" align="center" id="tb_data">
  <tr class="tittle" id="tittle">
    <td align="center" width="18%">Imagen</td>
    <td align="center" width="10%">Ref.</td>
    <!--<td align="center" width="10%">Cod. Barras</td>-->
    <td align="center" width="20%">Descripción</td>
    <td align="center" width="12%">Marca</td>
    <td align="center" width="10%">Cantidad</td>
    <td align="center" width="10%">Costo</td>
    <td align="center" width="10%">P. Mayorista</td>
    <td align="center" width="10%">P. Venta</td>
  </tr>
  <?php
  mysql_select_db($database_conexion, $conexion);
  $prod = mysql_query("SELECT * FROM `h01sg_inventario_detalle` WHERE `consec`='$consec_url' 
  AND `mov`='c' AND `delete`<>1 ORDER BY `id`", $conexion) or die(mysql_error());
  while ($row_prod = mysql_fetch_assoc($prod)) {

  ?>
  <tr id="fila_<?php echo $i?>" class="row">
    <td align="center" valign="middle">
    <?php
    $ref = $row_prod['ref'];
	mysql_select_db($database_conexion, $conexion);
	$det = mysql_query("SELECT * FROM `h01sg_producto` WHERE `ref`='$ref' AND `delete`<>1 ", $conexion) or die(mysql_error());
	$row_det = mysql_fetch_assoc($det);
	if ( $row_det['img_id'] != ''){				
	?>
    <div align="center" id="<?php echo $id ?>" style="width:90px; height:90px" name=divs class="img">
        <div>
        <?php
        if ($row_det['img_id']){
		?>
        <img src="compras_agregarimg.php?idnum=<?php echo $row_det['img_id'] ?>" 
        alt="Img" id="art<?php echo $row_det['img_id'] ?>" name="imgs" class="picture" />
        <?php
		}
		?>
        </div>
    </div>
    <?php 
	}else{
	?>
    <input type="hidden" id="img<?php echo $i?>" class="p">
    <?php
	}
	?>
    </td>
    <td class="cont" align="center">
    <label><?php echo $ref ?></label>
    </td>
    <!--<td class="cont">
    <input name="tf_desc" type="text" class="long" id="tf_codb< echo $i?>" value="< echo $row_det['cod_barra'] ?>" readonly>
    </td>-->
    <td class="cont">
    <label><?php echo $row_det['desc'] ?></label>
    </td>
    <td class="cont">
    <label><?php echo $row_det['marca'] ?></label>
    </td>
    <td class="cont" align="center">
    <label><?php echo $row_prod['cant'] ?></label>
    </td>
    <td class="cont" align="center">
    <label><?php echo number_format($row_det['costo_und'],2) ?></label>
    </td>
    <td class="cont" align="center">
    <label><?php echo number_format($row_det['precio_mayo'],2) ?></label>
    </td>
    <td class="cont" align="center">
	<label><?php echo number_format($row_det['precio_und'],2) ?></label>
    </td>
    
  </tr>
  <?php
  $i++;
  }
  ?>
</table>
<table width="98%" border="1" cellspacing="0" align="center">
  <tr>
  	<td width="20%" class="bold">Total Items</td>
    <td width="30%" class="bold"><label id="lb_toti" class="red"><?php echo number_format($row_fact['cant'],2)?></label></td>
    <td width="20%" class="bold">Costo Total</td>
    <td width="30%" class="bold"><label id="lb_totc" class="red"><?php echo number_format($row_fact['costo'],2)?></label></td>
  </tr>
  <tr>
    <td align="center" colspan="4">&nbsp;
    <input name="bt_close" type="button" class="ext" id="bt_close"
    value="Cerrar" onclick="window.parent.Shadowbox.close();">
    </td>
  </tr>
</table>
</div>
</form>
    
</body>
<script>

//funcion para imprimir la pantalla
function imprimir_esto(id_tabla){
	$("#"+id_tabla).printThis({
	     debug: false,          
	     importCSS: true,           
         printContainer: true,      				         
		 loadCSS: "../css/style-print.css", 
         pageTitle: "",             
         removeInline: false       
	  });
}

</script>
</html>
<?php
}
?>