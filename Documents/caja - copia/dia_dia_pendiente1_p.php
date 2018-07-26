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

$day_url=$_GET['d'];
$month_url=$_GET['m'];
$year_url=$_GET['y'];

$hac_url=$_GET['h'];
$tipo_url=$_GET['t'];

/*------------------------------------------------------------------------------------------------------------------------*/
/*$queEmp ="SELECT * FROM d89xz_diario where comentario LIKE '%Factura de Compra No%'";
	$resEmp = mysql_query($queEmp, $conexion) or die(mysql_error());
	$totEmp = mysql_num_rows($resEmp);
	if ($totEmp> 0) {
		
		while ($rowEmp = mysql_fetch_assoc($resEmp)) {
		//echo"hola". $consecutivo=	$rowEmp['comentario'];	
		$consecutivo=	$rowEmp['id'];
		
		 $prin1 =$rowEmp['comentario'];
		 list($conte1,$color1,$vari1)=explode(":",$prin1);
		// echo $vari1 =$vari1;
		  $color1 =$color1;
		$insertar = mysql_query("UPDATE  `d89xz_diario` SET `ven_com`='$color1' where id='$consecutivo' and  ven_com='' ", $conexion);							
						}}	*/	
	//-----------------------------------------------------------------------------


?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Facturas Pendientes</title>
<link rel="stylesheet" type="text/css" href="http://code.jquery.com/ui/1.10.3/themes/smoothness/jquery-ui.css" />
<link href="../caja/css/clean.css" rel="stylesheet" type="text/css" />
<link href="../caja/css/shadowbox.css" rel="stylesheet" type="text/css" />
<link href="../caja/css/style.css" rel="stylesheet" type="text/css" />
<script src="../caja/js/shadowbox.js" type="text/javascript"></script>
<script src="../caja/js/jquery.validate.js" type="text/javascript"></script>

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
		$('#seleccion').load('dia_dia_pendiente1.php' + ' #seleccion ' );
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

<script src="SpryAssets/SpryMenuBar.js" type="text/javascript"></script>
<link href="SpryAssets/SpryMenuBarHorizontal.css" rel="stylesheet" type="text/css" />

<script type="text/javascript" src="//ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
<script type="text/javascript" src="http://code.jquery.com/ui/1.10.3/jquery-ui.js"></script>
<script src="http://code.jquery.com/jquery-1.9.1.js"></script>
<script src="http://code.jquery.com/ui/1.10.1/jquery-ui.js"></script>



<script src="../js/printThis.js" type="text/javascript"></script>
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

<table width="98%" border="0" align="center" cellspacing="0">
  <tr bgcolor="#f0f0f0">
    <td width="858" align="left" bgcolor="#FFFFFF"><div id="menu">
      <ul >
        <ul>
          <li> <a href="dia_dia_pendiente.php"  >Crédito Ingreso</a> </li>
           <li><a href="dia_dia_pendiente1.php" class='active' >Crédito Egreso</a></li>
           
         
        
          </ul>
        </ul>
    </div>     </td>
    <td width="94" align="center" bgcolor="#FFFFFF">&nbsp;</td>
    <td width="58" align="left" bgcolor="#FFFFFF">&nbsp;</td>
  </tr>
</table>
<div id="main">




<DIV ID="seleccion">
  <p>
    <input type="hidden" id="tf_user" value="<? echo $usuario2 ?>">
    <input type="hidden" id="tf_user2" value="<? echo $usuario ?>">
  </p>
  <p>&nbsp;</p>
  <table width="99%" border="1" align="center" cellspacing="0">
    <tr >
    <th colspan="2" align="left" ><img src="img/Logo.png" alt="" width="200" height="70" /></th>
    <td width="146" align="center" >&nbsp;</td>
    <td width="170" align="center" >&nbsp;</td>
    <td width="122" align="center" >&nbsp;</td>
    <td width="64" align="center" >&nbsp;</td>
    <td width="121" align="center" ><img  title="Imprimir" src="../img/imprimir.png" alt=""  width="40" height="40" border="0" align="right" style="cursor:pointer" onclick="imprimir_esto('seleccion')"/></td>
  </tr>
  <tr  class="tittle">
    <td width="192" >Sucursal:</td>
    <td width="240" align="center" ><?
		echo @$hda=$_GET['hda'];
		
        if ($usuario2 == 'general'){
        ?>
      <select name="sl_hac" id="sl_hac" style="width:90%">
        <option value=" ">Todas</option>
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
      <input type="text" readonly="readonly" id="tf_hac" name="tf_hac" style="width:90%" value="<? echo $usuario2 ?>" />
      <?
        }
        ?></td>
    <td align="left" > &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Faturas Pendientes</td>
    <td align="right" >Fecha : Desde: 
      </td>
    <td align="left" ><input  name="tf_fecha" type="text" id="tf_fecha" style="width:80%"  value="<? echo date('Y-m-d') ?>" /> </td>
    <td align="left" >&nbsp; Hasta &nbsp;</td>
    <td align="left" ><input  name="tf_fecha2" type="text" id="tf_fecha2" style="width:80%"  value=""     required pattern=""  oninvalid="setCustomValidity('Esta fecha debe ser MAYOR  a la Inicial')"  onChange="validar('')"/></td>
    </tr>
