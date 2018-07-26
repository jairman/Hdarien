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
$rs_ej=mysql_query("SELECT * FROM tba WHERE hacienda='$usuario' and nivel='$usuario_nivel' and nombre='$usuario_name' and `delete`=0",$conexion);

ini_set('date.timezone', 'America/Bogota');
$today = date("Y-m-d");
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Documento sin título</title>
<script src="http://code.jquery.com/jquery-1.9.1.js"></script>
<script src="http://code.jquery.com/ui/1.10.1/jquery-ui.js"></script>
<link rel="stylesheet" href="http://code.jquery.com/ui/1.10.1/themes/base/jquery-ui.css" />
<link rel="stylesheet" href="../css/clean.css" />
<link rel="stylesheet" href="../css/style.css" />
<script type="text/javascript" src="js/shadowbox.js"></script>
<link rel="stylesheet" type="text/css" href="css/shadowbox.css">
<script type="text/javascript">
Shadowbox.init({	
	onOpen: function() {
		$('#sb-info').after($('#sb-wrapper-inner'));
		$('#sb-wrapper-inner').after($('#sb-title'));
	}, 
    handleOversize: "drag",
    modal: true,
	onClose: function(){  }
});
</script>

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
@media print{
    .visible {display:none}
}
.visible {display:none}
</style>
</head>

<body >
<table width="98%" border="1" cellspacing="0" cellpadding="0">
  <tr bgcolor="#CCC">
    <td colspan="6" align="left" bgcolor="#FFFFFF" style="color:#FFF; border-right:none"><img src="../img/historial1.png" width="48" height="48"   title="Historial" onclick="location.href='stin_corte3.php'" style="float:right; cursor:pointer; margin-right:15px; margin-top:30px" /></td>
  </tr>
  
    </table>
<form id="formu">
<table width="98%" border="1" cellspacing="0" cellpadding="0">

  <tr class="tittle">
 
    <td colspan="5" style="font-size:18px"  ><div id="rec_orden">  <?php
	if(isset($_GET['filtro'])){
		$filtro=$_GET['filtro'];
  $query_drio1 = "SELECT * FROM orden_corte where hacienda='$filtro'  ORDER BY orden_no DESC";
	$drio1 = mysql_query($query_drio1, $conexion) or die(mysql_error());
	$row_drio1 = mysql_fetch_assoc($drio1);
	$totalRows_drio1 = mysql_num_rows($drio1);
	$orden= $row_drio1['orden_no'];
	if($orden=='') $orden=2000;
	else $orden=$orden + 1;
	}
  ?>ORDEN DE CORTE No. <?php echo $orden ?></div>
      </td>
  </tr>
  <tr class="bold cont">
    <td style="width:200px" ><strong style="margin-left:15px">Fecha</strong></td>
    <td colspan="2" align="left" >
    <input type="text" name="registro" id="fecha"  style=" cursor:pointer"  required="required" value="<?php echo $today; ?>"  /></td>
    <td ><strong>Ubicación</strong></td>
    <td align="left"><?php
	if($usuario=='general'){
		$rs_usus=mysql_query("SELECT DISTINCT hacienda FROM h01sg_vacunos",$conexion);	
		
	?>
       <select name="registro" id="filtro" style=" margin:auto"   required="required" onchange="rec_tipos_tel()">
       <!--<option value="">Ubicación</option>-->
      <?php
	  while($row_rs_usus=mysql_fetch_assoc($rs_usus)){
	  ?>
      <option value="<?php echo $row_rs_usus['hacienda'] ?>"><?php echo $row_rs_usus['hacienda'] ?></option>
      <?php
	  }		  
	  ?>
      </select>      
     <?php
	}else{
	 ?> 
     <input type="text" value="<?php echo $usuario ?>" id="filtro"  readonly="readonly" name="registro"/>
     <?php
	}
	 ?></td>
  </tr>
  <tr class="bold cont">
    <td ><strong style="margin-left:15px">Cantidad de Telas</strong></td>
    <td colspan="2"><input type="text" name="registro" id="cant_telas" onkeyup="verifica2(this)" style=" "  required="required" /></td>
    <td><strong style="">Tipo</strong></td>
    <td style="width:50%" ><div id="rec_tipos_t">
      <?php
	  if(isset($_GET['filtro'])){
		  $filtro=$_GET['filtro'];
	$rs_telas=mysql_query("SELECT * FROM d89xz_total_medicinasins WHERE tipo_t<>'' and `delete`=0 and hacienda='$filtro'");
	  }
	?>

      <select name="registro" id="tipo_insumo" required="required"  >
        <option value="">Seleccione</option>
        <?php
	  while($row_telas=mysql_fetch_assoc($rs_telas)){
		  ?>
        <option  value="<?php echo $row_telas['id'] ?>"><?php echo $row_telas['tipo_t'].' '.$row_telas['nombre'].' '.$row_telas['ancho'].' de Ancho '.$row_telas['descripcion']; ?></option>
        <?php
	  }
	  ?>
      </select></div></td>
    </tr>
  <tr class="bold cont">
    <td><strong style="margin-left:15px">Largo</strong></td>
    <td><input type="text" name="registro" id="largo"  required="required" onkeyup="verifica2(this)" /></td>
    <td style="width:70px">&nbsp;</td>
    <td>Botón</td>
    <td>
    <div id="rec_bots">
	<?php
	  if(isset($_GET['filtro'])){
		  $filtro=$_GET['filtro'];
		  $rs_bots=mysql_query("SELECT * FROM d89xz_total_medicinasins WHERE tipo='BOTÓN' and hacienda='$filtro' and `delete`=0");
	  } 
	  ?>
    <select name="registro" id="tipo_boton" required="required"  >
        <option value="">Seleccione</option>
        <?php
	  while($row_bots=mysql_fetch_assoc($rs_bots)){
		  ?>
        <option  value="<?php echo $row_bots['id'] ?>"><?php echo $row_bots['nombre'].' '.$row_bots['marca'].' '.$row_bots['descripcion']; ?></option>
        <?php
	  }
	  ?>
      </select></div>
      <div id="rec_entretelas">
      <?php
	  if(isset($_GET['filtro'])){
		  $filtro=$_GET['filtro'];
		  $rs_entre=mysql_query("SELECT * FROM d89xz_total_medicinasins WHERE tipo='ENTRETELA' and hacienda='$filtro' and `delete`=0");
	  } 
	  ?>
    <select id="tipo_entretela" style="display:none">
        <option value="">Seleccione</option>
        <?php
	  while($row_entre=mysql_fetch_assoc($rs_entre)){
		  ?>
        <option  value="<?php echo $row_entre['id'] ?>"><?php echo $row_entre['descripcion']; ?></option>
        <?php
	  }
	  ?>
      </select>
      </div>
      </td>
    </tr>
</table>
<div name="des_diseno">
<table width="98%" border="1" cellspacing="0" cellpadding="0" align="center" name=''>
<tr class="tittle">
  <td colspan="30" align="center" >DESCRIPCION DEL DISEÑO
    <select name="diseno" id="diseno" onchange="descripcion()" class="">
      <option value="1" selected="selected" >1</option>
      <option value="2">2</option>
      <option value="3">3</option>
      <option value="4">4</option>
      <option value="5">5</option>
      <option value="6">6</option>
      <option value="7">7</option>
      <option value="8">8</option>
      <option value="9">9</option>
      <option value="10">10</option>
      </select></td>
</tr>
<tr class="bold">
  <td style="width:10%"><strong style="margin-left:15px">Tallas</strong></td>
  <td style="width:1%">37</td>
  <td style="width:10.25%"><input type="text" name="37" onkeyup="verifica(this)" style="width:30px"/>
  <input type="text" name="37m"  style="width:30%; display:none"  /></td>
  <td style="width:1%">38</td>
  <td style="width:10.25%"><input type="text" name="38"  onkeyup="verifica(this)" style="width:30px"  />
  <input type="text" name="38m" onkeyup="verifica(this)" style="width:30%; display:none"   /></td>
  <td style="width:1%">39</td>
  <td style="width:10.25%"><input type="text" name="39" onkeyup="verifica(this)" style="width:30px"  />
  <input type="text" name="39m" onkeyup="verifica(this)" style="width:30%; display:none"   /></td>
  <td style="width:1%">40</td>
  <td style="width:10.25%"><input type="text" name="40" onkeyup="verifica(this)" style="width:30px" />
  <input type="text" name="40m" onkeyup="verifica(this)" style="width:30%; display:none"   /></td>
  <td style="width:1%">41</td>
  <td style="width:10.25%" ><input type="text" name="41" onkeyup="verifica(this)" style="width:30px"   />
  <input type="text" name="41m" onkeyup="verifica(this)" style="width:30%; display:none"   /></td>
  <td style="width:1%">42</td>
  <td style="width:10.25%"><input type="text" name="42" onkeyup="verifica(this)" style="width:30px"  />
  <input type="text" name="42m" onkeyup="verifica(this)" style="width:30%; display:none"   /></td>
  <td style="width:1%">44</td>
  <td style="width:10.25%"><input type="text" name="44" onkeyup="verifica(this)" style="width:30px" />
  <input type="text" name="44m" onkeyup="verifica(this)" style="width:30%; display:none"   /></td>
  <td style="width:1%">46</td>
  <td style="width:10.25%"><input type="text" name="46" onkeyup="verifica(this)" style="width:30px"  />
  <input type="text" name="46m" onkeyup="verifica(this)" style="width:30%; display:none"   /></td>
</tr>
</table>
<table width="98%" border="1" cellspacing="0" cellpadding="0" align="center" name=''>
<tr class="bold">
  <td width="10%" ><strong style="margin-left:15px">Referencia</strong></td>
  <td>&nbsp;</td>
  <td><select name="referencia"  required="required">
    <option value="">Seleccione</option>
    <option value="Colección">Colección</option>
    <option value="Exclusiva">Exclusiva</option>
    <option value="Royal">Royal</option>
  </select></td>
  <td>&nbsp;</td>
  <td colspan="8">&nbsp;</td>
  <td>&nbsp;</td>
  <td>Diseño</td>
  <td>&nbsp;</td>
  <td colspan="7"><select name="diseno_t" required="required" >
    <option value="">Seleccione</option>
    <option value="Slim">Slim</option>
    <option value="Clásica">Clásica</option>
  </select></td>
  <td>&nbsp;</td>
  <td>Entretela</td>
  <td>&nbsp;</td>
  <td>
    <select name="entretela" required="required">
    <option value="">Seleccione</option>
    </select>
    <input type="text" name="cant_entretela" style="display:none; width:80px" onkeyup="verifica(this)" /></td>
  <td width="10" colspan="2">&nbsp;</td>
  <td width="40" colspan="2">&nbsp;</td>
</tr>
<tr class="bold">
  <td><strong style="margin-left:15px">Manga</strong></td>
  <td>&nbsp;</td>
  <td><select name="manga" required="required"  >
    <option value="">Seleccione</option>
    <option value="Larga">Larga</option>
    <option value="Corta">Corta</option>
  </select></td>
  <td colspan="9" align="left">Con Charretera   <input type="checkbox" name="charretera" /></td>
  <td>&nbsp;</td>
  <td>Cuello</td>
  <td>&nbsp;</td>
  <td><input type="text" name="cuello" required="required" /></td>
  <td colspan="9">Con Botón
    <input type="checkbox" name="cuello_bot" onclick="radio_cuello_bot()" checked="checked" /></td>
  <td colspan="5"><select name="cuello_bot_sel" >
    <option  value="">Seleccione</option>
    </select>    
    <input type="text" name="cant_cuello_bots" style="display:none; width:80px" onkeyup="verifica(this)" /></td>
  </tr>
<tr class="bold">
  <td><strong style="margin-left:15px">Cartera</strong></td>
  <td>&nbsp;</td>
  <td>
    <input type="text" name="cartera" required="required" /></td>
  <td colspan="9">&nbsp;</td>
  <td>&nbsp;</td>
  <td>Bolsillo</td>
  <td>&nbsp;</td>
  <td><input type="text" name="bolsillo_in" required="required" /></td>
  <td colspan="8">Con Botón
    <input type="checkbox" name="bolsillo" /></td>
  <td>&nbsp;</td>
  <td>&nbsp;</td>
  <td>&nbsp;</td>
  <td>&nbsp;</td>
  <td>&nbsp;</td>
  <td>&nbsp;</td>
</tr>
<tr class="bold">
  <td><strong style="margin-left:15px">Banda</strong></td>
  <td>&nbsp;</td>
  <td><input type="text" name="banda" required="required"  /></td>
  <td>&nbsp;</td>
  <td colspan="9">&nbsp;</td>
  <td>Espalda</td>
  <td>&nbsp;</td>
  <td><input type="text" name="espalda" required="required" /></td>
  <td colspan="7">&nbsp;</td>
  <td>Puño</td>
  <td>&nbsp;</td>
  <td><input type="text" name="puno" required="required"  /></td>
  <td>&nbsp;</td>
  <td colspan="3">&nbsp;</td>
  </tr>


</table>
</div>
 <div id="rec_todo">
<table width="98%" border="1" cellspacing="0" cellpadding="0" align="center">
  <tr class="tittle">
    <td colspan="8" >INSUMOS REQUERIDOS
    <input type="image" src="img/010.png" width="25" height="25" onclick="calcule(); return false" style="cursor:pointer; margin-left:15px" title="Calcular Total de Insumos" id="img_calculo"/>
     </tr>
  <tr class="bold">
  	<td width="150" >Metros de Tela    </td>
    <td >
   
    <?php if(isset($_GET['id_ins'])){
		$id_ins=$_GET['id_ins'];
		$filtro=$_GET['filtro'];
		 /////totalizar entradas con salidas para ponerlo en cantidad disponible
//entradas
$rs_largo=mysql_query("SELECT largo FROM d89xz_total_medicinasins WHERE id='$id_ins'");
$row_largo=mysql_fetch_assoc($rs_largo);
$largo=$row_largo['largo'];
$rs_disp=mysql_query("SELECT SUM(cantidad) as entradas FROM d89xz_total_medicinas_salidasins WHERE id_insumo='$id_ins' and hacienda='$filtro' and concep='entrada'",$conexion) or die(mysql_error());
$row_rs_disp=mysql_fetch_assoc($rs_disp);
$entradas=$row_rs_disp['entradas'];
//salidas
$rs_disp=mysql_query("SELECT SUM(cantidad) as salidas FROM d89xz_total_medicinas_salidasins WHERE id_insumo='$id_ins' and hacienda='$filtro' and concep='salida'",$conexion) or die(mysql_error());
$row_rs_disp=mysql_fetch_assoc($rs_disp);
$salidas=$row_rs_disp['salidas'];
//total
$cant_disp=($entradas*$largo-$salidas);
		
	}
	?>
    <input type="hidden" id="h_telas" value=" <?php echo $cant_disp ?>"  />
    <input type="text" name="registro" id="metros" <?php if(isset($_GET['id_ins'])){ ?> title="<?php echo 'Máximo '.number_format($cant_disp).' Metros'; ?>" <?php } ?> onkeyup="verifica2(this); funcion_maximos(this, <?php echo $cant_disp ?>)" />   
    </td>
    <td >Camisas</td>  
    <td ><input type="text" name="registro" id="t_camisas" />    </td>
    <td >Promedio   </td>
    <td ><input type="text" name="registro" id="promedio" />    </td>
    <td >Bolsas   </td>
    <td >
     <?php
if(isset($_GET['filtro'])){
	$filtro=$_GET['filtro'];
	$rs_bols=mysql_query("SELECT id, contenido FROM d89xz_total_medicinasins WHERE tipo='BOLSAS' and descripcion= 'EMPAQUE' and `delete`=0");
	$row_bols=mysql_fetch_assoc($rs_bols);
	$id_ins=$row_bols['id'];
	$cont=$row_bols['contenido'];
	$rs_disp=mysql_query("SELECT SUM(cantidad) as entradas FROM d89xz_total_medicinas_salidasins WHERE id_insumo='$id_ins' and hacienda='$filtro' and concep='entrada'",$conexion) or die(mysql_error());
	$row_rs_disp=mysql_fetch_assoc($rs_disp);
	$entradas=$row_rs_disp['entradas'];
	//salidas
	$rs_disp=mysql_query("SELECT SUM(cantidad) as salidas FROM d89xz_total_medicinas_salidasins WHERE id_insumo='$id_ins' and hacienda='$filtro' and concep='salida'",$conexion) or die(mysql_error());
	$row_rs_disp=mysql_fetch_assoc($rs_disp);
	$salidas=$row_rs_disp['salidas'];	
	//total
	$cant_disp=($entradas*$cont-$salidas);
}
	?>
    <input type="hidden" id="h_bolsas" value="<?php echo $cant_disp ?>"  />
    <input type="text" name="registro" id="bolsas" title="<?php echo 'Máximo '.number_format($cant_disp);  ?>"  onkeyup="verifica(this); funcion_maximos(this, <?php echo $cant_disp ?>)" />    </td>
    
  </tr>
  <tr class="bold">
    <td >Almas y Tacos</td>  
    <td >
    <?php
if(isset($_GET['filtro'])){
	$filtro=$_GET['filtro'];
	$rs_alms=mysql_query("SELECT id, contenido FROM d89xz_total_medicinasins WHERE tipo='ALMAS Y TACOS' and descripcion= 'ALMA Y TACO' and `delete`=0");
	$row_alms=mysql_fetch_assoc($rs_alms);
	$id_ins=$row_alms['id'];
	$cont=$row_alms['contenido'];
	$rs_disp=mysql_query("SELECT SUM(cantidad) as entradas FROM d89xz_total_medicinas_salidasins WHERE id_insumo='$id_ins' and hacienda='$filtro' and concep='entrada'",$conexion) or die(mysql_error());
	$row_rs_disp=mysql_fetch_assoc($rs_disp);
	$entradas=$row_rs_disp['entradas'];
	//salidas
	$rs_disp=mysql_query("SELECT SUM(cantidad) as salidas FROM d89xz_total_medicinas_salidasins WHERE id_insumo='$id_ins' and hacienda='$filtro' and concep='salida'",$conexion) or die(mysql_error());
	$row_rs_disp=mysql_fetch_assoc($rs_disp);
	$salidas=$row_rs_disp['salidas'];	
	//total
	$cant_disp=($entradas*$cont-$salidas);
}
	?>
    <input type="hidden" id="h_almas" value="<?php echo $cant_disp ?>"  />
    <input type="text" name="registro" id="almas" title="<?php echo 'Máximo '.number_format($cant_disp);  ?>"  onkeyup="verifica(this); funcion_maximos(this, <?php echo $cant_disp ?>)"/>   </td>
    <td >Mariposas   </td>
    <td ><?php
