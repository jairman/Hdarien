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

$ref_url = $_GET['r']; 

mysql_select_db($database_conexion, $conexion);
$query_prod = "SELECT * FROM `h01sg_insumos` WHERE `ref`='$ref_url' AND `delete`<>1 ";
$prod = mysql_query($query_prod, $conexion) or die(mysql_error()); 
$row_prod = mysql_fetch_assoc($prod);

?>
<!doctype html>
<html>
<head>
<meta charset="UTF-8">
<title>Ficha del Insumo</title>
<link href="../../css/clean.css" rel="stylesheet" type="text/css" />
<link rel="stylesheet" type="text/css" href="http://code.jquery.com/ui/1.11.0/themes/smoothness/jquery-ui.css" />
<link href="../../css/style.css" rel="stylesheet" type="text/css" />
<link href="../../css/shadowbox.css" rel="stylesheet" type="text/css" />

<script src="http://code.jquery.com/jquery-2.1.1.js"></script>
<script src="http://code.jquery.com/ui/1.11.0/jquery-ui.js"></script>
<script src="../../js/shadowbox.js" type="text/javascript"></script>
<script src="../../js/jquery.validate.js" type="text/javascript"></script>
<script src="../../js/printThis.js" type="text/javascript"></script>
<script src="../js/insumos_ficha.js" type="text/javascript"></script>

<style>
.picture{
	width:170px;
	height:170px;
}
.img{
	padding-top:2px;
}
</style>
</head>

<body>

<div id="dialog"></div>
<table width="95%" align="center" id="table_header">
  <tr>
    <td width="93%" align="left">
    <div id="menu">
      <ul>
      <li>
      <a href="insumos_ficha.php?r=<?php echo $ref_url ?>" class='active'>Ficha del Insumo</a>
      </li>
      <li>
      <a  href="insumos_mov.php?r=<?php echo $ref_url ?>" >Historial de movimientos</a>
      </li>
      </ul>
    </div>  
    </td>
    <td width="7%" align="left">
    <input type="image" title="Imprimir" src="../../img/imprimir.png" alt="" 
    width="48" height="48" border="0" align="right" style="cursor:pointer" onclick="imprimir_esto('recargar2')" >
	</td>
  </tr>
</table>
<div id="main">
&nbsp;
<div id="recargar2">

<table width="95%" align="center" id="table_header">
    <tr>
      <td align="left" width="90%" >
      <img src="../../img/Logo.png" alt="logo" name="logo" width="200" height="70" id="logo" />
      </td>
      <td align="right" width="10%">
      <input type="image" title="Imprimir" src="../../img/edit.png" alt="" 
    width="48" height="48" border="0" align="right" style="cursor:pointer" onclick="edit_prod('<?php echo $ref=$row_prod['ref']?>')" >
      </td>
    </tr>
</table>
<table width="95%" border="1" cellspacing="0" align="center">
  <tr class="tittle">
    <td colspan="4"> Insumo</td>
  </tr>
  <tr>
    <td class="bold" width="20%">Referencia</td>
    <td class="cont" width="30%">
    <input type="text" class="long red" id="tf_ref" 
    readonly value="<?php echo  $ref?>"></td>
    <td class="bold" width="20%" >Fecha de Creación</td>
    <td class="cont" width="30%" ><input name="tf_fecha" type="text" class="long" id="tf_fecha" 
    readonly value="<?php echo $row_prod['fecha']?>"></td>
    </tr>
    <!--<tr>
    <td class="bold">Cod. Barras</td>
    <td class="cont"><input type="text" class="long" id="tf_codb" 
    readonly value="< echo $row_prod['cod_barra']?>"></td>
    <td class="bold">RFID</td>
    <td class="cont"><input type="text" class="long" id="tf_rfid" 
    readonly value="< echo $row_prod['rfid']?>"></td>
    </tr>-->
    <tr>
    <td class="bold">Descripcion</td>
    <td class="cont"><input type="text" class="long" id="tf_desc" 
    readonly value="<?php echo $row_prod['desc']?>"></td>
    <td class="bold" >Unidad de Medida</td>
    <td class="cont" ><input type="text" class="long" id="tf_talla" 
    readonly value="<?php echo $row_prod['unidad']?>"></td>
    <tr>
    <tr>
    <td class="bold">Presentación</td>
    <td class="cont"><input type="text" class="long" id="tf_color" 
    readonly value="<?php echo $row_prod['present']?>"></td>
   	<td class="bold" >Contenido</td>
    <td class="cont" ><input type="text" class="long" id="tf_marca" 
    readonly value="<?php echo $row_prod['contenido']?>"></td>
    </tr>
    <tr>
    <td class="bold">Código</td>
    <td class="cont"><input type="text" class="long" id="tf_color" 
    readonly value="<?php echo $row_prod['codigo']?>"></td>
   	<td class="bold" >Color</td>
    <td class="cont" ><input type="text" class="long" id="tf_marca" 
    readonly value="<?php echo $row_prod['color']?>"></td>
    </tr>
    <tr>
    <td class="bold">Marca</td>
    <td class="cont"><input name="tf_fecha" type="text" class="long" id="tf_scat" 
    readonly="readonly" value="<?php echo $row_prod['marca']?>"></td>
   	<td class="bold" >Categoria</td>
    <td class="cont" ><input type="text" class="long" id="tf_cat" 
    readonly value="<?php echo $row_prod['categoria']?>"></td>
    </tr>
    <tr>
   	<td class="bold" >Minimo</td>
    <td class="cont" ><input name="tf_costo" type="text" class="long" id="tf_costo" 
    readonly="readonly" value="<?php echo $row_prod['min']?>" ></td>
    <td class="bold" >Maximo</td>
    <td class="cont" ><input name="tf_precio" type="text" class="long" id="tf_precio" 
    readonly="readonly" value="<?php echo $row_prod['max']?>" ></td>
    </tr>
	<!--
    <tr>
      <td colspan="4" align="center" class="cont" valign="middle">
        <div align="center" id="d_img" style="width:180px; height:180px" name=divs class="img">
          <div>
            <img src="../controllers/invent_agregarimg.php?idnum=< echo $row_prod['img_id']?>" alt="Img" id="art< echo $row_prod['img_id']?>" name="imgs" class="picture" />
            </div>
          </div>
      </td>
    </tr>-->
  <tr>
    <td colspan="4">&nbsp;</td>
  </tr>  
  <tr>
    <td colspan="4" align="center">
    <input name="bt_close" type="button" class="ext" id="bt_close"
    value="Cerrar" onclick="window.close();">
    </td>
  </tr>
</table>
&nbsp;
</div>
</div>
</body>
</html>
<?php
}
?>