</table>



<div id="seleccion1" >


 <input type="hidden" id="tf_fecha" value="<? echo $usuario2 ?>">
  <input type="hidden" id="tf_fecha2" value="<? echo $usuario ?>">
<?php





  $f1=$_GET['f1'];
 $f2=$_GET['f2'];
 $fecha= date("Y-m-d");
	
 $hda=$_GET['hda'];
	
	mysql_select_db($database_conexion, $conexion);
 $usuario_nivel;
	  if($usuario_nivel !='general'){
		 
		      if( $usuario_nivel !=''   &&  $f2 =='' ){
				  
				  // echo 1;
	  		 $query_pen = "SELECT DISTINCT factura,cliente,estado,comentario,hacienda,f_pago,concep,f_alarma ,fecha,consec_fact  FROM d89xz_diario WHERE   estado = 'Pendiente' and      
			    			      				concep='Egreso' and		hacienda='$usuario_nivel'    and    fecha >= '$f1' AND fecha <='$f2'     ORDER BY factura desc";
			  }
	
	
	
	    if( $usuario_nivel!=''   &&  $f2 !='' ){
					// echo "2".$usuario_nivel;
						$query_pen = "SELECT DISTINCT factura,cliente,estado,comentario,hacienda,f_pago,concep,f_alarma ,fecha,consec_fact  FROM d89xz_diario WHERE      estado = 'Pendiente'   
						 and  concep='Egreso' and    hacienda='$hda'    ORDER BY factura desc"; 	
			
				  }
	
	
	  }
	  




	  
	    if($usuario_nivel ='general'){
		 // echo $usuario_nivel;
	  			
					if($hda !=' ' && $f2 !='' ) {
					//echo "1";
						$query_pen = "SELECT DISTINCT factura,cliente,estado,comentario,hacienda,f_pago,concep,f_alarma ,fecha,consec_fact  FROM d89xz_diario WHERE  estado = 'Pendiente'   
						 and   concep='Egreso' and   hacienda='$hda'   and    fecha >= '$f1'  AND  fecha <='$f2'   ORDER BY factura desc"; 
				  }
				  
	  
				if($hda ==' ' && $f2 !='' ) {
					//echo "2";
						$query_pen = "SELECT DISTINCT factura,cliente,estado,comentario,hacienda,f_pago,concep,f_alarma ,fecha,consec_fact  FROM d89xz_diario WHERE  estado = 'Pendiente'   
						 and  concep='Egreso' and  fecha >= '$f1'  AND  fecha <='$f2'   ORDER BY factura desc"; 
				  }
				  
				  
				  if( $hda ==''   && $f2 =='' ){
				 //echo "3";
						$query_pen = "SELECT DISTINCT factura,cliente,estado,comentario,hacienda,f_pago,concep,f_alarma ,fecha,consec_fact  FROM d89xz_diario WHERE      estado = 'Pendiente'   and                          concep='Egreso' 					   ORDER BY factura desc"; 	
			
				  }
				  
				    if( $hda !=''   &&  $f2 =='' ){
					//	 echo "4".$usuario_nivel;
						$query_pen = "SELECT DISTINCT factura,cliente,estado,comentario,hacienda,f_pago,concep,f_alarma ,fecha,consec_fact  FROM d89xz_diario WHERE      estado = 'Pendiente'   
						 and  concep='Egreso' and    hacienda='$hda'    ORDER BY factura desc"; 	
			
				  }
				  
	  }


		$pen = mysql_query($query_pen, $conexion) or die(mysql_error());
		$row_pen = mysql_fetch_assoc($pen);
		$totalRows_pen = mysql_num_rows($pen);

