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

 $fecha=$_GET['fecha'];
$colname_pen = "-1";
if (isset($_GET['fecha'])) {
  $colname_pen = $_GET['fecha'];
}
mysql_select_db($database_conexion, $conexion);
$query_pen = sprintf("SELECT * FROM d89xz_tareas WHERE estado ='Pendiente' and fecha = %s and medicamentos ='0'  and hac='$usuario2'", GetSQLValueString($colname_pen, "date"));
$pen = mysql_query($query_pen, $conexion) or die(mysql_error());
$row_pen = mysql_fetch_assoc($pen);
$totalRows_pen = mysql_num_rows($pen);
///////////////////////////////////////////////////////////////////////////////////////////////////////////////////
mysql_select_db($database_conexion, $conexion);
$query_pen1 = sprintf("SELECT * FROM d89xz_tareas WHERE estado ='Pendiente' and fecha = %s and medicamentos !='0'  and hac='$usuario2'", GetSQLValueString($colname_pen, "date"));
$pen1 = mysql_query($query_pen1, $conexion) or die(mysql_error());
$row_pen1 = mysql_fetch_assoc($pen1);
$totalRows_pen1 = mysql_num_rows($pen1);
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Agenda</title>
<link href="../agenda/css/clean.css" rel="stylesheet" type="text/css" />
<link href="../agenda/css/style.css" rel="stylesheet" type="text/css" />
<link href="../agenda/css/shadowbox.css" rel="stylesheet" type="text/css" />
<script src="../agenda/js/shadowbox.js" type="text/javascript"></script>
<script src="../SpryAssets/SpryMenuBar.js" type="text/javascript"></script>
<script src="../SpryAssets/SpryValidationTextField.js" type="text/javascript"></script>
<link href="../SpryAssets/SpryMenuBarHorizontal.css" rel="stylesheet" type="text/css" />
<link href="../SpryAssets/SpryValidationTextField.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.3.1/jquery.min.js"></script>
<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.8.18/jquery-ui.min.js"></script>
<script type="text/javascript"><!--
Shadowbox.init({
handleOversize: "drag",
modal: true,
	onClose: function(){ $('#seleccion').load('loco.php'  + ' #seleccion ' );  
	}
});
// </script>
<script langiage="javascript" type="text/javascript">


function mano(a) { 
    if (navigator.appName=="Netscape") { 
        a.style.cursor='pointer'; 
    } else { 
        a.style.cursor='hand'; 
    } 
}

// RESALTAR LAS FILAS AL PASAR EL MOUSE
function ResaltarFila(id_fila) {
    document.getElementById(id_fila).style.backgroundColor = '#C0C0C0';
}
 
// RESTABLECER EL FONDO DE LAS FILAS AL QUITAR EL FOCO
function RestablecerFila(id_fila) {
    document.getElementById(id_fila).style.backgroundColor = '#FFFFFF';
}
 
// CONVERTIR LAS FILAS EN LINKS
function CrearEnlace(url) {
    location.href=url;
}
</script>
</head>

<body>
<DIV ID="seleccion">
  <table width="98%"  align="center" >
  <tr >
    <td >&nbsp;</td>
    <td >&nbsp;</td>
    <td >&nbsp;</td>
    <td align="right" ><a rel="shadowbox[ejemplos];options={continuous:true,modal: true}" href="loco_agregar.php?fecha=<?php echo $fecha; ?>"><img src="img/add.png" alt="" width="40" height="40" title="Agregar Tarea" /></a></td>
    <td ><a href="javascript:imprSelec('seleccion')" ><img src="img/imprimir.png" alt="" width="40" height="40" border="0" align="right" /></a></td>
  </tr>
  <tr >
    <td colspan="5" align="center"  class="tittle">Actividades Pendientes :<?php echo $_GET['fecha']?></td>
  </tr>
  <tr class="bold">
    <th width="19%" class="row">Fecha De Ingreso</th>
    <th width="5%" class="row">Hora</th>
    <th width="38%" class="row">Tipo </th>
    <th width="30%" class="row">Comentario</th>
    <th width="8%" class="row">Modificar</th>
  </tr>
  <?php do { ?>
   <tr class="row" align="center" id="fila_<?php echo $row_pen['id']; ?>" onMouseOver="ResaltarFila('fila_<?php echo $row_pen['id']; ?>');mano(this);"  onMouseOut="RestablecerFila('fila_<?php echo $row_pen['id']; ?>')" >
    
    
    
      <td class="row" onClick="CrearEnlace('loco_detalle.php?jorn=<?php echo $row_pen['fecha']; ?>&amp;id=<?php echo $row_pen['id']; ?>&amp;tarea=<?php echo $row_pen['tarea']; ?>');"><?php echo $row_pen['jorn']; ?></td>
      <td class="row" onClick="CrearEnlace('loco_detalle.php?jorn=<?php echo $row_pen['fecha']; ?>&amp;id=<?php echo $row_pen['id']; ?>&amp;tarea=<?php echo $row_pen['tarea']; ?>');"><?php echo $row_pen['hora']; ?></td>
      <td class="row" onClick="CrearEnlace('loco_detalle.php?jorn=<?php echo $row_pen['fecha']; ?>&amp;id=<?php echo $row_pen['id']; ?>&amp;tarea=<?php echo $row_pen['tarea']; ?>');"><?php echo $row_pen['comen']; ?></td>
      <td class="row" onClick="CrearEnlace('loco_detalle.php?jorn=<?php echo $row_pen['fecha']; ?>&amp;id=<?php echo $row_pen['id']; ?>&amp;tarea=<?php echo $row_pen['tarea']; ?>');"><?php echo $row_pen['tarea']; ?></td>
      <td class="row"><a  href="actua_estado_tareas.php?id=<?php echo $row_pen['id']; ?>&amp;fecha=<?php echo $fecha; ?>"><img src="img/edit.png" width="20" height="20" title="Dar por Cumplida"  onclick="return confirm('Desea dar por cumplida…?');" /></a></td>
    </tr>
 <?php } while ($row_pen = mysql_fetch_assoc($pen)); ?>
 
 <?php do { ?>
   
    <?php } while ($row_pen1 = mysql_fetch_assoc($pen1)); ?>
</table>
<!-- /////////////////////////////////////////--></DIV>
</body>
</html>
<?php
mysql_free_result($pen);
?>
<script language="Javascript">
function imprSelec(nombre)

  {

  var ficha = document.getElementById(nombre);

  var ventimp = window.open(' ', 'popimpr');

  ventimp.document.write( ficha.innerHTML );

  ventimp.document.close();

  ventimp.print( );

  ventimp.close();

  }
</script>