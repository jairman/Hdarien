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

@$day_url=$_GET['d'];
@$month_url=$_GET['m'];
@$year_url=$_GET['y'];
$idc_url=$_GET['id'];

@$hac_url=$_GET['h'];
@$tipo_url=$_GET['t'];


mysql_select_db($database_conexion, $conexion);
@$query_clien = sprintf("SELECT * FROM d89xz_prove WHERE id ='$idc_url'", GetSQLValueString($colname_clien, "int"));
$clien = mysql_query($query_clien, $conexion) or die(mysql_error());
$row_clien = mysql_fetch_assoc($clien);
$totalRows_clien = mysql_num_rows($clien);
$id=$row_clien['cedula'];
$c_ced = $row_clien['cedula'];
$c_nombre = $row_clien['nombre'];

/*------------------------------------------------------------------------------------------------------------------------*/
/*$queEmp ="SELECT * FROM d89xz_diario where comentario LIKE '%Factura de Venta No:%'";
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
<link href="../css/clean.css" rel="stylesheet" type="text/css" />
<link href="../css/shadowbox.css" rel="stylesheet" type="text/css" />
<link href="../css/style.css" rel="stylesheet" type="text/css" />
<script src="../js/shadowbox.js" type="text/javascript"></script>
<script src="../js/jquery.validate.js" type="text/javascript"></script>

<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.3.1/jquery.min.js"></script>
<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.8.18/jquery-ui.min.js"></script>
<script type="text/javascript" src="//ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
<script type="text/javascript" src="http://code.jquery.com/ui/1.10.3/jquery-ui.js"></script>
<script src="../js/printThis.js" type="text/javascript"></script>


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

</head>
<body>

<table width="98%" border="0" align="center" cellspacing="0">
  <tr >
    <td width="858" align="left" ><div id="menu">
     <ul >
      <ul>
        <li><a href="../PrincipalCP/prove/verProve.php?id=<?php echo $idc_url ?>" >Información del Provedor</a></li>
        <li><a href="../PrincipalCP/prove/compras_ini.php?id=<?php echo $idc_url ?>">Historial de Facturación</a></li>
        <li> <a href="dia_dia_pendiente_prove.php?id=<?php echo $idc_url ?>"  class='active'>Cuentas Por Pagar</a> </li>
           
           
         
        
          </ul>
        </ul>
    </div>     </td>
    <td width="94" align="center">&nbsp;</td>
    <td width="58" align="left" >&nbsp;</td>
  </tr>
</table>
<div id="main">




<DIV ID="seleccion2">
  <p>
    <input type="hidden" id="tf_user" value="<?php echo $usuario2 ?>">
    <input type="hidden" id="tf_user2" value="<?php echo $usuario ?>">
    <input type="hidden" id="id" value="<?php echo $id ?>">
  </p>
 
  <p>&nbsp;</p>
<p>&nbsp;</p>
<table width="99%" border="1" align="center">
<tr>
<td><img src="../img/Logo.png" alt="" width="200" height="70" /></td>
<td align="center"><input name="imgb" type="image"  title="Imprimir" src="../img/imprimir.png" alt=""  width="40" height="40" border="0" align="right" style="cursor:pointer" onclick="imprimir_esto('seleccion2')"/></td>
</tr>
<tr>
<td colspan="2"  class="tittle">Cuentas Por Pagar</td>
</tr>
</table>

<table width="99%" border="1" align="center" cellspacing="0">
  <tr  class="subtitle">
    <th align="left" class="bold" >Nombre</th>
<td colspan="2" align="center" ><?php  echo $c_nombre?></td>
    <td width="94" align="left" class="bold" >Cedula</td>
    <td width="152" align="center" ><?php echo $c_ced ?></td>
    <td width="58" align="center" >&nbsp;</td>
    <td width="159" align="center" >&nbsp;</td>
</tr>
  <tr  class="subtitle">
    <td width="149"  class="bold">Punto de Venta </td>
    <td width="192" align="center" ><?php
		echo @$hda=$_GET['hda'];
		
        if ($usuario2 == 'general'){
        ?>
      <select name="sl_hac" id="sl_hac" style="width:90%">
        <option value=" ">Seleccione</option>
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
      <input type="text" readonly="readonly" id="tf_hac" name="tf_hac" style="width:90%" value="<?php echo $usuario2 ?>" />
      <?php
        }
        ?></td>
    <td width="144" align="center" > &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
    <td align="left" class="bold" >  Desde  </td>
    <td align="center" ><input  name="tf_fecha" type="text" id="tf_fecha" style="width:80%"  value="<?php echo date('Y-m-d') ?>" /> </td>
    <td align="left" class="bold" >&nbsp; Hasta &nbsp;</td>
    <td align="center" ><input  name="tf_fecha2" type="text" id="tf_fecha2" style="width:80%"       oninvalid="setCustomValidity('Esta fecha debe ser MAYOR  a la Inicial')"    value="<?php echo date('Y-m-d') ?>"/></td>
</tr>
</table>



<div id="seleccion11" >


 <input type="hidden" id="tf_fecha" value="<?php echo $usuario2 ?>">
  <input type="hidden" id="tf_fecha2" value="<?php echo $usuario ?>">
  <input type="hidden" id="id" value="<?php echo $id ?>">
<?php





 @$f1=$_GET['f1'];
 @$f2=$_GET['f2'];
 @$fecha= date("Y-m-d");
 $id=$_GET['id'];
	
 @$hda=$_GET['hda'];
	
	mysql_select_db($database_conexion, $conexion);
 $usuario_nivel;
	  if($usuario_nivel !='general'){
		 
		      if( $usuario_nivel !=''   &&  $f2 =='' ){
				  
				  echo "1".$usuario_nivel;
	  		 $query_pen = "SELECT DISTINCT factura,cliente,estado,comentario,hacienda,f_pago,concep,f_alarma ,fecha,consec_fact  FROM d89xz_diario WHERE   estado = 'Pendiente' and  concep='Egreso' and	hacienda='$usuario_nivel' and cedula='$id'         ORDER BY factura desc";
			  }
	
	
	
	    if( $usuario_nivel!='general'   &&  $f2 !='' ){
			echo "2".$usuario_nivel.'-'.$f1.'-'.$f2;
			$query_pen = "SELECT DISTINCT factura,cliente,estado,comentario,hacienda,f_pago,concep,f_alarma       		    				,fecha,consec_fact  FROM d89xz_diario WHERE      estado = 'Pendiente'   
						 and  concep='Egreso' and    hacienda='$usuario_nivel' and    fecha >= '$f1'  AND  fecha <='$f2'                   and cedula='$id'       ORDER BY factura desc"; 	
			
				  }
	
	
	  }
	  




	  
	    if($usuario_nivel =='general'){
		  //echo $usuario_nivel;
	  			
					if($hda !=' ' && $f2 !='' ) {
					//echo "1";
						$query_pen = "SELECT DISTINCT factura,cliente,estado,comentario,hacienda,f_pago,concep,f_alarma ,fecha,consec_fact  FROM d89xz_diario WHERE  estado = 'Pendiente'   
						 and   concep='Egreso' and   hacienda='$hda'   and    fecha >= '$f1'  AND  fecha <='$f2'  and cedula='$id' ORDER BY factura desc"; 
				  }
				  
	  
				if($hda ==' ' && $f2 !='' ) {
					//echo "2";
						$query_pen = "SELECT DISTINCT factura,cliente,estado,comentario,hacienda,f_pago,concep,f_alarma ,fecha,consec_fact  FROM d89xz_diario WHERE  estado = 'Pendiente'   
						 and  concep='Egreso' and  fecha >= '$f1'  AND  fecha <='$f2' and cedula='$id'   ORDER BY factura desc"; 
				  }
				  
				  
				  if( $hda ==''   && $f2 =='' ){
				// echo "3".$id;
						$query_pen = "SELECT DISTINCT factura,cliente,estado,comentario,hacienda,f_pago,concep,f_alarma ,fecha,consec_fact  FROM d89xz_diario WHERE      
						estado = 'Pendiente'   and concep='Egreso' and cedula='$row_clien[cedula]' 	ORDER BY factura desc"; 	
			
				  }
				  
				    if( $hda !=''   &&  $f2 =='' ){
					//echo "4".$usuario_nivel;
						$query_pen = "SELECT DISTINCT factura,cliente,estado,comentario,hacienda,f_pago,concep,f_alarma ,fecha,consec_fact  FROM d89xz_diario WHERE      estado = 'Pendiente'   
						 and  concep='Egreso' and    hacienda='$hda' and cedula='$id'    ORDER BY factura desc"; 	
			
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
    <td width="7%">Fecha </td>
    <td width="11%">Factura No</td>
    <td width="13%">Punto de Venta</td>
    <td colspan="2">  Fecha Pago</td>
    <td width="30%">Descripción</td>
    <td width="7%">Valor</td>
    <td width="7%">Saldo</td>
    <td width="6%">Abonar</td>
    <td width="4%">&nbsp;</td>
  </tr>
  <?php 
  				$i =1;
  
  do {
	 
	  
	   ?>
   
      <tr class="row" align="center" >
        <td   align="center" onClick="mostrar('compras_fact.php?c=<?php echo $row_pen['consec_fact'] ?>&p=<?php echo $row_pen['hacienda'] ?>&factura=<?php echo $row_pen['factura'] ?>')"><?php echo $row_pen['fecha']; ?></td>
      <td   align="center" onClick="mostrar('compras_fact.php?c=<?php echo $row_pen['consec_fact'] ?>&p=<?php echo $row_pen['hacienda'] ?>&factura=<?php echo $row_pen['factura'] ?>')"><?php echo $row_pen['factura']; ?></td>
      <td   align="center" onClick="mostrar('compras_fact.php?c=<?php echo $row_pen['consec_fact'] ?>&p=<?php echo $row_pen['hacienda'] ?>&factura=<?php echo $row_pen['factura'] ?>')" ><?php echo $row_pen['hacienda']; ?></td>
      <td colspan="2"   align="center" onClick="mostrar('compras_fact.php?c=<?php echo $row_pen['consec_fact'] ?>&p=<?php echo $row_pen['hacienda'] ?>&factura=<?php echo $row_pen['factura'] ?>')" >&nbsp;<?php echo $row_pen['f_alarma']; ?></td>   
      <td  align="center" onClick="mostrar('compras_fact.php?c=<?php echo $row_pen['consec_fact'] ?>&p=<?php echo $row_pen['hacienda'] ?>&factura=<?php echo $row_pen['factura'] ?>')" ><?php echo $row_pen['comentario']; ?></td>
      <td  align="right" onClick="mostrar('compras_fact.php?c=<?php echo $row_pen['consec_fact'] ?>&p=<?php echo $row_pen['hacienda'] ?>&factura=<?php echo $row_pen['factura'] ?>')"><?php 
				  $result12 = mysql_query("SELECT SUM(`valor`) as total FROM  d89xz_diario WHERE `factura` = '$row_pen[factura]' and `hacienda` =                  '$row_pen[hacienda]'"); 
			      $row12 = mysql_fetch_array($result12, MYSQL_ASSOC);
			      $total12=$row12['total'];
	  
	              echo number_format (abs($total12));
	  
	   ?></td>
      <td align="right" > <label id="suma_<?php  echo $i ?>"  class="costo">
      <?php
	  //Detalle

			$result = mysql_query("SELECT SUM(`valor`) as total FROM  d89xz_diario WHERE `factura` = '$row_pen[factura]' and `hacienda` = '$row_pen[hacienda]'"); 
			$row = mysql_fetch_array($result, MYSQL_ASSOC);
			$total=$row['total'];
			
			$tal1 = abs($total);
			//el total de abonos
			$result = mysql_query("SELECT SUM(`abono`) as total FROM  d89xz_abonos WHERE  `orden` = '$row_pen[factura]' and `hacienda` = '$row_pen[hacienda]'"); 
			$row_abono = mysql_fetch_array($result, MYSQL_ASSOC);
			@$total_abono1=$row_abono['total'];
			@$total_abono2= abs($total_abono1);
// Saldo
	@$saldo1 = $tal1 - $total_abono1;
	@$saldo =  number_format($saldo1);
	  
	  echo $saldo;
	/*____________________________________Termino de abono Cancela Factura-------------------------------*/  
	  if ($saldo <= 0){
			
	 /*$insertar1 = mysql_query("UPDATE `d89xz_diario` SET `estado`= 'Cancelada' where `factura` = '$row_pen[factura]' and `hacienda` = '$row_pen[hacienda]' ", $conexion);
	 
	 			mysql_select_db($database_conexion, $conexion);
				$query_prove = "SELECT * FROM `d89xz_diario` where `factura` = '$row_pen[factura]' ";
				$prove = mysql_query($query_prove, $conexion) or die(mysql_error());
				$row_prove = mysql_fetch_assoc($prove);
				$totalRows_prove = mysql_num_rows($prove);
				$consec_fact=$row_prove['consec_fact'];
	 
	 
	 	 $insertar2 = mysql_query("UPDATE `h01sg_venta` SET `delete`= '9' where `consec`='$consec_fact' and `punto_venta`= '$row_pen[hacienda]' ", $conexion);
*/	 
	 
	 
	  }
	  

	
		
		