if(isset($_GET['filtro'])){
	$filtro=$_GET['filtro'];
	$rs_mars=mysql_query("SELECT id, contenido FROM d89xz_total_medicinasins WHERE tipo='MARIPOSA' and descripcion= 'EMPAQUE' and `delete`=0");
	$row_mars=mysql_fetch_assoc($rs_mars);
	$id_ins=$row_mars['id'];
	$cont=$row_mars['contenido'];
	$rs_disp=mysql_query("SELECT SUM(cantidad) as entradas FROM d89xz_total_medicinas_salidasins WHERE id_insumo='$id_ins' and hacienda='$filtro' and concep='entrada'",$conexion) or die(mysql_error());
	$row_rs_disp=mysql_fetch_assoc($rs_disp);
	$entradas=$row_rs_disp['entradas'];
	//salidas
	$rs_disp=mysql_query("SELECT SUM(cantidad) as salidas FROM d89xz_total_medicinas_salidasins WHERE id_insumo='$id_ins' and hacienda='$filtro' and concep='salida'",$conexion) or die(mysql_error());
	$row_rs_disp=mysql_fetch_assoc($rs_disp);
	$salidas=$row_rs_disp['salidas'];	
	//total
	$cant_disp=($entradas*$cont-$salidas);
}
	?><input type="hidden" id="h_mariposas" value="<?php echo $cant_disp ?>"  /><input type="text" name="registro" id="mariposas" title="<?php echo 'Máximo '.number_format($cant_disp);  ?>"  onkeyup="verifica(this); funcion_maximos(this, <?php echo $cant_disp ?>)"/>    </td>
    <td >Hormacuellos Largos   </td>
    <td ><?php
if(isset($_GET['filtro'])){
	$filtro=$_GET['filtro'];
	$rs_horl=mysql_query("SELECT id, contenido FROM d89xz_total_medicinasins WHERE tipo='HORMACUELLO' and nombre= 'LARGO' and `delete`=0");
	$row_horl=mysql_fetch_assoc($rs_horl);
	$id_ins=$row_horl['id'];
	$cont=$row_horl['contenido'];
	$rs_disp=mysql_query("SELECT SUM(cantidad) as entradas FROM d89xz_total_medicinas_salidasins WHERE id_insumo='$id_ins' and hacienda='$filtro' and concep='entrada'",$conexion) or die(mysql_error());
	$row_rs_disp=mysql_fetch_assoc($rs_disp);
	$entradas=$row_rs_disp['entradas'];
	//salidas
	$rs_disp=mysql_query("SELECT SUM(cantidad) as salidas FROM d89xz_total_medicinas_salidasins WHERE id_insumo='$id_ins' and hacienda='$filtro' and concep='salida'",$conexion) or die(mysql_error());
	$row_rs_disp=mysql_fetch_assoc($rs_disp);
	$salidas=$row_rs_disp['salidas'];	
	//total
	$cant_disp=($entradas*$cont-$salidas);
}
	?><input type="hidden" id="h_hormacuellos_l" value="<?php echo $cant_disp ?>"  />
    <input type="text" name="registro" id="hormacuellos_l" title="<?php echo 'Máximo '.number_format($cant_disp);  ?>"  onkeyup="verifica(this); funcion_maximos(this, <?php echo $cant_disp ?>)" />   </td>
    <td >Hormacuellos Pequeños    </td>
    <td ><?php
if(isset($_GET['filtro'])){
	$filtro=$_GET['filtro'];
	$rs_horP=mysql_query("SELECT id, contenido FROM d89xz_total_medicinasins WHERE tipo='HORMACUELLO' and nombre= 'PEQUEÑO' and `delete`=0");
	$row_horP=mysql_fetch_assoc($rs_horP);
	$id_ins=$row_horP['id'];
	$cont=$row_horP['contenido'];
	$rs_disp=mysql_query("SELECT SUM(cantidad) as entradas FROM d89xz_total_medicinas_salidasins WHERE id_insumo='$id_ins' and hacienda='$filtro' and concep='entrada'",$conexion) or die(mysql_error());
	$row_rs_disp=mysql_fetch_assoc($rs_disp);
	$entradas=$row_rs_disp['entradas'];
	//salidas
	$rs_disp=mysql_query("SELECT SUM(cantidad) as salidas FROM d89xz_total_medicinas_salidasins WHERE id_insumo='$id_ins' and hacienda='$filtro' and concep='salida'",$conexion) or die(mysql_error());
	$row_rs_disp=mysql_fetch_assoc($rs_disp);
	$salidas=$row_rs_disp['salidas'];	
	//total
	$cant_disp=($entradas*$cont-$salidas);
}
	?><input type="hidden" id="h_hormacuellos_p" value="<?php echo $cant_disp ?>"  />
    <input type="text" name="registro" id="hormacuellos_p" title="<?php echo 'Máximo '.number_format($cant_disp);  ?>"  onkeyup="verifica(this); funcion_maximos(this, <?php echo $cant_disp ?>)" />   </td>
  </tr>
  <tr class="bold">
    <td >Botones</td>   
    <td >
    
    <?php
if(isset($_GET['tipo_bots'])){
	$filtro=$_GET['filtro'];
	$id_bot=$_GET['tipo_bots'];
	$rs_12l=mysql_query("SELECT id, contenido FROM d89xz_total_medicinasins WHERE id='$id_bot' and `delete`=0");
	$row_12l=mysql_fetch_assoc($rs_12l);
	$id_ins=$row_12l['id'];
	$cont=$row_12l['contenido'];
	$rs_disp=mysql_query("SELECT SUM(cantidad) as entradas FROM d89xz_total_medicinas_salidasins WHERE id_insumo='$id_ins' and hacienda='$filtro' and concep='entrada'",$conexion) or die(mysql_error());
	$row_rs_disp=mysql_fetch_assoc($rs_disp);
	$entradas=$row_rs_disp['entradas'];
	//salidas
	$rs_disp=mysql_query("SELECT SUM(cantidad) as salidas FROM d89xz_total_medicinas_salidasins WHERE id_insumo='$id_ins' and hacienda='$filtro' and concep='salida'",$conexion) or die(mysql_error());
	$row_rs_disp=mysql_fetch_assoc($rs_disp);
	$salidas=$row_rs_disp['salidas'];	
	//total
	$cant_disp=($entradas*$cont-$salidas);
}
	?>
    <input type="hidden" id="h_botones" value="<?php echo $cant_disp ?>"  />
    <input type="text" name="registro" id="botones" title="<?php echo 'Máximo '.number_format($cant_disp);  ?>"  onkeyup="verifica(this); funcion_maximos(this, <?php echo $cant_disp ?>)"/>
   
    </td>
    <td >Botones Cuello</td>
    <td >
    <input type="text" name="registro" id="bot_cuello"   onkeyup="verifica(this); "/></td>
    <td >Marquillas(Composición)</td>
    <td ><div id="rec_marq_com"><?php
if(isset($_GET['filtro'])){
	$filtro=$_GET['filtro'];
	$id_ins=$_GET['id_ins'];
	$rs_desc=mysql_query("SELECT nombre FROM d89xz_total_medicinasins WHERE `delete`=0 and id='$id_ins'") or die(mysql_error());
	$row_desc=mysql_fetch_assoc($rs_desc);
	$desc=$row_desc['nombre'];
	$rs_marq=mysql_query("SELECT id, contenido FROM d89xz_total_medicinasins WHERE tipo='MARQUILLA' and descripcion= '$desc' and `delete`=0");
	$row_marq=mysql_fetch_assoc($rs_marq);
	$id_ins=$row_marq['id'];
	$cont=$row_marq['contenido'];
	$rs_disp=mysql_query("SELECT SUM(cantidad) as entradas FROM d89xz_total_medicinas_salidasins WHERE id_insumo='$id_ins' and hacienda='$filtro' and concep='entrada'",$conexion) or die(mysql_error());
	$row_rs_disp=mysql_fetch_assoc($rs_disp);
	$entradas=$row_rs_disp['entradas'];
	//salidas
	$rs_disp=mysql_query("SELECT SUM(cantidad) as salidas FROM d89xz_total_medicinas_salidasins WHERE id_insumo='$id_ins' and hacienda='$filtro' and concep='salida'",$conexion) or die(mysql_error());
	$row_rs_disp=mysql_fetch_assoc($rs_disp);
	$salidas=$row_rs_disp['salidas'];	
	//total
	$cant_disp=($entradas*$cont-$salidas);
}
	?>
    <input type="hidden" id="h_marquillas_c" value="<?php echo $cant_disp ?>"  />
    <input type="text" name="registro" id="marquillas_c" title="<?php echo 'Máximo '.number_format($cant_disp).'('.$desc.')';  ?>"  onkeyup="verifica(this); funcion_maximos(this, <?php echo $cant_disp ?>)" /></div></td>
    <td >Plumillas</td>
    <td ><?php
if(isset($_GET['filtro'])){
	$filtro=$_GET['filtro'];
	$rs_alms=mysql_query("SELECT id, contenido FROM d89xz_total_medicinasins WHERE tipo='PLUMILLA' and `delete`=0");
	$row_alms=mysql_fetch_assoc($rs_alms);
	$id_ins=$row_alms['id'];
	$cont=$row_alms['contenido'];
	$rs_disp=mysql_query("SELECT SUM(cantidad) as entradas FROM d89xz_total_medicinas_salidasins WHERE id_insumo='$id_ins' and hacienda='$filtro' and concep='entrada'",$conexion) or die(mysql_error());
	$row_rs_disp=mysql_fetch_assoc($rs_disp);
	$entradas=$row_rs_disp['entradas'];
	//salidas
	$rs_disp=mysql_query("SELECT SUM(cantidad) as salidas FROM d89xz_total_medicinas_salidasins WHERE id_insumo='$id_ins' and hacienda='$filtro' and concep='salida'",$conexion) or die(mysql_error());
	$row_rs_disp=mysql_fetch_assoc($rs_disp);
	$salidas=$row_rs_disp['salidas'];	
	//total
	$cant_disp=($entradas*$cont-$salidas);
}
	?>
    <input type="hidden" id="h_plumillas" value="<?php echo $cant_disp ?>"  />
    <input type="text" name="registro" id="plumillas" title="<?php echo 'Máximo '.number_format($cant_disp);  ?>"  onkeyup="verifica(this); funcion_maximos(this, <?php echo $cant_disp ?>)"/>   </td>
  </tr>
  <tr class="bold">
    <td >Cintas Colección</td>
    <td ><?php
if(isset($_GET['filtro'])){
	$filtro=$_GET['filtro'];
	$rs_c_col=mysql_query("SELECT id, contenido FROM d89xz_total_medicinasins WHERE tipo='CINTA' and nombre= 'COLECCION' and `delete`=0");
	$row_c_col=mysql_fetch_assoc($rs_c_col);
	$id_ins=$row_c_col['id'];
	$cont=$row_c_col['contenido'];
	$rs_disp=mysql_query("SELECT SUM(cantidad) as entradas FROM d89xz_total_medicinas_salidasins WHERE id_insumo='$id_ins' and hacienda='$filtro' and concep='entrada'",$conexion) or die(mysql_error());
	$row_rs_disp=mysql_fetch_assoc($rs_disp);
	$entradas=$row_rs_disp['entradas'];
	//salidas
	$rs_disp=mysql_query("SELECT SUM(cantidad) as salidas FROM d89xz_total_medicinas_salidasins WHERE id_insumo='$id_ins' and hacienda='$filtro' and concep='salida'",$conexion) or die(mysql_error());
	$row_rs_disp=mysql_fetch_assoc($rs_disp);
	$salidas=$row_rs_disp['salidas'];	
	//total
	$cant_disp=($entradas*$cont-$salidas);
}
	?><input type="hidden" id="h_c_coleccion" value="<?php echo $cant_disp ?>"  /><input type="text" name="registro" id="c_coleccion" title="<?php echo 'Máximo '.number_format($cant_disp);  ?>"  onkeyup="verifica(this); funcion_maximos(this, <?php echo $cant_disp ?>)"/></td>
    <td >Cintas Exclusiva</td>
    <td ><?php
if(isset($_GET['filtro'])){
	$filtro=$_GET['filtro'];
	$rs_c_exc=mysql_query("SELECT id, contenido FROM d89xz_total_medicinasins WHERE tipo='CINTA' and nombre= 'EXCLUSIVA' and `delete`=0");
	$row_c_exc=mysql_fetch_assoc($rs_c_exc);
	$id_ins=$row_c_exc['id'];
	$cont=$row_c_exc['contenido'];
	$rs_disp=mysql_query("SELECT SUM(cantidad) as entradas FROM d89xz_total_medicinas_salidasins WHERE id_insumo='$id_ins' and hacienda='$filtro' and concep='entrada'",$conexion) or die(mysql_error());
	$row_rs_disp=mysql_fetch_assoc($rs_disp);
	$entradas=$row_rs_disp['entradas'];
	//salidas
	$rs_disp=mysql_query("SELECT SUM(cantidad) as salidas FROM d89xz_total_medicinas_salidasins WHERE id_insumo='$id_ins' and hacienda='$filtro' and concep='salida'",$conexion) or die(mysql_error());
	$row_rs_disp=mysql_fetch_assoc($rs_disp);
	$salidas=$row_rs_disp['salidas'];	
	//total
	$cant_disp=($entradas*$cont-$salidas);
}
	?><input type="hidden" id="h_c_exclusiva" value="<?php echo $cant_disp ?>"  /><input type="text" name="registro" id="c_exclusiva" title="<?php echo 'Máximo '.number_format($cant_disp);  ?>"  onkeyup="verifica(this); funcion_maximos(this, <?php echo $cant_disp ?>)"/></td>
    <td >Cintas Royal</td>
    <td ><?php
if(isset($_GET['filtro'])){
	$filtro=$_GET['filtro'];
	$rs_c_roy=mysql_query("SELECT id, contenido FROM d89xz_total_medicinasins WHERE tipo='CINTA' and nombre= 'ROYAL' and `delete`=0");
	$row_c_roy=mysql_fetch_assoc($rs_c_roy);
	$id_ins=$row_c_roy['id'];
	$cont=$row_c_roy['contenido'];
	$rs_disp=mysql_query("SELECT SUM(cantidad) as entradas FROM d89xz_total_medicinas_salidasins WHERE id_insumo='$id_ins' and hacienda='$filtro' and concep='entrada'",$conexion) or die(mysql_error());
	$row_rs_disp=mysql_fetch_assoc($rs_disp);
	$entradas=$row_rs_disp['entradas'];
	//salidas
	$rs_disp=mysql_query("SELECT SUM(cantidad) as salidas FROM d89xz_total_medicinas_salidasins WHERE id_insumo='$id_ins' and hacienda='$filtro' and concep='salida'",$conexion) or die(mysql_error());
	$row_rs_disp=mysql_fetch_assoc($rs_disp);
	$salidas=$row_rs_disp['salidas'];	
	//total
	$cant_disp=($entradas*$cont-$salidas);
}
	?><input type="hidden" id="h_c_royal" value="<?php echo $cant_disp ?>"  /><input type="text" name="registro" id="c_royal" title="<?php echo 'Máximo '.number_format($cant_disp);  ?>"  onkeyup="verifica(this); funcion_maximos(this, <?php echo $cant_disp ?>)"/></td>
    <td >&nbsp;</td>
    <td >&nbsp;</td>
  </tr>
  <tr class="bold">
    <td >Etiquetas Colección</td>
    <td ><?php
if(isset($_GET['filtro'])){
	$filtro=$_GET['filtro'];
	$rs_e_col=mysql_query("SELECT id, contenido FROM d89xz_total_medicinasins WHERE tipo='ETIQUETA' and nombre= 'COLECCION' and `delete`=0");
	$row_e_col=mysql_fetch_assoc($rs_e_col);
	$id_ins=$row_e_col['id'];
	$cont=$row_e_col['contenido'];
	$rs_disp=mysql_query("SELECT SUM(cantidad) as entradas FROM d89xz_total_medicinas_salidasins WHERE id_insumo='$id_ins' and hacienda='$filtro' and concep='entrada'",$conexion) or die(mysql_error());
	$row_rs_disp=mysql_fetch_assoc($rs_disp);
	$entradas=$row_rs_disp['entradas'];
	//salidas
	$rs_disp=mysql_query("SELECT SUM(cantidad) as salidas FROM d89xz_total_medicinas_salidasins WHERE id_insumo='$id_ins' and hacienda='$filtro' and concep='salida'",$conexion) or die(mysql_error());
	$row_rs_disp=mysql_fetch_assoc($rs_disp);
	$salidas=$row_rs_disp['salidas'];	
	//total
	$cant_disp=($entradas*$cont-$salidas);
}
	?><input type="hidden" id="h_e_coleccion" value="<?php echo $cant_disp ?>"  /><input type="text" name="registro" id="e_coleccion" title="<?php echo 'Máximo '.number_format($cant_disp);  ?>"  onkeyup="verifica(this); funcion_maximos(this, <?php echo $cant_disp ?>)"/></td>
    <td >Etiquetas Exclusiva</td>
    <td ><?php
if(isset($_GET['filtro'])){
	$filtro=$_GET['filtro'];
	$rs_e_exc=mysql_query("SELECT id, contenido FROM d89xz_total_medicinasins WHERE tipo='ETIQUETA' and nombre= 'EXCLUSIVA' and `delete`=0");
	$row_e_exc=mysql_fetch_assoc($rs_e_exc);
	$id_ins=$row_e_exc['id'];
	$cont=$row_e_exc['contenido'];
	$rs_disp=mysql_query("SELECT SUM(cantidad) as entradas FROM d89xz_total_medicinas_salidasins WHERE id_insumo='$id_ins' and hacienda='$filtro' and concep='entrada'",$conexion) or die(mysql_error());
	$row_rs_disp=mysql_fetch_assoc($rs_disp);
	$entradas=$row_rs_disp['entradas'];
	//salidas
	$rs_disp=mysql_query("SELECT SUM(cantidad) as salidas FROM d89xz_total_medicinas_salidasins WHERE id_insumo='$id_ins' and hacienda='$filtro' and concep='salida'",$conexion) or die(mysql_error());
	$row_rs_disp=mysql_fetch_assoc($rs_disp);
	$salidas=$row_rs_disp['salidas'];	
	//total
	$cant_disp=($entradas*$cont-$salidas);
}
	?><input type="hidden" id="h_e_exclusiva" value="<?php echo $cant_disp ?>"  /><input type="text" name="registro" id="e_exclusiva" title="<?php echo 'Máximo '.number_format($cant_disp);  ?>"  onkeyup="verifica(this); funcion_maximos(this, <?php echo $cant_disp ?>)"/></td>
    <td >Etiquetas Royal</td>
    <td ><?php
