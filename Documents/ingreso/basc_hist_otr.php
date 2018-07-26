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

<? require_once('../Connections/conexion.php'); ?>
<?
if ($acceso !='0'){ 
//echo "hola ". $acceso;
?>
<table width="70%" align="center">
  <tr>
    <td><img src="img/Logo SAGA sin texto.png" width="886" height="248" /></td>
  </tr>
  <tr>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <th>No puede acceder A este MENU sin estar HABILITADO... Consulte al Administrador....!!!</th>
  </tr>
</table>

<? 
} else {
//echo "hola ". $acceso;
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

@$day_url=$_GET['d'];
@$month_url=$_GET['m'];
@$year_url=$_GET['y'];

@$hac_url=$_GET['h'];
@$tipo_url=$_GET['t'];

date_default_timezone_set('America/Bogota');
mysql_query("SET lc_time_names = 'es_CO'");
	//echo "hola". $_GET['id'];
 			mysql_select_db($database_conexion, $conexion);
			$query_cot1 = "SELECT * FROM nomina_valle WHERE id = '$_GET[id]'";
			$cot1 = mysql_query($query_cot1, $conexion) or die(mysql_error());
			$row_cot1 = mysql_fetch_assoc($cot1);
			$totalRows_cot1 = mysql_num_rows($cot1);	
			$rfid=$row_cot1['nombre'];
			$usuario2=$row_cot1['id'];

?>
<!doctype html>
<html>
<head>
<meta charset="UTF-8">
<title>Caja  Historial</title>
<script src="../SpryAssets/SpryMenuBar.js" type="text/javascript"></script>
<link href="../SpryAssets/SpryMenuBarHorizontal.css" rel="stylesheet" type="text/css" />  
<link href="../ingreso/css/clean.css" rel="stylesheet" type="text/css" />
<link rel="stylesheet" type="text/css" href="http://code.jquery.com/ui/1.10.3/themes/smoothness/jquery-ui.css" />
<link href="../ingreso/css/shadowbox.css" rel="stylesheet" type="text/css" />
<link href="../ingreso/css/style.css" rel="stylesheet" type="text/css" />

<script type="text/javascript" src="//ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
<script type="text/javascript" src="http://code.jquery.com/ui/1.10.3/jquery-ui.js"></script>

<style>
.res{
	color:#CCCC00;
	font-size:18px
}
#year, #month, #day{
	/*display:inline-block;*/
	float:left;
	/*width:100%;*/
}
#tipo{
	float:right;
}
</style>    
</head>

<body>
<p>
  <input type="hidden" id="tf_user" value="<? echo $usuario2 ?>">
  <input type="hidden" id="tf_user2" value="<? echo $usuario ?>">
</p>
<DIV ID="seleccion">
  
  <table width="98%"  align="center" id="table_header">
    <tr>
    <td colspan="1" align="left" >
    <img src="img/logo2.png" alt="logo" name="logo" width="200" height="70" id="logo" />
    </td>
    <td colspan="3" align="right" valign="baseline"><a href="javascript:imprSelec('seleccion')" ><img src="img/imprimir.png" alt="" width="40" height="40" 

border="0" align="right" /></a></td>
    </tr>
</table>