/*____________________________________________________________________________________________________________*/		
	   ?>
      
      </label></td>
      
      <td  align="center" onClick="mostrar('detalle_abono.php?factura=<?php echo $row_pen['factura']; ?>&hacienda=<?php echo $row_pen['hacienda']; ?>&concep=<?php echo $row_pen['concep']; ?>&cliente=<?php echo $row_pen['cliente']; ?>')" ><input name="imgb" type="image" src="../img/Calculator.png" width="25" height="25" title="Abonar"  class="calc"/></td>
      
<td   align="center" >&nbsp;</td>
    </tr>
        <?php 
		
		$i ++;
		
		
		} while ($row_pen = mysql_fetch_assoc($pen)); ?>
        
        
        <tr class="row" align="center" >
          <td   align="center" >&nbsp;</td>
          <td   align="center" >&nbsp;</td>
          <td   align="center" >&nbsp;</td>
          <td width="8%"   align="center" >&nbsp;</td>
          <th width="7%"  align="center" >&nbsp;</th>
          <td colspan="3"  align="center" >&nbsp;</td>
          <td  class="row" align="center" style="font-weight: bold">&nbsp;</td>
<td  class="row" align="center" style="font-weight: bold">&nbsp;</td>
        </tr>
        <tr class="row" align="center" >
        <td   align="center" >&nbsp;</td>
        <td   align="center" >&nbsp;</td>
        <td   align="center" >&nbsp;</td>
        <td   align="center" >&nbsp;</td>
        <th  align="center" >TOTAL</th>
        <td colspan="3"  align="center" ><label id="total_sum"></label>&nbsp;</td>
        <td   align="center" style="font-weight: bold">&nbsp;</td>
