<?php
$ruta_a_joomla = "/../../../carnesdana/";
define( '_JEXEC', 1 );
define( 'JPATH_BASE', realpath(dirname(__FILE__).$ruta_a_joomla ));
define( 'DS', DIRECTORY_SEPARATOR );

require_once ( JPATH_BASE .DS.'includes'.DS.'defines.php' );
require_once ( JPATH_BASE .DS.'includes'.DS.'framework.php' );
require_once ( JPATH_BASE .DS.'configuration.php' );
$mainframe =& JFactory::getApplication('site');
$mainframe->initialise();
$userx = &JFactory::getUser();
 $usuario= $userx->username;
  $usuario2= $userx->usertype2;
	$acceso= $userx->agenda;
if (JFactory::getUser()->usertype == NULL)
    JError::raiseError(1,"No puede acceder A esta Aplicación sin estar logueado... Consulte al Administrador....!!!");
$userx = JFactory::getUser();

?>
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
$hoy=date('Y-m-d');

$colname_asis = "-1";
if (isset($hoy)) {
  $colname_asis = $hoy;
}





echo $day_url=$_GET['d'];
echo $month_url=$_GET['m'];
echo $year_url=$_GET['y'];

echo $hac_url=$_GET['h'];
echo $tipo_url=$_GET['t'];

date_default_timezone_set('America/Bogota');
mysql_query("SET lc_time_names = 'es_CO'");

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Control Ingreso</title>
<script src="../SpryAssets/SpryMenuBar.js" type="text/javascript"></script>
<link href="../SpryAssets/SpryMenuBarHorizontal.css" rel="stylesheet" type="text/css" />  
<link href="../ingreso/css/clean.css" rel="stylesheet" type="text/css" />
<link rel="stylesheet" type="text/css" href="http://code.jquery.com/ui/1.10.3/themes/smoothness/jquery-ui.css" />
<link href="../ingreso/css/shadowbox.css" rel="stylesheet" type="text/css" />
<link href="../ingreso/css/style.css" rel="stylesheet" type="text/css" />

<script type="text/javascript" src="//ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>

<script type="text/javascript" src="http://code.jquery.com/ui/1.10.3/jquery-ui.js"></script>
<script src="../ingreso/js/shadowbox.js" type="text/javascript"></script>
<script src="../ingreso/js/jquery.validate.js" type="text/javascript"></script>

<script type="text/javascript"><!--
Shadowbox.init({
handleOversize: "drag",
modal: true,


});
// </script>
<style type="text/css">
#day {	/*display:inline-block;*/
	float:left;
}
#month {	/*display:inline-block;*/
	float:left;
}
#year {	/*display:inline-block;*/
	float:left;
}
</style>
</head>
<body>
<table width="98%" border="0" align="center" cellspacing="0" id="table_header">
  <tr bgcolor="#f0f0f0">
    <td width="858" align="left" bgcolor="#FFFFFF"><div id="menu">
      <ul >
        <ul>
          <li> <a href="loco.php" class='active'>Historial Colectivo</a> </li>
           <li> <a  href="agenda2.php" >Historial Individual</a></li>
        
          </ul>
        </ul>
    </div>      <div id="apDiv2"></div></td>
    <td width="94" align="center" bgcolor="#FFFFFF">&nbsp;</td>
    <td width="58" align="left" bgcolor="#FFFFFF"><a href="javascript:imprSelec('seleccion')" ><img src="img/imprimir.png" alt="" width="40" height="40" border="0" align="right" /></a></td>
  </tr>
</table>




<DIV ID="seleccion">
<div id="main">
				

<table width="98%" border="0" align="center">
          <tr>
            <td width="50%" rowspan="2"><img src="img/Logo SAGA sin texto.png" alt="logo" name="logo" width="200" height="90" id="logo" /></td>
            <td width="50%" class="tittle" >Registro Diario</td>
          </tr>
          <tr>
            <td  >&nbsp;</td>
          </tr>
          <tr>
            <td class="bold">Dirección</td>
            <td class="bold">Medellín  Antioquia </td>
          </tr>
          <tr>
            <td class="bold">(034) 354 05 26 </td>
            <td class="bold">Fecha: <?php echo $hoy ?></td>
          </tr>