if(isset($_GET['filtro'])){
	$filtro=$_GET['filtro'];
	$rs_e_roy=mysql_query("SELECT id, contenido FROM d89xz_total_medicinasins WHERE tipo='ETIQUETA' and nombre= 'ROYAL' and `delete`=0");
	$row_e_roy=mysql_fetch_assoc($rs_e_roy);
	$id_ins=$row_e_roy['id'];
	$cont=$row_e_roy['contenido'];
	$rs_disp=mysql_query("SELECT SUM(cantidad) as entradas FROM d89xz_total_medicinas_salidasins WHERE id_insumo='$id_ins' and hacienda='$filtro' and concep='entrada'",$conexion) or die(mysql_error());
	$row_rs_disp=mysql_fetch_assoc($rs_disp);
	$entradas=$row_rs_disp['entradas'];
	//salidas
	$rs_disp=mysql_query("SELECT SUM(cantidad) as salidas FROM d89xz_total_medicinas_salidasins WHERE id_insumo='$id_ins' and hacienda='$filtro' and concep='salida'",$conexion) or die(mysql_error());
	$row_rs_disp=mysql_fetch_assoc($rs_disp);
	$salidas=$row_rs_disp['salidas'];	
	//total
	$cant_disp=($entradas*$cont-$salidas);
}
	?><input type="hidden" id="h_e_royal" value="<?php echo $cant_disp ?>"  /><input type="text" name="registro" id="e_royal" title="<?php echo 'Máximo '.number_format($cant_disp);  ?>"  onkeyup="verifica(this); funcion_maximos(this, <?php echo $cant_disp ?>)"/></td>
    
    
    <td colspan="2" ><?php
