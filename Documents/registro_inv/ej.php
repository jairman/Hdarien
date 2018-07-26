<?php require_once('joom.php'); ?>
<?php require_once('../Connections/conexion.php'); ?>
<?php
if ($_FILES["file"]["error"] > 0)
  {
  echo "Error: " . $_FILES["file"]["error"] . "<br>";
  }
else
  {
   $nombre=$_FILES["file"]["name"]. "<br>" ;  
  $filePath = realpath($_FILES["file"]["tmp_name"]);
  $ext = explode('.',$_FILES['file']['name']);
	$extension = $ext[1];	
	$newname = $ext[0].'_'.time();
	$full_local_path = 'subidos/'.$newname.'.'.$extension ;
	move_uploaded_file($_FILES['file']['tmp_name'], $full_local_path);
  
  }
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<script src="http://code.jquery.com/jquery-1.9.1.js"></script>
<script src="http://code.jquery.com/ui/1.10.1/jquery-ui.js"></script>
<link rel="stylesheet" href="http://code.jquery.com/ui/1.10.1/themes/base/jquery-ui.css" />
<link rel="stylesheet" type="text/css" href="css/estilo_prog.css" >
<script type="text/javascript" src="js/format_table.js"></script>
<link href="css/format_table.css" rel="stylesheet" type="text/css" />
<link href="../css/style.css" rel="stylesheet" type="text/css" />
<link href="../css/clean.css" rel="stylesheet" type="text/css" />
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




<?php
    require('php-excel-reader/excel_reader2.php');
    require('SpreadsheetReader.php');
    $Reader = new SpreadsheetReader($full_local_path);
	$i=0;
	$arreglo=array();
    foreach ($Reader as $Row )
    {
		array_push($arreglo, $Row);
		if($i>0) {
			if($Row[0]=="") break;
		} 
		$i++;
    }
	?>
    <input type="hidden" id="tama" value="<?php echo $i-1;  ?>" />
    <p/>

<table width="98%" style="color:#000" align="center" border="1" cellspacing="0" cellpadding="0">
<tr class="tittle"><td colspan="20"><span style="float:left; margin-left:20px; font-size:18px;"><?php echo ($i-1).' Registros'  ?></span><input type="button" name="button" id="button" value="Enviar" onclick="envia(1)" style="float:right; margin-right:20px" class="ext" /></td></tr>
</table>    
    
<table width="98%"  align="center" border="1" cellspacing="0" cellpadding="0" id="tabla">
<thead>
  <tr class="tittle">
  <?php for($k=0;$k<13;$k++){ ?>
  <th align="center"><?php echo $arreglo[0][$k] ?> </th>
  <?php } ?> 
  </tr>  
  </thead>
  <tbody>
	<?php
	for($j=1;$j<$i;$j++){
		?>
  <tr id="<?php echo $j;  ?>"  class="row"  align="center"><?php for($k=0;$k<13;$k++){ 
		?>
		<td><?php echo $arreglo[$j][$k] ?> </td>
        <?php
		}
		?>  </tr>
        <?php
		
	}
?>
</tbody>
</table>
<div id="dialog">
<div class="demo-wrapper html5-progress-bar">
		<div class="progress-bar-wrapper">
			<progress id="progressbar" value="0" max="100"></progress>
			<span class="progress-value" id="progreso">0%</span>

		</div>
	</div>
<input type="button" id="aceptar" style="width:150px; display:none" value="Aceptar" class="ext" />
</div>
<div id="dialog2">
<span id="mini" style="float:left; margin-left:15px"></span>
<table id="reporte" width="98%" style="font-size:10px; display:none" align="center" border="1" cellspacing="0" cellpadding="0">
</table>

<br />
<br />
<table align="center"><tr><td>
<input type="button" id="mostrar_rep"  value="Mostrar Detalle de Datos no Subidos" class="ext" />
<input type="button" id="ocultar_rep" style="width:150px; display:none" value="Ocultar Detalle" class="ext" />
<input type="hidden" id="total_ing" />
</td></tr></table>
</div>
<div id="dialog3"></div>
</body>
<script>
$(window).load(function() {
  overlay = $('<div></div>').prependTo('body').attr('id', 'overlay');
  formato('tabla');
  if($("#tama").val()>1500){
	  $("#button").hide();
	  maximo_regs();
  }
});
$("#mostrar_rep").click(function(){
	$("#dialog2").dialog({width:$(window).width()*0.95});
	$("#reporte").show('slow');
	$("#mostrar_rep").hide()
	$("#ocultar_rep").show("slow");	
})
$("#ocultar_rep").click(function(){
	$("#dialog2").dialog({width:400});
	$("#reporte").hide();
	$("#mostrar_rep").show('slow')
	$("#ocultar_rep").hide();	
})
window.maximo=0;
window.ceds=[];
function envia(){	
	var obj=[];
	var tama=$("#tama").val()
	$("#tabla tbody tr").each(function(index, element) {
		obj[index]=[];
        $(this).find("td").each(function() {
            obj[index].push($(this).html())
        });
    });
	parent.arreglo(obj, tama)
}

function maximo_regs(){
	overlay.show();
	$("#dialog3").html('El Máximo Permitido es de 1500 Registros').css('text-align','center');
	$("#dialog3").prepend('<img id="theImg2" src="img/warning.PNG" width="43" height="31"/>');
	$("span.ui-dialog-title").text('Información Importante').css("text-align", "center"); 
	$("#dialog3").dialog("open");
	$("#dialog3").append('<br />')
	$("#dialog3").append("<br>");	
	$("#dialog3").append('<input type="button" id="cerrar_dial" style="width:150px" value="Aceptar" class="ext" onclick="cerrar_dialogo3()" />');
}
function cerrar_dialogo3(){
	$("#dialog3").dialog("close");
}

$(function() {
	var dialogwidth=400;
	var dialogwidth2=400;
    $( "#dialog" ).dialog({
	  open: function() { $(".ui-dialog-titlebar-close").hide() },
      autoOpen: false,
	  width: dialogwidth,
	  height: 'auto',
	  show: {effect: 'explode'},
	  hide: {effect: 'explode'},	  
	  position: [($(window).width() / 2) - (dialogwidth / 2), 10],
	  toolbar: false, 	     
    });
	$( "#dialog2" ).dialog({
      autoOpen: false,
	   open: function() { $(".ui-dialog-titlebar-close").show() },
	  width: dialogwidth2,
	  height: 'auto',
	  show: {effect: 'explode'},
	  hide: {effect: 'explode'},	  
	  position: [($(window).width() / 2) - (dialogwidth2 / 2), 10],
	  toolbar: false, 
	  close: function() { window.close() }, 	     
    });
	$( "#dialog3" ).dialog({
      autoOpen: false,
	  width: dialogwidth2,
	  height: 'auto',
	  show: {effect: 'explode'},
	  hide: {effect: 'explode'},	  
	  position: [($(window).width() / 2) - (dialogwidth2 / 2), 10],
	  toolbar: false, 
	  close: function() { overlay.hide(); location.href='excel.php' }, 	     
    });
})
function cerrar_dialogo(){
	$("#dialog").dialog("close");
}
</script>
</html>