</table>

<table width="98%" align="center">
  <tr>
    <td width="15%" align="left" class=" cont">Seleccione una Fecha: </td>
    <td width="65%" align="right" class=" cont"><div id="year" align="right">
      <select name="sl_year" id="sl_year" onchange="load2()"  style="width:100px">
        <option value="">Año</option>
        <?
		mysql_select_db($database_conexion, $conexion);
		if ($hac_url != 'Todo'){
			
				$query_anos = "SELECT DISTINCT YEAR(fecha) FROM `nomina_ingreso` 	ORDER BY YEAR(fecha) DESC";			
			
		}
		$anos = mysql_query($query_anos, $conexion) or die(mysql_error());
		while($row_anos = mysql_fetch_assoc($anos)){
		?>
        <option value="<?php echo $row_anos['YEAR(fecha)']?>"><?php echo $row_anos['YEAR(fecha)']?></option>
        <?
		}
		?>
        </select>
      </div>
      <div id="month" align="right">
        <select name="sl_month" id="sl_month" onchange="load3()" style="width:100px">
          <option value="">Mes</option>
          <?
		echo $year_url;
		mysql_select_db($database_conexion, $conexion);
		if ($hac_url != 'Todo'){
			if($tipo_url != 'Todo'){
				$query_mes = "SELECT DISTINCT MONTH(fecha), MONTHNAME(fecha) FROM `nomina_ingreso` WHERE `cedula`='$hac_url' 
				ORDER BY MONTH(fecha) DESC";	
			}else{
				$query_mes = "SELECT DISTINCT MONTH(fecha), MONTHNAME(fecha) FROM `nomina_ingreso` WHERE 
				 `cedula`='$hac_url' ORDER BY MONTH(fecha) DESC";			
			}
		}else{
			if($tipo_url != 'Todo'){
				$query_mes = "SELECT DISTINCT MONTH(fecha), MONTHNAME(fecha) FROM `nomina_ingreso` WHERE 
				 YEAR(fecha)='$year_url' ORDER BY MONTH(fecha) DESC";	
			}else{
				$query_mes = "SELECT DISTINCT MONTH(fecha), MONTHNAME(fecha) FROM `nomina_ingreso` WHERE 
				 YEAR(fecha)='$year_url' ORDER BY MONTH(fecha) DESC";	
			}
			
		}
		$mes = mysql_query($query_mes, $conexion) or die(mysql_error());
		while($row_mes = mysql_fetch_assoc($mes)){
        ?>
          <option value="<?php echo $row_mes['MONTH(fecha)']?>"> <?php echo ucwords(strtolower($row_mes['MONTHNAME(fecha)']))?> </option>
          <?
		}
        ?>
          </select>
        </div>
      <div id="day" align="right">
        <select name="sl_day" id="sl_day" onchange="load4()" style="width:100px">
          <option value="">Día</option>
          <?
		mysql_select_db($database_conexion, $conexion);
		if ($hac_url != 'Todo'){
			if($tipo_url != 'Todo'){
				$query_dia = "SELECT DISTINCT DAY(fecha) FROM `nomina_ingreso` WHERE 
				 YEAR(fecha)='$year_url' AND MONTH(fecha)='$month_url' 
				AND `cedula`='$hac_url'  ORDER BY DAY(fecha) ASC";	
			}else{
				$query_dia = "SELECT DISTINCT DAY(fecha) FROM `nomina_ingreso` WHERE 
				 YEAR(fecha)='$year_url' AND MONTH(fecha)='$month_url' 
				AND `cedula`='$hac_url' ORDER BY DAY(fecha) ASC";	
			}
		}else{
			if($tipo_url != 'Todo'){
				$query_dia = "SELECT DISTINCT DAY(fecha) FROM `nomina_ingreso` WHERE 
				 YEAR(fecha)='$year_url' AND MONTH(fecha)='$month_url' 
				 ORDER BY DAY(fecha) ASC";	
			}else{
				$query_dia = "SELECT DISTINCT DAY(fecha) FROM `nomina_ingreso` WHERE 
				 YEAR(fecha)='$year_url' AND MONTH(fecha)='$month_url' 
				ORDER BY DAY(fecha) ASC";	
			}
		}
		$dia = mysql_query($query_dia, $conexion) or die(mysql_error());
		while($row_dia = mysql_fetch_assoc($dia)){
        ?>
          <option value="<?php echo $row_dia['DAY(fecha)']?>"><?php echo $row_dia['DAY(fecha)']?></option>
          <?
        } 
        ?>
          </select>
      </div></td>
    <td width="20%" align="right" class="cont">&nbsp;</td>
  </tr>