if(isset($_GET['filtro'])){
	$filtro=$_GET['filtro'];
	$rs_mar=mysql_query("SELECT id, contenido FROM d89xz_total_medicinasins WHERE tipo='MARQUILLA' and nombre= 'COLECCION' and descripcion='TALLA 37 SLIM' and `delete`=0");
	$row_mar=mysql_fetch_assoc($rs_mar);
	$id_ins=$row_mar['id'];
	$cont=$row_mar['contenido'];
	$rs_disp=mysql_query("SELECT SUM(cantidad) as entradas FROM d89xz_total_medicinas_salidasins WHERE id_insumo='$id_ins' and hacienda='$filtro' and concep='entrada'",$conexion) or die(mysql_error());
	$row_rs_disp=mysql_fetch_assoc($rs_disp);
	$entradas=$row_rs_disp['entradas'];
	$rs_disp=mysql_query("SELECT SUM(cantidad) as salidas FROM d89xz_total_medicinas_salidasins WHERE id_insumo='$id_ins' and hacienda='$filtro' and concep='salida'",$conexion) or die(mysql_error());
	$row_rs_disp=mysql_fetch_assoc($rs_disp);
	$salidas=$row_rs_disp['salidas'];	
	$cant_disp=($entradas*$cont-$salidas);
?>
  <input type="hidden" id="col_sl37" value="<?php echo $cant_disp ?>"  />
  <?php
  $rs_mar=mysql_query("SELECT id, contenido FROM d89xz_total_medicinasins WHERE tipo='MARQUILLA' and nombre= 'COLECCION' and descripcion='TALLA 38 SLIM' and `delete`=0");
	$row_mar=mysql_fetch_assoc($rs_mar);
	$id_ins=$row_mar['id'];
	$cont=$row_mar['contenido'];
	$rs_disp=mysql_query("SELECT SUM(cantidad) as entradas FROM d89xz_total_medicinas_salidasins WHERE id_insumo='$id_ins' and hacienda='$filtro' and concep='entrada'",$conexion) or die(mysql_error());
	$row_rs_disp=mysql_fetch_assoc($rs_disp);
	$entradas=$row_rs_disp['entradas'];
	$rs_disp=mysql_query("SELECT SUM(cantidad) as salidas FROM d89xz_total_medicinas_salidasins WHERE id_insumo='$id_ins' and hacienda='$filtro' and concep='salida'",$conexion) or die(mysql_error());
	$row_rs_disp=mysql_fetch_assoc($rs_disp);
	$salidas=$row_rs_disp['salidas'];	
	$cant_disp=($entradas*$cont-$salidas);
?>
      <input type="hidden" id="col_sl38" value="<?php echo $cant_disp ?>"  />
      <?php
	  $rs_mar=mysql_query("SELECT id, contenido FROM d89xz_total_medicinasins WHERE tipo='MARQUILLA' and nombre= 'COLECCION' and descripcion='TALLA 39 SLIM' and `delete`=0");
	$row_mar=mysql_fetch_assoc($rs_mar);
	$id_ins=$row_mar['id'];
	$cont=$row_mar['contenido'];
	$rs_disp=mysql_query("SELECT SUM(cantidad) as entradas FROM d89xz_total_medicinas_salidasins WHERE id_insumo='$id_ins' and hacienda='$filtro' and concep='entrada'",$conexion) or die(mysql_error());
	$row_rs_disp=mysql_fetch_assoc($rs_disp);
	$entradas=$row_rs_disp['entradas'];
	$rs_disp=mysql_query("SELECT SUM(cantidad) as salidas FROM d89xz_total_medicinas_salidasins WHERE id_insumo='$id_ins' and hacienda='$filtro' and concep='salida'",$conexion) or die(mysql_error());
	$row_rs_disp=mysql_fetch_assoc($rs_disp);
	$salidas=$row_rs_disp['salidas'];	
	$cant_disp=($entradas*$cont-$salidas);
?>
      <input type="hidden" id="col_sl39" value="<?php echo $cant_disp ?>"  />
      <?php
	  $rs_mar=mysql_query("SELECT id, contenido FROM d89xz_total_medicinasins WHERE tipo='MARQUILLA' and nombre= 'COLECCION' and descripcion='TALLA 40 SLIM' and `delete`=0");
	$row_mar=mysql_fetch_assoc($rs_mar);
	$id_ins=$row_mar['id'];
	$cont=$row_mar['contenido'];
	$rs_disp=mysql_query("SELECT SUM(cantidad) as entradas FROM d89xz_total_medicinas_salidasins WHERE id_insumo='$id_ins' and hacienda='$filtro' and concep='entrada'",$conexion) or die(mysql_error());
	$row_rs_disp=mysql_fetch_assoc($rs_disp);
	$entradas=$row_rs_disp['entradas'];
	$rs_disp=mysql_query("SELECT SUM(cantidad) as salidas FROM d89xz_total_medicinas_salidasins WHERE id_insumo='$id_ins' and hacienda='$filtro' and concep='salida'",$conexion) or die(mysql_error());
	$row_rs_disp=mysql_fetch_assoc($rs_disp);
	$salidas=$row_rs_disp['salidas'];	
	$cant_disp=($entradas*$cont-$salidas);
?>
      <input type="hidden" id="col_sl40" value="<?php echo $cant_disp ?>"  />
      <?php
	  $rs_mar=mysql_query("SELECT id, contenido FROM d89xz_total_medicinasins WHERE tipo='MARQUILLA' and nombre= 'COLECCION' and descripcion='TALLA 41 SLIM' and `delete`=0");
	$row_mar=mysql_fetch_assoc($rs_mar);
	$id_ins=$row_mar['id'];
	$cont=$row_mar['contenido'];
	$rs_disp=mysql_query("SELECT SUM(cantidad) as entradas FROM d89xz_total_medicinas_salidasins WHERE id_insumo='$id_ins' and hacienda='$filtro' and concep='entrada'",$conexion) or die(mysql_error());
	$row_rs_disp=mysql_fetch_assoc($rs_disp);
	$entradas=$row_rs_disp['entradas'];
	$rs_disp=mysql_query("SELECT SUM(cantidad) as salidas FROM d89xz_total_medicinas_salidasins WHERE id_insumo='$id_ins' and hacienda='$filtro' and concep='salida'",$conexion) or die(mysql_error());
	$row_rs_disp=mysql_fetch_assoc($rs_disp);
	$salidas=$row_rs_disp['salidas'];	
	$cant_disp=($entradas*$cont-$salidas);
?>
      <input type="hidden" id="col_sl41" value="<?php echo $cant_disp ?>"  />
      <?php
	  $rs_mar=mysql_query("SELECT id, contenido FROM d89xz_total_medicinasins WHERE tipo='MARQUILLA' and nombre= 'COLECCION' and descripcion='TALLA 42 SLIM' and `delete`=0");
	$row_mar=mysql_fetch_assoc($rs_mar);
	$id_ins=$row_mar['id'];
	$cont=$row_mar['contenido'];
	$rs_disp=mysql_query("SELECT SUM(cantidad) as entradas FROM d89xz_total_medicinas_salidasins WHERE id_insumo='$id_ins' and hacienda='$filtro' and concep='entrada'",$conexion) or die(mysql_error());
	$row_rs_disp=mysql_fetch_assoc($rs_disp);
	$entradas=$row_rs_disp['entradas'];
	$rs_disp=mysql_query("SELECT SUM(cantidad) as salidas FROM d89xz_total_medicinas_salidasins WHERE id_insumo='$id_ins' and hacienda='$filtro' and concep='salida'",$conexion) or die(mysql_error());
	$row_rs_disp=mysql_fetch_assoc($rs_disp);
	$salidas=$row_rs_disp['salidas'];	
	$cant_disp=($entradas*$cont-$salidas);
?>
      <input type="hidden" id="col_sl42" value="<?php echo $cant_disp ?>"  />
      <?php
	  $rs_mar=mysql_query("SELECT id, contenido FROM d89xz_total_medicinasins WHERE tipo='MARQUILLA' and nombre= 'COLECCION' and descripcion='TALLA 44 SLIM' and `delete`=0");
	$row_mar=mysql_fetch_assoc($rs_mar);
	$id_ins=$row_mar['id'];
	$cont=$row_mar['contenido'];
	$rs_disp=mysql_query("SELECT SUM(cantidad) as entradas FROM d89xz_total_medicinas_salidasins WHERE id_insumo='$id_ins' and hacienda='$filtro' and concep='entrada'",$conexion) or die(mysql_error());
	$row_rs_disp=mysql_fetch_assoc($rs_disp);
	$entradas=$row_rs_disp['entradas'];
	$rs_disp=mysql_query("SELECT SUM(cantidad) as salidas FROM d89xz_total_medicinas_salidasins WHERE id_insumo='$id_ins' and hacienda='$filtro' and concep='salida'",$conexion) or die(mysql_error());
	$row_rs_disp=mysql_fetch_assoc($rs_disp);
	$salidas=$row_rs_disp['salidas'];	
	$cant_disp=($entradas*$cont-$salidas);
?>
      <input type="hidden" id="col_sl44" value="<?php echo $cant_disp ?>"  />
      <?php
	  $rs_mar=mysql_query("SELECT id, contenido FROM d89xz_total_medicinasins WHERE tipo='MARQUILLA' and nombre= 'COLECCION' and descripcion='TALLA 46 SLIM' and `delete`=0");
	$row_mar=mysql_fetch_assoc($rs_mar);
	$id_ins=$row_mar['id'];
	$cont=$row_mar['contenido'];
	$rs_disp=mysql_query("SELECT SUM(cantidad) as entradas FROM d89xz_total_medicinas_salidasins WHERE id_insumo='$id_ins' and hacienda='$filtro' and concep='entrada'",$conexion) or die(mysql_error());
	$row_rs_disp=mysql_fetch_assoc($rs_disp);
	$entradas=$row_rs_disp['entradas'];
	$rs_disp=mysql_query("SELECT SUM(cantidad) as salidas FROM d89xz_total_medicinas_salidasins WHERE id_insumo='$id_ins' and hacienda='$filtro' and concep='salida'",$conexion) or die(mysql_error());
	$row_rs_disp=mysql_fetch_assoc($rs_disp);
	$salidas=$row_rs_disp['salidas'];	
	$cant_disp=($entradas*$cont-$salidas);
?>
      <input type="hidden" id="col_sl46" value="<?php echo $cant_disp ?>"  />
      
      <?php $rs_mar=mysql_query("SELECT id, contenido FROM d89xz_total_medicinasins WHERE tipo='MARQUILLA' and nombre= 'COLECCION' and descripcion='TALLA 37' and `delete`=0");
	$row_mar=mysql_fetch_assoc($rs_mar);
	$id_ins=$row_mar['id'];
	$cont=$row_mar['contenido'];
	$rs_disp=mysql_query("SELECT SUM(cantidad) as entradas FROM d89xz_total_medicinas_salidasins WHERE id_insumo='$id_ins' and hacienda='$filtro' and concep='entrada'",$conexion) or die(mysql_error());
	$row_rs_disp=mysql_fetch_assoc($rs_disp);
	$entradas=$row_rs_disp['entradas'];
	$rs_disp=mysql_query("SELECT SUM(cantidad) as salidas FROM d89xz_total_medicinas_salidasins WHERE id_insumo='$id_ins' and hacienda='$filtro' and concep='salida'",$conexion) or die(mysql_error());
	$row_rs_disp=mysql_fetch_assoc($rs_disp);
	$salidas=$row_rs_disp['salidas'];	
	$cant_disp=($entradas*$cont-$salidas);
?>
      <input type="hidden" id="col_cl37" value="<?php echo $cant_disp ?>"  />
      <?php $rs_mar=mysql_query("SELECT id, contenido FROM d89xz_total_medicinasins WHERE tipo='MARQUILLA' and nombre= 'COLECCION' and descripcion='TALLA 38' and `delete`=0");
	$row_mar=mysql_fetch_assoc($rs_mar);
	$id_ins=$row_mar['id'];
	$cont=$row_mar['contenido'];
	$rs_disp=mysql_query("SELECT SUM(cantidad) as entradas FROM d89xz_total_medicinas_salidasins WHERE id_insumo='$id_ins' and hacienda='$filtro' and concep='entrada'",$conexion) or die(mysql_error());
	$row_rs_disp=mysql_fetch_assoc($rs_disp);
	$entradas=$row_rs_disp['entradas'];
	$rs_disp=mysql_query("SELECT SUM(cantidad) as salidas FROM d89xz_total_medicinas_salidasins WHERE id_insumo='$id_ins' and hacienda='$filtro' and concep='salida'",$conexion) or die(mysql_error());
	$row_rs_disp=mysql_fetch_assoc($rs_disp);
	$salidas=$row_rs_disp['salidas'];	
	$cant_disp=($entradas*$cont-$salidas);
?>
      <input type="hidden" id="col_cl38" value="<?php echo $cant_disp ?>"  />
      <?php $rs_mar=mysql_query("SELECT id, contenido FROM d89xz_total_medicinasins WHERE tipo='MARQUILLA' and nombre= 'COLECCION' and descripcion='TALLA 39' and `delete`=0");
	$row_mar=mysql_fetch_assoc($rs_mar);
	$id_ins=$row_mar['id'];
	$cont=$row_mar['contenido'];
	$rs_disp=mysql_query("SELECT SUM(cantidad) as entradas FROM d89xz_total_medicinas_salidasins WHERE id_insumo='$id_ins' and hacienda='$filtro' and concep='entrada'",$conexion) or die(mysql_error());
	$row_rs_disp=mysql_fetch_assoc($rs_disp);
	$entradas=$row_rs_disp['entradas'];
	$rs_disp=mysql_query("SELECT SUM(cantidad) as salidas FROM d89xz_total_medicinas_salidasins WHERE id_insumo='$id_ins' and hacienda='$filtro' and concep='salida'",$conexion) or die(mysql_error());
	$row_rs_disp=mysql_fetch_assoc($rs_disp);
	$salidas=$row_rs_disp['salidas'];	
	$cant_disp=($entradas*$cont-$salidas);
?>
      <input type="hidden" id="col_cl39" value="<?php echo $cant_disp ?>"  />
      <?php $rs_mar=mysql_query("SELECT id, contenido FROM d89xz_total_medicinasins WHERE tipo='MARQUILLA' and nombre= 'COLECCION' and descripcion='TALLA 40' and `delete`=0");
	$row_mar=mysql_fetch_assoc($rs_mar);
	$id_ins=$row_mar['id'];
	$cont=$row_mar['contenido'];
	$rs_disp=mysql_query("SELECT SUM(cantidad) as entradas FROM d89xz_total_medicinas_salidasins WHERE id_insumo='$id_ins' and hacienda='$filtro' and concep='entrada'",$conexion) or die(mysql_error());
	$row_rs_disp=mysql_fetch_assoc($rs_disp);
	$entradas=$row_rs_disp['entradas'];
	$rs_disp=mysql_query("SELECT SUM(cantidad) as salidas FROM d89xz_total_medicinas_salidasins WHERE id_insumo='$id_ins' and hacienda='$filtro' and concep='salida'",$conexion) or die(mysql_error());
	$row_rs_disp=mysql_fetch_assoc($rs_disp);
	$salidas=$row_rs_disp['salidas'];	
	$cant_disp=($entradas*$cont-$salidas);
?>
      <input type="hidden" id="col_cl40" value="<?php echo $cant_disp ?>"  />
      <?php $rs_mar=mysql_query("SELECT id, contenido FROM d89xz_total_medicinasins WHERE tipo='MARQUILLA' and nombre= 'COLECCION' and descripcion='TALLA 41' and `delete`=0");
	$row_mar=mysql_fetch_assoc($rs_mar);
	$id_ins=$row_mar['id'];
	$cont=$row_mar['contenido'];
	$rs_disp=mysql_query("SELECT SUM(cantidad) as entradas FROM d89xz_total_medicinas_salidasins WHERE id_insumo='$id_ins' and hacienda='$filtro' and concep='entrada'",$conexion) or die(mysql_error());
	$row_rs_disp=mysql_fetch_assoc($rs_disp);
	$entradas=$row_rs_disp['entradas'];
	$rs_disp=mysql_query("SELECT SUM(cantidad) as salidas FROM d89xz_total_medicinas_salidasins WHERE id_insumo='$id_ins' and hacienda='$filtro' and concep='salida'",$conexion) or die(mysql_error());
	$row_rs_disp=mysql_fetch_assoc($rs_disp);
	$salidas=$row_rs_disp['salidas'];	
	$cant_disp=($entradas*$cont-$salidas);
?>
      <input type="hidden" id="col_cl41" value="<?php echo $cant_disp ?>"  />
      <?php $rs_mar=mysql_query("SELECT id, contenido FROM d89xz_total_medicinasins WHERE tipo='MARQUILLA' and nombre= 'COLECCION' and descripcion='TALLA 42' and `delete`=0");
	$row_mar=mysql_fetch_assoc($rs_mar);
	$id_ins=$row_mar['id'];
	$cont=$row_mar['contenido'];
	$rs_disp=mysql_query("SELECT SUM(cantidad) as entradas FROM d89xz_total_medicinas_salidasins WHERE id_insumo='$id_ins' and hacienda='$filtro' and concep='entrada'",$conexion) or die(mysql_error());
	$row_rs_disp=mysql_fetch_assoc($rs_disp);
	$entradas=$row_rs_disp['entradas'];
	$rs_disp=mysql_query("SELECT SUM(cantidad) as salidas FROM d89xz_total_medicinas_salidasins WHERE id_insumo='$id_ins' and hacienda='$filtro' and concep='salida'",$conexion) or die(mysql_error());
	$row_rs_disp=mysql_fetch_assoc($rs_disp);
	$salidas=$row_rs_disp['salidas'];	
	$cant_disp=($entradas*$cont-$salidas);
?>
      <input type="hidden" id="col_cl42" value="<?php echo $cant_disp ?>"  />
      <?php $rs_mar=mysql_query("SELECT id, contenido FROM d89xz_total_medicinasins WHERE tipo='MARQUILLA' and nombre= 'COLECCION' and descripcion='TALLA 44' and `delete`=0");
	$row_mar=mysql_fetch_assoc($rs_mar);
	$id_ins=$row_mar['id'];
	$cont=$row_mar['contenido'];
	$rs_disp=mysql_query("SELECT SUM(cantidad) as entradas FROM d89xz_total_medicinas_salidasins WHERE id_insumo='$id_ins' and hacienda='$filtro' and concep='entrada'",$conexion) or die(mysql_error());
	$row_rs_disp=mysql_fetch_assoc($rs_disp);
	$entradas=$row_rs_disp['entradas'];
	$rs_disp=mysql_query("SELECT SUM(cantidad) as salidas FROM d89xz_total_medicinas_salidasins WHERE id_insumo='$id_ins' and hacienda='$filtro' and concep='salida'",$conexion) or die(mysql_error());
	$row_rs_disp=mysql_fetch_assoc($rs_disp);
	$salidas=$row_rs_disp['salidas'];	
	$cant_disp=($entradas*$cont-$salidas);
?>
      <input type="hidden" id="col_cl44" value="<?php echo $cant_disp ?>"  />
      <?php $rs_mar=mysql_query("SELECT id, contenido FROM d89xz_total_medicinasins WHERE tipo='MARQUILLA' and nombre= 'COLECCION' and descripcion='TALLA 46' and `delete`=0");
	$row_mar=mysql_fetch_assoc($rs_mar);
	$id_ins=$row_mar['id'];
	$cont=$row_mar['contenido'];
	$rs_disp=mysql_query("SELECT SUM(cantidad) as entradas FROM d89xz_total_medicinas_salidasins WHERE id_insumo='$id_ins' and hacienda='$filtro' and concep='entrada'",$conexion) or die(mysql_error());
	$row_rs_disp=mysql_fetch_assoc($rs_disp);
	$entradas=$row_rs_disp['entradas'];
	$rs_disp=mysql_query("SELECT SUM(cantidad) as salidas FROM d89xz_total_medicinas_salidasins WHERE id_insumo='$id_ins' and hacienda='$filtro' and concep='salida'",$conexion) or die(mysql_error());
	$row_rs_disp=mysql_fetch_assoc($rs_disp);
	$salidas=$row_rs_disp['salidas'];	
	$cant_disp=($entradas*$cont-$salidas);
?>
      <input type="hidden" id="col_cl46" value="<?php echo $cant_disp ?>"  />
      
      <?php $rs_mar=mysql_query("SELECT id, contenido FROM d89xz_total_medicinasins WHERE tipo='MARQUILLA' and nombre= 'EXCLUSIVA' and descripcion='TALLA 37 SLIM' and `delete`=0");
	$row_mar=mysql_fetch_assoc($rs_mar);
	$id_ins=$row_mar['id'];
	$cont=$row_mar['contenido'];
	$rs_disp=mysql_query("SELECT SUM(cantidad) as entradas FROM d89xz_total_medicinas_salidasins WHERE id_insumo='$id_ins' and hacienda='$filtro' and concep='entrada'",$conexion) or die(mysql_error());
	$row_rs_disp=mysql_fetch_assoc($rs_disp);
	$entradas=$row_rs_disp['entradas'];
	$rs_disp=mysql_query("SELECT SUM(cantidad) as salidas FROM d89xz_total_medicinas_salidasins WHERE id_insumo='$id_ins' and hacienda='$filtro' and concep='salida'",$conexion) or die(mysql_error());
	$row_rs_disp=mysql_fetch_assoc($rs_disp);
	$salidas=$row_rs_disp['salidas'];	
	$cant_disp=($entradas*$cont-$salidas);
?>
      <input type="hidden" id="exc_sl37" value="<?php echo $cant_disp ?>"  />
      <?php $rs_mar=mysql_query("SELECT id, contenido FROM d89xz_total_medicinasins WHERE tipo='MARQUILLA' and nombre= 'EXCLUSIVA' and descripcion='TALLA 38 SLIM' and `delete`=0");
	$row_mar=mysql_fetch_assoc($rs_mar);
	$id_ins=$row_mar['id'];
	$cont=$row_mar['contenido'];
	$rs_disp=mysql_query("SELECT SUM(cantidad) as entradas FROM d89xz_total_medicinas_salidasins WHERE id_insumo='$id_ins' and hacienda='$filtro' and concep='entrada'",$conexion) or die(mysql_error());
	$row_rs_disp=mysql_fetch_assoc($rs_disp);
	$entradas=$row_rs_disp['entradas'];
	$rs_disp=mysql_query("SELECT SUM(cantidad) as salidas FROM d89xz_total_medicinas_salidasins WHERE id_insumo='$id_ins' and hacienda='$filtro' and concep='salida'",$conexion) or die(mysql_error());
	$row_rs_disp=mysql_fetch_assoc($rs_disp);
	$salidas=$row_rs_disp['salidas'];	
	$cant_disp=($entradas*$cont-$salidas);
?>
      <input type="hidden" id="exc_sl38" value="<?php echo $cant_disp ?>"  />
      <?php $rs_mar=mysql_query("SELECT id, contenido FROM d89xz_total_medicinasins WHERE tipo='MARQUILLA' and nombre= 'EXCLUSIVA' and descripcion='TALLA 39 SLIM' and `delete`=0");
	$row_mar=mysql_fetch_assoc($rs_mar);
	$id_ins=$row_mar['id'];
	$cont=$row_mar['contenido'];
	$rs_disp=mysql_query("SELECT SUM(cantidad) as entradas FROM d89xz_total_medicinas_salidasins WHERE id_insumo='$id_ins' and hacienda='$filtro' and concep='entrada'",$conexion) or die(mysql_error());
	$row_rs_disp=mysql_fetch_assoc($rs_disp);
	$entradas=$row_rs_disp['entradas'];
	$rs_disp=mysql_query("SELECT SUM(cantidad) as salidas FROM d89xz_total_medicinas_salidasins WHERE id_insumo='$id_ins' and hacienda='$filtro' and concep='salida'",$conexion) or die(mysql_error());
	$row_rs_disp=mysql_fetch_assoc($rs_disp);
	$salidas=$row_rs_disp['salidas'];	
	$cant_disp=($entradas*$cont-$salidas);
?>
      <input type="hidden" id="exc_sl39" value="<?php echo $cant_disp ?>"  />
      <?php $rs_mar=mysql_query("SELECT id, contenido FROM d89xz_total_medicinasins WHERE tipo='MARQUILLA' and nombre= 'EXCLUSIVA' and descripcion='TALLA 40 SLIM' and `delete`=0");
	$row_mar=mysql_fetch_assoc($rs_mar);
	$id_ins=$row_mar['id'];
	$cont=$row_mar['contenido'];
	$rs_disp=mysql_query("SELECT SUM(cantidad) as entradas FROM d89xz_total_medicinas_salidasins WHERE id_insumo='$id_ins' and hacienda='$filtro' and concep='entrada'",$conexion) or die(mysql_error());
	$row_rs_disp=mysql_fetch_assoc($rs_disp);
	$entradas=$row_rs_disp['entradas'];
	$rs_disp=mysql_query("SELECT SUM(cantidad) as salidas FROM d89xz_total_medicinas_salidasins WHERE id_insumo='$id_ins' and hacienda='$filtro' and concep='salida'",$conexion) or die(mysql_error());
	$row_rs_disp=mysql_fetch_assoc($rs_disp);
	$salidas=$row_rs_disp['salidas'];	
	$cant_disp=($entradas*$cont-$salidas);
?>
      <input type="hidden" id="exc_sl40" value="<?php echo $cant_disp ?>"  />
      <?php $rs_mar=mysql_query("SELECT id, contenido FROM d89xz_total_medicinasins WHERE tipo='MARQUILLA' and nombre= 'EXCLUSIVA' and descripcion='TALLA 41 SLIM' and `delete`=0");
	$row_mar=mysql_fetch_assoc($rs_mar);
	$id_ins=$row_mar['id'];
	$cont=$row_mar['contenido'];
	$rs_disp=mysql_query("SELECT SUM(cantidad) as entradas FROM d89xz_total_medicinas_salidasins WHERE id_insumo='$id_ins' and hacienda='$filtro' and concep='entrada'",$conexion) or die(mysql_error());
	$row_rs_disp=mysql_fetch_assoc($rs_disp);
	$entradas=$row_rs_disp['entradas'];
	$rs_disp=mysql_query("SELECT SUM(cantidad) as salidas FROM d89xz_total_medicinas_salidasins WHERE id_insumo='$id_ins' and hacienda='$filtro' and concep='salida'",$conexion) or die(mysql_error());
	$row_rs_disp=mysql_fetch_assoc($rs_disp);
	$salidas=$row_rs_disp['salidas'];	
	$cant_disp=($entradas*$cont-$salidas);
?>
      <input type="hidden" id="exc_sl41" value="<?php echo $cant_disp ?>"  />
      <?php $rs_mar=mysql_query("SELECT id, contenido FROM d89xz_total_medicinasins WHERE tipo='MARQUILLA' and nombre= 'EXCLUSIVA' and descripcion='TALLA 42 SLIM' and `delete`=0");
	$row_mar=mysql_fetch_assoc($rs_mar);
	$id_ins=$row_mar['id'];
	$cont=$row_mar['contenido'];
	$rs_disp=mysql_query("SELECT SUM(cantidad) as entradas FROM d89xz_total_medicinas_salidasins WHERE id_insumo='$id_ins' and hacienda='$filtro' and concep='entrada'",$conexion) or die(mysql_error());
	$row_rs_disp=mysql_fetch_assoc($rs_disp);
	$entradas=$row_rs_disp['entradas'];
	$rs_disp=mysql_query("SELECT SUM(cantidad) as salidas FROM d89xz_total_medicinas_salidasins WHERE id_insumo='$id_ins' and hacienda='$filtro' and concep='salida'",$conexion) or die(mysql_error());
	$row_rs_disp=mysql_fetch_assoc($rs_disp);
	$salidas=$row_rs_disp['salidas'];	
	$cant_disp=($entradas*$cont-$salidas);
?>
      <input type="hidden" id="exc_sl42" value="<?php echo $cant_disp ?>"  />
      <?php $rs_mar=mysql_query("SELECT id, contenido FROM d89xz_total_medicinasins WHERE tipo='MARQUILLA' and nombre= 'EXCLUSIVA' and descripcion='TALLA 44 SLIM' and `delete`=0");
	$row_mar=mysql_fetch_assoc($rs_mar);
	$id_ins=$row_mar['id'];
	$cont=$row_mar['contenido'];
	$rs_disp=mysql_query("SELECT SUM(cantidad) as entradas FROM d89xz_total_medicinas_salidasins WHERE id_insumo='$id_ins' and hacienda='$filtro' and concep='entrada'",$conexion) or die(mysql_error());
	$row_rs_disp=mysql_fetch_assoc($rs_disp);
	$entradas=$row_rs_disp['entradas'];
	$rs_disp=mysql_query("SELECT SUM(cantidad) as salidas FROM d89xz_total_medicinas_salidasins WHERE id_insumo='$id_ins' and hacienda='$filtro' and concep='salida'",$conexion) or die(mysql_error());
	$row_rs_disp=mysql_fetch_assoc($rs_disp);
	$salidas=$row_rs_disp['salidas'];	
	$cant_disp=($entradas*$cont-$salidas);
?>
      <input type="hidden" id="exc_sl44" value="<?php echo $cant_disp ?>"  />
      <?php $rs_mar=mysql_query("SELECT id, contenido FROM d89xz_total_medicinasins WHERE tipo='MARQUILLA' and nombre= 'EXCLUSIVA' and descripcion='TALLA 46 SLIM' and `delete`=0");
	$row_mar=mysql_fetch_assoc($rs_mar);
	$id_ins=$row_mar['id'];
	$cont=$row_mar['contenido'];
	$rs_disp=mysql_query("SELECT SUM(cantidad) as entradas FROM d89xz_total_medicinas_salidasins WHERE id_insumo='$id_ins' and hacienda='$filtro' and concep='entrada'",$conexion) or die(mysql_error());
	$row_rs_disp=mysql_fetch_assoc($rs_disp);
	$entradas=$row_rs_disp['entradas'];
	$rs_disp=mysql_query("SELECT SUM(cantidad) as salidas FROM d89xz_total_medicinas_salidasins WHERE id_insumo='$id_ins' and hacienda='$filtro' and concep='salida'",$conexion) or die(mysql_error());
	$row_rs_disp=mysql_fetch_assoc($rs_disp);
	$salidas=$row_rs_disp['salidas'];	
	$cant_disp=($entradas*$cont-$salidas);
?>
      <input type="hidden" id="exc_sl46" value="<?php echo $cant_disp ?>"  />
      
      <?php $rs_mar=mysql_query("SELECT id, contenido FROM d89xz_total_medicinasins WHERE tipo='MARQUILLA' and nombre= 'EXCLUSIVA' and descripcion='TALLA 37' and `delete`=0");
	$row_mar=mysql_fetch_assoc($rs_mar);
	$id_ins=$row_mar['id'];
	$cont=$row_mar['contenido'];
	$rs_disp=mysql_query("SELECT SUM(cantidad) as entradas FROM d89xz_total_medicinas_salidasins WHERE id_insumo='$id_ins' and hacienda='$filtro' and concep='entrada'",$conexion) or die(mysql_error());
	$row_rs_disp=mysql_fetch_assoc($rs_disp);
	$entradas=$row_rs_disp['entradas'];
	$rs_disp=mysql_query("SELECT SUM(cantidad) as salidas FROM d89xz_total_medicinas_salidasins WHERE id_insumo='$id_ins' and hacienda='$filtro' and concep='salida'",$conexion) or die(mysql_error());
	$row_rs_disp=mysql_fetch_assoc($rs_disp);
	$salidas=$row_rs_disp['salidas'];	
	$cant_disp=($entradas*$cont-$salidas);
?>
      <input type="hidden" id="exc_cl37" value="<?php echo $cant_disp ?>"  />
      <?php $rs_mar=mysql_query("SELECT id, contenido FROM d89xz_total_medicinasins WHERE tipo='MARQUILLA' and nombre= 'EXCLUSIVA' and descripcion='TALLA 38' and `delete`=0");
	$row_mar=mysql_fetch_assoc($rs_mar);
	$id_ins=$row_mar['id'];
	$cont=$row_mar['contenido'];
	$rs_disp=mysql_query("SELECT SUM(cantidad) as entradas FROM d89xz_total_medicinas_salidasins WHERE id_insumo='$id_ins' and hacienda='$filtro' and concep='entrada'",$conexion) or die(mysql_error());
	$row_rs_disp=mysql_fetch_assoc($rs_disp);
	$entradas=$row_rs_disp['entradas'];
	$rs_disp=mysql_query("SELECT SUM(cantidad) as salidas FROM d89xz_total_medicinas_salidasins WHERE id_insumo='$id_ins' and hacienda='$filtro' and concep='salida'",$conexion) or die(mysql_error());
	$row_rs_disp=mysql_fetch_assoc($rs_disp);
	$salidas=$row_rs_disp['salidas'];	
	$cant_disp=($entradas*$cont-$salidas);
?>
      <input type="hidden" id="exc_cl38" value="<?php echo $cant_disp ?>"  />
      <?php $rs_mar=mysql_query("SELECT id, contenido FROM d89xz_total_medicinasins WHERE tipo='MARQUILLA' and nombre= 'EXCLUSIVA' and descripcion='TALLA 39' and `delete`=0");
	$row_mar=mysql_fetch_assoc($rs_mar);
	$id_ins=$row_mar['id'];
	$cont=$row_mar['contenido'];
	$rs_disp=mysql_query("SELECT SUM(cantidad) as entradas FROM d89xz_total_medicinas_salidasins WHERE id_insumo='$id_ins' and hacienda='$filtro' and concep='entrada'",$conexion) or die(mysql_error());
	$row_rs_disp=mysql_fetch_assoc($rs_disp);
	$entradas=$row_rs_disp['entradas'];
	$rs_disp=mysql_query("SELECT SUM(cantidad) as salidas FROM d89xz_total_medicinas_salidasins WHERE id_insumo='$id_ins' and hacienda='$filtro' and concep='salida'",$conexion) or die(mysql_error());
	$row_rs_disp=mysql_fetch_assoc($rs_disp);
	$salidas=$row_rs_disp['salidas'];	
	$cant_disp=($entradas*$cont-$salidas);
?>
      <input type="hidden" id="exc_cl39" value="<?php echo $cant_disp ?>"  />
      <?php $rs_mar=mysql_query("SELECT id, contenido FROM d89xz_total_medicinasins WHERE tipo='MARQUILLA' and nombre= 'EXCLUSIVA' and descripcion='TALLA 40' and `delete`=0");
	$row_mar=mysql_fetch_assoc($rs_mar);
	$id_ins=$row_mar['id'];
	$cont=$row_mar['contenido'];
	$rs_disp=mysql_query("SELECT SUM(cantidad) as entradas FROM d89xz_total_medicinas_salidasins WHERE id_insumo='$id_ins' and hacienda='$filtro' and concep='entrada'",$conexion) or die(mysql_error());
	$row_rs_disp=mysql_fetch_assoc($rs_disp);
	$entradas=$row_rs_disp['entradas'];
	$rs_disp=mysql_query("SELECT SUM(cantidad) as salidas FROM d89xz_total_medicinas_salidasins WHERE id_insumo='$id_ins' and hacienda='$filtro' and concep='salida'",$conexion) or die(mysql_error());
	$row_rs_disp=mysql_fetch_assoc($rs_disp);
	$salidas=$row_rs_disp['salidas'];	
	$cant_disp=($entradas*$cont-$salidas);
?>
      <input type="hidden" id="exc_cl40" value="<?php echo $cant_disp ?>"  />
      <?php $rs_mar=mysql_query("SELECT id, contenido FROM d89xz_total_medicinasins WHERE tipo='MARQUILLA' and nombre= 'EXCLUSIVA' and descripcion='TALLA 41' and `delete`=0");
	$row_mar=mysql_fetch_assoc($rs_mar);
	$id_ins=$row_mar['id'];
	$cont=$row_mar['contenido'];
	$rs_disp=mysql_query("SELECT SUM(cantidad) as entradas FROM d89xz_total_medicinas_salidasins WHERE id_insumo='$id_ins' and hacienda='$filtro' and concep='entrada'",$conexion) or die(mysql_error());
	$row_rs_disp=mysql_fetch_assoc($rs_disp);
	$entradas=$row_rs_disp['entradas'];
	$rs_disp=mysql_query("SELECT SUM(cantidad) as salidas FROM d89xz_total_medicinas_salidasins WHERE id_insumo='$id_ins' and hacienda='$filtro' and concep='salida'",$conexion) or die(mysql_error());
	$row_rs_disp=mysql_fetch_assoc($rs_disp);
	$salidas=$row_rs_disp['salidas'];	
	$cant_disp=($entradas*$cont-$salidas);
?>
      <input type="hidden" id="exc_cl41" value="<?php echo $cant_disp ?>"  />
      <?php $rs_mar=mysql_query("SELECT id, contenido FROM d89xz_total_medicinasins WHERE tipo='MARQUILLA' and nombre= 'EXCLUSIVA' and descripcion='TALLA 42' and `delete`=0");
	$row_mar=mysql_fetch_assoc($rs_mar);
	$id_ins=$row_mar['id'];
	$cont=$row_mar['contenido'];
	$rs_disp=mysql_query("SELECT SUM(cantidad) as entradas FROM d89xz_total_medicinas_salidasins WHERE id_insumo='$id_ins' and hacienda='$filtro' and concep='entrada'",$conexion) or die(mysql_error());
	$row_rs_disp=mysql_fetch_assoc($rs_disp);
	$entradas=$row_rs_disp['entradas'];
	$rs_disp=mysql_query("SELECT SUM(cantidad) as salidas FROM d89xz_total_medicinas_salidasins WHERE id_insumo='$id_ins' and hacienda='$filtro' and concep='salida'",$conexion) or die(mysql_error());
	$row_rs_disp=mysql_fetch_assoc($rs_disp);
	$salidas=$row_rs_disp['salidas'];	
	$cant_disp=($entradas*$cont-$salidas);
?>
      <input type="hidden" id="exc_cl42" value="<?php echo $cant_disp ?>"  />
      <?php $rs_mar=mysql_query("SELECT id, contenido FROM d89xz_total_medicinasins WHERE tipo='MARQUILLA' and nombre= 'EXCLUSIVA' and descripcion='TALLA 44' and `delete`=0");
	$row_mar=mysql_fetch_assoc($rs_mar);
	$id_ins=$row_mar['id'];
	$cont=$row_mar['contenido'];
	$rs_disp=mysql_query("SELECT SUM(cantidad) as entradas FROM d89xz_total_medicinas_salidasins WHERE id_insumo='$id_ins' and hacienda='$filtro' and concep='entrada'",$conexion) or die(mysql_error());
	$row_rs_disp=mysql_fetch_assoc($rs_disp);
	$entradas=$row_rs_disp['entradas'];
	$rs_disp=mysql_query("SELECT SUM(cantidad) as salidas FROM d89xz_total_medicinas_salidasins WHERE id_insumo='$id_ins' and hacienda='$filtro' and concep='salida'",$conexion) or die(mysql_error());
	$row_rs_disp=mysql_fetch_assoc($rs_disp);
	$salidas=$row_rs_disp['salidas'];	
	$cant_disp=($entradas*$cont-$salidas);
?>
      <input type="hidden" id="exc_cl44" value="<?php echo $cant_disp ?>"  />
      <?php $rs_mar=mysql_query("SELECT id, contenido FROM d89xz_total_medicinasins WHERE tipo='MARQUILLA' and nombre= 'EXCLUSIVA' and descripcion='TALLA 46' and `delete`=0");
	$row_mar=mysql_fetch_assoc($rs_mar);
	$id_ins=$row_mar['id'];
	$cont=$row_mar['contenido'];
	$rs_disp=mysql_query("SELECT SUM(cantidad) as entradas FROM d89xz_total_medicinas_salidasins WHERE id_insumo='$id_ins' and hacienda='$filtro' and concep='entrada'",$conexion) or die(mysql_error());
	$row_rs_disp=mysql_fetch_assoc($rs_disp);
	$entradas=$row_rs_disp['entradas'];
	$rs_disp=mysql_query("SELECT SUM(cantidad) as salidas FROM d89xz_total_medicinas_salidasins WHERE id_insumo='$id_ins' and hacienda='$filtro' and concep='salida'",$conexion) or die(mysql_error());
	$row_rs_disp=mysql_fetch_assoc($rs_disp);
	$salidas=$row_rs_disp['salidas'];	
	$cant_disp=($entradas*$cont-$salidas);
?>
      <input type="hidden" id="exc_cl46" value="<?php echo $cant_disp ?>"  />
      
      <?php $rs_mar=mysql_query("SELECT id, contenido FROM d89xz_total_medicinasins WHERE tipo='MARQUILLA' and nombre= 'ROYAL' and descripcion='TALLA 37 SLIM' and `delete`=0");
	$row_mar=mysql_fetch_assoc($rs_mar);
	$id_ins=$row_mar['id'];
	$cont=$row_mar['contenido'];
	$rs_disp=mysql_query("SELECT SUM(cantidad) as entradas FROM d89xz_total_medicinas_salidasins WHERE id_insumo='$id_ins' and hacienda='$filtro' and concep='entrada'",$conexion) or die(mysql_error());
	$row_rs_disp=mysql_fetch_assoc($rs_disp);
	$entradas=$row_rs_disp['entradas'];
	$rs_disp=mysql_query("SELECT SUM(cantidad) as salidas FROM d89xz_total_medicinas_salidasins WHERE id_insumo='$id_ins' and hacienda='$filtro' and concep='salida'",$conexion) or die(mysql_error());
	$row_rs_disp=mysql_fetch_assoc($rs_disp);
	$salidas=$row_rs_disp['salidas'];	
	$cant_disp=($entradas*$cont-$salidas);
?>
      <input type="hidden" id="roy_sl37" value="<?php echo $cant_disp ?>"  />
      <?php $rs_mar=mysql_query("SELECT id, contenido FROM d89xz_total_medicinasins WHERE tipo='MARQUILLA' and nombre= 'ROYAL' and descripcion='TALLA 38 SLIM' and `delete`=0");
	$row_mar=mysql_fetch_assoc($rs_mar);
	$id_ins=$row_mar['id'];
	$cont=$row_mar['contenido'];
	$rs_disp=mysql_query("SELECT SUM(cantidad) as entradas FROM d89xz_total_medicinas_salidasins WHERE id_insumo='$id_ins' and hacienda='$filtro' and concep='entrada'",$conexion) or die(mysql_error());
	$row_rs_disp=mysql_fetch_assoc($rs_disp);
	$entradas=$row_rs_disp['entradas'];
	$rs_disp=mysql_query("SELECT SUM(cantidad) as salidas FROM d89xz_total_medicinas_salidasins WHERE id_insumo='$id_ins' and hacienda='$filtro' and concep='salida'",$conexion) or die(mysql_error());
	$row_rs_disp=mysql_fetch_assoc($rs_disp);
	$salidas=$row_rs_disp['salidas'];	
	$cant_disp=($entradas*$cont-$salidas);
?>
      <input type="hidden" id="roy_sl38" value="<?php echo $cant_disp ?>"  />
      <?php $rs_mar=mysql_query("SELECT id, contenido FROM d89xz_total_medicinasins WHERE tipo='MARQUILLA' and nombre= 'ROYAL' and descripcion='TALLA 39 SLIM' and `delete`=0");
	$row_mar=mysql_fetch_assoc($rs_mar);
	$id_ins=$row_mar['id'];
	$cont=$row_mar['contenido'];
	$rs_disp=mysql_query("SELECT SUM(cantidad) as entradas FROM d89xz_total_medicinas_salidasins WHERE id_insumo='$id_ins' and hacienda='$filtro' and concep='entrada'",$conexion) or die(mysql_error());
	$row_rs_disp=mysql_fetch_assoc($rs_disp);
	$entradas=$row_rs_disp['entradas'];
	$rs_disp=mysql_query("SELECT SUM(cantidad) as salidas FROM d89xz_total_medicinas_salidasins WHERE id_insumo='$id_ins' and hacienda='$filtro' and concep='salida'",$conexion) or die(mysql_error());
	$row_rs_disp=mysql_fetch_assoc($rs_disp);
	$salidas=$row_rs_disp['salidas'];	
	$cant_disp=($entradas*$cont-$salidas);
?>
      <input type="hidden" id="roy_sl39" value="<?php echo $cant_disp ?>"  />
      <?php $rs_mar=mysql_query("SELECT id, contenido FROM d89xz_total_medicinasins WHERE tipo='MARQUILLA' and nombre= 'ROYAL' and descripcion='TALLA 40 SLIM' and `delete`=0");
	$row_mar=mysql_fetch_assoc($rs_mar);
	$id_ins=$row_mar['id'];
	$cont=$row_mar['contenido'];
	$rs_disp=mysql_query("SELECT SUM(cantidad) as entradas FROM d89xz_total_medicinas_salidasins WHERE id_insumo='$id_ins' and hacienda='$filtro' and concep='entrada'",$conexion) or die(mysql_error());
	$row_rs_disp=mysql_fetch_assoc($rs_disp);
	$entradas=$row_rs_disp['entradas'];
	$rs_disp=mysql_query("SELECT SUM(cantidad) as salidas FROM d89xz_total_medicinas_salidasins WHERE id_insumo='$id_ins' and hacienda='$filtro' and concep='salida'",$conexion) or die(mysql_error());
	$row_rs_disp=mysql_fetch_assoc($rs_disp);
	$salidas=$row_rs_disp['salidas'];	
	$cant_disp=($entradas*$cont-$salidas);
?>
      <input type="hidden" id="roy_sl40" value="<?php echo $cant_disp ?>"  />
      <?php $rs_mar=mysql_query("SELECT id, contenido FROM d89xz_total_medicinasins WHERE tipo='MARQUILLA' and nombre= 'ROYAL' and descripcion='TALLA 41 SLIM' and `delete`=0");
	$row_mar=mysql_fetch_assoc($rs_mar);
	$id_ins=$row_mar['id'];
	$cont=$row_mar['contenido'];
	$rs_disp=mysql_query("SELECT SUM(cantidad) as entradas FROM d89xz_total_medicinas_salidasins WHERE id_insumo='$id_ins' and hacienda='$filtro' and concep='entrada'",$conexion) or die(mysql_error());
	$row_rs_disp=mysql_fetch_assoc($rs_disp);
	$entradas=$row_rs_disp['entradas'];
	$rs_disp=mysql_query("SELECT SUM(cantidad) as salidas FROM d89xz_total_medicinas_salidasins WHERE id_insumo='$id_ins' and hacienda='$filtro' and concep='salida'",$conexion) or die(mysql_error());
	$row_rs_disp=mysql_fetch_assoc($rs_disp);
	$salidas=$row_rs_disp['salidas'];	
	$cant_disp=($entradas*$cont-$salidas);
?>
      <input type="hidden" id="roy_sl41" value="<?php echo $cant_disp ?>"  />
      <?php $rs_mar=mysql_query("SELECT id, contenido FROM d89xz_total_medicinasins WHERE tipo='MARQUILLA' and nombre= 'ROYAL' and descripcion='TALLA 42 SLIM' and `delete`=0");
	$row_mar=mysql_fetch_assoc($rs_mar);
	$id_ins=$row_mar['id'];
	$cont=$row_mar['contenido'];
	$rs_disp=mysql_query("SELECT SUM(cantidad) as entradas FROM d89xz_total_medicinas_salidasins WHERE id_insumo='$id_ins' and hacienda='$filtro' and concep='entrada'",$conexion) or die(mysql_error());
	$row_rs_disp=mysql_fetch_assoc($rs_disp);
	$entradas=$row_rs_disp['entradas'];
	$rs_disp=mysql_query("SELECT SUM(cantidad) as salidas FROM d89xz_total_medicinas_salidasins WHERE id_insumo='$id_ins' and hacienda='$filtro' and concep='salida'",$conexion) or die(mysql_error());
	$row_rs_disp=mysql_fetch_assoc($rs_disp);
	$salidas=$row_rs_disp['salidas'];	
	$cant_disp=($entradas*$cont-$salidas);
?>
      <input type="hidden" id="roy_sl42" value="<?php echo $cant_disp ?>"  />
      <?php $rs_mar=mysql_query("SELECT id, contenido FROM d89xz_total_medicinasins WHERE tipo='MARQUILLA' and nombre= 'ROYAL' and descripcion='TALLA 44 SLIM' and `delete`=0");
	$row_mar=mysql_fetch_assoc($rs_mar);
	$id_ins=$row_mar['id'];
	$cont=$row_mar['contenido'];
	$rs_disp=mysql_query("SELECT SUM(cantidad) as entradas FROM d89xz_total_medicinas_salidasins WHERE id_insumo='$id_ins' and hacienda='$filtro' and concep='entrada'",$conexion) or die(mysql_error());
	$row_rs_disp=mysql_fetch_assoc($rs_disp);
	$entradas=$row_rs_disp['entradas'];
	$rs_disp=mysql_query("SELECT SUM(cantidad) as salidas FROM d89xz_total_medicinas_salidasins WHERE id_insumo='$id_ins' and hacienda='$filtro' and concep='salida'",$conexion) or die(mysql_error());
	$row_rs_disp=mysql_fetch_assoc($rs_disp);
	$salidas=$row_rs_disp['salidas'];	
	$cant_disp=($entradas*$cont-$salidas);
?>
      <input type="hidden" id="roy_sl44" value="<?php echo $cant_disp ?>"  />
      <?php $rs_mar=mysql_query("SELECT id, contenido FROM d89xz_total_medicinasins WHERE tipo='MARQUILLA' and nombre= 'ROYAL' and descripcion='TALLA 46 SLIM' and `delete`=0");
	$row_mar=mysql_fetch_assoc($rs_mar);
	$id_ins=$row_mar['id'];
	$cont=$row_mar['contenido'];
	$rs_disp=mysql_query("SELECT SUM(cantidad) as entradas FROM d89xz_total_medicinas_salidasins WHERE id_insumo='$id_ins' and hacienda='$filtro' and concep='entrada'",$conexion) or die(mysql_error());
	$row_rs_disp=mysql_fetch_assoc($rs_disp);
	$entradas=$row_rs_disp['entradas'];
	$rs_disp=mysql_query("SELECT SUM(cantidad) as salidas FROM d89xz_total_medicinas_salidasins WHERE id_insumo='$id_ins' and hacienda='$filtro' and concep='salida'",$conexion) or die(mysql_error());
	$row_rs_disp=mysql_fetch_assoc($rs_disp);
	$salidas=$row_rs_disp['salidas'];	
	$cant_disp=($entradas*$cont-$salidas);
?>
      <input type="hidden" id="roy_sl46" value="<?php echo $cant_disp ?>"  />
     
     <?php $rs_mar=mysql_query("SELECT id, contenido FROM d89xz_total_medicinasins WHERE tipo='MARQUILLA' and nombre= 'ROYAL' and descripcion='TALLA 37' and `delete`=0");
	$row_mar=mysql_fetch_assoc($rs_mar);
	$id_ins=$row_mar['id'];
	$cont=$row_mar['contenido'];
	$rs_disp=mysql_query("SELECT SUM(cantidad) as entradas FROM d89xz_total_medicinas_salidasins WHERE id_insumo='$id_ins' and hacienda='$filtro' and concep='entrada'",$conexion) or die(mysql_error());
	$row_rs_disp=mysql_fetch_assoc($rs_disp);
	$entradas=$row_rs_disp['entradas'];
	$rs_disp=mysql_query("SELECT SUM(cantidad) as salidas FROM d89xz_total_medicinas_salidasins WHERE id_insumo='$id_ins' and hacienda='$filtro' and concep='salida'",$conexion) or die(mysql_error());
	$row_rs_disp=mysql_fetch_assoc($rs_disp);
	$salidas=$row_rs_disp['salidas'];	
	$cant_disp=($entradas*$cont-$salidas);
?> 
      <input type="hidden" id="roy_cl37" value="<?php echo $cant_disp ?>"  />
      <?php $rs_mar=mysql_query("SELECT id, contenido FROM d89xz_total_medicinasins WHERE tipo='MARQUILLA' and nombre= 'ROYAL' and descripcion='TALLA 38' and `delete`=0");
	$row_mar=mysql_fetch_assoc($rs_mar);
	$id_ins=$row_mar['id'];
	$cont=$row_mar['contenido'];
	$rs_disp=mysql_query("SELECT SUM(cantidad) as entradas FROM d89xz_total_medicinas_salidasins WHERE id_insumo='$id_ins' and hacienda='$filtro' and concep='entrada'",$conexion) or die(mysql_error());
	$row_rs_disp=mysql_fetch_assoc($rs_disp);
	$entradas=$row_rs_disp['entradas'];
	$rs_disp=mysql_query("SELECT SUM(cantidad) as salidas FROM d89xz_total_medicinas_salidasins WHERE id_insumo='$id_ins' and hacienda='$filtro' and concep='salida'",$conexion) or die(mysql_error());
	$row_rs_disp=mysql_fetch_assoc($rs_disp);
	$salidas=$row_rs_disp['salidas'];	
	$cant_disp=($entradas*$cont-$salidas);
?>
      <input type="hidden" id="roy_cl38" value="<?php echo $cant_disp ?>"  />
      <?php $rs_mar=mysql_query("SELECT id, contenido FROM d89xz_total_medicinasins WHERE tipo='MARQUILLA' and nombre= 'ROYAL' and descripcion='TALLA 39' and `delete`=0");
	$row_mar=mysql_fetch_assoc($rs_mar);
	$id_ins=$row_mar['id'];
	$cont=$row_mar['contenido'];
	$rs_disp=mysql_query("SELECT SUM(cantidad) as entradas FROM d89xz_total_medicinas_salidasins WHERE id_insumo='$id_ins' and hacienda='$filtro' and concep='entrada'",$conexion) or die(mysql_error());
	$row_rs_disp=mysql_fetch_assoc($rs_disp);
	$entradas=$row_rs_disp['entradas'];
	$rs_disp=mysql_query("SELECT SUM(cantidad) as salidas FROM d89xz_total_medicinas_salidasins WHERE id_insumo='$id_ins' and hacienda='$filtro' and concep='salida'",$conexion) or die(mysql_error());
	$row_rs_disp=mysql_fetch_assoc($rs_disp);
	$salidas=$row_rs_disp['salidas'];	
	$cant_disp=($entradas*$cont-$salidas);
?>
      <input type="hidden" id="roy_cl39" value="<?php echo $cant_disp ?>"  />
      <?php $rs_mar=mysql_query("SELECT id, contenido FROM d89xz_total_medicinasins WHERE tipo='MARQUILLA' and nombre= 'ROYAL' and descripcion='TALLA 40' and `delete`=0");
	$row_mar=mysql_fetch_assoc($rs_mar);
	$id_ins=$row_mar['id'];
	$cont=$row_mar['contenido'];
	$rs_disp=mysql_query("SELECT SUM(cantidad) as entradas FROM d89xz_total_medicinas_salidasins WHERE id_insumo='$id_ins' and hacienda='$filtro' and concep='entrada'",$conexion) or die(mysql_error());
	$row_rs_disp=mysql_fetch_assoc($rs_disp);
	$entradas=$row_rs_disp['entradas'];
	$rs_disp=mysql_query("SELECT SUM(cantidad) as salidas FROM d89xz_total_medicinas_salidasins WHERE id_insumo='$id_ins' and hacienda='$filtro' and concep='salida'",$conexion) or die(mysql_error());
	$row_rs_disp=mysql_fetch_assoc($rs_disp);
	$salidas=$row_rs_disp['salidas'];	
	$cant_disp=($entradas*$cont-$salidas);
?>
      <input type="hidden" id="roy_cl40" value="<?php echo $cant_disp ?>"  />
      <?php $rs_mar=mysql_query("SELECT id, contenido FROM d89xz_total_medicinasins WHERE tipo='MARQUILLA' and nombre= 'ROYAL' and descripcion='TALLA 41' and `delete`=0");
	$row_mar=mysql_fetch_assoc($rs_mar);
	$id_ins=$row_mar['id'];
	$cont=$row_mar['contenido'];
	$rs_disp=mysql_query("SELECT SUM(cantidad) as entradas FROM d89xz_total_medicinas_salidasins WHERE id_insumo='$id_ins' and hacienda='$filtro' and concep='entrada'",$conexion) or die(mysql_error());
	$row_rs_disp=mysql_fetch_assoc($rs_disp);
	$entradas=$row_rs_disp['entradas'];
	$rs_disp=mysql_query("SELECT SUM(cantidad) as salidas FROM d89xz_total_medicinas_salidasins WHERE id_insumo='$id_ins' and hacienda='$filtro' and concep='salida'",$conexion) or die(mysql_error());
	$row_rs_disp=mysql_fetch_assoc($rs_disp);
	$salidas=$row_rs_disp['salidas'];	
	$cant_disp=($entradas*$cont-$salidas);
?>
      <input type="hidden" id="roy_cl41" value="<?php echo $cant_disp ?>"  />
      <?php $rs_mar=mysql_query("SELECT id, contenido FROM d89xz_total_medicinasins WHERE tipo='MARQUILLA' and nombre= 'ROYAL' and descripcion='TALLA 42' and `delete`=0");
	$row_mar=mysql_fetch_assoc($rs_mar);
	$id_ins=$row_mar['id'];
	$cont=$row_mar['contenido'];
	$rs_disp=mysql_query("SELECT SUM(cantidad) as entradas FROM d89xz_total_medicinas_salidasins WHERE id_insumo='$id_ins' and hacienda='$filtro' and concep='entrada'",$conexion) or die(mysql_error());
	$row_rs_disp=mysql_fetch_assoc($rs_disp);
	$entradas=$row_rs_disp['entradas'];
	$rs_disp=mysql_query("SELECT SUM(cantidad) as salidas FROM d89xz_total_medicinas_salidasins WHERE id_insumo='$id_ins' and hacienda='$filtro' and concep='salida'",$conexion) or die(mysql_error());
	$row_rs_disp=mysql_fetch_assoc($rs_disp);
	$salidas=$row_rs_disp['salidas'];	
	$cant_disp=($entradas*$cont-$salidas);
?>
      <input type="hidden" id="roy_cl42" value="<?php echo $cant_disp ?>"  />
      <?php $rs_mar=mysql_query("SELECT id, contenido FROM d89xz_total_medicinasins WHERE tipo='MARQUILLA' and nombre= 'ROYAL' and descripcion='TALLA 44' and `delete`=0");
	$row_mar=mysql_fetch_assoc($rs_mar);
	$id_ins=$row_mar['id'];
	$cont=$row_mar['contenido'];
	$rs_disp=mysql_query("SELECT SUM(cantidad) as entradas FROM d89xz_total_medicinas_salidasins WHERE id_insumo='$id_ins' and hacienda='$filtro' and concep='entrada'",$conexion) or die(mysql_error());
	$row_rs_disp=mysql_fetch_assoc($rs_disp);
	$entradas=$row_rs_disp['entradas'];
	$rs_disp=mysql_query("SELECT SUM(cantidad) as salidas FROM d89xz_total_medicinas_salidasins WHERE id_insumo='$id_ins' and hacienda='$filtro' and concep='salida'",$conexion) or die(mysql_error());
	$row_rs_disp=mysql_fetch_assoc($rs_disp);
	$salidas=$row_rs_disp['salidas'];	
	$cant_disp=($entradas*$cont-$salidas);
?>
      <input type="hidden" id="roy_cl44" value="<?php echo $cant_disp ?>"  />
      <?php $rs_mar=mysql_query("SELECT id, contenido FROM d89xz_total_medicinasins WHERE tipo='MARQUILLA' and nombre= 'ROYAL' and descripcion='TALLA 46' and `delete`=0");
	$row_mar=mysql_fetch_assoc($rs_mar);
	$id_ins=$row_mar['id'];
	$cont=$row_mar['contenido'];
	$rs_disp=mysql_query("SELECT SUM(cantidad) as entradas FROM d89xz_total_medicinas_salidasins WHERE id_insumo='$id_ins' and hacienda='$filtro' and concep='entrada'",$conexion) or die(mysql_error());
	$row_rs_disp=mysql_fetch_assoc($rs_disp);
	$entradas=$row_rs_disp['entradas'];
	$rs_disp=mysql_query("SELECT SUM(cantidad) as salidas FROM d89xz_total_medicinas_salidasins WHERE id_insumo='$id_ins' and hacienda='$filtro' and concep='salida'",$conexion) or die(mysql_error());
	$row_rs_disp=mysql_fetch_assoc($rs_disp);
	$salidas=$row_rs_disp['salidas'];	
	$cant_disp=($entradas*$cont-$salidas);
?>
      <input type="hidden" id="roy_cl46" value="<?php echo $cant_disp ?>"  />
      <?php
}
	  ?>
    </td>
    </tr>
  </table>
  <table width="98%" border="1" cellspacing="0" cellpadding="0" align="center">
  <tr class="tittle">
    <td colspan="8" align="center" >OBSERVACIONES</td>
    </tr>
  
  <tr class="bold">
    
    <td align="center" colspan="7"><textarea name="registro" id="comentario" style="width:90%; height:70px"  ></textarea></td>
  </tr>
  <tr>
    <td colspan="8" align="center"><input type="submit" name="guarda" id="guarda" value="Guardar" onclick="guardar(); return false" class="ext" /></td>
    </tr>
