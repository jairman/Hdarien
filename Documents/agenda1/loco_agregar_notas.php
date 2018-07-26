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
/*$fe=date("Y/m/d");;

$fecha=$_GET['fecha'];*/

 $f1=$_POST['datepicker'];
 $f2=$_POST['datepicker2'];
 $fecha= date("Y-m-d");
$editFormAction = $_SERVER['PHP_SELF'];
if (isset($_SERVER['QUERY_STRING'])) {
  $editFormAction .= "?" . htmlentities($_SERVER['QUERY_STRING']);
}

if ((isset($_POST["MM_insert"])) && ($_POST["MM_insert"] == "form1")) {
  $insertSQL = sprintf("INSERT INTO d89xz_notas (tarea,hora,hac,user, fecha_ini, fecha, estado, jorn, comen) VALUES (%s, %s, %s, %s, %s, %s, %s, %s, %s)",
                       GetSQLValueString($_POST['tarea'], "text"),
					   GetSQLValueString($_POST['hora'], "text"),
					   
					   GetSQLValueString($usuario2, "text"),
					   GetSQLValueString($usuario, "text"),
					   
                       GetSQLValueString( $f1, "date"),
		
                       GetSQLValueString($f2, "date"),
                       GetSQLValueString('Pendiente', "text"),
                       GetSQLValueString($f1, "date"),
                       GetSQLValueString($_POST['comen'], "text"));

  mysql_select_db($database_conexion, $conexion);
  $Result1 = mysql_query($insertSQL, $conexion) or die(mysql_error());

 echo " <script type='text/javascript'>

  		 parent.location.reload();

			</script>";
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link href="../agenda/css/style.css" rel="stylesheet" type="text/css" />
<link href="../agenda/css/shadowbox.css" rel="stylesheet" type="text/css" />
<script src="../agenda/js/shadowbox.js" type="text/javascript"></script>
<script src="../SpryAssets/SpryMenuBar.js" type="text/javascript"></script>
<link href="../SpryAssets/SpryMenuBarHorizontal.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.3.1/jquery.min.js"></script>
<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.8.18/jquery-ui.min.js"></script>
<!--Calendario-->
<link rel="stylesheet" href="http://code.jquery.com/ui/1.10.1/themes/base/jquery-ui.css" />
<script src="http://code.jquery.com/jquery-1.9.1.js"></script>
<script src="http://code.jquery.com/ui/1.10.1/jquery-ui.js"></script>
<script src="jquery.ui.datepicker-es.js"></script>

<script>
$(function () {

$.datepicker.setDefaults($.datepicker.regional["es"]);
$("#datepicker").datepicker({ dateFormat: "yy-mm-dd",
        firstDay: 1,
        dayNamesMin: ["Do", "Lu", "Ma", "Mi", "Ju", "Vi", "Sa"],
        dayNamesShort: ["Dom", "Lun", "Mar", "Mie", "Jue", "Vie", "Sab"],
        monthNames: 
            ["Enero", "Febrero", "Marzo", "Abril", "Mayo", "Junio", "Julio",
            "Agosto", "Septiembre", "Octubre", "Noviembre", "Diciembre"],
        monthNamesShort: 
            ["Ene", "Feb", "Mar", "Abr", "May", "Jun",
            "Jul", "Ago", "Sep", "Oct", "Nov", "Dic"],
			showOn: "",
      		buttonImage: "img/calendar.gif",
     		 buttonImageOnly: true
			
			
			
			});
			
$("#datepicker2").datepicker({ dateFormat: "yy-mm-dd",
        firstDay: 1,
        dayNamesMin: ["Do", "Lu", "Ma", "Mi", "Ju", "Vi", "Sa"],
        dayNamesShort: ["Dom", "Lun", "Mar", "Mie", "Jue", "Vie", "Sab"],
        monthNames: 
            ["Enero", "Febrero", "Marzo", "Abril", "Mayo", "Junio", "Julio",
            "Agosto", "Septiembre", "Octubre", "Noviembre", "Diciembre"],
        monthNamesShort: 
            ["Ene", "Feb", "Mar", "Abr", "May", "Jun",
            "Jul", "Ago", "Sep", "Oct", "Nov", "Dic"]
			,
			showOn: "button",
      		buttonImage: "img/calendar.gif",
     		 buttonImageOnly: true
			});			
			
});


</script>
</head>

<body>
<table width="98%" align="center" id="table_header">
    <tr>
      <td colspan="1" align="left" >
      <img src="img/Logo SAGA sin texto.png" alt="logo" name="logo" width="200" height="70" id="logo" />
      </td>
      <td colspan="3" align="right" valign="baseline" >&nbsp;</td>
  </tr>
</table>
<p>&nbsp;</p>
<form action="<?php echo $editFormAction; ?>" method="post" name="form1" id="twoDates">
  <table width="530"  align="center" cellspacing="0">
    <tr >
      <th colspan="2" align="center"  class="tittle">Asignación De Notas</th>
    </tr>
    <tr >
      <th width="188" align="left"  class="bold">Nota</th>
      <td width="302" class="cont"><input type="text" name="tarea" value="" size="50" /></td>
    </tr>
    <tr >
      <th align="left" class="bold">Fecha Inicio</th>
      <td class="cont"><input  name="datepicker" type="text" id="datepicker" style="width:94%"  value="<?php echo date('Y-m-d') ?>" size="50" readonly="readonly" /></td>
    </tr>
    <tr >
      <th align="left" class="bold">Fecha Final</th>
      <td class="cont"><input  name="datepicker2" type="text" id="datepicker2" style="width:94%" required="required" pattern="" oninvalid="setCustomValidity('Esta fecha debe ser MAYOR  a la Inicial')" onchange="setCustomValidity('')"/></td>
    </tr>
    <tr >
      <td colspan="2" align="center"><input type="submit" name="button" id="button" value="Registrar"  class="ext"  onclick="return validate_twoDates(); return false"/></td>
    </tr>
  </table>
  <input type="hidden" name="MM_insert" value="form1" />
</form>
<p>&nbsp;</p>
<script type="text/javascript">
     <!-- Validar fechas de formulario-->
function validate_twoDates() {
  var $dateStart = $("form#twoDates input[name=datepicker]").val();
  var $dateEnd = $("form#twoDates input[name=datepicker2]").val();
  if($dateEnd < $dateStart){ 
  	$('#datepicker2').attr('pattern','[xxx]');
	
	$('#twoDates')[0].find(':submit').click();
  }else{ $('#datepicker2').removeAttr('pattern');  }
  return($dateEnd >= $dateStart);
}
</script>
</body>
</html>