<td   align="center" style="font-weight: bold">&nbsp;</td>
      </tr>

</table>

<p>&nbsp;</p>
<table width="99%" align="center">
  <tr>
    <td align="center"><input name="button2" type="button" class="ext" id="button2" value="Cancelar" onclick="window.close();" /></td>
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


Shadowbox.init({
handleOversize: "drag",
modal: true,

onOpen: function() {
		$('#sb-info').after($('#sb-wrapper-inner'));
		$('#sb-wrapper-inner').after($('#sb-title'));
	},


onClose: function(){
		$('#seleccion').load('dia_dia_pendiente_prove.php' + ' #seleccion ' );
				  }
});


// -----------------------------ver----------------------------------------------

function ver(c){
	var url = 'fact.php?c='+c.replace(/ /g,"+");
	Shadowbox.open({
     content: url,
     player: "iframe",
     
     options: {                   
          initialHeight: 1,
          initialWidth: 1,
          modal: true		  
    }})
}
function mostrar(url) {

Shadowbox.open({
content: url,
player: "iframe",
options: {  modal: true	
}})
}

//--------------------------------------------------------



function load2(){
	
	
//	alert ('hda')
	
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
	
	$('#month').load('dia_dia_pendiente_prove.php?h=' + h.replace(/ /g,"+") + '&y=' + y.replace(/ /g,"+") +
	'&m=' + m.replace(/ /g,"+")  +' #month ' );
	

	
	$('#seleccion11').load('dia_dia_pendiente_prove.php?h=' + h.replace(/ /g,"+") + '&y=' + y.replace(/ /g,"+") +
	'&m=' + m.replace(/ /g,"+")  +' #seleccion11 ' );
	
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
	

	
	$('#table').load('dia_dia_pendiente_prove.php?h=' + h.replace(/ /g,"+") + '&y=' + y.replace(/ /g,"+") +
	'&m=' + m.replace(/ /g,"+") +'&d=' + d.replace(/ /g,"+") +'&t=' + t.replace(/ /g,"+") +' #seleccion11' );
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
	var id=$('#id').val();
	//alert (id)
	//alert (ano)
	$('#seleccion11').load('dia_dia_pendiente_prove.php?hda=' + hda.replace(/ /g,"+") +'&f1=' + f1.replace(/ /g,"+") +'&f2=' + f2.replace(/ /g,"+")  + '&id=' + id.replace(/ /g,"+")  + ' #seleccion11 ', 
	function(response, status, xhr){
		//console.log('r:'+response+' s:'+status+' x: '+xhr);
		//console.log(status);	
		if (status == 'success'){
			totcosto();
				
		}
	});
	
	
})

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
	var id=$('#id').val();
	//alert (id)
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
	
	$('#seleccion11').load('dia_dia_pendiente_prove.php?hda=' + hda.replace(/ /g,"+") +'&f1=' + f1.replace(/ /g,"+") +'&f2=' + f2.replace(/ /g,"+")+ '&id=' + id.replace(/ /g,"+")    +' #seleccion11 ' , 
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
	var id=$('#id').val();
	//alert (id)
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
	
	$('#seleccion11').load('dia_dia_pendiente_prove.php?hda=' + hda.replace(/ /g,"+") +'&f1=' + f1.replace(/ /g,"+") +'&f2=' + f2.replace(/ /g,"+")  + '&id=' + id.replace(/ /g,"+")  +' #seleccion11 ' , 
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
		//alert(total)
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