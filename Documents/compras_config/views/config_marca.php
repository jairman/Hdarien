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

$order_url=$_GET['o'];

$i = 0;

?>
<!doctype html>
<html>
<head>
<meta charset="UTF-8">
<title>Parametrización Marca</title>
<link href="../../css/clean.css" rel="stylesheet" type="text/css" />
<link rel="stylesheet" type="text/css" href="http://code.jquery.com/ui/1.11.0/themes/smoothness/jquery-ui.css" />
<link href="../../css/style.css" rel="stylesheet" type="text/css" />
<link href="../../css/shadowbox.css" rel="stylesheet" type="text/css" />

<script src="http://code.jquery.com/jquery-2.1.1.js"></script>
<script src="http://code.jquery.com/ui/1.11.0/jquery-ui.js"></script>
<script src="../../js/shadowbox.js" type="text/javascript"></script>
<script src="../../js/jquery.validate.js" type="text/javascript"></script>
<script src="../../js/printThis.js" type="text/javascript"></script>
<script src="../js/config_marca.js" type="text/javascript"></script>

</head>

<body>

<input type="hidden" id="tf_user" value="<?php echo $usuario2 ?>">
<input type="hidden" id="tf_user2" value="<?php echo $usuario ?>">

<div id="dialog"></div>
<div id="dialog2" title="Edición Marca">
<table align="center" width="90%">
<tr>
	<td align="right" class="bold" width="50%">Identificador</td>
    <td class="cont" width="50%"><input type="text" id="tf_identif1" class="long" readonly></td>
</tr>
<tr>
	<td align="right" class="bold" width="50%">Descripción</td>
    <td class="cont" width="50%"><input type="text" id="tf_desc1" class="long"> </td>
</tr>
<tr>
	<td align="center">
    <img id="theImg" src="../../img/good.png" width="50" height="50" 
    style="cursor:pointer" onclick="updateUnd()" title="Confirmar"/>
    </td>
    <td align="center">
    <img id="theImg2" src="../../img/erase.png" width="50" height="50" 
    style="cursor:pointer" onclick="cerrar_dialogo2()" title="Cancelar" />
    
    </td>
</tr>
</table>
</div>
<div id="dialog3" title="Crear Marca">
<table align="center" width="90%">
<tr>
	<td align="right" class="bold" width="50%">Identificador</td>
    <td class="cont" width="50%"><input type="text" id="tf_identif" class="long"></td>
</tr>
<tr>
	<td align="right" class="bold" width="50%">Descripción</td>
    <td class="cont" width="50%"><input type="text" id="tf_desc" class="long"> </td>
</tr>
<tr>
	<td align="center">
    <img id="theImg" src="../../img/good.png" width="50" height="50" 
    style="cursor:pointer" onclick="createUnd()" title="Confirmar"/>
    </td>
    <td align="center">
    <img id="theImg2" src="../../img/erase.png" width="50" height="50" 
    style="cursor:pointer" onclick="cerrar_dialogo3()" title="Cancelar" />
    
    </td>
</tr>
</table>
</div>


<table width="90%" align="center" id="table_header">
  <tr>
    <td width="76%" align="left">
     <div id="menu">
      <ul>
      <li>
      <a href="../views/config.php" >Configuración</a>
      </li>              
      <li>
        <a href="../views/config_cat.php" >Categoría</a>
      </li>
      <li>
      <a href="../views/config_marca.php" class='active' >Marca</a>
      </li>              
      </ul>
    </div> 
    </td>
    <td width="8%">&nbsp;</td>
    <td width="8%" align="right">
    <input type="image" src="../../img/add2.png" alt="" width="48" height="48" border="0" 
    align="right"  title="Registro de Unidad" id="bt_addp" style="cursor:pointer" onClick="create()" >
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
    <td>Parametrización Marca</td>
    </tr>
</table>

<div id="d_table">
<table width="90%" border="1" cellspacing="0" align="center" id="tb_detail">
  <tr class="stittle" id="tittle">
    <td width="45%" onClick="orden_bus('marca')" style="cursor:pointer" title="Ordenar por Categoria">Marca</td>
    <td width="45%" onClick="orden_bus('nombre')" style="cursor:pointer" title="Ordenar por Descripcion">Descripción</td>
    <td width="10%">&nbsp;</td>
  </tr>
  <?php
  	//echo $order_url;
	mysql_select_db($database_conexion, $conexion);
	$query_inv = mysql_query("SELECT * FROM `h01sg_marca_prod` WHERE `delete`<>1 $order_url", $conexion) or die(mysql_error());		
	while($row_inv = mysql_fetch_assoc($query_inv)){
		
  ?>
  <tr class="row" id="fila_<?php echo $i?>" >
    <td align="center"><?php echo $row_inv['marca']?></td>
    <td align="center"><?php echo $row_inv['nombre']?></td>
    <td align="center"><input name="imgb" type="image" id="img<? echo $i; ?>" 
      src="../../img/edit.png" width="20" height="20" class="bt_x" style="cursor:pointer" title="Editar"
      onClick="edit('<?php echo $row_inv['marca'] ?>', '<?php echo $row_inv['nombre']?>')" >
      &nbsp;
      <input name="imga" type="image" id="imga<? echo $i; ?>" 
      src="../../img/erase.png" width="20" height="20" class="bt_x" style="cursor:pointer" title="Eliminar"
      onClick="erase('<?php echo $row_inv['marca'] ?>')" >
      </td>
  </tr>
  <?php
  $i++;
	}
  ?>
  <tr>
  <td colspan="3">&nbsp;</td>
  </tr>
</table>
&nbsp;
</div>
</div> 
</div>

</body>
</html>
<?php
}
?>