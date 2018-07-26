<?php require_once('joom.php'); ?>
<?php require_once('../Connections/conexion.php'); ?>
<?php
if ($acceso !='0'){ 
//echo "hola ". $acceso;
?>
  <p>&nbsp;</p>
  <p>&nbsp;</p>
<table width="70%" align="center">
  <tr>
    <td align="center"><img src="../img/Logo.png" width="500" height="248" /></td>
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
@$nombree=$_GET['n'];

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
<title>Historial</title>
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




<script type="text/javascript">
Shadowbox.init({	 
    handleOversize: "drag",
    modal: true,
	onOpen: function() {
		$('#sb-info').after($('#sb-wrapper-inner'));
		$('#sb-wrapper-inner').after($('#sb-title'));
	},
	
});




</script>
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
  <input type="hidden" id="tf_user" value="<?php  echo $usuario2 ?>">
  <input type="hidden" id="tf_user2" value="<?php  echo $usuario ?>">
  <input type="hidden" id="nombree" value="<?php  echo $nombree ?>">

  <DIV ID="seleccion">

<table width="98%"  align="center" id="table_header">
  <tr>
    <td colspan="1" align="left" >
    <img src="../../img/Logo.png" alt="logo" name="logo" width="201" height="74" id="logo" />
    </td>
    <td colspan="3" align="right" valign="baseline">
    <input type="image" title="Imprimir" src="../img/imprimir.png" alt="" 
    width="48" height="48" border="0"  style="cursor:pointer" onclick="imprimir_esto('seleccion')" >
    
  
    </td>
    </tr>
</table>
<p>&nbsp;</p>
<table width="98%" border="1" align="center" cellspacing="0">
  <tr  class="tittle">
    <td width="182" >Empleado</td>
    <td width="233" align="center" ><?= @$hda=$_GET['hda'];
		
        if ($usuario2 == 'general'){
        ?>
      <select name="sl_hac2" id="sl_hac2" style="width:90%">
        <option value=" ">Todas</option>
        <?php
        mysql_select_db($database_conexion, $conexion);
        $query_hac = "SELECT DISTINCT `hacienda` as hacienda , `hacienda` as hacienda1 FROM 
        `d89xz_hacienda` WHERE `delete`=0 order by hacienda";
        $hac = mysql_query($query_hac, $conexion) or die(mysql_error());
        while ($row_hac = mysql_fetch_assoc($hac)){
        ?>
        <option value="<?= $row_hac['hacienda']?>">
          <?= $row_hac['hacienda1']?>
          </option>
        <?php
        } 
        ?>
      </select>
      <?php 
        }else{
        ?>
      <input type="text" readonly id="tf_hac2" name="tf_hac" style="width:90%" value="<?= $rfid ?>" />
      <?php
        }
        ?></td>
    <td width="65" align="left" >&nbsp;</td>
    <td width="148" align="left" >&nbsp;</td>
    <td width="79" align="right" > Desde </td>
    <td width="145" align="left" ><input  name="tf_fecha" type="text" id="tf_fecha" style="width:80%"  value="<?= date('Y-m-d',strtotime('-1 day')) ?>" /></td>
    <td width="56" align="left" >&nbsp; Hasta &nbsp;</td>
    <td width="150" align="left" ><input  name="tf_fecha2" type="text" id="tf_fecha2" style="width:80%"       oninvalid="setCustomValidity('Esta fecha debe ser MAYOR  a la Inicial')"    value="<?= date('Y-m-d') ?>"/></td>
  </tr>
</table>
<div id="table" >    
<table width="98%" border="1" align="center" cellspacing="0">
    <tr>
    <td colspan="11" align="center" class="tittle">
    <label style="font-size:18px">
    Reporte  de Asistencia</label> </td>
    </tr>
    <tr class="tittle" style="font-size: 13px; ">
      <td width="78" rowspan="2" align="center" >Fecha</td>
      <td colspan="8" align="center" >HORAS</td>
      <td width="287" rowspan="2" align="center" >Comentario</td>
    </tr>
    <tr class="tittle" style="font-size: 13px; ">
    <td width="55" align="center" >Entrada</td>
    <td width="87" align="center" >Salida</td>
    <td width="92" align="center" >Almuerzo</td>
    <td width="105" align="center" ><span style="font-size: 13px">Ordinarias</span></td>
    <td width="78" align="center" >Extras</td>
    <td width="80" align="center" > Totales</td>
    <td width="89" align="center" >Permiso</td>
    <td width="104" align="center" >Incapacidad</td>
    </tr>
	<?php 
	
 @$f1=$_GET['f1'];
 @$f2=$_GET['f2'];
 @$fecha= date("Y-m-d");
 @$hda=$_GET['hda'];
 @$concep=$_GET['h'];
 	mysql_select_db($database_conexion, $conexion);	
		//echo "-1a-".$hac_url;
	$query_basc = "SELECT * FROM `nomina_ingreso`  WHERE `cedula`='$hac_url' and fecha >= '$f1'  AND  fecha <='$f2'
		  order by fecha desc  ";

	$basc = mysql_query($query_basc, $conexion) or die(mysql_error());
   	$num = mysql_num_rows($basc);
    while($row_basc = mysql_fetch_assoc($basc)){

    ?>
    
    <!-- aca se asignan las propiedades que tendran las filas -->
    <!-- mostrar('../caja/basc_form.php?consec=')-->
    <tr align="center" style="color: #000; font-size: 10px;"  class="row" >
    <td  ><?php  echo $row_basc['fecha']; ?></td>
    <td  ><?php  echo $row_basc['inicio']; ?></td>
    <td  ><?php  echo $row_basc['final']; if($row_basc['final']=='00:00:00'){ ?>
    
    <img src="../nomina/img/edit.png" width="15" height="15" title="Editar Asistencia"  onclick="mostrar2('<?php echo $nombree?>','<?php echo $row_basc['id']?>')" >
    <?php }?>
   </td>
     
    <td  ><?php  echo $row_basc['entalmuer']; ?></td>
    <td  ><?php  echo $row_basc['hnormales']; ?></td>
    <td  ><?php  echo $row_basc['hextras']; ?></td>
    <td  ><?php  echo $row_basc['htotales']; ?></td>
    <td  ><?php  echo $row_basc['permisos']; ?></td>
    <td  ><?php  echo $row_basc['incapacidad']; ?></td>
    <td  ><?php  echo $row_basc['comen']; ?></td>
    </tr>
   <?php 
    //linea para repetir el while mientras se cumpla la siguiente condicion
    }
    ?>  
    <tr align="center" class="row">
      <th  >
      <td  >      
      <td  >      
      <td  >TOTAL:
      <td class="row" ><?php 
	  //echo $year_url.'-'.$month_url.'-'.$day_url.'-'.$tipo_url.'-'.$hac_url ;
	  //$juli = mysql_query("SELECT SUM(`v_tal`) as total FROM nomina_ingreso where  YEAR(fecha) = '2014' AND                 MONTH(fecha) = '01' AND concep = 'Egreso'and estado!='Cancelada' and estado!='Pendiente'",$conexion);
	  
	  
	  
	  
	  
	  
	  
	mysql_select_db($database_conexion, $conexion);
	$juli = mysql_query("SELECT SUM(`hnormales`) as total FROM `nomina_ingreso` WHERE `cedula`='$hac_url'  
	and fecha >= '$f1'  AND  fecha <='$f2' ORDER BY `fecha` DESC",$conexion);  
    @$row07 = mysql_fetch_array($juli, MYSQL_ASSOC);
    @$Total= number_format ($row07["total"]);
    echo $Total;
	?></td>
      <td class="row" ><?php 
	
	 mysql_select_db($database_conexion, $conexion);
	$juli = mysql_query("SELECT SUM(`hextras`) as total FROM `nomina_ingreso` WHERE `cedula`='$hac_url' 
	and fecha >= '$f1'  AND  fecha <='$f2' ORDER BY `fecha` DESC",$conexion);  
    @$row07 = mysql_fetch_array($juli, MYSQL_ASSOC);
    @$Total= number_format ($row07["total"]);
    echo $Total;
	
	?></td>
      <td  class="row"  ><?php 
	  
		
	$juli = mysql_query("SELECT SUM(`htotales`) as total FROM `nomina_ingreso` WHERE `cedula`='$hac_url' 
	and fecha >= '$f1'  AND  fecha <='$f2' ORDER BY `fecha` DESC",$conexion);  
    
    @$row07 = mysql_fetch_array($juli, MYSQL_ASSOC);
    @$Total= number_format ($row07["total"]);
    echo $Total;
	?></td>
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
	carga();
	
	//load2();

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


// Recargar fechas
$('#tf_fecha2').change(function(){
	var f1=$('#tf_fecha').val();
	var f2=$('#tf_fecha2').val();
	var hda=$('#sl_hac').val();
	//alert (hda)
	//alert (f1)
var user = $('#tf_user').val();
//alert(user)	
if ( user == 'general'){
		hda = $('#sl_hac').val();
	} else {
		hda= $('#tf_user').val();	
	}
	
	var concep=$('#tf_user').val();
	console.log ('h:'+f1+' t:'+f2+' y:'+hda+' concep:'+concep);
	
	$('#table').load('basc_hist.php?hda=' + hda.replace(/ /g,"+") +'&f1=' + f1.replace(/ /g,"+") +'&f2=' + f2.replace(/ /g,"+")+'&h=' + concep.replace(/ /g,"+")  +' #table ' , 
	function(response, status, xhr){
		//console.log('r:'+response+' s:'+status+' x: '+xhr);
		//console.log(status);	
		if (status == 'success'){
			//totcosto();
				
		}
	});
	
})

$('#tf_fecha').change(function(){
	var f1=$('#tf_fecha').val();
	var f2=$('#tf_fecha2').val();
	var user = $('#tf_user').val();
	
	if ( user == 'general'){
			hda = $('#sl_hac').val();
		} else {
			hda= $('#tf_user').val();	
	}
	
	var concep=$('#tf_user').val();
	console.log ('h:'+f1+' t:'+f2+' y:'+hda+' concep:'+concep);
	
	$('#table').load('basc_hist.php?hda=' + hda.replace(/ /g,"+") +'&f1=' + f1.replace(/ /g,"+") +'&f2=' + f2.replace(/ /g,"+")+'&h=' + concep.replace(/ /g,"+")  +' #table ' , 
	function(response, status, xhr){
		//console.log('r:'+response+' s:'+status+' x: '+xhr);
		//console.log(status);	
		if (status == 'success'){
			//totcosto();
				
		}
	});	
})

function carga(){
	var f1=$('#tf_fecha').val();
	var f2=$('#tf_fecha2').val();
	var user = $('#tf_user').val();
	
	if ( user == 'general'){
			hda = $('#sl_hac').val();
		} else {
			hda= $('#tf_user').val();	
	}
	
	var concep=$('#tf_user').val();
	console.log ('h:'+f1+' t:'+f2+' y:'+hda+' concep:'+concep);
	
	$('#table').load('basc_hist.php?hda=' + hda.replace(/ /g,"+") +'&f1=' + f1.replace(/ /g,"+") +'&f2=' + f2.replace(/ /g,"+")+'&h=' + concep.replace(/ /g,"+")  +' #table ' , 
	function(response, status, xhr){
		//console.log('r:'+response+' s:'+status+' x: '+xhr);
		//console.log(status);	
		if (status == 'success'){
			//totcosto();
				
		}
	});	
}
	
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


function mostrar2(nombre,id){

/*alert(nombre)
alert(id)*/
var url = 'correo_notifi_horas.php?id=' + id+'&nombre='+nombre;
	Shadowbox.open({
     content: url,
     player: "iframe",
     
     options: {                   
          initialHeight: 1,
          initialWidth: 1,
          modal: true		  
    }})
	

}

//funcion para imprimir la pantalla
function imprimir_esto(id_tabla){
	$("#"+id_tabla).printThis({
	     debug: false,          
	     importCSS: true,           
         printContainer: true,      				         
		 loadCSS: "../css/style-print.css", 
         pageTitle: "",             
         removeInline: false,
				 removebuttons: true,       
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
