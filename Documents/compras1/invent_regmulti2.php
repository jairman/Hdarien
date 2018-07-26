<?php require_once('joom.php'); ?>
<?php require_once('../Connections/conexion.php') ?>

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

date_default_timezone_set('America/Bogota');

$c_date = date('Y-m-d');

/*SELECT MAX(consec) FROM `h01sg_inventario_detalle` 
WHERE `delete`<>1 AND `mov`='c'*/
mysql_select_db($database_conexion, $conexion);
$drio1 = mysql_query("SELECT * FROM `h01sg_compra` 
WHERE `delete`<>1 ORDER BY `consec` DESC ", $conexion) or die(mysql_error());
$row_drio1 = mysql_fetch_assoc($drio1);			
$factura1= $row_drio1['consec'];
if($factura1!=''){
	$factura2=$factura1;
}else{
	$factura2=0;	
}
$factura=$factura2 + 1;

$i = 0;

?>
<!doctype html>
<html>
<head>
<meta charset="UTF-8">
<title>Registrar Factura</title>
<link href="../css/clean.css" rel="stylesheet" type="text/css" />
<link rel="stylesheet" type="text/css" href="http://code.jquery.com/ui/1.11.0/themes/smoothness/jquery-ui.css" />
<link href="../css/style.css" rel="stylesheet" type="text/css" />
<link href="../css/shadowbox.css" rel="stylesheet" type="text/css" />

<script src="http://code.jquery.com/jquery-2.1.1.js"></script>
<script src="http://code.jquery.com/ui/1.11.0/jquery-ui.js"></script>
<script src="../js/shadowbox.js" type="text/javascript"></script>
<script src="../js/jquery.validate.js" type="text/javascript"></script>
<script src="js/invent_regmulti2.js" type="text/javascript"></script>

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
<input type="hidden" id="tf_i" value="<?php echo $i ?>">
<input type="hidden" id="tf_consecf" >

<div id="dialog"></div>

<form id="form1" name="form1">
	<table width="98%" align="center" id="table_header">
    <tr>
      <td align="left" width="92%">
      <img src="../img/Logo.png" alt="logo" name="logo" width="200" height="70" id="logo" />
      </td>
      <td width="8%" align="center">&nbsp;</td>
    </tr>
   </table>

  <table width="98%" border="1" cellspacing="0" align="center">
    <tr>
      <td class="bold" width="20%">No</td>
      <td width="30%" align="center"><label id="lb_consec" class="red"><?php echo $factura?></label></td>
      <td class="bold" width="20%">Fecha</td>
      <td width="30%" align="center" class="cont">
      <input type="text" id="lb_fecha" value="<?php echo $c_date?>" class="long" ></td>
    </tr>
    <tr>
      <td class="bold" >Provedor</td>
      <td align="center" class="cont">
      <input type="text" name="tf_prove" id="tf_prove" style="width:35%" onkeyup="des1()" > 
      <select name="sl_prove" id="sl_prove" style="width:60%" onChange="des2()">
      <option value="">Seleccione</option>
      <?php
        mysql_select_db($database_conexion, $conexion);
        $query_clr = "SELECT DISTINCT `nombre` FROM `d89xz_prove` WHERE `delete`<>1 ORDER BY `nombre` ASC ";
        $clr = mysql_query($query_clr, $conexion) or die(mysql_error());
        //$row_clr = mysql_fetch_assoc($clr);
        while ($row_clr = mysql_fetch_assoc($clr)){
        ?>
      <option value="<?php echo ucwords(strtolower($row_clr['nombre']))?>">
	  <?php echo ucwords(strtolower($row_clr['nombre']))?>
      </option>
		<?php
        } 
        ?>
      </select>
      </td>
      <td class="bold" >Cedula o Nit</td>
      <td align="center" class="cont"><input type="text" name="tf_ced" id="tf_ced" class="long" ></td>
    </tr>
    <tr>
      <td class="bold" >Telefono</td>
      <td align="center" class="cont"><input type="text" name="tf_tel" id="tf_tel" class="long" ></td>
      <td class="bold" >Forma de Pago</td>
      <td align="center" class="cont">
      <select name="sl_fpago" id="sl_fpago" class="long" align="center">
        <option value="">Seleccione</option>
        <option value="Contado">Contado</option>
        <option value="Consignación">Consignación</option>
        <option value="Credito">Credito</option>
        </select></td>
    </tr>
    <tr>
      <td class="bold" width="20%">Fecha Pago</td>
      <td align="center" class="cont">
      <input type="text" name="tf_fechap" id="tf_fechap" class="long" value="<? echo date ('Y-m-d') ?>">
      </td>
      <td class="bold" >Observaciones</td>
      <td align="center" class="cont"><input type="text" name="tf_obs" id="tf_obs" class="long" ></td>
    </tr>
    <tr id="fila_con">
      <td class="bold" width="20%">Punto de venta</td>
      <td align="center" class="cont">
      <?php
        if ($usuario2 == 'general'){
        ?>
        <select name="sl_ptov" id="sl_ptov" class="long">
        <option value="">Seleccione</option>
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
        ?>
      </td>
      <td class="bold" >&nbsp;</td>
      <td align="center" class="cont">&nbsp;</td>
    </tr>
  </table>
  <table width="98%" border="1" cellspacing="0" align="center" id="tb_data">
  <tr class="stittle" id="tittle">
    <td align="center" width="18%">Imagen</td>
    <td align="center" width="10%">Referencia</td>
    <!--<td align="center" width="10%">Cod. Barras</td>-->
    <td align="center" width="17%">Descripción</td>
    <td align="center" width="10%">Marca</td>
    <td align="center" width="10%">Cantidad</td>
    <td align="center" width="10%">Costo</td>
    <td align="center" width="10%">Por Mayor</td>
    <td align="center" width="10%">Detal</td>
    <td align="center" width="5%">&nbsp;</td>
  </tr>
  <?php
  mysql_select_db($database_conexion, $conexion);
  $pictures = mysql_query("SELECT  * FROM `h01sg_temp_img` WHERE `delete`=0 ORDER BY `id`");
  while ($row_pic = mysql_fetch_assoc($pictures)) {
	$nombre=$row_pic['name'];
	$id=$row_pic['id'];

  ?>
  <tr id="fila_<?php echo $i?>" class="row">
    <td align="center" valign="middle">
    <input type="hidden" id="img<?php echo $i?>" value="<?php echo $id ?>">
    <div align="center" id="<?php echo $id ?>" style="width:90px; height:90px" name=divs class="img">
        <div>
        <img src="../compras/invent_agregarimg.php?idnum=<?php echo $id ?>" alt="Img" id="art<?php echo $id ?>" name="imgs" class="picture" />
        </div>
    </div>
    </td>
    <td class="cont" align="center">
    <input type="text" name="tf_ref" id="tf_ref<?php echo $i?>" class="long ref" required onChange="checkref(<?php echo $i ?>)" >
    <img src="" width="22" height="22" id="img_est<?php echo $i?>" style="display:none" />
    </td>
    <!--<td class="cont">
    <input name="tf_barc" type="text" id="tf_barc< echo $i?>" class="long">
    </td>-->
    <td class="cont">
    <input name="tf_desc" type="text" id="tf_desc<?php echo $i?>" class="long">
    </td>
    <td class="cont">
    <input name="tf_marca" type="text" id="tf_marca<?php echo $i?>" class="long" >
    </td>
    <td class="cont" align="center">
    <input name="tf_cant" type="text" id="tf_cant<?php echo $i?>" class="long cant" required onkeyup="checkNum(this)">
    </td>
    <td class="cont" align="center">
    <input name="tf_costo" type="text" id="tf_costo<?php echo $i?>" class="long costo" required onkeyup="checkNum(this)">
    </td>
    <td class="cont" align="center">
    <input name="tf_preciom" type="text" id="tf_preciom<?php echo $i?>" class="long" required onkeyup="checkNum(this)">
    </td>
    <td class="cont" align="center">
    <input name="tf_precio" type="text" id="tf_precio<?php echo $i?>" class="long" required onkeyup="checkNum(this)">
    </td>
    
    <td align="center">
    <img src="../img/erase.png" id="img<?php echo $i?>" width="20" height="20" style="cursor:pointer;" 
    title="Eliminar" onClick="quitar(<?php echo $i ?>)">
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
    <td width="30%" class="bold"><label id="lb_toti" class="red"></label></td>
    <td width="20%" class="bold">Costo Total</td>
    <td width="30%" class="bold"><label id="lb_totc" class="red"></label></td>
  </tr>
  <tr>
    <td align="center" colspan="4">
    <input name="bt_ok" type="submit" id="bt_ok" value="Aceptar" class="ext">
    &nbsp;
    <input name="bt_close" type="button" class="ext" id="bt_close"
    value="Cancelar" onclick="window.close();">
    </td>
  </tr>
</table>
</form>
    
</body>
<script>


</script>
</html>
<?php
}
?>