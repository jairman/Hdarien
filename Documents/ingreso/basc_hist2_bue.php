<?php require_once('joom.php'); ?>
<?php require_once('../Connections/conexion.php'); ?>
<?php
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

<?php
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
			@$query_cot1 = "SELECT * FROM nomina_valle WHERE id = '$_GET[id]'";
			$cot1 = mysql_query($query_cot1, $conexion) or die(mysql_error());
			$row_cot1 = mysql_fetch_assoc($cot1);
			$totalRows_cot1 = mysql_num_rows($cot1);	
			$rfid=$row_cot1['nombre'];
			//$usuario2=$row_cot1['id'];

?>
<!doctype html>
<html>
<head>
<meta charset="UTF-8">
<title>Asistencia</title>
<script src="../SpryAssets/SpryMenuBar.js" type="text/javascript"></script>
<link href="../SpryAssets/SpryMenuBarHorizontal.css" rel="stylesheet" type="text/css" />  
<link href="../css/clean.css" rel="stylesheet" type="text/css" />
<link rel="stylesheet" type="text/css" href="http://code.jquery.com/ui/1.10.3/themes/smoothness/jquery-ui.css" />
<link href="../css/shadowbox.css" rel="stylesheet" type="text/css" />
<link href="../css/style.css" rel="stylesheet" type="text/css" />
<script src="../js/jquery.validate.js" type="text/javascript"></script>
<script src="../js/printThis.js" type="text/javascript"></script>

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
  <input type="hidden" id="tf_user" value="<?php echo $usuario2 ?>">
  <input type="hidden" id="tf_user2" value="<?php echo $usuario ?>">
</p>
<table width="98%" border="0" align="center" cellspacing="0" id="table_header2">
  <tr >
    <td width="858" align="left" ><div id="menu">
      <ul >
        <ul>
          <li> <a href="basc_hist2.php" class='active' >Historial Colectivo</a></li>
          <li> <a  href="agenda2.php"  >Historial Individual</a></li>
        
        </ul>
      </ul>
    </div></td>
    <td width="94" align="center" >&nbsp;</td>
    <td width="58" align="left" ><img  title="Imprimir" src="../img/imprimir.png" alt="" 
    width="48" height="48" border="0" align="right" style="cursor:pointer" onclick="imprimir_esto('main')"/></td>
  </tr>
</table>
<DIV ID="seleccion">
<div id="main">
  
  <table width="98%"  align="center" id="table_header">
    <tr>
    <td width="1%" colspan="1" rowspan="3" align="left" >&nbsp;</td>
    <td width="99%" colspan="3" align="right" valign="baseline">&nbsp;</td>
    </tr>
    <tr>
      <td colspan="3" align="center" valign="baseline" class="bold" style="font-size: 18px;">Registro Asistencia</td>
    </tr>
    <tr>
      <td colspan="3" align="right" valign="baseline">&nbsp;</td>
    </tr>
  </table>