<table width="98%" align="center">
    <tr>
    	<td class=" cont" align="right" width="29%">Empleado:
          <?
        if ($usuario2 == 'general'){
        ?>
          <select name="sl_hac" id="sl_hac" style="width:70%">
            <option value="Todo">Todas</option>
            <?
        mysql_select_db($database_conexion, $conexion);
        $query_hac = "SELECT DISTINCT `hacienda` as hacienda , `hacienda` as hacienda1 FROM 
        `d89xz_hacienda` WHERE `delete`=0 order by hacienda";
        $hac = mysql_query($query_hac, $conexion) or die(mysql_error());
        while ($row_hac = mysql_fetch_assoc($hac)){
        ?>
            <option value="<? echo $row_hac['hacienda']?>"><? echo $row_hac['hacienda1']?></option>
            <?
        } 
        ?>
          </select>
          <? 
        }else{
        ?>
          <input type="text" readonly id="tf_hac" style="width:70%" value="<? echo $rfid ?>">
        <?
        }
        ?></td>
    <td  align="right" width="17%">Seleccione una Fecha: </td>
    	<td width="28%" align="right" class=" cont"><div id="year" align="right">
    	  <select name="sl_year" id="sl_year" onChange="load2()"  style="width:100px">
    	    <option value="">Año</option>
    	    <?
		mysql_select_db($database_conexion, $conexion);
		if ($hac_url != 'Todo'){
			if ($tipo_url != 'Todo'){
				$query_anos = "SELECT DISTINCT YEAR(fecha)
				FROM `nomina_ingreso` WHERE  `cedula`='$hac_url' ORDER BY YEAR(fecha) DESC";	
			}else{
				$query_anos = "SELECT DISTINCT YEAR(fecha)
				FROM `nomina_ingreso` WHERE `cedula`='$hac_url' ORDER BY YEAR(fecha) DESC";	
			}
		}else{
			if($tipo_url != 'Todo'){
				$query_anos = "SELECT DISTINCT YEAR(fecha)
				FROM `nomina_ingreso` ORDER BY YEAR(fecha) DESC";	
			}else{
				$query_anos = "SELECT DISTINCT YEAR(fecha)
				FROM `nomina_ingreso` 	ORDER BY YEAR(fecha) DESC";			
			}
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
    	    <select name="sl_month" id="sl_month" onChange="load3()" style="width:100px">
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
    	      <option value="<?php echo $row_mes['MONTH(fecha)']?>">
   	          <?php echo ucwords(strtolower($row_mes['MONTHNAME(fecha)']))?>
   	          </option>
    	      <?
		}
        ?>
   	        </select> 
   	      </div>   
    	  <div id="day" align="right">
    	    <select name="sl_day" id="sl_day" onChange="load4()" style="width:100px">
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
   	      </div>  	  </td>
        <td width="18%" align="right" class="cont"><input name="sl_tipo"  type="hidden" disabled id="sl_tipo" onChange="load5()" value="Todo" > 
          <?
        mysql_select_db($database_conexion, $conexion);
        if ($hac_url != 'Todo'){
			$query_anos = "SELECT *FROM `nomina_ingreso` WHERE   `cedula`='$hac_url' ";
        }else{
			$query_anos = "SELECT *FROM `nomina_ingreso` ";
        }
        $anos = mysql_query($query_anos, $conexion) or die(mysql_error());
        while($row_anos = mysql_fetch_assoc($anos)){
        ?>
          <option value="<?php echo $row_anos['concep']?>"><?php echo $row_anos['concep']?></option>
          <?
        }
        ?>
        </select></td>
    </tr>
</table>

