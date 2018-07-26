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
///////////////////////HORA LOCAL////////////////////////
function hora_local($zona_horaria = 0)
{
	if ($zona_horaria > -12.1 and $zona_horaria < 12.1)
	{
		$hora_local = time() + ($zona_horaria * 3600);
		return $hora_local;
	}
	return 'error';
}

 $hora=gmdate('H:i:s', hora_local(-5));

 $fecha=gmdate('Y-m-d', hora_local(-5));

$editFormAction = $_SERVER['PHP_SELF'];
if (isset($_SERVER['QUERY_STRING'])) {
  $editFormAction .= "?" . htmlentities($_SERVER['QUERY_STRING']);
}
//////////////////////////////////////////////////////////////////////////
if ((isset($_POST["MM_insert"])) && ($_POST["MM_insert"] == "form2")) {
	
////////////////////////////COMPROBAR EMPLEADO///////////////////////////
mysql_select_db($database_conexion, $conexion);
$query_cot1 = "SELECT * FROM nomina_valle WHERE rfid = '$_POST[documento]'";
$cot1 = mysql_query($query_cot1, $conexion) or die(mysql_error());
$row_cot1 = mysql_fetch_assoc($cot1);
$totalRows_cot1 = mysql_num_rows($cot1);	
$rfid=$row_cot1['rfid'];
$unico=$row_cot1['cedula'];
$haci=$row_cot1['hacienda'];
	
//////////////////////////////////////////////////////////////////////////////////77	
	
if($rfid != ''){///////////////////////SALIDA //////////////////////////////////////////
	mysql_select_db($database_conexion, $conexion);
	$query_det = sprintf("SELECT * FROM nomina_ingreso WHERE cedula ='$_POST[documento]' order by fecha desc");
	$det = mysql_query($query_det, $conexion) or die(mysql_error());
	$row_det = mysql_fetch_assoc($det);
	//
	////////////////////////////////////////ENTRADA ALMUERZO ///////////////////////////////////////////////////
	if ( $row_det['h_sali'] !=' ' && $row_det['h_entrad'] =' ' ){
	
	
		             ///////////////////Horas almuerzo/////////////////////////////////////
						 $h1=substr($row_det['h_sali'],0,-3);
						  $m1=substr($row_det['h_sali'],3,2);//minutos
						 $h2=substr($hora,0,-3);
						  $m2=substr($hora,3,2);//minutos actual
						 $ini=(($h1*60)*60)+($m1*60);
						 $fin=(($h2*60)*60)+($m2*60);
						 $dif=$fin-$ini;
						 $difh=floor($dif/3600);
						 $difm=floor(($dif-($difh*3600))/60);
						//return date("H:i:s",mktime($difh,$difm,'00'));
						
						$htotales=$difh.':'.$difm;
$insertar = mysql_query("UPDATE `nomina_ingreso` SET `h_entrad`='$hora', `entalmuer`='$htotales' WHERE cedula ='$_POST[documento]' and fecha = '$fecha'");

echo "<script type=''>
		window.location='kardex.php';
	</script>";	

	}
////////////////////////////////////////////////////////////////////////////////////////////////////////////

	if ($row_det['fecha'] == $fecha){	
				
						//echo "final". $row_det['inicio'];
						 $h1=substr($row_det['inicio'],0,-3);
						 $m1=substr($row_det['inicio'],3,2);
						 $h2=substr($hora,0,-3);
						 $m2=substr($hora,3,2);
						 $ini=(($h1*60)*60)+($m1*60);
						 $fin=(($h2*60)*60)+($m2*60);
						 $dif=$fin-$ini;
						$difh=floor($dif/3600);
						//echo "<br>";
						 $difm=floor(($dif-($difh*3600))/60);
						//return date("H:i:s",mktime($difh,$difm,'00'));
						$hnormales=1;
						$htotales=$difh;
						$htrabajo=8;
						$hextras1=($htotales-$htrabajo);
						if($hextras1 >0){
							$hextras=$hextras1;
						}
						@$hnormales=$htotales-$hextras;
			//$insertar = mysql_query("UPDATE `nomina_ingreso` SET `final`='$hora', htotales='$htotales', hextras='$hextras',hnormales='$hnormales' WHERE cedula ='$_POST[documento]' and fecha = '$fecha'");
					
}

 ////////////////////////////////////////////////Entrada Laboral  Principal///////////////////////////////777
	mysql_select_db($database_conexion, $conexion);
	$query_det1 = sprintf("SELECT * FROM nomina_ingreso WHERE cedula ='$_POST[documento]' and fecha='$fecha' order by fecha desc");
	$det1 = mysql_query($query_det1, $conexion) or die(mysql_error());
	$row_det1 = mysql_fetch_assoc($det1);
	$cedula=$row_det1['cedula'];
	
	
if ($rfid != $cedula){	
				
	 $insertSQL = sprintf("INSERT INTO nomina_ingreso (cedula, fecha,cedulaorg,hacienda, inicio) VALUES (%s, %s, %s, %s, %s)",
                       GetSQLValueString($_POST['documento'], "text"),
                       GetSQLValueString($fecha, "date"),
					   GetSQLValueString($unico, "text"),
					   GetSQLValueString($haci, "text"),
                       GetSQLValueString($hora, "date"));

					  mysql_select_db($database_conexion, $conexion);
					  $Result1 = mysql_query($insertSQL, $conexion) or die(mysql_error());
					
				}

	}///condicion /////////////////////////////////////////////////////////////////////////////////////////////////77


}


