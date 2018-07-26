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
	$acceso= $userx->agenda;
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
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
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
<script src="../agenda/js/shadowbox.js" type="text/javascript"></script><script type="text/javascript"><!--
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
		.calendario td.evento {background:#0C3;color:white} /* color rojo evento */	
		.calendario td.hoy{font-weight:bold; color:#000}
 		a{text-decoration:none} 
	</style>
    
<script type="text/javascript"><!--
Shadowbox.init({
handleOversize: "drag",
modal: true,

});
// </script>
</head>
<body>
<table width="99%" border="0" align="center">
  <tr>
    <td align="center"><a href="index_hh.php"><img src="img/last.png" alt="" width="40" height="40" /></a></td>
  </tr>
</table>
<p>&nbsp;</p>

	<div id="agenda">
		<?php
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
			
			$q1="select * from d89xz_tareas where month(fecha)='".$elmes."' and year(fecha)='".$elanio."' and estado='Cumplida'  and hac='$usuario2'";
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
					else {echo " class='activa";$noagregar=false;}
					if ($hoy==$compuesta) echo " hoy";
					if ($noagregar==false) 
					
					
					echo "'><a rel='shadowbox[ejemplos];options={continuous:true}' href='loco_cumplidas.php?fecha=$compuesta' title='Mirar  ".fecha($compuesta)."'class='vtip'>$j<form id='evento$j' method='post' action='".$_SERVER["PHP_SELF"]."' style='display:none'></form>";
					
					else echo "'><a rel='shadowbox[ejemplos];options={continuous:true}' href='loco_cumplidas.php?fecha=$compuesta' title='Mirar  ".fecha($compuesta)."'class='vtip'>$j<form id='evento$j' method='post' action='".$_SERVER["PHP_SELF"]."' style='display:none'></form>";
					
					
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

</body>
</html>
