<?php require_once('joom.php'); ?>
<?php require_once('../Connections/conexion.php'); ?>
<?php if ($acceso =='0'){ ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<script src="http://code.jquery.com/jquery-1.9.1.js"></script>
<script src="http://code.jquery.com/ui/1.10.1/jquery-ui.js"></script>
<link href="../css/style.css" rel="stylesheet" type="text/css" />
<link href="../css/clean.css" rel="stylesheet" type="text/css" />
<style>
#pop-up {
	width:200px;
	height:150px;
}
</style>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Documento sin título</title>
<html>
<body>
<p>&nbsp;</p>
<p>&nbsp;</p>
<p>&nbsp;</p>
<table width="98%" border="1" cellspacing="0" cellpadding="0" align="center">
  <tr >
    <td align="left" ><p><img src="../img/Logo.png" height="75" width="200" /></p>
    <p>&nbsp;</p>
    <p>&nbsp;</p></td>
  </tr>
  <tr class="row">
    <td align="left" ><strong>1. </strong>Click en Examinar(Choose File) y Seleccione el Formato Excel Tipo .xlsx Con los Datos Guardados </td>
  </tr>
  <tr class="row">
    <td align="left" ><strong>2. </strong>A Continuación Dar Click En Submit</td>
  </tr>
  <tr class="row">
    <td align="left" ><strong>3. </strong>Su Tabla Con los Datos Deberá Aparecer</td>
  </tr>
  <tr class="row">
    <td align="left" ><strong>4. </strong>Verifique Que Todos los Datos Han Sido Cargados y Presione el Botón Enviar</td>
  </tr>
  <tr class="row">
    <td align="left" ><strong>5. </strong>Espere que los Datos se Suban al Servidor</td>
  </tr>
  <tr class="row">
    <td align="left" ><strong>Nota:</strong> El Máximo Permitido es de 1500 Registros</td>
  </tr>
  <tr class="row">
    <td align="left" ><strong>Nota:</strong> Habilite la Edición de Documentos en Excel Luego Haga Click en Guardar<img src="img/022.png" width="20" height="20"  alt="" id="image"/></td>
  </tr>
  <tr class="row">
    <td align="left" ><strong>Nota:</strong> Descargue el Formato Para Importar Desde Excel<a href="formato/proveedores_excel.xlsx" id="button-download" ><img src="../img/Download-Folder-icon.png" width="20" height="20" id="image"/></a></td>
  </tr>
  <tr class="tittle">
    <th  style="font-size:17px"><form action="ej.php" method="post"
enctype="multipart/form-data">
<label for="file">Filename:</label>
<input type="file" name="file" id="file"><br>
<input type="submit" name="submit" value="Submit">
</form></th>
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
    <th>No puede acceder A este MENU sin estar HABILITADO... Consulte al Administrador....!!!</th>
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