</table>
</div>
</form>
<div id="dialog2" >
</div>
<?php
}else{
	?>
    <table width="70%" border="0" align="center">
  <tr>
    <td><img src="../img/Logo_out.png" width="300" height="140" /></td>
  </tr>
  <tr>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <th>No puede acceder A este MENU sin estar HABILITADO... Consulte al Administrador....!!!</th>
  </tr>
</table>
<?php
}
?>
</body>
<script>
window.onload=function(){
	rec_tipos_tel();
	window.botones=9;
	window.calculo=0;
	overlay = $('<div></div>').prependTo('body').attr('id', 'overlay');
	$("#rec_todo").find("input:text").width("80%");
}
function guardar(){
	if($('#formu')[0].checkValidity()){
		if(window.calculo==0){ 
			$("#img_calculo").effect("pulsate", { times:5 }, 3000);
			return false;
		}else{
			guardar2();
			$("#guarda").hide()
		}
	}else{
		$('#formu')[0].find(':submit').click()
		$("#guarda").show("slow")
	}
}
function guardar2(){
	var valor=[];
	var ids=[];
	$('[name="registro"]').each(function(index, element) {
		
		valor.push($(this).val());
		ids.push(element.id);
	})
	$.ajax({
		type: "POST",
		//dataType: "json",
		url: "stin_corte_php.php",
		data: {orden_corte: valor, ids: ids},
		success: function(orden){ 
			siga(orden);
		}
	})
}
function siga(orden){
	var des=[];
	var j=0;
	var filtro=$("#filtro").val()
	$('[name="37"]').each(function(index, element) {
		des[j]=[]
		des[j].push($.trim($('[name="37"]').eq(index).val()))
		des[j].push($.trim($('[name="37m"]').eq(index).val()))
		des[j].push($.trim($('[name="38"]').eq(index).val()))
		des[j].push($.trim($('[name="38m"]').eq(index).val()))
		des[j].push($.trim($('[name="39"]').eq(index).val()))
		des[j].push($.trim($('[name="39m"]').eq(index).val()))
		des[j].push($.trim($('[name="40"]').eq(index).val()))
		des[j].push($.trim($('[name="40m"]').eq(index).val()))
		des[j].push($.trim($('[name="41"]').eq(index).val()))
		des[j].push($.trim($('[name="41m"]').eq(index).val()))
		des[j].push($.trim($('[name="42"]').eq(index).val()))
		des[j].push($.trim($('[name="42m"]').eq(index).val()))
		des[j].push($.trim($('[name="44"]').eq(index).val()))
		des[j].push($.trim($('[name="44m"]').eq(index).val()))
		des[j].push($.trim($('[name="46"]').eq(index).val()))
		des[j].push($.trim($('[name="46m"]').eq(index).val()))
		des[j].push($.trim($('[name="referencia"]').eq(index).val()))
		des[j].push($.trim($('[name="diseno_t"]').eq(index).val()))
		des[j].push($.trim($('[name="entretela"]').eq(index).val()))
		des[j].push($.trim($('[name="manga"]').eq(index).val()))
		des[j].push(calculo_charretera(index))
		des[j].push($.trim($('[name="cuello"]').eq(index).val()))
		des[j].push($.trim($('[name="cuello_bot"]').eq(index).val()))
		des[j].push($.trim($('[name="cuello_bot_sel"]').eq(index).val()))
		des[j].push($.trim($('[name="cant_cuello_bots"]').eq(index).val()))
		des[j].push($.trim($('[name="cartera"]').eq(index).val()))
		des[j].push($.trim($('[name="bolsillo_in"]').eq(index).val()))
		des[j].push(calculo_bolsillo(index))
		des[j].push($.trim($('[name="banda"]').eq(index).val()))
		des[j].push($.trim($('[name="espalda"]').eq(index).val()))
		des[j].push($.trim($('[name="puno"]').eq(index).val()))
		j++;
	})
	$.ajax({
		type: "POST",
		//dataType: "json",
		url: "stin_corte_php.php",
		data: {orden_corte2: orden, des: des, filtro: filtro},
		success: function(datos){ 
			$("#dialog2").html('&nbsp;&nbsp;&nbsp;Registro Exitoso').css('text-align','center');
			$("#dialog2").prepend('<img id="theImg2" src="img/good.png" width="43" height="31"/>');
			$("span.ui-dialog-title").text('Información Importante').css("text-align", "center"); 
			$("#dialog2").dialog("open");
			setTimeout(function () {
			   $("#dialog2").dialog("close");
			   location.href='stin_corte2.php?orden='+orden+'&filtro='+filtro;
			}, 2000);
		}
	})
}
function calculo_charretera(index){
	if($('[name="charretera"]').eq(index).is(":checked"))
		return "on"; else return "off";	
}
function calculo_bolsillo(index){
	if($('[name="bolsillo"]').eq(index).is(":checked"))
		return "on"; else return "off";	
}

