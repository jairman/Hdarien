<?
$ruta_a_joomla = "/../../../saga/";
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
	$acceso= $userx->banco_semen;
if (JFactory::getUser()->usertype == NULL)
    JError::raiseError(1,"No puede acceder A esta Aplicación sin estar logueado... Consulte al Administrador....!!!");
$userx = JFactory::getUser();

?>
<?php require_once('../Connections/conexion.php'); ?>
<?php
ini_set('display_errors', 1);
ini_set('log_errors', 1);
ini_set('error_log', dirname(__FILE__) . '/error_log.txt');
error_reporting(E_ALL);
?>
<html xmlns="http://www.w3.org/1999/xhtml">

	<head>
		<meta http-equiv="content-type" content="text/html;charset=iso-8859-1" />
		<title>Calendario en PHP con eventos</title>
		<meta http-equiv="PRAGMA" content="NO-CACHE" />
		<meta http-equiv="EXPIRES" content="-1" />
		<script type="text/javascript" src="js/jquery.js"></script>
		<script type="text/javascript" src="js/vtip.js"></script>
        <script type="text/javascript">
		$(document).ready(function(){
			setTimeout(function() {$('#mensaje').fadeOut('fast');}, 3000);
		});
		</script>
<link href="../agenda/css/style.css" rel="stylesheet" type="text/css" />
<link href="../agenda/css/shadowbox.css" rel="stylesheet" type="text/css" />
<script src="../agenda/js/shadowbox.js" type="text/javascript"></script>
<script src="../SpryAssets/SpryMenuBar.js" type="text/javascript"></script>
<link href="../SpryAssets/SpryMenuBarHorizontal.css" rel="stylesheet" type="text/css" />