<div id="table" >    
<table width="98%" border="1" align="center" cellspacing="0">
    <tr>
    <td colspan="11" align="center" class="tittle">
    <label style="font-size:18px">
    Reporte  de Asistencia</label> </td>
    </tr>
    <tr class="tittle" style="font-size: 13px; color: #fff;">
      <td width="71" rowspan="2" align="center" >Fecha</td>
      <td colspan="8" align="center" >HORAS</td>
      <td width="283" rowspan="2" align="center" >Comentario</td>
    </tr>
    <tr class="tittle" style="font-size: 13px; color: #fff;">
    <td width="70" align="center" >Entrada</td>
    <td width="64" align="center" >Salida</td>
    <td width="96" align="center" >Almuerzo</td>
    <td width="108" align="center" ><span style="font-size: 13px">Ordinarias</span></td>
    <td width="81" align="center" >Extras</td>
    <td width="83" align="center" > Totales</td>
    <td width="92" align="center" >Permiso</td>
    <td width="107" align="center" >Incapacidad</td>
    </tr>
	<?
    mysql_select_db($database_conexion, $conexion);
    if($year_url=='' && $month_url=='' && $day_url==''){
		$query_basc = "SELECT * FROM `nomina_ingreso` WHERE `cedula`='$hac_url' ORDER BY `fecha` DESC ";
		  
    }
	
    if($year_url!='' && $month_url=='' && $day_url==''){
        
		$query_basc = "SELECT * FROM `nomina_ingreso`  WHERE `cedula`='$hac_url' AND YEAR(fecha) ='$year_url' ORDER BY `fecha` DESC";
		
    }
	
    if($year_url!='' && $month_url!='' && $day_url==''){
        
	   $query_basc = "SELECT * FROM `nomina_ingreso`  WHERE `cedula`='$hac_url' AND YEAR(fecha) ='$year_url' AND MONTH(fecha) = '$month_url'          ORDER BY                  `fecha` DESC";
		    }
   
    if($year_url!='' && $month_url!='' && $day_url!=''){
      	$query_basc = "SELECT * FROM `nomina_ingreso`  WHERE  `cedula`='$hac_url' AND YEAR(fecha) =  '$year_url' AND MONTH(fecha) = '$month_url'         AND  DAY(fecha) = '$day_url' ORDER             BY `fecha` DESC";

    }
	
	$basc = mysql_query($query_basc, $conexion) or die(mysql_error());
   	$num = mysql_num_rows($basc);
    while($row_basc = mysql_fetch_assoc($basc)){

    ?>
    
    <!-- aca se asignan las propiedades que tendran las filas -->
    <!-- mostrar('../caja/basc_form.php?consec=')-->
    <tr align="center" style="font-size: 14px"
    id="fila_<? echo $row_basc['factura']; ?>"  class="row" 
    onMouseOver="ResaltarFila('fila_<? echo $row_basc['factura']; ?>');mano(this);"  
    onMouseOut="RestablecerFila('fila_<? echo $row_basc['factura']; ?>')">
    <td  ><? echo $row_basc['fecha']; ?></td>
    <td  ><? echo $row_basc['inicio']; ?></td>
    <td  ><? echo $row_basc['final']; ?></td>
    <td  ><? echo $row_basc['entalmuer']; ?></td>
    <td  ><? echo $row_basc['hnormales']; ?></td>
    <td  ><? echo $row_basc['hextras']; ?></td>
    <td  ><? echo $row_basc['htotales']; ?></td>
    <td  ><? echo $row_basc['permisos']; ?></td>
    <td  ><? echo $row_basc['incapacidad']; ?></td>
    <td  ><? echo $row_basc['comen']; ?></td>
    </tr>
   <?php 
    //linea para repetir el while mientras se cumpla la siguiente condicion
    }
    ?>  
    <tr class="row">
      <th align="right"  >TOTAL:
      <td align="right"  >      
      <td align="right"  >      
      <td align="right"  >      
      <td align="right"><?
	   $resultc = mysql_query("SELECT SUM(`hnormales`) as hnormales,SUM(`hextras`) as hextras,SUM(`htotales`) as htotales FROM nomina_ingreso "); 
		$rowc = mysql_fetch_array($resultc, MYSQL_ASSOC);	
		 //echo number_format($hnormales=$rowc["hnormales"]);

      ?></td>
      <td align="right" class="row" ><?
	  //echo $year_url.'-'.$month_url.'-'.$day_url.'-'.$tipo_url.'-'.$hac_url ;
	  //$juli = mysql_query("SELECT SUM(`v_tal`) as total FROM nomina_ingreso where  YEAR(fecha) = '2014' AND                 MONTH(fecha) = '01' AND concep = 'Egreso'and estado!='Cancelada' and estado!='Pendiente'",$conexion);
	  if($hac_url =='Todo'){
		  //Solo Ingresos y Egresos
		  if($year_url=='' && $month_url=='' && $day_url=='' && $tipo_url=='Todo'){
			  $juli = mysql_query("SELECT SUM(`v_tal`) as total FROM d89xz_diario where estado!='Cancelada' and              estado!='Pendiente' and estado!='Anulada'",$conexion);
		  }
		  if($year_url=='' && $month_url=='' && $day_url=='' && $tipo_url=='Ingreso'){
   			 $juli = mysql_query("SELECT SUM(`v_tal`) as total FROM d89xz_diario where estado!='Cancelada' and              estado!='Pendiente' and estado!='Anulada' AND concep = 'Ingreso' ",$conexion);
		  }
		  if($year_url=='' && $month_url=='' && $day_url=='' && $tipo_url=='Egreso'){
   			 $juli = mysql_query("SELECT SUM(`v_tal`) as total FROM d89xz_diario where estado!='Cancelada' and              estado!='Pendiente' and estado!='Anulada' AND concep = 'Egreso' ",$conexion);
		  }
		   // Ingresos , Egresos y Años///////////////////////////////////////////////////
		  if($year_url!='' && $month_url=='' && $day_url=='' && $tipo_url=='Todo'){
			  $juli = mysql_query("SELECT SUM(`v_tal`) as total FROM d89xz_diario where YEAR(fecha) = '$year_url' AND                estado!='Cancelada' and   estado!='Pendiente' and estado!='Anulada'",$conexion);
		  }
		  if($year_url!='' && $month_url=='' && $day_url=='' && $tipo_url=='Ingreso'){
   			 $juli = mysql_query("SELECT SUM(`v_tal`) as total FROM d89xz_diario where YEAR(fecha) = '$year_url' AND              estado!='Cancelada' and estado!='Pendiente' and estado!='Anulada' AND concep = 'Ingreso' ",$conexion);
		  }
		  if($year_url!='' && $month_url=='' && $day_url=='' && $tipo_url=='Egreso'){
   			 $juli = mysql_query("SELECT SUM(`v_tal`) as total FROM d89xz_diario where YEAR(fecha) = '$year_url' AND               estado!='Cancelada' and estado!='Pendiente' and estado!='Anulada' AND concep = 'Egreso' ",$conexion);
		  }
		    // Ingresos , Egresos , Años y Mes///////////////////////////////////////////////////
		  if($year_url!='' && $month_url!='' && $day_url=='' && $tipo_url=='Todo'){
			 $juli = mysql_query("SELECT SUM(`v_tal`) as total FROM d89xz_diario where YEAR(fecha) = '$year_url' AND             MONTH(fecha)='$month_url' AND estado!='Cancelada' and estado!='Pendiente' and estado!='Anulada'",             $conexion);
		  }
		  if($year_url!='' && $month_url!='' && $day_url=='' && $tipo_url=='Ingreso'){
   			 $juli = mysql_query("SELECT SUM(`v_tal`) as total FROM d89xz_diario where YEAR(fecha) = '$year_url' AND             MONTH(fecha) = '$month_url' AND estado!='Cancelada' and estado!='Pendiente' and estado!='Anulada' AND             concep = 'Ingreso' ",$conexion);
		  }
		  if($year_url!='' && $month_url!='' && $day_url=='' && $tipo_url=='Egreso'){
   			 $juli = mysql_query("SELECT SUM(`v_tal`) as total FROM d89xz_diario where YEAR(fecha) = '$year_url' AND              MONTH(fecha) = '$month_url' AND estado!='Cancelada' and estado!='Pendiente' and estado!='Anulada' AND              concep = 'Egreso' ",$conexion);
		  }
		    // Ingresos , Egresos , Años , Mes Y Dia///////////////////////////////////////////////////
		  if($year_url!='' && $month_url!='' && $day_url!='' && $tipo_url=='Todo'){
			 $juli = mysql_query("SELECT SUM(`v_tal`) as total FROM d89xz_diario where YEAR(fecha) = '$year_url' AND             MONTH(fecha)='$month_url' AND DAY(fecha) = '$day_url' AND estado!='Cancelada' and estado!='Pendiente' and             estado!='Anulada'", $conexion);
		  }
		  if($year_url!='' && $month_url!='' && $day_url!='' && $tipo_url=='Ingreso'){
   			 $juli = mysql_query("SELECT SUM(`v_tal`) as total FROM d89xz_diario where YEAR(fecha) = '$year_url' AND             MONTH(fecha) = '$month_url' AND DAY(fecha) = '$day_url' AND estado!='Cancelada' and estado!='Pendiente'               estado!='Anulada' AND concep = 'Ingreso' ",$conexion);
		  }
		  if($year_url!='' && $month_url!='' && $day_url!='' && $tipo_url=='Egreso'){
   			 $juli = mysql_query("SELECT SUM(`v_tal`) as total FROM d89xz_diario where YEAR(fecha) = '$year_url' AND              MONTH(fecha) = '$month_url' AND DAY(fecha) = '$day_url' AND estado!='Cancelada' and estado!='Pendiente'               estado!='Anulada' AND concep = 'Egreso' ",$conexion);
		  }
	  }else{
		 //Solo Ingresos y Egresos
		  if($year_url=='' && $month_url=='' && $day_url=='' && $tipo_url=='Todo'){
			  $juli = mysql_query("SELECT SUM(`v_tal`) as total FROM d89xz_diario where estado!='Cancelada' and              `hacienda`='$hac_url' AND estado!='Pendiente' and estado!='Anulada'",$conexion);
		  }
		  if($year_url=='' && $month_url=='' && $day_url=='' && $tipo_url=='Ingreso'){
   			 $juli = mysql_query("SELECT SUM(`v_tal`) as total FROM d89xz_diario where estado!='Cancelada' and              `hacienda`='$hac_url' AND estado!='Pendiente' and estado!='Anulada' AND concep = 'Ingreso' ",$conexion);
		  }
		  if($year_url=='' && $month_url=='' && $day_url=='' && $tipo_url=='Egreso'){
   			 $juli = mysql_query("SELECT SUM(`v_tal`) as total FROM d89xz_diario where estado!='Cancelada' and             `hacienda`='$hac_url' AND  estado!='Pendiente' and estado!='Anulada' AND concep = 'Egreso' ",$conexion);
		  }
		   // Ingresos , Egresos y Años///////////////////////////////////////////////////
		  if($year_url!='' && $month_url=='' && $day_url=='' && $tipo_url=='Todo'){
			  $juli = mysql_query("SELECT SUM(`v_tal`) as total FROM d89xz_diario where YEAR(fecha) = '$year_url' AND              `hacienda`='$hac_url' AND estado!='Cancelada' and estado!='Pendiente' and estado!='Anulada'",$conexion);
		  }
		  if($year_url!='' && $month_url=='' && $day_url=='' && $tipo_url=='Ingreso'){
   			 $juli = mysql_query("SELECT SUM(`v_tal`) as total FROM d89xz_diario where YEAR(fecha) = '$year_url' AND              `hacienda`='$hac_url' AND estado!='Cancelada' and estado!='Pendiente' and estado!='Anulada' AND concep =              'Ingreso' ",$conexion);
		  }
		  if($year_url!='' && $month_url=='' && $day_url=='' && $tipo_url=='Egreso'){
   			 $juli = mysql_query("SELECT SUM(`v_tal`) as total FROM d89xz_diario where YEAR(fecha) = '$year_url' AND               `hacienda`='$hac_url' AND estado!='Cancelada' and estado!='Pendiente' and estado!='Anulada' AND concep                = 'Egreso' ",$conexion);
		  }
		    // Ingresos , Egresos , Años y Mes///////////////////////////////////////////////////
		  if($year_url!='' && $month_url!='' && $day_url=='' && $tipo_url=='Todo'){
			 $juli = mysql_query("SELECT SUM(`v_tal`) as total FROM d89xz_diario where YEAR(fecha) = '$year_url' AND             MONTH(fecha)='$month_url' AND `hacienda`='$hac_url' AND estado!='Cancelada' and estado!='Pendiente' and             estado!='Anulada'", $conexion);
		  }
		  if($year_url!='' && $month_url!='' && $day_url=='' && $tipo_url=='Ingreso'){
   			 $juli = mysql_query("SELECT SUM(`v_tal`) as total FROM d89xz_diario where YEAR(fecha) = '$year_url' AND             MONTH(fecha) = '$month_url' AND `hacienda`='$hac_url' AND estado!='Cancelada' and estado!='Pendiente' and             estado!='Anulada' AND concep = 'Ingreso' ",$conexion);
		  }
		  if($year_url!='' && $month_url!='' && $day_url=='' && $tipo_url=='Egreso'){
   			 $juli = mysql_query("SELECT SUM(`v_tal`) as total FROM d89xz_diario where YEAR(fecha) = '$year_url' AND              MONTH(fecha) = '$month_url' AND estado!='Cancelada' and estado!='Pendiente' and estado!='Anulada' AND              `hacienda`='$hac_url' AND concep = 'Egreso' ",$conexion);
		  }
		    // Ingresos , Egresos , Años , Mes Y Dia///////////////////////////////////////////////////
		  if($year_url!='' && $month_url!='' && $day_url!='' && $tipo_url=='Todo'){
			 $juli = mysql_query("SELECT SUM(`v_tal`) as total FROM d89xz_diario where YEAR(fecha) = '$year_url' AND             MONTH(fecha)='$month_url' AND DAY(fecha) = '$day_url' AND estado!='Cancelada' and estado!='Pendiente' and             `hacienda`='$hac_url' AND estado!='Anulada'", $conexion);
		  }
		  if($year_url!='' && $month_url!='' && $day_url!='' && $tipo_url=='Ingreso'){
   			 $juli = mysql_query("SELECT SUM(`v_tal`) as total FROM d89xz_diario where YEAR(fecha) = '$year_url' AND             MONTH(fecha) = '$month_url' AND DAY(fecha) = '$day_url' AND estado!='Cancelada' and estado!='Pendiente'             `hacienda`='$hac_url'  and estado!='Anulada' AND concep = 'Ingreso' ",$conexion);
		  }
		  if($year_url!='' && $month_url!='' && $day_url!='' && $tipo_url=='Egreso'){
   			 $juli = mysql_query("SELECT SUM(`v_tal`) as total FROM d89xz_diario where YEAR(fecha) = '$year_url' AND              MONTH(fecha) = '$month_url' AND DAY(fecha) = '$day_url' AND estado!='Cancelada' and estado!='Pendiente'               `hacienda`='$hac_url' AND estado!='Anulada' AND concep = 'Egreso' ",$conexion);
		  }  
	  }
    @$row07 = mysql_fetch_array($juli, MYSQL_ASSOC);
    @$Total= number_format ($row07["total"]);
    //echo $Total;
	?></td>
      <td  >&nbsp;</td>
      <td  >&nbsp;</td>
      <td  >&nbsp;</td>
      <td colspan="3"  >&nbsp;</td>
    </tr>
   
