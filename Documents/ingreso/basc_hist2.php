<?php require_once('joom.php'); ?>
<?php require_once('../Connections/conexion.php'); ?>
<?php
if ($acceso !='0'){ 
//echo "hola ". $acceso;
?>
<table width="70%" align="center">
  <tr>
    <td><img src="../img/Logo.png" width="886" height="248" /></td>
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
<link href="../css/clean.css" rel="stylesheet" type="text/css" />
<link rel="stylesheet" type="text/css" href="http://code.jquery.com/ui/1.10.3/themes/smoothness/jquery-ui.css" />
<link href="../../css/style.css" rel="stylesheet" type="text/css" />
<link href="../css/shadowbox.css" rel="stylesheet" type="text/css" />


<script src="http://code.jquery.com/jquery-1.9.1.js"></script>
<script src="http://code.jquery.com/ui/1.10.1/jquery-ui.js"></script>

<script src="../js/shadowbox.js" type="text/javascript"></script>
<script src="../js/jquery.validate.js" type="text/javascript"></script>
<script src="../js/jquery.mask.js" type="text/javascript"></script>

<script src="../js/printThis.js" type="text/javascript"></script>


</head>

<body>
<input type="hidden" id="tf_user" value="<?php echo $usuario2 ?>">
  <input type="hidden" id="tf_user2" value="<?php echo $usuario ?>">
  

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
    width="48" height="48" border="0"  style="cursor:pointer" onclick="imprimir_esto('main')"/></td>
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
    	<td class=" cont" align="right" width="14%">
          <?php
		 // echo $usuario2;
		  
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
    <td width="13%"  align="right">Fecha : Desde: </td>
    <td  align="right" width="24%"><input  name="tf_fecha" type="text" id="tf_fecha" style="width:80%"  
    								value="<?php echo date('Y-m-d') ?>" /></td>
   <td  align="right" width="11%"> Hasta</td>
   <td  align="right" width="19%"><input  name="tf_fecha2" type="text" id="tf_fecha2" style="width:80%"  /></td>
    	<td width="19%" align="right" class="cont"><input name="sl_tipo"  type="hidden" disabled id="sl_tipo" 
        											onChange="load5()" value="Todo" > 
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
		$usuario2;
		
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
    <td colspan="12" align="left"  class="subtitle">
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
	@$f1=$_GET['f1'];
	@$f2=$_GET['f2'];
	@$fecha= date("Y-m-d");
	
	@$hda=$_GET['hda'];
	
    mysql_select_db($database_conexion, $conexion);
	
	if($hda !=' ' && $f2 !='' ) {
	//	echo 1;
		
	}
	if($hda ==' ' && $f2 !='' ) {
	//	echo 2;
	}
	if( $hda ==''   && $f2 =='' ){
	//	echo 3;
	}
	if( $hda !=''   &&  $f2 =='' ){
	//	echo 4;
	}
	
	
	
	
	
	
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
    
 
    <tr align="center" style="font-size: 12px"  class="row"  >
    
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
      <th colspan="2" align="right"  >TOTAL HORAS</th>
          
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
      <td align="center" ><?php 
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
      <th colspan="2" align="right"  >&nbsp;</td>
      <td align="right"  >&nbsp;</td>
      <td align="right"  >&nbsp;</td>
      <td align="right"  >&nbsp;</td>
      <td align="center">&nbsp;</td>
      <td align="center"  >&nbsp;</td>
      <td align="center"  >&nbsp;</td>
      <td  >&nbsp;</td>
      <td  >&nbsp;</td>
      <td colspan="3"  >&nbsp;</td>
    </tr>
    
    
    <tr class="row">
      <td align="right"  >VALORES DIARIOS</td>
      <th align="right"  >&nbsp;</td>    
      <td align="right"  >&nbsp;</td>
      <td align="right"  >&nbsp;</td>
      <td align="right"  >&nbsp;</td>
      <td align="center">$<?php
	  	$filtro=$row_haci['hacienda'];
			mysql_select_db($database_conexion, $conexion);
			$query_fijos = "SELECT * FROM nomina_fijos_valle WHERE hacienda='$filtro'";
			$fijos = mysql_query($query_fijos, $conexion) or die(mysql_error());
			$row_fijos = mysql_fetch_assoc($fijos);
			$totalRows_fijos = mysql_num_rows($fijos);
	   		@$dirias=($row_fijos['minimo']/ $row_fijos['dias_mes'])/$row_fijos['horas_dia'];
	   
	    echo number_format ($dirias_nor=$dirias * $total_nor);
	   
	   ?>
       
       
       </td>
      <td align="center"  >$<?php echo number_format ($dirias_ext=$row_fijos['hora_extra']*$total_ext);?></td>
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
	//datep()
	//cambia()
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



	

$('#tf_fecha2').change(function(){
	var f1=$('#tf_fecha').val();
	var f2=$('#tf_fecha2').val();
	//var hda=$('#sl_hac').val();
	//alert (f1)
	//alert (f2)
var user = $('#tf_user').val();
//alert(user)	
if ( user == 'general'){
		hda = $('#sl_hac').val();
	} else {
		hda= $('#tf_user').val();	
	}
	
		//console.log ('h:'+f1+' t:'+f2+' y:'+hda);
	
	$('#table').load('basc_hist2.php?hda=' + hda.replace(/ /g,"+") +'&f1=' + f1.replace(/ /g,"+") +'&f2=' + f2.replace(/ /g,"+")  +' #table > *' , 
	function(response, status, xhr){
		
		console.log(status);
			//datep()		
			//cambia()
	});
	
})

$('#tf_fecha').change(function(){
	var f1=$('#tf_fecha').val();
	var f2=$('#tf_fecha2').val();
	//alert (f1)
	//alert (f1)
	//alert (f2)
var user = $('#tf_user').val();
//alert(user)	
if ( user == 'general'){
		hda = $('#sl_hac').val();
	} else {
		hda= $('#tf_user').val();	
	}
	
		//console.log ('h:'+f1+' t:'+f2+' y:'+hda);
	
	$('#table').load('basc_hist2.php?hda=' + hda.replace(/ /g,"+") +'&f1=' + f1.replace(/ /g,"+") +'&f2=' + f2.replace(/ /g,"+")  +' #table > * ' , 
	function(response, status, xhr){
		//console.log('r:'+response+' s:'+status+' x: '+xhr);
		console.log(status);
		//datep()
		//cambia()	
		
	});
	
	
	
	
})

	/*
	//configurando el datepicker para las fechas
	$.datepicker.setDefaults({ 
		changeMonth: true,
		changeYear: true,
		dateFormat: "yy-mm-dd",
		dayNamesMin: ['Do', 'Lu', 'Ma', 'Mi', 'Ju', 'Vi', 'Sa'],
		monthNames: ['Enero de', 'Febrero de', 'Marzo de', 'Abril de', 'Mayo de', 'Junio de', 
					  'Julio de', 'Agosto de', 'Septiembre de', 'Octubre de', 
					  'Noviembre de', 'Diciembre de'],
		nextText: 'Siguiente',
		prevText: 'Anterior'
	});
	
	//hace que los campos desplieguen un datepicker
	$("#tf_fecha").datepicker();
	$("#tf_fecha2").datepicker();
*/
//function datep(){
	$(function () {
		$.datepicker.setDefaults($.datepicker.regional["es"]);
		$("#tf_fecha, #tf_fecha2").datepicker({ dateFormat: "yy-mm-dd",
			changeMonth: true,
			changeYear: true,
			dateFormat: "yy-mm-dd",
			dayNamesMin: ['Do', 'Lu', 'Ma', 'Mi', 'Ju', 'Vi', 'Sa'],
			monthNames: ['Enero de', 'Febrero de', 'Marzo de', 'Abril de', 'Mayo de', 'Junio de', 
						  'Julio de', 'Agosto de', 'Septiembre de', 'Octubre de', 
						  'Noviembre de', 'Diciembre de'],
			nextText: 'Siguiente',
			prevText: 'Anterior'
		});						
	});
//}
//funcion para imprimir la pantalla
function imprimir_esto(id_tabla){
	$("#"+id_tabla).printThis({
	     debug: false,          
	     importCSS: true,           
         printContainer: true,      				         
		 loadCSS: "../../css/style-print.css", 
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