function calcule(){
	var filtro=$("#filtro").val()
	var id_ins=$("#tipo_insumo").val()
	var tipo_bots=$("#tipo_boton").val()
	if(bandera()==1){ $(document).scrollTop(0); return false};
	var cant_camisas=cantidad_tallas()*parseFloat($("#cant_telas").val());
	var prom=(parseFloat($("#largo").val())/cantidad_tallas()).toFixed(2);
	$("#rec_todo").load("stin_corte1.php?filtro=" + encodeURIComponent(filtro) + "&id_ins="+ id_ins + "&tipo_bots=" + encodeURIComponent(tipo_bots) + " #rec_todo ", function(resp, stat, xhr){
		if (stat == 'success'){
			window.calculo=1;
			$("#t_camisas").val(cant_camisas);
			$("#bolsas").val(cant_camisas);
			$("#almas").val(cant_camisas);
			$("#mariposas").val(cant_camisas);
			$("#promedio").val(prom);
			$("#marquillas_c").val(cant_camisas);
			$("#plumillas").val(2*cant_camisas);
			c_telas();
			c_bolsas();
			c_bolsas();
			c_plumillas()
			c_mariposas()
			c_hormacuellos_l()
			c_hormacuellos_p()
			c_cuello()
			c_cuello2()
			c_marq_c()
			c_cintas();
			c_marq();
			c_entre();
			var tot_bot=c_mangas()+c_bolsillo()+window.botones*cant_camisas;
			c_tot_bot(tot_bot)
			$("#botones").val(tot_bot);	
		}
	});	
}
function c_entre(){
}
function c_marq(){
	var telas=$("#cant_telas").val();
	var col_sl=0;
	$('[name="referencia"]').each(function(index, element) {
		if($('[name="37"]').eq(index).val()=='') col_sl+=0; else col_sl+=parseInt($('[name="37"]').eq(index).val())
		$('[name="37m"]').eq(index).show("slow")
		$('[name="37m"]').eq(index).val(col_sl*telas)
		col_sl=0;
		if($('[name="38"]').eq(index).val()=='') col_sl+=0; else col_sl+=parseInt($('[name="38"]').eq(index).val())
		$('[name="38m"]').eq(index).show("slow")
		$('[name="38m"]').eq(index).val(col_sl*telas)
		col_sl=0;
		if($('[name="39"]').eq(index).val()=='') col_sl+=0; else col_sl+=parseInt($('[name="39"]').eq(index).val())
		$('[name="39m"]').eq(index).show("slow")
		$('[name="39m"]').eq(index).val(col_sl*telas)
		col_sl=0;
		if($('[name="40"]').eq(index).val()=='') col_sl+=0; else col_sl+=parseInt($('[name="40"]').eq(index).val())
		$('[name="40m"]').eq(index).show("slow")
		$('[name="40m"]').eq(index).val(col_sl*telas)
		col_sl=0;
		if($('[name="41"]').eq(index).val()=='') col_sl+=0; else col_sl+=parseInt($('[name="41"]').eq(index).val())
		$('[name="41m"]').eq(index).show("slow")
		$('[name="41m"]').eq(index).val(col_sl*telas)
		col_sl=0;
		if($('[name="42"]').eq(index).val()=='') col_sl+=0; else col_sl+=parseInt($('[name="42"]').eq(index).val())
		$('[name="42m"]').eq(index).show("slow")
		$('[name="42m"]').eq(index).val(col_sl*telas)
		col_sl=0;
		if($('[name="44"]').eq(index).val()=='') col_sl+=0; else col_sl+=parseInt($('[name="44"]').eq(index).val())
		$('[name="44m"]').eq(index).show("slow")
		$('[name="44m"]').eq(index).val(col_sl*telas)
		col_sl=0;
		if($('[name="46"]').eq(index).val()=='') col_sl+=0; else col_sl+=parseInt($('[name="46"]').eq(index).val())
		$('[name="46m"]').eq(index).show("slow")
		$('[name="46m"]').eq(index).val(col_sl*telas)
		col_sl=0;
	})
	maximos_marq()
}
function maximos_marq(){
	var maxi=0;
	$('[name="referencia"]').each(function(index, element) {
		if($(this).val()=='Colección'){
			if($('[name="diseno_t"]').eq(index).val()=='Slim'){
				$('[name="37m"]').eq(index).attr("title","Máximo "+$("#col_sl37").val());
				maxi=$("#col_sl37").val();
				$('[name="37m"]').eq(index).attr("onkeyup","verifica(this); funcion_maximos(this,"+maxi+")"); 
				maximos_marq2('[name="37m"]',index,$("#col_sl37").val())
				
				$('[name="38m"]').eq(index).attr("title","Máximo "+$("#col_sl38").val());
				maxi=$("#col_sl38").val();
				$('[name="38m"]').eq(index).attr("onkeyup","verifica(this); funcion_maximos(this,"+maxi+")"); 
				maximos_marq2('[name="38m"]',index,$("#col_sl38").val())
				
				$('[name="39m"]').eq(index).attr("title","Máximo "+$("#col_sl39").val());
				maxi=$("#col_sl39").val();
				$('[name="39m"]').eq(index).attr("onkeyup","verifica(this); funcion_maximos(this,"+maxi+")"); 
				maximos_marq2('[name="39m"]',index,$("#col_sl39").val())
				
				$('[name="40m"]').eq(index).attr("title","Máximo "+$("#col_sl40").val());
				maxi=$("#col_sl40").val();
				$('[name="40m"]').eq(index).attr("onkeyup","verifica(this); funcion_maximos(this,"+maxi+")"); 
				maximos_marq2('[name="40m"]',index,$("#col_sl40").val())
				
				$('[name="41m"]').eq(index).attr("title","Máximo "+$("#col_sl41").val());
				maxi=$("#col_sl41").val();
				$('[name="41m"]').eq(index).attr("onkeyup","verifica(this); funcion_maximos(this,"+maxi+")"); 
				maximos_marq2('[name="41m"]',index,$("#col_sl41").val())
				
				$('[name="42m"]').eq(index).attr("title","Máximo "+$("#col_sl42").val());
				maxi=$("#col_sl42").val();
				$('[name="42m"]').eq(index).attr("onkeyup","verifica(this); funcion_maximos(this,"+maxi+")"); 
				maximos_marq2('[name="42m"]',index,$("#col_sl42").val())
				
				$('[name="44m"]').eq(index).attr("title","Máximo "+$("#col_sl44").val());
				maxi=$("#col_sl44").val();
				$('[name="44m"]').eq(index).attr("onkeyup","verifica(this); funcion_maximos(this,"+maxi+")"); 
				maximos_marq2('[name="44m"]',index,$("#col_sl44").val())
				
				$('[name="46m"]').eq(index).attr("title","Máximo "+$("#col_sl46").val()); 
				maxi=$("#col_sl46").val();
				$('[name="46m"]').eq(index).attr("onkeyup","verifica(this); funcion_maximos(this,"+maxi+")"); 
				maximos_marq2('[name="46m"]',index,$("#col_sl46").val())
			}else if($('[name="diseno_t"]').eq(index).val()=='Clásica'){
				$('[name="37m"]').eq(index).attr("title","Máximo "+$("#col_cl37").val()); 
				maxi=$("#col_cl37").val();
				$('[name="37m"]').eq(index).attr("onkeyup","verifica(this); funcion_maximos(this,"+maxi+")"); 
				maximos_marq2('[name="37m"]',index,$("#col_cl37").val())
				
				$('[name="38m"]').eq(index).attr("title","Máximo "+$("#col_cl38").val()); 
				maxi=$("#col_cl38").val();
				$('[name="38m"]').eq(index).attr("onkeyup","verifica(this); funcion_maximos(this,"+maxi+")"); 
				maximos_marq2('[name="38m"]',index,$("#col_cl38").val())
				
				$('[name="39m"]').eq(index).attr("title","Máximo "+$("#col_cl39").val()); 
				maxi=$("#col_cl39").val();
				$('[name="39m"]').eq(index).attr("onkeyup","verifica(this); funcion_maximos(this,"+maxi+")"); 
				maximos_marq2('[name="39m"]',index,$("#col_cl39").val())
				
				$('[name="40m"]').eq(index).attr("title","Máximo "+$("#col_cl40").val()); 
				maxi=$("#col_cl40").val();
				$('[name="40m"]').eq(index).attr("onkeyup","verifica(this); funcion_maximos(this,"+maxi+")"); 
				maximos_marq2('[name="40m"]',index,$("#col_cl40").val())
				
				$('[name="41m"]').eq(index).attr("title","Máximo "+$("#col_cl41").val()); 
				maxi=$("#col_cl41").val();
				$('[name="41m"]').eq(index).attr("onkeyup","verifica(this); funcion_maximos(this,"+maxi+")"); 
				maximos_marq2('[name="41m"]',index,$("#col_cl41").val())
				
				$('[name="42m"]').eq(index).attr("title","Máximo "+$("#col_cl42").val()); 
				maxi=$("#col_cl42").val();
				$('[name="42m"]').eq(index).attr("onkeyup","verifica(this); funcion_maximos(this,"+maxi+")"); 
				maximos_marq2('[name="42m"]',index,$("#col_cl42").val())
				
				$('[name="44m"]').eq(index).attr("title","Máximo "+$("#col_cl44").val()); 
				maxi=$("#col_cl44").val();
				$('[name="44m"]').eq(index).attr("onkeyup","verifica(this); funcion_maximos(this,"+maxi+")"); 
				maximos_marq2('[name="44m"]',index,$("#col_cl44").val())
				
				$('[name="46m"]').eq(index).attr("title","Máximo "+$("#col_cl46").val()); 
				maxi=$("#col_cl46").val();
				$('[name="46m"]').eq(index).attr("onkeyup","verifica(this); funcion_maximos(this,"+maxi+")"); 
				maximos_marq2('[name="46m"]',index,$("#col_cl46").val())
			}
		}
		
		else if($(this).val()=='Exclusiva'){
			if($('[name="diseno_t"]').eq(index).val()=='Slim'){
				$('[name="37m"]').eq(index).attr("title","Máximo "+$("#exc_sl37").val());
				maxi=$("#exc_sl37").val();
				$('[name="37m"]').eq(index).attr("onkeyup","verifica(this); funcion_maximos(this,"+maxi+")"); 
				maximos_marq2('[name="37m"]',index,$("#exc_sl37").val())
				
				$('[name="38m"]').eq(index).attr("title","Máximo "+$("#exc_sl38").val());
				maxi=$("#exc_sl38").val();
				$('[name="38m"]').eq(index).attr("onkeyup","verifica(this); funcion_maximos(this,"+maxi+")"); 
				maximos_marq2('[name="38m"]',index,$("#exc_sl38").val())
				
				$('[name="39m"]').eq(index).attr("title","Máximo "+$("#exc_sl39").val());
				maxi=$("#exc_sl39").val();
				$('[name="39m"]').eq(index).attr("onkeyup","verifica(this); funcion_maximos(this,"+maxi+")"); 
				maximos_marq2('[name="39m"]',index,$("#exc_sl39").val())
				
				$('[name="40m"]').eq(index).attr("title","Máximo "+$("#exc_sl40").val());
				maxi=$("#exc_sl40").val();
				$('[name="40m"]').eq(index).attr("onkeyup","verifica(this); funcion_maximos(this,"+maxi+")"); 
				maximos_marq2('[name="40m"]',index,$("#exc_sl40").val())
				
				$('[name="41m"]').eq(index).attr("title","Máximo "+$("#exc_sl41").val());
				maxi=$("#exc_sl41").val();
				$('[name="41m"]').eq(index).attr("onkeyup","verifica(this); funcion_maximos(this,"+maxi+")"); 
				maximos_marq2('[name="41m"]',index,$("#exc_sl41").val())
				
				$('[name="42m"]').eq(index).attr("title","Máximo "+$("#exc_sl42").val());
				maxi=$("#exc_sl42").val();
				$('[name="42m"]').eq(index).attr("onkeyup","verifica(this); funcion_maximos(this,"+maxi+")"); 
				maximos_marq2('[name="42m"]',index,$("#exc_sl42").val())
				
				$('[name="44m"]').eq(index).attr("title","Máximo "+$("#exc_sl44").val());
				maxi=$("#exc_sl44").val();
				$('[name="44m"]').eq(index).attr("onkeyup","verifica(this); funcion_maximos(this,"+maxi+")"); 
				maximos_marq2('[name="44m"]',index,$("#exc_sl44").val())
				
				$('[name="46m"]').eq(index).attr("title","Máximo "+$("#exc_sl46").val()); 
				maxi=$("#exc_sl46").val();
				$('[name="46m"]').eq(index).attr("onkeyup","verifica(this); funcion_maximos(this,"+maxi+")"); 
				maximos_marq2('[name="46m"]',index,$("#exc_sl46").val())
			}else if($('[name="diseno_t"]').eq(index).val()=='Clásica'){
				$('[name="37m"]').eq(index).attr("title","Máximo "+$("#exc_cl37").val()); 
				maxi=$("#exc_cl37").val();
				$('[name="37m"]').eq(index).attr("onkeyup","verifica(this); funcion_maximos(this,"+maxi+")"); 
				maximos_marq2('[name="37m"]',index,$("#exc_cl37").val())
				
				$('[name="38m"]').eq(index).attr("title","Máximo "+$("#exc_cl38").val()); 
				maxi=$("#exc_cl38").val();
				$('[name="38m"]').eq(index).attr("onkeyup","verifica(this); funcion_maximos(this,"+maxi+")"); 
				maximos_marq2('[name="38m"]',index,$("#exc_cl38").val())
				
				$('[name="39m"]').eq(index).attr("title","Máximo "+$("#exc_cl39").val()); 
				maxi=$("#exc_cl39").val();
				$('[name="39m"]').eq(index).attr("onkeyup","verifica(this); funcion_maximos(this,"+maxi+")"); 
				maximos_marq2('[name="39m"]',index,$("#exc_cl39").val())
				
				$('[name="40m"]').eq(index).attr("title","Máximo "+$("#exc_cl40").val()); 
				maxi=$("#exc_cl40").val();
				$('[name="40m"]').eq(index).attr("onkeyup","verifica(this); funcion_maximos(this,"+maxi+")"); 
				maximos_marq2('[name="40m"]',index,$("#exc_cl40").val())
				
				$('[name="41m"]').eq(index).attr("title","Máximo "+$("#exc_cl41").val()); 
				maxi=$("#exc_cl41").val();
				$('[name="41m"]').eq(index).attr("onkeyup","verifica(this); funcion_maximos(this,"+maxi+")"); 
				maximos_marq2('[name="41m"]',index,$("#exc_cl41").val())
				
				$('[name="42m"]').eq(index).attr("title","Máximo "+$("#exc_cl42").val()); 
				maxi=$("#exc_cl42").val();
				$('[name="42m"]').eq(index).attr("onkeyup","verifica(this); funcion_maximos(this,"+maxi+")"); 
				maximos_marq2('[name="42m"]',index,$("#exc_cl42").val())
				
				$('[name="44m"]').eq(index).attr("title","Máximo "+$("#exc_cl44").val()); 
				maxi=$("#exc_cl44").val();
				$('[name="44m"]').eq(index).attr("onkeyup","verifica(this); funcion_maximos(this,"+maxi+")"); 
				maximos_marq2('[name="44m"]',index,$("#exc_cl44").val())
				
				$('[name="46m"]').eq(index).attr("title","Máximo "+$("#exc_cl46").val()); 
				maxi=$("#exc_cl46").val();
				$('[name="46m"]').eq(index).attr("onkeyup","verifica(this); funcion_maximos(this,"+maxi+")"); 
				maximos_marq2('[name="46m"]',index,$("#exc_cl46").val())
			}
		}
		
		else if($(this).val()=='Royal'){
			if($('[name="diseno_t"]').eq(index).val()=='Slim'){
				
				$('[name="37m"]').eq(index).attr("title","Máximo "+$("#roy_sl37").val());
				maxi=$("#roy_sl37").val();
				$('[name="37m"]').eq(index).attr("onkeyup","verifica(this); funcion_maximos(this,"+maxi+")"); 
				maximos_marq2('[name="37m"]',index,$("#roy_sl37").val())
				
				$('[name="38m"]').eq(index).attr("title","Máximo "+$("#roy_sl38").val());
				maxi=$("#roy_sl38").val();
				$('[name="38m"]').eq(index).attr("onkeyup","verifica(this); funcion_maximos(this,"+maxi+")"); 
				maximos_marq2('[name="38m"]',index,$("#roy_sl38").val())
				
				$('[name="39m"]').eq(index).attr("title","Máximo "+$("#roy_sl39").val());
				maxi=$("#roy_sl39").val();
				$('[name="39m"]').eq(index).attr("onkeyup","verifica(this); funcion_maximos(this,"+maxi+")"); 
				maximos_marq2('[name="39m"]',index,$("#roy_sl39").val())
				
				$('[name="40m"]').eq(index).attr("title","Máximo "+$("#roy_sl40").val());
				maxi=$("#roy_sl40").val();
				$('[name="40m"]').eq(index).attr("onkeyup","verifica(this); funcion_maximos(this,"+maxi+")"); 
				maximos_marq2('[name="40m"]',index,$("#roy_sl40").val())
				
				$('[name="41m"]').eq(index).attr("title","Máximo "+$("#roy_sl41").val());
				maxi=$("#roy_sl41").val();
				$('[name="41m"]').eq(index).attr("onkeyup","verifica(this); funcion_maximos(this,"+maxi+")"); 
				maximos_marq2('[name="41m"]',index,$("#roy_sl41").val())
				
				$('[name="42m"]').eq(index).attr("title","Máximo "+$("#roy_sl42").val());
				maxi=$("#roy_sl42").val();
				$('[name="42m"]').eq(index).attr("onkeyup","verifica(this); funcion_maximos(this,"+maxi+")"); 
				maximos_marq2('[name="42m"]',index,$("#roy_sl42").val())
				
				$('[name="44m"]').eq(index).attr("title","Máximo "+$("#roy_sl44").val());
				maxi=$("#roy_sl44").val();
				$('[name="44m"]').eq(index).attr("onkeyup","verifica(this); funcion_maximos(this,"+maxi+")"); 
				maximos_marq2('[name="44m"]',index,$("#roy_sl44").val())
				
				$('[name="46m"]').eq(index).attr("title","Máximo "+$("#roy_sl46").val()); 
				maxi=$("#roy_sl46").val();
				$('[name="46m"]').eq(index).attr("onkeyup","verifica(this); funcion_maximos(this,"+maxi+")"); 
				maximos_marq2('[name="46m"]',index,$("#roy_sl46").val())
			}else if($('[name="diseno_t"]').eq(index).val()=='Clásica'){
				$('[name="37m"]').eq(index).attr("title","Máximo "+$("#roy_cl37").val()); 
				maxi=$("#roy_cl37").val();
				$('[name="37m"]').eq(index).attr("onkeyup","verifica(this); funcion_maximos(this,"+maxi+")"); 
				maximos_marq2('[name="37m"]',index,$("#roy_cl37").val())
				
				$('[name="38m"]').eq(index).attr("title","Máximo "+$("#roy_cl38").val()); 
				maxi=$("#roy_cl38").val();
				$('[name="38m"]').eq(index).attr("onkeyup","verifica(this); funcion_maximos(this,"+maxi+")"); 
				maximos_marq2('[name="38m"]',index,$("#roy_cl38").val())
				
				$('[name="39m"]').eq(index).attr("title","Máximo "+$("#roy_cl39").val()); 
				maxi=$("#roy_cl39").val();
				$('[name="39m"]').eq(index).attr("onkeyup","verifica(this); funcion_maximos(this,"+maxi+")"); 
				maximos_marq2('[name="39m"]',index,$("#roy_cl39").val())
				
				$('[name="40m"]').eq(index).attr("title","Máximo "+$("#roy_cl40").val()); 
				maxi=$("#roy_cl40").val();
				$('[name="40m"]').eq(index).attr("onkeyup","verifica(this); funcion_maximos(this,"+maxi+")"); 
				maximos_marq2('[name="40m"]',index,$("#roy_cl40").val())
				
				$('[name="41m"]').eq(index).attr("title","Máximo "+$("#roy_cl41").val()); 
				maxi=$("#roy_cl41").val();
				$('[name="41m"]').eq(index).attr("onkeyup","verifica(this); funcion_maximos(this,"+maxi+")"); 
				maximos_marq2('[name="41m"]',index,$("#roy_cl41").val())
				
				$('[name="42m"]').eq(index).attr("title","Máximo "+$("#roy_cl42").val()); 
				maxi=$("#roy_cl42").val();
				$('[name="42m"]').eq(index).attr("onkeyup","verifica(this); funcion_maximos(this,"+maxi+")"); 
				maximos_marq2('[name="42m"]',index,$("#roy_cl42").val())
				$('[name="44m"]').eq(index).attr("title","Máximo "+$("#roy_cl44").val()); 
				maxi=$("#roy_cl44").val();
				$('[name="44m"]').eq(index).attr("onkeyup","verifica(this); funcion_maximos(this,"+maxi+")"); 
				maximos_marq2('[name="44m"]',index,$("#roy_cl44").val())
				$('[name="46m"]').eq(index).attr("title","Máximo "+$("#roy_cl46").val()); 
				maxi=$("#roy_cl46").val();
				$('[name="46m"]').eq(index).attr("onkeyup","verifica(this); funcion_maximos(this,"+maxi+")"); 
				maximos_marq2('[name="46m"]',index,$("#roy_cl46").val())
			}
		}
	})
}
function maximos_marq2(nombre,index,maximo){
	if(parseInt($(nombre).eq(index).val())>parseInt(maximo)) 
		$(nombre).eq(index).css("color","red")
	else $(nombre).eq(index).css("color","black")
}