</table>
</div>
</DIV>

</body>
    
<script>
$(document).ready(function() {
    $('#month').hide();
	$('#day').hide();
	
	//load2();
	
	var user = $('#tf_user').val();
	if ( user != 'general'){
		var hac = '';
		hac = $('#tf_user').val();
		load1(hac);
	}else{
		var hac = '';
		hac = $('#sl_hac').val();
		load1(hac);
	}
	 
	$('#sl_hac').bind('change', function(){
		var hac = $(this).val();
		load1(hac);	
	});
	
});

function load5(){
	var y = '';
	var m = '';
	var d = '';
	var t = $('#sl_tipo').val();
	var user = $('#tf_user').val();
	var h = '';
	if ( user == 'general'){
		h = $('#sl_hac').val();
	} else {
		h = $('#tf_user').val();	
	}
	
	$('#month').hide();
	$('#day').hide();
	
	console.log ('h:'+h+' t:'+t+' y:'+y+' m:'+m+' d:'+d);
	
	$('#year').load('basc_hist.php?h=' + h.replace(/ /g,"+") + '&y=' + y.replace(/ /g,"+") +
	'&m=' + m.replace(/ /g,"+") +'&d=' + d.replace(/ /g,"+") +'&t=' + t.replace(/ /g,"+") +' #year' );
	
	$('#month').load('basc_hist.php?h=' + h.replace(/ /g,"+") + '&y=' + y.replace(/ /g,"+") +
	'&m=' + m.replace(/ /g,"+") +'&d=' + d.replace(/ /g,"+") +'&t=' + t.replace(/ /g,"+") +' #month ' );
	
	$('#day').load('basc_hist.php?h=' + h.replace(/ /g,"+") + '&y=' + y.replace(/ /g,"+") +
	'&m=' + m.replace(/ /g,"+") +'&d=' + d.replace(/ /g,"+") +'&t=' + t.replace(/ /g,"+") +' #day' );
	
	$('#table').load('basc_hist.php?h=' + h.replace(/ /g,"+") + '&y=' + y.replace(/ /g,"+") +
	'&m=' + m.replace(/ /g,"+") +'&d=' + d.replace(/ /g,"+") +'&t=' + t.replace(/ /g,"+") +' #table ' );
	
}

