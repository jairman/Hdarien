
<?php require_once('joom.php'); ?>
<?php require_once('../Connections/conexion.php'); ?>

<?php
if ($acceso =='0'){ 
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
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<script src="http://code.jquery.com/jquery-1.9.1.js"></script>
<script src="http://code.jquery.com/ui/1.10.1/jquery-ui.js"></script>
<link rel="stylesheet" href="http://code.jquery.com/ui/1.10.1/themes/base/jquery-ui.css" />
<link rel="stylesheet" href="css/clean.css" />
<link rel="stylesheet" href="css/style.css" />
<script type="text/javascript" src="js/shadowbox.js"></script>
<link rel="stylesheet" type="text/css" href="css/shadowbox.css">
<script type="text/javascript">
Shadowbox.init({	 
    handleOversize: "drag",
    modal: true,
	onClose: function(){
		recarga_tabla();
	}
});
</script>
<script src="../SpryAssets/SpryMenuBar.js" type="text/javascript"></script>
<link href="../SpryAssets/SpryMenuBarHorizontal.css" rel="stylesheet" type="text/css" />  
<script type="text/javascript" src="js/format_table.js"></script>
<link href="css/format_table.css" rel="stylesheet" type="text/css" />
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Documento sin título</title>
<style>
#overlay {
    position: fixed; 
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background: #000;
    opacity: 0.8;
    filter: alpha(opacity=80);
    z-index:50;
	display:none;
}
</style>


</head>

<body>
<table width="98%" border="0" align="center" cellspacing="0">
  <tr bgcolor="#f0f0f0">
    <td width="858" align="left" bgcolor="#FFFFFF"><div id="menu">
      <ul >
        <ul>
          <li> <a href="loco.php" >Historial Colectivo</a> </li>
           <li> <a  href="agenda2.php" class='active' >Historial Individual</a></li>
        
          </ul>
        </ul>
    </div>      <div id="apDiv2"></div></td>
    <td width="94" align="center" bgcolor="#FFFFFF">&nbsp;</td>
    <td width="58" align="left" bgcolor="#FFFFFF">&nbsp;</td>
  </tr>
</table>
<table width="98%" border="1" cellspacing="0" cellpadding="0" style="border-right:none; border-top:none; border-bottom:none; font-size: 12px; font-family: Arial;" >
  <tr align="center" style="color:#FFF; background-color:#ccc;">
    <td colspan="5" align="left" bgcolor="#FFFFFF" style="border-right:none" ><img src="img/logo2.png" width="200" height="70" /></td>
    </tr>
  <tr align="center" >
    <td colspan="5" align="right" style="font-family: 'Arial Black', Gadget, sans-serif" > <label for="filtro"></label>
    <?
	if($usuario=='general'){
		$rs_usus=mysql_query("SELECT  hacienda FROM d89xz_hacienda where `delete` ='0'",$conexion);	
		
	?>
    <select name="filtro" id="filtro" style="float:left; margin-left:15px; width:300px" onchange="recarga_tabla()" class="cont">
       <option value="">Seleccione Sucursal</option>
      <?
	  while($row_rs_usus=mysql_fetch_assoc($rs_usus)){
	  ?>
      <option value="<? echo $row_rs_usus['hacienda'] ?>"><? echo $row_rs_usus['hacienda'] ?></option>
      <?
	  }		  
	  ?>
      </select>      
     <?
	}else{
	 ?> 
     <input type="hidden" value="<? echo $usuario ?>" id="filtro" />
     <?
	}
	 ?></td>
    </tr>
    </table>
    <div id="recargar">
<?
@$filtro = stripslashes(trim($_GET["filtro"]));
$query_lugar = "SELECT DISTINCT lugar_trabajo FROM nomina_valle WHERE hacienda='$filtro' and `delete`=0 ORDER BY lugar_trabajo ASC";
$lugar = mysql_query($query_lugar, $conexion) or die(mysql_error());
$totalRows_lugar = mysql_num_rows($lugar);

