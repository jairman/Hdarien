<?php require_once('joom.php'); ?>
<?php require_once('../Connections/conexion.php'); ?>
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

mysql_select_db($database_conexion, $conexion);
$query_corr = "SELECT * FROM nomina_ingreso where final='00:00:00'";
$corr = mysql_query($query_corr, $conexion) or die(mysql_error());
$row_corr = mysql_fetch_assoc($corr);
$totalRows_corr = mysql_num_rows($corr);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Asistencia</title>
<link rel="stylesheet" type="text/css" href="http://code.jquery.com/ui/1.10.3/themes/smoothness/jquery-ui.css" />
<link href="css/clean.css" rel="stylesheet" type="text/css" />
<link href="css/shadowbox.css" rel="stylesheet" type="text/css" />
<link href="css/style.css" rel="stylesheet" type="text/css" />
<script src="js/shadowbox.js" type="text/javascript"></script>
<script src="js/jquery.validate.js" type="text/javascript"></script>

<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.3.1/jquery.min.js"></script>
<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.8.18/jquery-ui.min.js"></script>
<script type="text/javascript" src="//ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
<script type="text/javascript" src="http://code.jquery.com/ui/1.10.3/jquery-ui.js"></script>


<script type="text/javascript"><!--
Shadowbox.init({
handleOversize: "drag",
modal: true,


onOpen: function() {
		$('#sb-info').after($('#sb-wrapper-inner'));
		$('#sb-wrapper-inner').after($('#sb-title'));
	},



onClose: function(){
		$('#seleccion1').load('dia_dia.php' + ' #seleccion1 ' );
				  }

});
// </script>
</head>

<body>
<table width="98%" border="0" align="center" cellspacing="0">
  <tr bgcolor="#f0f0f0">
    <td width="858" align="left" bgcolor="#FFFFFF"><div id="menu">
      <ul >
        <ul>
          <li> <a href="basc_hist2.php" >Historial Colectivo</a></li>
          <li> <a  href="agenda2.php"  >Historial Individual</a></li>
          <?php  if($auto==1) { ?>
          <li> <a  href="correo_notifi_menu.php" class='active' >Empleados Sin Registro De Salida</a></li>
          <?php }  ?>
        </ul>
      </ul>
    </div></td>
    <td width="94" align="center" bgcolor="#FFFFFF">&nbsp;</td>
    <td width="58" align="left" bgcolor="#FFFFFF">&nbsp;</td>
  </tr>
</table>
<div id="main">
<table width="98%">
  <tr>
    <td><img src="img/Logo SAGA sin texto.png" alt="" width="200" height="90" /></td>
  </tr>
</table>

<table width="98%" border="1" align="center" cellspacing="0">
  <tr>
    <td colspan="7" align="center" bgcolor="#fb7c1f" style="color: #FFF" class="tittle"><strong style="font-size: 16px">Listado de empleados Sin Registro De Salida</strong></td>
  </tr>
  <tr align="center" bgcolor="#6b6b6b" class="tittle">
    <td width="11%" style="color: #FFF">Fecha</td>
    <td width="14%" style="color: #FFF">Cédula</td>
    <td width="26%" style="color: #FFF"><strong>Nombre</strong></td>
    <td width="13%" style="color: #FFF"><strong>Hora inicio</strong></td>
    <td width="11%" style="color: #FFF"><strong>Hora Final</strong></td>
    <td width="20%" style="color: #FFF"><strong>Sucursal</strong></td>
    <td width="5%" style="color: #FFF">&nbsp;</td>
  </tr>
  <?php do { ?>
    <tr class="row">
      <td align="center" class="row"><?php echo $row_corr['fecha']; ?></td>
      <td align="center" class="row"><?php echo $row_corr['cedulaorg']; ?></td>
      <td align="center"><?php
	  
	  		mysql_select_db($database_conexion, $conexion);
			$query_corr1 = "SELECT * FROM nomina_valle WHERE id='$row_corr[cedula]'";
			$corr1 = mysql_query($query_corr1, $conexion) or die(mysql_error());
			$row_corr1 = mysql_fetch_assoc($corr1);
			$totalRows_corr1 = mysql_num_rows($corr1);
	  		echo $row_corr1['nombre']
	  
      
      ?></td>
      <td align="center"><?php echo $row_corr['inicio']; ?></td>
      <td align="center"><?php echo $row_corr['final']; ?></td>
      <td align="center"><?php echo $row_corr['hacienda']; ?></td>
      <td align="center"><a rel="shadowbox[ejemplos];options={continuous:true,modal: true}" href="correo_notifi_horas.php?id=<?php echo $row_corr['id']; ?>&amp;nombre=<?php echo $row_corr1['nombre']; ?>"><img src="img/edit.png" width="20" height="20" title="Ingresar Horas" /></a></td>
    </tr>
    <?php } while ($row_corr = mysql_fetch_assoc($corr)); ?>
</table>
</div>
</body>
</html>
<?php
mysql_free_result($corr);
?>