function c_cintas(){
	var c_col=0;
	var c_exl=0;
	var c_roy=0;
	$('[name="referencia"]').each(function(index, element) {
		if($(this).val()=="Colección"){
			if($('[name="37"]').eq(index).val()=='') c_col+=0; else c_col+=parseInt($('[name="37"]').eq(index).val())
			if($('[name="38"]').eq(index).val()=='') c_col+=0; else c_col+=parseInt($('[name="38"]').eq(index).val())
			if($('[name="39"]').eq(index).val()=='') c_col+=0; else c_col+=parseInt($('[name="39"]').eq(index).val())
			if($('[name="40"]').eq(index).val()=='') c_col+=0; else c_col+=parseInt($('[name="40"]').eq(index).val())
			if($('[name="41"]').eq(index).val()=='') c_col+=0; else c_col+=parseInt($('[name="41"]').eq(index).val())
			if($('[name="42"]').eq(index).val()=='') c_col+=0; else c_col+=parseInt($('[name="42"]').eq(index).val())
			if($('[name="44"]').eq(index).val()=='') c_col+=0; else c_col+=parseInt($('[name="44"]').eq(index).val())
			if($('[name="46"]').eq(index).val()=='') c_col+=0; else c_col+=parseInt($('[name="46"]').eq(index).val())	
		}
		if($(this).val()=="Exclusiva"){
			if($('[name="37"]').eq(index).val()=='') c_exl+=0; else c_exl+=parseInt($('[name="37"]').eq(index).val())
			if($('[name="38"]').eq(index).val()=='') c_exl+=0; else c_exl+=parseInt($('[name="38"]').eq(index).val())
			if($('[name="39"]').eq(index).val()=='') c_exl+=0; else c_exl+=parseInt($('[name="39"]').eq(index).val())
			if($('[name="40"]').eq(index).val()=='') c_exl+=0; else c_exl+=parseInt($('[name="40"]').eq(index).val())
			if($('[name="41"]').eq(index).val()=='') c_exl+=0; else c_exl+=parseInt($('[name="41"]').eq(index).val())
			if($('[name="42"]').eq(index).val()=='') c_exl+=0; else c_exl+=parseInt($('[name="42"]').eq(index).val())
			if($('[name="44"]').eq(index).val()=='') c_exl+=0; else c_exl+=parseInt($('[name="44"]').eq(index).val())
			if($('[name="46"]').eq(index).val()=='') c_exl+=0; else c_exl+=parseInt($('[name="46"]').eq(index).val())	
		}
		if($(this).val()=="Royal"){
			if($('[name="37"]').eq(index).val()=='') c_roy+=0; else c_roy+=parseInt($('[name="37"]').eq(index).val())
			if($('[name="38"]').eq(index).val()=='') c_roy+=0; else c_roy+=parseInt($('[name="38"]').eq(index).val())
			if($('[name="39"]').eq(index).val()=='') c_roy+=0; else c_roy+=parseInt($('[name="39"]').eq(index).val())
			if($('[name="40"]').eq(index).val()=='') c_roy+=0; else c_roy+=parseInt($('[name="40"]').eq(index).val())
			if($('[name="41"]').eq(index).val()=='') c_roy+=0; else c_roy+=parseInt($('[name="41"]').eq(index).val())
			if($('[name="42"]').eq(index).val()=='') c_roy+=0; else c_roy+=parseInt($('[name="42"]').eq(index).val())
			if($('[name="44"]').eq(index).val()=='') c_roy+=0; else c_roy+=parseInt($('[name="44"]').eq(index).val())
			if($('[name="46"]').eq(index).val()=='') c_roy+=0; else c_roy+=parseInt($('[name="46"]').eq(index).val())	
		}
	})
	$("#c_coleccion, #e_coleccion").val(c_col*$("#cant_telas").val());
	$("#c_exclusiva, #e_exclusiva").val(c_exl*$("#cant_telas").val());
	$("#c_royal, #e_royal").val(c_roy*$("#cant_telas").val());
	var c_col_disp=parseInt($("#h_c_coleccion").val())
	var c_exc_disp=parseInt($("#h_c_exclusiva").val())
	var c_roy_disp=parseInt($("#h_c_royal").val())
	if(c_col_disp<c_col*$("#cant_telas").val()) $("#c_coleccion").css("color","red");
	else  $("#c_coleccion").css("color","black")
	if(c_exc_disp<c_exl*$("#cant_telas").val()) $("#c_exclusiva").css("color","red");
	else  $("#c_exclusiva").css("color","black")
	if(c_roy_disp<c_roy*$("#cant_telas").val()) $("#c_royal").css("color","red");
	else  $("#c_roy").css("color","black")
	var e_col_disp=parseInt($("#h_e_coleccion").val())
	var e_exc_disp=parseInt($("#h_e_exclusiva").val())
	var e_roy_disp=parseInt($("#h_e_royal").val())
	if(e_col_disp<c_col*$("#cant_telas").val()) $("#e_coleccion").css("color","red");
	else  $("#e_coleccion").css("color","black")
	if(e_exc_disp<c_exl*$("#cant_telas").val()) $("#e_exclusiva").css("color","red");
	else  $("#e_exclusiva").css("color","black")
	if(e_roy_disp<c_roy*$("#cant_telas").val()) $("#e_royal").css("color","red");
	else  $("#e_roy").css("color","black")	
}
function c_marq_c(){
	var marq_disp=parseInt($("#h_marquillas_c").val())
	var marq_nec=parseInt($("#marquillas_c").val())
	if(marq_disp<marq_nec) $("#marquillas_c").css("color","red");
	else  $("#marquillas_c").css("color","black")
}
function radio_cuello_bot(){
	$('[name="cuello_bot"]').each(function(index, element) {
        if($(this).is(":checked")){
			$('[name="cuello_bot_sel"]').eq(index).show("slow");			
		}else{
			$('[name="cuello_bot_sel"]').eq(index).hide("slow");	
			$('[name="cant_cuello_bots"]').eq(index).hide("slow");	
		}
    });
}
function c_tot_bot(tot_bot){
	var cant_disp=$("#h_botones").val()
	if(tot_bot>cant_disp) $("#botones").css("color","red"); else $("#botones").css("color","black");
}
function c_bolsillo(){
	var bolsillo=0;
	var t37=0; var t38=0; var t39=0; var t40=0; var  t41=0; var t42=0; var t44=0; var t46=0;
	$('[name="bolsillo"]').each(function(index, element) {
        if($(this).is(":checked")){
			if($('[name="37"]').eq(index).val()=='') t37+=0; else t37+=parseInt($('[name="37"]').eq(index).val())
			if($('[name="38"]').eq(index).val()=='') t38+=0; else t38+=parseInt($('[name="38"]').eq(index).val())
			if($('[name="39"]').eq(index).val()=='') t39+=0; else t39+=parseInt($('[name="39"]').eq(index).val())
			if($('[name="40"]').eq(index).val()=='') t40+=0; else t40+=parseInt($('[name="40"]').eq(index).val())
			if($('[name="41"]').eq(index).val()=='')  t41+=0; else t41+=parseInt($('[name="41"]').eq(index).val())
			if($('[name="42"]').eq(index).val()=='') t42+=0; else t42+=parseInt($('[name="42"]').eq(index).val())
			if($('[name="44"]').eq(index).val()=='') t44+=0; else t44+=parseInt($('[name="44"]').eq(index).val())
			if($('[name="46"]').eq(index).val()=='') t46+=0; else t46+=parseInt($('[name="46"]').eq(index).val())
		}
    });
	bolsillo= (t37+t38+t39+t40+t41+t42+t44+t46)*parseFloat($("#cant_telas").val());
	return bolsillo;
}
function c_cuello2(){
	$('[name="cuello_bot"]').each(function(index, element) {
		var cuello=0;
		var t37=0; var t38=0; var t39=0; var t40=0; var  t41=0; var t42=0; var t44=0; var t46=0;
        if($(this).is(":checked")){
			if($('[name="37"]').eq(index).val()=='') t37+=0; else t37+=parseInt($('[name="37"]').eq(index).val())
			if($('[name="38"]').eq(index).val()=='') t38+=0; else t38+=parseInt($('[name="38"]').eq(index).val())
			if($('[name="39"]').eq(index).val()=='') t39+=0; else t39+=parseInt($('[name="39"]').eq(index).val())
			if($('[name="40"]').eq(index).val()=='') t40+=0; else t40+=parseInt($('[name="40"]').eq(index).val())
			if($('[name="41"]').eq(index).val()=='')  t41+=0; else t41+=parseInt($('[name="41"]').eq(index).val())
			if($('[name="42"]').eq(index).val()=='') t42+=0; else t42+=parseInt($('[name="42"]').eq(index).val())
			if($('[name="44"]').eq(index).val()=='') t44+=0; else t44+=parseInt($('[name="44"]').eq(index).val())
			if($('[name="46"]').eq(index).val()=='') t46+=0; else t46+=parseInt($('[name="46"]').eq(index).val())
			cuello= (t37+t38+t39+t40+t41+t42+t44+t46)*parseFloat($("#cant_telas").val())*2;
			$('[name="cant_cuello_bots"]').eq(index).show("slow")
			$('[name="cant_cuello_bots"]').eq(index).val(cuello)
		}else{
			$('[name="cant_cuello_bots"]').eq(index).hide("slow")
		}
    });
	
}
function c_cuello(){
	var cuello=0;
	var t37=0; var t38=0; var t39=0; var t40=0; var  t41=0; var t42=0; var t44=0; var t46=0;
	$('[name="cuello_bot"]').each(function(index, element) {
        if($(this).is(":checked")){
			if($('[name="37"]').eq(index).val()=='') t37+=0; else t37+=parseInt($('[name="37"]').eq(index).val())
			if($('[name="38"]').eq(index).val()=='') t38+=0; else t38+=parseInt($('[name="38"]').eq(index).val())
			if($('[name="39"]').eq(index).val()=='') t39+=0; else t39+=parseInt($('[name="39"]').eq(index).val())
			if($('[name="40"]').eq(index).val()=='') t40+=0; else t40+=parseInt($('[name="40"]').eq(index).val())
			if($('[name="41"]').eq(index).val()=='')  t41+=0; else t41+=parseInt($('[name="41"]').eq(index).val())
			if($('[name="42"]').eq(index).val()=='') t42+=0; else t42+=parseInt($('[name="42"]').eq(index).val())
			if($('[name="44"]').eq(index).val()=='') t44+=0; else t44+=parseInt($('[name="44"]').eq(index).val())
			if($('[name="46"]').eq(index).val()=='') t46+=0; else t46+=parseInt($('[name="46"]').eq(index).val())
		}
    });
	cuello= (t37+t38+t39+t40+t41+t42+t44+t46)*parseFloat($("#cant_telas").val())*2;
	$("#bot_cuello").val(cuello)
}
function c_mangas(){
	var manga_l=0;
	var charret=0;
	var t37=0; var t38=0; var t39=0; var t40=0; var  t41=0; var t42=0; var t44=0; var t46=0;
	$('[name="manga"]').each(function(index, element) {
        if($(this).val()=='Larga'){
			if($('[name="37"]').eq(index).val()=='') t37+=0; else t37+=parseInt($('[name="37"]').eq(index).val())
			if($('[name="38"]').eq(index).val()=='') t38+=0; else t38+=parseInt($('[name="38"]').eq(index).val())
			if($('[name="39"]').eq(index).val()=='') t39+=0; else t39+=parseInt($('[name="39"]').eq(index).val())
			if($('[name="40"]').eq(index).val()=='') t40+=0; else t40+=parseInt($('[name="40"]').eq(index).val())
			if($('[name="41"]').eq(index).val()=='')  t41+=0; else t41+=parseInt($('[name="41"]').eq(index).val())
			if($('[name="42"]').eq(index).val()=='') t42+=0; else t42+=parseInt($('[name="42"]').eq(index).val())
			if($('[name="44"]').eq(index).val()=='') t44+=0; else t44+=parseInt($('[name="44"]').eq(index).val())
			if($('[name="46"]').eq(index).val()=='') t46+=0; else t46+=parseInt($('[name="46"]').eq(index).val()) 		
		}
    });
	manga_l= (t37+t38+t39+t40+t41+t42+t44+t46)*parseFloat($("#cant_telas").val())*4;
	t37=0;t38=0;t39=0;t40=0;t41=0;t42=0;t44=0;t46=0;
	var charr_manga=0;
	$('[name="charretera"]').each(function(index, element) {
        if($(this).is(":checked")){
			if($('[name="37"]').eq(index).val()=='') t37+=0; else t37+=parseInt($('[name="37"]').eq(index).val())
			if($('[name="38"]').eq(index).val()=='') t38+=0; else t38+=parseInt($('[name="38"]').eq(index).val())
			if($('[name="39"]').eq(index).val()=='') t39+=0; else t39+=parseInt($('[name="39"]').eq(index).val())
			if($('[name="40"]').eq(index).val()=='') t40+=0; else t40+=parseInt($('[name="40"]').eq(index).val())
			if($('[name="41"]').eq(index).val()=='')  t41+=0; else t41+=parseInt($('[name="41"]').eq(index).val())
			if($('[name="42"]').eq(index).val()=='') t42+=0; else t42+=parseInt($('[name="42"]').eq(index).val())
			if($('[name="44"]').eq(index).val()=='') t44+=0; else t44+=parseInt($('[name="44"]').eq(index).val())
			if($('[name="46"]').eq(index).val()=='') t46+=0; else t46+=parseInt($('[name="46"]').eq(index).val())
		}
    });
	charr_manga= (t37+t38+t39+t40+t41+t42+t44+t46)*parseFloat($("#cant_telas").val())*2;
	return charr_manga+manga_l;
}
function c_hormacuellos_p(){
	var cant=0;
	$('[name="37"]').each(function(index, element) {
        if($(this).val()=="") cant+=0; else cant+=parseInt($(this).val())
    });
	$('[name="38"]').each(function(index, element) {
        if($(this).val()=="") cant+=0; else cant+=parseInt($(this).val())
    });
	$('[name="39"]').each(function(index, element) {
        if($(this).val()=="") cant+=0; else cant+=parseInt($(this).val())
    });
	$('[name="40"]').each(function(index, element) {
        if($(this).val()=="") cant+=0; else cant+=parseInt($(this).val())
    });
	cant=cant*parseFloat($("#cant_telas").val());
	$("#hormacuellos_p").val(cant);
	var disp=parseInt($("#h_hormacuellos_p").val())
	if(disp<cant) $("#hormacuellos_p").css("color","red");
	else  $("#hormacuellos_p").css("color","black")
}
function c_hormacuellos_l(){
	var cant=0;
	$('[name="41"]').each(function(index, element) {
        if($(this).val()=="") cant+=0; else cant+=parseInt($(this).val())
    });
	$('[name="42"]').each(function(index, element) {
        if($(this).val()=="") cant+=0; else cant+=parseInt($(this).val())
    });
	$('[name="44"]').each(function(index, element) {
        if($(this).val()=="") cant+=0; else cant+=parseInt($(this).val())
    });
	$('[name="46"]').each(function(index, element) {
        if($(this).val()=="") cant+=0; else cant+=parseInt($(this).val())
    });
	cant=cant*parseFloat($("#cant_telas").val());
	$("#hormacuellos_l").val(cant);
	var disp=parseInt($("#h_hormacuellos_l").val())
	if(disp<cant) $("#hormacuellos_l").css("color","red");
	else  $("#hormacuellos_l").css("color","black")
}
function c_mariposas(){
	var alms_disp=parseInt($("#h_mariposas").val())
	var alms_nec=parseInt($("#mariposas").val())
	if(alms_disp<alms_nec) $("#mariposas").css("color","red");
	else  $("#mariposas").css("color","black")
}
function c_almas(){
	var alms_disp=parseInt($("#h_almas").val())
	var alms_nec=parseInt($("#almas").val())
	if(alms_disp<alms_nec) $("#almas").css("color","red");
	else  $("#almas").css("color","black")
}
function c_bolsas(){
	var bols_disp=parseInt($("#h_bolsas").val())
	var bols_nec=parseInt($("#bolsas").val())
	if(bols_disp<bols_nec) $("#bolsas").css("color","red");
	else  $("#bolsas").css("color","black")
}
function c_plumillas(){
	var plu_disp=parseInt($("#h_plumillas").val())
	var plu_nec=parseInt($("#plumillas").val())
	if(plu_disp<plu_nec) $("#plumillas").css("color","red");
	else  $("#plumillas").css("color","black")
}
function c_telas(){
	var cant_telas=parseFloat($("#cant_telas").val());
	var largo=parseFloat($("#largo").val());
	var h_telas = parseFloat($("#h_telas").val());
	var metros = (largo*cant_telas).toFixed(2)
	$("#metros").val(metros);
	if(h_telas<metros) $("#metros").css("color","red");
	else  $("#metros").css("color","black")
}