?>
    <table width="98%" border="1" cellspacing="0" cellpadding="0" style="border-right:none; border-top:none; border-bottom:none; font-size: 12px; font-family: Arial;" id="t_formato">
    <thead>
  <tr align="center" style="font-size:16px">
    <th colspan="5"  class="tittle" >Listado De Empleados</th>
    </tr> 
  <tr align="center" class="tittle">
    <td width="376" style="font-family: 'Arial Black', Gadget, sans-serif"><strong>Nombre</strong></td>
    <td width="142" style="font-family: 'Arial Black', Gadget, sans-serif"><strong>Cédula</strong></td>
    <td width="158" style="font-family: 'Arial Black', Gadget, sans-serif"><strong>Cargo</strong></td>
    <td style="font-family: 'Arial Black', Gadget, sans-serif"><strong>Salario</strong></td>
    <th width="145" style="border-right:none; border-top:none; border-bottom:none; margin-left:15px" align="center" >&nbsp;</th>
  </tr>
  </thead>
  <?
  while($row_lugar = mysql_fetch_assoc($lugar)){
	  $lugar_tra=$row_lugar['lugar_trabajo'];
  ?>
  <tr align="center" class="bold">
    <td colspan="5" align="left" style="font-family: 'Arial Black', Gadget, sans-serif; border:none" class="row" ><strong><? echo $row_lugar['lugar_trabajo'] ?></strong></td>
    </tr>
  <? 
  mysql_select_db($database_conexion, $conexion);
$query_lista = "SELECT * FROM nomina_valle WHERE lugar_trabajo='$lugar_tra' and hacienda='$filtro' and `delete`=0  order by nombre";
$lista = mysql_query($query_lista, $conexion) or die(mysql_error());
$totalRows_lista = mysql_num_rows($lista);
  while ($row_lista = mysql_fetch_assoc($lista)){ ?>
  <tr align="center" name="filas" onmouseover="dibujar('<? echo $row_lista['id']?>','<? echo $row_lista['cedula'] ?>')"  onmouseout= "desdibujar('<? echo $row_lista['id']?>','<? echo $row_lista['cedula'] ?>')" id="<? echo $row_lista['id'] ?>" style="background-image:none; border-right:none" class="row"> 
    <td align="left" style="font-family: Arial"   onclick="mostrar(<? echo $row_lista['id']?>)"><? echo $row_lista['nombre'] ?></td>
    <td style="font-family: Arial" align="right"  onclick="mostrar(<? echo $row_lista['id']?>)"><? echo $row_lista['cedula'] ?></td>
    <td style="font-family: Arial" align="center" onclick="mostrar(<? echo $row_lista['id']?>)"><? echo $row_lista['cargo'] ?></td>
    <td align="center" style="font-family: Arial" onclick="mostrar(<? echo $row_lista['id']?>)"><? echo @number_format($row_lista['salario']) ?>    </td>
    <td align="center" style="font-family: Arial" onclick="mostrar(<? echo $row_lista['cedula']?>)"><? echo @number_format($row_lista['salario']) ?>    </td>
     
	
<? }  }  ?>
  </td>
  </tr>
  </tbody>
</table>
</div>
<div id="dialog" align="center">
</div>

<?
}else{
	?>
    <table width="70%" border="0" align="center">
  <tr>
    <td><img src="img/logo3.png" width="917" height="690" /></td>
  </tr>
  <tr>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <th>No puede acceder A este MENU sin estar HABILITADO... Consulte al Administrador....!!!</th>
  </tr>
</table>
<?
}
?>
</body>
<script>
window.onload=function(){
	recarga_tabla()
	overlay = $('<div></div>').prependTo('body').attr('id', 'overlay');
	formato("t_formato")

};

function recarga_tabla(){
	var filtro=$("#filtro").val();
		$('#recargar').load('agenda_prueba.php?filtro=' + filtro.replace(/ /g,"+") + ' #recargar ' );
				  }

function dibujar(fila, ced){	
	document.getElementById(fila).style.backgroundColor = "#CCC"; 
	
	document.getElementById(fila).style.color = "#fff"; 
	document.getElementById(fila).style.cursor="pointer";
	document.getElementById(fila).title = 'Ver Detalle';
}
function desdibujar(fila, ced){	
	document.getElementById(fila).style.color = "#000"; 
	 document.getElementById(fila).style.backgroundColor = "#FFF"; 
	 document.getElementById(fila).style.cursor="auto";
	 
}

</script>
</html>
<?php
@mysql_free_result(@$estado);
@mysql_free_result($lista);
?>