<table width="98%" align="center">
    <tr>
    	<td class=" cont" align="right" width="23%">
          <?php
		  
        if ($usuario2 == 'general'){
        ?>
        <input name="sl_hac"  type="hidden" disabled id="sl_hac"  value="Todo" >
       
       
        <?php 
        }else{
        ?>
          <input type="hidden"  disabled id="tf_hac" style="width:70%" value="<?php echo $rfid ?>"  >
        <?php
        }
        ?></td>
    <td  align="right" width="19%">Seleccione una Fecha: </td>
    	<td width="38%" align="right" class=" cont"><div id="year" align="right">
    	  <select name="sl_year" id="sl_year" onChange="load2()"  style="width:100px">
    	    <option value="">Año</option>
    	    <?php
		mysql_select_db($database_conexion, $conexion);
		if ($hac_url != 'Todo'){
			if ($tipo_url != 'Todo'){
				$query_anos = "SELECT DISTINCT YEAR(fecha)
				FROM `nomina_ingreso` WHERE  `hacienda`='$hac_url' ORDER BY YEAR(fecha) DESC";	
			}else{
				$query_anos = "SELECT DISTINCT YEAR(fecha)
				FROM `nomina_ingreso` WHERE `hacienda`='$hac_url' ORDER BY YEAR(fecha) DESC";	
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
    	    <?php 
		}
		?>
    	    
   	      </select>
    	  </div>
    	  <div id="month" align="right">
    	    <select name="sl_month" id="sl_month" onChange="load3()" style="width:100px">
    	      <option value="">Mes</option>
    	      <?php 
		echo $year_url;
		mysql_select_db($database_conexion, $conexion);
		if ($hac_url != 'Todo'){
			if($tipo_url != 'Todo'){
				$query_mes = "SELECT DISTINCT MONTH(fecha), MONTHNAME(fecha) FROM `nomina_ingreso` WHERE `hacienda`='$hac_url' 
				ORDER BY MONTH(fecha) DESC";	
			}else{
				$query_mes = "SELECT DISTINCT MONTH(fecha), MONTHNAME(fecha) FROM `nomina_ingreso` WHERE 
				 `hacienda`='$hac_url' ORDER BY MONTH(fecha) DESC";			
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
    	      <?php 
		}
        ?>
   	        </select> 
   	      </div>   
    	  <div id="day" align="right">
    	    <select name="sl_day" id="sl_day" onChange="load4()" style="width:100px">
    	      <option value="">Día</option>
    	      <?php 
		mysql_select_db($database_conexion, $conexion);
		if ($hac_url != 'Todo'){
			if($tipo_url != 'Todo'){
				$query_dia = "SELECT DISTINCT DAY(fecha) FROM `nomina_ingreso` WHERE 
				 YEAR(fecha)='$year_url' AND MONTH(fecha)='$month_url' 
				AND `hacienda`='$hac_url'  ORDER BY DAY(fecha) ASC";	
			}else{
				$query_dia = "SELECT DISTINCT DAY(fecha) FROM `nomina_ingreso` WHERE 
				 YEAR(fecha)='$year_url' AND MONTH(fecha)='$month_url' 
				AND `hacienda`='$hac_url' ORDER BY DAY(fecha) ASC";	
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
    	      <?php 
        } 
        ?>
   	        </select>
   	      </div>  	  </td>
        <td width="20%" align="right" class="cont"><input name="sl_tipo"  type="hidden" disabled id="sl_tipo" onChange="load5()" value="Todo" > 
          <?php 
        mysql_select_db($database_conexion, $conexion);
        if ($hac_url != 'Todo'){
			$query_anos = "SELECT *FROM `nomina_ingreso` WHERE   `hacienda`='$hac_url' ";
        }else{
			$query_anos = "SELECT *FROM `nomina_ingreso` ";
        }
        $anos = mysql_query($query_anos, $conexion) or die(mysql_error());
        while($row_anos = mysql_fetch_assoc($anos)){
        ?>
          <option value="<?php echo $row_anos['concep']?>"><?php echo $row_anos['concep']?></option>
          <?php 
        }
        ?>
        </select></td>
    </tr>
</table>

<div id="table" >  

<?php
		$hoy=date('Y-m-d');
		mysql_select_db($database_conexion, $conexion);
		
		
		 if ($usuario2 == 'general'){
					 $query_haci = "SELECT * FROM d89xz_hacienda where `delete` ='0'";
        
        		}else{
					$query_haci = "SELECT * FROM d89xz_hacienda where hacienda='$usuario2' and `delete` ='0'";
       
       		 }		
		
		$haci = mysql_query($query_haci, $conexion) or die(mysql_error());
		$row_haci = mysql_fetch_assoc($haci);
		$totalRows_haci = mysql_num_rows($haci);
		
		do {
?>






  
<table width="98%" border="1" align="center" cellspacing="0">
    <tr>
    <td colspan="12" align="left" bgcolor="#fb7c1f" >
    <label style="font-size:16px"><?php echo $row_haci['hacienda']; ?></label> </td>
    </tr>
    <tr class="tittle" style="font-size: 13px; color: #fff;">
      <td width="236" colspan="2" rowspan="2" align="center" >Nombre</td>
      <td colspan="8" align="center" >HORAS</td>
      <td width="194" rowspan="2" align="center" >Comentario</td>
    </tr>
    <tr class="tittle" style="font-size: 13px; color: #fff;">
    <td width="78" align="center" >Entrada</td>
    <td width="81" align="center" >Salida</td>
    <td width="80" align="center" >Almuerzo</td>
    <td width="82" align="center" ><span style="font-size: 13px">Ordinarias</span></td>
    <td width="67" align="center" >Extras</td>
    <td width="71" align="center" > Totales</td>
    <td width="77" align="center" >Permiso</td>
    <td width="89" align="center" >Incapacidad</td>
    </tr>
	<?php 
    mysql_select_db($database_conexion, $conexion);
    if($year_url=='' && $month_url=='' && $day_url==''){
		//echo 1;
		$query_basc = "SELECT * FROM `nomina_ingreso` WHERE hacienda ='$row_haci[hacienda]' and fecha='$hoy' ORDER BY `fecha` DESC ";
		  
    }
	
    if($year_url!='' && $month_url=='' && $day_url==''){
        
		$query_basc = "SELECT * FROM `nomina_ingreso`  WHERE hacienda ='$row_haci[hacienda]'  AND YEAR(fecha) ='$year_url' ORDER BY `fecha` DESC";
		
    }
	
    if($year_url!='' && $month_url!='' && $day_url==''){
        
	   $query_basc = "SELECT * FROM `nomina_ingreso`  WHERE hacienda ='$row_haci[hacienda]'  AND YEAR(fecha) ='$year_url' AND MONTH(fecha) = '$month_url'          ORDER BY                  `fecha` DESC";
		    }
   
    if($year_url!='' && $month_url!='' && $day_url!=''){
      	$query_basc = "SELECT * FROM `nomina_ingreso`  WHERE  hacienda ='$row_haci[hacienda]'  AND YEAR(fecha) =  '$year_url' AND MONTH(fecha) = '$month_url'         AND  DAY(fecha) = '$day_url' ORDER             BY `fecha` DESC";

    }
	
	$basc = mysql_query($query_basc, $conexion) or die(mysql_error());
   	$num = mysql_num_rows($basc);
    while($row_basc = mysql_fetch_assoc($basc)){

    ?>
    
    <!-- aca se asignan las propiedades que tendran las filas -->
    <!-- mostrar('../caja/basc_form.php?consec=')-->
    <tr align="center" style="font-size: 12px"
    id="fila_<?php echo $row_basc['factura']; ?>"  class="row" 
    onMouseOver="ResaltarFila('fila_<?php echo $row_basc['factura']; ?>');mano(this);"  
    onMouseOut="RestablecerFila('fila_<?php echo $row_basc['factura']; ?>')">
    
    <td colspan="2"  ><?php  
						mysql_select_db($database_conexion, $conexion);
                        $query_cot1 = "SELECT * FROM nomina_valle WHERE id = '$row_basc[cedula]'";
                        $cot1 = mysql_query($query_cot1, $conexion) or die(mysql_error());
                        $row_cot1 = mysql_fetch_assoc($cot1);
                        $totalRows_cot1 = mysql_num_rows($cot1);	
                        echo  $rfid=$row_cot1['nombre'];
	
	?></td>
    <td  ><?php echo $row_basc['inicio']; ?></td>
    <td  ><?php echo $row_basc['final']; ?></td>
    <td  ><?php echo $row_basc['entalmuer']; ?></td>
    <td  ><?php echo $row_basc['hnormales']; ?></td>
    <td  ><?php echo $row_basc['hextras']; ?></td>
    <td  ><?php echo $row_basc['htotales']; ?></td>
    <td  ><?php echo $row_basc['permisos']; ?></td>
    <td  ><?php echo $row_basc['incapacidad']; ?></td>
    <td  ><?php echo $row_basc['comen']; ?></td>
    </tr>
   <?php 
    //linea para repetir el while mientras se cumpla la siguiente condicion
    }
    ?>  
    <tr class="row">
      <th colspan="2" align="right"  >TOTAL HORAS
      <td align="right"  >      
      <td align="right"  >      
      <td align="right"  >      
      <td align="center"><?php 
	  //echo $year_url.'-'.$month_url.'-'.$day_url.'-'.$tipo_url.'-'.$hac_url ;
	  //$juli = mysql_query("SELECT SUM(`v_tal`) as total FROM nomina_ingreso where  YEAR(fecha) = '2014' AND                 MONTH(fecha) = '01' AND concep = 'Egreso'and estado!='Cancelada' and estado!='Pendiente'",$conexion);
	  
	  //echo $row_haci[hacienda];
	  mysql_select_db($database_conexion, $conexion);
	 // echo "Hola";
	 if($year_url=='' && $month_url=='' && $day_url==''){
		//echo 1;
		
		$juli = mysql_query("SELECT SUM(`hnormales`) as total FROM `nomina_ingreso` WHERE `hacienda`='$row_haci[hacienda]' and fecha='$hoy'
		
		 ORDER BY `fecha` DESC",$conexion);  
    }
	
    if($year_url!='' && $month_url=='' && $day_url==''){
        
		
		$juli = mysql_query("SELECT SUM(`hnormales`) as total FROM `nomina_ingreso`  WHERE `hacienda`='$row_haci[hacienda]' AND YEAR(fecha) ='$year_url' ORDER BY `fecha` DESC ",$conexion);
    }
	
    if($year_url!='' && $month_url!='' && $day_url==''){
        $juli = mysql_query("SELECT SUM(`hnormales`) as total  FROM `nomina_ingreso`  WHERE `hacienda`='$row_haci[hacienda]' AND YEAR(fecha) ='$year_url' AND MONTH(fecha) = '$month_url'          ORDER BY                  `fecha` DESC",$conexion); 
	  
		    }
   
    if($year_url!='' && $month_url!='' && $day_url!=''){
		$juli = mysql_query("SELECT SUM(`hnormales`) as total  FROM `nomina_ingreso`  WHERE  `hacienda`='$row_haci[hacienda]' AND YEAR(fecha) =  '$year_url' AND MONTH(fecha) = '$month_url'         AND  DAY(fecha) = '$day_url' ORDER             BY `fecha` DESC",$conexion);
		
      
    }
    @$row07 = mysql_fetch_array($juli, MYSQL_ASSOC);
    @$Total= number_format ($row07["total"]);
	$total_nor=$row07["total"];
    echo $Total;
	?></td>
      <td align="center" class="row" ><?php 
	  //echo $year_url.'-'.$month_url.'-'.$day_url.'-'.$tipo_url.'-'.$hac_url ;
	  //$juli = mysql_query("SELECT SUM(`v_tal`) as total FROM nomina_ingreso where  YEAR(fecha) = '2014' AND                 MONTH(fecha) = '01' AND concep = 'Egreso'and estado!='Cancelada' and estado!='Pendiente'",$conexion);
	  
	  //echo $row_haci[hacienda];
	  mysql_select_db($database_conexion, $conexion);
	 // echo "Hola";
	 if($year_url=='' && $month_url=='' && $day_url==''){
		//echo 1;
		
		$juli = mysql_query("SELECT SUM(`hextras`) as total FROM `nomina_ingreso` WHERE `hacienda`='$row_haci[hacienda]' and fecha='$hoy'
		
		 ORDER BY `fecha` DESC",$conexion);  
    }
	
    if($year_url!='' && $month_url=='' && $day_url==''){
        
		
		$juli = mysql_query("SELECT SUM(`hextras`) as total FROM `nomina_ingreso`  WHERE `hacienda`='$row_haci[hacienda]' AND YEAR(fecha) ='$year_url' ORDER BY `fecha` DESC ",$conexion);
    }
	
    if($year_url!='' && $month_url!='' && $day_url==''){
        $juli = mysql_query("SELECT SUM(`hextras`) as total  FROM `nomina_ingreso`  WHERE `hacienda`='$row_haci[hacienda]' AND YEAR(fecha) ='$year_url' AND MONTH(fecha) = '$month_url'          ORDER BY                  `fecha` DESC",$conexion); 
	  
		    }
   
    if($year_url!='' && $month_url!='' && $day_url!=''){
		$juli = mysql_query("SELECT SUM(`hextras`) as total  FROM `nomina_ingreso`  WHERE  `hacienda`='$row_haci[hacienda]' AND YEAR(fecha) =  '$year_url' AND MONTH(fecha) = '$month_url'         AND  DAY(fecha) = '$day_url' ORDER             BY `fecha` DESC",$conexion);
		
      
    }
    @$row072 = mysql_fetch_array($juli, MYSQL_ASSOC);
    @$Total= number_format ($row072["total"]);
	$total_ext=$row072["total"];
    echo $Total;
	?></td>
      <td align="center"  ><?php 
	  //echo $year_url.'-'.$month_url.'-'.$day_url.'-'.$tipo_url.'-'.$hac_url ;
	  //$juli = mysql_query("SELECT SUM(`v_tal`) as total FROM nomina_ingreso where  YEAR(fecha) = '2014' AND                 MONTH(fecha) = '01' AND concep = 'Egreso'and estado!='Cancelada' and estado!='Pendiente'",$conexion);
	  
	  //echo $row_haci[hacienda];
	  mysql_select_db($database_conexion, $conexion);
	 // echo "Hola";
	 if($year_url=='' && $month_url=='' && $day_url==''){
		//echo 1;
		
		$juli = mysql_query("SELECT SUM(`htotales`) as total FROM `nomina_ingreso` WHERE `hacienda`='$row_haci[hacienda]' and fecha='$hoy'
		
		 ORDER BY `fecha` DESC",$conexion);  
    }
	
    if($year_url!='' && $month_url=='' && $day_url==''){
        
		
		$juli = mysql_query("SELECT SUM(`htotales`) as total FROM `nomina_ingreso`  WHERE `hacienda`='$row_haci[hacienda]' AND YEAR(fecha) ='$year_url' ORDER BY `fecha` DESC ",$conexion);
    }
	
    if($year_url!='' && $month_url!='' && $day_url==''){
        $juli = mysql_query("SELECT SUM(`htotales`) as total  FROM `nomina_ingreso`  WHERE `hacienda`='$row_haci[hacienda]' AND YEAR(fecha) ='$year_url' AND MONTH(fecha) = '$month_url'          ORDER BY                  `fecha` DESC",$conexion); 
	  
		    }
   
    if($year_url!='' && $month_url!='' && $day_url!=''){
		$juli = mysql_query("SELECT SUM(`htotales`) as total  FROM `nomina_ingreso`  WHERE  `hacienda`='$row_haci[hacienda]' AND YEAR(fecha) =  '$year_url' AND MONTH(fecha) = '$month_url'         AND  DAY(fecha) = '$day_url' ORDER             BY `fecha` DESC",$conexion);
		
      
    }
    @$row07 = mysql_fetch_array($juli, MYSQL_ASSOC);
    @$Total= number_format ($row07["total"]);
    echo $Total;
	?></td>
      <td  >&nbsp;</td>
      <td  >&nbsp;</td>
      <td colspan="3"  >&nbsp;</td>
    </tr>
    
    
    <tr class="row">
      <th align="right"  >
      <th align="right"  >
      <td align="right"  ></td>
      <td align="right"  ></td>
      <td align="right"  ></td>
      <td align="center">&nbsp;</td>
      <td align="center" class="row" >&nbsp;</td>
      <td align="center"  >&nbsp;</td>
      <td  >&nbsp;</td>
      <td  >&nbsp;</td>
      <td colspan="3"  >&nbsp;</td>
    </tr>
    
    
    <tr class="row">
      <th align="right"  >VALORES DIARIOS
        </td>
      <th align="right"  >   </td>    
      <td align="right"  ></td>
      <td align="right"  >       </td>
      <td align="right"  >       </td>
      <td align="center">$<?php
	  	$filtro=$row_haci['hacienda'];
			mysql_select_db($database_conexion, $conexion);
			$query_fijos = "SELECT * FROM nomina_fijos_valle WHERE hacienda='$filtro'";
			$fijos = mysql_query($query_fijos, $conexion) or die(mysql_error());
			$row_fijos = mysql_fetch_assoc($fijos);
			$totalRows_fijos = mysql_num_rows($fijos);
	   		$dirias=($row_fijos['minimo']/ $row_fijos['dias_mes'])/$row_fijos['horas_dia'];
	   
	    echo number_format ($dirias_nor=$dirias * $total_nor);
	   
	   ?>
       
       
       </td>
      <td align="center" class="row" >$<?php echo number_format ($dirias_ext=$row_fijos['hora_extra']*$total_ext);?></td>
      <td align="center"  >$<?php echo number_format ($dirias_ext + $dirias_nor);?></td>
      <td  >&nbsp;</td>
      <td  >&nbsp;</td>
      <td colspan="3"  >&nbsp;</td>
    </tr>
    
    
    
   
</table>

      <?php } while ($row_haci = mysql_fetch_assoc($haci)); ?>
</div>
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
	
	$('#year').load('basc_hist2.php?h=' + h.replace(/ /g,"+") + '&y=' + y.replace(/ /g,"+") +
	'&m=' + m.replace(/ /g,"+") +'&d=' + d.replace(/ /g,"+") +'&t=' + t.replace(/ /g,"+") +' #year' );
	
	$('#month').load('basc_hist2.php?h=' + h.replace(/ /g,"+") + '&y=' + y.replace(/ /g,"+") +
	'&m=' + m.replace(/ /g,"+") +'&d=' + d.replace(/ /g,"+") +'&t=' + t.replace(/ /g,"+") +' #month ' );
	
	$('#day').load('basc_hist2.php?h=' + h.replace(/ /g,"+") + '&y=' + y.replace(/ /g,"+") +
	'&m=' + m.replace(/ /g,"+") +'&d=' + d.replace(/ /g,"+") +'&t=' + t.replace(/ /g,"+") +' #day' );
	
	$('#table').load('basc_hist2.php?h=' + h.replace(/ /g,"+") + '&y=' + y.replace(/ /g,"+") +
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
	
	$('#tipo').load('basc_hist2.php?h=' + hac.replace(/ /g,"+") + '&y=' + y.replace(/ /g,"+") +
	'&m=' + m.replace(/ /g,"+") +'&d=' + d.replace(/ /g,"+") +'&t=' + t.replace(/ /g,"+") +' #tipo' );
	
	$('#year').load('basc_hist2.php?h=' + hac.replace(/ /g,"+") + '&y=' + y.replace(/ /g,"+") +
	'&m=' + m.replace(/ /g,"+") +'&d=' + d.replace(/ /g,"+") +'&t=' + t.replace(/ /g,"+") +' #year' );
	
	$('#month').load('basc_hist2.php?h=' + hac.replace(/ /g,"+") + '&y=' + y.replace(/ /g,"+") +
	'&m=' + m.replace(/ /g,"+") +'&d=' + d.replace(/ /g,"+") +'&t=' + t.replace(/ /g,"+") +' #month ' );
	
	$('#day').load('basc_hist2.php?h=' + hac.replace(/ /g,"+") + '&y=' + y.replace(/ /g,"+") +
	'&m=' + m.replace(/ /g,"+") +'&d=' + d.replace(/ /g,"+") +'&t=' + t.replace(/ /g,"+") +' #day' );
	
	$('#table').load('basc_hist2.php?h=' + hac.replace(/ /g,"+") + '&y=' + y.replace(/ /g,"+") +
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
	
	$('#month').load('basc_hist2.php?h=' + h.replace(/ /g,"+") + '&y=' + y.replace(/ /g,"+") +
	'&m=' + m.replace(/ /g,"+") +'&d=' + d.replace(/ /g,"+") +'&t=' + t.replace(/ /g,"+") +' #month ' );
	
	$('#day').load('basc_hist2.php?h=' + h.replace(/ /g,"+") + '&y=' + y.replace(/ /g,"+") +
	'&m=' + m.replace(/ /g,"+") +'&d=' + d.replace(/ /g,"+") +'&t=' + t.replace(/ /g,"+") +' #day' );
	
	$('#table').load('basc_hist2.php?h=' + h.replace(/ /g,"+") + '&y=' + y.replace(/ /g,"+") +
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
	
	$('#day').load('basc_hist2.php?h=' + h.replace(/ /g,"+") + '&y=' + y.replace(/ /g,"+") +
	'&m=' + m.replace(/ /g,"+") +'&d=' + d.replace(/ /g,"+") +'&t=' + t.replace(/ /g,"+") +' #day' );
	
	$('#table').load('basc_hist2.php?h=' + h.replace(/ /g,"+") + '&y=' + y.replace(/ /g,"+") +
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
	
	$('#table').load('basc_hist2.php?h=' + h.replace(/ /g,"+") + '&y=' + y.replace(/ /g,"+") +
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


//funcion para imprimir la pantalla
function imprimir_esto(id_tabla){
	//console.log ('h:'+id_tabla);
	
	$("#"+id_tabla).printThis({
	     debug: false,          
	     importCSS: true,           
         printContainer: true,      				         
		 loadCSS: "../css/style-print.css", 
         pageTitle: "",             
         removeInline: false       
	  });
}
</script>
</html>
<?php
@mysql_free_result($years_query);
@mysql_free_result($months_q);
@mysql_free_result($peso_tot_q);
}
?>