function load1(hac){
	var y = '';
	var m = '';
	var d = '';
	var t = $('#sl_tipo').val();
	
	$('#month').hide();
	$('#day').hide();
	
	console.log ('h:'+hac+' t:'+t+' y:'+y+' m:'+m+' d:'+d);
	
	$('#tipo').load('basc_hist.php?h=' + hac.replace(/ /g,"+") + '&y=' + y.replace(/ /g,"+") +
	'&m=' + m.replace(/ /g,"+") +'&d=' + d.replace(/ /g,"+") +'&t=' + t.replace(/ /g,"+") +' #tipo' );
	
	$('#year').load('basc_hist.php?h=' + hac.replace(/ /g,"+") + '&y=' + y.replace(/ /g,"+") +
	'&m=' + m.replace(/ /g,"+") +'&d=' + d.replace(/ /g,"+") +'&t=' + t.replace(/ /g,"+") +' #year' );
	
	$('#month').load('basc_hist.php?h=' + hac.replace(/ /g,"+") + '&y=' + y.replace(/ /g,"+") +
	'&m=' + m.replace(/ /g,"+") +'&d=' + d.replace(/ /g,"+") +'&t=' + t.replace(/ /g,"+") +' #month ' );
	
	$('#day').load('basc_hist.php?h=' + hac.replace(/ /g,"+") + '&y=' + y.replace(/ /g,"+") +
	'&m=' + m.replace(/ /g,"+") +'&d=' + d.replace(/ /g,"+") +'&t=' + t.replace(/ /g,"+") +' #day' );
	
	$('#table').load('basc_hist.php?h=' + hac.replace(/ /g,"+") + '&y=' + y.replace(/ /g,"+") +
	'&m=' + m.replace(/ /g,"+") +'&d=' + d.replace(/ /g,"+") +'&t=' + t.replace(/ /g,"+") +' #table ' );
	
}

