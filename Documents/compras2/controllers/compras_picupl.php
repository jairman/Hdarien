<?php require_once('../controllers/joom.php'); ?>
<?php require_once('../../Connections/conexion.php'); ?>

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

date_default_timezone_set('America/Bogota');
$c_date = date('Y-m-d');

?>
<!doctype html>
<html>
<head>
<meta charset="UTF-8">
<title>Registrar Productos</title>
<link href="../../css/clean.css" rel="stylesheet" type="text/css" />
<link rel="stylesheet" type="text/css" href="http://code.jquery.com/ui/1.11.0/themes/smoothness/jquery-ui.css" />
<link href="../../css/style.css" rel="stylesheet" type="text/css" />
<link href="../../css/shadowbox.css" rel="stylesheet" type="text/css" />

<script src="http://code.jquery.com/jquery-2.1.1.js"></script>
<script src="http://code.jquery.com/ui/1.11.0/jquery-ui.js"></script>
<script src="../../js/shadowbox.js" type="text/javascript"></script>
<script src="../../js/jquery.validate.js" type="text/javascript"></script>

<style>
.picture{
	width:100px;
	height:100px;
}
</style>
</head>

<body>
<div id="dialog"></div>
<?php
//echo ini_get('max_file_uploads');
//error_reporting(E_ERROR | E_PARSE);	
if(isset($_POST['upload'])){		   
	for($i=0;$i<count($_FILES['userfile']['size']);$i++){
		$fileName = $_FILES['userfile']['name'][$i];
		$tmpName  = $_FILES['userfile']['tmp_name'][$i];
		$fileSize = $_FILES['userfile']['size'][$i];
		$fileType = $_FILES['userfile']['type'][$i];
		@$fp = fopen($tmpName, 'r');
		@$content = fread($fp, $fileSize);
		$content = addslashes($content);
		@fclose($fp);
		if(!get_magic_quotes_gpc()) 
			$fileName = addslashes($fileName);		
		if(substr($fileType,0,5)=='image'){
			$rs_buscar=mysql_query("SELECT name FROM `h01sg_temp_img` WHERE `name`='$fileName'",$conexion);
			$rs_buscar_num_rows=mysql_num_rows($rs_buscar);
			if($rs_buscar_num_rows>0){
				mysql_query("UPDATE `h01sg_temp_img` SET `delete`=0 WHERE `name`='$fileName'",$conexion);
			}else{
				mysql_select_db($database_conexion, $conexion);
				$query = "INSERT INTO `h01sg_temp_img` (name, size, content, `type`, `delete` ) VALUES ('$fileName', '$fileSize', '$content', '$fileType', '0')";
				mysql_query($query, $conexion) or die(mysql_error());    
			}			
		}		
	}
}      
?>
<table width="98%" border="1" cellspacing="0" cellpadding="0" align="center">
    
    <form id="form"  method="post" enctype="multipart/form-data" name="uploadform">
    <tr>
    <td colspan="2" class="bold">
    Instrucciones:<br>
    1. De click en la barra para que abra la ventana de subida de archivos<br>
    2. Seleccione las imagenes que desea subir<br>
    3. de click en aceptar para que abra el formulario de registro<br>
    </td>
    </tr>
    <tr>
    <td colspan="2" id="abrir" style="cursor:pointer" class="tittle">Haga click aqui para subir las imágenes!
    <input name="userfile[]"
    type="file"  id="userfile"  multiple="multiple" style="display:none" >
    <input name="upload" type="submit" class="box" id="upload" value="Cargar" style="display:none"></td>
    </tr>
    <tr>
    <td colspan="2" ><?php
    $rs = mysql_query("SELECT  * FROM `h01sg_temp_img` WHERE `delete`=0");
    while ($row = mysql_fetch_assoc($rs)) {
		$nombre=$row['name'];
		$id=$row['id'];
    ?>
    
    <div align="center" id="<?php echo $id ?>" style="width:120px; height:120px; float:left;" name=divs>
        <div>
        <img src="compras_agregarimg.php?idnum=<?php echo $id ?>" alt="Img" id="art<?php echo $id ?>" name="imgs" class="picture" />
        </div>
        <div style="width:100px; height:20px">
        <table width="100" border="0">
            <tr>
            <td align="center"><img src="../../img/erase.png" width="20" height="20" style="cursor:pointer;" title="Eliminar" onClick="quitar(<?php echo $id ?>)"></td>
            </tr>
        </table>
        </div>
    </div>
    
    <?php
    }
    ?>
    </td>
    </tr>
    <tr>
    <td colspan="2">&nbsp;</td>
    </tr>
    <tr align="center">
    <td colspan="2" >
    <input type="submit" name="subir" id="subir" value="Aceptar " 
    class="ext" style="width:20%" onClick="guardar(); return false">
    &nbsp;
    <input name="bt_close" type="button" class="ext" id="bt_close"
    style="width:20%" value="Cancelar" onclick="window.parent.Shadowbox.close()">
    </td>
    </tr>
    </form>
