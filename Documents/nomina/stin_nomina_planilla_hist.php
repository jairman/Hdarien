<?php require_once('joom.php'); ?>
<?php require_once('../Connections/conexion.php'); ?>
<?php
if($acceso==0){
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
$filtro=$_GET['filtro'];
mysql_select_db($database_conexion, $conexion);
$query_hist = "SELECT DISTINCT fecha FROM nomina_liquidar WHERE hacienda='$filtro' and `delete`=0 and estado='planilla'";
$hist = mysql_query($query_hist, $conexion) or die(mysql_error());



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
     $('#sb-body').prepend($('#sb-info'))},	 
    handleOversize: "drag",
    modal: true
});
</script>

</head>

<body>
<p><span class="current" style="color: #FFF"><img src="../img/Logo.png" width="200" height="90" /></span></p>
<table width="50%" border="1" cellspacing="0" cellpadding="0" align="center">
  <tr class="tittle">
    <th align="center" style="color: #FFF; font-size:16px">Fecha
      <input type="hidden" name="filtro" id="filtro" value="<?php echo $filtro ?>" /></th>
    <th align="center" style="color: #FFF; font-size:16px">No. de Liquidaciones</th>
    <th align="center" style="color: #FFF; font-size:16px">Total</th>
  </tr>
  <?php
  while($row_hist = mysql_fetch_assoc($hist)){
	  $fecha=$row_hist['fecha'];
	  mysql_select_db($database_conexion, $conexion);
	  $rs_num=mysql_query("SELECT id_nomina FROM nomina_liquidar WHERE fecha='$fecha'");
	  $num=mysql_num_rows($rs_num);	  
	  $query_dib = "SELECT id, SUM(total4) as total4 FROM nomina_liquidar WHERE fecha='$fecha'";
	  $dib = mysql_query($query_dib, $conexion) or die(mysql_error());
	  $row_dib = mysql_fetch_assoc($dib);
	 
  ?>
  <tr class="row" id="<?php echo $row_dib['id'] ?>" onclick="mostrar('<?php echo $row_hist['fecha']?>')">
    <td align="center"><?php echo $row_hist['fecha'] ?></td>
    <td align="center"><?php echo $num ?></td>
    <td align="center"><?php echo number_format($row_dib['total4']) ?></td>
  </tr>
  <?php
  }
  ?>
</table>
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
overlay = $('<div></div>').prependTo('body').attr('id', 'overlay');
overlay.click(function(){
	window.win.focus()
});
function mostrar(fecha){
	var filtro=$('#filtro').val()
	var url = 'stin_nomina_planilla_hist2.php?fecha=' + fecha+'&filtro='+filtro;
	var w = window.open(url,'','width=1280,height=640,dependent=yes')
	window.win=w;
	overlay.show();
	checkChildWindow(w, function() {  } );
	w.moveTo(0,0);
    	w.resizeTo(screen.width,screen.height);
}
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
        clearTimeout(t);
		var ano= $('#ano').val();
		$('#tabla').load('kardex.php?ano=' + ano + ' #tabla ' );
		overlay.hide();
    }
}	 


</script>
</html>
<?php
mysql_free_result($hist);
?>
