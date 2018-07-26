<?
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
		<title>HOJA DE HORARIOS</title>
		<meta http-equiv="PRAGMA" content="NO-CACHE" />
		<meta http-equiv="EXPIRES" content="-1" />
		<script type="text/javascript" src="js/jquery.js"></script>
		<script type="text/javascript" src="js/vtip.js"></script>
		<script type="text/javascript">
		$(document).ready(function(){
			setTimeout(function() {$('#mensaje').fadeOut('fast');}, 3000);
		});
		</script>
<script src="../SpryAssets/SpryMenuBar.js" type="text/javascript"></script>
<link href="../SpryAssets/SpryMenuBarHorizontal.css" rel="stylesheet" type="text/css" />        
<link href="../ingreso/css/style.css" rel="stylesheet" type="text/css" />
<link href="../ingreso/css/shadowbox.css" rel="stylesheet" type="text/css" />
<script src="../ingreso/js/shadowbox.js" type="text/javascript"></script><script type="text/javascript"><!--
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
<table width="98%" border="0" align="center" cellspacing="0">
  <tr bgcolor="#f0f0f0">
    <td width="858" align="left" bgcolor="#FFFFFF"><ul id="MenuBar1" class="MenuBarHorizontal">
      <li><a href="agenda.php" >Historial Colectivo</a></li>
      <li><a href="agenda2.php" class="current">Historial Individual</a></li>
    </ul></td>
    <td width="94" align="center" bgcolor="#FFFFFF">&nbsp;</td>
    <td width="58" align="left" bgcolor="#FFFFFF">&nbsp;</td>
  </tr>
</table>
<table width="98%">
  <tr>
    <td><img src="img/logo3.png" alt="" width="300" height="140" /></td>
  </tr>
</table>
<table width="100%" border="0">
  <tr>
    <td class="tittle">Seleccione Fecha&nbsp; De  Ingreso</td>
  </tr>
</table>

	<div id="agenda">
	</td>
	</tr></table>

</body>
</html>