</table>
<input name="sl_tipo"  type="hidden" disabled id="sl_tipo"  value="Todo" >
<input name="sl_hac"  type="hidden" disabled id="sl_hac"  value="Todo" >

<?php
	mysql_select_db($database_conexion, $conexion);
		$query_haci = "SELECT * FROM d89xz_hacienda where `delete` ='0'";
		$haci = mysql_query($query_haci, $conexion) or die(mysql_error());
		$row_haci = mysql_fetch_assoc($haci);
		$totalRows_haci = mysql_num_rows($haci);


////////////////////////////////////////////////////////////

do { ?>
     
     
      <?php 
	  
	   $row_haci['hacienda']; ?>
     
<div id="table"> 

           <table width="98%" border="0" align="center">
            
            <?php
			
			$hoy=date('Y-m-d');
            mysql_select_db($database_conexion, $conexion);
           // $query_asis = sprintf("SELECT * FROM nomina_ingreso WHERE fecha = %s  and hacienda ='$row_haci[hacienda]' ORDER BY inicio ASC",            GetSQLValueString($colname_asis, "date"));
	echo "Año". $year_url;
	echo "<br>";
    if($year_url=='' && $month_url=='' && $day_url==''){
		echo "hola 1";
		$query_asis  = "SELECT * FROM `nomina_ingreso` WHERE hacienda ='$row_haci[hacienda]' and fecha='$hoy' ORDER BY `fecha` DESC ";
		  
    }
	
    if($year_url!='' && $month_url=='' && $day_url==''){
        echo "hola 2";
		$query_asis  = "SELECT * FROM `nomina_ingreso`  WHERE hacienda ='$row_haci[hacienda]' AND YEAR(fecha) ='$year_url' ORDER BY `fecha` DESC";
		
    }
	
    if($year_url!='' && $month_url!='' && $day_url==''){
        
	  $query_asis  = "SELECT * FROM `nomina_ingreso`  WHERE `cedula`='$hac_url' AND YEAR(fecha) ='$year_url' AND MONTH(fecha) = '$month_url'          ORDER BY                  `fecha` DESC";
		    }
   
    if($year_url!='' && $month_url!='' && $day_url!=''){
      	$query_asis  = "SELECT * FROM `nomina_ingreso`  WHERE  `cedula`='$hac_url' AND YEAR(fecha) =  '$year_url' AND MONTH(fecha) = '$month_url'         AND  DAY(fecha) = '$day_url' ORDER             BY `fecha` DESC";

    }
	
	 $asis = mysql_query($query_asis, $conexion) or die(mysql_error());
            $row_asis = mysql_fetch_assoc($asis);
           $totalRows_asis = mysql_num_rows($asis);
			
			
		
            ?>
            
            
              <tr align="center" bgcolor="#fb7c1f">
                <td colspan="11" align="left" bgcolor="#fb7c1f"  style="font-size: 13px"><?php echo $row_haci['hacienda']; ?></td>
              </tr>
              <tr align="center" class="tittle row">
                <td width="5%" rowspan="2"  style="font-size: 13px">Cedula</td>
                <td width="22%" rowspan="2"  style="font-size: 13px">Nombre</td>
                <td colspan="8"  style="font-size: 13px" class="row">HORAS</td>
                <td width="16%" rowspan="2"  style="font-size: 13px"><p>Comentario</p></td>
              </tr>
              <tr align="center" class="tittle ">
                <td width="7%"  style="font-size: 13px">Entrada</td>
                <td width="5%"  style="font-size: 13px">Salida</td>
                <td width="7%"  style="font-size: 13px">Almuerzo</td>
                <td width="8%"  style="font-size: 13px">Ordinarias</td>
                <td width="6%"  style="font-size: 13px"> Extras</td>
                <td width="7%"  style="font-size: 13px">Totales</td>
                <td width="7%"  style="font-size: 13px">Permiso </td>
                <td width="10%"  style="font-size: 13px"> Incapacidad</td>
              </tr>
              <?php do { ?>
                <tr class="row">
                  <td align="right"  style="font-size: 11px"><?php echo $row_asis['cedulaorg']; ?></td>
                  <td align="center"  style="font-size: 11px"> &nbsp; <?
                         mysql_select_db($database_conexion, $conexion);
                        $query_cot1 = "SELECT * FROM nomina_valle WHERE id = '$row_asis[cedula]'";
                        $cot1 = mysql_query($query_cot1, $conexion) or die(mysql_error());
                        $row_cot1 = mysql_fetch_assoc($cot1);
                        $totalRows_cot1 = mysql_num_rows($cot1);	
                         $rfid=$row_cot1['nombre'];
                          
                  ?></td>
                  <td align="center"  style="font-size: 11px"><?php echo $row_asis['inicio']; ?></td>
                  <td align="center"  style="font-size: 11px"><?php echo $row_asis['final']; ?></td>
                  <td align="center"  style="font-size: 11px"><?php echo $row_asis['entalmuer']?></td>
                  <td align="center"  style="font-size: 11px"><?php echo $row_asis['hnormales']; ?></td>
                  <td align="center"  style="font-size: 11px"><?php echo $row_asis['hextras']; ?></td>
                  <td align="center"  style="font-size: 11px"><?php echo $row_asis['htotales']; ?></td>
                  <td align="center"  style="font-size: 11px"><?php echo $row_asis['permisos']; ?></td>
                  <td align="center"  style="font-size: 11px"><?php echo $row_asis['incapacidad']; ?></td>
                  <td align="center"  style="font-size: 11px"><?php echo $row_asis['comen']; ?></td>
                </tr>
                <?php } while ($row_asis = mysql_fetch_assoc($asis)); ?>
                <tr class="row">
                  <td colspan="4" align="right" >TOTALES  DIARIAS:</td>
                  <td align="right" >&nbsp;</td>
                  <td align="center" >
                    <?
                   $resultc = mysql_query("SELECT SUM(`hnormales`) as hnormales,SUM(`hextras`) as hextras,SUM(`htotales`) as htotales FROM                     nomina_ingreso WHERE fecha ='$hoy' and hacienda ='$row_haci[hacienda]' "); 
                    $rowc = mysql_fetch_array($resultc, MYSQL_ASSOC);	
                     echo number_format($hnormales=$rowc["hnormales"]);
            
                  ?>
                  </td>
                  <td align="center" ><? // echo number_format($hnormales=$rowc["hextras"]); ?></td>
                  <td align="center" ><? //echo number_format($hnormales=$rowc["htotales"]); ?></td>
                  <td align="right" >&nbsp;</td>
                  <td align="right" >&nbsp;</td>
                  <td align="right" >&nbsp;</td>
                </tr>
                
            </table>
     </div>
   
      <?php } while ($row_haci = mysql_fetch_assoc($haci)); ?>
   
