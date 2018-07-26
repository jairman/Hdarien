<?php require_once('joom.php'); ?>
<?php require_once('../Connections/conexion.php'); ?>
<?php if ($acceso =='0'){ ?>
<!doctype html>
<html>
<head>
<meta charset="UTF-8">
<title>Subida de Inventario desde Excel</title>
<link href="../css/clean.css" rel="stylesheet" type="text/css" />
<link rel="stylesheet" type="text/css" href="http://code.jquery.com/ui/1.11.0/themes/smoothness/jquery-ui.css" />
<link href="../css/style.css" rel="stylesheet" type="text/css" />
<link href="../css/shadowbox.css" rel="stylesheet" type="text/css" />

<script src="http://code.jquery.com/jquery-2.1.1.js"></script>
<script src="http://code.jquery.com/ui/1.11.0/jquery-ui.js"></script>
<script src="../js/shadowbox.js" type="text/javascript"></script>
<script src="../js/jquery.validate.js" type="text/javascript"></script>
<style>
#pop-up {
	width:200px;
	height:150px;
}
</style>
</head>
<body>

<table width="98%" border="1" cellspacing="0" cellpadding="0" align="center">
  <tr >
    <td align="left" ><img src="../img/Logo.png" height="75" width="200" /></td>
  </tr>
  <tr>
  	<td class="tittle">Subida de Productos por Excel</td>
  </tr>
  <tr class="bold">
    <td align="left" >
    <label class="red" style="font-size:12px">Importante: Descargue el Formato Para Importar Desde Excel  <a href="formato/compras.xlsx" id="button-download" ><img src="../img/Download-Folder-icon.png" width="25" height="25" id="image"/></a></label><br>
    <label>
    1. Llene el archivo con los campos que desea utilizar y deje en blanco los que no. <br>
    2. Click en examinar(Choose File) y seleccione el formato excel tipo .xlsx con los datos guardados. <br>
    3. A continuación dar click en enviar.<br>
    4. Su tabla con los datos deberá aparecer.<br>
    5. Verifique que todos los datos han sido cargados y presione el botón enviar.<br>
    6. Espere que los datos se carguen en el formulario de compras.<br>
    Nota: <br>
    - El máximo permitido es de 300 productos.<br>
    - Habilite la edición de documentos en excel luego haga click en guardar.  <img src="../img/info.png" width="25" height="25"  alt="" id="image"/><br>
    </label>
    </td>
  </tr>
  <tr class="stittle">
    <td style="font-size:17px">
    <form action="ej.php" method="post"
    enctype="multipart/form-data">
    <label for="file">Archivo:</label>
    <input type="file" name="file" id="file"><br>
    <input type="submit" name="submit" value="Enviar">
    </form>
    </td>
  </tr>
</table>
<div id="pop-up" style="display:none">
<img src="img/excel.PNG" width="700" height="250"/>
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
    <td>No puede acceder A este MENU sin estar HABILITADO... Consulte al Administrador....!!!</td>
    </tr>
</table>
<?php
}
?>
</body>
<script>
$("#image").mouseover(function(e){
	$("#pop-up").show();
	$("#pop-up").offset({left:e.pageX+30,top:e.pageY-50});
	console.log(e.pageY)
});
$("#image").mouseout(function(){
	$("#pop-up").hide();
});
</script>
</html>