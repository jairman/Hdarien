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
@$order_url=$_GET['o'];

date_default_timezone_set('America/Bogota');
mysql_query("SET lc_time_names = 'es_CO'");

//echo $hac_url.'-'.$year_url.'-'.$month_url.'-'.$day_url.'-'.$tipo_url;


$maxRows_fpago = 100;
$pageNum_fpago = 0;
if (isset($_GET['pageNum_fpago'])) {
  $pageNum_fpago = $_GET['pageNum_fpago'];
}
$startRow_fpago = $pageNum_fpago * $maxRows_fpago;

mysql_select_db($database_conexion, $conexion);
$query_fpago = "SELECT DISTINCT f_pago FROM d89xz_diario";
$query_limit_fpago = sprintf("%s LIMIT %d, %d", $query_fpago, $startRow_fpago, $maxRows_fpago);
$fpago = mysql_query($query_limit_fpago, $conexion) or die(mysql_error());
$row_fpago = mysql_fetch_assoc($fpago);

?>
<!doctype html>
<html>
<head>
<meta charset="UTF-8">
<title>Caja  Historial</title>
<link href="../css/clean.css" rel="stylesheet" type="text/css" />
<link rel="stylesheet" type="text/css" href="http://code.jquery.com/ui/1.10.3/themes/smoothness/jquery-ui.css" />
<link href="../css/style.css" rel="stylesheet" type="text/css" />
<link href="../css/shadowbox.css" rel="stylesheet" type="text/css" />

<script type="text/javascript" src="//ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
<script type="text/javascript" src="http://code.jquery.com/ui/1.10.3/jquery-ui.js"></script>
<script src="../js/shadowbox.js" type="text/javascript"></script>

<script src="../js/printThis.js" type="text/javascript"></script>

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
<table width="98%" border="0" align="center" cellspacing="0">
  <tr >
    <td width="244" align="left">&nbsp;</td>
    <td width="308" align="center">&nbsp;</td>
    <td width="239" align="right">&nbsp;</td>
  </tr>
</table>

<DIV ID="seleccion">

<table width="98%"  align="center" id="table_header">
    <tr>
    <td width="91%" colspan="1" align="left" ><img src="../img/Logo.png" alt="logo" name="logo" width="200" height="70" id="logo" />
    </td>
    <td width="9%" colspan="3" align="center" valign="baseline"><input name="imgb2" type="image"   title="Imprimir" src="../img/imprimir.png" alt="" 
    width="40" height="40" border="0"  style="cursor:pointer" onClick="imprimir_esto('seleccion')"/></td>
    </tr>
</table>

