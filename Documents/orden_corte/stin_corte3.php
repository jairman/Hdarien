<?php require_once('joom.php'); ?>
<?php require_once('../Connections/conexion.php'); ?>
<?php
if ($acceso =='0'){ 
//echo "hola ". $acceso;
?>
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
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Documento sin título</title>
<link href="../css/clean.css" rel="stylesheet" type="text/css" />
<link rel="stylesheet" type="text/css" href="http://code.jquery.com/ui/1.10.3/themes/smoothness/jquery-ui.css" />
<link href="css/shadowbox.css" rel="stylesheet" type="text/css" />
<link href="../css/style.css" rel="stylesheet" type="text/css" />
<script src="http://code.jquery.com/jquery-1.9.1.js"></script>
<script src="http://code.jquery.com/ui/1.10.1/jquery-ui.js"></script>
<link rel="stylesheet" href="http://code.jquery.com/ui/1.10.1/themes/base/jquery-ui.css" />
<script type="text/javascript" src="js/shadowbox.js"></script></script>
<script type="text/javascript">
Shadowbox.init({	
	onOpen: function() {
		$('#sb-info').after($('#sb-wrapper-inner'));
		$('#sb-wrapper-inner').after($('#sb-title'));
	},	
	handleOversize: "drag",
	modal: true,
	onClose: function(){ 	}
	
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
</style>
</head>

<body>


<p>&nbsp;</p>
<table width="90%" border="1" cellspacing="0" cellpadding="0" align="center">
  <tr bgcolor="#CCC">
    <td align="left" bgcolor="#FFFFFF" style="color:#FFF; border-right:none"><span style="font-size:20px"><strong style="margin-right:150px"><img src="../img/add.png" width="48" height="48"  alt="" style="float:right; margin-right:15px; cursor:pointer; margin-top:30px" onclick="location.href='stin_corte1.php'"/></strong></span></td>
  </tr>
</table>
<div id="dialog" >
</div>
<table  width="90%" border="1" cellspacing="0" cellpadding="0" align="center">
  <tr align="center" class="tittle">
    <td colspan="8" style="font-size:20px"><?php
	if($usuario=='general'){
		$rs_usus=mysql_query("SELECT DISTINCT hacienda FROM h01sg_vacunos",$conexion);	
		
	?>
      <select name="registro" id="filtro" style=" margin-left:15px; float:left"   required="required" onchange="recarga_tabla()">
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
     <input type="hidden" value="<?php echo $usuario ?>" id="filtro"  readonly="readonly" name="registro"/>
     <?php
	}
	 ?><strong style="margin-right:150px">Historial Orden de Corte 
     </strong></td>
  </tr>
</table>
  <div id="recarga">
  <?php
  $filtro=$_GET['filtro'];
  $rs_ord=mysql_query("SELECT * FROM orden_corte WHERE hacienda='$filtro' and `delete`=0");
  ?>
  <table  width="90%" border="1" cellspacing="0" cellpadding="0" align="center">
  <tr align="center" class="tittle">
    <td><strong>Orden No.</strong></td>
    <td>Fecha</td>
    <td><strong>Tipo</strong></td>
    <td><strong>Telas</strong></td>
    <td><strong>Largo</strong></td>
    <td><strong>Promedio</strong></td>
    <td>Total Camisas</td>
    <td>Responsable</td>
    <td><strong>Estado</strong></td>
  </tr>
  <?php while($row_ord = @mysql_fetch_assoc($rs_ord)){ 
  
  ?>
   <?php
	if($row_ord['estado']=='') $estado='Pendiente';
	else if($row_ord['estado']=='Finalizado') {
		$d=strtotime($row_ord['tiem']);
		$estado=date("Y-m-d",$d);
	}
	 else $estado=$row_ord['estado'];
	?>
  <tr class="row" align="center" id="<?php echo $row_ord['orden_no'] ?>" onclick="mostrar('<?php echo $estado ?>', '<?php echo $row_ord['orden_no'] ?>', '<?php echo $row_ord['hacienda'] ?>')"  >
    <td ><?php echo $row_ord['orden_no'] ?></td>
    <td ><?php echo $row_ord['fecha'] ?></td>
    <?php
	$rs_ins=mysql_query("SELECT * FROM d89xz_total_medicinasins WHERE id='$row_ord[tipo_insumo]'");
	$row_ins=mysql_fetch_assoc($rs_ins);
	?>
    <td ><?php echo $row_ins['tipo_t'].' '.$row_ins['nombre'].' '.$row_ins['ancho'].' de Ancho '.$row_ins['descripcion']  ?></td>
    <td ><?php echo $row_ord['cant_telas'] ?></td>
    <td ><?php echo $row_ord['largo'] ?></td>
    <td ><?php echo $row_ord['promedio'] ?></td>
    <td ><?php echo $row_ord['t_camisas'] ?></td>
    <td ><?php echo $row_ord['user'] ?></td>
   
    <td ><?php echo $estado ?></td>
  </tr>
  <?php } ?>
  
</table>
</div>
<?php
}else{
	?>
<table width="70%" align="center">
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
	recarga_tabla()
	overlay = $('<div></div>').prependTo('body').attr('id', 'overlay');
}
function mostrar(estado, orden, filtro){
	if(estado=='Pendiente') location.href='stin_corte2.php?orden='+orden+'&filtro='+filtro
	else if(estado=='En Curso') location.href='stin_corte2.php?orden='+orden+'&filtro='+filtro
	else location.href='stin_corte7.php?orden='+orden+'&filtro='+filtro
}
function recarga_tabla(){
	var filtro=$("#filtro").val()
	$("#recarga").load("stin_corte3.php?filtro=" + encodeURIComponent(filtro)  + " #recarga ");
}
$(function() {
    $( "#dialog" ).dialog({
      autoOpen: false,
	  show: {effect: 'explode', duration: 500},
	  hide: {effect: 'explode', duration: 500},  
	  width: 400,
	  height: "auto",
	  position: [300, 200],
	  toolbar: false,  	
	     
    });
})

</script>