<script type="text/javascript"><!--
Shadowbox.init({
handleOversize: "drag",
modal: true,

});
// </script>

		<style>
		<style>
		* {margin: ;padding: 0;font-family: Arial;} /*  al centro    */
		html,body{height:100%;width:100%;outline:0;overflow:hidden}
		body {text-align:center;margin:0;width:100%;height:100%;overflow:hidden;background:#fff;padding:30px 0}
		p#vtip { display: none; position: absolute; padding: 5px; left: 5px; font-size: 0.75em; background-color: #4D68A2; border: 1px solid #666666; -moz-border-radius: 5px; -webkit-border-radius: 5px; z-index: 9999;color:white }
		p#vtip #vtipArrow { position: absolute; top: -10px; left: 5px }
		
		#agenda{margin:10px;width:1000px;margin:0 auto}
		#agenda h1{text-align:left;margin:0;font-size:1.5em;color:#312c2b}
		#agenda h2{text-align: center;font-size:1em;color:#969696; width:99%;}
		/*#agenda h2{text-align: center;font-size:1em;color:#969696; width:9%;}*/
		#agenda table.calendario {width:5%;border:1px outset #CCC;font-size:12px;   -moz-border-radius: 5px; -webkit-border-radius: 5px; }
		.calendario th {font-weight:bold;color:white;padding:10px 5px;} 
		.calendario td{padding:10px 5px;text-align:center;border:1px solid #f0f0f0;width:100px;white-space:pre-line;}
		.calendario td p{margin:5px;font-size:12px;border:1px solid #ccc;text-align:left;padding:5px}
		
		
		.calendario td.evento {background: #E13434;color:white} /* color rojo evento */
		
		.calendario td.hoy{font-weight:bold; color:#000}
		/*
		*/
		</style>
        <style type="text/css">
#apDiv1 {
	position:absolute;
	width:38%;
	height:166px;
	z-index:1;
	top: 125px;
}
#apDiv2 {
	position: absolute;
	width: 49%;
	right: 9px;
	z-index: 1;
	height: 560px;
	top: 125px;
}
a{text-decoration:none} 
        </style>

</head>
<body >
<ul id="MenuBar1" class="MenuBarHorizontal">
 <li><a href="index_hh.php" class="current" >Agenda Mes</a>  </li>
<li><a href="alert.php" >Alertas</a>    </li>
<li><a href="editar_diario.php" >Editar Pendientes</a>    </li>
<li><a href="index_h.php"  >Historial</a>  </li>
</ul>

<p>&nbsp;</p>
<table width="98%" border="0" align="center">
  <tr>
    <td width="25%"><img src="img/Logo SAGA sin texto.png" width="200" height="70" align="left"></td>
    <td width="24%" align="right"><a rel="shadowbox[ejemplos];options={continuous:true,modal: true}" href="loco_agregar_cal.php"><img src="img/add.png" alt="" width="40" height="40" title="Agregar  Eventos Calendario"></a></td>
    <td width="51%" align="right" valign="baseline" ><img src="img/add.png" width="40" height="40" title="Agregar  Notas "></td>
  </tr>
</table>
<p>&nbsp;</p>

<p>&nbsp;</p>
<p>&nbsp;</p>
<p>&nbsp;</p>
<p>&nbsp;</p>
<p>&nbsp;</p>

<div id="agenda">
<div id="apDiv1">
		<?php
			//include("config.inc.php");
			require_once('../Connections/conexion.php');
			
			$mostrar="";
			function fecha ($valor)
			{
				$timer = explode(" ",$valor);
				$fecha = explode("-",$timer[0]);
				$fechex = $fecha[2]."/".$fecha[1]."/".$fecha[0];
				return $fechex;
			}
			
			
			
						
			if (!isset($_GET["fecha"])) 
			{
				$mesactual=intval(date("m"));
				if ($mesactual<10) $elmes="0".$mesactual;
				else $elmes=$mesactual;
				$elanio=date("Y");
			} 
			else 
			{
				$cortefecha=explode("-",$_GET["fecha"]);
				$mesactual=intval($cortefecha[1]);
				if ($mesactual<10) $elmes="0".$mesactual;
				else $elmes=$mesactual;
				$elanio=$cortefecha[0];
			}
			
			$primeromes=date("N",mktime(0,0,0,$mesactual,1,$elanio));
			
			
			
			if (!isset($_GET["mes"])) $hoy=date("Y-m-d"); 
			else $hoy=$_GET["ano"]."-".$_GET["mes"]."-01";
			
			if (($elanio % 4 == 0) && (($elanio % 100 != 0) || ($elanio % 400 == 0))) $dias=array("","31","29","31","30","31","30","31","31","30","31","30","31");
			else $dias=array("","31","28","31","30","31","30","31","31","30","31","30","31");
			
			$ides=array();
			$eventos=array();
			$titulos=array();
			
			$q1="select * from d89xz_tareas where month(fecha)='".$elmes."' and year(fecha)='".$elanio."' and estado='Pendiente'";
			mysql_select_db($dbname);
			$r1=mysql_query($q1);
			if ($f1=mysql_fetch_array($r1))
			{
				$h=0;
				do
				{
					$ides[$h]=$f1["id"];
					$eventos[$h]=$f1["fecha"];
					$titulos[$h]=$f1["tarea"];
					$h+=1;
				}
				while($f1=mysql_fetch_array($r1));
			}
			
//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
	$q12="select * from d89xz_tareas where month(fecha)='".$elmes."' and year(fecha)='".$elanio."' and estado='Pendiente'";
			mysql_select_db($dbname);
			$r12=mysql_query($q12);
			if ($f12=mysql_fetch_array($r12))
			{
				$h2=0;
				do
				{
					$ides2[$h2]=$f12["id"];
					$eventos2[$h2]=$f12["fecha"];
					$titulos2[$h2]=$f12["tarea"];
					$h2+=1;
				}
				while($f12=mysql_fetch_array($r12));
			}

///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////7			
			
			
			
			$meses=array("","Enero","Febrero","Marzo","Abril","Mayo","Junio","Julio","Agosto","Septiembre","Octubre","Noviembre","Diciembre");
			$diasantes=$primeromes-1;
			$diasdespues=42;
			$tope=$dias[$mesactual]+$diasantes;
			if ($tope%7!=0) $totalfilas=intval(($tope/7)+1);
			else $totalfilas=intval(($tope/7));
			echo "<h2>Calendario de Eventos  ".$meses[$mesactual]." de ".$elanio."</h2>";
			
			echo "<script>function mostrar(cual) 
			{if (document.getElementById(cual).style.display=='block') 
			{document.getElementById(cual).style.display='none';
			} else {document.getElementById(cual).style.display='block'} } </script> ";
			
			echo "<table class='calendario' cellspacing='0' cellpadding='0' width='49%' >";
			
			echo "<tr class='tittle'><th class='row'>Lunes</th><th class='row'>Martes</th><th class='row'>Miércoles</th><th class='row'>Jueves</th><th class='row'>Viernes</th><th class='row'>Sábado</th><th class='row'>Domingo</th></tr>
			
			<tr>";
			
			$j=1;
			$filita=0;
			function buscarevento($fecha,$eventos,$titulos)
			{
				$clave=array_search($fecha,$eventos,true);
				return $titulos[$clave];
			}
			for ($i=1;$i<=$diasdespues;$i++)
			{
				if ($filita<$totalfilas)
				{
				if ($i>=$primeromes && $i<=$tope) 
				{
					echo "<td";
					if ($j<10) $dd="0".$j;else $dd=$j;
					$compuesta=$elanio."-$elmes-$dd";
					
					if (count($eventos)>0 && in_array($compuesta,$eventos,true)) {echo " class=' evento";$noagregar=true;}
					//if (count($eventos2)>0 && in_array($compuesta,$eventos2,true)) {echo " class=' evento1";$noagregar=true;}
					else {echo " class='activa";$noagregar=false;}
					if ($hoy==$compuesta) echo " hoy";
					if ($noagregar==false) 
					
					
					echo "'><a rel='shadowbox[ejemplos];options={continuous:true}' href='loco.php?fecha=$compuesta' title='Mirar Y Agregar Evento ".fecha($compuesta)."'class='vtip'>$j<form id='evento$j' method='post' action='".$_SERVER["PHP_SELF"]."' style='display:none'></form>";
					
					else echo "'><a rel='shadowbox[ejemplos];options={continuous:true}' href='loco.php?fecha=$compuesta' title='Mirar Y Agregar Evento ".fecha($compuesta)."'class='vtip'>$j<form id='evento$j' method='post' action='".$_SERVER["PHP_SELF"]."' style='display:none'></form>";
					
				
					
//echo "<b><a href='loco.php?fecha=$compuesta'  title='Mirar Detalle de Evento ".fecha($compuesta)."'class='vtip' ><img src='buscar.jpg' /></a><b/>";
					
					echo "</td>";
					$j+=1;
				}
				else echo "<td class='desactivada'>&nbsp;</td>";
				if ($i==7 || $i==14 || $i==21 || $i==28 || $i==35 || $i==42) {echo "<tr>";$filita+=1;}
				}
			}
			echo "</table>";
			$mesanterior=date("Y-m-d",mktime(0,0,0,$mesactual-1,01,$elanio));
			$messiguiente=date("Y-m-d",mktime(0,0,0,$mesactual+1,01,$elanio));
			
			
			echo "<h2><p>&laquo; <a href='".$_SERVER["PHP_SELF"]."?fecha=$mesanterior'>Mes Anterior</a> - <a href='".$_SERVER["PHP_SELF"]."?fecha=$messiguiente'>Mes Siguiente</a> &raquo;</p></h2>";
			?>
	</td></tr></table>
</div>



<div id="apDiv2">
<h2>Reportes Diarios </h2>

<table width="99%" border="1" align="center" cellspacing="0" style=" border: 1px solid #666666; -moz-border-radius: 5px; -webkit-border-radius: 5px;font-size:12px; " >
  <tr>

    <th height="37" colspan="2" class="tittle" >EVENTOS</th>
    </tr>
    
  <tr>
    <td height="37" align="center" class="row">
      <input type="submit" name="button2" id="button2" value=" &nbsp;&nbsp;Muertes &nbsp;&nbsp;" onClick="mostrar();" class="ext">
    </td>
    <td width="50%" align="center" class="row">
      <input type="submit" name="button" id="button" value="&nbsp;&nbsp;Nacimientos&nbsp;&nbsp;" onClick="mostrar2();" class="ext">
   </td>
  </tr>
  <tr>
    <td height="37" align="center" class="row">
      <input type="submit" name="button3" id="button3" value="&nbsp;&nbsp;&nbsp;Compras&nbsp;&nbsp;" onClick="mostrar1();" class="ext">
    </td>
    <td align="center" class="row">
      <input type="submit" name="button4" id="button4" value="&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Ventas&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;" onClick="mostrar3();" class="ext">
   </td>
  </tr>
  <tr class="row">
    <td height="37" class="row"><p>&nbsp;</p></td>
    <td align="center" class="row">
      <input type="submit" name="button5" id="button5" value="Reporte Ventas" onClick="mostrar4();" class="ext">
    </td>
  </tr>
</table>
<table width="100%" border="0">
  <tr>
    <td align="center" class="tittle"><p>Notas</p></td>
  </tr>
  <tr>
    <td class="row">&nbsp;</td>
  </tr>
</table>

</div>
</body>
</html>

<script language="Javascript">

var MenuBar1 = new Spry.Widget.MenuBar("MenuBar1", {imgDown:"SpryAssets/SpryMenuBarDownHover.gif", imgRight:"SpryAssets/SpryMenuBarRightHover.gif"});


overlay = $('<div></div>').prependTo('body').attr('id', 'overlay');
function mostrar(){
	var url = 'muerte_repor.php';
		Shadowbox.open({
     content: url,
     player: "iframe",
     
     options: {                   
          initialHeight: 1,
          initialWidth: 1,
          modal: true		  
    }})
	 }
function mostrar1(){
	var url = 'ingreso_vacuno.php';
		Shadowbox.open({
     content: url,
     player: "iframe",
     
     options: {                   
          initialHeight: 1,
          initialWidth: 1,
          modal: true		  
    }})
	 }
function mostrar2(){
	var url = 'paritorio_vacas_nacimientos_agenda.php';
		Shadowbox.open({
     content: url,
     player: "iframe",
     
     options: {                   
          initialHeight: 1,
          initialWidth: 1,
          modal: true		  
    }})
	 }
function mostrar3(){
	var url = 'stin_bascula.php';
		Shadowbox.open({
     content: url,
     player: "iframe",
     
     options: {                   
          initialHeight: 1,
          initialWidth: 1,
          modal: true		  
    }})
	 }	 
function mostrar4(){
	var url = 'stin_buscar_bascula.php';
		Shadowbox.open({
     content: url,
     player: "iframe",
     
     options: {                   
          initialHeight: 1,
          initialWidth: 1,
          modal: true		  
    }})
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
		$('#tabla').load('stin_sanita2.php?ano=' + ano + ' #tabla ' );
		overlay.hide();
    }
}
overlay.click(function(){
	window.win.focus()
});
</script>

<style>
#overlay {
    position: fixed; 
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background: #000;
    opacity: 0.8;
    filter: alpha(opacity=80);
    z-index:50;
	display:none;
}
</style>