</div>
</DIV>
</body>
<?php
mysql_free_result($asis);

mysql_free_result($haci);
?>

<script language="Javascript">
$(document).ready(function() {
    $('#month').hide();
	$('#day').hide();
	
});


function load2(){
	var y = $('#sl_year').val();
	var m = $('#sl_month').val();
	var d = $('#sl_day').val();
	var t = $('#sl_tipo').val();
	
	var user = $('#tf_user').val();
	var h = $('#sl_hac').val();
	
	
	
	
	$('#month').load('loco_prueba.php?h=' + h.replace(/ /g,"+") + '&y=' + y.replace(/ /g,"+") +
	'&m=' + m.replace(/ /g,"+") +'&d=' + d.replace(/ /g,"+") +'&t=' + t.replace(/ /g,"+") +' #month ' );
	
	$('#day').load('loco_prueba.php?h=' + h.replace(/ /g,"+") + '&y=' + y.replace(/ /g,"+") +
	'&m=' + m.replace(/ /g,"+") +'&d=' + d.replace(/ /g,"+") +'&t=' + t.replace(/ /g,"+") +' #day' );
	
	$('#table').load('loco_prueba.php?h=' + h.replace(/ /g,"+") + '&y=' + y.replace(/ /g,"+") +
	'&m=' + m.replace(/ /g,"+") +'&d=' + d.replace(/ /g,"+") +'&t=' + t.replace(/ /g,"+") +' #table ', 
	function(response, status, xhr){
		//console.log('r:'+response+' s:'+status+' x: '+xhr);
		//console.log(status);	
		if (status == 'success'){
			if (y == ''){
		console.log('y igual:'+y);
		$('#month').hide();
		$('#day').hide();
		$('#sl_month').val('');
		$('#sl_day').val('');
			
	}else{
		console.log('y diferente:'+y);
		$('#month').show();
		$('#day').hide();			
	}	
		}
	});
	
	
	
	
	
}