$colname_asis = "-1";
if (isset($_GET['fecha'])) {
  $colname_asis = $_GET['fecha'];
}
mysql_select_db($database_conexion, $conexion);
$query_asis = sprintf("SELECT * FROM nomina_ingreso WHERE fecha = '$fecha' ORDER BY inicio ASC", GetSQLValueString($colname_asis, "date"));
$asis = mysql_query($query_asis, $conexion) or die(mysql_error());
$row_asis = mysql_fetch_assoc($asis);
$totalRows_asis = mysql_num_rows($asis);

?>
<input type="hidden" value="<?php echo  $_POST['documento'] ?>"  name="id" id="id" >
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Control Ingreso</title>

<link href="../ingreso/css/clean.css" rel="stylesheet" type="text/css" />
<link rel="stylesheet" type="text/css" href="http://code.jquery.com/ui/1.10.3/themes/smoothness/jquery-ui.css" />
<link href="../ingreso/css/shadowbox.css" rel="stylesheet" type="text/css" />
<link href="../ingreso/css/style.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.3.1/jquery.min.js"></script>
<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.8.18/jquery-ui.min.js"></script>
<script type="text/javascript" src="//ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
<script type="text/javascript" src="http://code.jquery.com/ui/1.10.3/jquery-ui.js"></script>
<script src="../ingreso/js/shadowbox.js" type="text/javascript"></script>
<script src="../ingreso/js/jquery.validate.js" type="text/javascript"></script>
<script type="text/javascript"><!--
var curso=$('#id').val();
//alert(curso)
Shadowbox.init({
handleOversize: "drag",
modal: true,

	onClose: function(){ 
	$('#tabla').load('kardex.php?curso='+$('#id').val().replace(/ /g,"+")+ ' #tabla ' );  
	}
	
});

// </script>
</head>

<body>
<table width="90%" border="0" align="center">
  <tr>
    <td width="27%" align="left"><img src="img/logo3.png" width="300" height="140" /></td>
    <td width="73%" align="right"><input type="submit" name="button" id="button1" value="Historial De Horarios"  class="ext"  onclick="mostrar();" /></td>
  </tr>
</table>
<p>&nbsp;</p>
<form action="<?php echo $editFormAction; ?>" method="post" name="form2" id="form2">
 
  <table width="70%" border="1" align="center">
    <tr >
      <td colspan="2"  class="tittle">Registró De Asistencia</td>
    </tr>
    <tr>
      <th  class="bold">Deslice Su Documento Por El Lector</th>
      <th class="cont bold"><input type="text" name="documento" id="documento" tabindex="1" style="width:95%" /></th>
    </tr>
  </table>
  <?php
  
   
  ?>
  <input type="hidden" name="MM_insert" value="form2" />