function load2(){
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
	
	$('#month').load('basc_hist.php?h=' + h.replace(/ /g,"+") + '&y=' + y.replace(/ /g,"+") +
	'&m=' + m.replace(/ /g,"+") +'&d=' + d.replace(/ /g,"+") +'&t=' + t.replace(/ /g,"+") +' #month ' );
	
	$('#day').load('basc_hist.php?h=' + h.replace(/ /g,"+") + '&y=' + y.replace(/ /g,"+") +
	'&m=' + m.replace(/ /g,"+") +'&d=' + d.replace(/ /g,"+") +'&t=' + t.replace(/ /g,"+") +' #day' );
	
	$('#table').load('basc_hist.php?h=' + h.replace(/ /g,"+") + '&y=' + y.replace(/ /g,"+") +
	'&m=' + m.replace(/ /g,"+") +'&d=' + d.replace(/ /g,"+") +'&t=' + t.replace(/ /g,"+") +' #table ' );
	
	if (y == ''){
		//console.log('y:'+y);
		$('#month').hide();
		$('#day').hide();
		$('#sl_month').val('');
		$('#sl_day').val('');
			
	}else{
		//console.log('y:'+y);
		$('#month').show();
		$('#day').hide();			
	}
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
	
	$('#day').load('basc_hist.php?h=' + h.replace(/ /g,"+") + '&y=' + y.replace(/ /g,"+") +
	'&m=' + m.replace(/ /g,"+") +'&d=' + d.replace(/ /g,"+") +'&t=' + t.replace(/ /g,"+") +' #day' );
	
	$('#table').load('basc_hist.php?h=' + h.replace(/ /g,"+") + '&y=' + y.replace(/ /g,"+") +
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
	
	$('#table').load('basc_hist.php?h=' + h.replace(/ /g,"+") + '&y=' + y.replace(/ /g,"+") +
	'&m=' + m.replace(/ /g,"+") +'&d=' + d.replace(/ /g,"+") +'&t=' + t.replace(/ /g,"+") +' #table ' );
	
}


//funcion para iniciar el shadowbox
Shadowbox.init({
	handleOversize: "drag",
	modal: true
});

// CONVERTIR LAS FILAS EN LINKS
function CrearEnlace(url) {

Shadowbox.open({
content: url,
player: "iframe",
options: {  modal: true	
}})
}
//funciona para cambiar el puntero del mouse por una manito
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
	Shadowbox.open({
		content: url,
		player: "iframe",
		options: {  modal: true  }
	})
}

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
		
		var url = "../bascula_normal/basc_hist.php";
		window.location.href = url;	 
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
</html>
<?php
@mysql_free_result($years_query);
@mysql_free_result($months_q);
@mysql_free_result($peso_tot_q);
}
?>