//Detalle
			
			$result = mysql_query("SELECT SUM(`valor`) as total FROM  d89xz_diario WHERE `factura` = '$row_pen[factura]' and 
									`hacienda` = '$row_pen[hacienda]'"); 
			$row = mysql_fetch_array($result, MYSQL_ASSOC);
			$total=$row['total'];			
			$tal1 = abs($total);
			
			//el total de abonos
			@$result = mysql_query("SELECT SUM(`abono`) as total FROM  d89xz_abonos WHERE  `orden` = '$row_pen[factura]' and                	 											                                `hacienda`='$row_pen[hacienda]'");$row_abono = mysql_fetch_array($result, MYSQL_ASSOC);
					$total_abono1=$row_abono['total'];
					$total_abono2= abs($total_abono1);
					
			// Saldo
				$saldo1 = $tal1 - $total_abono1;
				$saldo =  number_format($saldo1);
	
	
	
	
	
	
	
?>

<table width="99%" border="1" align="center" cellspacing="0" id="t_suma">
  <tr align="center"   class="tittle" id="tittle">
    <td width="8%">Fecha Ingreso</td>
    <td width="8%">Factura</td>
    <td width="9%">Fecha Pago</td>
    <td width="16%">Cliente/Proveedor</td>
    <td width="20%" >Descripción</td>
    <td width="10%">Sucursal</td>
    <td width="10%">Valor</td>
    <td width="11%">Saldo</td>
    <td width="8%">Abonar</td>
  </tr>
  <?php 
  				$i =1;
  
  do {
	 
	  
	   ?>
   
      <tr class="row" align="center" >
        <td   align="center" onClick="ver('<?php echo $row_pen['consec_fact']; ?>');" ><?php echo $row_pen['fecha']; ?></td>
      <td   align="center" onClick="ver('<?php echo $row_pen['consec_fact']; ?>');"><?php echo $row_pen['factura']; ?></td>
      <td   align="center"  onClick="ver('<?php echo $row_pen['consec_fact']; ?>');"><?php echo $row_pen['f_alarma']; ?></td>
      <td   align="center"  onClick="ver('<?php echo $row_pen['consec_fact']; ?>');">&nbsp; <?php echo $row_pen['cliente']; ?></td>   
      <td  align="center" onClick="ver('<?php echo $row_pen['consec_fact']; ?>');">&nbsp; <?php echo $row_pen['comentario']; ?></td>
      <td  align="center" onClick="ver('<?php echo $row_pen['consec_fact']; ?>');"><?php echo $row_pen['hacienda']; ?></td>
      <td  align="right" onClick="ver('<?php echo $row_pen['consec_fact']; ?>');"><?php 
				  $result12 = mysql_query("SELECT SUM(`valor`) as total FROM  d89xz_diario WHERE `factura` = '$row_pen[factura]' and `hacienda` =                  '$row_pen[hacienda]'"); 
			      $row12 = mysql_fetch_array($result12, MYSQL_ASSOC);
			      $total12=$row12['total'];
	  
	              echo number_format (abs($total12));
	  
	   ?></td>
      <td align="right"> <label id="suma_<?php  echo $i ?>"  class="costo">
      <?
	  //Detalle

			$result = mysql_query("SELECT SUM(`valor`) as total FROM  d89xz_diario WHERE `factura` = '$row_pen[factura]' and `hacienda` = '$row_pen[hacienda]'"); 
			$row = mysql_fetch_array($result, MYSQL_ASSOC);
			$total=$row['total'];
			
			$tal1 = abs($total);
			//el total de abonos
			$result = mysql_query("SELECT SUM(`abono`) as total FROM  d89xz_abonos WHERE  `orden` = '$row_pen[factura]' and `hacienda` = '$row_pen[hacienda]'"); 
			$row_abono = mysql_fetch_array($result, MYSQL_ASSOC);
			$total_abono1=$row_abono['total'];
			$total_abono2= abs($total_abono1);
// Saldo
	$saldo1 = $tal1 - $total_abono1;
	$saldo =  number_format($saldo1);
	  
	  echo $saldo;
	  
	  if ($saldo <= 0){
		  $insertar1 = mysql_query("UPDATE `d89xz_diario` SET `estado`= 'Cancelada' where `factura` = '$row_pen[factura]' and `hacienda` = '$row_pen[hacienda]' ", $conexion);
	  }
	  
	   ?>
      
      </label></td>
      <td  class="row" align="center" style="font-weight: bold"><a rel="shadowbox[ejemplos];options={continuous:true,modal: true}" href="detalle_abono.php?factura=<?php echo $row_pen['factura']; ?>&hacienda=<?php echo $row_pen['hacienda']; ?>"><img src="../img/Calculator.png" width="20" height="20" title="Abonar" /></a></td>
    </tr>
        <?php 
		
		$i ++;
		
		
		} while ($row_pen = mysql_fetch_assoc($pen)); ?>
        
        
        <tr class="row" align="center" >
          <td   align="center" >&nbsp;</td>
          <td   align="center" >&nbsp;</td>
          <td   align="center" >&nbsp;</td>
          <td   align="center" >&nbsp;</td>
          <th  align="center" >&nbsp;</th>
          <td colspan="3"  align="center" >&nbsp;</td>
          <td  class="row" align="center" style="font-weight: bold">&nbsp;</td>
        </tr>
        <tr class="row" align="center" >
        <td   align="center" >&nbsp;</td>
        <td   align="center" >&nbsp;</td>
        <td   align="center" >&nbsp;</td>
        <td   align="center" >&nbsp;</td>
        <th  align="center" >TOTAL</th>
        <td colspan="3"  align="center" ><label id="total_sum"></label>&nbsp;</td>
        <td  class="row" align="center" style="font-weight: bold">&nbsp;</td>
      </tr>

</table>

<p>&nbsp;</p>
<table width="99%" align="center">
  <tr>
    <td align="center"><input name="button2" type="submit" class="ext" id="button2" value="Cancelar" onclick="window.close();" /></td>
  </tr>
</table>
<p>&nbsp;</p>
</div>


</DIV>
</div>

</body>
</html>
<?php
mysql_free_result($pen);
?>
<script>

$(document).ready(function() {
	
	totcosto()
	
});
// -----------------------------ver----------------------------------------------

function ver(c){
	var url = 'compras_fact.php?c='+c.replace(/ /g,"+");
	Shadowbox.open({
     content: url,
     player: "iframe",
     
     options: {                   
          initialHeight: 1,
          initialWidth: 1,
          modal: true		  
    }})
}
//--------------------------------------------------------






function load2(){
	
	
	alert ('hda')
	
	var y = $('#sl_year').val();
	var m = $('#sl_month').val();
	
	var user = $('#tf_user').val();
	var h = '';
	if ( user == 'general'){
		h = $('#sl_hac').val();
	} else {
		h = $('#tf_user').val();	
	}
	console.log ('h:'+h+' t:'+t+' y:'+y+' m:'+m+' d:'+d);	
	
	$('#month').load('dia_dia_pendiente.php?h=' + h.replace(/ /g,"+") + '&y=' + y.replace(/ /g,"+") +
	'&m=' + m.replace(/ /g,"+")  +' #month ' );
	

	
	$('#seleccion1').load('dia_dia_pendiente.php?h=' + h.replace(/ /g,"+") + '&y=' + y.replace(/ /g,"+") +
	'&m=' + m.replace(/ /g,"+")  +' #seleccion1 ' );
	
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
	

	
	$('#table').load('dia_dia_pendiente.php?h=' + h.replace(/ /g,"+") + '&y=' + y.replace(/ /g,"+") +
	'&m=' + m.replace(/ /g,"+") +'&d=' + d.replace(/ /g,"+") +'&t=' + t.replace(/ /g,"+") +' #seleccion1' );
	if (m == ''){
		//console.log('m:'+m);
		$('#day').hide();
		$('#sl_day').val('');
	}else{
		//console.log('m:'+m);
		$('#day').show();
	}	
}




// Recargar
$('#sl_hac').change(function(){
		var f1=$('#tf_fecha').val();
	var f2=$('#tf_fecha2').val();
	var hda=$('#sl_hac').val();
	//alert (hda)
	//alert (ano)
	$('#seleccion1').load('dia_dia_pendiente.php?hda=' + hda.replace(/ /g,"+") +'&f1=' + f1.replace(/ /g,"+") +'&f2=' + f2.replace(/ /g,"+")  +' #seleccion1 ' );
	
})

//funcion para imprimir la pantalla
function imprimir_esto(id_tabla){
	$("#"+id_tabla).printThis({
	     debug: false,          
	     importCSS: true,           
         printContainer: true,      				         
		 loadCSS: "../css/style-print.css", 
         pageTitle: "",             
         removeInline: false       
	  });
}


     <!-- Validar fechas de formulario-->
/*function validar() {
	var fecha1=$('#tf_fecha').val();
	var fecha2=$('#tf_fecha2').val();
	//alert(fecha2)
	

  if(fecha2 < fecha1){ 
  	$('#tf_fecha').attr('pattern','[xxx]');
	//alert('ok')
	$('#twoDates')[0].find(':submit').click();
	
  }else{ $('#datepicker2').removeAttr('pattern');  }
  
  return($dateEnd >= $dateStart);
}*/


// Recargar
$('#tf_fecha2').change(function(){
	var f1=$('#tf_fecha').val();
	var f2=$('#tf_fecha2').val();
	//var hda=$('#sl_hac').val();
	//alert (hda)
	//alert (f1)
var user = $('#tf_user').val();
//alert(user)	
if ( user == 'general'){
		hda = $('#sl_hac').val();
	} else {
		hda= $('#tf_user').val();	
	}
	
		//console.log ('h:'+f1+' t:'+f2+' y:'+hda);
	
	$('#seleccion1').load('dia_dia_pendiente.php?hda=' + hda.replace(/ /g,"+") +'&f1=' + f1.replace(/ /g,"+") +'&f2=' + f2.replace(/ /g,"+")  +' #seleccion1 ', 
	function(response, status, xhr){
		//console.log('r:'+response+' s:'+status+' x: '+xhr);
		//console.log(status);	
		if (status == 'success'){
			totcosto();
				
		}
	});
	
})

$('#tf_fecha').change(function(){
	var f1=$('#tf_fecha').val();
	var f2=$('#tf_fecha2').val();
	//var hda=$('#sl_hac').val();
	//alert (hda)
	//alert (f1)
var user = $('#tf_user').val();
//alert(user)	
if ( user == 'general'){
		hda = $('#sl_hac').val();
	} else {
		hda= $('#tf_user').val();	
	}
	
		//console.log ('h:'+f1+' t:'+f2+' y:'+hda);
	
	$('#seleccion1').load('dia_dia_pendiente.php?hda=' + hda.replace(/ /g,"+") +'&f1=' + f1.replace(/ /g,"+") +'&f2=' + f2.replace(/ /g,"+")  +' #seleccion1 ' , 
	function(response, status, xhr){
		//console.log('r:'+response+' s:'+status+' x: '+xhr);
		//console.log(status);	
		if (status == 'success'){
			totcosto();
				
		}
	});
	
})



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
	$( "#tf_fecha").datepicker();
	$( "#tf_fecha2").datepicker();
	
	/// ----------------------------------------------Sumar Campos ________________________________________///
	
	function totcosto(){
	//console.log('totcosto');
	var total = new Number();
	var $table = $('#t_suma tr:not(#tittle)').closest('table');  		
	$table.find('.costo').each(function() {
		//var cant = new Number($.trim($(this).text()));
		var id = $(this).attr('id');	
		var n = id.substr(5);
		//console.log('n:'+n);
		n = $.trim('suma_'+n);
		//console.log(n);
		var costo = new Number ($.trim(($('#'+n).text()).replace(/\,/g, '')));
		//console.log('co: '+costo);
		//console.log(typeof(costo));
		total = costo + parseFloat(total);
	});
	
	$('#total_sum').text(commaSeparateNumber(total));
}
	


function commaSeparateNumber(val){
    while (/(\d+)(\d{3})/.test(val.toString())){
      val = val.toString().replace(/(\d+)(\d{3})/, '$1'+','+'$2');
    }
    return val;
  }
	
	
</script>