function rec_tipos_tel(){
	var filtro=$("#filtro").val();
	$("#rec_tipos_t").load("stin_corte1.php?filtro=" + encodeURIComponent(filtro)  + " #rec_tipos_t ");
	$("#rec_orden").load("stin_corte1.php?filtro=" + encodeURIComponent(filtro)  + " #rec_orden ");
	$("#rec_bots").load("stin_corte1.php?filtro=" + encodeURIComponent(filtro)  + " #rec_bots " , function(resp, stat, xhr){
		if (stat == 'success'){
			$('[name="cuello_bot_sel"]').each(function(index, element) {
				$(this).find('option').remove();
				var op = $('#tipo_boton option');
				var values = $.map(op ,function(option) {
					$('[name="cuello_bot_sel"]').eq(index).append($('<option>', { 
						value: option.value,
						text : option.text 
					}));
				})
    		});
			
		}
	});
	$("#rec_entretelas").load("stin_corte1.php?filtro=" + encodeURIComponent(filtro)  + " #rec_entretelas " , function(resp, stat, xhr){
		if (stat == 'success'){
			$('[name="entretela"]').each(function(index, element) {
				$(this).find('option').remove();
				var op = $('#tipo_entretela option');
				var values = $.map(op ,function(option) {
					$('[name="entretela"]').eq(index).append($('<option>', { 
						value: option.value,
						text : option.text 
					}));
				})
    		});
			
		}
	});
}
function funcion_maximos(itm, maxi){
	var valor=$(itm).val()
	if(valor>maxi) $(itm).css("color","red")
	else  $(itm).css("color","black")
}
function cantidad_tallas(){
	var tallas;
	var t37=0; var t38=0; var t39=0; var t40=0; var t41=0; var t42=0; var t44=0; var t46=0;
	$('[name="37"]').each(function(index, element) {
		var valor=$(this).val();
		if(valor=='') valor =0; 
		else valor = parseInt($(this).val())
		t37+=valor;
    });
	$('[name="38"]').each(function(index, element) {
		var valor=$(this).val();
		if(valor=='') valor =0; 
		else valor = parseInt($(this).val())
		t38+=valor;
    });
	$('[name="39"]').each(function(index, element) {
		var valor=$(this).val();
		if(valor=='') valor =0; 
		else valor = parseInt($(this).val())
		t39+=valor;
    });
	$('[name="40"]').each(function(index, element) {
		var valor=$(this).val();
		if(valor=='') valor =0; 
		else valor = parseInt($(this).val())
		t40+=valor;
    });
	$('[name="41"]').each(function(index, element) {
		var valor=$(this).val();
		if(valor=='') valor =0; 
		else valor = parseInt($(this).val())
		t41+=valor;
    });
	$('[name="42"]').each(function(index, element) {
		var valor=$(this).val();
		if(valor=='') valor =0; 
		else valor = parseInt($(this).val())
		t42+=valor;
    });
	$('[name="44"]').each(function(index, element) {
		var valor=$(this).val();
		if(valor=='') valor =0; 
		else valor = parseInt($(this).val())
		t44+=valor;
    });
	$('[name="46"]').each(function(index, element) {
		var valor=$(this).val();
		if(valor=='') valor =0; 
		else valor = parseInt($(this).val())
		t46+=valor;
    });
	tallas=t37+t38+t39+t40+t41+t42+t44+t46;
	return tallas;
}
function bandera(){
	var filtro=$("#filtro").val()
	var id_ins=$("#tipo_insumo").val()
	var cant_telas=$("#cant_telas").val()
	var largo=$("#largo").val()
	var band=0;
	var boton=$("#tipo_boton").val()
	if(filtro==''){ 
		$("#filtro").effect("pulsate", { times:5 }, 3000);
		band=1;
	}
	if(id_ins==''){ 
		$("#tipo_insumo").effect("pulsate", { times:5 }, 3000);
		band=1;
	}
	if(cant_telas==''){ 
		$("#cant_telas").effect("pulsate", { times:5 }, 3000);
		band=1;
	}
	if(largo==''){ 
		$("#largo").effect("pulsate", { times:5 }, 3000);
		band=1;
	}
	if(boton==''){ 
		$("#tipo_boton").effect("pulsate", { times:5 }, 3000);
		band=1;
	}
	$("[name=manga]").each(function(index, element) {
        if($(this).val()==''){ 
			$(this).effect("pulsate", { times:5 }, 3000);
			band=1;
		}
    });
	$("[name=cuello_bot_sel]").each(function(index, element) {
        if($(this).val()=='' && $(this).is(":visible")){ 
			$(this).effect("pulsate", { times:5 }, 3000);
			band=1;
		}
    });
	$("[name=referencia]").each(function(index, element) {
        if($(this).val()==''){ 
			$(this).effect("pulsate", { times:5 }, 3000);
			band=1;
		}
    });
	$("[name=diseno_t]").each(function(index, element) {
        if($(this).val()==''){ 
			$(this).effect("pulsate", { times:5 }, 3000);
			band=1;
		}
    });
	$("[name=entretela]").each(function(index, element) {
        if($(this).val()==''){ 
			$(this).effect("pulsate", { times:5 }, 3000);
			band=1;
		}
    });
	return band;
}
function descripcion(){
	var cant=$("#diseno").val();
	var $tabla = $("[name=des_diseno]").first();
	
	for(i=1;i<cant;i++){
		$("[name=des_diseno]").last().after($tabla.clone())
		
	}	
	while(cant!=$("[name=des_diseno]").length){
		$("[name=des_diseno]").last().remove();
		
	}
	$("[name=diseno]").each(function(index, element) {
        if(index!=0){
			$(this).remove();
		}
    });	
}
function verifica(itm){
	var valor=itm.value;
	var itm_id=itm.id;
	while(isNaN(valor)||valor.match(' ')||/\./.test(valor)||valor.match(/\,/g)){
		var valor=valor.substring(0,valor.length-1);
		$(itm).val(valor);		
	}
}
function verifica2(itm){
	var valor=itm.value;
	var itm_id=itm.id;
	while(isNaN(valor)||valor.match(' ')){
		var valor=valor.substring(0,valor.length-1);
		$("#"+itm_id).val(valor);		
	}
}
function mensaje(msje, pulsar){
	$("#dialog").html(msje).css('text-align','center');
	$("#dialog").prepend('<img id="theImg2" src="img/warning.png" width="43" height="31"/>');
	$("span.ui-dialog-title").text('Información Importante').css("text-align", "center"); 
	$("#dialog").dialog("open");
	setTimeout(function () {
	   $("#dialog").dialog("close");
	}, 2000);
	$(pulsar).effect("pulsate", { times:3 }, 3000);
}

/////////////////////////////////////////////////
var dialogwidth=400
$(function() {
    $( "#dialog2" ).dialog({
      autoOpen: false,
	  width: dialogwidth,
	  height: 'auto',
	  show: {effect: 'explode'},
	  hide: {effect: 'explode'},	  
	  position: [($(window).width() / 2) - (dialogwidth / 2), 150],
	  toolbar: false, 
	  close: function() { overlay.hide() }, 	     
    });
})
$(function () {
	$.datepicker.setDefaults($.datepicker.regional["es"]);
	$("#fecha").datepicker({ dateFormat: "yy-mm-dd",
		firstDay: 1,
		changeMonth: true,
		changeYear: true,
		dayNamesMin: ["Do", "Lu", "Ma", "Mi", "Ju", "Vi", "Sa"],
		dayNamesShort: ["Dom", "Lun", "Mar", "Mie", "Jue", "Vie", "Sab"],
		monthNames: 
			["Enero", "Febrero", "Marzo", "Abril", "Mayo", "Junio", "Julio",
			"Agosto", "Septiembre", "Octubre", "Noviembre", "Diciembre"],
		monthNamesShort: 
			["Ene", "Feb", "Mar", "Abr", "May", "Jun",
			"Jul", "Ago", "Sep", "Oct", "Nov", "Dic"],
	});						
});	
</script>