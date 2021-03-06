<?php require_once('../controllers/joom.php'); ?>
<?php require_once('../../Connections/conexion.php');
  
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
<!--------------------------------Nesesario-------------->



<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Kardex Clientes</title>
<link href="../../css/clean.css" rel="stylesheet" type="text/css" />
<link href="../../css/estilo.css" rel="stylesheet" type="text/css" />
<link rel="stylesheet" type="text/css" href="http://code.jquery.com/ui/1.10.3/themes/smoothness/jquery-ui.css" />
<link href="../../css/style.css" rel="stylesheet" type="text/css" />
<link href="../../css/shadowbox.css" rel="stylesheet" type="text/css" />

<link rel="stylesheet" href="../css/bootstrap.css">
<link rel="stylesheet" href="../css/bootstrap-theme.css">


<script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.2.25/angular.min.js"></script>
<script src="../js/app.js"></script>
<!--<script data-require="ng-table@*" data-semver="0.3.0" src="http://bazalt-cms.com/assets/ng-table/0.3.0/ng-table.js"></script>
--><script src="http://code.jquery.com/jquery-1.9.1.js"></script>
<script src="http://code.jquery.com/ui/1.10.1/jquery-ui.js"></script>
<script src="../../js/shadowbox.js" type="text/javascript"></script>
<script src="../../js/jquery.validate.js" type="text/javascript"></script>
<script src="../../js/printThis.js" type="text/javascript"></script>
<script src="../js/kardex.js" type="text/javascript"></script>
 

</head>

<body>
<div id="tabla">

<table width="98%" align="center">
  <tr>
    <td align="right"><p class="s"> 
             <input name="search" id="search" type="search"  autocomplete="off" >
     </p></td>
<td width="6%" align="center"><img src="../../img/addpersonas.png" width="48" height="48" title="Agregar Nuevo" style="cursor:pointer"  onclick="agregar()"  /></td>
<td width="4%" align="center"><img src="../../img/Excell_Up.png" alt="" width="40" height="40" style="cursor:pointer" title="Agregar Excel"  onclick="agregar_excel()"  /></td>
    <td width="6%" align="center"><img  title="Imprimir" src="../../img/imprimir.png" alt="" 
    width="40" height="40" border="0"  style="cursor:pointer" onclick="imprimir_esto('registros')"/></td>
  </tr>
</table>
<?php
	/*mysql_select_db($database_conexion, $conexion);
	$query_kar = "SELECT * FROM d89xz_clientes where  `delete` !='1'  order by  nombre  ";
	$kar = mysql_query($query_kar, $conexion) or die(mysql_error());
	$row_kar = mysql_fetch_assoc($kar);
	$totalRows_kar = mysql_num_rows($kar);*/
?>
<div id='registros' >
<table width="98%" border="1" align="center">
<tr>
<td align="center" class="tittle">Listado de Clientes</td>
</tr>
</table>
<div ng-controller="DemoCtrl">
<table width="98%" border="1" align="center" cellspacing="0" ng-table="tableParams">
 
  <tr align="center" class="tittle"  >
    <td width="10%" onClick="orden_bus('cedula')" style="cursor:pointer" title="Ordenar por NIT">NIT</td>
    <td width="24%" onClick="orden_bus('nombre')" style="cursor:pointer" title="Ordenar por Nombre">Nombre</td>
    <td width="8%" onClick="orden_bus('telefono')" style="cursor:pointer" title="Ordenar por Teléfono">Teléfono</td>
    <td width="10%" onClick="orden_bus('cel')" style="cursor:pointer" title="Ordenar por Celularl">Celular</td>
    <td width="9%" onClick="orden_bus('categoria')" style="cursor:pointer" title="Ordenar por Categoría
    ">Cumpleaños</td>
<td width="10%" onClick="orden_bus('ciudad')" style="cursor:pointer" title="Ordenar por Ciudad">Ciudad</td>
    <td width="25%" onClick="orden_bus('ciudad')" style="cursor:pointer" title="Ordenar por Ciudad">Email</td>
    <td colspan="3" >&nbsp;</td>
  </tr>
  <?php //do { ?>
    <tr class="row" title="Ver Detalle" ng-repeat="dato in $data">
      <td align="right" >{{dato.cedula}}</td>
      <td align="right" >{{dato.nombre}}</td>
      <td align="right" >{{dato.telefono}}</td>
      <td align="right" >{{dato.cel}}</td>
      <td align="right" >{{dato.cumple}}</td>
      <td align="right" >{{dato.ciudad}}</td>
      <td align="right" >{{dato.mail}}</td>
   </table>
       
</div>
</div>
</div>
</body>
<div id="dialog2">
</div>


</html>
<?php
//mysql_free_result($kar);
?>
<?php }else{ ?>


<table width="70%" border="0" align="center">
  <tr>
    <td><img src="../../img/Logo SAGA sin texto.png" width="886" height="248" /></td>
  </tr>
  <tr>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <th>No puede acceder A este MENU sin estar HABILITADO... Consulte al Administrador....!!!</th>
  </tr>
</table>

<?php } ?>