<table width="98%" align="center">
    <tr>
      <td width="10%" align="left" class="bold cont">&nbsp;</td>
      <td width="17%" align="left" class="bold cont "></td>
      
      <td width="10%" align="right" class="bold cont">&nbsp;</td>
      <td colspan="3" align="right" class="bold cont">&nbsp;</td>
    </tr>
    <tr>
    	<td align="left" class="bold cont">Tienda:</td>
   	  <td align="left" class="bold cont"><?php
        if ($usuario2 == 'general'){
        ?>
        <select name="sl_hac" id="sl_hac" style="width:70%">
          <option value="Todo">Todas</option>
          <?php
        mysql_select_db($database_conexion, $conexion);
        $query_hac = "SELECT DISTINCT `hacienda` as hacienda , `hacienda` as hacienda1 FROM 
        `d89xz_hacienda` WHERE `delete`=0 order by hacienda";
        $hac = mysql_query($query_hac, $conexion) or die(mysql_error());
        while ($row_hac = mysql_fetch_assoc($hac)){
        ?>
          <option value="<?php echo $row_hac['hacienda']?>"><?php echo $row_hac['hacienda1']?></option>
          <?php
        } 
        ?>
        </select>
        <?php 
        }else{
        ?>
        <input type="text" readonly id="tf_hac" style="width:70%" value="<?php echo $usuario2 ?>">
      <?php
        }
        ?></td>
        <td colspan="2" align="left" class="bold cont"><div id="tipo" ><input type="hidden" readonly name="sl_tipo" id="sl_tipo" style="width:70%" value="Todo">
          <?php
        mysql_select_db($database_conexion, $conexion);
        if ($hac_url != 'Todo'){
			$query_anos = "SELECT DISTINCT `concep`
			FROM `d89xz_diario` WHERE  `estado` !='Anulada'
			AND `hacienda`='$hac_url' ";
        }else{
			$query_anos = "SELECT DISTINCT `concep`
			FROM `d89xz_diario` WHERE `estado`!='Anulada'";
        }
        $anos = mysql_query($query_anos, $conexion) or die(mysql_error());
        while($row_anos = mysql_fetch_assoc($anos)){
        ?>
          <option value="<?php echo $row_anos['concep']?>"><?php echo $row_anos['concep']?></option>
          <?php
        }
        ?>
        </select></div></td>
      <td width="6%" align="left" class="bold cont">Fecha:</td>
      <td width="44%" align="left" class="bold cont"><div id="year" align="right">
    <select name="sl_year" id="sl_year" onChange="load2()" style=" width:100px;" >
        <option value="">Año</option>
        <?php
		mysql_select_db($database_conexion, $conexion);
		if ($hac_url != 'Todo'){
			if ($tipo_url != 'Todo'){
				$query_anos = "SELECT DISTINCT YEAR(fecha)
				FROM `d89xz_diario` WHERE  `estado` !='Anulada' AND `concep`='$tipo_url'
				AND `hacienda`='$hac_url' ORDER BY YEAR(fecha) DESC";	
			}else{
				$query_anos = "SELECT DISTINCT YEAR(fecha)
				FROM `d89xz_diario` WHERE `estado` !='Anulada'
				AND `hacienda`='$hac_url' ORDER BY YEAR(fecha) DESC";	
			}
		}else{
			if($tipo_url != 'Todo'){
				$query_anos = "SELECT DISTINCT YEAR(fecha)
				FROM `d89xz_diario` WHERE `estado` !='Anulada' AND `concep`='$tipo_url'
				ORDER BY YEAR(fecha) DESC";	
			}else{
				$query_anos = "SELECT DISTINCT YEAR(fecha)
				FROM `d89xz_diario` WHERE `estado` !='Anulada'
				ORDER BY YEAR(fecha) DESC";			
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
    <select name="sl_month" id="sl_month" onChange="load3()" style=" width:100px;">
        <option value="">Mes</option>
        <?php
		echo $year_url;
		mysql_select_db($database_conexion, $conexion);
		if ($hac_url != 'Todo'){
			if($tipo_url != 'Todo'){
				$query_mes = "SELECT DISTINCT MONTH(fecha), MONTHNAME(fecha) FROM `d89xz_diario` WHERE 
				`estado` !='Anulada' AND `hacienda`='$hac_url' AND `concep`='$tipo_url'
				ORDER BY MONTH(fecha) DESC";	
			}else{
				$query_mes = "SELECT DISTINCT MONTH(fecha), MONTHNAME(fecha) FROM `d89xz_diario` WHERE 
				`estado` !='Anulada' AND `hacienda`='$hac_url' ORDER BY MONTH(fecha) DESC";			
			}
		}else{
			if($tipo_url != 'Todo'){
				$query_mes = "SELECT DISTINCT MONTH(fecha), MONTHNAME(fecha) FROM `d89xz_diario` WHERE 
				`estado` !='Anulada' AND YEAR(fecha)='$year_url' AND `concep`='$tipo_url'
				ORDER BY MONTH(fecha) DESC";	
			}else{
				$query_mes = "SELECT DISTINCT MONTH(fecha), MONTHNAME(fecha) FROM `d89xz_diario` WHERE 
				`estado` !='Anulada' AND YEAR(fecha)='$year_url' ORDER BY MONTH(fecha) DESC";	
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
    <select name="sl_day" id="sl_day" onChange="load4()" style=" width:100px;">
        <option value="">Día</option>
        <?php
		mysql_select_db($database_conexion, $conexion);
		if ($hac_url != 'Todo'){
			if($tipo_url != 'Todo'){
				$query_dia = "SELECT DISTINCT DAY(fecha) FROM `d89xz_diario` WHERE 
				`estado` !='Anulada' AND YEAR(fecha)='$year_url' AND MONTH(fecha)='$month_url' 
				AND `hacienda`='$hac_url' AND `concep`='$tipo_url' ORDER BY DAY(fecha) ASC";	
			}else{
				$query_dia = "SELECT DISTINCT DAY(fecha) FROM `d89xz_diario` WHERE 
				`estado` !='Anulada' AND YEAR(fecha)='$year_url' AND MONTH(fecha)='$month_url' 
				AND `hacienda`='$hac_url' ORDER BY DAY(fecha) ASC";	
			}
		}else{
			if($tipo_url != 'Todo'){
				$query_dia = "SELECT DISTINCT DAY(fecha) FROM `d89xz_diario` WHERE 
				`estado` !='Anulada' AND YEAR(fecha)='$year_url' AND MONTH(fecha)='$month_url' 
				AND `concep`='$tipo_url' ORDER BY DAY(fecha) ASC";	
			}else{
				$query_dia = "SELECT DISTINCT DAY(fecha) FROM `d89xz_diario` WHERE 
				`estado` !='Anulada' AND YEAR(fecha)='$year_url' AND MONTH(fecha)='$month_url' 
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
    </div></td>
    </tr>
</table>

<div id="table" >    
<table width="98%" border="1" align="center" cellspacing="0">
    <tr>
    <td colspan="9" align="center" class="tittle">
    <label style="font-size:18px">
    Reporte  de Caja</label> </td>
    </tr>
    <tr class="tittle">
    <td width="104" align="center" onClick="orden_bus('factura')" style="cursor:pointer"
     				title="Ordenar por Factuta" >N° Factura</td>
    <td width="96" align="center" onClick="orden_bus('fecha')" style="cursor:pointer" 
    				title="Ordenar por Fecha" >Fecha</td>
    <td width="200" align="center"  onClick="orden_bus('cliente')" style="cursor:pointer"  	 
    				title="Ordenar por Cliente/Proveedor">Cliente/Proveedor</td>
    <td width="277" align="center"  onClick="orden_bus('comentario')" style="cursor:pointer" 
    				title="Ordenar por Comentario">Comentario</td>
    <td width="98"  onClick="orden_bus('valor')" style="cursor:pointer" title="Valor Total">Valor Total</td>
    <td width="84" align="center" onClick="orden_bus('concep')" style="cursor:pointer" 
    				title="Ordenar por Concepto">Concepto</td>
    <td width="78" align="center"  onClick="orden_bus('estado')" style="cursor:pointer"
    				 title="Ordenar por Estado">Estado</td>
    <td width="126" align="center" onClick="orden_bus('hacienda')" style="cursor:pointer"
    				 title="Ordenar por Sucursal">Sucursal</td>
    </tr>
	<?php
    mysql_select_db($database_conexion, $conexion);
    if($year_url=='' && $month_url=='' && $day_url==''){
        if ($hac_url != 'Todo'){
            //echo 1;
			//echo $tipo_url;
			if($tipo_url != 'Todo'){
				//echo '2a1';
				$query_basc = "SELECT DISTINCT factura,estado,cliente,hacienda,fecha,concep FROM `d89xz_diario`                 WHERE `hacienda`='$hac_url' AND `concep`='$tipo_url' $order_url ";
			}else{
				$anoss1= date("Y"); // Year (2003)
				$mes1= date("m"); // Year (2003)
				$dia1=date("d");
			    $dia2=$dia1 + 1;
				//echo '2a2';
				$query_basc = "SELECT DISTINCT factura,estado,cliente,hacienda,fecha,concep FROM `d89xz_diario`                 WHERE  `hacienda`='$hac_url'and  YEAR(fecha) ='$anoss1' AND MONTH(fecha) = '$mes1'  AND DAY(fecha) = '$dia2' $order_url ";
			}
        }else{
           // echo 2;
			//echo $tipo_url;
			if($tipo_url != 'Todo'){
				//echo '2a';
				$query_basc = "SELECT DISTINCT factura,estado,cliente,hacienda,fecha,concep FROM `d89xz_diario`                WHERE `concep`='$tipo_url' $order_url";
			}else{
				//echo '2b';
				$anoss1= date("Y"); // Year (2003)
				$mes1= date("m"); // Year (2003)
				$dia1=date("d");
			    $dia2=$dia1 + 1;
				$query_basc = "SELECT DISTINCT factura,estado,cliente,hacienda,fecha,concep FROM `d89xz_diario`                 WHERE  YEAR(fecha) ='$anoss1' AND MONTH(fecha) = '$mes1'  AND DAY(fecha) = '$dia2' $order_url";
			}
        }
    }
    if($year_url!='' && $month_url=='' && $day_url==''){
        if ($hac_url != 'Todo'){
            //echo 3;
			if($tipo_url != 'Todo'){
				$query_basc = "SELECT DISTINCT factura,estado,cliente,hacienda,fecha,concep FROM `d89xz_diario`                 WHERE `concep`='$tipo_url' AND `hacienda`='$hac_url' AND YEAR(fecha) = '$year_url'$order_url";
			}else{
				$query_basc = "SELECT DISTINCT factura,estado,cliente,hacienda,fecha,concep FROM `d89xz_diario`                WHERE `hacienda`='$hac_url' AND YEAR(fecha) ='$year_url' $order_url";
			}
        }else{
            //echo 4;
			if($tipo_url != 'Todo'){
				$query_basc = "SELECT DISTINCT factura,estado,cliente,hacienda,fecha,concep FROM `d89xz_diario`               WHERE `concep`='$tipo_url' AND  YEAR(fecha) = '$year_url' $order_url";
			}else{
				$query_basc = "SELECT DISTINCT factura,estado,cliente,hacienda,fecha,concep FROM `d89xz_diario`                WHERE YEAR(fecha) = '$year_url' $order_url";
			} 
        }
    }
    if($year_url!='' && $month_url!='' && $day_url==''){
        if ($hac_url != 'Todo'){
            //echo 5;
			if($tipo_url != 'Todo'){
				$query_basc = "SELECT DISTINCT factura,estado,cliente,hacienda,fecha,concep FROM `d89xz_diario`                 WHERE  `concep`='$tipo_url' AND `hacienda`='$hac_url' AND YEAR(fecha) = '$year_url' 
			     AND MONTH(fecha) = '$month_url' $order_url";
			}else{
				$query_basc = "SELECT DISTINCT factura,estado,cliente,hacienda,fecha,concep FROM `d89xz_diario`                 WHERE `hacienda`='$hac_url' AND YEAR(fecha) ='$year_url' AND MONTH(fecha) = '$month_url' $order_url";
			}
        }else{
            //echo 6;
			if($tipo_url != 'Todo'){
				$query_basc = "SELECT DISTINCT factura,estado,cliente,hacienda,fecha,concep FROM `d89xz_diario`                WHERE  YEAR(fecha) = '$year_url' AND `concep`='$tipo_url' AND MONTH(fecha) = '$month_url' $order_url";
			}else{
				$query_basc = "SELECT DISTINCT factura,estado,cliente,hacienda,fecha,concep FROM `d89xz_diario`                WHERE  YEAR(fecha) = '$year_url' AND MONTH(fecha) = '$month_url' $order_url";
			}  
        }
    }
    if($year_url!='' && $month_url!='' && $day_url!=''){
        if ($hac_url != 'Todo'){
            //echo 7;
			if($tipo_url != 'Todo'){
				$query_basc = "SELECT DISTINCT factura,estado,cliente,hacienda,fecha,concep FROM `d89xz_diario`                WHERE  `concep`='$tipo_url' AND `hacienda`='$hac_url' AND YEAR(fecha) = '$year_url' AND MONTH(fecha) =                '$month_url' AND DAY(fecha) = '$day_url'  $order_url";
			}else{
				$query_basc = "SELECT DISTINCT factura,estado,cliente,hacienda,fecha,concep FROM `d89xz_diario`                 WHERE  `hacienda`='$hac_url' AND YEAR(fecha) =  '$year_url' AND MONTH(fecha) = '$month_url' AND                  DAY(fecha) = '$day_url' $order_url";
			}
        }else{
            //echo 8;
			if($tipo_url != 'Todo'){
				$query_basc = "SELECT DISTINCT factura,estado,cliente,hacienda,fecha,concep FROM `d89xz_diario`                WHERE YEAR(fecha) = '$year_url' AND `concep`='$tipo_url' AND MONTH(fecha) = '$month_url' AND                 DAY(fecha) = '$day_url' $order_url";
			}else{
				$query_basc = "SELECT DISTINCT factura,estado,cliente,hacienda,fecha,concep FROM `d89xz_diario`                WHERE  YEAR(fecha) = '$year_url' AND MONTH(fecha) = '$month_url' AND DAY(fecha) = '$day_url' $order_url";
			} 
        }
    }
	
	$basc = mysql_query($query_basc, $conexion) or die(mysql_error());
   	$num = mysql_num_rows($basc);
    while($row_basc = mysql_fetch_assoc($basc)){
    
    $est=$row_basc['delete'];
    $tipo=$row_basc['tipo_peso'];
    ?>
    
  
    <tr align="center"  class="row" >
    <td onClick="CrearEnlace('factura_diario_h.php?id=<?php echo $row_basc['factura']; ?>&amp;hda=<?php echo  $row_basc['hacienda'] ?>');"><?php echo $row_basc['factura']; ?></td>
    <td  onClick="CrearEnlace('factura_diario_h.php?id=<?php echo $row_basc['factura']; ?>&amp;hda=<?php echo  $row_basc['hacienda'] ?>');"><?php echo $row_basc['fecha']; ?></td>
    <td align="left"  onClick="CrearEnlace('factura_diario_h.php?id=<?php echo $row_basc['factura']; ?>&amp;hda=<?php echo  $row_basc['hacienda'] ?>');"> <?php echo $row_basc['cliente']; ?></td>
    <td align="left"  onClick="CrearEnlace('factura_diario_h.php?id=<?php echo $row_basc['factura']; ?>&amp;hda=<?php echo  $row_basc['hacienda'] ?>');"><?php
			
			mysql_select_db($database_conexion, $conexion);
			$query_hd = "SELECT * FROM d89xz_diario where factura='$row_basc[factura]' and hacienda='$row_basc[hacienda]'";
			$hd = mysql_query($query_hd, $conexion) or die(mysql_error());
			$row_hd = mysql_fetch_assoc($hd);
			$totalRows_hd = mysql_num_rows($hd);
	
	 		echo $row_hd['comentario']; ?>
    
    
    </td>
    <td align="right"  onClick="CrearEnlace('factura_diario_h.php?id=<?php echo $row_basc['factura']; ?>&amp;hda=<?php echo  $row_basc['hacienda'] ?>');"><?php 
	 $juli = mysql_query("SELECT SUM(`valor`) as total FROM d89xz_diario where `hacienda`='$row_basc[hacienda]' AND      factura = '$row_basc[factura]' ",$conexion);
	 @$row07 = mysql_fetch_array($juli, MYSQL_ASSOC);
    @$Total= ($row07["total"]);
	echo  number_format(abs($Total));
	
	 ?></td>
    <td  onClick="CrearEnlace('factura_diario_h.php?id=<?php echo $row_basc['factura']; ?>&amp;hda=<?php echo  $row_basc['hacienda'] ?>');"><?php echo $row_basc['concep']; ?></td>
    <td onClick="CrearEnlace('factura_diario_h.php?id=<?php echo $row_basc['factura']; ?>&amp;hda=<?php echo  $row_basc['hacienda'] ?>');"><?php echo $row_basc['estado']; ?></td>
    <td colspan="3"  onClick="CrearEnlace('factura_diario_h.php?id=<?php echo $row_basc['factura']; ?>&amp;hda=<?php echo  $row_basc['hacienda'] ?>');"><?php echo $row_basc['hacienda']; ?></td>
    </tr>
   <?php 
    //linea para repetir el while mientras se cumpla la siguiente condicion
    }
    ?>  
    <tr class="row" >
      <td colspan="3" align="right"  >
      <td>      
     </td>
      <td align="right" ><?php
	  //echo $year_url.'-'.$month_url.'-'.$day_url.'-'.$tipo_url.'-'.$hac_url ;
	  //$juli = mysql_query("SELECT SUM(`valor`) as total FROM d89xz_diario where  YEAR(fecha) = '2014' AND                 MONTH(fecha) = '01' AND concep = 'Egreso'and estado!='Cancelada' and estado!='Pendiente'",$conexion);
	  if($hac_url =='Todo'){
		  //Solo Ingresos y Egresos
		  if($year_url=='' && $month_url=='' && $day_url=='' && $tipo_url=='Todo'){
			  $juli = mysql_query("SELECT SUM(`valor`) as total FROM d89xz_diario where estado!='Cancelada' and              estado!='Pendiente' and estado!='Anulada' and estado!='Base'",$conexion);
		  }
		  if($year_url=='' && $month_url=='' && $day_url=='' && $tipo_url=='Ingreso'){
   			 $juli = mysql_query("SELECT SUM(`valor`) as total FROM d89xz_diario where estado!='Cancelada' and              estado!='Pendiente' and estado!='Anulada' and estado!='Base' AND concep = 'Ingreso' ",$conexion);
		  }
		  if($year_url=='' && $month_url=='' && $day_url=='' && $tipo_url=='Egreso'){
   			 $juli = mysql_query("SELECT SUM(`valor`) as total FROM d89xz_diario where estado!='Cancelada' and              estado!='Pendiente' and estado!='Anulada' and estado!='Base' AND concep = 'Egreso' ",$conexion);
		  }
		   // Ingresos , Egresos y Años///////////////////////////////////////////////////
		  if($year_url!='' && $month_url=='' && $day_url=='' && $tipo_url=='Todo'){
			  $juli = mysql_query("SELECT SUM(`valor`) as total FROM d89xz_diario where YEAR(fecha) = '$year_url' AND                estado!='Cancelada' and   estado!='Pendiente' and estado!='Anulada' and estado!='Base'",$conexion);
		  }
		  if($year_url!='' && $month_url=='' && $day_url=='' && $tipo_url=='Ingreso'){
   			 $juli = mysql_query("SELECT SUM(`valor`) as total FROM d89xz_diario where YEAR(fecha) = '$year_url' AND              estado!='Cancelada' and estado!='Pendiente' and estado!='Anulada' and estado!='Base' AND concep = 'Ingreso' ",$conexion);
		  }
		  if($year_url!='' && $month_url=='' && $day_url=='' && $tipo_url=='Egreso'){
   			 $juli = mysql_query("SELECT SUM(`valor`) as total FROM d89xz_diario where YEAR(fecha) = '$year_url' AND               estado!='Cancelada' and estado!='Pendiente' and estado!='Anulada' and estado!='Base' AND concep = 'Egreso' ",$conexion);
		  }
		    // Ingresos , Egresos , Años y Mes///////////////////////////////////////////////////
		  if($year_url!='' && $month_url!='' && $day_url=='' && $tipo_url=='Todo'){
			 $juli = mysql_query("SELECT SUM(`valor`) as total FROM d89xz_diario where YEAR(fecha) = '$year_url' AND             MONTH(fecha)='$month_url' AND estado!='Cancelada' and estado!='Pendiente' and estado!='Anulada' and estado!='Base'",             $conexion);
		  }
		  if($year_url!='' && $month_url!='' && $day_url=='' && $tipo_url=='Ingreso'){
   			 $juli = mysql_query("SELECT SUM(`valor`) as total FROM d89xz_diario where YEAR(fecha) = '$year_url' AND             MONTH(fecha) = '$month_url' AND estado!='Cancelada' and estado!='Pendiente' and estado!='Anulada' and estado!='Base' AND             concep = 'Ingreso' ",$conexion);
		  }
		  if($year_url!='' && $month_url!='' && $day_url=='' && $tipo_url=='Egreso'){
   			 $juli = mysql_query("SELECT SUM(`valor`) as total FROM d89xz_diario where YEAR(fecha) = '$year_url' AND              MONTH(fecha) = '$month_url' AND estado!='Cancelada' and estado!='Pendiente' and estado!='Anulada' and estado!='Base' AND              concep = 'Egreso' ",$conexion);
		  }
		    // Ingresos , Egresos , Años , Mes Y Dia///////////////////////////////////////////////////
		  if($year_url!='' && $month_url!='' && $day_url!='' && $tipo_url=='Todo'){
			 $juli = mysql_query("SELECT SUM(`valor`) as total FROM d89xz_diario where YEAR(fecha) = '$year_url' AND             MONTH(fecha)='$month_url' AND DAY(fecha) = '$day_url' AND estado!='Cancelada' and estado!='Pendiente' and             estado!='Anulada' and estado!='Base'", $conexion);
		  }
		  if($year_url!='' && $month_url!='' && $day_url!='' && $tipo_url=='Ingreso'){
   			 $juli = mysql_query("SELECT SUM(`valor`) as total FROM d89xz_diario where YEAR(fecha) = '$year_url' AND             MONTH(fecha) = '$month_url' AND DAY(fecha) = '$day_url' AND estado!='Cancelada' and estado!='Pendiente'               estado!='Anulada' and estado!='Base' AND concep = 'Ingreso' ",$conexion);
		  }
		  if($year_url!='' && $month_url!='' && $day_url!='' && $tipo_url=='Egreso'){
   			 $juli = mysql_query("SELECT SUM(`valor`) as total FROM d89xz_diario where YEAR(fecha) = '$year_url' AND              MONTH(fecha) = '$month_url' AND DAY(fecha) = '$day_url' AND estado!='Cancelada' and estado!='Pendiente'               estado!='Anulada' and estado!='Base' AND concep = 'Egreso' ",$conexion);
		  }
	  }else{
		 //Solo Ingresos y Egresos
		  if($year_url=='' && $month_url=='' && $day_url=='' && $tipo_url=='Todo'){
			  $juli = mysql_query("SELECT SUM(`valor`) as total FROM d89xz_diario where estado!='Cancelada' and              `hacienda`='$hac_url' AND estado!='Pendiente' and estado!='Anulada' and estado!='Base'",$conexion);
		  }
		  if($year_url=='' && $month_url=='' && $day_url=='' && $tipo_url=='Ingreso'){
   			 $juli = mysql_query("SELECT SUM(`valor`) as total FROM d89xz_diario where estado!='Cancelada' and              `hacienda`='$hac_url' AND estado!='Pendiente' and estado!='Anulada' and estado!='Base' AND concep = 'Ingreso' ",$conexion);
		  }
		  if($year_url=='' && $month_url=='' && $day_url=='' && $tipo_url=='Egreso'){
   			 $juli = mysql_query("SELECT SUM(`valor`) as total FROM d89xz_diario where estado!='Cancelada' and             `hacienda`='$hac_url' AND  estado!='Pendiente' and estado!='Anulada' and estado!='Base' AND concep = 'Egreso' ",$conexion);
		  }
		   // Ingresos , Egresos y Años///////////////////////////////////////////////////
		  if($year_url!='' && $month_url=='' && $day_url=='' && $tipo_url=='Todo'){
			  $juli = mysql_query("SELECT SUM(`valor`) as total FROM d89xz_diario where YEAR(fecha) = '$year_url' AND              `hacienda`='$hac_url' AND estado!='Cancelada' and estado!='Pendiente' and estado!='Anulada' and estado!='Base'",$conexion);
		  }
		  if($year_url!='' && $month_url=='' && $day_url=='' && $tipo_url=='Ingreso'){
   			 $juli = mysql_query("SELECT SUM(`valor`) as total FROM d89xz_diario where YEAR(fecha) = '$year_url' AND              `hacienda`='$hac_url' AND estado!='Cancelada' and estado!='Pendiente' and estado!='Anulada' and estado!='Base' AND concep =              'Ingreso' ",$conexion);
		  }
		  if($year_url!='' && $month_url=='' && $day_url=='' && $tipo_url=='Egreso'){
   			 $juli = mysql_query("SELECT SUM(`valor`) as total FROM d89xz_diario where YEAR(fecha) = '$year_url' AND               `hacienda`='$hac_url' AND estado!='Cancelada' and estado!='Pendiente' and estado!='Anulada' and estado!='Base' AND concep                = 'Egreso' ",$conexion);
		  }
		    // Ingresos , Egresos , Años y Mes///////////////////////////////////////////////////
		  if($year_url!='' && $month_url!='' && $day_url=='' && $tipo_url=='Todo'){
			 $juli = mysql_query("SELECT SUM(`valor`) as total FROM d89xz_diario where YEAR(fecha) = '$year_url' AND             MONTH(fecha)='$month_url' AND `hacienda`='$hac_url' AND estado!='Cancelada' and estado!='Pendiente' and             estado!='Anulada' and estado!='Base'", $conexion);
		  }
		  if($year_url!='' && $month_url!='' && $day_url=='' && $tipo_url=='Ingreso'){
   			 $juli = mysql_query("SELECT SUM(`valor`) as total FROM d89xz_diario where YEAR(fecha) = '$year_url' AND             MONTH(fecha) = '$month_url' AND `hacienda`='$hac_url' AND estado!='Cancelada' and estado!='Pendiente' and             estado!='Anulada' and estado!='Base' AND concep = 'Ingreso' ",$conexion);
		  }
		  if($year_url!='' && $month_url!='' && $day_url=='' && $tipo_url=='Egreso'){
   			 $juli = mysql_query("SELECT SUM(`valor`) as total FROM d89xz_diario where YEAR(fecha) = '$year_url' AND              MONTH(fecha) = '$month_url' AND estado!='Cancelada' and estado!='Pendiente' and estado!='Anulada' and estado!='Base' AND              `hacienda`='$hac_url' AND concep = 'Egreso' ",$conexion);
		  }
		    // Ingresos , Egresos , Años , Mes Y Dia///////////////////////////////////////////////////
		  if($year_url!='' && $month_url!='' && $day_url!='' && $tipo_url=='Todo'){
			 $juli = mysql_query("SELECT SUM(`valor`) as total FROM d89xz_diario where YEAR(fecha) = '$year_url' AND             MONTH(fecha)='$month_url' AND DAY(fecha) = '$day_url' AND estado!='Cancelada' and estado!='Pendiente' and             `hacienda`='$hac_url' AND estado!='Anulada' and estado!='Base'", $conexion);
		  }
		  if($year_url!='' && $month_url!='' && $day_url!='' && $tipo_url=='Ingreso'){
   			 $juli = mysql_query("SELECT SUM(`valor`) as total FROM d89xz_diario where YEAR(fecha) = '$year_url' AND             MONTH(fecha) = '$month_url' AND DAY(fecha) = '$day_url' AND estado!='Cancelada' and estado!='Pendiente'             `hacienda`='$hac_url'  and estado!='Anulada' and estado!='Base' AND concep = 'Ingreso' ",$conexion);
		  }
		  if($year_url!='' && $month_url!='' && $day_url!='' && $tipo_url=='Egreso'){
   			 $juli = mysql_query("SELECT SUM(`valor`) as total FROM d89xz_diario where YEAR(fecha) = '$year_url' AND              MONTH(fecha) = '$month_url' AND DAY(fecha) = '$day_url' AND estado!='Cancelada' and estado!='Pendiente'               `hacienda`='$hac_url' AND estado!='Anulada' and estado!='Base' AND concep = 'Egreso' ",$conexion);
		  }  
	  }
    @$row07 = mysql_fetch_array($juli, MYSQL_ASSOC);
    @$Total= number_format ($row07["total"]);
    //echo $Total;
	?></td>
      <td  >&nbsp;</td>
      <td  >&nbsp;</td>
      <td colspan="3"  >&nbsp;</td>
      </tr>
   
</table>
<table width="98%" align="center">
  <tr>
    <td height="59" colspan="8" align="center" class="tittle">Resumen</td>
  </tr>
  <tr class="tittle">
    <td width="16%" rowspan="2" align="center">Forma De Pago</td>
    <td colspan="3" align="center">Ingresos</td>
    <td colspan="3" align="center">Egresos</td>
    <td align="center">&nbsp;</td>
  </tr>
  <tr class="tittle">
    <td width="13%" align="center">Ventas</td>
    <td width="12%" align="center">Recibo Caja</td>
    <td width="14%" align="center">Abonos</td>
    <td width="12%" align="center">Compras</td>
    <td width="16%" align="center"><!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.0 Transitional//EN">
      <!--  		@page { margin: 2cm }  		p { margin-bottom: 0.25cm; line-height: 120% }  	-->
      <p>Comprobante Egreso</p></td>
    <td width="9%" align="center">Abonos</td>
    <td width="8%" align="center">Base</td>
  </tr>
  <?php do { ?>
  <tr class="row">
    <td align="left"><?php echo $row_fpago['f_pago']; ?></td>
    <td align="right"><?php
/*		 if ($usuario2 == 'general'){
			if($hda !=''){ 
					$juli = mysql_query("SELECT SUM(`valor`) as total FROM d89xz_diario where `hacienda`='$hda' AND concep ='Ingreso'
					               and f_pago='$row_fpago[f_pago]' and YEAR(fecha) ='$anoss' AND MONTH(fecha) = '$mess' AND 
								   DAY(fecha) = '$dia' and estado !='Anulada'  and  estado !='Cancelada'  and devolucion !='3'  and  devolucion !='4' ", $conexion);
			}else{
					$juli = mysql_query("SELECT SUM(`valor`) as total FROM d89xz_diario where  concep ='Ingreso'
					               and f_pago='$row_fpago[f_pago]' and YEAR(fecha) ='$anoss' AND MONTH(fecha) = '$mess' AND 
								   DAY(fecha) = '$dia' and estado !='Anulada'  and  estado !='Cancelada'  and devolucion !='3'  and  devolucion !='4' ", $conexion);
			}
		
		 }else{
			 
			 $juli = mysql_query("SELECT SUM(`valor`) as total FROM d89xz_diario where `hacienda`='$usuario2' AND  concep ='Ingreso' and 
			                 YEAR(fecha) ='$anoss' AND MONTH(fecha) = '$mess' AND DAY(fecha) = '$dia' and f_pago='$row_fpago[f_pago]' and 
							 estado !='Anulada'  and  estado !='Cancelada'  and devolucion !='3'  and  devolucion !='4'  ",$conexion);
			 
		 }
		
	 @$row07 = mysql_fetch_array($juli, MYSQL_ASSOC);
    @$Total= ($row07["total"]);
	echo  number_format(abs($Total));
	*/	
			
	  if($hac_url =='Todo'){
		  //Solo Ingresos y Egresos
		  if($year_url=='' && $month_url=='' && $day_url=='' ){
			  $juli = mysql_query("SELECT SUM(`valor`) as total FROM d89xz_diario where estado !='Anulada'  and  estado !='Cancelada' and f_pago='$row_fpago[f_pago]' 
			  AND concep = 'Ingreso'   and devolucion !='3'  and  devolucion !='4'  ",$conexion);
		  }
		
		
		   // Ingresos , Egresos y Años///////////////////////////////////////////////////
		  if($year_url!='' && $month_url=='' && $day_url=='' ){
			  $juli = mysql_query("SELECT SUM(`valor`) as total FROM d89xz_diario where YEAR(fecha) = '$year_url' AND                
			  estado !='Anulada'  and  estado !='Cancelada'  and f_pago='$row_fpago[f_pago]' AND concep = 'Ingreso'   and devolucion !='3'  and  devolucion !='4'  ",$conexion);
		  }
		 
		 
		    // Ingresos , Egresos , Años y Mes///////////////////////////////////////////////////
		  if($year_url!='' && $month_url!='' && $day_url=='' ){
			 $juli = mysql_query("SELECT SUM(`valor`) as total FROM d89xz_diario where YEAR(fecha) = '$year_url' AND             MONTH(fecha)='$month_url' AND estado !='Anulada'  and  estado !='Cancelada' and f_pago='$row_fpago[f_pago]' AND concep = 'Ingreso'   and devolucion !='3'  and  devolucion !='4' ",             $conexion);
		  }
		 
		
		    // Ingresos , Egresos , Años , Mes Y Dia///////////////////////////////////////////////////
		  if($year_url!='' && $month_url!='' && $day_url!='' ){
			 $juli = mysql_query("SELECT SUM(`valor`) as total FROM d89xz_diario where YEAR(fecha) = '$year_url' AND             MONTH(fecha)='$month_url' AND DAY(fecha) = '$day_url' AND estado !='Anulada'  and  estado !='Cancelada'  and f_pago='$row_fpago[f_pago]' AND concep = 'Ingreso'    and devolucion !='3'  and  devolucion !='4' ", $conexion);
		  }
		
		 
	  }else{
		 //Solo Ingresos y Egresos
		  if($year_url=='' && $month_url=='' && $day_url==''){
			  $juli = mysql_query("SELECT SUM(`valor`) as total FROM d89xz_diario where          
			      `hacienda`='$hac_url' AND estado !='Anulada'  and  estado !='Cancelada'  and f_pago='$row_fpago[f_pago]' AND concep = 'Ingreso'    and devolucion !='3'  and  devolucion !='4' ",$conexion);
		  }
		
		  		   // Ingresos , Egresos y Años///////////////////////////////////////////////////
		  if($year_url!='' && $month_url=='' && $day_url==''){
			  $juli = mysql_query("SELECT SUM(`valor`) as total FROM d89xz_diario where YEAR(fecha) = '$year_url' AND              `hacienda`='$hac_url' AND estado !='Anulada'  and  estado !='Cancelada' and f_pago='$row_fpago[f_pago]' AND concep = 'Ingreso'   and devolucion !='3'  and  devolucion !='4' ",$conexion);
		  }
		
		 
		    // Ingresos , Egresos , Años y Mes///////////////////////////////////////////////////
		  if($year_url!='' && $month_url!='' && $day_url=='' ){
			 $juli = mysql_query("SELECT SUM(`valor`) as total FROM d89xz_diario where YEAR(fecha) = '$year_url' AND  
			            MONTH(fecha)='$month_url' AND `hacienda`='$hac_url' AND estado !='Anulada'  and  estado !='Cancelada' 
			  and f_pago='$row_fpago[f_pago]' AND concep = 'Ingreso'  and devolucion !='3'  and  devolucion !='4' ", $conexion);
		  }
		
		
		    // Ingresos , Egresos , Años , Mes Y Dia///////////////////////////////////////////////////
		  if($year_url!='' && $month_url!='' && $day_url!='' ){
			 $juli = mysql_query("SELECT SUM(`valor`) as total FROM d89xz_diario where YEAR(fecha) = '$year_url' AND  
			            MONTH(fecha)='$month_url' AND DAY(fecha) = '$day_url'  and            
						 `hacienda`='$hac_url' AND estado !='Anulada'  and  estado !='Cancelada' and f_pago='$row_fpago[f_pago]' AND concep = 'Ingreso'  and devolucion !='3'  and  devolucion !='4' ", $conexion);
		  }
		
		   
	  }
    @$row07in = mysql_fetch_array($juli, MYSQL_ASSOC);
    @$Totalin= number_format ($row07in["total"]);
    echo $Totalin;
//	----------------------------------------------- Fin Ingresos---------------------------------------------------------------------------
		
		
		
		
		
        ?></td>
    <td align="right"><?php
	/*	 if ($usuario2 == 'general'){
			if($hda !=''){ 
					$juli = mysql_query("SELECT SUM(`valor`) as total FROM d89xz_diario where `hacienda`='$hda' AND concep ='Ingreso'
					               and f_pago='$row_fpago[f_pago]' and YEAR(fecha) ='$anoss' AND MONTH(fecha) = '$mess' AND 
								   DAY(fecha) = '$dia' and estado !='Anulada'  and  estado !='Cancelada'  and   devolucion ='4' ", $conexion);
			}else{
					$juli = mysql_query("SELECT SUM(`valor`) as total FROM d89xz_diario where  concep ='Ingreso'
					               and f_pago='$row_fpago[f_pago]' and YEAR(fecha) ='$anoss' AND MONTH(fecha) = '$mess' AND 
								   DAY(fecha) = '$dia' and estado !='Anulada'  and  estado !='Cancelada'  and  devolucion ='4' ", $conexion);
			}
		
		 }else{
			 
			 $juli = mysql_query("SELECT SUM(`valor`) as total FROM d89xz_diario where `hacienda`='$usuario2' AND  concep ='Ingreso' and 
			                 YEAR(fecha) ='$anoss' AND MONTH(fecha) = '$mess' AND DAY(fecha) = '$dia' and f_pago='$row_fpago[f_pago]' and 
							 estado !='Anulada'  and  estado !='Cancelada'  and   devolucion ='4'  ",$conexion);
			 
		 }
		
	 @$row07 = mysql_fetch_array($juli, MYSQL_ASSOC);
    @$Total= ($row07["total"]);
	echo  number_format(abs($Total));*/
	////-----------------------------------------------------------------------recibo Caja ---------------------------------
		  if($hac_url =='Todo'){
		  //Solo Ingresos y Egresos
		  if($year_url=='' && $month_url=='' && $day_url=='' ){
			  $juli = mysql_query("SELECT SUM(`valor`) as total FROM d89xz_diario where estado !='Anulada'  and  estado !='Cancelada' and f_pago='$row_fpago[f_pago]' 
			  AND concep = 'Ingreso'   and devolucion ='4'  ",$conexion);
		  }
		
		
		   // Ingresos , Egresos y Años///////////////////////////////////////////////////
		  if($year_url!='' && $month_url=='' && $day_url=='' ){
			  $juli = mysql_query("SELECT SUM(`valor`) as total FROM d89xz_diario where YEAR(fecha) = '$year_url' AND                
			  estado !='Anulada'  and  estado !='Cancelada'  and f_pago='$row_fpago[f_pago]' AND concep = 'Ingreso'   and devolucion ='4'  ",$conexion);
		  }
		 
		 
		    // Ingresos , Egresos , Años y Mes///////////////////////////////////////////////////
		  if($year_url!='' && $month_url!='' && $day_url=='' ){
			 $juli = mysql_query("SELECT SUM(`valor`) as total FROM d89xz_diario where YEAR(fecha) = '$year_url' AND             MONTH(fecha)='$month_url' AND estado !='Anulada'  and  estado !='Cancelada' and f_pago='$row_fpago[f_pago]' AND concep = 'Ingreso'   and devolucion ='4' ",             $conexion);
		  }
		 
		
		    // Ingresos , Egresos , Años , Mes Y Dia///////////////////////////////////////////////////
		  if($year_url!='' && $month_url!='' && $day_url!='' ){
			 $juli = mysql_query("SELECT SUM(`valor`) as total FROM d89xz_diario where YEAR(fecha) = '$year_url' AND             MONTH(fecha)='$month_url' AND DAY(fecha) = '$day_url' AND estado !='Anulada'  and  estado !='Cancelada'  and f_pago='$row_fpago[f_pago]' AND concep = 'Ingreso'    and devolucion ='4' ", $conexion);
		  }
		
		 
	  }else{
		 //Solo Ingresos y Egresos
		  if($year_url=='' && $month_url=='' && $day_url==''){
			  $juli = mysql_query("SELECT SUM(`valor`) as total FROM d89xz_diario where          
			      `hacienda`='$hac_url' AND estado !='Anulada'  and  estado !='Cancelada'  and f_pago='$row_fpago[f_pago]' AND concep = 'Ingreso'    and devolucion ='4' ",$conexion);
		  }
		
		  		   // Ingresos , Egresos y Años///////////////////////////////////////////////////
		  if($year_url!='' && $month_url=='' && $day_url==''){
			  $juli = mysql_query("SELECT SUM(`valor`) as total FROM d89xz_diario where YEAR(fecha) = '$year_url' AND              `hacienda`='$hac_url' AND estado !='Anulada'  and  estado !='Cancelada' and f_pago='$row_fpago[f_pago]' AND concep = 'Ingreso'   and devolucion ='4' ",$conexion);
		  }
		
		 
		    // Ingresos , Egresos , Años y Mes///////////////////////////////////////////////////
		  if($year_url!='' && $month_url!='' && $day_url=='' ){
			 $juli = mysql_query("SELECT SUM(`valor`) as total FROM d89xz_diario where YEAR(fecha) = '$year_url' AND  
			            MONTH(fecha)='$month_url' AND `hacienda`='$hac_url' AND estado !='Anulada'  and  estado !='Cancelada' 
			  and f_pago='$row_fpago[f_pago]' AND concep = 'Ingreso'  and devolucion ='4' ", $conexion);
		  }
		
		
		    // Ingresos , Egresos , Años , Mes Y Dia///////////////////////////////////////////////////
		  if($year_url!='' && $month_url!='' && $day_url!='' ){
			 $juli = mysql_query("SELECT SUM(`valor`) as total FROM d89xz_diario where YEAR(fecha) = '$year_url' AND  
			            MONTH(fecha)='$month_url' AND DAY(fecha) = '$day_url'  and            
						 `hacienda`='$hac_url' AND estado !='Anulada'  and  estado !='Cancelada' and f_pago='$row_fpago[f_pago]' AND concep = 'Ingreso'  and devolucion ='4' ", $conexion);
		  }
		
		   
	  }
    @$row07in = mysql_fetch_array($juli, MYSQL_ASSOC);
    @$TotalinC= number_format ($row07in["total"]);
    echo $TotalinC;
//	----------------------------------------------- Fin Recibo Cajas---------------------------------------------------------------------------	
		
        ?></td>
    <td align="right"><?php
/*		 if ($usuario2 == 'general'){
			if($hda !=''){ 
					$juli = mysql_query("SELECT SUM(`valor`) as total FROM d89xz_diario where `hacienda`='$hda' AND concep ='Ingreso'
					               and f_pago='$row_fpago[f_pago]' and YEAR(fecha) ='$anoss' AND MONTH(fecha) = '$mess' AND 
								   DAY(fecha) = '$dia' and estado !='Anulada'  and  estado !='Cancelada'  and devolucion='3'  ", $conexion);
			}else{
					$juli = mysql_query("SELECT SUM(`valor`) as total FROM d89xz_diario where  concep ='Ingreso'
					               and f_pago='$row_fpago[f_pago]' and YEAR(fecha) ='$anoss' AND MONTH(fecha) = '$mess' AND 
								   DAY(fecha) = '$dia' and estado !='Anulada'  and  estado !='Cancelada'  and devolucion='3'  ", $conexion);
			}
		
		 }else{
			 
			 $juli = mysql_query("SELECT SUM(`valor`) as total FROM d89xz_diario where `hacienda`='$usuario2' AND  concep ='Ingreso' and 
			                 YEAR(fecha) ='$anoss' AND MONTH(fecha) = '$mess' AND DAY(fecha) = '$dia' and f_pago='$row_fpago[f_pago]' and 
							 estado !='Anulada'  and  estado !='Cancelada'  and devolucion='3'  ",$conexion);
			 
		 }
		
	 @$row07 = mysql_fetch_array($juli, MYSQL_ASSOC);
    @$Total= ($row07["total"]);
	echo  number_format(abs($Total));*/
	////-----------------------------------------------------------------------Abono Ingresos ---------------------------------
		  if($hac_url =='Todo'){
		  //Solo Ingresos y Egresos
		  if($year_url=='' && $month_url=='' && $day_url=='' ){
			  $juli = mysql_query("SELECT SUM(`valor`) as total FROM d89xz_diario where estado !='Anulada'  and  estado !='Cancelada' and f_pago='$row_fpago[f_pago]' 
			  AND concep = 'Ingreso'   and devolucion='3'   ",$conexion);
		  }
		
		
		   // Ingresos , Egresos y Años///////////////////////////////////////////////////
		  if($year_url!='' && $month_url=='' && $day_url=='' ){
			  $juli = mysql_query("SELECT SUM(`valor`) as total FROM d89xz_diario where YEAR(fecha) = '$year_url' AND                
			  estado !='Anulada'  and  estado !='Cancelada'  and f_pago='$row_fpago[f_pago]' AND concep = 'Ingreso'   and devolucion='3'   ",$conexion);
		  }
		 
		 
		    // Ingresos , Egresos , Años y Mes///////////////////////////////////////////////////
		  if($year_url!='' && $month_url!='' && $day_url=='' ){
			 $juli = mysql_query("SELECT SUM(`valor`) as total FROM d89xz_diario where YEAR(fecha) = '$year_url' AND             MONTH(fecha)='$month_url' AND estado !='Anulada'  and  estado !='Cancelada' and f_pago='$row_fpago[f_pago]' AND concep = 'Ingreso'   and devolucion='3'  ",             $conexion);
		  }
		 
		
		    // Ingresos , Egresos , Años , Mes Y Dia///////////////////////////////////////////////////
		  if($year_url!='' && $month_url!='' && $day_url!='' ){
			 $juli = mysql_query("SELECT SUM(`valor`) as total FROM d89xz_diario where YEAR(fecha) = '$year_url' AND             MONTH(fecha)='$month_url' AND DAY(fecha) = '$day_url' AND estado !='Anulada'  and  estado !='Cancelada'  and f_pago='$row_fpago[f_pago]' AND concep = 'Ingreso'    and devolucion='3'  ", $conexion);
		  }
		
		 
	  }else{
		 //Solo Ingresos y Egresos
		  if($year_url=='' && $month_url=='' && $day_url==''){
			  $juli = mysql_query("SELECT SUM(`valor`) as total FROM d89xz_diario where          
			      `hacienda`='$hac_url' AND estado !='Anulada'  and  estado !='Cancelada'  and f_pago='$row_fpago[f_pago]' AND concep = 'Ingreso'    and devolucion='3'  ",$conexion);
		  }
		
		  		   // Ingresos , Egresos y Años///////////////////////////////////////////////////
		  if($year_url!='' && $month_url=='' && $day_url==''){
			  $juli = mysql_query("SELECT SUM(`valor`) as total FROM d89xz_diario where YEAR(fecha) = '$year_url' AND              `hacienda`='$hac_url' AND estado !='Anulada'  and  estado !='Cancelada' and f_pago='$row_fpago[f_pago]' AND concep = 'Ingreso'   and devolucion='3'  ",$conexion);
		  }
		
		 
		    // Ingresos , Egresos , Años y Mes///////////////////////////////////////////////////
		  if($year_url!='' && $month_url!='' && $day_url=='' ){
			 $juli = mysql_query("SELECT SUM(`valor`) as total FROM d89xz_diario where YEAR(fecha) = '$year_url' AND  
			            MONTH(fecha)='$month_url' AND `hacienda`='$hac_url' AND estado !='Anulada'  and  estado !='Cancelada' 
			  and f_pago='$row_fpago[f_pago]' AND concep = 'Ingreso'  and devolucion='3'  ", $conexion);
		  }
		
		
		    // Ingresos , Egresos , Años , Mes Y Dia///////////////////////////////////////////////////
		  if($year_url!='' && $month_url!='' && $day_url!='' ){
			 $juli = mysql_query("SELECT SUM(`valor`) as total FROM d89xz_diario where YEAR(fecha) = '$year_url' AND  
			            MONTH(fecha)='$month_url' AND DAY(fecha) = '$day_url'  and            
						 `hacienda`='$hac_url' AND estado !='Anulada'  and  estado !='Cancelada' and f_pago='$row_fpago[f_pago]' AND concep = 'Ingreso'  and devolucion='3'  ", $conexion);
		  }
		
		   
	  }
    @$row07in = mysql_fetch_array($juli, MYSQL_ASSOC);
    @$TotalinC= number_format ($row07in["total"]);
    echo $TotalinC;
//	----------------------------------------------- Fin  Abonos Ingreso---------------------------------------------------------------------------	
		
        ?></td>
    <td align="right"><?php

			
	  if($hac_url =='Todo'){
		  //Solo Ingresos y Egresos
		  if($year_url=='' && $month_url=='' && $day_url=='' ){
			  $juli = mysql_query("SELECT SUM(`valor`) as total FROM d89xz_diario where estado !='Anulada'  and  estado !='Cancelada' and f_pago='$row_fpago[f_pago]' 
			  AND concep = 'Egreso'   and devolucion !='3'  and  devolucion !='4'  ",$conexion);
		  }
		
		
		   // Egresos , Egresos y Años///////////////////////////////////////////////////
		  if($year_url!='' && $month_url=='' && $day_url=='' ){
			  $juli = mysql_query("SELECT SUM(`valor`) as total FROM d89xz_diario where YEAR(fecha) = '$year_url' AND                
			  estado !='Anulada'  and  estado !='Cancelada'  and f_pago='$row_fpago[f_pago]' AND concep = 'Egreso'   and devolucion !='3'  and  devolucion !='4'  ",$conexion);
		  }
		 
		 
		    // Ingresos , Egresos , Años y Mes///////////////////////////////////////////////////
		  if($year_url!='' && $month_url!='' && $day_url=='' ){
			 $juli = mysql_query("SELECT SUM(`valor`) as total FROM d89xz_diario where YEAR(fecha) = '$year_url' AND             MONTH(fecha)='$month_url' AND estado !='Anulada'  and  estado !='Cancelada' and f_pago='$row_fpago[f_pago]' AND concep = 'Egreso'   and devolucion !='3'  and  devolucion !='4' ",             $conexion);
		  }
		 
		
		    // Egresos , Egresos , Años , Mes Y Dia///////////////////////////////////////////////////
		  if($year_url!='' && $month_url!='' && $day_url!='' ){
			 $juli = mysql_query("SELECT SUM(`valor`) as total FROM d89xz_diario where YEAR(fecha) = '$year_url' AND             MONTH(fecha)='$month_url' AND DAY(fecha) = '$day_url' AND estado !='Anulada'  and  estado !='Cancelada'  and f_pago='$row_fpago[f_pago]' AND concep = 'Egreso'    and devolucion !='3'  and  devolucion !='4' ", $conexion);
		  }
		
		 
	  }else{
		 //Solo Egresos y Egresos
		  if($year_url=='' && $month_url=='' && $day_url==''){
			  $juli = mysql_query("SELECT SUM(`valor`) as total FROM d89xz_diario where          
			      `hacienda`='$hac_url' AND estado !='Anulada'  and  estado !='Cancelada'  and f_pago='$row_fpago[f_pago]' AND concep = 'Egreso'    and devolucion !='3'  and  devolucion !='4' ",$conexion);
		  }
		
		  		   // Egresos , Egresos y Años///////////////////////////////////////////////////
		  if($year_url!='' && $month_url=='' && $day_url==''){
			  $juli = mysql_query("SELECT SUM(`valor`) as total FROM d89xz_diario where YEAR(fecha) = '$year_url' AND              `hacienda`='$hac_url' AND estado !='Anulada'  and  estado !='Cancelada' and f_pago='$row_fpago[f_pago]' AND concep = 'Egreso'   and devolucion !='3'  and  devolucion !='4' ",$conexion);
		  }
		
		 
		    // Egresos , Egresos , Años y Mes///////////////////////////////////////////////////
		  if($year_url!='' && $month_url!='' && $day_url=='' ){
			 $juli = mysql_query("SELECT SUM(`valor`) as total FROM d89xz_diario where YEAR(fecha) = '$year_url' AND  
			            MONTH(fecha)='$month_url' AND `hacienda`='$hac_url' AND estado !='Anulada'  and  estado !='Cancelada' 
			  and f_pago='$row_fpago[f_pago]' AND concep = 'Egreso'  and devolucion !='3'  and  devolucion !='4' ", $conexion);
		  }
		
		
		    // Egresos , Egresos , Años , Mes Y Dia///////////////////////////////////////////////////
		  if($year_url!='' && $month_url!='' && $day_url!='' ){
			 $juli = mysql_query("SELECT SUM(`valor`) as total FROM d89xz_diario where YEAR(fecha) = '$year_url' AND  
			            MONTH(fecha)='$month_url' AND DAY(fecha) = '$day_url'  and            
						 `hacienda`='$hac_url' AND estado !='Anulada'  and  estado !='Cancelada' and f_pago='$row_fpago[f_pago]' AND concep = 'Egreso'  and devolucion !='3'  and  devolucion !='4' ", $conexion);
		  }
		
		   
	  }
    @$row07in = mysql_fetch_array($juli, MYSQL_ASSOC);
    @$TotalEn= number_format (abs($row07in["total"]));
    echo $TotalEn;
//	----------------------------------------------- Fin Egresos---------------------------------------------------------------------------
		
		
		
		
		
        ?></td>
    <td align="right"><?php
	/*	 if ($usuario2 == 'general'){
			if($hda !=''){ 
					$juli = mysql_query("SELECT SUM(`valor`) as total FROM d89xz_diario where `hacienda`='$hda' AND concep ='Ingreso'
					               and f_pago='$row_fpago[f_pago]' and YEAR(fecha) ='$anoss' AND MONTH(fecha) = '$mess' AND 
								   DAY(fecha) = '$dia' and estado !='Anulada'  and  estado !='Cancelada'  and   devolucion ='4' ", $conexion);
			}else{
					$juli = mysql_query("SELECT SUM(`valor`) as total FROM d89xz_diario where  concep ='Ingreso'
					               and f_pago='$row_fpago[f_pago]' and YEAR(fecha) ='$anoss' AND MONTH(fecha) = '$mess' AND 
								   DAY(fecha) = '$dia' and estado !='Anulada'  and  estado !='Cancelada'  and  devolucion ='4' ", $conexion);
			}
		
		 }else{
			 
			 $juli = mysql_query("SELECT SUM(`valor`) as total FROM d89xz_diario where `hacienda`='$usuario2' AND  concep ='Ingreso' and 
			                 YEAR(fecha) ='$anoss' AND MONTH(fecha) = '$mess' AND DAY(fecha) = '$dia' and f_pago='$row_fpago[f_pago]' and 
							 estado !='Anulada'  and  estado !='Cancelada'  and   devolucion ='4'  ",$conexion);
			 
		 }
		
	 @$row07 = mysql_fetch_array($juli, MYSQL_ASSOC);
    @$Total= ($row07["total"]);
	echo  number_format(abs($Total));*/
	////-----------------------------------------------------------------------recibo Caja ---------------------------------
		  if($hac_url =='Todo'){
		  //Solo Ingresos y Egresos
		  if($year_url=='' && $month_url=='' && $day_url=='' ){
			  $juli = mysql_query("SELECT SUM(`valor`) as total FROM d89xz_diario where estado !='Anulada'  and  estado !='Cancelada' and f_pago='$row_fpago[f_pago]' 
			  AND concep = 'Egreso'   and devolucion ='4'  ",$conexion);
		  }
		
		
		   // Egresos , Egresos y Años///////////////////////////////////////////////////
		  if($year_url!='' && $month_url=='' && $day_url=='' ){
			  $juli = mysql_query("SELECT SUM(`valor`) as total FROM d89xz_diario where YEAR(fecha) = '$year_url' AND                
			  estado !='Anulada'  and  estado !='Cancelada'  and f_pago='$row_fpago[f_pago]' AND concep = 'Egreso'   and devolucion ='4'  ",$conexion);
		  }
		 
		 
		    // Egresos , Egresos , Años y Mes///////////////////////////////////////////////////
		  if($year_url!='' && $month_url!='' && $day_url=='' ){
			 $juli = mysql_query("SELECT SUM(`valor`) as total FROM d89xz_diario where YEAR(fecha) = '$year_url' AND             MONTH(fecha)='$month_url' AND estado !='Anulada'  and  estado !='Cancelada' and f_pago='$row_fpago[f_pago]' AND concep = 'Egreso'   and devolucion ='4' ",             $conexion);
		  }
		 
		
		    // Egresos , Egresos , Años , Mes Y Dia///////////////////////////////////////////////////
		  if($year_url!='' && $month_url!='' && $day_url!='' ){
			 $juli = mysql_query("SELECT SUM(`valor`) as total FROM d89xz_diario where YEAR(fecha) = '$year_url' AND             MONTH(fecha)='$month_url' AND DAY(fecha) = '$day_url' AND estado !='Anulada'  and  estado !='Cancelada'  and f_pago='$row_fpago[f_pago]' AND concep = 'Egreso'    and devolucion ='4' ", $conexion);
		  }
		
		 
	  }else{
		 //Solo Egresos y Egresos
		  if($year_url=='' && $month_url=='' && $day_url==''){
			  $juli = mysql_query("SELECT SUM(`valor`) as total FROM d89xz_diario where          
			      `hacienda`='$hac_url' AND estado !='Anulada'  and  estado !='Cancelada'  and f_pago='$row_fpago[f_pago]' AND concep = 'Egreso'    and devolucion ='4' ",$conexion);
		  }
		
		  		   // Egresos , Egresos y Años///////////////////////////////////////////////////
		  if($year_url!='' && $month_url=='' && $day_url==''){
			  $juli = mysql_query("SELECT SUM(`valor`) as total FROM d89xz_diario where YEAR(fecha) = '$year_url' AND              `hacienda`='$hac_url' AND estado !='Anulada'  and  estado !='Cancelada' and f_pago='$row_fpago[f_pago]' AND concep = 'Egreso'   and devolucion ='4' ",$conexion);
		  }
		
		 
		    // Egresos , Egresos , Años y Mes///////////////////////////////////////////////////
		  if($year_url!='' && $month_url!='' && $day_url=='' ){
			 $juli = mysql_query("SELECT SUM(`valor`) as total FROM d89xz_diario where YEAR(fecha) = '$year_url' AND  
			            MONTH(fecha)='$month_url' AND `hacienda`='$hac_url' AND estado !='Anulada'  and  estado !='Cancelada' 
			  and f_pago='$row_fpago[f_pago]' AND concep = 'Egreso'  and devolucion ='4' ", $conexion);
		  }
		
		
		    // Egresos , Egresos , Años , Mes Y Dia///////////////////////////////////////////////////
		  if($year_url!='' && $month_url!='' && $day_url!='' ){
			 $juli = mysql_query("SELECT SUM(`valor`) as total FROM d89xz_diario where YEAR(fecha) = '$year_url' AND  
			            MONTH(fecha)='$month_url' AND DAY(fecha) = '$day_url'  and            
						 `hacienda`='$hac_url' AND estado !='Anulada'  and  estado !='Cancelada' and f_pago='$row_fpago[f_pago]' AND concep = 'Egreso'  and devolucion ='4' ", $conexion);
		  }
		
		   
	  }
    @$row07in = mysql_fetch_array($juli, MYSQL_ASSOC);
    @$TotalEnC= number_format (abs($row07in["total"]));
    echo $TotalEnC;
//	----------------------------------------------- Fin Recibo Cajas---------------------------------------------------------------------------	
		
        ?></td>
    <td align="right"><?php

	////-----------------------------------------------------------------------Abono EGRESOS ---------------------------------
		  if($hac_url =='Todo'){
		  //Solo Ingresos y Egresos
		  if($year_url=='' && $month_url=='' && $day_url=='' ){
			  $juli = mysql_query("SELECT SUM(`valor`) as total FROM d89xz_diario where estado !='Anulada'  and  estado !='Cancelada' and f_pago='$row_fpago[f_pago]' 
			  AND concep = 'Egreso'   and devolucion='3'   ",$conexion);
		  }
		
		
		   // Egresos , Egresos y Años///////////////////////////////////////////////////
		  if($year_url!='' && $month_url=='' && $day_url=='' ){
			  $juli = mysql_query("SELECT SUM(`valor`) as total FROM d89xz_diario where YEAR(fecha) = '$year_url' AND                
			  estado !='Anulada'  and  estado !='Cancelada'  and f_pago='$row_fpago[f_pago]' AND concep = 'Egreso'   and devolucion='3'   ",$conexion);
		  }
		 
		 
		    // Egresos , Egresos , Años y Mes///////////////////////////////////////////////////
		  if($year_url!='' && $month_url!='' && $day_url=='' ){
			 $juli = mysql_query("SELECT SUM(`valor`) as total FROM d89xz_diario where YEAR(fecha) = '$year_url' AND             MONTH(fecha)='$month_url' AND estado !='Anulada'  and  estado !='Cancelada' and f_pago='$row_fpago[f_pago]' AND concep = 'Egreso'   and devolucion='3'  ",             $conexion);
		  }
		 
		
		    // Egresos , Egresos , Años , Mes Y Dia///////////////////////////////////////////////////
		  if($year_url!='' && $month_url!='' && $day_url!='' ){
			 $juli = mysql_query("SELECT SUM(`valor`) as total FROM d89xz_diario where YEAR(fecha) = '$year_url' AND             MONTH(fecha)='$month_url' AND DAY(fecha) = '$day_url' AND estado !='Anulada'  and  estado !='Cancelada'  and f_pago='$row_fpago[f_pago]' AND concep = 'Egreso'    and devolucion='3'  ", $conexion);
		  }
		
		 
	  }else{
		 //Solo Egresos y Egresos
		  if($year_url=='' && $month_url=='' && $day_url==''){
			  $juli = mysql_query("SELECT SUM(`valor`) as total FROM d89xz_diario where          
			      `hacienda`='$hac_url' AND estado !='Anulada'  and  estado !='Cancelada'  and f_pago='$row_fpago[f_pago]' AND concep = 'Egreso'    and devolucion='3'  ",$conexion);
		  }
		
		  		   // Egresos , Egresos y Años///////////////////////////////////////////////////
		  if($year_url!='' && $month_url=='' && $day_url==''){
			  $juli = mysql_query("SELECT SUM(`valor`) as total FROM d89xz_diario where YEAR(fecha) = '$year_url' AND              `hacienda`='$hac_url' AND estado !='Anulada'  and  estado !='Cancelada' and f_pago='$row_fpago[f_pago]' AND concep = 'Egreso'   and devolucion='3'  ",$conexion);
		  }
		
		 
		    // Egresos , Egresos , Años y Mes///////////////////////////////////////////////////
		  if($year_url!='' && $month_url!='' && $day_url=='' ){
			 $juli = mysql_query("SELECT SUM(`valor`) as total FROM d89xz_diario where YEAR(fecha) = '$year_url' AND  
			            MONTH(fecha)='$month_url' AND `hacienda`='$hac_url' AND estado !='Anulada'  and  estado !='Cancelada' 
			  and f_pago='$row_fpago[f_pago]' AND concep = 'Egreso'  and devolucion='3'  ", $conexion);
		  }
		
		
		    // Egresos , Egresos , Años , Mes Y Dia///////////////////////////////////////////////////
		  if($year_url!='' && $month_url!='' && $day_url!='' ){
			 $juli = mysql_query("SELECT SUM(`valor`) as total FROM d89xz_diario where YEAR(fecha) = '$year_url' AND  
			            MONTH(fecha)='$month_url' AND DAY(fecha) = '$day_url'  and            
						 `hacienda`='$hac_url' AND estado !='Anulada'  and  estado !='Cancelada' and f_pago='$row_fpago[f_pago]' AND concep = 'Egreso'  and devolucion='3'  ", $conexion);
		  }
		
		   
	  }
    @$row07in = mysql_fetch_array($juli, MYSQL_ASSOC);
    @$TotalEGC= number_format (abs($row07in["total"]));
    echo $TotalEGC;
//	----------------------------------------------- Fin  Abonos ---------------------------
//-----------------------------------------Bse-----------------------------------	
		
        ?></td>
    <td colspan="3" align="right"><?php
	
		  if($hac_url =='Todo'){
		  //Solo Ingresos y Egresos
		  if($year_url=='' && $month_url=='' && $day_url=='' ){
			  $julib = mysql_query("SELECT SUM(`valor`) as total FROM d89xz_diario where estado !='Anulada'  and  estado !='Cancelada' and f_pago='$row_fpago[f_pago]' 
			  AND concep = 'Base'    ",$conexion);
		  }
		   // Egresos , Egresos y Años///////////////////////////////////////////////////
		  if($year_url!='' && $month_url=='' && $day_url=='' ){
			  $julib = mysql_query("SELECT SUM(`valor`) as total FROM d89xz_diario where YEAR(fecha) = '$year_url' AND                
			  estado !='Anulada'  and  estado !='Cancelada'  and f_pago='$row_fpago[f_pago]' AND concep = 'Base'    ",$conexion);
		  }
		    // Egresos , Egresos , Años y Mes///////////////////////////////////////////////////
		  if($year_url!='' && $month_url!='' && $day_url=='' ){
			 $julib = mysql_query("SELECT SUM(`valor`) as total FROM d89xz_diario where YEAR(fecha) = '$year_url' AND             MONTH(fecha)='$month_url' AND estado !='Anulada'  and  estado !='Cancelada' and f_pago='$row_fpago[f_pago]' AND concep = 'Base'  ",             $conexion);
		  }
		    // Egresos , Egresos , Años , Mes Y Dia///////////////////////////////////////////////////
		  if($year_url!='' && $month_url!='' && $day_url!='' ){
			 $julib = mysql_query("SELECT SUM(`valor`) as total FROM d89xz_diario where YEAR(fecha) = '$year_url' AND             MONTH(fecha)='$month_url' AND DAY(fecha) = '$day_url' AND estado !='Anulada'  and  estado !='Cancelada'  and f_pago='$row_fpago[f_pago]' AND concep = 'Base'  ", $conexion);
		  }
	  }else{
		 //Solo Egresos y Egresos
		  if($year_url=='' && $month_url=='' && $day_url==''){
			  $julib = mysql_query("SELECT SUM(`valor`) as total FROM d89xz_diario where          
			      `hacienda`='$hac_url' AND estado !='Anulada'  and  estado !='Cancelada'  and f_pago='$row_fpago[f_pago]' AND concep = 'Base'   ",$conexion);
		  }
		  		   // Egresos , Egresos y Años///////////////////////////////////////////////////
		  if($year_url!='' && $month_url=='' && $day_url==''){
			  $julib = mysql_query("SELECT SUM(`valor`) as total FROM d89xz_diario where YEAR(fecha) = '$year_url' AND              `hacienda`='$hac_url' AND estado !='Anulada'  and  estado !='Cancelada' and f_pago='$row_fpago[f_pago]' AND concep = 'Base'   ",$conexion);
		  }
		  // Egresos , Egresos , Años y Mes///////////////////////////////////////////////////
		  if($year_url!='' && $month_url!='' && $day_url=='' ){
			 $julib = mysql_query("SELECT SUM(`valor`) as total FROM d89xz_diario where YEAR(fecha) = '$year_url' AND  
			            MONTH(fecha)='$month_url' AND `hacienda`='$hac_url' AND estado !='Anulada'  and  estado !='Cancelada' 
			  and f_pago='$row_fpago[f_pago]' AND concep = 'Base'   ", $conexion);
		  }		
		    // Egresos , Egresos , Años , Mes Y Dia///////////////////////////////////////////////////
		  if($year_url!='' && $month_url!='' && $day_url!='' ){
			 $julib = mysql_query("SELECT SUM(`valor`) as total FROM d89xz_diario where YEAR(fecha) = '$year_url' AND  
			            MONTH(fecha)='$month_url' AND DAY(fecha) = '$day_url'  and            
						 `hacienda`='$hac_url' AND estado !='Anulada'  and  estado !='Cancelada' and f_pago='$row_fpago[f_pago]' AND concep = 'Base'   ", $conexion);
		  }
		
		   
	  }
    @$row07inb = mysql_fetch_array($julib, MYSQL_ASSOC);
    @$TotalEnCb= number_format (abs($row07inb["total"]));
    echo $TotalEnCb;
//	----------------------------------------------- FinBase------------------------------------------------
 //-------------------------------------------Cajas-----------------------------------------------------------	
		
        ?></td>
    </tr>
  <?php } while ($row_fpago = mysql_fetch_assoc($fpago)); ?>
  <tr class="bold">
    <td align="right">&nbsp;</td>
    <td align="right">&nbsp;</td>
    <td align="right">&nbsp;</td>
    <td align="right">&nbsp;</td>
    <td align="right">&nbsp;</td>
    <td align="right">&nbsp;</td>
    <td align="right">&nbsp;</td>
    <td align="right">&nbsp;</td>
  </tr>
  <tr class="row">
    <td align="right">SUB TOTAL</td>
    <td align="right"><strong>
      <?php
/*		 if ($usuario2 == 'general'){
			if($hda !=''){ 
					$juli = mysql_query("SELECT SUM(`valor`) as total FROM d89xz_diario where `hacienda`='$hda' AND concep ='Ingreso'
					               and  YEAR(fecha) ='$anoss' AND MONTH(fecha) = '$mess' AND 
								   DAY(fecha) = '$dia' and estado !='Anulada'  and  estado !='Cancelada'  and devolucion !='3'  and  devolucion !='4' ", $conexion);
			}else{
					$juli = mysql_query("SELECT SUM(`valor`) as total FROM d89xz_diario where  concep ='Ingreso'
					                and YEAR(fecha) ='$anoss' AND MONTH(fecha) = '$mess' AND 
								   DAY(fecha) = '$dia' and estado !='Anulada'  and  estado !='Cancelada'  and devolucion !='3'  and  devolucion !='4' ", $conexion);
			}
		
		 }else{
			 
			 $juli = mysql_query("SELECT SUM(`valor`) as total FROM d89xz_diario where `hacienda`='$usuario2' AND  concep ='Ingreso' and 
			                 YEAR(fecha) ='$anoss' AND MONTH(fecha) = '$mess' AND DAY(fecha) = '$dia' and 
							 estado !='Anulada'  and  estado !='Cancelada'  and devolucion !='3'  and  devolucion !='4'  ",$conexion);
			 
		 }
		
	 @$row07 = mysql_fetch_array($juli, MYSQL_ASSOC);
    @$TotalINV= ($row07["total"]);
	echo  number_format(abs($TotalINV));*/
		
		  if($hac_url =='Todo'){
		  //Solo Ingresos y Egresos
		  if($year_url=='' && $month_url=='' && $day_url=='' ){
			  $juli = mysql_query("SELECT SUM(`valor`) as total FROM d89xz_diario where estado !='Anulada'  and  
			  estado !='Cancelada' AND concep = 'Ingreso'   and devolucion !='3'  and  devolucion !='4' and  
			  devolucion !='5' and   f_pago !='Consignación'  and   f_pago !='Saldo'   ",$conexion);
		  }
		
		
		   // Ingresos , Egresos y Años///////////////////////////////////////////////////
		  if($year_url!='' && $month_url=='' && $day_url=='' ){
			  $juli = mysql_query("SELECT SUM(`valor`) as total FROM d89xz_diario where YEAR(fecha) = '$year_ur          
			  estado !='Anulada'  and  estado !='Cancelada'   AND concep = 'Ingreso'   and devolucion !='3'  and      	               devolucion !='4' and  devolucion !='5' and   f_pago !='Consignación'  and   f_pago !='Saldo'  
			   ",$conexion);
		  }
		 
		 
		    // Ingresos , Egresos , Años y Mes///////////////////////////////////////////////////
		  if($year_url!='' && $month_url!='' && $day_url=='' ){
			 $juli = mysql_query("SELECT SUM(`valor`) as total FROM d89xz_diario where YEAR(fecha) = '$year_url' AND             MONTH(fecha)='$month_url' AND estado !='Anulada'  and  estado !='Cancelada'  AND concep = 'Ingreso'   
			 and devolucion !='3'  and  devolucion !='4' and  devolucion !='5' and   f_pago !='Consignación'  
			 and   f_pago !='Saldo'  ",             $conexion);
		  }
		 
		
		    // Ingresos , Egresos , Años , Mes Y Dia///////////////////////////////////////////////////
		  if($year_url!='' && $month_url!='' && $day_url!='' ){
			 $juli = mysql_query("SELECT SUM(`valor`) as total FROM d89xz_diario where YEAR(fecha) = '$year_url' AND             MONTH(fecha)='$month_url' AND DAY(fecha) = '$day_url' AND estado !='Anulada'  and  estado !='Cancelada'                AND concep = 'Ingreso'    and devolucion !='3'  and  devolucion !='4' and  devolucion !='5' and  
			 f_pago !='Consignación'  and   f_pago !='Saldo'  ", $conexion);
		  }
		
		 
	  }else{
		 //Solo Ingresos y Egresos
		  if($year_url=='' && $month_url=='' && $day_url==''){
			  $juli = mysql_query("SELECT SUM(`valor`) as total FROM d89xz_diario where          
			   `hacienda`='$hac_url' AND estado !='Anulada'  and  estado !='Cancelada'  AND concep = 'Ingreso'    and                devolucion !='3'  and  devolucion !='4' and  devolucion !='5' and   f_pago !='Consignación'  and   
			   f_pago !='Saldo'  ",$conexion);
		  }
		
		  		   // Ingresos , Egresos y Años///////////////////////////////////////////////////
		  if($year_url!='' && $month_url=='' && $day_url==''){
			  $juli = mysql_query("SELECT SUM(`valor`) as total FROM d89xz_diario where YEAR(fecha) = '$year_url' AND              `hacienda`='$hac_url' AND estado !='Anulada'  and  estado !='Cancelada'  AND concep = 'Ingreso'   and                devolucion !='3'  and  devolucion !='4' and  devolucion !='5' and   f_pago !='Consignación'  and   
			  f_pago !='Saldo'  ",$conexion);
		  }
		
		 
		    // Ingresos , Egresos , Años y Mes///////////////////////////////////////////////////
		  if($year_url!='' && $month_url!='' && $day_url=='' ){
			 $juli = mysql_query("SELECT SUM(`valor`) as total FROM d89xz_diario where YEAR(fecha) = '$year_url' AND  
			   MONTH(fecha)='$month_url' AND `hacienda`='$hac_url' AND estado !='Anulada'  and  estado !='Cancelada' 
			   AND concep = 'Ingreso'  and devolucion !='3'  and  devolucion !='4' and  devolucion !='5' and   
			   f_pago !='Consignación'  and   f_pago !='Saldo'  ", $conexion);
		  }
		
		
		    // Ingresos , Egresos , Años , Mes Y Dia///////////////////////////////////////////////////
		  if($year_url!='' && $month_url!='' && $day_url!='' ){
			 $juli = mysql_query("SELECT SUM(`valor`) as total FROM d89xz_diario where YEAR(fecha) = '$year_url' AND  
			 MONTH(fecha)='$month_url' AND DAY(fecha) = '$day_url'  and `hacienda`='$hac_url' AND estado !='Anulada' 
			  and  estado !='Cancelada'  AND concep = 'Ingreso'  and devolucion !='3'  and  devolucion !='4' and                devolucion !='5' and   f_pago !='Consignación'  and   f_pago !='Saldo'  ", $conexion);
		  }
		
		   
	  }
    @$row07in = mysql_fetch_array($juli, MYSQL_ASSOC);
		$Totalin1=  ($row07in["total"]);
    @$Totalin= number_format ($row07in["total"]);
    echo $Totalin;
//	----------------------------------------------- Fin Sub Total---------------------------------------------------------------------------
		
		
        ?>
    </strong></td>
    <td align="right"><strong>
      <?php
	/*	 if ($usuario2 == 'general'){
			if($hda !=''){ 
					$juli = mysql_query("SELECT SUM(`valor`) as total FROM d89xz_diario where `hacienda`='$hda' AND concep ='Ingreso'
					               and YEAR(fecha) ='$anoss' AND MONTH(fecha) = '$mess' AND 
								   DAY(fecha) = '$dia' and estado !='Anulada'  and  estado !='Cancelada'  and   devolucion ='4' ", $conexion);
			}else{
					$juli = mysql_query("SELECT SUM(`valor`) as total FROM d89xz_diario where  concep ='Ingreso'
					                and YEAR(fecha) ='$anoss' AND MONTH(fecha) = '$mess' AND 
								   DAY(fecha) = '$dia' and estado !='Anulada'  and  estado !='Cancelada'  and  devolucion ='4' ", $conexion);
			}
		
		 }else{
			 
			 $juli = mysql_query("SELECT SUM(`valor`) as total FROM d89xz_diario where `hacienda`='$usuario2' AND  concep ='Ingreso' and 
			                 YEAR(fecha) ='$anoss' AND MONTH(fecha) = '$mess' AND DAY(fecha) = '$dia' and  
							 estado !='Anulada'  and  estado !='Cancelada'  and   devolucion ='4'  ",$conexion);
			 
		 }
		
	 @$row07 = mysql_fetch_array($juli, MYSQL_ASSOC);
    @$TotalINC= ($row07["total"]);
	echo  number_format(abs($TotalINC));*/
	
	////-----------------------------------------------------------------------recibo  Sub TotalCaja ---------------------------------
		  if($hac_url =='Todo'){
		  //Solo Ingresos y Egresos
		  if($year_url=='' && $month_url=='' && $day_url=='' ){
			  $juli = mysql_query("SELECT SUM(`valor`) as total FROM d89xz_diario where estado !='Anulada'  and  estado !='Cancelada' 
			  AND concep = 'Ingreso'   and devolucion ='4'  ",$conexion);
		  }
		
		
		   // Ingresos , Egresos y Años///////////////////////////////////////////////////
		  if($year_url!='' && $month_url=='' && $day_url=='' ){
			  $juli = mysql_query("SELECT SUM(`valor`) as total FROM d89xz_diario where YEAR(fecha) = '$year_url' AND                
			  estado !='Anulada'  and  estado !='Cancelada'   AND concep = 'Ingreso'   and devolucion ='4'  ",$conexion);
		  }
		 
		 
		    // Ingresos , Egresos , Años y Mes///////////////////////////////////////////////////
		  if($year_url!='' && $month_url!='' && $day_url=='' ){
			 $juli = mysql_query("SELECT SUM(`valor`) as total FROM d89xz_diario where YEAR(fecha) = '$year_url' AND             MONTH(fecha)='$month_url' AND estado !='Anulada'  and  estado !='Cancelada' AND concep = 'Ingreso'   and devolucion ='4' ",             $conexion);
		  }
		 
		
		    // Ingresos , Egresos , Años , Mes Y Dia///////////////////////////////////////////////////
		  if($year_url!='' && $month_url!='' && $day_url!='' ){
			 $juli = mysql_query("SELECT SUM(`valor`) as total FROM d89xz_diario where YEAR(fecha) = '$year_url' AND             MONTH(fecha)='$month_url' AND DAY(fecha) = '$day_url' AND estado !='Anulada'  and  estado !='Cancelada'  AND concep = 'Ingreso'    and devolucion ='4' ", $conexion);
		  }
		
		 
	  }else{
		 //Solo Ingresos y Egresos
		  if($year_url=='' && $month_url=='' && $day_url==''){
			  $juli = mysql_query("SELECT SUM(`valor`) as total FROM d89xz_diario where          
			      `hacienda`='$hac_url' AND estado !='Anulada'  and  estado !='Cancelada'   AND concep = 'Ingreso'    and devolucion ='4' ",$conexion);
		  }
		
		  		   // Ingresos , Egresos y Años///////////////////////////////////////////////////
		  if($year_url!='' && $month_url=='' && $day_url==''){
			  $juli = mysql_query("SELECT SUM(`valor`) as total FROM d89xz_diario where YEAR(fecha) = '$year_url' AND              `hacienda`='$hac_url' AND estado !='Anulada'  and  estado !='Cancelada'  AND concep = 'Ingreso'   and devolucion ='4' ",$conexion);
		  }
		
		 
		    // Ingresos , Egresos , Años y Mes///////////////////////////////////////////////////
		  if($year_url!='' && $month_url!='' && $day_url=='' ){
			 $juli = mysql_query("SELECT SUM(`valor`) as total FROM d89xz_diario where YEAR(fecha) = '$year_url' AND  
			            MONTH(fecha)='$month_url' AND `hacienda`='$hac_url' AND estado !='Anulada'  and  estado !='Cancelada' 
			   AND concep = 'Ingreso'  and devolucion ='4' ", $conexion);
		  }
		
		
		    // Ingresos , Egresos , Años , Mes Y Dia///////////////////////////////////////////////////
		  if($year_url!='' && $month_url!='' && $day_url!='' ){
			 $juli = mysql_query("SELECT SUM(`valor`) as total FROM d89xz_diario where YEAR(fecha) = '$year_url' AND  
			            MONTH(fecha)='$month_url' AND DAY(fecha) = '$day_url'  and            
						 `hacienda`='$hac_url' AND estado !='Anulada'  and  estado !='Cancelada'  AND concep = 'Ingreso'  and devolucion ='4' ", $conexion);
		  }
		
		   
	  }
    @$row07in = mysql_fetch_array($juli, MYSQL_ASSOC);
	@$TotalinC1=  ($row07in["total"]);
    @$TotalinC= number_format ($row07in["total"]);
    echo $TotalinC;
//	----------------------------------------------- Fin  Sub total Recibo Cajas---------------------------------------------------------------------------	
		
	
		
		
        ?>
    </strong></td>
    <td align="right"><?php
		/* if ($usuario2 == 'general'){
			if($hda !=''){ 
					$juli = mysql_query("SELECT SUM(`valor`) as total FROM d89xz_diario where `hacienda`='$hda' AND concep ='Ingreso'
					                and YEAR(fecha) ='$anoss' AND MONTH(fecha) = '$mess' AND 
								   DAY(fecha) = '$dia' and estado !='Anulada'  and  estado !='Cancelada'  and devolucion='3'  ", $conexion);
			}else{
					$juli = mysql_query("SELECT SUM(`valor`) as total FROM d89xz_diario where  concep ='Ingreso'
					                and YEAR(fecha) ='$anoss' AND MONTH(fecha) = '$mess' AND 
								   DAY(fecha) = '$dia' and estado !='Anulada'  and  estado !='Cancelada'  and devolucion='3'  ", $conexion);
			}
		
		 }else{
			 
			 $juli = mysql_query("SELECT SUM(`valor`) as total FROM d89xz_diario where `hacienda`='$usuario2' AND  concep ='Ingreso' and 
			                 YEAR(fecha) ='$anoss' AND MONTH(fecha) = '$mess' AND DAY(fecha) = '$dia' and 
							 estado !='Anulada'  and  estado !='Cancelada'  and devolucion='3'  ",$conexion);
			 
		 }
		
	 @$row07 = mysql_fetch_array($juli, MYSQL_ASSOC);
    @$TotalINA= ($row07["total"]);
	echo  number_format(abs($TotalINA));*/
	
	
	////-----------------------------------------------------------------------Abono sub total Ingresos ---------------------------------
		  if($hac_url =='Todo'){
		  //Solo Ingresos y Egresos
		  if($year_url=='' && $month_url=='' && $day_url=='' ){
			  $juli = mysql_query("SELECT SUM(`valor`) as total FROM d89xz_diario where estado !='Anulada'  and  estado !='Cancelada' 
			  AND concep = 'Ingreso'   and devolucion='3'   ",$conexion);
		  }
		
		
		   // Ingresos , Egresos y Años///////////////////////////////////////////////////
		  if($year_url!='' && $month_url=='' && $day_url=='' ){
			  $juli = mysql_query("SELECT SUM(`valor`) as total FROM d89xz_diario where YEAR(fecha) = '$year_url' AND                
			  estado !='Anulada'  and  estado !='Cancelada'  AND concep = 'Ingreso'   and devolucion='3'   ",$conexion);
		  }
		 
		 
		    // Ingresos , Egresos , Años y Mes///////////////////////////////////////////////////
		  if($year_url!='' && $month_url!='' && $day_url=='' ){
			 $juli = mysql_query("SELECT SUM(`valor`) as total FROM d89xz_diario where YEAR(fecha) = '$year_url' AND             MONTH(fecha)='$month_url' AND estado !='Anulada'  and  estado !='Cancelada'  AND concep = 'Ingreso'   and devolucion='3'  ",             $conexion);
		  }
		 
		
		    // Ingresos , Egresos , Años , Mes Y Dia///////////////////////////////////////////////////
		  if($year_url!='' && $month_url!='' && $day_url!='' ){
			 $juli = mysql_query("SELECT SUM(`valor`) as total FROM d89xz_diario where YEAR(fecha) = '$year_url' AND             MONTH(fecha)='$month_url' AND DAY(fecha) = '$day_url' AND estado !='Anulada'  and  estado !='Cancelada'   AND concep = 'Ingreso'    and devolucion='3'  ", $conexion);
		  }
		
		 
	  }else{
		 //Solo Ingresos y Egresos
		  if($year_url=='' && $month_url=='' && $day_url==''){
			  $juli = mysql_query("SELECT SUM(`valor`) as total FROM d89xz_diario where          
			      `hacienda`='$hac_url' AND estado !='Anulada'  and  estado !='Cancelada'   AND concep = 'Ingreso'    and devolucion='3'  ",$conexion);
		  }
		
		  		   // Ingresos , Egresos y Años///////////////////////////////////////////////////
		  if($year_url!='' && $month_url=='' && $day_url==''){
			  $juli = mysql_query("SELECT SUM(`valor`) as total FROM d89xz_diario where YEAR(fecha) = '$year_url' AND              `hacienda`='$hac_url' AND estado !='Anulada'  and  estado !='Cancelada'  AND concep = 'Ingreso'   and devolucion='3'  ",$conexion);
		  }
		
		 
		    // Ingresos , Egresos , Años y Mes///////////////////////////////////////////////////
		  if($year_url!='' && $month_url!='' && $day_url=='' ){
			 $juli = mysql_query("SELECT SUM(`valor`) as total FROM d89xz_diario where YEAR(fecha) = '$year_url' AND  
			            MONTH(fecha)='$month_url' AND `hacienda`='$hac_url' AND estado !='Anulada'  and  estado !='Cancelada' 
			   AND concep = 'Ingreso'  and devolucion='3'  ", $conexion);
		  }
		
		
		    // Ingresos , Egresos , Años , Mes Y Dia///////////////////////////////////////////////////
		  if($year_url!='' && $month_url!='' && $day_url!='' ){
			 $juli = mysql_query("SELECT SUM(`valor`) as total FROM d89xz_diario where YEAR(fecha) = '$year_url' AND  
			            MONTH(fecha)='$month_url' AND DAY(fecha) = '$day_url'  and            
						 `hacienda`='$hac_url' AND estado !='Anulada'  and  estado !='Cancelada'  AND concep = 'Ingreso'  and devolucion='3'  ", $conexion);
		  }
		
		   
	  }
    @$row07in = mysql_fetch_array($juli, MYSQL_ASSOC);
	    @$TotalINV= ($row07in["total"]);
    @$TotalinC= number_format ($row07in["total"]);
    echo $TotalinC;
//	----------------------------------------------- Fin   sub totalAbonos Ingreso---------------------------------------------------------------------------	
	
		
		
        ?></td>
    <td align="right"><?php
		/* if ($usuario2 == 'general'){
			if($hda !=''){ 
					$juli2 = mysql_query("SELECT SUM(`valor`) as total FROM d89xz_diario where `hacienda`='$hda' AND concep ='Egreso'
					               and YEAR(fecha) ='$anoss' AND MONTH(fecha) = '$mess' AND 
								   DAY(fecha) = '$dia' and estado !='Anulada'  and  estado !='Cancelada'  ", $conexion);
			}else{
					$juli2 = mysql_query("SELECT SUM(`valor`) as total FROM d89xz_diario where  concep ='Egreso'
					               and YEAR(fecha) ='$anoss' AND MONTH(fecha) = '$mess' AND 
								   DAY(fecha) = '$dia' and estado !='Anulada'  and  estado !='Cancelada'   ", $conexion);
			}
		
		 }else{
			// echo "Hola";
			 $juli2 = mysql_query("SELECT SUM(`valor`) as total FROM d89xz_diario where `hacienda`='$usuario2' AND  concep ='Egreso' and 
			                 YEAR(fecha) ='$anoss' AND MONTH(fecha) = '$mess' AND DAY(fecha) = '$dia' and 
							 estado !='Anulada'  and  estado !='Cancelada'  ",$conexion);
			 
		 }
		
	 @$row072 = mysql_fetch_array($juli2, MYSQL_ASSOC);
    @$Total2C= ($row072["total"]);
	echo  number_format(abs($Total2C));
		*/
	//------------------------------------------------------------------------------------Sub Total Compras -----------------------------------------------------------------------------------------------
	
	if($hac_url =='Todo'){
		  //Solo Ingresos y Egresos
		  if($year_url=='' && $month_url=='' && $day_url=='' ){
			  $juli = mysql_query("SELECT SUM(`valor`) as total FROM d89xz_diario where estado !='Anulada'  and 
			   estado !='Cancelada'  AND concep = 'Egreso'   and devolucion !='3'  and  devolucion !='4' and   
			   f_pago !='Consignación'  and   f_pago !='Saldo' and   f_pago !='Consignación'  and   f_pago !='Saldo' 
			     ",$conexion);
		  }
		
		
		   // Egresos , Egresos y Años///////////////////////////////////////////////////
		  if($year_url!='' && $month_url=='' && $day_url=='' ){
			  $juli = mysql_query("SELECT SUM(`valor`) as total FROM d89xz_diario where YEAR(fecha) = '$year_url' 
			  AND  estado !='Anulada'  and  estado !='Cancelada'   AND concep = 'Egreso'   and devolucion !='3'  and                devolucion !='4' and   f_pago !='Consignación'  and   f_pago !='Saldo'   ",$conexion);
		  }
		 
		 
		    // Ingresos , Egresos , Años y Mes///////////////////////////////////////////////////
		  if($year_url!='' && $month_url!='' && $day_url=='' ){
			 $juli = mysql_query("SELECT SUM(`valor`) as total FROM d89xz_diario where YEAR(fecha) = '$year_url' AND             MONTH(fecha)='$month_url' AND estado !='Anulada'  and  estado !='Cancelada'  AND concep = 'Egreso'   and             devolucion !='3'  and  devolucion !='4' and   f_pago !='Consignación'  and   f_pago !='Saldo'  ",             $conexion);
		  }
		 
		
		    // Egresos , Egresos , Años , Mes Y Dia///////////////////////////////////////////////////
		  if($year_url!='' && $month_url!='' && $day_url!='' ){
			 $juli = mysql_query("SELECT SUM(`valor`) as total FROM d89xz_diario where YEAR(fecha) = '$year_url' AND             MONTH(fecha)='$month_url' AND DAY(fecha) = '$day_url' AND estado !='Anulada'  and  estado !='Cancelada'              AND concep = 'Egreso'    and devolucion !='3'  and  devolucion !='4' and   f_pago !='Consignación'  and            f_pago !='Saldo'  ", $conexion);
		  }
		
		 
	  }else{
		 //Solo Egresos y Egresos
		  if($year_url=='' && $month_url=='' && $day_url==''){
			  $juli = mysql_query("SELECT SUM(`valor`) as total FROM d89xz_diario where          
			 `hacienda`='$hac_url' AND estado !='Anulada'  and  estado !='Cancelada'   AND concep = 'Egreso'
			 and devolucion !='3'  and  devolucion !='4' and   f_pago !='Consignación'  and   f_pago !='Saldo'  ",             $conexion);
		  }
		
		  		   // Egresos , Egresos y Años///////////////////////////////////////////////////
		  if($year_url!='' && $month_url=='' && $day_url==''){
			  $juli = mysql_query("SELECT SUM(`valor`) as total FROM d89xz_diario where YEAR(fecha) = '$year_url' AND              `hacienda`='$hac_url' AND estado !='Anulada'  and  estado !='Cancelada'  AND concep = 'Egreso'   and             devolucion !='3'  and  devolucion !='4' and   f_pago !='Consignación'  and   f_pago !='Saldo'  ",$conexion);
		  }
		
		 
		    // Egresos , Egresos , Años y Mes///////////////////////////////////////////////////
		  if($year_url!='' && $month_url!='' && $day_url=='' ){
			 $juli = mysql_query("SELECT SUM(`valor`) as total FROM d89xz_diario where YEAR(fecha) = '$year_url' AND  
			  MONTH(fecha)='$month_url' AND `hacienda`='$hac_url' AND estado !='Anulada'  and  estado !='Cancelada' 
			 AND concep = 'Egreso'  and devolucion !='3'  and  devolucion !='4' and   f_pago !='Consignación'  and             f_pago !='Saldo'  ", $conexion);
		  }
		
		
		    // Egresos , Egresos , Años , Mes Y Dia///////////////////////////////////////////////////
		  if($year_url!='' && $month_url!='' && $day_url!='' ){
			 $juli = mysql_query("SELECT SUM(`valor`) as total FROM d89xz_diario where YEAR(fecha) = '$year_url' AND  
			 MONTH(fecha)='$month_url' AND DAY(fecha) = '$day_url'  and `hacienda`='$hac_url' AND estado !='Anulada'  and              estado !='Cancelada'  AND concep = 'Egreso'  and devolucion !='3'  and  devolucion !='4' and   
			 f_pago !='Consignación'  and   f_pago !='Saldo'  ", $conexion);
		  }
		
		   
	  }
    @$row07in = mysql_fetch_array($juli, MYSQL_ASSOC);
		 @$TotalEn1= (abs($row07in["total"]));
    @$TotalEn= number_format (abs($row07in["total"]));
    echo $TotalEn;
//	----------------------------------------------- Fin Egresos---------------------------------------------------------------------------
		
		
			
        ?></td>
    <td align="right"><?php
/*		 if ($usuario2 == 'general'){
			if($hda !=''){ 
					$juli2 = mysql_query("SELECT SUM(`valor`) as total FROM d89xz_diario where `hacienda`='$hda' AND concep ='Egreso'
					              and YEAR(fecha) ='$anoss' AND MONTH(fecha) = '$mess' AND 
								   DAY(fecha) = '$dia' and estado !='Anulada'  and  estado !='Cancelada'  and   devolucion ='4'  ", $conexion);
			}else{
					$juli2 = mysql_query("SELECT SUM(`valor`) as total FROM d89xz_diario where  concep ='Egreso'
					               and YEAR(fecha) ='$anoss' AND MONTH(fecha) = '$mess' AND 
								   DAY(fecha) = '$dia' and estado !='Anulada'  and  estado !='Cancelada'  and   devolucion ='4'   ", $conexion);
			}
		
		 }else{
			// echo "Hola";
			 $juli2 = mysql_query("SELECT SUM(`valor`) as total FROM d89xz_diario where `hacienda`='$usuario2' AND  concep ='Egreso' and 
			                 YEAR(fecha) ='$anoss' AND MONTH(fecha) = '$mess' AND DAY(fecha) = '$dia' and 
							 estado !='Anulada'  and  estado !='Cancelada'  and   devolucion ='4'  ",$conexion);
			 
		 }
		
	 @$row072 = mysql_fetch_array($juli2, MYSQL_ASSOC);
    @$Total2R= ($row072["total"]);
	echo  number_format(abs($Total2R));*/
		
		
		////-----------------------------------------------------------------------Sub Total recibo Caja ---------------------------------
		  if($hac_url =='Todo'){
		  //Solo Ingresos y Egresos
		  if($year_url=='' && $month_url=='' && $day_url=='' ){
			  $juli = mysql_query("SELECT SUM(`valor`) as total FROM d89xz_diario where estado !='Anulada'  and  estado !='Cancelada' 
			  AND concep = 'Egreso'   and devolucion ='4'  ",$conexion);
		  }
		
		
		   // Egresos , Egresos y Años///////////////////////////////////////////////////
		  if($year_url!='' && $month_url=='' && $day_url=='' ){
			  $juli = mysql_query("SELECT SUM(`valor`) as total FROM d89xz_diario where YEAR(fecha) = '$year_url' AND                
			  estado !='Anulada'  and  estado !='Cancelada'   AND concep = 'Egreso'   and devolucion ='4'  ",$conexion);
		  }
		 
		 
		    // Egresos , Egresos , Años y Mes///////////////////////////////////////////////////
		  if($year_url!='' && $month_url!='' && $day_url=='' ){
			 $juli = mysql_query("SELECT SUM(`valor`) as total FROM d89xz_diario where YEAR(fecha) = '$year_url' AND             MONTH(fecha)='$month_url' AND estado !='Anulada'  and  estado !='Cancelada'  AND concep = 'Egreso'   and devolucion ='4' ",             $conexion);
		  }
		 
		
		    // Egresos , Egresos , Años , Mes Y Dia///////////////////////////////////////////////////
		  if($year_url!='' && $month_url!='' && $day_url!='' ){
			 $juli = mysql_query("SELECT SUM(`valor`) as total FROM d89xz_diario where YEAR(fecha) = '$year_url' AND             MONTH(fecha)='$month_url' AND DAY(fecha) = '$day_url' AND estado !='Anulada'  and  estado !='Cancelada'   AND concep = 'Egreso'    and devolucion ='4' ", $conexion);
		  }
		
		 
	  }else{
		 //Solo Egresos y Egresos
		  if($year_url=='' && $month_url=='' && $day_url==''){
			  $juli = mysql_query("SELECT SUM(`valor`) as total FROM d89xz_diario where          
			      `hacienda`='$hac_url' AND estado !='Anulada'  and  estado !='Cancelada'   AND concep = 'Egreso'    and devolucion ='4' ",$conexion);
		  }
		
		  		   // Egresos , Egresos y Años///////////////////////////////////////////////////
		  if($year_url!='' && $month_url=='' && $day_url==''){
			  $juli = mysql_query("SELECT SUM(`valor`) as total FROM d89xz_diario where YEAR(fecha) = '$year_url' AND              `hacienda`='$hac_url' AND estado !='Anulada'  and  estado !='Cancelada'  AND concep = 'Egreso'   and devolucion ='4' ",$conexion);
		  }
		
		 
		    // Egresos , Egresos , Años y Mes///////////////////////////////////////////////////
		  if($year_url!='' && $month_url!='' && $day_url=='' ){
			 $juli = mysql_query("SELECT SUM(`valor`) as total FROM d89xz_diario where YEAR(fecha) = '$year_url' AND  
			            MONTH(fecha)='$month_url' AND `hacienda`='$hac_url' AND estado !='Anulada'  and  estado !='Cancelada' 
			   AND concep = 'Egreso'  and devolucion ='4' ", $conexion);
		  }
		
		
		    // Egresos , Egresos , Años , Mes Y Dia///////////////////////////////////////////////////
		  if($year_url!='' && $month_url!='' && $day_url!='' ){
			 $juli = mysql_query("SELECT SUM(`valor`) as total FROM d89xz_diario where YEAR(fecha) = '$year_url' AND  
			            MONTH(fecha)='$month_url' AND DAY(fecha) = '$day_url'  and            
						 `hacienda`='$hac_url' AND estado !='Anulada'  and  estado !='Cancelada'  AND concep = 'Egreso'  and devolucion ='4' ", $conexion);
		  }
		
		   
	  }
    @$row07in = mysql_fetch_array($juli, MYSQL_ASSOC);
	@$TotalEnC1=  (abs($row07in["total"]));
    @$TotalEnC= number_format (abs($row07in["total"]));
    echo $TotalEnC;
//	----------------------------------------------- Fin  Sub Total Recibo Cajas---------------------------------------------------------------------------	
		

		
        ?></td>
    <td align="right"><?php
/*		 if ($usuario2 == 'general'){
			if($hda !=''){ 
					$juli = mysql_query("SELECT SUM(`valor`) as total FROM d89xz_diario where `hacienda`='$hda' AND concep ='Egreso'
					                and YEAR(fecha) ='$anoss' AND MONTH(fecha) = '$mess' AND 
								   DAY(fecha) = '$dia' and estado !='Anulada'  and  estado !='Cancelada'  and devolucion='3'  ", $conexion);
			}else{
					$juli = mysql_query("SELECT SUM(`valor`) as total FROM d89xz_diario where  concep ='Egreso'
					             and YEAR(fecha) ='$anoss' AND MONTH(fecha) = '$mess' AND 
								   DAY(fecha) = '$dia' and estado !='Anulada'  and  estado !='Cancelada'  and devolucion='3'  ", $conexion);
			}
		
		 }else{
			 
			 $juli = mysql_query("SELECT SUM(`valor`) as total FROM d89xz_diario where `hacienda`='$usuario2' AND  concep ='Egreso' and 
			                 YEAR(fecha) ='$anoss' AND MONTH(fecha) = '$mess' AND DAY(fecha) = '$dia' and 
							 estado !='Anulada'  and  estado !='Cancelada'  and devolucion='3'  ",$conexion);
			 
		 }
		
	 @$row07 = mysql_fetch_array($juli, MYSQL_ASSOC);
    @$Total2A= ($row07["total"]);
	echo  number_format(abs($Total2A));*/
	
	////-----------------------------------------------------------------------Abono Sub  total EGRESOS ---------------------------------
		  if($hac_url =='Todo'){
		  //Solo Ingresos y Egresos
		  if($year_url=='' && $month_url=='' && $day_url=='' ){
			  $juli = mysql_query("SELECT SUM(`valor`) as total FROM d89xz_diario where estado !='Anulada'  and  estado !='Cancelada' 
			  AND concep = 'Egreso'   and devolucion='3'   ",$conexion);
		  }
		
		
		   // Egresos , Egresos y Años///////////////////////////////////////////////////
		  if($year_url!='' && $month_url=='' && $day_url=='' ){
			  $juli = mysql_query("SELECT SUM(`valor`) as total FROM d89xz_diario where YEAR(fecha) = '$year_url' AND                
			  estado !='Anulada'  and  estado !='Cancelada'   AND concep = 'Egreso'   and devolucion='3'   ",$conexion);
		  }
		 
		 
		    // Egresos , Egresos , Años y Mes///////////////////////////////////////////////////
		  if($year_url!='' && $month_url!='' && $day_url=='' ){
			 $juli = mysql_query("SELECT SUM(`valor`) as total FROM d89xz_diario where YEAR(fecha) = '$year_url' AND             MONTH(fecha)='$month_url' AND estado !='Anulada'  and  estado !='Cancelada'  AND concep = 'Egreso'   and devolucion='3'  ",             $conexion);
		  }
		 
		
		    // Egresos , Egresos , Años , Mes Y Dia///////////////////////////////////////////////////
		  if($year_url!='' && $month_url!='' && $day_url!='' ){
			 $juli = mysql_query("SELECT SUM(`valor`) as total FROM d89xz_diario where YEAR(fecha) = '$year_url' AND             MONTH(fecha)='$month_url' AND DAY(fecha) = '$day_url' AND estado !='Anulada'  and  estado !='Cancelada'   AND concep = 'Egreso'    and devolucion='3'  ", $conexion);
		  }
		
		 
	  }else{
		 //Solo Egresos y Egresos
		  if($year_url=='' && $month_url=='' && $day_url==''){
			  $juli = mysql_query("SELECT SUM(`valor`) as total FROM d89xz_diario where          
			      `hacienda`='$hac_url' AND estado !='Anulada'  and  estado !='Cancelada'  AND concep = 'Egreso'    and devolucion='3'  ",$conexion);
		  }
		
		  		   // Egresos , Egresos y Años///////////////////////////////////////////////////
		  if($year_url!='' && $month_url=='' && $day_url==''){
			  $juli = mysql_query("SELECT SUM(`valor`) as total FROM d89xz_diario where YEAR(fecha) = '$year_url' AND              `hacienda`='$hac_url' AND estado !='Anulada'  and  estado !='Cancelada'  AND concep = 'Egreso'   and devolucion='3'  ",$conexion);
		  }
		
		 
		    // Egresos , Egresos , Años y Mes///////////////////////////////////////////////////
		  if($year_url!='' && $month_url!='' && $day_url=='' ){
			 $juli = mysql_query("SELECT SUM(`valor`) as total FROM d89xz_diario where YEAR(fecha) = '$year_url' AND  
			            MONTH(fecha)='$month_url' AND `hacienda`='$hac_url' AND estado !='Anulada'  and  estado !='Cancelada' 
			  AND concep = 'Egreso'  and devolucion='3'  ", $conexion);
		  }
		
		
		    // Egresos , Egresos , Años , Mes Y Dia///////////////////////////////////////////////////
		  if($year_url!='' && $month_url!='' && $day_url!='' ){
			 $juli = mysql_query("SELECT SUM(`valor`) as total FROM d89xz_diario where YEAR(fecha) = '$year_url' AND  
			            MONTH(fecha)='$month_url' AND DAY(fecha) = '$day_url'  and            
						 `hacienda`='$hac_url' AND estado !='Anulada'  and  estado !='Cancelada'  AND concep = 'Egreso'  and devolucion='3'  ", $conexion);
		  }
		
		   
	  }
    @$row07in = mysql_fetch_array($juli, MYSQL_ASSOC);
	 @$TotalEGC1= (abs($row07in["total"]));
    @$TotalEGC= number_format (abs($row07in["total"]));
    echo $TotalEGC;
//	----------------------------------------------- Fin  Abonos Egreso---------------------------------------------------------------------------	
		
		
		
        ?></td>
    <td align="right">&nbsp;</td>
  </tr>
  <tr class="row">
    <td align="right" style="font-size: 12px">TOTAL MOVIMIENTOS</td>
    <td colspan="3" align="center" style="color: #093"><?php  echo number_format($finalingresos = $Totalin1 + $TotalinC1 + $TotalINV )?></td>
    <td colspan="3" align="center" style="color:#AEB404"><?php  echo number_format(abs($finalegresos =   $TotalEn1 + $TotalEnC1 + $TotalEGC1) )?></td>
    <td align="right">&nbsp;</td>
  </tr>
  <tr class="row">
    <td align="right" style="font-size: 12px">SUBTOTAL EFECTIVO</td>
    <td colspan="3" align="center" style="color: #093"><strong>
      <?php

		  if($hac_url =='Todo'){
		  //Solo Ingresos y Egresos
		  if($year_url=='' && $month_url=='' && $day_url=='' ){
			 // echo "hola 1".'-';
			  $juli = mysql_query("SELECT SUM(`valor`) as total FROM d89xz_diario where estado !='Anulada'  and 
			   estado !='Cancelada' AND concep = 'Ingreso'   and devolucion !='5'    
			   and  f_pago ='Efectivo'  ",$conexion);
			   //________________________________________________________________________________________
			   $julib = mysql_query("SELECT SUM(`valor`) as total FROM d89xz_diario where estado !='Anulada'  and 
			   estado !='Cancelada' AND concep = 'Base'       
			     ",$conexion);
			   
		  }
		
		
		   // Ingresos , Egresos y Años///////////////////////////////////////////////////
		  if($year_url!='' && $month_url=='' && $day_url=='' ){
			  $juli = mysql_query("SELECT SUM(`valor`) as total FROM d89xz_diario where YEAR(fecha) = '$year_url' AND                estado !='Anulada'  and  estado !='Cancelada'   AND concep = 'Ingreso'   and   devolucion !='5' 
			   and  f_pago ='Efectivo' ",$conexion);
			   //________________________________________________________________________________________
			    $julib = mysql_query("SELECT SUM(`valor`) as total FROM d89xz_diario where YEAR(fecha) = '$year_url' AND                estado !='Anulada'  and  estado !='Cancelada'   AND concep = 'Base'    ",$conexion);
		  }
		 
		 
		    // Ingresos , Egresos , Años y Mes///////////////////////////////////////////////////
		  if($year_url!='' && $month_url!='' && $day_url=='' ){
			 $juli = mysql_query("SELECT SUM(`valor`) as total FROM d89xz_diario where YEAR(fecha) = '$year_url' AND             MONTH(fecha)='$month_url' AND estado !='Anulada'  and  estado !='Cancelada'  AND concep = 'Ingreso'   and             devolucion !='5'  and    f_pago ='Efectivo' ",             $conexion);
			  //________________________________________________________________________________________
			  $julib = mysql_query("SELECT SUM(`valor`) as total FROM d89xz_diario where YEAR(fecha) = '$year_url' AND             MONTH(fecha)='$month_url' AND estado !='Anulada'  and  estado !='Cancelada'  AND concep = 'Base'   ",             $conexion);
		  }
		 
		
		    // Ingresos , Egresos , Años , Mes Y Dia///////////////////////////////////////////////////
		  if($year_url!='' && $month_url!='' && $day_url!='' ){
			 $juli = mysql_query("SELECT SUM(`valor`) as total FROM d89xz_diario where YEAR(fecha) = '$year_url' AND             MONTH(fecha)='$month_url' AND DAY(fecha) = '$day_url' AND estado !='Anulada'  and  estado !='Cancelada'                AND concep = 'Ingreso'    and devolucion !='5'    and  f_pago ='Efectivo' ", $conexion);
			   //________________________________________________________________________________________
			   
			   $julib = mysql_query("SELECT SUM(`valor`) as total FROM d89xz_diario where YEAR(fecha) = '$year_url' AND             MONTH(fecha)='$month_url' AND DAY(fecha) = '$day_url' AND estado !='Anulada'  and  estado !='Cancelada'                AND concep = 'Base'    ", $conexion); 
		  }
		
		 
	  }else{
		 //Solo Ingresos y Egresos
		  if($year_url=='' && $month_url=='' && $day_url==''){
			  $juli = mysql_query("SELECT SUM(`valor`) as total FROM d89xz_diario where `hacienda`='$hac_url' AND 
			  estado !='Anulada'  and  estado !='Cancelada'  AND concep = 'Ingreso'    and devolucion !='5'    and
			    f_pago ='Efectivo' ",$conexion);
			//________________________________________________________________________________________	
			
			 $julib = mysql_query("SELECT SUM(`valor`) as total FROM d89xz_diario where `hacienda`='$hac_url' AND 
			  estado !='Anulada'  and  estado !='Cancelada'  AND concep = 'Base'   ",$conexion);  
		  }
		
		  		   // Ingresos , Egresos y Años///////////////////////////////////////////////////
		  if($year_url!='' && $month_url=='' && $day_url==''){
			  $juli = mysql_query("SELECT SUM(`valor`) as total FROM d89xz_diario where YEAR(fecha) = '$year_url' AND              `hacienda`='$hac_url' AND estado !='Anulada'  and  estado !='Cancelada'  AND concep = 'Ingreso'   and       	       devolucion !='5'    and  f_pago ='Efectivo' ",$conexion);
			  //________________________________________________________________________________________	
			  $julib = mysql_query("SELECT SUM(`valor`) as total FROM d89xz_diario where YEAR(fecha) = '$year_url' AND              `hacienda`='$hac_url' AND estado !='Anulada'  and  estado !='Cancelada'  AND concep = 'Base'  ",$conexion);
		  }
		
		 
		    // Ingresos , Egresos , Años y Mes///////////////////////////////////////////////////
		  if($year_url!='' && $month_url!='' && $day_url=='' ){
			 $juli = mysql_query("SELECT SUM(`valor`) as total FROM d89xz_diario where YEAR(fecha) = '$year_url' AND  
			   MONTH(fecha)='$month_url' AND `hacienda`='$hac_url' AND estado !='Anulada'  and  estado !='Cancelada' 
			   AND concep = 'Ingreso'  and devolucion !='5'    and  f_pago ='Efectivo' ", $conexion);
			   //________________________________________________________________________________________
			   
			    $julib = mysql_query("SELECT SUM(`valor`) as total FROM d89xz_diario where YEAR(fecha) = '$year_url' AND  
			   MONTH(fecha)='$month_url' AND `hacienda`='$hac_url' AND estado !='Anulada'  and  estado !='Cancelada' 
			   AND concep = 'Base'   ", $conexion);
		  }
		
		
		    // Ingresos , Egresos , Años , Mes Y Dia///////////////////////////////////////////////////
		  if($year_url!='' && $month_url!='' && $day_url!='' ){
			 $juli = mysql_query("SELECT SUM(`valor`) as total FROM d89xz_diario where YEAR(fecha) = '$year_url' AND  
			 MONTH(fecha)='$month_url' AND DAY(fecha) = '$day_url'  and `hacienda`='$hac_url' AND estado !='Anulada' 
			  and  estado !='Cancelada'  AND concep = 'Ingreso'  and devolucion !='5'   and  f_pago ='Efectivo' ",              $conexion);
			//________________________________________________________________________________________
			 $julib = mysql_query("SELECT SUM(`valor`) as total FROM d89xz_diario where YEAR(fecha) = '$year_url' AND  
			 MONTH(fecha)='$month_url' AND DAY(fecha) = '$day_url'  and           
			`hacienda`='$hac_url' AND estado !='Anulada'  and  estado !='Cancelada'  AND concep = 'Base'  ", $conexion);
						 
		  }
		
		   
	  }
    @$row07in = mysql_fetch_array($juli, MYSQL_ASSOC);
	$Totalin1=  ($row07in["total"]);
    
	//___________________________________________
	@$row07inb = mysql_fetch_array($julib, MYSQL_ASSOC);
	 $Totalin1b=  ($row07inb["total"]);
	 @$Totalin1bbI=  ($Totalin1+$Totalin1b);
   	@$Totalin1bb= number_format ($Totalin1+$Totalin1b);
	
    echo $Totalin1bb;
//	----------------------------------------------- Fin Sub Total---------------------------------------------------------------------------
		
		
        ?>
    </strong></td>
    <td colspan="3" align="center" style="color:#AEB404"><strong>
      <?php

		  if($hac_url =='Todo'){
		  //Solo Ingresos y Egresos
		  if($year_url=='' && $month_url=='' && $day_url=='' ){
			  //echo "hola 1".'-';
			  $juli = mysql_query("SELECT SUM(`valor`) as total FROM d89xz_diario where estado !='Anulada'  and 
			   estado !='Cancelada' AND concep = 'Egreso'   and devolucion !='5'    
			   and  f_pago ='Efectivo'   ",$conexion);
		  }
		
		
		   // Ingresos , Egresos y Años///////////////////////////////////////////////////
		  if($year_url!='' && $month_url=='' && $day_url=='' ){
			  $juli = mysql_query("SELECT SUM(`valor`) as total FROM d89xz_diario where YEAR(fecha) = '$year_url' AND                
			  estado !='Anulada'  and  estado !='Cancelada'   AND concep = 'Egreso'   and   devolucion !='5'  and  f_pago ='Efectivo' ",$conexion);
		  }
		 
		 
		    // Ingresos , Egresos , Años y Mes///////////////////////////////////////////////////
		  if($year_url!='' && $month_url!='' && $day_url=='' ){
			 $juli = mysql_query("SELECT SUM(`valor`) as total FROM d89xz_diario where YEAR(fecha) = '$year_url' AND             MONTH(fecha)='$month_url' AND estado !='Anulada'  and  estado !='Cancelada'  AND concep = 'Egreso'   and devolucion !='5'  and    f_pago ='Efectivo' ",             $conexion);
		  }
		 
		
		    // Ingresos , Egresos , Años , Mes Y Dia///////////////////////////////////////////////////
		  if($year_url!='' && $month_url!='' && $day_url!='' ){
			 $juli = mysql_query("SELECT SUM(`valor`) as total FROM d89xz_diario where YEAR(fecha) = '$year_url' AND             MONTH(fecha)='$month_url' AND DAY(fecha) = '$day_url' AND estado !='Anulada'  and  estado !='Cancelada'   AND concep = 'Egreso'    and devolucion !='5'    and  f_pago ='Efectivo' ", $conexion);
		  }
		
		 
	  }else{
		 //Solo Ingresos y Egresos
		  if($year_url=='' && $month_url=='' && $day_url==''){
			  $juli = mysql_query("SELECT SUM(`valor`) as total FROM d89xz_diario where          
			      `hacienda`='$hac_url' AND estado !='Anulada'  and  estado !='Cancelada'  AND concep = 'Egreso'    and devolucion !='5'    and  f_pago ='Efectivo' ",$conexion);
		  }
		
		  		   // Ingresos , Egresos y Años///////////////////////////////////////////////////
		  if($year_url!='' && $month_url=='' && $day_url==''){
			  $juli = mysql_query("SELECT SUM(`valor`) as total FROM d89xz_diario where YEAR(fecha) = '$year_url' AND              `hacienda`='$hac_url' AND estado !='Anulada'  and  estado !='Cancelada'  AND concep = 'Egreso'   and devolucion !='5'    and  f_pago ='Efectivo' ",$conexion);
		  }
		
		 
		    // Ingresos , Egresos , Años y Mes///////////////////////////////////////////////////
		  if($year_url!='' && $month_url!='' && $day_url=='' ){
			 $juli = mysql_query("SELECT SUM(`valor`) as total FROM d89xz_diario where YEAR(fecha) = '$year_url' AND  
			            MONTH(fecha)='$month_url' AND `hacienda`='$hac_url' AND estado !='Anulada'  and  estado !='Cancelada' 
			   AND concep = 'Egreso'  and devolucion !='5'    and  f_pago ='Efectivo' ", $conexion);
		  }
		
		
		    // Ingresos , Egresos , Años , Mes Y Dia///////////////////////////////////////////////////
		  if($year_url!='' && $month_url!='' && $day_url!='' ){
			 $juli = mysql_query("SELECT SUM(`valor`) as total FROM d89xz_diario where YEAR(fecha) = '$year_url' AND  
			            MONTH(fecha)='$month_url' AND DAY(fecha) = '$day_url'  and            
						 `hacienda`='$hac_url' AND estado !='Anulada'  and  estado !='Cancelada'  AND concep = 'Egreso'  and devolucion !='5'   and  f_pago ='Efectivo' ", $conexion);
		  }
		
		   
	  }
    @$row07in = mysql_fetch_array($juli, MYSQL_ASSOC);
		$Totalin1E=  ($row07in["total"]);
    @$Totalin= number_format (abs($row07in["total"]));
    echo $Totalin;
//	----------------------------------------------- Fin Sub Total---------------------------------------------------------------------------
		
		
        ?>
    </strong></td>
    <td align="right">&nbsp;</td>
  </tr>
  <tr class="row">
    <td align="right" style="font-size: 12px">TOTAL EFECTIVO</td>
    <?php
    $final= number_format($Totalin1bbI + $Totalin1E);
		$final1=number_format(abs($Totalin1bbI + $Totalin1E));
	if($final>0){
			
		echo "<td colspan='6' align='center' style='color: #093'>$final1</td>";
	}else{
		echo "<td colspan='6' align='center' style='color: #FF0000'>$final1</td>";
	}
    ?>
    <td align="right">&nbsp;</td>
  </tr>
</table>
<p>&nbsp;</p>
<p>&nbsp;</p>
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
	var order='';
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
	'&m=' + m.replace(/ /g,"+") +'&d=' + d.replace(/ /g,"+") +'&t=' + t.replace(/ /g,"+")+ '&o=' + order.replace(/ /g,"+") +' #year' );
	
	$('#month').load('basc_hist.php?h=' + h.replace(/ /g,"+") + '&y=' + y.replace(/ /g,"+") +
	'&m=' + m.replace(/ /g,"+") +'&d=' + d.replace(/ /g,"+") +'&t=' + t.replace(/ /g,"+")+ '&o=' + order.replace(/ /g,"+") +' #month ' );
	
	$('#day').load('basc_hist.php?h=' + h.replace(/ /g,"+") + '&y=' + y.replace(/ /g,"+") +
	'&m=' + m.replace(/ /g,"+") +'&d=' + d.replace(/ /g,"+") +'&t=' + t.replace(/ /g,"+")+ '&o=' + order.replace(/ /g,"+") +' #day' );
	
	$('#table').load('basc_hist.php?h=' + h.replace(/ /g,"+") + '&y=' + y.replace(/ /g,"+") +
	'&m=' + m.replace(/ /g,"+") +'&d=' + d.replace(/ /g,"+") +'&t=' + t.replace(/ /g,"+")+ '&o=' + order.replace(/ /g,"+") +' #table ' );
	
}

function load1(hac){
	var y = '';
	var m = '';
	var d = '';
	var t = $('#sl_tipo').val();
	var order='';
	
	$('#month').hide();
	$('#day').hide();
	
	console.log ('h:'+hac+' t:'+t+' y:'+y+' m:'+m+' d:'+d);
	
	$('#tipo').load('basc_hist.php?h=' + hac.replace(/ /g,"+") + '&y=' + y.replace(/ /g,"+") +
	'&m=' + m.replace(/ /g,"+") +'&d=' + d.replace(/ /g,"+") +'&t=' + t.replace(/ /g,"+")+ '&o=' + order.replace(/ /g,"+") +' #tipo' );
	
	$('#year').load('basc_hist.php?h=' + hac.replace(/ /g,"+") + '&y=' + y.replace(/ /g,"+") +
	'&m=' + m.replace(/ /g,"+") +'&d=' + d.replace(/ /g,"+") +'&t=' + t.replace(/ /g,"+")+ '&o=' + order.replace(/ /g,"+") +' #year' );
	
	$('#month').load('basc_hist.php?h=' + hac.replace(/ /g,"+") + '&y=' + y.replace(/ /g,"+") +
	'&m=' + m.replace(/ /g,"+") +'&d=' + d.replace(/ /g,"+") +'&t=' + t.replace(/ /g,"+")+ '&o=' + order.replace(/ /g,"+") +' #month ' );
	
	$('#day').load('basc_hist.php?h=' + hac.replace(/ /g,"+") + '&y=' + y.replace(/ /g,"+") +
	'&m=' + m.replace(/ /g,"+") +'&d=' + d.replace(/ /g,"+") +'&t=' + t.replace(/ /g,"+")+ '&o=' + order.replace(/ /g,"+") +' #day' );
	
	$('#table').load('basc_hist.php?h=' + hac.replace(/ /g,"+") + '&y=' + y.replace(/ /g,"+") +
	'&m=' + m.replace(/ /g,"+") +'&d=' + d.replace(/ /g,"+") +'&t=' + t.replace(/ /g,"+")+ '&o=' + order.replace(/ /g,"+") +' #table ' );
	
}

function load2(){
	var y = $('#sl_year').val();
	var m = $('#sl_month').val();
	var d = $('#sl_day').val();
	var t = $('#sl_tipo').val();
	var order='';
	
	var user = $('#tf_user').val();
	var h = '';
	if ( user == 'general'){
		h = $('#sl_hac').val();
	} else {
		h = $('#tf_user').val();	
	}
	console.log ('h:'+h+' t:'+t+' y:'+y+' m:'+m+' d:'+d);	
	
	$('#month').load('basc_hist.php?h=' + h.replace(/ /g,"+") + '&y=' + y.replace(/ /g,"+") +
	'&m=' + m.replace(/ /g,"+") +'&d=' + d.replace(/ /g,"+") +'&t=' + t.replace(/ /g,"+")+ '&o=' + order.replace(/ /g,"+") +' #month ' );
	
	$('#day').load('basc_hist.php?h=' + h.replace(/ /g,"+") + '&y=' + y.replace(/ /g,"+") +
	'&m=' + m.replace(/ /g,"+") +'&d=' + d.replace(/ /g,"+") +'&t=' + t.replace(/ /g,"+") + '&o=' + order.replace(/ /g,"+") +' #day' );
	
	$('#table').load('basc_hist.php?h=' + h.replace(/ /g,"+") + '&y=' + y.replace(/ /g,"+") +
	'&m=' + m.replace(/ /g,"+") +'&d=' + d.replace(/ /g,"+") +'&t=' + t.replace(/ /g,"+") + '&o=' + order.replace(/ /g,"+") +' #table ' );
	
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
	var order='';
	
	var user = $('#tf_user').val();
	var h = '';
	if ( user == 'general'){
		h = $('#sl_hac').val();
	} else {
		h = $('#tf_user').val();	
	}
	
	console.log ('h:'+h+' t:'+t+' y:'+y+' m:'+m+' d:'+d);
	
	$('#day').load('basc_hist.php?h=' + h.replace(/ /g,"+") + '&y=' + y.replace(/ /g,"+") +
	'&m=' + m.replace(/ /g,"+") +'&d=' + d.replace(/ /g,"+") +'&t=' + t.replace(/ /g,"+") + '&o=' + order.replace(/ /g,"+") +' #day' );
	
	$('#table').load('basc_hist.php?h=' + h.replace(/ /g,"+") + '&y=' + y.replace(/ /g,"+") +
	'&m=' + m.replace(/ /g,"+") +'&d=' + d.replace(/ /g,"+") +'&t=' + t.replace(/ /g,"+")  +' #table ' );
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
	var order='';
	
	var user = $('#tf_user').val();
	var h = '';
	if ( user == 'general'){
		h = $('#sl_hac').val();
	} else {
		h = $('#tf_user').val();	
	}
	console.log ('h:'+h+' t:'+t+' y:'+y+' m:'+m+' d:'+d);
	
	$('#table').load('basc_hist.php?h=' + h.replace(/ /g,"+") + '&y=' + y.replace(/ /g,"+") +
	'&m=' + m.replace(/ /g,"+") +'&d=' + d.replace(/ /g,"+") +'&t=' + t.replace(/ /g,"+")+ '&o=' + order.replace(/ /g,"+") +' #table ' );
	
}


//funcion para iniciar el shadowbox
Shadowbox.init({
	handleOversize: "drag",
	modal: true,
onOpen: function() {
		$('#sb-info').after($('#sb-wrapper-inner'));
		$('#sb-wrapper-inner').after($('#sb-title'));
	},
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
	$("#"+id_tabla).printThis({
	     debug: false,          
	     importCSS: true,           
         printContainer: true,      				         
		 loadCSS: "../css/style-print.css", 
         pageTitle: "",             
         removeInline: false,
				 removebuttons:true       
	  });
}

//-----------------------Ordenar Tabla ------------------------------------------------------------------

function orden_bus(tipo){
	window.band2=!window.band2;
	if(window.band2==true) ord='ASC';
	else ord='DESC'
	var order = 'ORDER BY `'+tipo+'` '+ord
	//console.log(order)
	load6(order)
	
}

function load6(order){
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
	
	console.log ('h:'+h+' t:'+t+' y:'+y+' m:'+m+' d:'+d+' o:'+order);

	
	$('#table').load('basc_hist.php?h=' + h.replace(/ /g,"+") + '&y=' + y.replace(/ /g,"+") +
	'&m=' + m.replace(/ /g,"+") +'&d=' + d.replace(/ /g,"+") +'&t=' + t.replace(/ /g,"+") + '&o=' + order.replace(/ /g,"+") +' #table ' );
	if (m == ''){
		console.log('m:'+m);
		
	}else{
		console.log('m:'+m);
		
	}	
}


</script>
</html>
<?php
@mysql_free_result($years_query);
@mysql_free_result($months_q);
@mysql_free_result($peso_tot_q);
}
?>