</form>

<DIV ID="tabla">
<?php
if(@$_GET['curso'] !=''){
$cupo =$_GET['curso'];	
}else{
@$cupo =$_POST['documento'];
}
mysql_select_db($database_conexion, $conexion);
$query_bs = sprintf("SELECT * FROM nomina_valle WHERE rfid ='$cupo'");
$bs = mysql_query($query_bs, $conexion) or die(mysql_error());
$row_bs = mysql_fetch_assoc($bs);
$totalRows_bs = mysql_num_rows($bs);
///////////////VARIABLES////////////////////
@$salida=salida;
@$salalmuer=salalmuer;
@$permiso=permiso;
@$citas=citas;

////////////////////////////////////
?>
<table width="70%" border="0" align="center">
 
  <tr>
    <th colspan="2" align="left" class="tittle">Información De Empleado</th>
    <td width="242" rowspan="7" align="center">
      <table width="87%" height="231" border="1" align="center"    >
        <tr class="row">
          <td height="306" align="center"  class="row" >
            <?php  
	 $url=$row_bs['foto'];
	if ($url !=''){	
	?> 
            <img src="webcam jquery/fotos/<?php echo $url ?>.jpg" width="224" height="179" />
            <!--<img src="webcam jquery/fotos/20131118074851.jpg" width="320" height="240" />-->
            <?php	 }
	
   if ($url =='') {
?>	   
            
            <a rel="shadowbox[ejemplos];options={continuous:true,modal: true}" href="webcam jquery/index.php?id=<?php echo $row_bs['id']?>"><img src='img/foto.png' width='40' height='40' title='Agregar  Foto' />
            
            <?php }?>
            </td>
          </tr>
        </table>
      </td>
    <td width="160" align="center">&nbsp;</td>
  </tr>
  <tr>
    <th width="117" align="left" >&nbsp;</th>
    <th width="186" align="left" class="cont">&nbsp;</th>
    <?php if (@$rfid!=''){
		  if ($row_det['h_sali'] ==' ' && $row_det['h_entrad'] ==' ' ){
		  ?>
    <td width="160" align="center"><a href="act_jor.php?cedula=<?php echo $row_bs['cedula'];?>&variable=<?php echo $salalmuer?>" ><input name="button4" type="submit" class="ext" id="button3" value="Salida Almuerzo"  style='width:150px' /></a></td>
    <?php }} ?>
  </tr>

    <tr align="center">
      <td align="left" class="bold">Documento</td>
      <td width="186" align="left" class="cont"><?php echo $row_bs['cedula']; ?></td>
      <?php if (@$rfid!=''){ ?>
      <td width="160" align="center" valign="middle"><a  href="act_jor.php?cedula=<?php echo $row_bs['cedula'];?>&variable=<?php echo $permiso?>" >
      <input name="button6" type="submit" class="ext" id="button5" value="Permisos especiales"  style='width:150px'/>
      </a></td>
        <?php }?>
    </tr>
    <tr align="center">
      <td align="left" class="bold">Nombre</td>
      <td width="186" align="left" class="cont"><?php echo $row_bs['nombre']; ?></td>
      <?php if (@$rfid!=''){ ?>
      <td align="center"><a  href="act_jor.php?cedula=<?php echo $row_bs['cedula'];?>&variable=<?php echo $citas ?>" >
        <input name="button7" type="submit" class="ext" id="button6" value="Incapacidad  Médica"  style='width:150px'/>
      </a></td>
       <?php }?>
    </tr>
    <tr align="center">
      <td align="left" class="bold">Cargo</td>
      <td width="186" align="left" class="cont"><?php echo $row_bs['cargo']; ?></td>
      <?php if (@$rfid!=''){ ?>
      <td rowspan="3" align="center"><a href="act_jor.php?cedula=<?php echo $row_bs['cedula'];?>&variable=<?php echo $salida?>" >
        <input name="button3" type="submit" class="ext" id="button2" value="Final De Jornada" style='width:150px' />
      </a></td>
      <?php }?>
    </tr>
    <tr align="center">
      <td colspan="2" align="center" ><span style="color: #F00; font-size: 24px;">
        <?php
	  if ((isset($_POST["MM_insert"])) && ($_POST["MM_insert"] == "form2")) {
	   if($rfid == ''){ echo "Empleado No Existe";}} 
	   if (@$rfid != @$cedula){	}
	   ?>
      </span></td>
    </tr>
    <tr align="center">
      <td colspan="2" align="center" ><span style="color: #0F0; font-size: 24px;">
        <?php
	  
	   if (@$rfid != @$cedula){echo "Bienvenido !";	}
	   ?>
      </span></td>
    </tr>
  </table>