</table>
    
</body>
<script>

$(document).ready(function() {
	//se crea la variable con el estilo css overlay
	overlay = $('<div></div>').prependTo('body').attr('id', 'overlay');
	
    var tam = $("[name=divs]").length;
	if(tam>0){
		$("#bt_close").show('slow')
		$("#subir").show('slow')
	}else{
		$("#bt_close").hide()
		$("#subir").hide()
	}
	
	//alert($('#ses').val())
});

function quitar(id){
	overlay.show()
	$("#dialog").html('Desea eliminar el artículo?').css('text-align','center');
	$("#dialog").prepend('<img id="theImg2" src="../img/warning.png" width="50" height="50"/>');
	$("span.ui-dialog-title").text('Información Importante').css("text-align", "center"); 
	$("#dialog").dialog("open");
	$("#dialog").append('&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<img id="theImg2" src="../img/good.png" width="50" height="50" style="cursor:pointer" onclick="eliminar('+id+');cerrar_dialogo();"/>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<img id="theImg2" src="../img/erase.png" width="50" height="50" style="cursor:pointer" onclick="cerrar_dialogo()"/>');	
}

function cerrar_dialogo(){
	overlay.hide()
	$("#dialog").dialog("close");
}

function eliminar(id){
	//console.log("id="+id+"&action=del_pict")
	$.ajax({
        type: "POST",
        url: "../inventario/invent_connect.php",
        data: "id="+id+"&action=del_pict",
        success: function(datos){			
			//console.log(datos);
			$("#"+id ).remove();
        }
	})	
}

function guardar(){	
	//var url = '../inventario/invent_regmulti2.php';
	//mostrar(url)
	parent.addrows();
	window.parent.Shadowbox.close();
}

$('#abrir').click(function(){		
	var hg = document.getElementById('userfile').click()		
});

$('#userfile').change(function(){
	overlay.show();
	var hg = document.getElementById('upload').click()		
});

//funcion para inicializar el cuadro de dialogo
var dialogwidth=400
$(function() {
    $( "#dialog" ).dialog({
      autoOpen: false,
	  width: dialogwidth,
	  height: 'auto',
	  show: {effect: 'explode'},
	  hide: {effect: 'explode'},	  
	  //position: [($(window).width() / 2) - (dialogwidth / 2), 150],
	  toolbar: false, 
	  close: function() { overlay.hide() }, 	     
    });
})

//se crea la variable con el estilo css overlay
overlay = $('<div></div>').prependTo('body').attr('id', 'overlay');

function checkChildWindow(win, onclose) {
    var w = win;
    var cb = onclose;
    var t = setTimeout(function() { checkChildWindow(w, cb); }, 500);
    var closing = false;
    try {
        if (win.closed || win.top == null) //happens when window is closed in FF/Chrome/Safari
        closing = true;        
    } catch (e) { //happens when window is closed in IE        
        closing = true;
    }
    if (closing) {
		
		window.parent.Shadowbox.close()
       	
		clearTimeout(t);
		overlay.hide();
    }
}

function mostrar(url){
	//console.log(url);
	var w = window.open(url,'','width=1200,height=600')
	window.win=w;
	overlay.show();
	checkChildWindow(w, function() {  } );
	w.moveTo(0,0);
    w.resizeTo(screen.width,screen.height);		 
}
overlay.click(function(){
	window.win.focus()
});


document.onkeydown = function(event) {
	//console.log(window.event.keyCode)
  if(window.event.keyCode==116||window.event.keyCode==8){
        event.preventDefault();
  }
}
</script>
</html>
<?php
}
?>