function load3(){
	var y = $('#sl_year').val();
	var m = $('#sl_month').val();
	var d = $('#sl_day').val();
	var t = $('#sl_tipo').val();
	
	var user = $('#tf_user').val();
	var h = '';
	if ( user == 'general'){
		h = $('#sl_hac').val();
	} else {
		h = $('#tf_user').val();	
	}
	
	console.log ('h:'+h+' t:'+t+' y:'+y+' m:'+m+' d:'+d);
	
	$('#day').load('loco_prueba.php?h=' + h.replace(/ /g,"+") + '&y=' + y.replace(/ /g,"+") +
	'&m=' + m.replace(/ /g,"+") +'&d=' + d.replace(/ /g,"+") +'&t=' + t.replace(/ /g,"+") +' #day' );
	
	$('#table').load('loco_prueba.php?h=' + h.replace(/ /g,"+") + '&y=' + y.replace(/ /g,"+") +
	'&m=' + m.replace(/ /g,"+") +'&d=' + d.replace(/ /g,"+") +'&t=' + t.replace(/ /g,"+") +' #table ' );
	if (m == ''){
		//console.log('m:'+m);
		$('#day').hide();
		$('#sl_day').val('');
	}else{
		//console.log('m:'+m);
		$('#day').show();
	}	
}

function load4(){
	var y = $('#sl_year').val();
	var m = $('#sl_month').val();
	var d = $('#sl_day').val();
	var t = $('#sl_tipo').val();
	
	var user = $('#tf_user').val();
	var h = '';
	if ( user == 'general'){
		h = $('#sl_hac').val();
	} else {
		h = $('#tf_user').val();	
	}
	console.log ('h:'+h+' t:'+t+' y:'+y+' m:'+m+' d:'+d);
	
	$('#table').load('loco_prueba.php?h=' + h.replace(/ /g,"+") + '&y=' + y.replace(/ /g,"+") +
	'&m=' + m.replace(/ /g,"+") +'&d=' + d.replace(/ /g,"+") +'&t=' + t.replace(/ /g,"+") +' #table ' );
	
}




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