</DIV>
<table width="70%" border="0" align="center">
  <tr align="center" class="tittle">
    <td width="9%" >Cedula</td>
    <td width="28%" >Nombre</td>
    <td width="9%" >Entrada</td>
    <td width="8%" >Salida</td>
    <td width="12%" >Almuerzo</td>
    <td width="13%" > Horas Normales</td>
    <td width="10%" >Horas Extra</td>
    <td width="11%" > Horas Totales</td>
  </tr>
  <?php do { ?>
  <tr class="row">
    <td align="right" ><?php echo $row_asis['cedula']."&nbsp;"; ?></td>
    <td ><?php
			 mysql_select_db($database_conexion, $conexion);
			$query_cot1 = "SELECT * FROM nomina_valle WHERE rfid = '$row_asis[cedula]'";
			$cot1 = mysql_query($query_cot1, $conexion) or die(mysql_error());
			$row_cot1 = mysql_fetch_assoc($cot1);
			$totalRows_cot1 = mysql_num_rows($cot1);	
			echo "&nbsp;".$rfid=$row_cot1['nombre'];
			  
	  ?></td>
    <td align="right" ><?php echo $row_asis['inicio']; ?></td>
    <td align="right" ><?php echo $row_asis['final']; ?></td>
    <td align="center" ><?php echo $row_asis['entalmuer']?></td>
    <td align="right" ><?php echo $row_asis['hnormales']; ?></td>
    <td align="right" ><?php echo $row_asis['hextras']; ?></td>
    <td align="right" ><?php echo $row_asis['htotales']; ?></td>
  </tr>
  <?php } while ($row_asis = mysql_fetch_assoc($asis)); ?>
  <tr class="row">
    <td colspan="5" align="right" class="row bold"><strong>TOTALES  DIARIAS:</strong></td>
    <td align="right" class="row"><?php
	   $resultc = mysql_query("SELECT SUM(`hnormales`) as hnormales,SUM(`hextras`) as hextras,SUM(`htotales`) as htotales FROM nomina_ingreso WHERE fecha ='$fecha' "); 
		$rowc = mysql_fetch_array($resultc, MYSQL_ASSOC);	
		 echo number_format($hnormales=$rowc["hnormales"]);

      ?></td>
    <td align="right" ><?php echo number_format($hnormales=$rowc["hextras"]); ?></td>
    <td align="right" ><?php echo number_format($hnormales=$rowc["htotales"]); ?></td>
  </tr>
</table>
<p>&nbsp;</p>
<script language="JavaScript">
            <!-- iniciar cursor en el formulario
                  document.form2.documento.focus();
            //-->		
 </script>
</body>
</html>
<?php
mysql_free_result($bs);
?>
<script>
overlay = $('<div></div>').prependTo('body').attr('id', 'overlay');
function mostrar(){
	var url = 'loco.php';
	var w = window.open(url,'','width=1270,height=640,dependent=yes')
	window.win=w;
	overlay.show();
	checkChildWindow(w, function() {  } );
	w.moveTo(0,0);
    w.resizeTo(screen.width,screen.height);
	
	 }

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
        clearTimeout(t);
		var ano= $('#ano').val();
		
		overlay.hide();
    }
}
overlay.click(function(){
	window.win.focus()
});
</script>
